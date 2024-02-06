<?php
if (!session_id()) session_start();
// Set database info
$host = "aarjzohjnmvt66.clylrxtmqasn.us-east-1.rds.amazonaws.com"; // host
//$host = "localhost"; // host
//$username = "root";  // user
$username = "uts";  // user
$password = "19092001?A"; // password
//$password = "";
$mysql_database = "grocery_store"; // database name

// create connect
$conn = mysqli_connect($host, $username, $password, $mysql_database);

// check connect
if(!$conn){
    die("error:" . mysqli_connect_error());
}

mysqli_set_charset($conn,'utf8'); // Set the encoding to utf8

?>