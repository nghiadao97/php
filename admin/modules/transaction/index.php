<?php
  $open = "transaction";
  require_once __DIR__. "/../../autoload/autoload.php";
  //fetchAll: lấy tất cả
  $transaction = $db -> fetchAll('transaction');

  //Phân trang
  if (isset($_GET['page']))
  {
    $p = $_GET['page'];
  }
  else
  {
    $p=1;
  }
  // DESC giàm dần (sắp xếp)
  $sql = "SELECT transaction.* , users.name as nameuser, users.phone as phoneuser, users.address as addressuser FROM transaction LEFT JOIN users ON users.id = transaction.users_id ORDER BY ID DESC ";
  $transaction = $db->fetchJone('transaction', $sql, $p, 10, true);
  if (isset($transaction['page']))
  {
    $sotrang = $transaction['page'];
    unset($transaction['page']);
  }


?>

<?php require_once __DIR__. "/../../layouts/header.php"; ?>
    <div id="content-wrapper">
        <div class="container-fluid">
          <!-- Page Content -->
            <div class="row">
                
                <h1 style="padding-right: 50px;">Danh sách đơn hàng</h1> 
                
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
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $stt = 1; foreach ($transaction as $item): ?>
                        <tr>
                          <td><?php echo $stt ?></td>
                          <td><?php echo $item['nameuser'] ?></td>
                          <td><?php echo $item['phoneuser'] ?></td>
                          <td><?php echo $item['addressuser'] ?></td>
                          <td>
                              <a href="status.php?id=<?php echo $item['id'] ?>" class="btn btn-xs <?php echo $item['status'] == 0 ? 'btn-danger' : 'btn-info' ?>"><?php echo $item['status'] == 0 ? 'Chưa xử lý' : 'Đã xử lý' ?></a>
                          </td>
                          <td>
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