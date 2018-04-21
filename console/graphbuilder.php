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
        <link rel="stylesheet" href="css/common.css" />
    </head>
    <body onload="updateGType()">
        <h1>Generate Graph</h1>
        
        <form action="totalsgraph.php" method="GET" id="graphform">
            Daily
            <select id="graphtype" onchange="updateGType()">
                <option value="totalsgraph">Number of Reports</option>
                <option value="avgdistgraph">Average Distance</option>
            </select>
            Last
            <input type="number" id="days" name="days" />
            Days
            <input type="submit" min="1" value="Generate" />
        </form>
        <div id="errorBlock"></div>
        <?php
            
        ?>
    </body>
</html>
