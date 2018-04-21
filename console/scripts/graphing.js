/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function getTotals(days, log) {
    var newest = 0;
    var diff;
    var values = [];
    while(log.length > 0) {
        var currentReport = log.pop();
        if(newest === 0) {
            newest = currentReport.RXDate;
        }
        diff = newest - currentReport.RXDate;
        if(diff >= days) {
            break;
        }
        values[diff]++;
    }
    return values;
}