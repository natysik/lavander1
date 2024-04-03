<?php include "database.php" ;
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
?>
<html>
<head>
	<link rel="stylesheet" href="personalArea.css">
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
									
									echo '<li> <a href="basket.php" class = "header_link btn from-left now">Личный кабинет</a> </li>';
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


	<div class = "submenu">

		<div class = "area on" data-info = "favorites">Избранные букеты</div>
		<div class = "area " data-info = "personal-information" >Личная информация </div>
		<div class = "area" data-info = "change-password">Изменить пароль</div>
		<div class = "area" data-info = "active-order">Активные заказы</div>
		<div class = "area" data-info = "orders">Все заказы</div>

	</div>


	<form class = "personal-information" method="post" id="ajax-form-personal-information">
		<?php 
		include('personalInfo.php');
		information();

		?>

		<button type = "button" id = "button-personal-information">Сохранить изменения</button>
	</form>


	<form class = "personal-password" method="post" id="ajax-form-personal-password">
		<?php 
		password();
		?>

		<button type = "button" id = "button-personal-password">Изменить пароль</button>
	</form>

	<div class = "active-order">

		<table class="bordered table_sort" id = "bordered">
			<thead>
				<tr>  
            		<th>Имя курьера</th>
            		<th>Номер курьера</th>
            		<th>Адресс доставки</th>
            		<th>Цена заказа</th>
            		<th>Дата оформления заказа</th>
            		<th>Статус заказа</th>
        		</tr>
    		</thead>
    		<tbody>
    			<?php include('listOrders.php'); activeOrders();?>
    		</tbody>
		</table>

	</div>

	<div class = "all-order">

		<table class="bordered table_sort" id = "bordered">
			<thead>
				<tr>  
            		<th>Имя курьера</th>
            		<th>Номер курьера</th>
            		<th>Адресс доставки</th>
            		<th>Цена заказа</th>
            		<th>Дата оформления заказа</th>
            		<th>Статус заказа</th>
        		</tr>
    		</thead>
    		<tbody>
    			<?php  allOrders();?>
    		</tbody>
		</table>

	</div>


	<div class="slider multiple-items" id = "flowers" style = "visibility: block">
					<?php include "favoritesFlowers.php";?>
	</div>

	<div id="myModal" class="modal">
		<div class="modal-content">
			<div class="modal-header">
				<span class="close" title = "Отмена">&times;</span>
			</div>

		 <div class="modal-body"></div>
		</div>
	</div>

	<div id="modal-new-order" class="modal-new-order">
		<div class="modal-content-new-order">
			<div class="modal-header-new-order">
				<span class="close-new-order" title = "Отмена">&times;</span>
				<p>Оформление заказа</p>
				<hr>
			</div>

			<div class="modal-body-new-order">

				<form  class = ""  id = "" method = "post" >
					
					<p class="typeOfText"> Доставка: </p>
					<div class="dropdownDost">
						<div class="select">
						 	<span>Выбрать тип</span>
					          <i class="fa fa-chevron-left"></i>
					    </div>
					    <input type="hidden" name="dost" id = "dost">
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
					      	<input type = "text"  id = "phone-input" value="<?php phone();?>" class = "textBox" autocomplete="off" >
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

					

					      Стоимость всего заказа: 
					      <span class = "endPrice" id = "endPrice">  
					      </span> рублей

					      <div id = "error"></div>

					      <div>
					      	<button type = "button" id = "button" class = "end" onclick = "acceptOrder()">Заказать</button>
					      </div>

						

					
					

				</form>
			</div>
		</div>
	</div>


	<script>

		$('a:contains("Личный кабинет")').removeClass("header_link btn from-left").addClass("now");

		

		$('div.logo').on('click', function(event) {
			window.location.href = 'firstPage.php';
		});


		let information = document.getElementsByClassName("personal-information")[0];
		let password = document.getElementsByClassName("personal-password")[0];
		let slider = document.getElementsByClassName("slider")[0];
		let order = document.getElementsByClassName("active-order")[0];
		let allorder = document.getElementsByClassName("all-order")[0];

		$('.submenu').on('click', '.area', function(){
			$(this).addClass('on').siblings('.area').removeClass('on');
			if(this.dataset.info == "personal-information"){
				information.style.display = "block";
				password.style.display = "none";
				order.style.display = "none";
				allorder.style.display = "none";
				slider.style.visibility = "hidden";
			}
			if(this.dataset.info == "change-password"){
				slider.style.visibility = "hidden";
				information.style.display = "none";
				password.style.display = "block";
				allorder.style.display = "none";
				order.style.display = "none";
			}
			if(this.dataset.info == "favorites"){
				information.style.display = "none";
				password.style.display = "none";
				slider.style.visibility = "visible";
				allorder.style.display = "none";
				order.style.display = "none";
			}
			if(this.dataset.info == "active-order"){
				slider.style.visibility = "hidden";
				information.style.display = "none";
				password.style.display = "none";
				allorder.style.display = "none";
				order.style.display = "block";
			}
			if(this.dataset.info == "orders"){
				slider.style.visibility = "hidden";
				information.style.display = "none";
				password.style.display = "none";
				allorder.style.display = "block";
				order.style.display = "none";
			}
     	});

     	$('body').on('click', '.control', function(){
			if ($('#password').attr('type') == 'password'){
				$(this).addClass('view');
				$('#password').attr('type', 'text');
			} else {
				$(this).removeClass('view');
				$('#password').attr('type', 'password');
			}
			return false;
		});

		$('body').on('click', '.control-rep', function(){
			if ($('#password-rep').attr('type') == 'password'){
				$(this).addClass('view');
				$('#password-rep').attr('type', 'text');
			} else {
				$(this).removeClass('view');
				$('#password-rep').attr('type', 'password');
			}
			return false;
		});

		



		$('.logOut').on('click', function(event) {
			 $.ajax({
				url: 'logOut.php',
				method: 'POST',
				success: function(response){	
					window.location.href = 'firstPage.php';
					}
			});
			
		});


		$( document ).ready(function() {
			$("#button-personal-information").click(
				function(){
					changeUserInfo('ajax-form-personal-information', 'changeUserInfo.php');
					return false; 
				}
				);
		});

		function changeUserInfo(ajax_form, url) {
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


		$(document).ready(function() {
			$("#button-personal-password").click(
				function(){
					changeUserPassword('ajax-form-personal-password', 'changeUserPassword.php');
					return false; 
				}
				);
		});

		function changeUserPassword(ajax_form, url) {
			$.ajax({
				url:     url,
				type:     "POST", 
				dataType: "html", 
				data: $("#"+ajax_form).serialize(), 
				success: function(response) { 
					$("#error-new-password").html(response);

				}
			});
		}



		$('.multiple-items').slick({
			slidesToShow: 5,
        	slidesToScroll: 1,
        	infinite: true,
			responsive: [
    		
        		{
        			breakpoint: 780,
        			settings: {
	        slidesToShow: 6,
	      }
	    },
	    {
	      breakpoint: 416,
	      settings: {
	        slidesToShow: 1
	      }
	    
    }]});


		$('.remove').on('click', function(event) {
			 $.ajax({
				url: 'remove.php',
				method: 'POST',
				data: {
					bouquet_id: this.id
				},
				success: function(response){	
					location.reload();

					}
			});
			
		});


		$(document).ready(function() {
			$("#addCategory").click(
				function(){
					modal.style.display = "block";
					let request = new XMLHttpRequest();

					request.onreadystatechange = function(){
						if((request.readyState==4) && (request.status==200)){
							$('.modal-body').html(this.responseText);
						}
					}

					request.open('GET','modal.php?id=' + this.dataset.id, true); 
					request.send();
				}
				);
		});


		let modal = document.getElementById('myModal');
		let close = document.getElementsByClassName("close")[0];

		close.onclick = function() {
		    modal.style.display = "none";
		}


		let dost = 0;
		let dostvalue = "";

		let adress = 0;
		let adressValue = "";

		let opl = 0;
		let oplValue = "";

		$('.dropdownDost').click(function () {
			$(this).attr('tabindex', 1).focus();
			$(this).toggleClass('active');
			$(this).find('.dropdown-menu').slideToggle(300);
		});

		$('.dropdownDost').focusout(function () {
			$(this).removeClass('active');
			$(this).find('.dropdown-menu').slideUp(300);
		});

		$('.dropdownDost .dropdown-menu li').click(function () {
			$(this).parents('.dropdownDost').find('span').text($(this).text());
			$(this).parents('.dropdownDost').find('input').attr('value', $(this).attr('id'));
	

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


		function acceptOrder(order_num){
			let price = document.getElementById('endPrice');
			let phone = document.getElementById('phone-input').value;

			if(dost == 0) $('#error').html('Укажите способ доставки');

			if(dostvalue == "Самовывоз") adressValue = "-";
			if(dostvalue == "Доставка по адресу") adressValue = $("#adress").val();

			if(opl == 0) $('#error').html('Укажите способ оплаты');
			else{
				$.ajax({
				url: 'newOrder.php',
				method: 'POST',
				data: {
					bouquet_id: price.dataset.bouquet,
					numberOf: price.dataset.numberOf,
					cost: price.dataset.cost,
					dostvalue: dostvalue,
					adressValue: adressValue,
					oplValue: oplValue,
					phone: phone
				},
				success: function(response){	
					$("#error").html(response);
				}
			});
			}


			
		}


		$('body').on('click', '#favorites-icon', function(){

			let icon = document.getElementById("favorites-icon");
			let text = document.getElementsByClassName("favorites-all")[0];

			if(document.getElementById("favorites").innerHTML.includes("Для добавления в избранное необходимо войти."))
				return false;

			else if(document.getElementById("favorites").innerHTML.includes("Добавить в избранное.")){
				

				$.ajax({
					url: 'addToFavorites.php',
					method: 'POST',
					data:{
						bouquet_id: document.getElementsByClassName("nameOfB")[0].id
					},
					success: function(response){
						icon.src = "img/icon/dislike.png";
						document.getElementById("favorites").innerText = "У Вас в избранном.";
						text.innerText = "В избранном у "+ response.trim() +" пользователей.";
					}
				});

				
			}
			else{
				

				$.ajax({
					url: 'removeFromFavorites.php',
					method: 'POST',
					data:{
						bouquet_id: document.getElementsByClassName("nameOfB")[0].id
					},
					success: function(response){
						icon.src = "img/icon/like.png";
						document.getElementById("favorites").innerText = "Добавить в избранное.";
						text.innerText = "В избранном у "+ response.trim() +" пользователей.";
					}
				});
			}

			return false;
		});

		

		

		



		
	
			


		

	</script>


	
</body>
</html>