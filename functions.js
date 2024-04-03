
//let price = 0;
let greenMap = new Map();
let packId = null;
let pricePack = 0;

$('.bye').mouseover(function(){
	text = this.innerHTML;
	$(this).text('Купить');
});
		
$('.bye').mouseout(function(){
	$(this).text(this.dataset.price + ' руб');
});

$(document).ready(function() {
	$('#down').click(function () {
		let $input = $(this).parent().find('input');
		let count = parseInt($input.val()) - 1;
		count = count < 1 ? 1 : count;

		if(count < 1){
			count = 1;
		}
		else{
			count = count;

			let coast = document.getElementsByClassName("coast")[0];

			if(price == coast.id){
				$('#total-price').html('Стоимость: ' + price + ' рублей');

				bonus = Math.round(price / 10);
				$('#total-bonus').html('Бонусы: ' + bonus );
			}
			else if(price == 0){
				price = coast.id;
				$('#total-price').html('Стоимость: ' + price + ' рублей');

				bonus = Math.round(price / 10);
				$('#total-bonus').html('Бонусы: ' + bonus );
			}
			else{
				price -=  coast.id;
				$('#total-price').html('Стоимость: ' + price + ' рублей');

				bonus = Math.round(price / 10);
				$('#total-bonus').html('Бонусы: ' + bonus );
			}
			
		}

		$input.val(count);
		$input.change();
		return false;
	});
	
	$('#up').click(function () {
		let $input = $(this).parent().find('input');
		$input.val(parseInt($input.val()) + 1);
		let d = this.id * $input.val;


		let coast = document.getElementsByClassName("coast")[0];
		let kolvo = document.getElementsByClassName("inputModal")[0];

		price = kolvo.value * coast.id;
		bonus = Math.round(price / 10);

		$('#total-price').html('Стоимость: ' + price + ' рублей');
		$('#total-bonus').html('Бонусы: ' + bonus );
		

		$input.change();
		return false;
	});
});



let modal = document.getElementById('myModal');
$('.bye').on('click', function(event) {
	modal.style.display = "block";
	bouquet_id = this.dataset.id;

	let request = new XMLHttpRequest();
	request.onreadystatechange = function(){
		if((request.readyState==4) && (request.status==200)){
			$('.modal-body').html(this.responseText);
		}
	}

	request.open('GET','modal.php?id=' + this.dataset.id, true); 
    request.send();
});

$('.box').on('click', function(event) {
	modal.style.display = "block";

	let request = new XMLHttpRequest();
	request.onreadystatechange = function(){
		if((request.readyState==4) && (request.status==200)){
			$('.modal-body').html(this.responseText);
		}
	}


    request.open('GET','modal.php?id=' + this.dataset.id, true); 
     		 
    request.send();
});



let bouquet_id;
let kolvo;

function closeModal(id){

	let request = new XMLHttpRequest();
	request.onreadystatechange = function(){
		if((request.readyState==4) && (request.status==200)){
			alert(this.response);
			
		}
	}

	kolvo = document.getElementsByClassName("inputModal")[0];
	bouquet_id = id;

    request.open('GET','addToBasket.php?bouquet=' + id + '&numerOf=' + kolvo.value, true); 		 
    request.send();


    modal.style.display = "none";

    

	return false;
}

function sendModal(cost, id){

	let newOrderModal = document.getElementById('modal-new-order');
	kolvo = document.getElementsByClassName("inputModal")[0].value;
	
	bouquet_cost = cost;


    modal.style.display = "none";
    newOrderModal.style.display = "block";


    let price = document.getElementById('endPrice');
    price.dataset.bouquet = id;
    price.dataset.numberOf = kolvo;
    price.dataset.cost = kolvo * bouquet_cost;


    price.innerHTML =  kolvo * bouquet_cost;


	
	return false;
}



let val = 0;
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

function remove(){

	for (let key of flowers.keys()) {
		if(key.includes(this.id + ":")){

			let valueToChek;
			let price;

			let imgs = document.querySelectorAll("#img");
			for(let i = 0; i < imgs.length; i++){
				if(imgs[i].dataset.value == this.id){
					valueToChek = imgs[i].dataset.id;
					imgs[i].parentNode.removeChild(imgs[i]);
				}
			}

			let inputs = document.querySelectorAll(".inputModal");
			for(let i = 0; i < inputs.length; i++){
				if(inputs[i].dataset.id == valueToChek){
					let count = parseInt(inputs[i].value) - 1;
					count = count < 0 ? 0 : count;
					inputs[i].value = count;

					price = inputs[i].dataset.price;
				}
			}

			let number = Number(document.getElementById("number").textContent) - 1;
			document.getElementById("number").textContent = number;


			console.log(price);

			priceTemp = Number(document.getElementById("price-of-bouquet").innerHTML) - price;
			document.getElementById("price-of-bouquet").textContent = priceTemp;


			priceOfBouquet = priceTemp;

			this.parentNode.removeChild(this);

			flowers.delete(key);
		}
	}

}

function sizeOfConstructor(content, constructor){
			if(content == "7"){
				constructorSize = 7;
				constructor.style.height = 100 + "px";
				constructor.style.width = 100 + "px";
			}
			if(content == "9"){
				constructorSize = 9;
				constructor.style.height = 110 + "px";
				constructor.style.width = 110 + "px";
			}
			if(content == "11"){
				constructorSize = 11;
				constructor.style.height = 120 + "px";
				constructor.style.width = 120 + "px";
			}
			if(content == "13"){
				constructorSize = 13;
				constructor.style.height = 130 + "px";
				constructor.style.width = 130 + "px";
			}
			if(content == "15"){
				constructorSize = 15;
				constructor.style.height = 140 + "px";
				constructor.style.width = 140 + "px";
			}
			if(content == "17"){
				constructorSize = 17;
				constructor.style.height = 150 + "px";
				constructor.style.width = 150 + "px";
			}
			if(content == "19"){
				constructorSize = 19;
				constructor.style.height = 160 + "px";
				constructor.style.width = 160 + "px";
			}
			if(content == "21"){
				constructorSize = 21;
				constructor.style.height = 170 + "px";
				constructor.style.width = 170 + "px";
			}
			if(content == "23"){
				constructorSize = 23;
				constructor.style.height = 180 + "px";
				constructor.style.width = 180 + "px";
			}
			if(content == "25"){
				constructorSize = 25;
				constructor.style.height = 190 + "px";
				constructor.style.width = 190 + "px";
			}
			if(content == "27"){
				constructorSize = 27;
				constructor.style.height = 200 + "px";
				constructor.style.width = 200 + "px";
			}
			if(content == "29"){
				constructorSize = 29;
				constructor.style.height = 210 + "px";
				constructor.style.width = 210 + "px";
			}
			if(content == "31"){
				constructorSize = 31;
				constructor.style.height = 220 + "px";
				constructor.style.width = 210 + "px";
			}
			if(content == "33"){
				constructorSize = 33;
				constructor.style.height = 230 + "px";
				constructor.style.width = 230 + "px";
			}
			if(content == "35"){
				constructorSize = 35;
				constructor.style.height = 240 + "px";
				constructor.style.width = 240 + "px";
			}
			if(content == "37"){
				constructorSize = 37;
				constructor.style.height = 250 + "px";
				constructor.style.width = 250 + "px";
			}
		}





