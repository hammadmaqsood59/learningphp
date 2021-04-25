<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "aajjdb";

//Create Connection

$conn = new mysqli($servername,$username, $password, $dbname);

//cheak connection

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected Successfully";