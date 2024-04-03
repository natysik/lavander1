<?php include "database.php" ;
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
?>
<html>
<head>
	<link rel="stylesheet" href="basket.css">
	<link rel="stylesheet" href="common-styles.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	 <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
	 <script src="slick/slick.min.js"></script>
    <link rel="stylesheet" type="text/css" href="slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="slick/slick-theme.css"/>
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


	<div class = "subMenu">
		
		
	</div>

	<div class = "window">
		<div class = "bas">
			<div class = "allFlowersInBasket"> <?php  include("getAllFromBasket.php"); ?></div>
			<button class = "compose"><?php include("basketGetPrice.php")?></button> 
		</div>
		

		<div class = "table">
			
		<?php include("ordersTable.php")?>
		
		</div>
	</div>


	<div id="myModal" class="modal">
		<div class="modal-content">
			<div class="modal-header">
				<span class="zak" title = "Отмена">&times;</span>
				<p>Оформление заказа</p>
				<hr>
			</div>

			<div class="modal-body">

				<form  class = "formLogIn"  id = "formLogIn" method = "post" action = "logIn.php">
					
					<p class="typeOfText"> Доставка: </p>
					<div class="dropdownDost">
						<div class="select">
						 	<span>Выбрать тип</span>
					          <i class="fa fa-chevron-left"></i>
					    </div>
					    <input type="hidden" name="gender" id = "dost">
					      <ul class="dropdown-menu">
					      	<li  id = "none" data-content = "Самовывоз"> Самовывоз </li>
					        <li  data-content = "Доставка по адресу"> Доставка по адресу </li>
					    </ul>
					</div>
					</p>

					<p class="typeOfText"> Адрес доставки: 
					    <div>
					      	<input type = "text" id = "adress" value="<?php include('infoForOrder.php'); adress(); ?>" class = "textBox" autocomplete="off" >
					    </div>
					</p>

					<p class="typeOfText"> Номер телефона: 
					    <div>
					      	<input type = "text"  value="<?php phone();?>" class = "textBox" autocomplete="off" >
					    </div>
					</p>

					

					<p class="typeOfText"> Оплата: </p>
					    <div class="dropdownOpl">
					      	<div class="select">
					      		<span>Выбрать </span>
					      		<i class="fa fa-chevron-left"></i>
					      	</div>

					      	<input type="hidden" name="gender">

					      	<ul class="dropdown-menu">
					      		<li data-content = "Банковской картой"> Банковской картой </li>
					      		<li data-content = "Наличными"> Наличными </li>
					      	</ul>
					    </div>
					</p>

					

					      Стоимость всего заказа: <span class = "endPrice">  <?php include("basketGetPrice.php")?></span>

					      <div id = "error"></div>

					      <div>
					      	<button type = "button" id = "button" class = "end">Заказать</button>
					      </div>

						

					
					

				</form>
			</div>
		</div>
	</div>

	<div id="modal" class="loginModal">
		<div class="logmodal-content">
			<div class="logmodal-header">
				<span class="logclose" title = "Отмена">&times;</span>
				<p class = "welcome">Добро пожаловать в Lavender!</p>
			</div>

			<div class="logmodal-body">
				<form  class = "formLogIn"  id = "formLogIn" method = "post" action = "logIn.php">
					<div>
						<div>
							<input type = "text" id = "login" name = "logIn" placeholder="Логин" autocomplete="off" >
						</div>

						<div id = "errorLogin"></div>

						<div class = "password">
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


	<div id="modalRegistration" class="modalRegistration">
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
						<div id = "errorReg"></div>

					</div>

					
					

				</form>
			</div>
		</div>
	</div>










	<script>

		$('a:contains("Корзина")').removeClass("header_link btn from-left").addClass("now");

		

		let table = document.getElementsByClassName("table")[0];
		let bask = document.getElementsByClassName("bas")[0];

		$('div.logo').on('click', function(event) {
			window.location.href = 'firstPage.php';
		});

		$('.subMenu').on('click', '.basket', function(){
			$(this).addClass('on').siblings('.basket').removeClass('on');
			if(this.dataset.info == "basket"){
				bask.style.display = "block";
				table.style.display = "none";
			}
			if(this.dataset.info == "orders"){
				bask.style.display = "none";
				table.style.display = "block";
			}
     	});


     	let text;

     	$('.compose').mouseover(function(){
			text = this.innerHTML;
			$(this).text('заказать');
		});

		$('.compose').mouseout(function(){
			$(this).text(text);

		});



		let modal = document.getElementById('myModal');
		let span = document.getElementsByClassName("zak")[0];



		$('.compose').on('click', function(event) {
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

		let dost = 0;
		let dostvalue = "";

		let adress = 0;
		let adressValue = "";

		let opl = 0;
		let oplValue = "";

		let forh = 0;
		let forhValue = "";

		let inputAdr = document.getElementById('adress');
		let adr = inputAdr.value;

		$('.dropdownDost').click(function () {
			$(this).attr('tabindex', 1).focus();
			$(this).toggleClass('active');
			$(this).find('.dropdown-menu').slideToggle(300);
			$('#error').html('');
		});

		$('.dropdownDost').focusout(function () {
			$(this).removeClass('active');
			$(this).find('.dropdown-menu').slideUp(300);
		});

		$('.dropdownDost .dropdown-menu li').click(function () {
			$(this).parents('.dropdownDost').find('span').text($(this).text());
			$(this).parents('.dropdownDost').find('input').attr('value', $(this).attr('id'));
			console.log(this.id);

			if(this.id == "none"){
				$('#adress').val('');
				$('#adress').addClass('off');
				$('#adress').prop('readonly', true);
				dost = 1;
				adress = 1;
				dostvalue = this.dataset.content;
				adressValue = "-";

			}
			else{
				$('#adress').removeClass('off');
				$('#adress').val(adr);
				$('#adress').prop('readonly', false);
				dost = 1;
				adress = 0;
				dostvalue = this.dataset.content;
			}
		});

		$('.dropdownOpl').click(function () {
			$(this).attr('tabindex', 1).focus();
			$(this).toggleClass('active');
			$(this).find('.dropdown-menu').slideToggle(300);
			$('#error').html('');
		});

		$('.dropdownOpl').focusout(function () {
			$(this).removeClass('active');
			$(this).find('.dropdown-menu').slideUp(300);
		});

		$('.dropdownOpl .dropdown-menu li').click(function () {
			$(this).parents('.dropdownOpl').find('span').text($(this).text());
			$(this).parents('.dropdownOpl').find('input').attr('value', $(this).attr('id'));
			opl = 1;
			oplValue = this.dataset.content;
		});

		$('.dropdownForh').click(function () {
			$(this).attr('tabindex', 1).focus();
			$(this).toggleClass('active');
			$(this).find('.dropdown-menu').slideToggle(300);
			$('#error').html('');
		});

		$('.dropdownForh').focusout(function () {
			$(this).removeClass('active');
			$(this).find('.dropdown-menu').slideUp(300);
		});

		$('.dropdownForh .dropdown-menu li').click(function () {
			$(this).parents('.dropdownForh').find('span').text($(this).text());
			$(this).parents('.dropdownForh').find('input').attr('value', $(this).attr('id'));
			forh = 1;
			forhValue = this.dataset.content;
		});



		



		$("#button").click(
				function(){

					let endPrice = Number($(".endPrice").html().replace(/[a-zа-яё]/gi, ''));

					if(dost == 0) $('#error').html('Укажите способ доставки');

					if(dostvalue == "Самовывоз") adressValue = "-";
					if(dostvalue == "Доставка по адресу") adressValue = $("#adress").val();

					if(opl == 0) $('#error').html('Укажите способ оплаты');
					else{
						$.ajax({
							url: 'sendZak.php',
							method: 'POST',
							data: {
								dostvalue: dostvalue,
								adressValue: adressValue,
								oplValue: oplValue,
								endPrice: endPrice
							},
							success: function(){
							$('.endPrice').load('basketGetPrice.php');						 
								modal.style.display = "none";
								$('.allFlowersInBasket').load('getAllFromBasket.php');
								$('.compose').load('basketGetPrice.php');
								$('.table').load('ordersTable.php');

								alert("Заказ оформлен!");
							}
						});


					}
							
					
				}); 

		let modalLog = document.getElementById('modal');
    	let logClose = document.getElementsByClassName("logclose")[0];
    	$('.logIn').on('click', function(event) {
			modalLog.style.display = "block";
			return false;
		});

		logClose.onclick = function() {
		    modalLog.style.display = "none";
		}

		window.onclick = function(event) {
		    if (event.target == modal) {
		        modalLog.style.display = "none";
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
								$("#errorPassword").html(response);
							}
						});
					}
							
					
				});

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
					window.location.href = 'firstPage.php';
					}
			});
			
		});

		



		let modalRegistration = document.getElementById('modalRegistration');
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
						$("#errorReg").html('Заполните все поля');
					}
					else if($("#loginReg").val() == ""){
						$('#errorReg').html('Заполните все поля');
					}
					else if($("#passwordNew").val() == ""){
						$('#errorReg').html('Заполните все поля');
					}
					else if($("#passwordNewRep").val() == ""){
						$('#errorReg').html('Заполните все поля');
					}
					
					else if($("#passwordNewRep").val() != $("#passwordNew").val()){
						$('#errorReg').html('Пароли не совпадают');
					}

					else {
						let name = $("#name").val();
						let loginReg = $("#loginReg").val();
						let passwordNew = $("#passwordNew").val();
						let passwordNewRep = $("#passwordNewRep").val();

						let request = new XMLHttpRequest();

						request.onreadystatechange = function(){
							if((request.readyState==4) && (request.status==200)){
								$('#errorReg').html(this.responseText);
								if($('#errorReg').html() == "")
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