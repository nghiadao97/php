<?php
  $open = "user";
  require_once __DIR__. "/../../autoload/autoload.php";

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
  $sql = "SELECT users.* FROM users ORDER BY ID DESC ";
  $user = $db->fetchJone('users', $sql, $p, 5, true);
  if (isset($user['page']))
  {
    $sotrang = $user['page'];
    unset($user['page']);
  }


?>

<?php require_once __DIR__. "/../../layouts/header.php"; ?>
    <div id="content-wrapper">
        <div class="container-fluid">
          <!-- Page Content -->
            <div class="row">
                
                <h1 style="padding-right: 50px;">Danh sách thành viên</h1> 

            </div>
            <hr>
            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="index.html">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Danh sách thành viên</li>
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
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $stt = 1; foreach ($user as $item): ?>
                        <tr>
                          <td><?php echo $stt ?></td>
                          <td><?php echo $item['name'] ?></td>
                          <td><?php echo $item['email'] ?></td>
                          <td><?php echo $item['phone'] ?></td>

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