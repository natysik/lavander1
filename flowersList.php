<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
include "database.php";
global $conn;


$query = mysqli_query($conn, "SELECT * FROM flowers where type = 1");



while($row = mysqli_fetch_assoc($query)){

	$img = base64_encode($row['img']);

	echo '

	<div class = "flower-card">
		<img src = "data:image/jpeg;base64,'.$img.'" class = "flower-img">
		<div class = "name-of-flower"> '.$row["flowerName"].' </div>
		<div class = "price-of-flower" > '.$row["price"].' руб</div>

		<div class="amount">
    		<span class="down" data-id = "'.$row["flower_id"].'" data-img = "data:image/jpeg;base64,'.$img.'" data-price = "'.$row["price"].'">-</span>
    		<input class = "inputModal" data-id = "'.$row["flower_id"].'" id = "inputModal_'.$row["flower_id"].'" type="text" value="0" data-price = "'.$row["price"].'" readonly="readonly"/>
   	 		<span class="up" data-id = "'.$row["flower_id"].'" data-img = "data:image/jpeg;base64,'.$img.'" data-price = "'.$row["price"].'">+</span> 
		</div>
	</div>



		';
	}




?>


