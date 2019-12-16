<?php 
    require_once __DIR__. "/autoload/autoload.php"; 
    //unset($_SESSION['cart']);
    $sqlHomecate = "SELECT name, id FROM category WHERE home = 1 ORDER BY updated_at";
    $CategoryHome = $db->fetchsql($sqlHomecate);
    //_debug($CategoryHome); 

    $data = [];

    foreach ($CategoryHome as $item) {
        $cateId = intval($item['id']); //ép kiểu cho nó trả về số nguyên
        $sql = " SELECT * FROM product WHERE category_id = $cateId";
        $ProductHome = $db->fetchsql($sql);
        $data[$item['name']] = $ProductHome; //lấy ra các sản phẩm có tên asus/dell trong product
    }
?>
<?php require_once __DIR__. "/layouts/header.php"; ?>
    <div class="col-md-9 bor">
        <section id="slide" class="text-center" >
            <img src="<?php echo base_url() ?>public/frontend/images/slide/sl3.jpg" class="img-thumbnail" width="100%">
        </section>
        <section class="box-main1">
            <?php foreach ($data as $key => $value): ?>  
                <h3 class="title-main"><a href=""> <?php echo $key?> </a> </h3> <!-- $key là tên danh mục -->
                <div class="showitem" style="margin-top: 10px; margin-bottom: 10px;">
                    <?php foreach ($value as $item): ?> <!-- đổ sản phẩm có cái tên là $key ra -->
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
            <?php endforeach ?>
            
        </section>

    </div>
<?php require_once __DIR__. "/layouts/footer.php"; ?>
                