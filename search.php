<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
include "database.php";
global $conn;




if(!empty($_GET['name'])){
	$name = $_GET['name'];

	if(isset($_SESSION['login']))
		$query = "SELECT * FROM `bouquets` WHERE nameOfTheBouquet LIKE '%$name%'";
	else
		$query = "SELECT * FROM `bouquets` WHERE nameOfTheBouquet LIKE '%$name%' AND typeOfBouquet !=1";
	
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

else {echo "Нет таких букетов";}

?>

<script type="text/javascript" src="functions.js"></script>