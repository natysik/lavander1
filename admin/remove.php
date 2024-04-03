<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
include "database.php";
global $conn;

$user = $_SESSION['id'];
$id = $_POST['id'];


$query = mysqli_query($conn, "DELETE FROM comments WHERE id = '$id' ") or die("Ошибка".mysqli_error($conn));


$query = mysqli_query($conn, "SELECT * FROM comments, users WHERE comments.user_id = users.user_id");


while($row = mysqli_fetch_assoc($query)){
	$postid = $row['id'];

	

	echo '
		<div class = "comment"> 
						<span class = "userName">Пользователь: '.$row["login"].' <span id = "'.$row["id"].'" class="remove" title = "Удалить">&times;</span> </span>
						<p class = "comText">'.$row["comment"].'</p>

						
					</div>
		';
	}

?>