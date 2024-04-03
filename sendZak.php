<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();


include "database.php";
global $conn;


$query_getOrderNumber = mysqli_query($conn, "SELECT MAX(order_number) as numb FROM `orders`");
$row_getOrderNumber = mysqli_fetch_assoc($query_getOrderNumber);
$order_number = $row_getOrderNumber["numb"] + 1;



$dostvalue = mysqli_real_escape_string($conn, $_POST["dostvalue"]);
$adressValue = mysqli_real_escape_string($conn, $_POST["adressValue"]);
$oplValue = mysqli_real_escape_string($conn, $_POST["oplValue"]);
$date = date("j.n.Y");
$time = date("H:i:s");
$user = $_SESSION['id'];
$endPrice = $_POST['endPrice'];

$query = mysqli_query($conn, "INSERT INTO `orders`( `order_number`, `user_id`, `dost`, `adress`, `opl`,  `date`, `cost`,  `status` ) VALUES ('$order_number', '$user', '$dostvalue','$adressValue','$oplValue', '$date', '$endPrice',  1 )") ;


$query_getInformationForDescription = mysqli_query($conn, "SELECT `bouquet_id`, `numberOf` FROM `basket` WHERE `user_id` = $user");

while ($row_getInformationForDescription = mysqli_fetch_assoc($query_getInformationForDescription)) {
	$bouquet_id = $row_getInformationForDescription["bouquet_id"];
	$numberOf = $row_getInformationForDescription["numberOf"];



	$query_getOrderContentNumber = mysqli_query($conn, "SELECT MAX(id) as numb FROM `order_content`");
	$row_getOrderContentNumber = mysqli_fetch_assoc($query_getOrderContentNumber);
	$orderContent_number = $row_getOrderContentNumber["numb"] + 1;



	$query = mysqli_query($conn, "INSERT INTO `order_content` (`id`, `id_bouquet`, `amount`, `order_number`) VALUES ('$orderContent_number', '$bouquet_id', '$numberOf', '$order_number');");
}


$query = mysqli_query($conn, "DELETE FROM `basket` WHERE  `user_id` = '$user'");


?>