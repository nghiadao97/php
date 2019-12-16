<?php
	require_once __DIR__. "/autoload/autoload.php"; 
    //đăng nhập rồi mới cho phép mua hàng
    if (!isset($_SESSION['name_user']))
    {
        echo "<script>alert(' Bạn phải đăng nhập mới thực hiện được chức năng này '); location.href='index.php'</script>";
    }

    $id = intval(getInput('id'));	

    //Chi tiết sản phẩm
    $product = $db->fetchID("product",$id); //lấy sản phẩm theo id
    //_debug($product);

    //kiem tra nếu tồn tại giỏ hàng thì cập nhật giỏ hàng
    //
    //ngược lại thì tạo mới
    if ( ! isset($_SESSION['cart'][$id])) //$id của sản phẩm trong giỏ hàng nếu chưa có thì tạo mới
    {
    	//tạo mới giỏ hàng
    	$_SESSION['cart'][$id]['name']    = $product['name'];
    	$_SESSION['cart'][$id]['thunbar'] = $product['thunbar'];
    	$_SESSION['cart'][$id]['soluong'] = 1;
    	$_SESSION['cart'][$id]['price']   = ((100 - $product['sale']) * $product['price'])/100;
    }
    else
    {
    	//cập nhật lại giỏ hàng
    	$_SESSION['cart'][$id]['soluong'] += 1; //giỏ hàng đã tồn tại sản phẩm có id đó thì nó sẽ tăng số lượng lên
    }

    echo "<script>alert(' Thêm sản phẩm thành công '); location.href='gio-hang.php'</script>";

?>

