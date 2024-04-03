<?php
include "database.php";
global $conn;
if(session_status()!=PHP_SESSION_ACTIVE) session_start();

$name = $_POST["name"];

echo $name;





?>