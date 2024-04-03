<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();

include "database.php";
global $conn;

$basket_id = $_GET['id'];
$number_of = $_GET['numberOf'];
$user = $_SESSION['id'];

$query = mysqli_query($conn, "UPDATE `basket` SET `numberOf`='$number_of' WHERE `basket_id` = '$basket_id'");


?>