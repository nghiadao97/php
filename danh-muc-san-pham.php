<?php 
	require_once __DIR__. "/autoload/autoload.php"; 

	$id = intval(getInput('id'));
	$EditCategory = $db -> fetchID("category",$id);
    //_debug($EditCategory);

    //Phân trang cho templace
    if (isset($_GET['p']))
    {
      $p = $_GET['p'];
    }
    else
    {
      $p=1;
    }

	$sql = " SELECT * FROM product WHERE category_id = $id";

    //Đếm tổng số bảng ghi
    $total = count($db->fetchsql($sql));
	$product = $db->fetchJones("product",$sql,$total,$p,4,true); 
    $sotrang = $product['page']; //lấy ra
    unset($product['page']); // Xóa đi

    //Lấy ra cái tên của SERVER NAME
    $path = $_SERVER['SCRIPT_NAME'];

?>
<?php require_once __DIR__. "/layouts/header.php"; ?>
    <div class="col-md-9 bor">

        <section class="box-main1">
            <h3 class="title-main"><a href=""><?php echo $EditCategory['name'] ?></a> </h3>
            
            <div class="showitem clearfix">
            	<?php foreach ($product as $item): ?>
            		<div class="col-md-3 item-product bor">
                        <a href="chi-tiet-san-pham.php?id=<?php echo $item['id']?>">
                            <img src="<?php echo uploads() ?>/product/<?php echo $item['thunbar'] ?>" class="" width="100%" height="180">
                        </a>
                        <div class="info-item">
                            <a href="chi-tiet-san-pham.php?id=<?php echo $item['id']?>"><?php echo $item['name']?></a>

                            <?php if ($item['sale'] > 0): ?>
                            <p><strike class="sale"><?php echo formatPrice($item['price']) ?></strike> <b class="price"><?php echo formatpricesale($item['price'], $item['sale']) ?></b></p>
                            <?php else : ?>
                            <p><b class="price"><?php echo formatPrice($item['price']) ?></b></p>
                            <?php endif ?>

                        </div>
                        <div class="hidenitem">
                            <p><a href=""><i class="fa fa-search"></i></a></p>
                            <p><a href=""><i class="fa fa-heart"></i></a></p>
                            <p><a href="addcart.php?id=<?php echo $item['id']?>"><i class="fa fa-shopping-basket"></i></a></p>
                        </div>
                    </div>
            	<?php endforeach ?>
	            
	        </div>
            <nav class="text-center">
            	<ul class="pagination"> <!-- Phân trang --> 
                    <?php for ($i=1; $i <= $sotrang ; $i++) :?>
                        <li class="<?php echo isset($_GET['p']) && $_GET['p'] == $i ? 'active' : '' ?>"><a href="<?php echo $path ?>?id=<?php echo $id ?>&&p=<?php echo $i ?>"><?php echo $i; ?></a></li>
                    <?php endfor; ?>
            	</ul>
            </nav>
        </section>

    </div>
<?php require_once __DIR__. "/layouts/footer.php"; ?>
                