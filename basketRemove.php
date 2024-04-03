<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();

include "database.php";
global $conn;

$basket_id = $_GET['id'];
$user = $_SESSION['id'];

$query = mysqli_query($conn, "DELETE FROM `basket` WHERE `basket_id` = '$basket_id' AND `user_id` = '$user'");

echo $basket_id;
?>