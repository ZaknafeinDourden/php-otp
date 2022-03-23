<?php 


$servername = "";
$username = "";
$password = "";
$dbname = "otp_project";

// Create connection
$db = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$db) {
  die("Connection failed: " . mysqli_connect_error());
}
//echo "succesful";
 
 


 ?>