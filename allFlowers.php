<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
include "database.php";
global $conn;

$query = mysqli_query($conn, "SELECT * FROM bouquets WHERE typeOfBouquet != 1");


if(isset($_SESSION['login'])){
	$id = $_SESSION['id'];
	mysqli_query($conn, "SELECT * FROM bouquets left join bouquets_own on bouquets.bouquet_id = bouquets_own.bouquet_id where bouquets_own.user_id = $id");
}
else{
	$query = mysqli_query($conn, "SELECT * FROM bouquets WHERE typeOfBouquet != 1");
}

// if(!isset($_SESSION['id']){
// 	$query = mysqli_query($conn, "SELECT * FROM bouquets WHERE typeOfBouquet != 1");
// }
// else{
// 	$id = $_SESSION['id'];
// 	$query = mysqli_query($conn, "SELECT * FROM bouquets left join bouquets_own on bouquets.bouquet_id = bouquets_own.bouquet_id where bouquets_own.user_id = $id");
// }







while($row = mysqli_fetch_assoc($query)){

	$img = base64_encode($row['photo']);

	echo '
		<div class = "box" data-id = "'.$row["bouquet_id"].'">
			<p class = "nameOf">'.$row["nameOfTheBouquet"].'</p>

				<div class = "slide-img">
				  	<img src = "data:image/jpeg;base64,'.$img.'" >
				 </div>

				<div class = "detail-box">
				  	<div class = "detal-box">
				  		<div class = "type">
				  			<button class = "bye" id = "addCategory" data-id = "'.$row["bouquet_id"].'" data-price = "'.$row["price"].'">'.$row["price"].' руб</button>
				  		</div>
				  	</div>
				</div>
		</div>
		';
	}

?>
