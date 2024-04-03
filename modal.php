<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
include "database.php";
global $conn;


$id = $_GET['id'];


if(!isset($_SESSION['login'])){
	$src = "img/icon/like.png";
	$text = "Для добавления в избранное необходимо войти.";
}
else{
	$user = $_SESSION['id'];
	$query_isInFavorites = mysqli_query($conn, "SELECT COUNT(*) AS res FROM favorites WHERE user_id = '$user' AND bouquet_id = '$id'");

	if(mysqli_fetch_assoc($query_isInFavorites)["res"] == 0){
		$src = "img/icon/like.png";
		$text = "Добавить в избранное.";
	}
	else{
		$src = "img/icon/dislike.png";
		$text = "У Вас в избранном.";
	}
}

$query = mysqli_query($conn, "SELECT * FROM bouquets WHERE bouquets.bouquet_id = '$id' "); 


$query_content = mysqli_query($conn, "SELECT flowers.flower_id FROM bouquet_content INNER JOIN flowers ON bouquet_content.flower_id = flowers.flower_id WHERE flowers.type = 1 and bouquet_content.bouquet_id = '$id'");
$flowers_id = array();
while($row_content = mysqli_fetch_assoc($query_content)){
	array_push($flowers_id, $row_content['flower_id']);
}

$flowers_list = array_count_values($flowers_id);
$flowers = array_keys($flowers_list);
$countfl = array_values($flowers_list);


$query_green = mysqli_query($conn, "SELECT flowers.flower_id FROM bouquet_content INNER JOIN flowers ON bouquet_content.flower_id = flowers.flower_id WHERE flowers.type = 2 and bouquet_content.bouquet_id = '$id'");
$greens_id = array();

while($row_green = mysqli_fetch_assoc($query_green)){
	array_push($greens_id, $row_green['flower_id']);
}


$queryPACK = mysqli_query($conn, "SELECT pack.typeOfPack FROM pack left join bouquets on pack.pack_id = bouquets.pack_id WHERE bouquets.bouquet_id = $id");
$rowPACK = mysqli_fetch_assoc($queryPACK);


$query_favorites = mysqli_query($conn, "SELECT COUNT(*) as res FROM favorites WHERE bouquet_id = '$id'");



$queryCheck = mysqli_query($conn, "SELECT COUNT(*) as res FROM bouquets_own WHERE bouquet_id = '$id'");
$check = mysqli_fetch_assoc($queryCheck)["res"];



while($row = mysqli_fetch_assoc($query)){

	$count = mysqli_fetch_assoc($query_favorites)["res"];

	$img = base64_encode($row['photo']);
	
	echo '
	<form class = "addBou">
		<div>

			<div class = "mdBody">
				<div class = "nameOfB" id = "'.$row["bouquet_id"].'">'.$row["nameOfTheBouquet"].'
			</div>

			<div class = "modalImg">
				<img src = "data:image/jpeg;base64,'.$img.'" >
			</div>

			<div class = "description">
				<img class = "icons" src = "img/icon/price.png">
				<div class = "coast" id = "'.$row["price"].'">Цена букета '.$row["price"].'  рублей.
				</div>
			</div>

			

			<div class = "description">
				<img class = "icons" src = "img/icon/favorites.png">
				<div class = "favorites-all" id = "'.$count.'"> В избранном у '.$count.' пользователей.
				</div>
			</div>

			<div class = "description">
				<img class = "icons" id = "favorites-icon" src = '.$src.'>
				<div class = "favorites"  id = "favorites"> '.$text.'
				</div>
			</div>

			<div class = "content">
				<div class = "name-content">Состав букета:</div>
			</div>';

			for($i = 0; $i < count($flowers); $i++){
				$id = $flowers[$i];
				$query_flowersList = mysqli_query($conn, "SELECT flowerName FROM flowers WHERE flower_id = '$id'");
				$row_flowersList = mysqli_fetch_assoc($query_flowersList);


				echo ' 
				<div class = "all-content">'.$row_flowersList["flowerName"].' - '.$countfl[$i].' шт</div>
				';

			}
			if(count($greens_id) > 0){
                echo '<div class = "content"><div class = "name-content">Список зелени:</div></div>   ' ;

                for($i = 0; $i < count($greens_id); $i++){
                $id = $greens_id[$i];
                $query_greensList = mysqli_query($conn, "SELECT flowerName FROM flowers WHERE flower_id = '$id'");
                $row_greensList = mysqli_fetch_assoc($query_greensList);

               
                echo ' 
                <div class = "all-content">'.$row_greensList["flowerName"].' 
                 </div>';

        }
        
        }

         echo '<div class = "content"><div class = "name-content">Упаковка:</div></div>' ;
        echo ' 
                <div class = "all-content">'.$rowPACK["typeOfPack"].' 
                 </div>';


			echo '

			<div class = "content">
				<div class = "name-content">Итого:</div>
			</div>

			<div style="margin-top: -15px;">
				<div class = "total" id = "total-price">Стоимость: '.$row["price"].' рублей</div>
				<div class="amount">
    				<span class="down" id="down">-</span>
    				<input class = "inputModal" id = "inputModal" type="text" value="1" readonly="readonly"/>
   	 				<span class="up" id="up">+</span> шт.
				</div>
			</div>

			

			
		</div>

		<button type = "button" class = "back" onclick = "closeModal(this.dataset.id) " title = "Добавить в корзину и вернуться к просмотру" data-id = "'.$row["bouquet_id"].'">Добавить в корзину
		</button>

		<button type = "button" class = "back" onclick = "sendModal('.$row["price"].', '.$row["bouquet_id"].') " title = "Добавить в корзину и вернуться к просмотру" data-id = "'.$row["bouquet_id"].'">Оформить заказ
		</button>
		';

		if($check > 0)
			echo

		'

		<button type = "button" id = "changemargin" class = "back" onclick = "openToEdit('.$row["bouquet_id"].') " title = "Редактировать" data-id = "'.$row["bouquet_id"].'">Редактировать
		</button>
		
					
	
	</form>
		';
	}


?>

<script type="text/javascript" src="functions.js"></script>