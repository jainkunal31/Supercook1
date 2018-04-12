<?php

//connection variables
$host = 'localhost';
$user = 'root';
$password = 'kunal@123';
$dbname='accounts';

//create mysql connection
$mysqli = new mysqli($host,$user,$password,$dbname);
if ($mysqli->connect_errno) {
    printf("Connection failed: %s\n", $mysqli->connect_error);
    die();
}


?>