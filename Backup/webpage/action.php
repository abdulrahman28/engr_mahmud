<?php


if ($_SERVER["REQUEST_METHOD"] == "GET") {
   $fname =  $_GET['fname'];
   $lname =  $_GET['lname'];
   $uname =  $_GET['uname'];
   $country =  $_GET['country'];
   $s =  $_GET['subject'];
}


echo "The Name of User is " . $fname . " " . $lname . ". <br>The subject is " . $s;


?>