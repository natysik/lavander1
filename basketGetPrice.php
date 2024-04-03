<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
include "database.php";
global $conn;

if(!isset($_SESSION['login'])){
	echo "0";
}
else{
	$user = $_SESSION['id'];

$query = mysqli_query($conn, "SELECT SUM(`price` * `numberOf`) AS price FROM `basket`, bouquets WHERE basket.bouquet_id = bouquets.bouquet_id AND user_id = $user");


$row = mysqli_fetch_assoc($query);
$count =  mysqli_num_rows($query);
if($row["price"] == 0) $price = 0;
else $price = $row["price"];


	echo "$price руб" ;
}





?>


