
<?php
    $open = "admin";
	  require_once __DIR__. "/../../autoload/autoload.php";
	
    $id = intval(getInput('id'));
  
    $EditAdmin = $db -> fetchID("admin",$id);
    if (empty($EditAdmin))
    {
        $_SESSION['error'] = " Dữ liệu không tồn tại ";
        redirectAdmin("admin");
    }

    /**
     * danh sách danh mục sản phẩm
     */

    if ($_SERVER["REQUEST_METHOD"] == "POST") //kiểm tra phương thức POST
    {
        //Cách 1:
        // if(isset($_POST['name']) && $_POST['name'] != NULL) //nếu tồn tại phương thức POST
        // {
        //     $name = $_POST['name'];
        // }
        // echo $name;

        //Cách 2: dùng function
        // $name = postInput("name");
        // echo $name;

        //Cách 3:
        $data =
        [
            "name"        => postInput('name'),
            "email"       => postInput("email"),
            "phone"       => postInput("phone"),
            "address"     => postInput("address"),
            "level"       => postInput("level")
        ];

        $error = [];

        if(postInput('name') == '')
        {
            $error['name'] = "Mời bạn nhập đầy đủ họ và tên";
        }

        if(postInput('email') == '')
        {
            $error['email'] = "Mời bạn nhập email";
        }
        else
        {
          if (postInput('email') != $EditAdmin['email']){
            $is_check = $db->fetchOne("admin","email = '".$data['email']."' ");
            if ($is_check != NULL)
            {
              $error['email'] = "Email đã tồn tại";
            }
          }
        }

        if(postInput('phone') == '')
        {
            $error['phone'] = "Mời bạn nhập số điện thoại";
        }

        if(postInput('address') == '')
        {
            $error['address'] = "Mời bạn nhập địa chỉ";
        }

        if (postInput('password') != NULL && postInput('re_password') != NULL)
        {
            if (postInput('password') != postInput('re_password'))
            {
                $error['password'] = "Mật khẩu thay đổi không hợp lệ";
            }
            else
            {
                $data['password'] = MD5(postInput(password));
            }
        }

        //error trống có nghĩa là không có lỗi
        //fetchOne: lấy cái bảng ghi
        if(empty($error))
        {      

          $id_update = $db->update("admin", $data, array("id"=>$id));
          if ($id_update > 0)
              {
                  $_SESSION['success'] = " Cập nhật thành công ";  //thông báo ra trang product - $_SESSION: khai báo bên autoload để dùng
                  redirectAdmin("admin");
              }
              else
              {
                  $_SESSION['error'] = " Cập nhật thất bại "; 
                  redirectAdmin("admin");
              }
        }

    }

?>

<?php require_once __DIR__. "/../../layouts/header.php"; ?>
    <div id="content-wrapper">
        <div class="container-fluid">
        	<!-- Page Content -->
            <h1>Thêm mới Admin</h1>
            <hr>
            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="index.html">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="">admin</a>
                </li>
                <li class="breadcrumb-item active">
                    <i class="fa fa-file"></i> Thêm mới
                </li>
            </ol>
            <div class="clearfix"></div>
            <?php 
                $retVal = (isset($_SESSION['error'])) ? $_SESSION['error'] : '' ;
                ?>
                  <div class="alert alert-danger">
                  <?php echo $retVal; unset($_SESSION['error']); ?>
                  </div>
                <?php 
            ?>
            <div class="row">
                <div class="col-md-6">
                    <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data"> <!-- Muốn upload được ảnh cần có enctype="multipart/form-data" -->

                       <div class="form-group">
                          <label for="exampleInputEmail1">First and Last name </label>
                          <input name="name" type="text" id="inputEmail3" class="form-control" placeholder="Ken_Đ" value="<?php echo $EditAdmin['name']?>">
                          <!-- Kiểm tra rồi báo cho người dùng biết lỗi đó -->
                          <?php if(isset($error['name'])): ?>
                            <p class="text-danger"> <?php echo $error['name'] ?> </p> 
                          <?php endif ?>

                       </div>   
                       <div class="form-group">
                          <label for="exampleInputEmail1">Email</label>
                          <input name="email" type="text" id="inputEmail3" class="form-control" placeholder="daophunghia0907@gmail.com" value="<?php echo $EditAdmin['email']?>">
                          <!-- Kiểm tra rồi báo cho người dùng biết lỗi đó -->
                          <?php if(isset($error['email'])): ?>
                            <p class="text-danger"> <?php echo $error['email'] ?> </p> 
                            <?php endif ?>

                       </div> 
                       <div class="form-group">
                          <label for="exampleInputEmail1">Phone</label>
                          <input name="phone" type="number" id="inputEmail3" class="form-control" placeholder="0903276742" value="<?php echo $EditAdmin['phone']?>" >
                          <!-- Kiểm tra rồi báo cho người dùng biết lỗi đó -->
                          <?php if(isset($error['phone'])): ?>
                            <p class="text-danger"> <?php echo $error['phone'] ?> </p> 
                            <?php endif ?>

                       </div> 
                       <div class="form-group">
                          <label for="exampleInputEmail1">Password</label>
                          <input name="password" type="password" id="inputEmail3" class="form-control" placeholder="********" >
                          <!-- Kiểm tra rồi báo cho người dùng biết lỗi đó -->
                          <?php if(isset($error['password'])): ?>
                            <p class="text-danger"> <?php echo $error['password'] ?> </p> 
                            <?php endif ?>

                       </div> 
                       <div class="form-group">
                          <label for="exampleInputEmail1">CofigPassword</label>
                          <input name="re_password" type="password" id="inputEmail3" class="form-control" placeholder="********">
                          <!-- Kiểm tra rồi báo cho người dùng biết lỗi đó -->
                          <?php if(isset($error['re_password'])): ?>
                            <p class="text-danger"> <?php echo $error['re_password'] ?> </p> 
                            <?php endif ?>

                       </div> 
                       <div class="form-group">
                          <label for="exampleInputEmail1">Address </label>
                          <input name="address" type="text" id="inputEmail3" class="form-control" placeholder="296 ấp Long Giêng, xã Phước Hậu, huyện Cần Giuộc, tỉnh Long An" value="<?php echo $EditAdmin['address']?>">
                          <!-- Kiểm tra rồi báo cho người dùng biết lỗi đó -->
                          <?php if(isset($error['address'])): ?>
                            <p class="text-danger"> <?php echo $error['address'] ?> </p> 
                          <?php endif ?>

                       </div>  
                      <div class="form-group">
                          <label for="exampleInputEmail1">Level </label>
                          <select class="form-control" name="level">
                            <option value="1" <?php echo isset($EditAdmin['level']) && $EditAdmin['level'] == 1 ? "selected = 'selected'" : ''?>> CTV</option>
                            <option value="2" <?php echo isset($EditAdmin['level']) && $EditAdmin['level'] == 2 ? "selected = 'selected'" : ''?>> Admin</option>
                          </select>
                          <!-- Kiểm tra rồi báo cho người dùng biết lỗi đó -->
                          <?php if(isset($error['level'])): ?>
                            <p class="text-danger"> <?php echo $error['level'] ?> </p> 
                          <?php endif ?>

                       </div>  
                       <button type="submit" class="btn btn-success">Lưu</button> 
                    </form>
                </div>
            </div>
        </div>
    </div>


<?php require_once __DIR__. "/../../layouts/footer.php"; ?>            