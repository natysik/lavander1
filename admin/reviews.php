<?php 
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
?>
<html>
<head>
	<link rel="stylesheet" href="reviews.css">
	<link rel="stylesheet" href="common-styles.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
	<meta charset="UTF-8" />
	<meta name = "viewport" content="width=device-width">
</head>
<body>
	<div class = "wrapper">
		<div class = "header">
			<div class = "container">
				<div class = "header__body">
					<div class = "logo">LAVANDER</div>
					<div class = "header_burger">
						<span></span> 
					</div>
					<nav class = "header__menu">
						<ul class = "header__list">
							<?php include('../menu.php');

							if(!isset($_SESSION['login'])){
								echo '<li><a href="" class = "header_link logIn">Вход</a></li>';
							}
							if(isset($_SESSION['login'])){
								if($_SESSION['login'] != "admin"){
									
									echo '<li> <a href="personalArea.php" class = "header_link btn from-left">Личный кабинет</a> </li>';
								}
								
								echo '<li><a href="" class = "header_link logOut">Выход</a></li>';
								if($_SESSION['login'] != "admin"){
									echo "<script language='Javascript' type='text/javascript'> 
									$('.logOut').css('padding-left','435px');
									</script>";
								}
							}?>
						</ul>
					</nav>
				</div>
			</div>
		</div>
	</div>


	<table class = "table">
		<tr>
			<td>
				<div class = "tagline"><div>Есть что сказать</div></div>
			</td>	
		</tr>

		<tr class = "tt">
			<td class="leftComment">
				<div class = "bel">о нас?</div>
				<textarea class = "commentForm" id = "commentForm" placeholder="Оставьте комментарий"></textarea> 
				<div>
					<button class = "choze">Отправить</button>
				</div>
			</td>

			<td>
				<div class = "allComents">
					<?php include("getAllComments.php") ?>
				</div>

			</td>
		</tr>

		
	</table>


	

		
	


	


	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>


	<script>

		$('a:contains("Отзывы")').removeClass("header_link btn from-left").addClass("now");

		$('div.logo').on('click', function(event) {
			window.location.href = 'firstPage.php';
		});

		$('.logOut').on('click', function(event) {
			let page = "first-page";
			 $.ajax({
				url: '../logOut.php',
				method: 'POST',
				success: function(response){						 
					$(".text").html(response);
					window.location.href = '../firstPage.php';
					}
			});
			
		});

		$('.remove').on('click', function(event) {
			 $.ajax({
				url: 'remove.php',
				method: 'POST',
				data: {
					id: this.id
				},
				success: function(response){	
					location.reload();
					}
			});
			
		});

		
		

	


	
		

		
		

	</script>
</body>
</html>