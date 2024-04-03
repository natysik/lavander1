<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();

if($_SESSION['id'] == 3){

	unset($_SESSION['login']);
	unset($_SESSION['id']);
	unset($_SESSION['role']);

	
}
else{
	unset($_SESSION['login']);
	unset($_SESSION['id']);
	unset($_SESSION['role']);

	print "<script language='Javascript' type='text/javascript'> 
                function reload(){}; 
                setTimeout('reload()', 0) 
            </script>";
}

?>