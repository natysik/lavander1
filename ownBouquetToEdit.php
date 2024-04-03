<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	 <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="functions.js"></script>

<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();

$id = $_SESSION["editId"];
//$val = 0;
$zIndex = 0;


	$query = mysqli_query($conn, "SELECT * FROM `bouquet_content` left join flowers on bouquet_content.flower_id = flowers.flower_id WHERE bouquet_id = $id and flowers.type = 1") ;
	$numberOfFlowers = mysqli_num_rows($query);

	while($row = mysqli_fetch_assoc($query)){

		$flower_id = $row['flower_id'];

		$queryFlower = mysqli_query($conn, "SELECT * FROM `flowers` WHERE flower_id = $flower_id AND type = 1");
		$rowFlower = mysqli_fetch_assoc($queryFlower);

		

		print "<script language='Javascript' type='text/javascript'>
		
			contenier = document.getElementById('making-a-bouquet');

			textInfo = document.getElementById('text-info');
			textInfo.style.display = 'none';

			
			input = Number(document.getElementById('inputModal_".$flower_id."').value) + 1;
			document.getElementById('inputModal_".$flower_id."').value = input;
			


			div = document.createElement('div');
			div.setAttribute('class', 'remove-flower');
			div.setAttribute('title', 'Удалить');
			div.setAttribute('id', val);
			div.addEventListener('click', remove, false);
			div.textContent = '\u00D7';
			contenier.appendChild(div);


			image = document.createElement('img');
			image.src = 'data:image/jpeg;base64,".base64_encode($rowFlower["img"])."';
			image.style.height = parseInt(50) + 'px';
			image.style.position = 'absolute';
			image.style.zIndex = ".$zIndex.";
			image.classList.add(".$rowFlower['flower_id'].");
			image.setAttribute('data-id',".$rowFlower['flower_id'].");
			image.setAttribute('data-value', val);
			image.setAttribute('id', 'img');

			
			contenier.appendChild(image);

			image.addEventListener('mousedown', initialClick, false);

			image.style.top = parseInt(".$row['position_top'].") + 'px';
			image.style.left = parseInt(".$row['position_left'].") + 'px';
			div.style.top = parseInt(".$row['position_top'].") + 'px';
			div.style.left = parseInt(".$row['position_left'].") + 'px';


			positionForSend = image.dataset.id + ':' + parseInt(".$row['position_left'].") + ';' + parseInt(".$row['position_top'].");

			flowers.set(image.dataset.value + ':' + image.dataset.id,  positionForSend);


			val++;
			
        </script>";

        
        $zIndex++;
	}
	

	$queryBouquet = mysqli_query($conn, "SELECT * FROM `bouquets` WHERE bouquet_id = $id");
	$rowBouquet = mysqli_fetch_assoc($queryBouquet);
	print "<script language='Javascript' type='text/javascript'>
			priceOfBouquet = ".$rowBouquet['price'].";
			document.getElementById('price-of-bouquet').innerHTML = priceOfBouquet;

			document.getElementById('number').textContent = ".$numberOfFlowers.";

			constructor = document.getElementById('making-a-bouquet');
			sizeOfConstructor(".$numberOfFlowers.", constructor);


			document.getElementById('select').textContent = ".$numberOfFlowers.";
	</script>";


	$query = mysqli_query($conn, "SELECT bouquet_content.flower_id as id FROM `bouquet_content` left join flowers on bouquet_content.flower_id = flowers.flower_id WHERE bouquet_id = '$id' AND flowers.type = 2");


	while($row = mysqli_fetch_assoc($query)){

		$green_id = $row['id'];

		

		print "<script language='Javascript' type='text/javascript'>


		document.getElementById('checkbox-".$green_id."').checked = true;
		greenMap.set(".$green_id.", ".$green_id.");
		
			
			
        </script>";

        
        
	}


	$query = mysqli_query($conn, "SELECT pack.pack_id, pack.price FROM `bouquets` left join pack on bouquets.pack_id = pack.pack_id WHERE bouquet_id = '$id' ");

	$row = mysqli_fetch_assoc($query);
	
	print "<script language='Javascript' type='text/javascript'>


		document.getElementById('checkboxPACK-".$row["pack_id"]."').checked = true;
		packId = ".$row["pack_id"].";
		pricePack = ".$row["price"].";
			
			
        </script>";


?>

