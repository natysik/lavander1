<?php 
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
?>
<html>
<head>
	<link rel="stylesheet" href="firstPage.css">
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

		
	

	<table>
		<tr>
			<td>
				<div class = "tagline">
					<div>Цветы в любую точку</div>
					<div class = "bel">Беларуси</div>
					<div class = "text">Цветы — наше вдохновение и забота о Вас!
						<p>Мы будем радовать Вас приятными ценами и современными</p>
						<p>авторскими цветочными композициями.</p>
					</div>
					<button class = "choze" onclick="document.location='ourBouquets.php'">выбрать букет</button>
				</div>
			</td>
			<td class = "card">
				<div id="circle"></div> 
				<img src="img/lavanda.png" class = "img">
			</td>
		</tr>
	</table>

	<div id="myModal" class="modal">
		<div class="modal-content">
			<div class="modal-header">
				<span class="close" title = "Отмена">&times;</span>
				<p class="welcome">Добро пожаловать в Lavander!</p>
			</div>

			<div class="modal-body">

				<form  class = "formLogIn"  id = "formLogIn" method = "post" action = "logIn.php">
					<div>

						<div>
							<input type = "text" id = "login" name = "logIn" placeholder="Логин" autocomplete="off" >
						</div>

						<div id = "errorLogin"></div>

						<div class="password">
							<input type = "password" id = "password" name = "password" placeholder="Пароль">
							<a href="#" class="password-control"></a>
						</div>

						<div id = "errorPassword"></div>

						<button type = "button" id = "buttonLogIn">Вход</button>
						<p class = "acc">Ещё нет аккаунта?</p>
						

					</div>

					
					

				</form>
			</div>
		</div>
	</div>

	<div id="modal" class="modalRegistration">
		<div class="registration-content">
			<div class="registration-header">
				<span class="registration-close" title = "Отмена">&times;</span>
				<p class="welcome">Регистрация</p>
			</div>

			<div class="registration-body">

				<form  class = "registration-form"  id = "form" method = "post" >
					<div>
						<span class = "desc"> Имя Фамилия: </span>
						<div>
							<input type = "text" id = "name" name = "name"  class = "textInput"autocomplete="off" >
						</div>

						<span class = "desc"> Логин: </span>
						<div>
							<input type = "text" id = "loginReg" name = "name"  class = "textInput"autocomplete="off" >
						</div>

						<span class = "desc"> Пароль: </span>
						<div>
							<input type = "password" id = "passwordNew" name = "position"  class = "textInput"autocomplete="off" >
						</div>

						<span class = "desc"> Повторите пароль: </span>
						<div>
							<input type = "password" id = "passwordNewRep" name = "position"  class = "textInput"autocomplete="off" >
						</div>
               			




						

						<button type = "button" id = "buttonAdd">Регистрация</button>
						<div id = "error"></div>

					</div>

					
					

				</form>
			</div>
		</div>
	</div>


	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>


	<script>

		let modal = document.getElementById('myModal');
		let span = document.getElementsByClassName("close")[0];

		$('.logIn').on('click', function(event) {
			modal.style.display = "block";
			return false;
		});

		span.onclick = function() {
		    modal.style.display = "none";
		}

		window.onclick = function(event) {
		    if (event.target == modal) {
		        modal.style.display = "none";
		    }
		}

		$("#login").click(function(){
			$('#errorLogin').html('');
		});

		$("#password").click(function(){
			$('#errorPassword').html('');
		});


		$( document ).ready(function() {
			$("#buttonLogIn").click(
				function(){

					if($("#login").val() == "" || $("#password").val() == ""){
						if($("#login").val() == "")
							$('#errorLogin').html('Это поле не может быть пустым');
						if($("#password").val() == "")
							$('#errorPassword').html('Это поле не может быть пустым');
					}
					else{
						let login = $("#login").val();
						let password = $("#password").val();

						$.ajax({
							url: 'logIn.php',
							method: 'POST',
							data: {
								login: login,
								password: password
							},
							success: function(response){				
								$("#errorLogin").html(response);
							}
						});

					}
							
					
				});

			//АДАПТИВНОСТЬ

			$('.header_burger').click(
				function(){
				$('.header_burger, .header__menu').toggleClass('active');
			});

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

		let modalRegistration = document.getElementById('modal');
		let spanRegistration = document.getElementsByClassName("registration-close")[0];

		$('.acc').on('click', function(event) {
			modalRegistration.style.display = "block";
			return false;
		});

		spanRegistration.onclick = function() {
		    modalRegistration.style.display = "none";
		}

		window.onclick = function(event) {
		    if (event.target == modalRegistration) {
		        modalRegistration.style.display = "none";
		    }
		}

		$( document ).ready(function() {
			$("#buttonAdd").click(
				function(){

					if($("#name").val() == ""){
						$('#error').html('Заполните все поля');
					}
					else if($("#loginReg").val() == ""){
						$('#error').html('Заполните все поля');
					}
					else if($("#passwordNew").val() == ""){
						$('#error').html('Заполните все поля');
					}
					else if($("#passwordNewRep").val() == ""){
						$('#error').html('Заполните все поля');
					}
					
					else if($("#passwordNewRep").val() != $("#passwordNew").val()){
						$('#error').html('Пароли не совпадают');
					}

					else {
						let name = $("#name").val();
						let loginReg = $("#loginReg").val();
						let passwordNew = $("#passwordNew").val();
						let passwordNewRep = $("#passwordNewRep").val();

						let request = new XMLHttpRequest();

						request.onreadystatechange = function(){
							if((request.readyState==4) && (request.status==200)){
								$('#error').html(this.responseText);
								if($('#error').html() == "")
									location.reload();
								}
						}

						request.open('GET','registr.php?name=' + name + '&loginReg=' + loginReg + '&passwordNew=' + passwordNew + '&passwordNewRep=' + passwordNewRep, true); 
						request.send();
					}

					
				});
		});


		$('body').on('click', '.password-control', function(){
			if ($('#password').attr('type') == 'password'){
				$(this).addClass('view');
				$('#password').attr('type', 'text');
			} else {
				$(this).removeClass('view');
				$('#password').attr('type', 'password');
			}
			return false;
		});



	
		

		
		

	</script>
</body>
</html>