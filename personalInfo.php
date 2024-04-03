<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();


function information(){
	include "database.php";
	global $conn;

	$user = $_SESSION['id'];


	$query = mysqli_query($conn, "SELECT * FROM `users` WHERE user_id = $user");

	while($row = mysqli_fetch_assoc($query)){


	echo '

		<div class = "information-name">Имя пользователя: </div> 
		<input type = "text" id = "name" name = "name"  class = "text-input" autocomplete="off" value = "'.$row["name"].'">
		<div id = "error-name"></div>

		<div class = "information-name" style = "padding-top: 10px">Логин: <span class = "necessarily">*</span></div> 
		<input type = "text" id = "login-name" name = "login-name"  class = "text-input" autocomplete="off" value = "'.$row["login"].'">
		<div id = "error-login"></div>

		<div class = "information-name" style = "padding-top: 10px">Телефон: <span class = "necessarily">*</span></div> 
		<input type = "text" id = "phone" name = "phone"  class = "text-input" autocomplete="off" value = "'.$row["phone"].'">
		<div id = "error-phone"></div>

	

		<div class = "information-name adress" >Адресс: </div> 
		<input type = "text" id = "adress" name = "adress"  class = "text-input adress" autocomplete="off" value = "'.$row["adress"].'">
		<div id = "error-adress"></div>
		';
	}

}


function password(){
	include "database.php";
	global $conn;

	$user = $_SESSION['id'];


	$query = mysqli_query($conn, "SELECT * FROM `users` WHERE user_id = $user");

	while($row = mysqli_fetch_assoc($query)){


	echo '

		<div class = "information-name">Введите новый пароль: <span class = "necessarily">*</span></div> 
			<div class="password">
				<input type = "password" id = "password"  name = "password"  class = "text-input" autocomplete="off" >
				<a href="#" class="control"></a>
			</div>
		<div id = "error-new-password"></div>
		


		<div class = "information-name">Повторите пароль: <span class = "necessarily">*</span></div> 
			<div class="password">
				<input type = "password" id = "password-rep"  name = "password-rep"  class = "text-input" >
				<a href="#" class="control-rep"></a>
			</div>
		<div id = "error-rep-password"></div>



		
		';
	}

}



?>