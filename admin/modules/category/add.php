
<?php
    $open = "category";
	require_once __DIR__. "/../../autoload/autoload.php";
	
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
            "name" => postInput('name'),
            "slug" => to_slug(postInput("name"))
        ];

        $error = [];

        if(postInput('name') == '')
        {
            $error['name'] = "Mời bạn nhập đầy đủ tên danh mục";
        }

        //error trống có nghĩa là không có lỗi
        //fetchOne: lấy cái bảng ghi
        if(empty($error))
        {
            $isset = $db->fetchOne("category", " name = '".$data['name']."' " );
            if (count($isset)>0)
            {
                $_SESSION['error'] = " Tên danh mục đã tồn tại ! ";
            }
            else
            {
                $id_insert = $db->insert("category", $data); //thêm thành công nó trả về $id_insert
                if ($id_insert > 0)
                {
                    $_SESSION['success'] = " Thêm mới thành công ";  //thông báo ra trang category - $_SESSION: khai báo bên autoload để dùng
                    redirectAdmin("category");
                }
                else
                {
                    $_SESSION['error'] = " Thêm mới thất bại "; 
                }
            }           
        }

    }

?>

<?php require_once __DIR__. "/../../layouts/header.php"; ?>
    <div id="content-wrapper">
        <div class="container-fluid">
        	<!-- Page Content -->
            <h1>Thêm mới danh mục</h1>
            <hr>
            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="index.html">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="">Danh mục</a>
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
                <div class="col-md-8">
                    <form class="form-horizontal" action="" method="POST">
                       <div class="form-group">
                          <label for="exampleInputEmail1">Tên danh mục</label>
                          <input name="name" type="text" class="form-control" placeholder="Tên danh mục" >
                          <!-- Kiểm tra rồi báo cho người dùng biết lỗi đó -->
                          <?php if(isset($error['name'])): ?>
                            <p class="text-danger"> <?php echo $error['name'] ?> </p> 
                            <?php endif ?>

                       </div>   
                       <button type="submit" class="btn btn-success">Lưu</button> 
                    </form>
                </div>
            </div>
        </div>
    </div>


<?php require_once __DIR__. "/../../layouts/footer.php"; ?>            