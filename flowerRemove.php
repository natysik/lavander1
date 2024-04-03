<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();

include "database.php";
global $conn;

$bouquet_id = $_GET['id'];

$query = mysqli_query($conn, "DELETE FROM `basket` WHERE `bouquet_id` = '$bouquet_id' ");

$query = mysqli_query($conn, "DELETE FROM `bouquets` WHERE `bouquet_id` = '$bouquet_id' ");


?>