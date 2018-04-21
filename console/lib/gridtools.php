<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//$long = getDeltaLong("EM88", "EL85");
//$lat = getDeltaLat("FM85", "EL85");

//echo getBearing($long, $lat);

function getDeltaLong($source, $destination) {
    return ((ord($destination[0]) - ord($source[0])) * 10 + ord($destination[2]) - ord($source[2])) * 100;
}

function getDeltaLat($source, $destination) {
    return ((ord($destination[1]) - ord($source[1])) * 10 + ord($destination[3]) - ord($source[3])) * 70;
}

function getDistance($long, $lat) {
    return sqrt(pow($long, 2) + pow($lat, 2));
}

function getBearing($long, $lat) {
    $bearing = rad2Deg(atan2($long, $lat));
    if($long < 0) {
        $bearing = 360 + $bearing;
    }
    return $bearing;
}

?>