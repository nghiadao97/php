<?php

	require_once __DIR__. "/autoload/autoload.php"; 
	$key = intval(getInput("key")); //lấy $key của sản phẩm cần sửa
	$soluong = intval(getInput("soluong")); 

	$_SESSION['cart'][$key]['soluong'] = $soluong; //số lượng vừa lấy được

	echo 1;
	
?>	