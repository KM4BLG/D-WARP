/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// Sends full station table to a div
// Adapted from W3Schools AJAX example
function getFullTable() {
    var sortby = document.getElementById("sortby").value;
    var sortorder = document.getElementById("sortorder").value;
    var filter = document.getElementById("filter").value;
    var tableArea = document.getElementById("tableArea");
    
    tableArea.innerHTML = "Loading...";
    
    var req = new XMLHttpRequest();
    
    req.onreadystatechange = function() {
        if(this.readyState === 4 && this.status === 200) {
            tableArea.innerHTML = this.responseText;
        }
    };
    
    req.open("GET", "getstationtable.php?sortby=" + sortby + "&sortorder=" + sortorder + "&show=" + filter, true);
    req.send();
}

function generateExportLink() {
    var sortby = document.getElementById("sortby").value;
    var sortorder = document.getElementById("sortorder").value;
    var filter = document.getElementById("filter").value;
    var link = document.getElementById("csvlink");
    
    link.href = "getcsv.php?sortby=" + sortby + "&sortorder=" + sortorder + "&show=" + filter;
}

function getFilterByCall() {
    var callsign = document.getElementById("callsign").value;
    var tableArea = document.getElementById("tableArea");
    
    tableArea.innerHTML = "Loading...";
    
    var req = new XMLHttpRequest();
    
    req.onreadystatechange = function() {
        if(this.readyState === 4 && this.status === 200) {
            tableArea.innerHTML = this.responseText;
        }
    };
    
    req.open("GET", "getstationtable.php?sortby=RXDate,RXTime&sortorder=ASC&show=Log&filterby=Callsign&filter=" + callsign, true);
    req.send();
}

function getFilterByGrid() {
    var grid = document.getElementById("grid").value;
    var tableArea = document.getElementById("tableArea");
    
    tableArea.innerHTML = "Loading...";
    
    var req = new XMLHttpRequest();
    
    req.onreadystatechange = function() {
        if(this.readyState === 4 && this.status === 200) {
            tableArea.innerHTML = this.responseText;
        }
    };
    
    req.open("GET", "getstationtable.php?sortby=RXDate,RXTime&sortorder=ASC&show=Log&filterby=Grid&filter=" + grid, true);
    req.send();
}

function updateGType() {
    document.getElementById("graphform").action = document.getElementById("graphtype").value + ".php";
}