
<?php
    $open = "product";
  require_once __DIR__. "/../../autoload/autoload.php";
  

    /**
     * danh sách danh mục sản phẩm
     */

    $id = intval(getInput('id'));
  
    $Editproduct = $db -> fetchID("product",$id);
    if (empty($Editproduct))
    {
        $_SESSION['error'] = " Dữ liệu không tồn tại ";
        redirectAdmin("product");
    }

    $category = $db->fetchAll("category");

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
            "slug"        => to_slug(postInput("name")),
            "category_id" => postInput("category_id"),
            "price"       => postInput("price"),
            "number"      => postInput("number"),
            "content"     => postInput("content"),
            "sale"        => postInput("sale")
        ];

        $error = [];

        if(postInput('name') == '')
        {
            $error['name'] = "Mời bạn nhập đầy đủ tên danh mục";
        }

        if(postInput('category_id') == '')
        {
            $error['category_id'] = "Mời bạn chọn tên danh mục";
        }

        if(postInput('price') == '')
        {
            $error['price'] = "Mời bạn nhập giá sản phẩm";
        }

        if(postInput('content') == '')
        {
            $error['content'] = "Mời bạn nhập nội dung sản phẩm";
        }

        if(postInput('number') == '')
        {
            $error['number'] = "Mời bạn nhập số lượng sản phẩm";
        }

        //error trống có nghĩa là không có lỗi
        //fetchOne: lấy cái bảng ghi
        if(empty($error))
        {
            if (isset($_FILES['thunbar']))
            {
                $file_name = $_FILES['thunbar']['name'];
                $file_tmp = $_FILES['thunbar']['tmp_name'];
                $file_type = $_FILES['thunbar']['type'];
                $file_erro = $_FILES['thunbar']['error'];

                if ($file_erro == 0)
                {
                    $part = ROOT ."product/"; // đường dẫn đến upload
                    $data['thunbar'] = $file_name; //lấy tên của ảnh để lưu vào csdl
                }
            }             
            $update = $db->update("product", $data, array("id"=>$id));
            if ($update > 0)
                {
                    move_uploaded_file($file_tmp, $part.$file_name); //di chuyển file
                    $_SESSION['success'] = " Cập nhật thành công ";  //thông báo ra trang category - $_SESSION: khai báo bên autoload để dùng
                    redirectAdmin("product");
                }
                else
                {
                    $_SESSION['error'] = " Cập nhật thất bại "; 
                    redirectAdmin("product");
                }
        }

    }

?>

<?php require_once __DIR__. "/../../layouts/header.php"; ?>
    <div id="content-wrapper">
        <div class="container-fluid">
          <!-- Page Content -->
            <h1>Thêm mới sản phẩm</h1>
            <hr>
            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="index.html">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="">Sản phẩm</a>
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
                          <label for="exampleInputEmail1">Danh mục sản phẩm</label>
                          <select class="form-control" name="category_id">
                              <option value=""> - Mời bạn chọn danh mục sản phẩm - </option>
                              <?php foreach ($category as $item): ?>
                                  <option value="<?php echo $item['id'] ?>" <?php echo $Editproduct['category_id'] == $item['id'] ? "selected = 'selected'" : ''?>><?php echo $item['name'] ?></option>
                              <?php endforeach ?>
                          </select>
                          <!-- Kiểm tra rồi báo cho người dùng biết lỗi đó -->
                          <?php if(isset($error['category_id'])): ?>
                            <p class="text-danger"> <?php echo $error['category_id'] ?> </p> 
                          <?php endif ?>

                       </div>
                       <div class="form-group">
                          <label for="exampleInputEmail1">Tên sản phẩm</label>
                          <input name="name" type="text" id="inputEmail3" class="form-control" placeholder="Tên danh mục" value="<?php echo $Editproduct['name']?>" >
                          <!-- Kiểm tra rồi báo cho người dùng biết lỗi đó -->
                          <?php if(isset($error['name'])): ?>
                            <p class="text-danger"> <?php echo $error['name'] ?> </p> 
                          <?php endif ?>

                       </div>   
                       <div class="form-group">
                          <label for="exampleInputEmail1">Giá sản phẩm</label>
                          <input name="price" type="number" id="inputEmail3" class="form-control" placeholder="9.000.000" value="<?php echo $Editproduct['price']?>" >
                          <!-- Kiểm tra rồi báo cho người dùng biết lỗi đó -->
                          <?php if(isset($error['price'])): ?>
                            <p class="text-danger"> <?php echo $error['price'] ?> </p> 
                            <?php endif ?>

                       </div> 
                       <div class="form-group">
                          <label for="exampleInputEmail1">Số lượng</label>
                          <input name="number" type="number" id="inputEmail3" class="form-control" placeholder="100" value="<?php echo $Editproduct['number']?>">
                          <!-- Kiểm tra rồi báo cho người dùng biết lỗi đó -->
                          <?php if(isset($error['number'])): ?>
                            <p class="text-danger"> <?php echo $error['number'] ?> </p> 
                            <?php endif ?>

                       </div> 
                       <div class="form-group">
                          <label for="exampleInputEmail1">Giảm giá</label>
                            <input name="sale" type="number" id="inputEmail3" class="form-control" placeholder="10 %" value="<?php echo $Editproduct['sale']?>">

                          <label for="inputEmail3">Hình ảnh</label>
                            <input name="thunbar" type="file" id="inputEmail3" class="form-control">
                            <!-- Kiểm tra rồi báo cho người dùng biết lỗi đó -->
                            <?php if(isset($error['thunbar'])): ?>
                              <p class="text-danger"> <?php echo $error['thunbar'] ?> </p> 
                              <?php endif ?>
                            <img src="<?php echo uploads() ?>product/<?php echo $Editproduct['thunbar'] ?>" width="50px" height="50px">
                       </div> 
                       <div class="form-group">
                          <label for="exampleInputEmail1">Nội dung</label>
                          <textarea class="form-control" name="content" rows="4"><?php echo $Editproduct['content']?></textarea>
                          <!-- Kiểm tra rồi báo cho người dùng biết lỗi đó -->
                          <?php if(isset($error['content'])): ?>
                            <p class="text-danger"> <?php echo $error['content'] ?> </p> 
                            <?php endif ?>

                       </div>
                       <button type="submit" class="btn btn-success">Lưu</button> 
                    </form>
                </div>
            </div>
        </div>
    </div>


<?php require_once __DIR__. "/../../layouts/footer.php"; ?>            