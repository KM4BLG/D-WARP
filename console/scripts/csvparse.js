/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function parseCSVLine(line) {
    var components = line.split(",");
    return {
        RXDate: components[0],
        RXTime: components[1],
        Sig: components[2],
        Frequency: components[3],
        Callsign: components[4],
        Grid: components[5],
        Power: components[6]
    };
}

function parseFile(ftext) {
    var rawLines = ftext.split("\n");
    var i;
    var sArray = [];
    for(i = 1; i < rawLines.length; i++) {
        sArray.push(parseCSVLine(rawLines[i]));
    }
    return sArray;
}

function getCSVText() {
    var req = new XMLHttpRequest();
    var resp;
    
    req.onreadystatechange = function() {
        if(this.readyState === 4 && this.status === 200) {
            resp = this.responseText;
        }
    };
    
    req.open("GET", "getcsv.php?sortby=RXDate&sortorder=ASC&show=Log", true);
    req.send();
    
    return resp;
}