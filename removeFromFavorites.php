<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();

include "database.php";
global $conn;

$bouquet_id = $_POST["bouquet_id"];
$user_id = $_SESSION['id'];

$query = mysqli_query($conn, "DELETE FROM `favorites` WHERE `bouquet_id` = '$bouquet_id' AND `user_id` = '$user_id'");

$query_favorites = mysqli_query($conn, "SELECT COUNT(*) as res FROM favorites WHERE bouquet_id = '$bouquet_id'");
echo mysqli_fetch_assoc($query_favorites)["res"] ;
?>
