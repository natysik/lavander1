<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
include "database.php";
global $conn;


$id = $_GET['id'];


if(!isset($_SESSION['login'])){
	$src = "img/icon/like.png";
	$text = "Для добавления в избранное необходимо войти.";
}
else{
	$user = $_SESSION['id'];
	$query_isInFavorites = mysqli_query($conn, "SELECT COUNT(*) AS res FROM favorites WHERE user_id = '$user' AND bouquet_id = '$id'");

	if(mysqli_fetch_assoc($query_isInFavorites)["res"] == 0){
		$src = "img/icon/like.png";
		$text = "Добавить в избранное.";
	}
	else{
		$src = "img/icon/dislike.png";
		$text = "У Вас в избранном.";
	}
}

$query = mysqli_query($conn, "SELECT * FROM bouquets WHERE bouquet_id = '$id'");



$query_content = mysqli_query($conn, "SELECT * FROM content INNER JOIN flowers ON content.flower_id = flowers.flower_id WHERE content.bouquet_id = '$id'");



$query_favorites = mysqli_query($conn, "SELECT COUNT(*) as res FROM favorites WHERE bouquet_id = '$id'");








while($row = mysqli_fetch_assoc($query)){

	$count = mysqli_fetch_assoc($query_favorites)["res"];
	$bonus = $row["price"] / 10;
	$img = base64_encode($row['photo']);
	
	echo '
	<form id = "edit-form-boue" class = "addBou" method = "post" enctype="multipart/form-data" onsubmit="return sendModal('.$row["bouquet_id"].');">

		<img class = "bou-img" src = "data:image/jpeg;base64, '.$img.'" >
		<input id="file-input-edit" class = "input-img" onchange="changeImg()" type="file" name="img_edit" multiple>

		<div class = "information-name" style = "padding-top: 10px">Название букета: </div> 
		<input type = "text" id = "name-edit" name = "name"  class = "text-input" autocomplete="off" value = "'.$row["nameOfTheBouquet"].'">
		<div id = "error-name"></div>

		<div class = "information-name" style = "padding-top: 10px">Цена: </div> 
		<input type = "number" id = "price" name = "price"  class = "text-input" autocomplete="off" value = "'.$row["price"].'">
		<div id = "error-price"></div>

		
		<button type = "submit" class = "submitModal" data-id = "'.$row["bouquet_id"].'" >Сохранить
		</button>
					
	
	</form>
		';
	}


?>

<script type="text/javascript" src="functions.js"></script>