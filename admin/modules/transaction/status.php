<?php
	$open = "transaction";
	require_once __DIR__. "/../../autoload/autoload.php";

    $id = intval(getInput('id'));

    $EditTransaction = $db -> fetchID("transaction",$id);
    //_debug($EditCategory); die;
    if (empty($EditTransaction)) //empty là nếu nó trống
    {
        $_SESSION['error'] = " Dữ liệu không tồn tại ";
        redirectAdmin("transaction");
    }

    if ($EditTransaction['status'] == 1)
    {
        $_SESSION['error'] = " Đơn hàng đã được xử lý rồi!!! ";
        redirectAdmin("transaction");
    }
    $status = 1;
    
    $update = $db->update("transaction", array("status" => $status), array("id" => $id));
    if ($update > 0)
    {
        $_SESSION['success'] = " Cập nhật thành công ";  //thông báo ra trang category - $_SESSION: khai báo bên autoload để dùng

        //giảm số lượng sản phẩm để biết khi nào hết hàng
        $sql = " SELECT product_id, qty FROM orders WHERE transaction_id = $id ";
        $Order = $db->fetchsql($sql);
        //_debug($Order);die;
        foreach ($Order as $item) {
            $idproduct = intval($item['product_id']);
            $product = $db->fetchID("product", $idproduct);
            $number = $product['number'] - $item['qty'];
            //_debug($number);
            $up_product = $db->update("product",array("number" => $number, "pay" => $product['pay'] + 1), array("id" => $idproduct)); //pay là số sản phẩm mua nhiều nó tăng lên trên database (product)
        }
        redirectAdmin("transaction");
    }
    else
    {
        $_SESSION['error'] = " Dữ liệu không thay đổi "; 
        redirectAdmin("transaction");
    }

?>