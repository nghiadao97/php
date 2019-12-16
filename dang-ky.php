<?php 
	require_once __DIR__. "/autoload/autoload.php"; 
    //đăng nhập rồi không cho phép vào trang đăng ký nữa
    if (isset($_SESSION['name_user']))
    {
        echo "<script>alert(' Bạn đã có tài khoản nên không thể vào đây '); location.href='index.php'</script>";
    }

 //    //kết nối database trực tiếp tại trang - cách 2:
 //    $conn = mysqli_connect("localhost","root","","tutphp");
 //    if(mysqli_connect_errno())
 //    {
 //        echo "Failed to connet to MySQL: " . mysqli_connect_errno();
 //    }
 //    //phong chữ
 //    mysqli_set_charset($conn,"utf8");
	
	// //Xử lý 
 //    $name = $email = $password = $address = $phone = '';
 //    $error = [];

    $data = 
    [
        'name'     => postInput("name"),
        'email'    => postInput("email"),
        'password' => postInput("password"),
        'address'  => postInput("address"),
        'phone'    => postInput("phone")
    ];

    $error = [];
    if ($_SERVER["REQUEST_METHOD"] == "POST") //tồn tại phương thức POST
    {
        //tiến hành validete và đăng ký - cách 2
        // if (isset($_POST['name']) && $_POST['name'] != NULL)
        // {
        //     $name = $_POST['name'];
        // }
        // if ($name == '')
        // {
        //     $error['name'] = "Tên không được để trống !";
        // }

        // if (isset($_POST['email']) && $_POST['email'] != NULL)
        // {
        //     $email = $_POST['email'];
        // }
        // if ($email == '')
        // {
        //     $error['email'] = "Email không được để trống !";
        // }

        // if (isset($_POST['password']) && $_POST['password'] != NULL)
        // {
        //     $password = $_POST['password'];
        // }
        // if ($password == '')
        // {
        //     $error['password'] = "Password không được để trống !";
        // }

        // if (isset($_POST['phone']) && $_POST['phone'] != NULL)
        // {
        //     $phone = $_POST['phone'];
        // }
        // if ($phone == '')
        // {
        //     $error['phone'] = "Số điện thoại không được để trống !";
        // }

        // if (isset($_POST['address']) && $_POST['address'] != NULL)
        // {
        //     $address = $_POST['address'];
        // }
        // if ($address == '')
        // {
        //     $error['address'] = "Address không được để trống !";
        // }
        if($data['name'] == '')
        {
            $error['name'] = "Tên không được để trống !";
        }

        if($data['email'] == '')
        {
            $error['email'] = "Email không được để trống !";
        }
        else
        {
            $is_check = $db->fetchOne("users","email = '".$data['email']."' ");
            if ($is_check != NULL)
            {
              $error['email'] = "Email đã tồn tại mời bạn nhập địa chỉ email khác";
            }
        }

        if($data['password'] == '')
        {
            $error['password'] = "Mật khẩu không được để trống !";
        }
        else
        {
            $data['password'] = MD5(postInput('password'));
        }

        if($data['address'] == '')
        {
            $error['address'] = "Địa chỉ không được để trống !";
        }

        if($data['phone'] == '')
        {
            $error['phone'] = "Số điện thoại không được để trống !";
        }

        //kiểm tra mảng error
        if(empty($error))
        {      
            //thêm dữ liệu không dùng hàm có sẵn - cách 2
            // $sql = " INSERT INTO users(name,email,password,phone,address) VALUES ('".$name."','".$email."','".MD5($password)."','".$phone."','".$address."')";
            // $insert = mysqli_query($conn,$sql) or die (" Thêm mới thất bại ");
            $idinsert = $db->insert("users", $data);
            if ($idinsert > 0)
            {
                $_SESSION['success'] = " Đăng ký thành công ! Mời bạn đăng nhập !!! ";
                header("location: dang-nhap.php");
            }
            else
            {
                
            }
        }

    }

?>
<?php require_once __DIR__. "/layouts/header.php"; ?>
    <div class="col-md-9 bor">

        <section class="box-main1">
            <h3 class="title-main" style="text-align: center;"><a href=""> Đăng ký thành viên </a> </h3>
            
            <form action="" method="POST" class="form-horizontal formcustome" role="form" style="margin-top: 20px">
        		<div class="form-group">
    				<label class="col-md-2 col-md-offset-1">Tên thành viên</label>
    				<div class="col-md-8">
    					<input type="text" name="name" placeholder=" Đào Phú Nghĩa" class="form-control" value="<?php echo $data['name'] ?>"> <!-- value="<?php echo $name ?>"> - cách 2 -->
                        <?php if(isset($error['name'])): ?>
                            <p class="text-danger"> <?php echo $error['name'] ?> </p> 
                        <?php endif ?>
    				</div>
        		</div>
        		<div class="form-group">
    				<label class="col-md-2 col-md-offset-1">Email</label>
    				<div class="col-md-8">
    					<input type="email" name="email" placeholder=" daophunghia0907@gmail.com" class="form-control" value="<?php echo $data['email'] ?>">
                        <?php if(isset($error['email'])): ?>
                            <p class="text-danger"> <?php echo $error['email'] ?> </p> 
                        <?php endif ?>
    				</div>
        		</div>
        		<div class="form-group">
    				<label class="col-md-2 col-md-offset-1">Mật khẩu</label>
    				<div class="col-md-8">
    					<input type="password" name="password" placeholder="********" class="form-control" value="<?php echo $data['password'] ?>">
                        <?php if(isset($error['password'])): ?>
                            <p class="text-danger"> <?php echo $error['password'] ?> </p> 
                        <?php endif ?>
    				</div>
        		</div>
        		<div class="form-group">
    				<label class="col-md-2 col-md-offset-1">Số điện thoại</label>
    				<div class="col-md-8">
    					<input type="phone" name="phone" placeholder="0903276742" class="form-control" value="<?php echo $data['phone'] ?>">
                        <?php if(isset($error['phone'])): ?>
                            <p class="text-danger"> <?php echo $error['phone'] ?> </p> 
                        <?php endif ?>
    				</div>
        		</div>
        		<div class="form-group">
    				<label class="col-md-2 col-md-offset-1">Địa chỉ</label>
    				<div class="col-md-8">
    					<input type="text" name="address" placeholder="LA" class="form-control" value="<?php echo $data['address'] ?>">
                        <?php if(isset($error['address'])): ?>
                            <p class="text-danger"> <?php echo $error['address'] ?> </p> 
                        <?php endif ?>
    				</div>
        		</div>

        		<button type="submit" class="btn btn-success col-md-2 col-md-offset-9" style="margin-bottom: 20px">Đăng ký</button>

            </form>
            <!-- noi dung -->
        </section>

    </div>
<?php require_once __DIR__. "/layouts/footer.php"; ?>
                