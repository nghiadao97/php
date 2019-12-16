<?php 
	session_start();
	unset($_SESSION['name_user']);
	unset($_SESSION['name_user']);

	header("location: index.php");
?>