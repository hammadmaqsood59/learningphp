<?php


session_start();
$_SESSION = array();
session_destroy();
//header("location: login.php");
header('Location: http://localhost/aajjlogin/login.php');


?>