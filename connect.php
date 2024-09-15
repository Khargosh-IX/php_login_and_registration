<?php
// Database connection
$host = "localhost";
$user = "root";
$password = "";
$dbname = "phplogin";

// connection
$connect = mysqli_connect($host, $user, $password, $dbname);

// check connection
if(!$connect){
    die("Connection failed:" . mysqli_connect_error());
}
?>