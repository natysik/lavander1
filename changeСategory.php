<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
include "database.php";
global $conn;

$category = $_GET['category'];
$sort = $_GET['sort'];
$user = $_SESSION['id'];


if($sort == "priceAsc" || $sort == "undefined"){

	if($category == 8){
		
		$query = mysqli_query($conn, "SELECT * FROM bouquets ORDER BY price ASC");
		
	}
	else if($category == 1){
		include "ownBoquetCategory.php";
	}
	else{
		$query = mysqli_query($conn, "SELECT * FROM bouquets WHERE typeOfBouquet = '$category' ORDER BY price ASC");
	}
}





else if($sort == "priceDesc"){

	if($category == 8){
		$query = mysqli_query($conn, "SELECT * FROM bouquets  ORDER BY price DESC");
	}
	else{
		$query = mysqli_query($conn, "SELECT * FROM bouquets WHERE typeOfBouquet = '$category' ORDER BY price DESC");
	}
}


if($category != 1){
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

}







?>


<script type="text/javascript" src="functions.js"></script>
