<?php 
	require_once __DIR__. "/autoload/autoload.php"; 
	$user = $db->fetchID("users", intval($_SESSION['name_id']));
	//_debug($user);

	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$data =
		[
			'amount' => $_SESSION['total'], //amount: tổng số tiền, total: nằm bên trang giỏ hàng
			'users_id' => $_SESSION['name_id'], //users_id nằm trong database (trancition)
			'note' => postInput("note")
		];
		//_debug($data);

		//lưu vào database (trancision)
		$idtran = $db->insert("transaction", $data); //$idtran nằm trong database (trancition) dữ liệu là id
		if ($idtran > 0)
		{
			foreach ($_SESSION['cart'] as $key => $value) //id sản phẩm
			{
				$data2 = //thực hiện bên trang order
				[
					'transaction_id' => $idtran, //trancision_id nằm trong database (order)
					'product_id'    => $key, //$key là id sản phẩm
					'qty'           => $value['soluong'],
					'price'         => $value['price']
				];

				$id_insert = $db->insert("orders", $data2);
			}
            
			$_SESSION['success'] = "Lưu thông tin đơn hàng thành công! Chúng tôi sẽ liên hệ với bạn sớm nhất!";
			header("location: thong-bao.php");
		}
	}
?>
<?php require_once __DIR__. "/layouts/header.php"; ?>
    <div class="col-md-9 bor">

        <section class="box-main1">
            <h3 class="title-main"><a href=""> Thanh toán đơn hàng </a> </h3>
            
            <form action="" method="POST" class="form-horizontal formcustome" role="form" style="margin-top: 20px">
        		<div class="form-group">
    				<label class="col-md-2 col-md-offset-1">Tên thành viên</label>
    				<div class="col-md-8">
    					<input type="text" readonly="" name="name" placeholder=" Đào Phú Nghĩa" class="form-control" value="<?php echo $user['name'] ?>"> <!-- value="<?php echo $name ?>"> - cách 2 -->
    				</div>
        		</div>
        		<div class="form-group">
    				<label class="col-md-2 col-md-offset-1">Email</label>
    				<div class="col-md-8">
    					<input type="email" readonly="" name="email" placeholder=" daophunghia0907@gmail.com" class="form-control" value="<?php echo $user['email'] ?>">
    				</div>
        		</div>
        		<div class="form-group">
    				<label class="col-md-2 col-md-offset-1">Số điện thoại</label>
    				<div class="col-md-8">
    					<input type="phone" readonly="" name="phone" placeholder="0903276742" class="form-control" value="<?php echo $user['phone'] ?>">
    				</div>
        		</div>
        		<div class="form-group">
    				<label class="col-md-2 col-md-offset-1">Địa chỉ</label>
    				<div class="col-md-8">
    					<input type="text" readonly="" name="address" placeholder="LA" class="form-control" value="<?php echo $user['address'] ?>">
    				</div>
        		</div>
        		<div class="form-group">
    				<label class="col-md-2 col-md-offset-1">Số tiền thanh toán</label>
    				<div class="col-md-8">
    					<input type="text" readonly="" name="address" placeholder="LA" class="form-control" value="<?php echo formatPrice($_SESSION['total']) ?>">
    				</div>
        		</div>
        		<div class="form-group">
    				<label class="col-md-2 col-md-offset-1">Ghi chú</label>
    				<div class="col-md-8">
    					<input type="text" name="note" placeholder="Giao hàng đúng hẹn" class="form-control">
    				</div>
        		</div>

        		<button type="submit" class="btn btn-success col-md-2 col-md-offset-9" style="margin-bottom: 20px">Xác nhận</button>

            </form>
            
        </section>

    </div>
<?php require_once __DIR__. "/layouts/footer.php"; ?>
                	