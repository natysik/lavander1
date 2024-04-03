<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
include "database.php";
global $conn;




if(!empty($_GET['name'])){
	$name = $_GET['name'];

	$query = "SELECT * FROM `bouquets` WHERE nameOfTheBouquet LIKE '%$name%'";
	$result = mysqli_query($conn, $query);


	while($row = mysqli_fetch_assoc($result)){

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

else {
	$query = mysqli_query($conn, "SELECT * FROM bouquets");

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

