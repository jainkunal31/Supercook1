<?php


$servername = "localhost";
$username = "root";
$password = "kunal@123";
$database = "test";

//Connection to database, we use OOP method of connection
$db = new mysqli($servername, $username, $password, $database);

//Returns true if there is NO connection
if(!$db){
	//Error Message
	die("Connection failed: " . $db->connect_error);
}