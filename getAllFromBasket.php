<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
include "database.php";
global $conn;

if(!isset($_SESSION['login'])){
	echo 'Только зарегистрированный пользователь может просматривать корзину!';
}
else{
	$user = $_SESSION['id'];

$query = mysqli_query($conn, "SELECT * FROM basket, bouquets WHERE basket.bouquet_id = bouquets.bouquet_id AND user_id = $user ");


while($row = mysqli_fetch_assoc($query)){

	$img = base64_encode($row['photo']);

	echo '
		<div class = "element">
			<span class="close" title = "Удалить из корзины" data-id = "'.$row["basket_id"].'">&times;</span>
			<div class = "elementImg"><img src = "data:image/jpeg;base64,'.$img.'" ></div>
			<div class = "namePrice">Цена: <span class = "infoPrice" id = "price" data-price = '.$row["price"].' data-numbOf = '.$row["numberOf"].'>'.$row["price"] * $row["numberOf"].'</span> руб</div>

			<div class = "descc">
				<div class = "name">Название букета: <span class = "info">'.$row["nameOfTheBouquet"].'</span></div>

				<div class="amount">
    				<span class="down" data-id = "'.$row["basket_id"].'">-</span>
    				<input class = "inputModal" type="text" value='.$row["numberOf"].' />
   	 				<span class="up" data-id = "'.$row["basket_id"].'">+</span> шт
				</div>

			</div>
		</div>
		';
	}
}



?>

<script>

	$('.close').on('click', function(event) {

		let request = new XMLHttpRequest();

		request.onreadystatechange = function(){
		if((request.readyState==4) && (request.status==200)){
			$('.allFlowersInBasket').load('getAllFromBasket.php');
			$('.compose').load('basketGetPrice.php');
			$('.endPrice').load('basketGetPrice.php');
		}
	}

	request.open('GET','basketRemove.php?id=' + this.dataset.id, true); 
    request.send();

	});

	$('.up').click(function(){

		let $input = $(this).parent().find('input');

		let numberOf = parseInt($input.val()) + 1;

		let request = new XMLHttpRequest();

		request.onreadystatechange = function(){
		if((request.readyState==4) && (request.status==200)){
			$('.allFlowersInBasket').load('getAllFromBasket.php');
			$('.compose').load('basketGetPrice.php');
			$('.endPrice').load('basketGetPrice.php');
		}
	}

	request.open('GET','basketPlas.php?id=' + this.dataset.id + '&numberOf=' + numberOf, true); 
    request.send();

	});

	$('.down').click(function(){

		let $input = $(this).parent().find('input');

		if( parseInt($input.val()) == 1) return false;
		else{

			let numberOf = parseInt($input.val()) - 1;

			let request = new XMLHttpRequest();

			request.onreadystatechange = function(){
				if((request.readyState==4) && (request.status==200)){
					$('.allFlowersInBasket').load('getAllFromBasket.php');
					$('.compose').load('basketGetPrice.php');
					$('.endPrice').load('basketGetPrice.php');
				}
			}

			request.open('GET','basketPlas.php?id=' + this.dataset.id + '&numberOf=' + numberOf, true); 
			request.send();

		}

		

	});


	
	
</script>