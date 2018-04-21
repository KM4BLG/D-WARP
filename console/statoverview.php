<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
    include("config/dbconnect.php");
    $GLOBALS["conn"] = new mysqli($mysql_host, $mysql_user, $mysql_pass, $mysql_scma);
    if($GLOBALS["conn"]->connect_error) {
        die("Error getting stats.");
    }
    
    $results = $GLOBALS["conn"]->query("SELECT * FROM Log ORDER BY RXDate");
    
    $totalRows = $results->num_rows;
    $totalDays = 0;
    $currentDay = 0;
    
    function getTotalRows($table) {
        return $GLOBALS["conn"]->query("SELECT * FROM " . $table)->num_rows;
    }
    
    if($results->num_rows > 0) {
        while($current = $results->fetch_assoc()) {
            if(($temp = $current["RXDate"]) != $currentDay) {
                $currentDay = $temp;
                $totalDays++;
            }
        }
    }
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="css/common.css" />
    </head>
    <body>
        <h1>Overview</h1>
        <div class="statBlock">
            <h3>Log Stats</h3>
            <ul>
                <li>Total Stations: <?php echo(getTotalRows("Log")); ?></li>
                <li>Average Per Day: <?php echo(round($totalRows / $totalDays)); ?></li>
            </ul>
            <h3>Entries By Band</h3>
            <ul>
                <li>2200m: <?php echo(getTotalRows("2200m")); ?></li>
                <li>630m: <?php echo(getTotalRows("630m")); ?></li>
                <li>160m: <?php echo(getTotalRows("160m")); ?></li>
                <li>80m: <?php echo(getTotalRows("80m")); ?></li>
                <li>40m: <?php echo(getTotalRows("40m")); ?></li>
                <li>30m: <?php echo(getTotalRows("30m")); ?></li>
                <li>20m: <?php echo(getTotalRows("20m")); ?></li>
                <li>17m: <?php echo(getTotalRows("17m")); ?></li>
                <li>15m: <?php echo(getTotalRows("15m")); ?></li>
                <li>12m: <?php echo(getTotalRows("12m")); ?></li>
                <li>10m: <?php echo(getTotalRows("10m")); ?></li>
            </ul>
        </div>
        
        <?php
            $conn->close();
        ?>
    </body>
</html>
