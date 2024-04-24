<!-- New Phones -->
<?php
// request method post
if($_SERVER['REQUEST_METHOD'] == "POST"){
    if (isset($_POST['new_phones_submit'])){
// Verificar si hay un usuario logueado
    if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])){
          $Cart->addToCart($_POST['user_id'], $_POST['item_id'], $_POST['item_name'], $_POST['item_image'], $_POST['item_price']);
        } else {
          header('Location: login.php?cart');
          exit();
        }
    }
}
?>
<section id="new-phones">
    <div class="container">
        <h4 class="font-rubik font-size-20">Nuevos Productos</h4>
        <hr>

        <!-- owl carousel -->
        <div class="owl-carousel owl-theme">
            <?php foreach ($product_shuffle as $item) { ?>
                <div class="item py-2">
                    <div class="product font-rale">
                        <a href="<?php printf('%s?item_id=%s', 'product.php',  $item['item_id']); ?>"><img src="./assets/products/<?php echo $item['item_image'] ?? "./assets/products/1.png"; ?>" alt="product1" class="img-fluid"></a>
                        <div class="text-center">
                            <h6><?php echo  $item['item_name'] ?? "Unknown";  ?></h6>
                            <span><?= $item['category']; ?></span>
                            <div class="price py-2">
                                <span>$<?php echo $item['item_price'] ?? '0' ; ?></span>
                            </div>
                            <form method="post">
                                <input type="hidden" name="item_id" value="<?php echo $item['item_id'] ?? '1'; ?>">
                                <input type="hidden" name="user_id" value="<?php echo $user['user_id'] ?? '55'; ?>">
                                <input type="hidden" name="item_name" value="<?php echo $item['item_name'] ?? '1'; ?>">
                                <input type="hidden" name="item_image" value="<?php echo $item['item_image'] ?? '55'; ?>">
                                <input type="hidden" name="item_price" value="<?php echo $item['item_price'] ?? '55'; ?>">
                                <?php
                                if (in_array($item['item_id'], $in_cart ?? [])){
                                    echo '<button type="submit" disabled class="btn btn-success font-size-12">In the Cart</button>';
                                }else{
                                    echo '<button type="submit" name="new_phones_submit" class="btn btn-warning font-size-12">Add to Cart</button>';
                                }
                                ?>
                            </form>
                        </div>
                    </div>
                </div>
            <?php } // closing foreach function ?>
        </div>
        <!-- !owl carousel -->

    </div>
</section>
<!-- !New Phones -->