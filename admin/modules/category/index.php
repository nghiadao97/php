<?php
  $open = "category";
	require_once __DIR__. "/../../autoload/autoload.php";
	//fetchAll: lấy tất cả
  $category = $db -> fetchAll('category');
?>

<?php require_once __DIR__. "/../../layouts/header.php"; ?>
    <div id="content-wrapper">
        <div class="container-fluid">
        	<!-- Page Content -->
            <div class="row">
                
                <h1 style="padding-right: 50px;">Danh mục sản phẩm</h1> 
                
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

            <p>This is a great starting point for new custom pages.</p>
            <div class="row">
               <div class="col-md-12">
                  <table class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>STT</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Home</th>
                        <th>Created</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $stt = 1; foreach ($category as $item): ?>
                        <tr>
                          <td><?php echo $stt ?></td>
                          <td><?php echo $item['name'] ?></td>
                          <td><?php echo $item['slug'] ?></td>
                          <td>
                            <a href="home.php?id=<?php echo $item['id']?>" class="btn btn-xs <?php echo $item['home'] == 1 ? 'btn-info' : 'btn-danger' ?>">
                              <?php echo $item['home'] == 1 ? 'Hiển thị' : 'Không' ?>
                              
                            </a>
                          </td>
                          <td><?php echo $item['created_at'] ?></td>
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
                          <li class="page-item"><a class="page-link" href="#">1</a></li>
                          <li class="page-item active" aria-current="page">
                             <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                          </li>
                          <li class="page-item"><a class="page-link" href="#">3</a></li>
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