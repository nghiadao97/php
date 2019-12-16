<?php
  $open = "product";
  require_once __DIR__. "/../../autoload/autoload.php";
  //fetchAll: lấy tất cả
  $product = $db -> fetchAll('product');

  //Phân trang
  if (isset($_GET['page']))
  {
    $p = $_GET['page'];
  }
  else
  {
    $p=1;
  }
  $sql = "SELECT product.*,category.name as namecate FROM product LEFT JOIN category on category.id = product.category_id";
  $product = $db->fetchJone('product', $sql, $p, 5, true);
  if (isset($product['page']))
  {
    $sotrang = $product['page'];
    unset($product['page']);
  }


?>

<?php require_once __DIR__. "/../../layouts/header.php"; ?>
    <div id="content-wrapper">
        <div class="container-fluid">
          <!-- Page Content -->
            <div class="row">
                
                <h1 style="padding-right: 50px;">Danh sách sản phẩm</h1> 
                
                <a style="height: 50px; padding-top: 10px" href="add.php" class="btn btn-success">Thêm mới</a>
            </div>
            <hr>
            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="index.html">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Danh mục</li>
            </ol>
            <div class="clearfix"></div>
            <!-- Đưa ra câu thông báo lỗi-->
            <?php require_once __DIR__. "/../../../partials/notification.php"; ?>

            <div class="row">
               <div class="col-md-12">
                  <table class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>STT</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Slug</th>
                        <th>Thunbar</th>
                        <th>Info</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $stt = 1; foreach ($product as $item): ?>
                        <tr>
                          <td><?php echo $stt ?></td>
                          <td><?php echo $item['name'] ?></td>
                          <td><?php echo $item['category_id'] ?></td>
                          <td><?php echo $item['slug'] ?></td>
                          <td>
                            <img src="<?php echo uploads() ?>product/<?php echo $item['thunbar'] ?>" width="80px" height="80px">
                          </td>
                          <td>
                            <ul>
                              <li> Giá: <?php echo $item['price'] ?> </li>
                              <li> Số lượng: <?php echo $item['number'] ?> </li>
                            </ul>
                          </td>
                          <td>  
                            <a class="btn btn-xs btn-info" href="edit.php?id=<?php echo $item['id']?>"><i class="fa fa-edit"></i>Sửa</a>
                            <a class="btn btn-xs btn-danger" href="delete.php?id=<?php echo $item['id']?>"><i class="fa fa-times"></i>Xóa</a>
                          </td>
                        </tr>
                      <?php $stt++; endforeach ?>
                      
                    </tbody>
                  </table>
                  <nav style="padding-left: 37%" aria-label="Page navigation">
                       <ul class="pagination">
                          <li class="page-item disabled">
                             <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                          </li>
                             <!-- Phân trang -->
                          <?php for ($i = 1 ; $i <= $sotrang ; $i++) : ?>
                            <?php 
                            if(isset($_GET['page']))
                            {
                              $p = $_GET['page'];
                            } 
                            else
                            {
                              $p = 1  ;
                            }
                            ?>
                            <li class="<?php echo ($i == $p) ? 'active' : '' ?>">
                              <a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                            </li>
                          <?php endfor; ?>

                          <li class="page-item">
                             <a class="page-link" href="#">Next</a>
                          </li>
                       </ul>
                  </nav>              
               </div>
            </div>
        </div>  
    </div>                  
<?php require_once __DIR__. "/../../layouts/footer.php"; ?>            