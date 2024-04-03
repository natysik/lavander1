<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
include "database.php";
global $conn;


$order_numb = $_POST['order_num'];
$courier = $_SESSION['id'];



$query = mysqli_query($conn, "UPDATE orders SET status = '2', courier = '$courier' WHERE orders.order_number = '$order_numb';");

$query = mysqli_query($conn, "UPDATE orders_nologin SET status = '2', courier = '$courier' WHERE orders_nologin.order_number = '$order_numb';");


?>