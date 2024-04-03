<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();


include "database.php";
global $conn;
$user_id = $_SESSION['id'];




function adress(){

	include "database.php";
	global $conn;

	$user_id = $_SESSION['id'];
	$query = mysqli_query($conn, "SELECT adress FROM users WHERE user_id = '$user_id'");
	$row = mysqli_fetch_assoc($query);


	echo $row['adress'];
}

function phone(){

	include "database.php";
	global $conn;

	$user_id = $_SESSION['id'];
	$query = mysqli_query($conn, "SELECT phone FROM users WHERE user_id = '$user_id'");
	$row = mysqli_fetch_assoc($query);


	echo $row['phone'];
}

?>