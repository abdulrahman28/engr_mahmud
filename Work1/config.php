<?php

function conn(){
    
    $servername = "localhost";
    $username   = "unilori5_admin";
    $password   = "olalekan@28";
    $dbname     = "unilori5_mydb";
    
    $dbc = new mysqli($servername, $username, $password, $dbname);

if ($dbc->connect_error) {
    die("Database Connection failed: " . $dbc->connect_error);
    exit();
    }
    
    return $dbc;
}


 //New Code


function dt() {
    
  $dbc = conn();
  
  $sql = "SELECT logtime FROM sdata order by logtime";
  
  if ($result = $dbc->query($sql)) return $result;
  
  else return false;
  
  $dbc->close();
}


  function getAllReadings($limit) {
    
    $dbc = conn();
    
    $sql = "SELECT id,  temp, tur, ph, orp, ec, flow, logtime FROM sdata order by logtime desc limit " . $limit;
    
    if ($result = $dbc->query($sql)) return $result;
    
    else return false;
    
    $dbc->close();
  }
  
  function getLastReadings() {
      
     $dbc = conn();
     
    $sql = "SELECT id, temp, tur, ph, orp, ec, flow, logtime FROM sdata order by logtime desc limit 1";
    
    if ($result = $dbc->query($sql)) return $result->fetch_assoc();
    else return false;
    
    $dbc->close();
  }

  function minReading($limit, $value) {
      
     $dbc = conn();
     
    $sql = "SELECT MIN(" . $value . ") AS min_amount FROM (SELECT " . $value . " FROM sdata order by logtime desc limit " . $limit . ") AS min";
    
    if ($result = $dbc->query($sql)) return $result->fetch_assoc();
    else return false;
    
    $dbc->close();
  }

  function maxReading($limit, $value) {
     
    $dbc = conn();
    
    $sql = "SELECT MAX(" . $value . ") AS max_amount FROM (SELECT " . $value . " FROM sdata order by logtime desc limit " . $limit . ") AS max";
    
    if ($result = $dbc->query($sql)) return $result->fetch_assoc();
    else return false;
    
    $dbc->close();
  }

  function avgReading($limit, $value) {
     
    $dbc = conn();
     
    $sql = "SELECT AVG(" . $value . ") AS avg_amount FROM (SELECT " . $value . " FROM sdata order by logtime desc limit " . $limit . ") AS avg";
    
    if ($result = $dbc->query($sql)) return $result->fetch_assoc();
    else return false;
    
    $dbc->close();
  }
 
    
//Old Code    
    
function op($query){
    $dbc = conn();
    
    if($dbc->query($query))echo "OK";
    
    $dbc->close();
}


function opp($query){
  $dbc = conn();
  
  if($dbc->query($query)) echo "";
  
  $dbc->close();
}

function rd($query){
    $dbc = conn();
    
    $res = $dbc->query($query);

    if(mysqli_num_rows($res)){
    while($row = mysqli_fetch_assoc($res))echo json_encode($row);
    }   
    
    $dbc->close();
}

function rdd(){

  $dbc = conn();

  $p = array();
  $t = array();

  $query = "SELECT power, reading_time FROM sdata ORDER BY id";
  $res = $dbc->query($query);

  if(mysqli_num_rows($res)){
  while($row = mysqli_fetch_assoc($res)){
    array_push($p,$row['power']);
    $row_reading_time = $row['reading_time'];
    array_push($t,date("Y-m-d H:i:s", strtotime("$row_reading_time + 301 minutes")));
  }
}

$f = array("Power"=>$p, "Time"=>$t);

echo json_encode($f);
  
$dbc->close();

}

?>