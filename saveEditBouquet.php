<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
include "database.php";
global $conn;

$user = $_SESSION['id'];
$price = $_POST['coast'];
$img = addslashes(file_get_contents('img/whyWe.png'));
$name = $_POST['name'];
$bouquet_id = $_SESSION["editId"];
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

$green_id = explode(',', $green); 

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

$query = mysqli_query($conn, "DELETE FROM bouquet_content WHERE bouquet_id = $bouquet_id")  ;

$query = mysqli_query($conn, "DELETE FROM bouquets_own WHERE bouquet_id = $bouquet_id") ;

$query = mysqli_query($conn, "DELETE FROM order_content WHERE bouquet_id = $bouquet_id") ;

$query = mysqli_query($conn, "DELETE FROM basket WHERE bouquet_id = $bouquet_id") ;

$query = mysqli_query($conn, "DELETE FROM bouquets WHERE bouquet_id = $bouquet_id") ;




$query = mysqli_query($conn, "INSERT INTO `bouquets` (`bouquet_id`, `nameOfTheBouquet`, `typeOfBouquet`, `price`, `photo`, `pack_id`) VALUES ('$bouquet_id', '$name', '1', '$price', '$img', '$pack' )") or die("Ошибка1".mysqli_error($conn));


$query = mysqli_query($conn, "INSERT INTO `bouquets_own` (`bouquet_id`, `user_id`) VALUES ('$bouquet_id', '$user')") or die("Ошибка2".mysqli_error($conn));



for($i = 0; $i < count($flowers_id); $i++){


	$query_flowersList = mysqli_query($conn, "INSERT INTO `bouquet_content` ( `flower_id`, `bouquet_id`, `position_left`, `position_top`) VALUES ('$flowers_id[$i]', '$bouquet_id', '$left[$i]', '$top[$i]')") or die("Ошибка3".mysqli_error($conn));


		

}


for($i = 0; $i < count($green_id); $i++){

	echo $green_id[$i];

	$query_flowersList = mysqli_query($conn, "INSERT INTO `bouquet_content` ( `flower_id`, `bouquet_id`, `position_left`, `position_top`) VALUES ('$green_id[$i]', '$bouquet_id', NULL, NULL)") or die("Ошибка".mysqli_error($conn));	

}


unset($_SESSION["editId"]);


?>