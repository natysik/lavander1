<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
include "database.php";
global $conn;

$user = $_SESSION['id'];

$query = mysqli_query($conn, "SELECT * FROM comments, users WHERE comments.user_id = users.user_id");


while($row = mysqli_fetch_assoc($query)){
	$postid = $row['id'];

	

	echo '
		<div class = "comment"> 
						<span class = "userName">Пользователь: '.$row["login"].' <span id = "'.$row["id"].'" class="remove" title = "Удалить">&times;</span> </span>
						<p class = "comText">'.$row["comment"].'</p>

						
					</div>
		';
	}



?>

<script>
	$(".choze").on('click', function(){
			let com = document.getElementById('commentForm').value;

			if(com == '') alert("Комментарий не может быть пустым!");
			else{
				let request = new XMLHttpRequest();
				request.onreadystatechange = function(){
				if((request.readyState==4) && (request.status==200)){
					alert("Коммент отправлен");
					$('#commentForm').val('');
					$('.allComents').html('getAllComments.php');
					//alert(this.responseText)
				}
			}

			request.open('GET','sendComment.php?com=' + com, true); 
    		request.send();
			}

			

		});

		

    // like and unlike click
    $(".butlike").click(function(){
        let id = this.id;   // Getting Button id
        let split_id = id.split("_");

        let text = split_id[0];
        let postid = split_id[1];  // postid

        let request = new XMLHttpRequest();
      	request.onreadystatechange = function(){
        if((request.readyState==4) && (request.status==200)){
            $('#col_'+postid).html(this.responseText);
            alert(this.responseText);
          }
        }
        request.open('GET','likeunlike.php?id=' + postid, true);
        request.send();
        

    
</script>