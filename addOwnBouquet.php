<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();


include "database.php";
global $conn;


$img = $_POST['img'];

//$query = mysqli_query($conn, "SELECT bouquet_id as id FROM bouquets WHERE bouquet_id=(SELECT max(bouquet_id) FROM bouquets)");

//$row = mysqli_fetch_assoc($query);

//$id = $row["id"] + 1;

$query = mysqli_query($conn, "INSERT INTO `bouquets`( `bouquet_id`, `nameOfTheBouquet`, `typeOfBouquet`, `price`, `pack_id`, `photo`) VALUES ('32', 'Авторский','1','25','1','$img')");



//echo $img;



?>