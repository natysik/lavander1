<?php
include "database.php";
global $conn;




$query = mysqli_query($conn, "SELECT * FROM bouquets");





while($row = mysqli_fetch_assoc($query)){

	echo '
		<div class = "box">
		<span class="delete" id = "'.$row["bouquet_id"].'" title = "Удалить букет">&times;</span>
				  			<p class = "nameOf">'.$row["nameOfTheBouquet"].'</p>
				  			<div class = "slide-img">
				  				<img src = "'.$row["photo"].'" >
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
