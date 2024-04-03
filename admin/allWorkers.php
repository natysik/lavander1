<?php
include "database.php";

global $conn;
$query = mysqli_query($conn, "SELECT * FROM workers");

while($row = mysqli_fetch_assoc($query)){

	echo '
		<div class = "worker">
			<img src = "'.$row["photo"].'" class = "roundImg">

			<div class = "textZagol1">'.$row["name"].'</div>
			<div class = "osnText4">'.$row["position"].'</div>
						
			<div class = "osnText5">'.$row["workDisc1"].'</div>
			<div class = "osnText5">'.$row["workDisc2"].'</div>
			<div class = "osnText5">'.$row["workDisc3"].'</div>
		</div>
		';
	}

?>