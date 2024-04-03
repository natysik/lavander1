<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
include "database.php";
global $conn;


$query = mysqli_query($conn, "SELECT * FROM flowers where type = 2");



while($row = mysqli_fetch_assoc($query)){

	$img = base64_encode($row['img']);

	echo '
	


 <div class = "checkbox_label">
 <input type="checkbox" id="checkbox-'.$row["flower_id"].'" name="checkbox-'.$row["flower_id"].'" value="'.$row["flower_id"].'" data-price = "'.$row["price"].'" class = "checkbox custom-checkbox">
    <label for="checkbox-'.$row["flower_id"].'">'.$row["flowerName"].' - '.$row["price"].' руб</label>
 </div> 
		';
	}




?>



