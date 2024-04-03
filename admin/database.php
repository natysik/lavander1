<?php

$conn = mysqli_connect("localhost", "root", "root", "lavender");
if(!$conn){
	die("Ошибка подключения к БД" . mysqli_error($conn));
}


?>