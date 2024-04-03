<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();


include "database.php";
global $conn;


if($_POST['name'] == ""){
	echo "Укажите название.";
}
else if($_POST['type'] == ""){
	echo "Укажите тип букета.";
}
else if($_POST['price'] == ""){
	echo "Укажите цену.";
}
else if($_SESSION['img'] == ''){
	echo "Загрузите изображение";
}
else{

	$name = $_POST['name'];
	$type = $_POST['type'];
	$price = $_POST['price'];
	$img = addslashes(file_get_contents($_SESSION['img']));



	$query = mysqli_query($conn, "SELECT bouquet_id as id FROM bouquets WHERE bouquet_id=(SELECT max(bouquet_id) FROM bouquets)");

	$row = mysqli_fetch_assoc($query);
	$id = $row["id"] + 1;

	$query = mysqli_query($conn, "INSERT INTO `bouquets`( `bouquet_id`, `nameOfTheBouquet`, `typeOfBouquet`, `price`, `pack_id`, `photo`) VALUES ('$id', '$name','$type','$price','1','$img')"); 


print "<script language='Javascript' type='text/javascript'>
			function reload(){
                top.location = 'ourBouquets.php'};
                setTimeout('reload()', 0);
                alert('Букет добавлен!');
        </script>";

        echo "";
}




?>