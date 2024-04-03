<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();

include "database.php";
global $conn;

$bouquet_id = $_POST["bouquet_id"];
$user_id = $_SESSION['id'];

$query_forId = mysqli_query($conn, "SELECT id as id FROM favorites WHERE id=(SELECT max(id) FROM favorites)");
$row = mysqli_fetch_assoc($query_forId);
$id = $row["id"] + 1;

$query = mysqli_query($conn, "INSERT INTO `favorites`(`id`, `bouquet_id`, `user_id`) VALUES ('$id','$bouquet_id','$user_id')");


$query_favorites = mysqli_query($conn, "SELECT COUNT(*) as res FROM favorites WHERE bouquet_id = '$bouquet_id'");
echo mysqli_fetch_assoc($query_favorites)["res"] ;
?>



