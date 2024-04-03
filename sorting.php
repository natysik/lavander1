<?php
include "database.php";


$sortProperty = $_GET['id'];

global $conn;

$query = mysqli_query($conn, "SELECT * FROM bouquets ORDER BY price");


while($row = mysqli_fetch_assoc($query)){

	echo '
		<div class = "box">
				  			<p class = "nameOf">'.$row["nameOfTheBouquet"].'</p>
				  			<div class = "slide-img">
				  				<img src = "'.$row["photo"].'" >
				  			</div>

				  			<div class = "detail-box">
				  				<div class = "detal-box">
				  					<div class = "type">
				  						<button class = "bye" id = "addCategory">'.$row["price"].'</button>
				  					</div>
				  				</div>
				  			</div>
				  		</div>
		';
	}

?>