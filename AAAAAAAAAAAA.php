<?php
if (isset($_SESSION['user_id'])) {
    $userCartItems = $Cart->getCartId($Cart->getUserCartItems($_SESSION['user_id'])) ?? [];
    if (in_array($item['item_id'], $userCartItems)) {
        echo '<button type="submit" disabled class="btn btn-success font-size-12">In the Cart</button>';
    } else {
        echo '<button type="submit" name="top_sale_submit" class="btn btn-warning font-size-12">Add to Cart</button>';
    }
} else {
    // Si no hay usuario logueado, simplemente mostrar el botón "Add to Cart"
    echo '<button type="submit" name="top_sale_submit" class="btn btn-warning font-size-12">Add to Cart</button>';
}
?>
FRAGMENTO DE TOP SALE QUE SI FUNCIONA


    if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Realizar operaciones que requieran $user_id, como obtener elementos del carrito
    $in_cart = $Cart->getCartId($Cart->getUserCartItems($user_id));
} else {
    // Si no hay usuario logueado, establecer valores predeterminados o evitar operaciones que requieran $user_id
    $in_cart = []; // Establecer un array vacío para evitar errores más adelante
}


TOP SALE 

<!-- Top Sale -->
<?php

    shuffle($product_shuffle);

    // request method post
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        if (isset($_POST['top_sale_submit'])){
            // call method addToCart
            $Cart->addToCart($_POST['user_id'], $_POST['item_id']);
        }
    }
?>
<section id="top-sale">
    <div class="container py-5">
        <h4 class="font-rubik font-size-20">Nuevos Productos</h4>
        <hr>
        <!-- owl carousel -->
        <div class="owl-carousel owl-theme">
            <?php foreach ($product_shuffle as $item) { ?>
            <div class="item py-2">
                <div class="product font-rale">
                    <a href="<?php printf('%s?item_id=%s', 'product.php',  $item['item_id']); ?>"><img src="<?php echo $item['item_image'] ?? "./assets/products/1.png"; ?>" alt="product1" class="img-fluid"></a>
                    <div class="text-center">
                        <h6><?php echo  $item['item_name'] ?? "Unknown";  ?></h6>
                        <div class="rating text-warning font-size-12">
                            <span><i class="fas fa-star"></i></span>
                            <span><i class="fas fa-star"></i></span>
                            <span><i class="fas fa-star"></i></span>
                            <span><i class="fas fa-star"></i></span>
                            <span><i class="far fa-star"></i></span>
                        </div>
                        <div class="price py-2">
                            <span>$<?php echo $item['item_price'] ?? '0' ; ?></span>
                        </div>
                        <form method="post">
                            <input type="hidden" name="item_id" value="<?php echo $item['item_id'] ?? '1'; ?>">
                            <input type="hidden" name="user_id" value="<?php echo $user['user_id'] ?? '1'; ?>">

<?php
if (isset($_SESSION['user_id'])) {
    $userCartItems = $Cart->getCartId($Cart->getUserCartItems($_SESSION['user_id'])) ?? [];
    if (in_array($item['item_id'], $userCartItems)) {
        echo '<button type="submit" disabled class="btn btn-success font-size-12">In the Cart</button>';
    } else {
        echo '<button type="submit" name="top_sale_submit" class="btn btn-warning font-size-12">Add to Cart</button>';
    }
} else {
    // Si no hay usuario logueado, simplemente mostrar el botón "Add to Cart"
    echo '<button type="submit" name="top_sale_submit" class="btn btn-warning font-size-12">Add to Cart</button>';
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
<!-- !Top Sale -->


<!--!BuTTONS NEW-PHONE -->

                                <?php
                                if (in_array($item['item_id'], $Cart->getCartId($Cart->getUserCartItems($_SESSION['user_id'])) ?? [])){
                                    echo '<button type="submit" disabled class="btn btn-success font-size-12">In the Cart</button>';
                                }else{
                                    echo '<button type="submit" name="top_sale_submit" class="btn btn-warning font-size-12">Add to Cart</button>';
                                }
                                ?>