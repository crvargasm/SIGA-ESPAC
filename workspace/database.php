<?php
$server = "localhost";
$username = "searcher";
$password = "Searchnow4272$";
$database = "espac";

$conn = mysqli_connect($server, $username, $password, $database);
//Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $cone->connect_error);
}
  //echo "Connected successfully";
