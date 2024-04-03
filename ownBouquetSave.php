<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
include "database.php";
global $conn;

//для записи координат в бд
$flowers_id = $_POST['flowers_id'];
$flowers_id = explode(',', $flowers_id);

for($i = 0; $i < count($flowers_id ); $i++){
	$temp = explode(':', $flowers_id[$i]);
	$flowers_id[$i] = $temp[1];
}

//для вывода в консоль
$flowers_list = array_count_values($flowers_id);
$flowers = array_keys($flowers_list);
$count = array_values($flowers_list);



$greens_id = $_POST['green'];
$greens_id = explode(',', $greens_id);




$flowers_coordinates = $_POST['flowers_coordinates'];
$flowers_coordinates = explode(',', $flowers_coordinates);

for($i = 0; $i < count($flowers_coordinates ); $i++){
	$temp = explode(':', $flowers_coordinates[$i]);
	$flowers_coordinates[$i] = $temp[1];
}

$pack = $_POST["pack"];
$queryPACK = mysqli_query($conn, "SELECT * FROM pack WHERE pack_id = '$pack'");
$rowPACK = mysqli_fetch_assoc($queryPACK);

if(empty($_SESSION['id'])){
	print "<script language='Javascript' type='text/javascript'>
			alert('Только зарегестрированный пользователь может создавать букеты!');
        </script>";
}
else{
	print "<script language='Javascript' type='text/javascript'>
			modalSave.style.display = 'block';
        </script>";

        for($i = 0; $i < count($flowers); $i++){
        	$id = $flowers[$i];
        	$query_flowersList = mysqli_query($conn, "SELECT flowerName FROM flowers WHERE flower_id = '$id'");
        	$row_flowersList = mysqli_fetch_assoc($query_flowersList);

        	// var_dump($flowers_coordinates);

        	echo ' 
        	<div class = "all-content">'.$row_flowersList["flowerName"].' - '.$count[$i].' шт</div>
        	';

			// var_dump($flowers_list);
        }

        if(count($greens_id) > 0){
                echo '<span class = "desc"> Список зелени: </span> ' ;

                for($i = 0; $i < count($greens_id); $i++){
                $id = $greens_id[$i];
                $query_greensList = mysqli_query($conn, "SELECT flowerName FROM flowers WHERE flower_id = '$id'");
                $row_greensList = mysqli_fetch_assoc($query_greensList);

               
                echo ' 
                <div class = "all-content">'.$row_greensList["flowerName"].' 
                 </div>';

        }
        
        }

         echo '<span class = "desc"> Упаковка: </span> ' ;
        echo ' 
                <div class = "all-content">'.$rowPACK["typeOfPack"].' 
                 </div>';

}




?>


