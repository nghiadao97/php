
<?php
	require_once __DIR__. "/../autoload/autoload.php";
	
	$category = $db->fetchAll("category"); //fetchAll là lấy tất cả
	//var_dump($category);

?>

<?php require_once __DIR__. "/../layouts/header.php"; ?>
            <div id="content-wrapper">
                <div class="container-fluid">
                	<!-- Page Content -->
                    <h1>Xin chào bạn đến với trang quản trị của admin</h1>
                    <hr>
                    <!-- Breadcrumbs-->
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.html">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">Blank Page</li>
                    </ol>
                    <p>This is a great starting point for new custom pages.</p>
                </div>
                <!-- /.container-fluid -->
                <!-- Sticky Footer -->
                <footer class="sticky-footer">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright © Your Website 2019</span>
                        </div>
                    </div>
                </footer>
            </div>
<?php require_once __DIR__. "/../layouts/footer.php"; ?>            