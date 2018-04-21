<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script src="scripts/ajax.js"></script>
        <link rel="stylesheet" href="css/tabledisplay.css" />
        <link rel="stylesheet" href="css/common.css" />
    </head>
    <body onload="getFullTable()">
        <select id="sortby" onchange="getFullTable()">
            <option value="ID">Sort By...</option>
            <option value="RXDate,RXTime">Date and Time</option>
            <option value="Sig">Signal Report</option>
            <option value="Frequency">Frequency</option>
            <option value="Callsign">Call Sign</option>
            <option value="Grid">Grid Square</option>
            <option value="Power">TX Power</option>
        </select>
        <select id="sortorder" onchange="getFullTable()">
            <option value="ASC">Ascending</option>
            <option value="DESC">Descending</option>
        </select>
        <select id="filter" onChange="getFullTable()">
            <option value="Log">Filter By Band...</option>
            <option value="2200m">2200m</option>
            <option value="630m">630m</option>
            <option value="160m">160m</option>
            <option value="80m">80m</option>
            <option value="40m">40m</option>
            <option value="30m">30m</option>
            <option value="20m">20m</option>
            <option value="17m">17m</option>
            <option value="15m">15m</option>
            <option value="12m">12m</option>
            <option value="10m">10m</option>
        </select>
        <p><div id="tableArea"></div></p>
    </body>
</html>
