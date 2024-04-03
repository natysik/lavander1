<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();


include "database.php";
global $conn;

$user = $_SESSION['id'];
$query = mysqli_query($conn, "SELECT * FROM `users` WHERE user_id = $user");
$row = mysqli_fetch_assoc($query);


$login = $_POST['login-name'];
$queryForLogin = mysqli_query($conn, "SELECT * FROM users WHERE login = '$login'");
$resForLogin = mysqli_fetch_assoc($queryForLogin);


$regPhone = "/^(\+?375)-?\(?(33|29|44)\)?-?(\d{3})[\s|-]?(\d{2})[\s|-]?(\d{2})$/";
$count = 0;


if($_POST['login-name'] == ""){
	print "<script language='Javascript' type='text/javascript'>
			$('#error-login').html('Это поле обязательное для заполнения.');
        </script>";
        $count++;
}

if($_POST['login-name'] != "" AND $_POST['login-name'] != $row["login"]){
	if(!empty($resForLogin["login"])){
		print "<script language='Javascript' type='text/javascript'>
			$('#error-login').html('Данный логин занят.');
        </script>";
        $count++;
	}
	else
		print "<script language='Javascript' type='text/javascript'>
			$('#error-login').html(' ');
        </script>";

}

if($_POST['phone'] == ""){
	print "<script language='Javascript' type='text/javascript'>
			$('#error-phone').html('Это поле обязательное для заполнения.');
        </script>";
        $count++;
}


if($_POST['phone'] != ""){
	if(!preg_match($regPhone, $_POST['phone'])){
		print "<script language='Javascript' type='text/javascript'>
			$('#error-phone').html('Номер должен быть в формате 375xxxxxxxxx');
        </script>";
        $count++;
	}
	else{
		print "<script language='Javascript' type='text/javascript'>
			$('#error-phone').html(' ');
        </script>";
	}
}



if($count == 0){

	$name = $_POST['name'];
	$login = $_POST['login-name'];
	$phone = $_POST['phone'];
	$adress = $_POST['adress'];



	


	$query = mysqli_query($conn, "UPDATE users SET login = '$login', name = '$name', phone = '$phone', adress = '$adress' WHERE users.user_id = '$user'") or die("Ошибка".mysqli_error($conn)); 


	print "<script language='Javascript' type='text/javascript'>
				$('#error-phone').html('');
				$('#error-name').html('');
				$('#error-login').html('');
                alert('Изменения сохранены!');
        </script>";

}









?>