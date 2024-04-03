<?php include "database.php" ;
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
$_SESSION['flowerMenu'] = 0;





?>
<html>
<head>
	
	<link rel="stylesheet" href="common-styles.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	 <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
	 <script src="slick/slick.min.js"></script>
	 <script type="text/javascript" src="functions.js"></script>
    <link rel="stylesheet" type="text/css" href="slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="slick/slick-theme.css"/>
    <link rel="stylesheet" href="ownBouquet.css">
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



	<table class = "dd">
		<tr >
			<td class = "chooze">
				<div class = "tagline">
					<div>Соберите свой</div>
				</div>
			</td>	
		</tr>

		<tr>
			<td class = "chooze">
				<div class = "bel">идеальный букет</div>
			</td>
		</tr>
	</table>


	<div id="modal" class="loginModal">
		<div class="logmodal-content">
			<div class="logmodal-header">
				<span class="logclose" title = "Отмена">&times;</span>
				<p class="welcome">Добро пожаловать в Lavender!</p>
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

				<form  class = "registration-form"   method = "post" id = "ajax-registration-form">
					<div>
						<span class = "desc"> Имя: </span>
						<div>
							<input type = "text" id = "name" name = "name"  class = "text-input"autocomplete="off" >
						</div>
						<div id = "error-name"></div>

						<span class = "desc"> Логин: <span class = "necessarily">*</span> </span>
						<div>
							<input type = "text" id = "loginReg" name = "loginReg"  class = "text-input"autocomplete="off" >
						</div>
						<div id = "error-login"></div>

						<span class = "desc"> Телефон: <span class = "necessarily">*</span> </span>
						<div>
							<input type = "text" id = "phone" name = "phoneReg"  class = "text-input" autocomplete="off" >
						</div>
						<div id = "error-phone"></div>


						<span class = "desc"> Пароль: <span class = "necessarily">*</span> </span>
						<div>
							<input type = "password" id = "passwordNew" name = "passwordNew"  class = "text-input"autocomplete="off" >
							<a href="#" class="control"></a>
						</div>
						<div id = "error-password"></div>

						<span class = "desc"> Повторите пароль:  </span>
						<div>
							<input type = "password" id = "passwordNewRep" name = "passwordNewRep"  class = "text-input"autocomplete="off" >
							<a href="#" class="control-rep"></a>
						</div>
               			<div id = "error-rep-password"></div>


						<button type = "button" id = "buttonAdd">Регистрация</button>

					</div>

					
					

				</form>
			</div>
		</div>
	</div>

	<div class = "main-window">
		<div class = "multiple-items"><?php include "flowersList.php"?></div>

		<div class = "constructor">
		<div class = "submenu">
			<div class = "area on" data-info = "above">Вид сверху</div>
			<div class = "area " data-info = "greenery" >Зелень </div>
			<div class = "area" data-info = "pack">Упаковка</div>
		</div>

		<div class = "bouquet-form">
			<div  id = "bouquet-form">
				<div id = "content">
					<div class = "making-a-bouquet" id = "making-a-bouquet">
						<span class = "text-info" id = "text-info">Выберите цветок</span>
					</div>
				</div>



				<span class = "number-of-in-bouq">Количество цветов в букете:</span>
				<div class="dropdown">
					<div class="select" id = "select">
						<span>27</span>
					</div>
					<input type="hidden" name="dost" id = "dost">
					<ul class="dropdown-menu">
						<li  data-content = "7"> 7 </li>
						<li  data-content = "9"> 9 </li>
						<li  data-content = "11"> 11 </li>
						<li  data-content = "13"> 13 </li>
						<li  data-content = "15"> 15 </li>
						<li  data-content = "17"> 17 </li>
						<li  data-content = "19"> 19 </li>
						<li  data-content = "21"> 21 </li>
						<li  data-content = "23"> 23 </li>
						<li  data-content = "25"> 25 </li>
						<li  data-content = "27"> 27 </li>
						<li  data-content = "29"> 29 </li>
						<li  data-content = "31"> 31 </li>
						<li  data-content = "33"> 33 </li>
						<li  data-content = "35"> 35 </li>
						<li  data-content = "37"> 37 </li>
					</ul>
				</div>

				<span class = "number-of-in-bouq">Текущее количество цветов:</span>
				<span class = "number-of-in-bouq" id = "number" style = "margin-left: 10px">0</span>
				<div class = "clean-off"><span>Отчистить</span></div>

			</div>


			<div id = "green-form">
				<?php include "greenForm.php"; ?>
			</div>


			<div id = "pack-form">
				<?php include "packForm.php"; ?>
			</div>

			<div class = "ordering-block"> 
				<div>
					<div class = "price-info">Общая стоимость: <span id = "price-of-bouquet"> 0</span> руб</div>
				
				</div>
				<?php 
					if(!isset($_SESSION["editId"]))
						echo '<button type = "button" class = "button-create">Создать букет</button>';
					else
						echo '<button type = "button" class = "button-save">Сохранить изменения</button>';
				?>
				
			</div>
		</div>
		</div>

		<div>


	<div id="create-own-bouquet" class="create-own-bouquet">
		<div class="create-content">
			<div class="create-header">
				<span class="create-close" title = "Отмена">&times;</span>
				<p class="welcome">Создание букета</p>
			</div>

			<div class="create-body">
				<form  class = "create-form"   method = "post" id = "ajax-create-form">
					<div>
						<span class = "desc"> Название букета: </span>
						<div>
							<input type = "text" id = "bouquet-name" name = "bouquet-name"  class = "text-input" autocomplete="off" >
						</div>
						<div id = "error-bouquet-name"></div>

						<span class = "desc"> Список цветов: </span>
						<div class = "contentOfBouquet">
							

						</div>

						<span class = "desc"> Общая стоимость: </span>
						<span class = "total-cost"></span>


						<button type = "button" class = "create-button" id = "create-button">Сохранить букет</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	

	<div id="save-own-bouquet" class="save-own-bouquet">
		<div class="create-content">
			<div class="create-header">
				<span class="save-close" title = "Отмена">&times;</span>
				<p class="welcome">Редактирование букета</p>
			</div>

			<div class="create-body">
				<form  class = "create-form"   method = "post" id = "ajax-create-form">
					<div>
						<span class = "desc"> Название букета: </span>
						<div>
							<?php 
							$id = $_SESSION["editId"];
							$query = mysqli_query($conn, "SELECT * FROM `bouquets` WHERE bouquet_id = $id") ;
							$row = mysqli_fetch_assoc($query);

							echo '<input type = "text" id = "bouquet-name-edit" name = "bouquet-name-edit"  class = "text-input" autocomplete="off" value = '.$row["nameOfTheBouquet"].'>';
							 ?>
							
						</div>
						<div id = "error-bouquet-name-edit"></div>

						<span class = "desc"> Список цветов: </span>
						<div class = "list"></div> 

						<span class = "desc"> Общая стоимость: </span>
						<span class = "total-cost"></span> 


						<button type = "button" class = "save-edit-button" id = "save-edit-button">Сохранить букет</button>
					</div>
				</form>
			</div>
		</div>
	</div>



	<script>

		$('a:contains("Собрать свой букет")').removeClass("header_link btn from-left").addClass("now");

		$('div.logo').on('click', function(event) {
			window.location.href = 'firstPage.php';
		});


		let constr = document.getElementById('bouquet-form');
		let green = document.getElementById('green-form');
		let pack = document.getElementById('pack-form');

		$('.submenu').on('click', '.area', function(){
			$(this).addClass('on').siblings('.area').removeClass('on');
			if(this.dataset.info == "above"){
				constr.style.display = "block";
				green.style.display = "none";
				pack.style.display = "none";
			}
			if(this.dataset.info == "greenery"){
				constr.style.display = "none";
				green.style.display = "flex";
				pack.style.display = "none";
			}
			if(this.dataset.info == "pack"){
				pack.style.display = "flex";
				constr.style.display = "none";
				green.style.display = "none";
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

		$(document).ready(function() {
			$("#buttonLogIn").click(function(){
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
				$('.dropdown').toggleClass('classSlad');
			});
		});

		$('.logOut').on('click', function(event) {
			 $.ajax({
				url: 'logOut.php',
				method: 'POST',
				success: function(response){						 
					$(".text").html(response);
					location.reload();
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


		
		
		let priceOfBouquet = 0;
		let zIndex = 0;
		


		//for position
		let flowers = new Map();

		$(document).ready(function() {
			$('.down').click(function () {
				if(constr.style.display !== "none"){
					let $input = $(this).parent().find('input');
					let count = parseInt($input.val()) - 1;
					count = count < 0 ? 0 : count;


					let inputs = document.getElementsByClassName("inputModal");
					let valueOfFlowers = 0;
					for(let i = 0; i < inputs.length; ++i){
						valueOfFlowers += Number(inputs[i].value);
					}

					document.getElementById("number").textContent = Number(valueOfFlowers) - 1;
					if(Number(valueOfFlowers) == 0)
						document.getElementById("number").textContent = 0;




					let collection = document.getElementsByClassName(this.dataset.id);
					collection[0].remove();


					priceOfBouquet -= parseInt(this.dataset.price);
					document.getElementById("price-of-bouquet").innerHTML = priceOfBouquet;



					$input.val(count);
					$input.change();





					for(let key of Array.from(flowers.keys()).sort((a, b) => a-b)){
						if(key.split(':')[1] == this.dataset.id){
							flowers.delete(key);
							break;
						}
					}
					return false;
				}

			});


			let contenier = document.getElementById("making-a-bouquet");
			let flag = 0;
			


			$('.up').click(function () {

				if(constr.style.display !== "none"){

					let $input = $(this).parent().find('input');

					$input.val(parseInt($input.val()) + 1);

					let inputs = document.getElementsByClassName("inputModal");
					let valueOfFlowers = 0;
					for(let i = 0; i < inputs.length; i++){
						valueOfFlowers += Number(inputs[i].value);
					}



					if(Number(valueOfFlowers) > Number(constructorSize)){
						$input.val(parseInt($input.val()) - 1);
						alert("В букете не может быть больше " + constructorSize +" цветов.");
						document.getElementById("number").textContent = constructorSize;
					}
					else{
						document.getElementById("number").textContent = valueOfFlowers;

						let position = contenier.getBoundingClientRect();

						let textInfo = document.getElementById('text-info');
						textInfo.style.display = "none";



						let top = random(position.bottom, position.top);
						let left = random(position.right, position.left);




						let div = document.createElement("div");
						div.setAttribute("class", "remove-flower");
						div.setAttribute("title", "Удалить");
						div.setAttribute("id",val);
						div.addEventListener("click", remove, false);
						div.textContent = "\u00D7";
						contenier.appendChild(div);



						let img = document.createElement("img");
						img.src = this.dataset.img;
						img.style.height = parseInt(50) + 'px';
						img.style.position = 'absolute';
						img.style.zIndex = zIndex;
						img.classList.add(this.dataset.id);
						img.setAttribute("data-id",this.dataset.id);
						img.setAttribute("data-value",val);
						img.setAttribute("id", "img");
						contenier.appendChild(img);


						img.style.top = parseInt(top) + 'px';
						img.style.left = parseInt(left) + 'px';

						div.style.top = parseInt(top) + 'px';
						div.style.left = parseInt(left) + 'px';

						positionForSend = img.dataset.id + ":" + parseInt(left) + ";" + parseInt(top);
						flowers.set(img.dataset.value + ":" + img.dataset.id,  positionForSend);
						console.log(flowers);

						img.addEventListener("mousedown", initialClick, false);


						let priceToSave = 0;
						let checkbox = document.getElementsByClassName("checkbox");
						for(let i = 0; i < checkbox.length; i++){
							if(checkbox[i].checked == true){
								priceToSave += Number(checkbox[i].dataset.price);
							}

						}


						priceOfBouquet += parseInt(this.dataset.price);
						if(flag == 0){
							priceOfBouquet += priceToSave;
							flag = 1;
						}

						

						document.getElementById("price-of-bouquet").innerHTML = priceOfBouquet;


						$input.change();

						zIndex++;
						val++;
						return false;
					}
				}


				
			});


			function random(min, max) {
			 let rand = min - 25 + Math.random() * (max - min + 1);
			 return Math.round(rand);
			}



			let moving = false;
			let startX;
			let startY;

			function initialClick(e) {
				startX = e.clientX;
				startY = e.clientY;
				this.style.zIndex = zIndex + 1;


				elems = document.querySelectorAll('.remove-flower');
				for(i = 0; i < elems.length; i++) {
					elems[i].style.display = "none";
				}

				id = this.dataset.value;
				div = document.getElementById(id);
				div.style.display = "block";


				if(moving){
					document.removeEventListener("mousemove", move);
					moving = !moving;

					return;
				}

				moving = !moving;
				image = this;
				zIndex++;
				div.style.display = "none";


				document.addEventListener("mousemove", move, false);
			}


			let positionLeft = "";
			let positionTop = "";
			let positionForSend = "";


			function move(e){
				let position = contenier.getBoundingClientRect();

				let newX = e.clientX - 10;
				let newY = e.clientY - 10;


				if(newX < position.right - 25 && newX > position.left  - 25){
					div.style.left = newX + "px";
					image.style.left = newX + "px";
					positionLeft = newX;
				}

				if(newY < position.bottom - 25 && newY > position.top - 25){
					div.style.top = newY + "px";
					image.style.top = newY + "px";
					positionTop = newY;
				}

				positionForSend = image.dataset.id + ":" + positionLeft + ";" + positionTop;

				flowers.set(image.dataset.value + ":" + image.dataset.id,  positionForSend);
				console.log(flowers);
			
				
			}

			
		});

		$('.multiple-items').slick({
			rows: 2,
			slidesToShow: 3,
        	slidesToScroll: 1,
        	variableWidth: true,
        	infinite: true,
			responsive: [{
				breakpoint: 780,
				settings: {
					slidesToShow: 6,
				}
			},
			{
				breakpoint: 416,
				settings: {
					rows: 1,
					slidesToShow: 1
				}
			}]
		});



		let modalCreate = document.getElementById('create-own-bouquet');
		let spanCreate = document.getElementsByClassName("create-close")[0];


		let modalSave = document.getElementById('save-own-bouquet');
		let spanSave = document.getElementsByClassName("save-close")[0];

		//let flowers_id;
		//let flowers_amount;


		$('.button-create').click(function(){

			let inputs = document.getElementsByClassName("inputModal");
			let valueOfFlowers = 0;
			for(let i = 0; i < inputs.length; i++){
				valueOfFlowers += Number(inputs[i].value);
			}

			if(Number(valueOfFlowers) < Number(constructorSize)){
				alert("Недостаточно цветов в букете.");
			}
			else if(packId == null){
				alert("Необходимо выбрать тип упаковки.");
			}
			else{
				let flowers_id = Array.from(flowers.keys()).toString();
				let flowers_coordinates = Array.from(flowers.values()).toString();
				let greenKeys = Array.from(greenMap.keys()).toString();


			$.ajax({
				url: 'ownBouquetFunctions.php',
				method: 'POST',
				data: {
					flowers_id: flowers_id,
					flowers_coordinates: flowers_coordinates,
					green: greenKeys,
					pack: packId
				},
				success: function(response){	
					$(".contentOfBouquet").html(response);
					$(".total-cost").html(document.getElementById("price-of-bouquet").innerHTML + ' руб');
				}
			});

			
			return false;
			}

			
		});


		$('.button-save').click(function(){

			let inputs = document.getElementsByClassName("inputModal");
			let valueOfFlowers = 0;
			for(let i = 0; i < inputs.length; i++){
				valueOfFlowers += Number(inputs[i].value);
			}

			if(Number(valueOfFlowers) < Number(constructorSize)){
				alert("Недостаточно цветов в букете.");
			}
			else{
				let flowers_id = Array.from(flowers.keys()).toString();
				let flowers_coordinates = Array.from(flowers.values()).toString();
				let greenKeys = Array.from(greenMap.keys()).toString();
				console.log(greenKeys);


			$.ajax({
				url: 'ownBouquetSave.php',
				method: 'POST',
				data: {
					flowers_id: flowers_id,
					flowers_coordinates: flowers_coordinates,
					green: greenKeys,
					pack: packId
				},
				success: function(response){	
					$(".list").html(response);
					$(".total-cost").html(document.getElementById("price-of-bouquet").innerHTML + ' руб');


				}
			});

			
			return false;
			}

			
		});
		
		spanCreate.onclick = function() {
			modalCreate.style.display = "none";
		}

		spanSave.onclick = function() {
			modalSave.style.display = "none";
		}



		$('#create-button').click(function(){

			let flowers_id = Array.from(flowers.keys()).toString();
			let flowers_coordinates = Array.from(flowers.values()).toString();
			let greenKeys = Array.from(greenMap.keys()).toString();


			if($("#bouquet-name").val() == "")
				$('#error-bouquet-name').html('Введите название букета');
			else{

				$.ajax({
				url: 'createOwnBouquet.php',
				method: 'POST',
				data: {
					flowers_id: flowers_id,
					flowers_coordinates: flowers_coordinates,
					price: document.getElementById("price-of-bouquet").innerHTML,
					name: $("#bouquet-name").val(),
					green: greenKeys,
					pack: packId
				},
				success: function(response){	
					alert("Новый букет добавлен в раздел Авторские букеты!");
					window.location.href = 'ourBouquets.php';
					//alert(response);

				}
			});
			}
			

		});

		$('#save-edit-button').click(function(){



			let flowers_id = Array.from(flowers.keys()).toString();
			let flowers_coordinates = Array.from(flowers.values()).toString();
			let greenKeys = Array.from(greenMap.keys()).toString();

			let price = document.getElementById("price-of-bouquet").innerHTML;
			price = Number(price.split(' ')[0]);
			


			if($("#bouquet-name-edit").val() == "")
				$('#error-bouquet-name').html('Введите название букета');
			else{

				$.ajax({
				url: 'saveEditBouquet.php',
				method: 'POST',
				data: {
					flowers_id: flowers_id,
					flowers_coordinates: flowers_coordinates,
					coast: price,
					name: $("#bouquet-name-edit").val(),
					green: greenKeys,
					pack: packId
				},
				success: function(response){	
					alert("Изменения сохранены!");
					window.location.href = 'ourBouquets.php';
					//alert(response);

				}
			});
			}
			

		});

		let constructorSize = 27;


		$('.dropdown').click(function () {
			$(this).attr('tabindex', 1).focus();
			$(this).toggleClass('active');
			$(this).find('.dropdown-menu').slideToggle(300);
		});

		$('.dropdown').focusout(function () {
			$(this).removeClass('active');
			$(this).find('.dropdown-menu').slideUp(300);
		});

		$('.dropdown .dropdown-menu li').click(function () {
			$(this).parents('.dropdown').find('span').text($(this).text());
			let constructor = document.getElementById("making-a-bouquet");
			let text = document.getElementById("text-info");

			
			if(Number(this.dataset.content) >= Number(constructorSize)){
				sizeOfConstructor(this.dataset.content, constructor);
			}

			else{
				let result = confirm("Выбранное количество цветов меньше, чем текущее. Если вы желаете продолжить, то все цветы будут удалены. Продолжить?");

				if(result){
					document.getElementById('text-info').style.display = "block";

					sizeOfConstructor(this.dataset.content, constructor);

					while(document.getElementById("img"))
						document.getElementById("img").remove();

					let inputs = document.getElementsByClassName("inputModal");
					for(let i = 0; i < inputs.length; i++)
						inputs[i].value = 0;

					document.getElementById("price-of-bouquet").innerHTML = 0;
					priceOfBouquet = 0;

					document.getElementById("number").textContent = 0;

					elems = document.querySelectorAll('.remove-flower');
					for(i = 0; i < elems.length; i++) {
						elems[i].parentNode.removeChild(elems[i]);
					}

					flowers.clear();
				}

				else
					$(this).parents('.dropdown').find('span').text(constructorSize);
			}
			
		});


		

		$(".clean-off").click(function(){
			document.getElementById('text-info').style.display = "block";

			let priceToSave = 0;

			while(document.getElementById("img"))
				document.getElementById("img").remove();

			let inputs = document.getElementsByClassName("inputModal");
			for(let i = 0; i < inputs.length; i++)
				inputs[i].value = 0;

			let checkbox = document.getElementsByClassName("checkbox");
			for(let i = 0; i < checkbox.length; i++){
				if(checkbox[i].checked == true){
					priceToSave += Number(checkbox[i].dataset.price);
				}
				
			}

			

			document.getElementById("price-of-bouquet").innerHTML = priceToSave;
			priceOfBouquet = 0;

			document.getElementById("number").textContent = 0;

			elems = document.querySelectorAll('.remove-flower');
			for(i = 0; i < elems.length; i++) {
				elems[i].parentNode.removeChild(elems[i]);
			}


			flowers.clear();
			flag = 0;

		});

		

		$('.checkbox').on('change', function () {

			let id = Number($(this).val());
			let checkbox = document.getElementById("checkbox-" + id);
			let price = Number(checkbox.dataset.price);

			if($(this).is(':checked')){
				priceTemp = Number(document.getElementById("price-of-bouquet").innerHTML) + price;
				document.getElementById("price-of-bouquet").textContent = priceTemp;
				greenMap.set(id, id);
			}
			else{
				priceTemp = Number(document.getElementById("price-of-bouquet").innerHTML) - price;
				document.getElementById("price-of-bouquet").textContent = priceTemp;
				greenMap.delete(id);
			}


		});




		$('.checkboxPACK').on('change', function () {

			

			let id = Number($(this).val());
			let checkbox = document.getElementById("checkboxPACK-" + id);
			let price = Number(checkbox.dataset.price);


			let $box = $(this);
			if ($box.is(":checked")) {
				let group = "input:checkbox[name='" + $box.attr("name") + "']";
				$(group).prop("checked", false);

				priceTemp = Number(document.getElementById("price-of-bouquet").innerHTML) - pricePack;
				document.getElementById("price-of-bouquet").textContent = priceTemp;
				packId = id;

				pricePack = price;
				priceTemp = Number(document.getElementById("price-of-bouquet").innerHTML) + pricePack;
				document.getElementById("price-of-bouquet").textContent = priceTemp;

				$box.prop("checked", true);
			} else {
				$box.prop("checked", false);
			}






		});







    

		

	</script>


	
</body>
</html>

<?php 




if(isset($_SESSION["editId"])){
	include 'ownBouquetToEdit.php';
	
}


?>