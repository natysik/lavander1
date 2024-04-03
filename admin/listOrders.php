<?php
include "database.php";

global $conn;
$query = mysqli_query($conn, "SELECT `order_number`, `name`, `cost`, `date`,  status.status_name 
FROM `orders` as t1 LEFT JOIN users t2 ON t1.user_id = t2.user_id
LEFT JOIN status on t1.status = status.id_status
UNION
SELECT order_number, '', cost, date,  status.status_name 
FROM orders_nologin as t1 LEFT JOIN status on t1.status = status.id_status");

while($row = mysqli_fetch_assoc($query)){


	echo '
	<tr>
        	<td>'.$row["order_number"].'</td>        
        	<td>'.$row["name"].'</td>
        	<td>'.$row["cost"].'</td>
        	<td>'.$row["date"].'</td>
        	<td>'.$row["status_name"].'</td>
    	</tr>     

		';
	}

?>