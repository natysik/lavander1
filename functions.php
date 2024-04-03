<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();

include "database.php";




function menuItems(){

	if(!isset($_SESSION['login'])){
		global $conn;
		$query = mysqli_query($conn, "SELECT * FROM category WHERE id != '1' AND id != '9'");
		while($row = mysqli_fetch_assoc($query)){
			$id = $row['id'];
			$name = $row['nameOfCategory'];

			echo "<li class = 'section designer-bouquets' id = '{$id}'> {$name} </li>";
	}

		
	}

	else if($_SESSION['login'] != 3){
		global $conn;
		$query = mysqli_query($conn, "SELECT * FROM category WHERE id != '9'");

		while($row = mysqli_fetch_assoc($query)){
			$id = $row['id'];
			$name = $row['nameOfCategory'];

			echo "<li class = 'section designer-bouquets' id = '{$id}'> {$name} </li>";
		}
	}

	else{
		global $conn;
		$query = mysqli_query($conn, "SELECT * FROM category ");

		while($row = mysqli_fetch_assoc($query)){
			$id = $row['id'];
			$name = $row['nameOfCategory'];

			echo "<li class = 'section designer-bouquets' id = '{$id}'> {$name} </li>";
		}
	}
}




?>