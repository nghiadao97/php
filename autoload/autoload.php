<?php
	session_start();
	require_once __DIR__. "/../libraries/Database.php";
	require_once __DIR__. "/../libraries/Function.php";
	$db = new Database; //khởi tạo

	define("ROOT", $_SERVER['DOCUMENT_ROOT'] ."/tutphp/public/uploads/");



	$category = $db->fetchAll("category");

	/**
	 * lấy danh sách sản phẩm mới
	 */
	$sqlNew = "SELECT * FROM product WHERE 1 ORDER BY ID DESC LIMIT 4";
	$productNew = $db->fetchsql($sqlNew);

	/**
	 * lấy danh sách sản phẩm bán chạy
	 */
	$sqlPay = "SELECT * FROM product WHERE 1 ORDER BY PAY DESC LIMIT 4";
	$productPay = $db->fetchsql($sqlPay);
?>