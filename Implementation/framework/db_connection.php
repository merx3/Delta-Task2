<?php
$username = "team1_dpuser";
$password = "zxsdergfbv$";
$hostname = "localhost"; 

//connection to the database
$dbhandle = mysqli_connect($hostname, $username, $password, "team1_delta")
  or die("Unable to connect to MySQL");
?>