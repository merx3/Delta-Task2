<?php
$username = "team1_dpuser";
$password = "zxsdergfbv$";
$hostname = "localhost"; 

//connection to the database
$dbconn = mysqli_connect($hostname, $username, $password, "team1_delta")
  or die("Unable to connect to MySQL");

if (mysqli_connect_errno($dbconn))
{
    echo "Failed to connect to MySQL:" . mysqli_connect_error();
}
?>
