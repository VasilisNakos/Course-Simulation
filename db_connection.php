<?php 

$servername = "webpagesdb.it.auth.gr:3306";
$username = "Vasileios";
$password = "ergasia123";
$dbname = "student4041partB";

$conn = new mysqli($servername,$username,$password,$dbname);

if($conn->connect_error)
	die("Connection failed: " . $conn->connect_error);

?>
