<?php 
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
?>
<html>
<head>
	<link rel="stylesheet" href="orders.css">
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


	<table class="bordered table_sort">
    <thead>
        <tr>
            <th>№ </th>        
            <th>Имя пользователя</th>
            <th>Цена заказа</th>
            <th>Дата оформления заказа</th>
            <th>Статус заказа</th>
        </tr>
    </thead>
    <tbody>
    	<?php include('listOrders.php'); ?>
    </tbody>
    
</table>

		
	


	


	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>


	<script>

		$('a:contains("Заказы")').removeClass("header_link btn from-left").addClass("now");

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

		document.addEventListener('DOMContentLoaded', () => {

			const getSort = ({ target }) => {
				const order = (target.dataset.order = -(target.dataset.order || -1));
				const index = [...target.parentNode.cells].indexOf(target);
				const collator = new Intl.Collator(['en', 'ru'], { numeric: true });
				const comparator = (index, order) => (a, b) => order * collator.compare(
					a.children[index].innerHTML,
					b.children[index].innerHTML
					);

				for(const tBody of target.closest('table').tBodies)
					tBody.append(...[...tBody.rows].sort(comparator(index, order)));

				for(const cell of target.parentNode.cells)
					cell.classList.toggle('sorted', cell === target);
			};

			document.querySelectorAll('.table_sort thead').forEach(tableTH => tableTH.addEventListener('click', () => getSort(event)));
		});

		

	


	
		

		
		

	</script>
</body>
</html>