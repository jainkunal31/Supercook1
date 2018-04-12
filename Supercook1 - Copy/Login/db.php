<?php
/* Database connection settings */
$host = 'localhost';
$user = 'root';
$pass = 'kunal@123';
$db = 'accounts';
$mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);
