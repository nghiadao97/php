<?php 
	require_once __DIR__. "/autoload/autoload.php"; 

    $data = 
    [
        'name'     => postInput("name"),
        'password' => postInput("password")
    ];
	
    $error = [];
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if($data['name'] == '')
        {
            $error['name'] = "Tên không được để trống !";
        }
        if($data['password'] == '')
        {
            $error['password'] = "Mật khẩu không được để trống !";
        }
        if(empty($error))
        {
            $is_check = $db->fetchOne("users", "name ='".$data['name']."' AND password ='".MD5($data['password'])."' ");
            //_debug($is_check);
            if($is_check != NULL)
            {
                $_SESSION['name_user'] = $is_check['name']; //Lưu lại tên
                $_SESSION['name_id'] = $is_check['id'];
                echo "<script>alert(' Đăng nhập thành công '); location.href='index.php'</script>";
            }
            else
            {
                $_SESSION['error'] = " Đăng nhập thất bại ";
            }
        }

    }

?>
<?php require_once __DIR__. "/layouts/header.php"; ?>
    <div class="col-md-9 bor">

        <section class="box-main1">
            <h3 class="title-main" style="text-align: center;"><a href=""> Đăng nhập </a> </h3>
            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success">
                    <strong style="color: #3c763d">Success!</strong> <?php echo $_SESSION['success']; unset($_SESSION['success'])?>
                </div>
            <?php endif ?>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger">
                    <strong style="color: #fe0404">Error!</strong> <?php echo $_SESSION['error']; unset($_SESSION['error'])?>
                </div>
            <?php endif ?>

            <form action="" method="POST" class="form-horizontal formcustome" role="form" style="margin-top: 20px">
        		<div class="form-group">
    				<label class="col-md-2 col-md-offset-1">Tên thành viên</label>
    				<div class="col-md-8">
    					<input type="text" name="name" placeholder=" Đào Phú Nghĩa" class="form-control">
                        <?php if(isset($error['name'])): ?>
                            <p class="text-danger"> <?php echo $error['name'] ?> </p> 
                        <?php endif ?>
    				</div>
        		</div>
        		<div class="form-group">
    				<label class="col-md-2 col-md-offset-1">Mật khẩu</label>
    				<div class="col-md-8">
    					<input type="password" name="password" placeholder="********" class="form-control">
                        <?php if(isset($error['password'])): ?>
                            <p class="text-danger"> <?php echo $error['password'] ?> </p> 
                        <?php endif ?>
    				</div>
        		</div>

        		<button type="submit" class="btn btn-success col-md-2 col-md-offset-9" style="margin-bottom: 20px">Đăng nhập</button>

            </form>
            
        </section>

    </div>
<?php require_once __DIR__. "/layouts/footer.php"; ?>
                