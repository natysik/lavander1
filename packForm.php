<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
include "database.php";
global $conn;


$query = mysqli_query($conn, "SELECT * FROM pack ");



while($row = mysqli_fetch_assoc($query)){

	$img = base64_encode($row['photo']);

	echo '
	


 <div class = "checkbox_label_pack">
 <input type="checkbox" id="checkboxPACK-'.$row["pack_id"].'" name="checkboxPACK" value="'.$row["pack_id"].'" data-price = "'.$row["price"].'" class = "checkboxPACK custom-checkbox">
    <label for="checkboxPACK-'.$row["pack_id"].'">'.$row["typeOfPack"].' - '.$row["price"].' руб</label>
 </div> 
		';
	}




?>

