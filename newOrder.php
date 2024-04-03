<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();


include "database.php";
global $conn;

$bouquet_id = $_POST["bouquet_id"];
$numberOf = $_POST["numberOf"];
$oplValue = $_POST["oplValue"];
$dostvalue = $_POST["dostvalue"];
$adressValue = $_POST["adressValue"];
$cost = $_POST["cost"];
$date = date("j.n.Y");
$user = $_SESSION['id'];
$phone = $_POST["phone"];


$query_getOrderNumber = mysqli_query($conn, "SELECT if(MAX(t1.order_number) > MAX(t2.order_number), MAX(t1.order_number), MAX(t2.order_number)) as numb FROM orders as t1, orders_nologin as t2");
$row_getOrderNumber = mysqli_fetch_assoc($query_getOrderNumber);
$order_number = $row_getOrderNumber["numb"] + 1;



if(empty($_SESSION["id"])){

	

	$query = mysqli_query($conn, "INSERT INTO orders_nologin( order_number,  dost, adress, phone, opl,  `date`, `cost`,  `status` ) VALUES ('$order_number',  '$dostvalue','$adressValue','$phone', '$oplValue', '$date', '$cost',  1 )") ;


	$query_getOrderContentNumber = mysqli_query($conn, "SELECT MAX(id) as numb FROM `order_content`");
	$row_getOrderContentNumber = mysqli_fetch_assoc($query_getOrderContentNumber);
	$orderContent_number = $row_getOrderContentNumber["numb"] + 1;


	$query = mysqli_query($conn, "INSERT INTO `order_content` (`id`, `id_bouquet`, `amount`, `order_number`) VALUES ('$orderContent_number', '$bouquet_id', '$numberOf', '$order_number');");


	print "<script language='Javascript' type='text/javascript'>
			alert('Заказ оформлен!');
			location.reload();
        </script>";

}

else{

	$query = mysqli_query($conn, "INSERT INTO `orders`( `order_number`, `user_id`, `dost`, `adress`, `opl`,  `date`, `cost`,  `status` ) VALUES ('$order_number', '$user', '$dostvalue','$adressValue','$oplValue', '$date', '$cost',  1 )") ;

	$query_getInformationForDescription = mysqli_query($conn, "SELECT `bouquet_id`, `numberOf` FROM `basket` WHERE `user_id` = $user");

while ($row_getInformationForDescription = mysqli_fetch_assoc($query_getInformationForDescription)) {
	$bouquet_id = $row_getInformationForDescription["bouquet_id"];
	$numberOf = $row_getInformationForDescription["numberOf"];



	$query_getOrderContentNumber = mysqli_query($conn, "SELECT MAX(id) as numb FROM `order_content`");
	$row_getOrderContentNumber = mysqli_fetch_assoc($query_getOrderContentNumber);
	$orderContent_number = $row_getOrderContentNumber["numb"] + 1;



	$query = mysqli_query($conn, "INSERT INTO `order_content` (`id`, `id_bouquet`, `amount`, `order_number`) VALUES ('$orderContent_number', '$bouquet_id', '$numberOf', '$order_number');");
}


print "<script language='Javascript' type='text/javascript'>
			alert('Заказ оформлен!');
			location.reload();
        </script>";

}




?>