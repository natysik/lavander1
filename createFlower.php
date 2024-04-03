<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();


include "database.php";
global $conn;

if(!isset($_SESSION['login'])){
	echo "Только зарегистрированный пользователь может создавать букеты!";
}
else{
	$coast = $_GET['coast'];
$user = $_SESSION['id'];

$query = mysqli_query($conn, "SELECT if(MAX(t1.bouquet_id) > MAX(t2.bouquet_id), MAX(t1.bouquet_id), MAX(t2.bouquet_id)) as numb FROM bouquets as t1, own_bouquets as t2");

$row = mysqli_fetch_assoc($query);

$id = $row["id"] + 1;

$img = addslashes(file_get_contents('img/whyWe.png'));

$query = mysqli_query($conn, "INSERT INTO `own_bouquets`(`bouquet_id`, `nameOfTheBouquet`, `typeOfBouquet`, `price`,  `photo`, `user_id`) VALUES ('$id','Авторский букет', '1','$coast','$img', '$user')")or die("Ошибка".mysqli_error($conn));

echo "Букет добавлен в раздел Авторские!";
}




?>