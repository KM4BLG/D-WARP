<link rel="stylesheet" href="css/common.css" />


<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include("config/dbconnect.php");
include("lib/gridtools.php");

$conn = new mysqli($mysql_host, $mysql_user, $mysql_pass, $mysql_scma);

if($conn->connect_error) {
    die("Error getting table.");
}

$sortby = $_GET["sortby"];
$sortorder = $_GET["sortorder"];
$table = $_GET["show"];
$filterby = $_GET["filterby"];
$filter = $_GET["filter"];

if(!is_null($filterby) && !is_null($filter)) {
    $whereclause = " WHERE " . $filterby . " = \"" . $filter . "\"";
}

$select = "SELECT * FROM " . $table . $whereclause . " ORDER BY " . $sortby . " " . $sortorder . ";";
$results = $conn->query($select);

$gridfile = fopen("mygrid", "r");
$mygrid = fread($gridfile, filesize("mygrid"));
fclose($gridfile);

if($results->num_rows > 0) {
    echo("<table><tr><td>Date</td><td>Time</td><td>Signal</td><td>Frequency (MHz)</td><td>Call Sign</td><td>Grid Square</td><td>TX Power (dBm)</td><td>Distance (mi)</td><td>Bearing</td></tr>");
    while($current = $results->fetch_assoc()) {
        $long = getDeltaLong($mygrid, $current["Grid"]);
        $lat = getDeltaLat($mygrid, $current["Grid"]);
        echo("<tr><td>" . str_pad($current["RXDate"], 6, '0', STR_PAD_LEFT) .
                "</td><td>" . str_pad($current["RXTime"], 4, '0', STR_PAD_LEFT) .
                "</td><td>" . $current["Sig"]. "</td><td>" . $current["Frequency"] .
                "</td><td>" . $current["Callsign"]. "</td><td>" . $current["Grid"] .
                "</td><td>" . $current["Power"] . "</td><td>" . round(getDistance($long, $lat)) . "</td><td>" . round(getBearing($long, $lat)) . "</td></tr>\n");
    }
    echo("</table>");
}
else {
    die("No results.");
}

?>