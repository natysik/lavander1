<?php
if($_SESSION['role'] == 3){
echo '
	<li>
		<a href="ourBouquets.php" class = "header_link btn from-left">Наши букеты</a>
	</li>
	<li>
		<a href="reviews.php" class = "header_link btn from-left">Отзывы</a>
	</li>
	<li>
		<a href="orders.php" class = "header_link btn from-left">Заказы</a>
	</li>
';
}

else if($_SESSION['role'] == 2){
echo '
	<li>
		<a href="orders.php" class = "header_link btn from-left">Заказы</a>
	</li>
';
}

else if($_SESSION['role'] == 1)	{
	echo '
	<li>
		<a href="ourBouquets.php" class = "header_link btn from-left">Наши букеты</a>
	</li>

	<li>
		<a href="ownBouquet.php" class = "header_link btn from-left">Собрать свой букет</a>
	</li>

	<li>
		<a href="reviews.php" class = "header_link btn from-left">Отзывы</a>
	</li>

	<li>
		<a href="basket.php" class = "header_link btn from-left">Корзина</a>
	</li>
';
}

else{
	echo '
	<li>
		<a href="ourBouquets.php" class = "header_link btn from-left">Наши букеты</a>
	</li>

	<li>
		<a href="ownBouquet.php" class = "header_link btn from-left">Собрать свой букет</a>
	</li>

	<li>
		<a href="reviews.php" class = "header_link btn from-left">Отзывы</a>
	</li>

';
}

?>