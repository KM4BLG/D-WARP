<?php

// Make this output a CSV file rather than HTML file
header("Content-Type: text/csv");
header("Content-Disposition: attachment; filename=dwarp.csv");

// Include database login config file
include("config/dbconnect.php");
include("lib/gridtools.php");

// Establish DB connection
$conn = new mysqli($mysql_host, $mysql_user, $mysql_pass, $mysql_scma);
if($conn->connect_error) {
    die("Error getting table.");
}

// Retrieve GET Data
$sortby = $_GET["sortby"];
$sortorder = $_GET["sortorder"];
$table = $_GET["show"];

// Generate Main SQL SELECT
$select = "SELECT * FROM " . $table . " ORDER BY " . $sortby . " " . $sortorder . ";";

// Perform Query
$results = $conn->query($select);

$gridfile = fopen("mygrid", "r");
$mygrid = fread($gridfile, filesize("mygrid"));
fclose($gridfile);

// Output CSV
if($results->num_rows > 0) {
    echo("Date,Time,Signal,Frequency,Call Sign,Grid Square,TX Power,Distance (mi),Bearing");
    // For each row, create according to CSV standard
    while($current = $results->fetch_assoc()) {
        $long = getDeltaLong($mygrid, $current["Grid"]);
        $lat = getDeltaLat($mygrid, $current["Grid"]);
        echo("\n" . str_pad($current["RXDate"], 6, '0', STR_PAD_LEFT) .
                "," . str_pad($current["RXTime"], 4, '0', STR_PAD_LEFT) .
                "," . $current["Sig"]. "," . $current["Frequency"] .
                "," . $current["Callsign"]. "," . $current["Grid"] .
                "," . $current["Power"]) . "," . round(getDistance($long, $lat)) . "," . round(getBearing($long, $lat));
    }
}
// If no results, notify user.
else {
    die("No results.");
}

?>