<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();


include "database.php";
global $conn;

$user = $_SESSION['id'];
$query = mysqli_query($conn, "SELECT * FROM `users` WHERE user_id = $user");
$row = mysqli_fetch_assoc($query);



$count = 0;


if($_POST['password'] == ""){
	print "<script language='Javascript' type='text/javascript'>
			$('#error-new-password').html('Это поле не может быть пустым.');
        </script>";
        $count++;
}



if($_POST['password-rep'] == ""){
	print "<script language='Javascript' type='text/javascript'>
			$('#error-rep-password').html('Это поле не может быть пустым.');
        </script>";
        $count++;
}


if($_POST['password'] != $_POST['password-rep']){

	print "<script language='Javascript' type='text/javascript'>
			$('#error-rep-password').html('Введённые пароли не совпадают.');
        </script>";
    $count++;
	
}
else{
	print "<script language='Javascript' type='text/javascript'>
			$('#error-rep-password').html('');
        </script>";
}


if($_POST['password'] != "" ){
	if($row["password"] == $_POST['password']){
		print "<script language='Javascript' type='text/javascript'>
			$('#error-new-password').html('Вы используете текущий пароль.');
        </script>";
        $count++;
	}
	else if ($_POST['password'] == $_POST['password-rep']){
		$password = $_POST['password'];
		$query = mysqli_query($conn, "UPDATE users SET password = '$password' WHERE users.user_id = '$user'"); 

		print "<script language='Javascript' type='text/javascript'>
			alert('Пароль изменён!');
        </script>";
	}
		

}









?>