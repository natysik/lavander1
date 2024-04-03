<?php
include "database.php";
global $conn;

$user = $_SESSION['id'];


$query = mysqli_query($conn, "SELECT * FROM favorites LEFT JOIN bouquets ON favorites.bouquet_id = bouquets.bouquet_id WHERE user_id = '$user'");





while($row = mysqli_fetch_assoc($query)){

	$img = base64_encode($row['photo']);

	echo '
		<div class = "box" data-id = "'.$row["bouquet_id"].'">
			<p class = "nameOf">'.$row["nameOfTheBouquet"].' <span id = "'.$row["bouquet_id"].'" class="remove" title = "Отмена">&times;</span></p>

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