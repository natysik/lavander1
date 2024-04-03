<?php
include "database.php";
global $conn;
if(session_status()!=PHP_SESSION_ACTIVE) session_start();

if(!isset($_SESSION['login'])){
	echo "Только зарегистрированный пользователь может добавлять товары в корзину!";
}
else{
	$bouquet = $_GET['bouquet'];
	$numberOf = $_GET['numerOf'];
	$user = $_SESSION['id'];

	$queryForBouquet = mysqli_query($conn, "SELECT * FROM basket WHERE bouquet_id = '$bouquet' AND user_id = '$user'");
	$resForBouquet = mysqli_fetch_assoc($queryForBouquet);

	if(empty($resForBouquet["bouquet_id"])){
		$query = mysqli_query($conn, "INSERT INTO basket (user_id, bouquet_id, numberOf) VALUES ($user, $bouquet, $numberOf);") or die("Ошибка".mysqli_error($conn));
		echo "Товар добавлен в корзину";
	}
	else{
		echo "Данный букет уже есть в вашей корзине!";
	}



}





?>
