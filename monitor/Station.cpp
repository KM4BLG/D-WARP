/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

#include <string.h>
#include <stdlib.h>
#include <string>
#include "Station.h"

using namespace std;

Station::Station(unsigned int date, unsigned int time, int sig, double freq, string callsign, string grid, unsigned int txpower) {
    this->date = date;
    this->time = time;
    this->sig = sig;
    this->freq = freq;
    this->callsign = callsign;
    this->grid = grid;
    this->txpower = txpower;
}

unsigned int Station::getDate() {
    return date;
}

unsigned int Station::getTime() {
    return time;
}

int Station::getSig() {
    return sig;
}

double Station::getFreq() {
    return freq;
}

string Station::getCall() {
    return callsign;
}

string Station::getGrid() {
    return grid;
}

unsigned int Station::getTxPower() {
    return txpower;
}