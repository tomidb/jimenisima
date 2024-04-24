<!-- Special Price -->
<?php
    $brand = array_map(function ($pro){ return $pro['category']; }, $product_shuffle);
    $unique = array_unique($brand);
    sort($unique);

// request method post
if($_SERVER['REQUEST_METHOD'] == "POST"){
    if (isset($_POST['special_price_submit'])){
    if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])){
          $Cart->addToCart($_POST['user_id'], $_POST['item_id'], $_POST['item_name'], $_POST['item_image'], $_POST['item_price']);
        } else {


    header('Location: login.php?cart');
    exit();
        }
    }
}


?>
<section id="special-price">
    <div class="container">
        <h4 class="font-rubik font-size-20">Productos por categoría</h4>
        <div id="filters" class="button-group text-right font-baloo font-size-16">
            <button class="btn is-checked" data-filter="*">Todos</button>
            <?php
                array_map(function ($brand){
                    printf('<button class="btn" data-filter=".%s">%s</button>', $brand, $brand);
                }, $unique);
            ?>
        </div>

        <div class="grid">
            <?php array_map(function ($item) use($in_cart){ ?>
            <div class="grid-item border <?php echo $item['category'] ?? "Brand" ; ?>">
                <div class="item py-2" style="width: 200px;">
                    <div class="product font-rale">
                        <a href="<?php printf('%s?item_id=%s', 'product.php',  $item['item_id']); ?>"><img src="./assets/products/<?php echo $item['item_image'] ?? "./assets/products/13.png"; ?>" alt="product1" class="img-fluid"></a>
                        <div class="text-center">
                            <h6><?php echo $item['item_name'] ?? "Unknown"; ?></h6>
                            <div class="price py-2">
                                <span>$<?php echo $item['item_price'] ?? 0 ?></span>
                            </div>
                            <form method="post">
                                <input type="hidden" name="item_id" value="<?php echo $item['item_id'] ?? '1'; ?>">
                                <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id'] ?? '55'; ?>">
                                <input type="hidden" name="item_name" value="<?php echo $item['item_name'] ?? '1'; ?>">
                                <input type="hidden" name="item_image" value="<?php echo $item['item_image'] ?? '55'; ?>">
                                <input type="hidden" name="item_price" value="<?php echo $item['item_price'] ?? '55'; ?>">
                                <?php
                                if (in_array($item['item_id'], $in_cart ?? [])){
                                    echo '<button type="submit" disabled class="btn btn-success font-size-12">In the Cart</button>';
                                }else{
                                    echo '<button type="submit" name="special_price_submit" class="btn btn-warning font-size-12">Add to Cart</button>';
                                }
                                ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php }, $product_shuffle) ?>
        </div>
    </div>
</section>
<!-- !Special Price -->
