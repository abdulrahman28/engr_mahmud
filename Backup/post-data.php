<?php

require_once "config.php";

if ($_SERVER["REQUEST_METHOD"] == "GET"){
    
    $ld1 = $_GET["ld1"];
    $ld2 = $_GET["ld2"];
    $ld3 = $_GET["ld3"];
    $ld4 = $_GET["ld4"];
    
op("INSERT INTO cdata(ld1, ld2, ld3, ld4) VALUES ($ld1, $ld2, $ld3, $ld4)");

}

?>