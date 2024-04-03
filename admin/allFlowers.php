<?php
include "database.php";

global $conn;
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
				  			<button class = "bye" id = "edit-bou" data-id = "'.$row["bouquet_id"].'" data-price = "'.$row["price"].'">'.$row["price"].' руб</button>
				  		</div>
				  	</div>
				</div>
		</div>
		';
	}

?>