<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
include "database.php";
global $conn;



function activeOrders(){

    include "database.php";
    global $conn;

    $user = $_SESSION["id"];


    $query = mysqli_query($conn, "SELECT courier, t1.adress, cost, date, status.status_name FROM orders as t1 LEFT JOIN users t2 ON t1.user_id = t2.user_id LEFT JOIN status on t1.status = status.id_status WHERE t1.status != 3 AND t1.user_id = '$user'");

    while($row = mysqli_fetch_assoc($query)){

    $courier = $row["courier"];


    $queryGetCourier = mysqli_query($conn, "SELECT name, phone FROM users WHERE user_id = '$courier'");
    $rowCourier = mysqli_fetch_assoc($queryGetCourier);

    echo '
    <tr  id = "">
            <td>'.$rowCourier["name"].'</td>        
            <td>'.$rowCourier["phone"].'</td>
            <td>'.$row["adress"].'</td>
            <td>'.$row["cost"].'</td>
            <td>'.$row["date"].'</td>
            <td>'.$row["status_name"].'</td>
        </tr>     

        ';
    }



}

function allOrders(){

    include "database.php";
    global $conn;

    $user = $_SESSION["id"];


    $query = mysqli_query($conn, "SELECT courier, t1.adress, cost, date, status.status_name FROM orders as t1 LEFT JOIN users t2 ON t1.user_id = t2.user_id LEFT JOIN status on t1.status = status.id_status WHERE  t1.user_id = '$user'");

while($row = mysqli_fetch_assoc($query)){

    $courier = $row["courier"];


    $queryGetCourier = mysqli_query($conn, "SELECT name, phone FROM users WHERE user_id = '$courier'");
    $rowCourier = mysqli_fetch_assoc($queryGetCourier);

    echo '
    <tr  id = "">
            <td>'.$rowCourier["name"].'</td>        
            <td>'.$rowCourier["phone"].'</td>
            <td>'.$row["adress"].'</td>
            <td>'.$row["cost"].'</td>
            <td>'.$row["date"].'</td>
            <td>'.$row["status_name"].'</td>
        </tr>     

        ';
    }



}

?>