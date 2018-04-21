<?php
    header("Content-type: text/javascript");  
    include("config/dbconnect.php");
    include("lib/gridtools.php");
    
    $conn = new mysqli($mysql_host, $mysql_user, $mysql_pass, $mysql_scma);
    if($conn->connect_error) {
        die("ERROR: Could not generate graph!");
    }
    
    $varnames = array("twentytwohundred", "sixthirty", "onesixty", "eighty", "forty", "thirty", "twenty", "seventeen", "fifteen", "twelve", "ten");
    $bands = array("2200m", "630m", "160m", "80m", "40m", "30m", "20m", "17m", "15m", "12m", "10m");
    $colors = array("maroon", "red", "orange", "yellow", "green", "purple", "fuchsia", "lime", "aqua", "blue", "black");

    for($i = 0; $i < count($bands); $i++) {
        echo "var " . $varnames[$i] . " = {\n" . 
                generateJSArrays($conn, intval($_GET["days"]), $bands[$i]) .
                "\n\ttype: 'bar',\n\tname: '" . $bands[$i] .
                "',\n\tmarker: {\n\t\tcolor: '" . $colors[$i] . "',\n\t\topacity: 0.7,\n\t}\n};\n\n";
    }
    
    function generateJSArrays($conn, $numDays, $table) {
        $gridfile = fopen("mygrid", "r") or die("issue");
        $mygrid = fread($gridfile, filesize("mygrid"));
        fclose($gridfile);
        
        $x = "\tx: [";
        $y = "\ty: [";
        for($i = $numDays; $i > 0; $i--) {
            $total = 0;
            $workingDate = intval(date("ymd", strtotime("-". $i . " days")));
            $x = $x . "'" . date_format(date_create_from_format("ymd", strval($workingDate)), "F j, Y") . "'";
            $results = $conn->query("SELECT * FROM " . $table . " WHERE RXDate = " . $workingDate . ";");
            $num = $results->num_rows;
            while($current = $results->fetch_assoc()) {
                $long = getDeltaLong($mygrid, $current["Grid"]);
                $lat = getDeltaLat($mygrid, $current["Grid"]);
                $total += getDistance($long, $lat);
            }
            $avg = $total / $num;
            if(is_nan($avg)) {
                $avg = 0;
            }
            $y = $y . strval(round($avg));
            if($i > 1) {
                $x = $x . ", ";
                $y = $y . ", ";
            }
        }
        $x = $x . "],";
        $y = $y . "],";
        return $x . "\n" . $y;
    }
    
    $conn->close();   
?>