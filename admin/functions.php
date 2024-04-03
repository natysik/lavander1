<?php

include "database.php";

function menuItems(){

	global $conn;
	$query = mysqli_query($conn, "SELECT * FROM category WHERE id != '1'");

	while($row = mysqli_fetch_assoc($query)){
		$id = $row['id'];
		$name = $row['nameOfCategory'];


		echo "<li class = 'section designer-bouquets' id = '{$id}'> {$name} </li>";
	}
}



?>