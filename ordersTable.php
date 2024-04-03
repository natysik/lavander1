<?php

if(session_status()!=PHP_SESSION_ACTIVE) session_start();
include "database.php";
global $conn;

if(!isset($_SESSION['login'])){
	echo "Только зарегистрированный пользователь может просматривать заказы!";
}

else{
	$user = $_SESSION['id'];

$query = mysqli_query($conn, "SELECT * FROM orders WHERE user_id = $user");

echo '<table border="1" width="100%" cellpadding="5" class = "tt">
			<tr>
				<th>Дата заказа</th>
				<th>Тип доставки</th>
				<th>Адресс</th>
				<th>Оплата</th>
				
   			</tr>';
while($row = mysqli_fetch_assoc($query)){

	echo '
   			<tr>
    			<td>'.$row["date"].'</td>
    			<td>'.$row["dost"].'</td>
    			<td>'.$row["adress"].'</td>
    			<td>'.$row["opl"].'</td>
  			</tr>
 		';
	}
echo '</table>';
}


?>