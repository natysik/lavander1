<?php include "database.php" ;
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
?>
<html>
<head>
	<link rel="stylesheet" href="ourBouquets.css">
	<link rel="stylesheet" href="..\common-styles.css">
	<script src = "js/ourBouquets.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	 <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
	 <script src="slick/slick.min.js"></script>
    <link rel="stylesheet" type="text/css" href="slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="slick/slick-theme.css"/>
	<meta charset="UTF-8" />
	
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
			<td class = "chooze">
				<div class = "tagline">
					<div>Выберите свой</div>
				</div>
			</td>

			<td class = "for">
				
				<div id="myModal" class="modal">
					<div class="modal-content">
						<div class="modal-header" >
							<span class="close">&times;</span>
							<p>Добавление нового букета</p>
							<hr>
						</div>
					    <div class="modal-body">

					    	<form method = 'post'  class = "addBou"  enctype="multipart/form-data" onsubmit="return addBouquets();" id = "form-addNewBou">
					    		<span class = "desc"> Название букета: </span>
					    		<div>
					    			<input type = "text" id = "name" name = "name"  class = "textInput"autocomplete="off" >
					    		</div>

					    		<span class = "desc"> Тип букета: </span> </br>
					    			<div class="dropdown">
					    				<div class="select">
					    					<span>Выбрать тип</span>
					    					<i class="fa fa-chevron-left"></i>
					    				</div>

					    				<input type="hidden" name="type">

					    				<ul class="dropdown-menu">
					    					<?php
					    					include "database.php";
					    					global $conn;
					    					$query = mysqli_query($conn, "SELECT * FROM category");

					    					while($row = mysqli_fetch_assoc($query)){
					    						$id = $row['id'];
					    						$name = $row['nameOfCategory'];
					    						echo "<li  id = '{$id}'> {$name} </li>";
					    					}?>
					    				</ul>
					    			</div>
					    		

					    		</br><span class = "desc"> Цена: </span> 
					    		<div>
					    			<input type = "number" min="1" id = "price" name = "price"  class = "textInput" autocomplete="off" >
					    		</div>

					    		<span class = "desc"> Загрузка изображения </span>
					    		<input id="file-input" type="file" name="img_upload" multiple>

					    		<button type = "submit" id = "buttonAdd">Добавить</button>
					    		<div id = "error"></div>
					    	</form>

					    </div>
					</div>
				</div>

				<form>
					<input type="text" placeholder="Поиск" class = "search">
					<button type="submit"></button>
				</form>

			</td>	
		</tr>

		<tr>
			<td class = "chooze">
				<div class = "bel">идеальный букет</div>
			</td>
			<td rowspan ="3" class = "wrap">
				<!----слайдер товаров---->
				<div class = "loaderArea">
					<div class="preloader">
				  			<div class="load">
				  				<hr/><hr/><hr/><hr/>
				  			</div>
				  		</div>
				</div>
			
				  	<div class="slider multiple-items" id = "flowers">
				  		<?php include "allFlowers.php";?>
				  	</div>
				
				<button class = "addBouquets" id = "addBouquets" >Добавить букет</button>
			</td>
		</tr>
		<tr>
			<td>
				<ul class = "sections" id = "sections">
					<?php include "functions.php";
					menuItems();
					?>
				</ul>

				<button class = "addCategory" id = "addCategory" >Изменить разделы</button>
				<div id="myModalCategory" class="modal">
					<div class="modal-content">
						<div class="modal-header">
							<span class="closeCategory">&times;</span>
							<p>Изменение разделов</p>
							<hr>
						</div>
					    <div class="modal-body">
					      <p> Название: <input type = "text" id = "bname"></p>
					      <p> Тип букета: <input type = "text" id = "btype"></p>
					      <p> Изображение: <input type = "text" id = "bimg"></p><p> Стоимость: <input type = "text" id = "bprice"></p><input type = "hidden" id = "bid">
					    </div>
					</div>
				</div>

				<div id="modal-edit-boue" class="modal"> 
					<div class="modal-content">
						<div class="modal-header name-of-area"> Редактировать букет
							<span class="close-edit-bou" title = "Отмена">&times;</span>
							<hr>
						</div>
						<div class="modal-body-edit-bou"></div>
					</div>
				</div>


				<div class = "someText">Не нашли подходящий? </div>
				<div class = "someText1">Составте свой собственный букет и мы посчитаем </div>
				<div class = "sometext2">стоимость сбора и доставки.</div>

				<button class = "compose">составить</button>
			</td>
		
			
		</tr>
	</table>

	


	



	<script>

		$('a:contains("Наши букеты")').removeClass("header_link btn from-left").addClass("now");

		$(window).on('load', function () {
			$slider = $('#flowers');
			$button = $('.addBouquets');
			$preloader = $('.loaderArea');
			$loader = $preloader.find('.loader');
			$loader.fadeOut();
			$preloader.fadeOut();
			$slider.fadeIn(400);
			$button.fadeIn(400);
		});



		$('div.logo').on('click', function(event) {
			window.location.href = '../firstPage.php';
		});

		$('.logOut').on('click', function(event) {
			 $.ajax({
				url: '../logOut.php',
				method: 'POST',
				success: function(response){						 
					$(".text").html(response);
					window.location.href = '../ourBouquets.php';
					}
			});
			
		});
		
		function changeCategory(category){
			var request = new XMLHttpRequest();
			request.onreadystatechange = function(){
				if((request.readyState==4) && (request.status==200)){
					$('.box').remove();
          			$('.slider').slick('slickAdd', this.responseText );

				}
			}

     		request.open('GET','changeСategory.php?category=' + category, true); 
     		request.send();

		}

		function getLastSlide(){
    		return ($(".slider").slick("getSlick").slideCount - 1);
		}
		

		$('.sections').on('click', 'li.section', function(){
			$(this).addClass('on').siblings('.section').removeClass('on');
			category = this.id;
			changeCategory(this.id);
     	});


		let ul = document.getElementById('sections');
		ul.addEventListener('click', function(e){
			let target = e.target;
			if(target.tagName == 'LI'){

			}
		});

		$(".search").keydown(function(e) {
        if(e.keyCode === 13){
        	let name = $('.search').val();

        	let request = new XMLHttpRequest();
        	request.onreadystatechange = function(){
        		if((request.readyState == 4) && (request.status == 200)){
        			$('.box').remove();
            		$('.slider').slick('slickAdd', this.responseText );
        		}
        	}

        	request.open('GET', 'search.php?name=' + name, true);
        	request.send();
        	return false;
        	
                    
               
 
        
        }
 
    });



		

		let modal = document.getElementById('myModal');
		let modalCategory = document.getElementById('myModalCategory');
		let modalEditBou = document.getElementById('modal-edit-boue');


		let btn = document.getElementById("addBouquets");
		let btnCategory = document.getElementById("addCategory");

		let span = document.getElementsByClassName("close")[0]; 
		let spanCategory = document.getElementsByClassName("closeCategory")[0];
		let spanEditBou = document.getElementsByClassName("close-edit-bou")[0];


		btn.onclick = function() {
		    modal.style.display = "block";
		}

		btnCategory.onclick = function() {
		    modalCategory.style.display = "block";
		}


		$('.bye').on('click', function(event) {

		    modalEditBou.style.display = "block";

		    let request = new XMLHttpRequest();
			request.onreadystatechange = function(){
				if((request.readyState==4) && (request.status==200)){
					$('.modal-body-edit-bou').html(this.responseText);
				}
			}


     		request.open('GET','modal.php?id=' + this.dataset.id, true); 
     		 
     		request.send();
		});


		span.onclick = function() {
		    modal.style.display = "none";
		}

		spanCategory.onclick = function() {
		    modalCategory.style.display = "none";
		}

		spanEditBou.onclick = function() {
		    modalEditBou.style.display = "none";
		}



		window.onclick = function(event) {
		    if (event.target == modal) {
		        modal.style.display = "none";
		    }
		}

		window.onclick = function(event) {
		    if (event.target == modalCategory) {
		        modalCategory.style.display = "none";
		    }
		}

		$('.multiple-items').slick({
			slidesToShow: 3,
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
	        slidesToShow: 2
	      }
	    
    }]});



		$('.dropdown').click(function () {
			$(this).attr('tabindex', 1).focus();
			$(this).toggleClass('active');
			$(this).find('.dropdown-menu').slideToggle(300);
		});

		$('.dropdown').focusout(function () {
			$(this).removeClass('active');
			$(this).find('.dropdown-menu').slideUp(300);
		});

		let idCategoty;

		$('.dropdown .dropdown-menu li').click(function () {
			$(this).parents('.dropdown').find('span').text($(this).text());
			$(this).parents('.dropdown').find('input').attr('value', $(this).attr('id'));
			idCategoty = this.id;
		});


		let input = document.getElementById('bimg');
		input.onchange = e => {
			let file = e.target.files[0];
		}


		let imgForSession;
		
		function addBouquets(){
				sendAjaxForm('error', 'form-addNewBou', 'addBouquets.php');
				imgForSession = document.getElementById("file-input").value;
				let arr = imgForSession.substr(12); 
				imgForSession = "D:/OpenServer/domains/labs/project/img/" + arr;
				

				session(imgForSession);

				return false; 
				
		}

		

		function session(image) {
			$.ajax({
				type: "POST",
				url: "session.php",
				data: {img: image},

				success: function(save) {}
			});
		}

		function changeImg(){
			let img = document.getElementById("file-input-edit").value;
			let arr = img.substr(12); 
			img = "../img/" + arr;

			$(".bou-img").attr("src", img);
			$(".input-img").attr("value", img);
		}

		function sendModal(id){
			//sendAjaxForm('error-price', 'edit-form-boue', 'editBouquet.php');

			return false;

			$.ajax({
				url: editBouquet.php, 
				type: "POST", 
				dataType: "html", 
				data: {
					name: $(".name-edit").value
				},

				success: function(response) { 
					alert(response);

				}
			});
		}

		




		

		

		

		
    

		

	</script>


	
</body>
</html>