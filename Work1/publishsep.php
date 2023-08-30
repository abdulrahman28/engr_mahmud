<?php

include_once "config.php";

$apikey = "unilorin-waterquality";

$temp = $tur = $ph = $orp = $ec = $flow = $api = "";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $api = test_input($_GET["api"]); 
    if($api == $apikey){
    $temp = test_input($_GET["temp"]); 
    $tur = test_input($_GET["tur"]);
    $ph = test_input($_GET["ph"]);
    $orp = test_input($_GET["orp"]);
    $ec = test_input($_GET["ec"]);
    $flow = test_input($_GET["flow"]);
    op("INSERT INTO sdata(temp, tur, ph, orp, ec, flow) VALUES ($temp, $tur, $ph, $orp, $ec, $flow)");
    }
    else echo "Wrong API!!!";
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

?>