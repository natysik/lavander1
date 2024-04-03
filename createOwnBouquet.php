<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
include "database.php";
global $conn;

$user = $_SESSION['id'];
$price = $_POST['price'];
$img = addslashes(file_get_contents('img/whyWe.png'));
$name = $_POST['name'];
$green = $_POST['green'];
$pack = $_POST['pack'];

$flowers_id = $_POST['flowers_id'];
$flowers_id = explode(',', $flowers_id);

for($i = 0; $i < count($flowers_id ); $i++){
	$temp = explode(':', $flowers_id[$i]);
	$flowers_id[$i] = $temp[1];
}

$flowers_coordinates = $_POST['flowers_coordinates'];
$flowers_coordinates = explode(',', $flowers_coordinates);

for($i = 0; $i < count($flowers_coordinates ); $i++){
	$temp = explode(':', $flowers_coordinates[$i]);
	$flowers_coordinates[$i] = $temp[1];
}

$top = array();
$left = array();
for($i = 0; $i < count($flowers_coordinates ); $i++){
	$temp = explode(';', $flowers_coordinates[$i]);
	array_push($top, (float)$temp[1]);
	array_push($left, (float)$temp[0]);
}


$green_id = explode(',', $green); 


$query_getBouquetId = mysqli_query($conn, "SELECT MAX(bouquet_id) as numb FROM bouquets");
$row_getBouquetId = mysqli_fetch_assoc($query_getBouquetId);
$id_bouquet = $row_getBouquetId["numb"] + 1;



$query = mysqli_query($conn, "INSERT INTO `bouquets` (`bouquet_id`, `nameOfTheBouquet`, `typeOfBouquet`, `price`, `photo`, `pack_id`) VALUES ('$id_bouquet', '$name', '1', '$price', '$img', '$pack' )") or die("Ошибка".mysqli_error($conn)) ;


$query = mysqli_query($conn, "INSERT INTO `bouquets_own` (`bouquet_id`, `user_id`) VALUES ('$id_bouquet', '$user')") ;



for($i = 0; $i < count($flowers_id); $i++){


	$query_flowersList = mysqli_query($conn, "INSERT INTO `bouquet_content` ( `flower_id`, `bouquet_id`, `position_left`, `position_top`) VALUES ('$flowers_id[$i]', '$id_bouquet', '$left[$i]', '$top[$i]')") or die("Ошибка".mysqli_error($conn));	

}




for($i = 0; $i < count($green_id); $i++){

	echo $green_id[$i];


	$query_flowersList = mysqli_query($conn, "INSERT INTO `bouquet_content` ( `flower_id`, `bouquet_id`, `position_left`, `position_top`) VALUES ('$green_id[$i]', '$id_bouquet', NULL, NULL)") or die("Ошибка".mysqli_error($conn));	

}




?>