/* 
 * File:   main.cpp
 * Author: zach
 *
 * Created on February 5, 2018, 10:21 PM
 */

#include <iostream>
#include <fstream>
#include <string>
#include <stack>
#include "Station.h"

#include "mysql_connection.h"
#include <cppconn/driver.h>
#include <cppconn/exception.h>
#include <cppconn/resultset.h>
#include <cppconn/statement.h>

using namespace std;

Station getStationFromLogLine(string line);

int main(int argc, char** argv) {
    cout << "D-WARP Database Synchronization Engine v1.0.0\nDeveloped By Zach Thompson - KM4BLG\n\n";
    
    // Check cmd args
    if (argc < 5) {
        cerr << "Usage: ./dwarp_logger <Log File> <Host:Port> <Username> <Password>\n";
        return EXIT_FAILURE;
    }

    // Initialize log path, server address, username, and password strings
    string logPath = argv[1];
    string serverAddr = argv[2];
    string username = argv[3];
    string password = argv[4];

    cout << "Opening WSPR log file...\n";

    // Open and verify WSPR log file
    ifstream logFile;
    logFile.open(logPath);
    if (!logFile.is_open()) {
        cerr << "ERROR: Could not access WSPR Log File!\n";
        return EXIT_FAILURE;
    }

    cout << "Log file opened successfully. Parsing log file...\n";

    string currentLine;

    // Declare stack to hold Station objects
    stack<Station> stationStack;

    // Parse file line by line,
    // creating Station objects and pushing them to the stack
    while (getline(logFile, currentLine)) {
        // Check for valid line before parsing
        if (currentLine.find("Transmitting") == string::npos && currentLine != "") {
            // Create station object and push to stack
            Station s = getStationFromLogLine(currentLine);
            stationStack.push(s);
        }
    }
    
    try {
        cout << "Log file parse complete. Attempting MySQL server connection...\n";
        // Declare Variables needed for MySQL connection
        sql::Driver* DBDriver;
        sql::Connection* conn;
        sql::Statement* query;
        sql::ResultSet* results;

        // Setup and Establish MySQL connection
        DBDriver = get_driver_instance();
        conn = DBDriver->connect("tcp://" + serverAddr, username, password);
        conn->setSchema("DWARP");
        query = conn->createStatement();

        cout << "Connected to MySQL server. Syncing database...\n";
        
        // Main loop for working our way through the stack
        while (!stationStack.empty()) {
            Station s = stationStack.top();
            // Check for duplicate entry against top of stack
            string select("SELECT * FROM Log WHERE RXDate = " + to_string(s.getDate())
                    + " AND RXTime = " + to_string(s.getTime()) + " AND Sig = " +
                    to_string(s.getSig()) + " AND Frequency = " + to_string(s.getFreq())
                    + " AND Callsign = \"" + s.getCall() + "\" AND Grid = \"" + s.getGrid()
                    + "\" AND Power = " + to_string(s.getTxPower()) + ";");
            results = query->executeQuery(select);
            // If duplicate found, we have finished reading in new entries
            if (results->next()) {
                break;
            }

            // If no duplicate, do an insert
            string insert("INSERT INTO Log (RXDate,RXTime,Sig,Frequency,Callsign,Grid,Power) VALUES ("
                    + to_string(s.getDate()) + "," + to_string(s.getTime()) + "," + to_string(s.getSig())
                    + "," + to_string(s.getFreq()) + ",\"" + s.getCall() + "\",\"" + s.getGrid() + "\","
                    + to_string(s.getTxPower()) + ");");

            query->execute(insert);
            // Move to next element in stack
            stationStack.pop();
        }

        cout << "Database synchronization complete. Disconnecting from MySQL server...\n";
        
        // Close connection and free memory occupied by MySQL connector
        conn->commit();
        conn->close();
        delete results;
        delete query;
        delete conn;
        
        cout << "Disconnected from MySQL server. D-WARP synchronization complete.\n";
        
    }    catch (sql::SQLException &e) {
        // Error handling for database connection
        cerr << "ERROR: Could not connect to MySQL Database Server!\n";
        return EXIT_FAILURE;
    }

    return EXIT_SUCCESS;
}

/**
 * Creates a station object from a line of the log file.
 * @param line - String of line from file
 * @return A Station object if line was properly formatted, returns null otherwise
 */
Station getStationFromLogLine(string line) {
    unsigned int date;
    unsigned int time;
    int sig;
    double freq;
    char callsign[7];
    char grid[7];
    unsigned int txpower;
    sscanf(line.c_str(), "%u %u %*s %i %*s %lf  %s %s %u %*s", &date, &time, &sig, &freq, callsign, grid, &txpower);
    Station s(date, time, sig, freq, callsign, grid, txpower);
    return s;
}