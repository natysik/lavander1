<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();


include "database.php";
global $conn;


$name = $_POST['name'];
$loginReg = $_POST['loginReg'];
$phone = $_POST['phoneReg'];
$passwordNew = $_POST['passwordNew'];
$passwordNewRep = $_POST['passwordNewRep'];


$queryForLogin = mysqli_query($conn, "SELECT * FROM users WHERE login = '$loginReg'");
$resForLogin = mysqli_fetch_assoc($queryForLogin);

$count = 0;

$regPhone = "/^(\+?375)-?\(?(33|29|44)\)?-?(\d{3})[\s|-]?(\d{2})[\s|-]?(\d{2})$/";


if($_POST['loginReg'] == ""){
	print "<script language='Javascript' type='text/javascript'>
			$('#error-login').html('Это поле обязательное для заполнения.');
        </script>";
        $count++;
}

if($_POST['loginReg'] != "" ){
	if(!empty($resForLogin["login"])){
		print "<script language='Javascript' type='text/javascript'>
			$('#error-login').html('Данный логин занят.');
        </script>";
        $count++;
	}
	else
		print "<script language='Javascript' type='text/javascript'>
			$('#error-login').html('');
        </script>";

}

if($_POST['phoneReg'] == ""){
	print "<script language='Javascript' type='text/javascript'>
			$('#error-phone').html('Это поле обязательное для заполнения.');
        </script>";
        $count++;
}

if($_POST['phoneReg'] != ""){
	if(!preg_match($regPhone, $_POST['phoneReg'])){
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

if($_POST['passwordNew'] == ""){
	print "<script language='Javascript' type='text/javascript'>
			$('#error-password').html('Это поле не может быть пустым.');
        </script>";
        $count++;
}




if($_POST['passwordNew'] != $_POST['passwordNewRep']){

	print "<script language='Javascript' type='text/javascript'>
			$('#error-rep-password').html('Введённые пароли не совпадают.');
			$('#error-password').html('');
        </script>";
    
	$count++;
}
else{
	print "<script language='Javascript' type='text/javascript'>
			$('#error-rep-password').html('');
        </script>";
}

if($count == 0){


	$query = mysqli_query($conn, "SELECT user_id as id FROM users WHERE user_id=(SELECT max(user_id) FROM users)");

	$row = mysqli_fetch_assoc($query);

	$id = $row["id"] + 1;

	$query = mysqli_query($conn, "INSERT INTO `users`(`user_id`, `login`, `password`, `name`, `phone`, `role` ) VALUES ('$id','$loginReg','$passwordNew', '$name', '$phone', 1)");


	$_SESSION['login'] = $loginReg;
	$_SESSION['id'] = $id;
	$_SESSION['role'] = 1;


	print "<script language='Javascript' type='text/javascript'>
				
                alert('Регистрация прошла успешно!');
                location.reload();
        </script>";



}













?>