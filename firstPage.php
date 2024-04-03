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
					<div ><img src="img/logo.png" class = "logo"></div>
					<div class = "header_burger">
						<span></span> 
					</div>
					<nav class = "header__menu">
						<ul class = "header__list">
							<?php include('menu.php');

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
					<div class = "dada">Цветы в любую точку</div>
					<div class = "bel">Беларуси</div>
					<img src="img/logo.png" class = "hide">
					<div class = "text">Цветы — наше вдохновение и забота о Вас!
						<p>Мы будем радовать Вас приятными ценами и современными</p>
						<p>авторскими цветочными композициями.</p>
					</div>
					<button class = "choze" onclick="document.location='ourBouquets.php'">выбрать букет</button>
				</div>


			</td>
			<td class = "card">
				<div id="circle"></div> 
				<img src="img/fon.png" class = "img">
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

				<form  class = "registration-form"   method = "post" id = "ajax-registration-form">
					<div>
						<span class = "desc"> Имя: </span>
						<div>
							<input type = "text" id = "name" name = "name"  class = "textInput"autocomplete="off" >
						</div>
						<div id = "error-name"></div>

						<span class = "desc"> Логин: <span class = "necessarily">*</span> </span>
						<div>
							<input type = "text" id = "loginReg" name = "loginReg"  class = "textInput"autocomplete="off" >
						</div>
						<div id = "error-login"></div>

						<span class = "desc"> Телефон: <span class = "necessarily">*</span> </span>
						<div>
							<input type = "text" id = "phone" name = "phoneReg"  class = "textInput" autocomplete="off" >
						</div>
						<div id = "error-phone"></div>


						<span class = "desc"> Пароль: <span class = "necessarily">*</span> </span>
						
						<div>
							<input type = "password" id = "passwordNew" name = "passwordNew"  class = "textInput"autocomplete="off" >
							<a href="#" class="control"></a>
						</div>
						<div id = "error-password"></div>

						<span class = "desc"> Повторите пароль:  </span>
						<div>
							<input type = "password" id = "passwordNewRep" name = "passwordNewRep"  class = "textInput"autocomplete="off" >
							<a href="#" class="control-rep"></a>
						</div>
               			<div id = "error-rep-password"></div>


						<button type = "button" id = "buttonAdd">Регистрация</button>

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
			 $.ajax({
				url: 'logOut.php',
				method: 'POST',
				success: function(response){						 
					$(".text").html(response);
					//location.reload();
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
					registerNewUser('ajax-registration-form', 'registr.php');
					return false; 
				});
		});

		function registerNewUser(ajax_form, url) {
			$.ajax({
				url:     url,
				type:     "POST", 
				dataType: "html", 
				data: $("#"+ajax_form).serialize(), 
				success: function(response) { 
					$("#error-name").html(response);

				}
			});
		}


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

		$('body').on('click', '.control', function(){
			if ($('#passwordNew').attr('type') == 'password'){
				$(this).addClass('view');
				$('#passwordNew').attr('type', 'text');
			} else {
				$(this).removeClass('view');
				$('#passwordNew').attr('type', 'password');
			}
			return false;
		});

		$('body').on('click', '.control-rep', function(){
			if ($('#passwordNewRep').attr('type') == 'password'){
				$(this).addClass('view');
				$('#passwordNewRep').attr('type', 'text');
			} else {
				$(this).removeClass('view');
				$('#passwordNewRep').attr('type', 'password');
			}
			return false;
		});



	
		

		
		

	</script>
</body>
</html>