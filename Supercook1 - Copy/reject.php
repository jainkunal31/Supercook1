<?php
session_start();
$host = 'localhost';
$user = 'root';
$password = 'kunal@123';
$dbname='test';

$conn = new mysqli($host,$user,$password,$dbname);
if ($conn->connect_errno) {
    printf("Connection failed: %s\n", $conn->connect_error);
    die();
}



if(isset($_GET['id']) && !empty($_GET['id'])) {





$items = $_GET['id'];
echo $items;
$sql = "UPDATE images set isrejected=1 where id=$items";


if (mysqli_query($conn,$sql) === TRUE) {
  header('Location: ' . $_SERVER['HTTP_REFERER']);
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
}
?>