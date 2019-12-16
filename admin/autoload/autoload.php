<?php
	session_start();
	require_once __DIR__. "/../../libraries/Database.php";
	require_once __DIR__. "/../../libraries/Function.php";
	$db = new Database; //khởi tạo

	if (!isset($_SESSION['admin_id']))
	{
		header("location: /tutphp/login/");
	}

	define("ROOT", $_SERVER['DOCUMENT_ROOT'] ."/tutphp/public/uploads/");

?>