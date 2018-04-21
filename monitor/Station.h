/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/* 
 * File:   Station.h
 * Author: zach
 *
 * Created on February 5, 2018, 10:26 PM
 */

#ifndef STATION_H
#define STATION_H

using namespace std;

class Station {
    private:
        unsigned int date;
        unsigned int time;
        int sig;
        double freq;
        string callsign;
        string grid;
        unsigned int txpower;
    public:
        Station(unsigned int, unsigned int, int, double, string, string, unsigned int);
        unsigned int getDate();
        unsigned int getTime();
        int getSig();
        double getFreq();
        string getCall();
        string getGrid();
        unsigned int getTxPower();
};

#endif /* STATION_H */

