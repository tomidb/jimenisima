<!--   product  -->
<?php
if($_SERVER['REQUEST_METHOD'] == "POST"){
    if (isset($_POST['product_submit'])){
// Verificar si hay un usuario logueado
    if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])){
          $Cart->addToCart($_POST['user_id'], $_POST['item_id'], $_POST['item_name'], $_POST['item_image'], $_POST['item_price']);
          header('Location: cart.php');
        } else {
          header('Location: login.php?cart');
          exit();
        }
    }
}
    $item_id = $_GET['item_id'] ?? 1;
    foreach ($product->getData() as $item) :
        if ($item['item_id'] == $item_id) :
?>
<section id="product" class="py-3">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <img src="./assets/products/<?php echo $item['item_image'] ?? "./assets/products/1.png" ?>" alt="product" class="img-fluid">
            </div>
            <div class="col-sm-6 py-5">
                <h5 class="font-baloo font-size-20"><?php echo $item['item_name'] ?? "Unknown"; ?></h5>
                <span> <?php echo $item['category'] ?? "Brand"; ?></span>
                <hr class="m-0">

                <!---    product price       -->
                <table class="my-3">
                    <tr class="font-rale font-size-14">
                        <td>Precio:</td>
                        <td class="font-size-20 text-danger">$<span><?php echo $item['item_price'] ?? 0; ?></span></td>
                    </tr>
                    <tr class="font-rale font-size-14">
                        <td>Stock disponible:</td>
                        <td><span class="font-size-16 text-danger"><?php echo $item['qty']; ?></span></td>
                    </tr>
                </table>
                <!---    !product price       -->
                <div class="row orm-row pt-4 font-size-16 font-baloo">
                    <div class="col-6 ">
                       <form method="post">
                                <input type="hidden" name="item_id" value="<?php echo $item['item_id'] ?? '1'; ?>">
                                <input type="hidden" name="user_id" value="<?php echo $user['user_id'] ?? '55'; ?>">
                                <input type="hidden" name="item_name" value="<?php echo $item['item_name'] ?? '1'; ?>">
                                <input type="hidden" name="item_image" value="<?php echo $item['item_image'] ?? '55'; ?>">
                                <input type="hidden" name="item_price" value="<?php echo $item['item_price'] ?? '55'; ?>">
                        <?php
                            if (in_array($item['item_id'], $in_cart ?? [])){
                            echo '<button type="submit" disabled class="btn btn-success font-size-16 form-control">In the Cart</button>';
                        }else{
                            echo '<button type="submit" name="product_submit" class="btn btn-warning font-size-16 form-control">Add to Cart</button>';
                        }
                        ?>
                          </form>
                    </div>
                </div>
            </div> 
        </div>
    </div>
</section>
<!--   !product  -->
<?php
        endif;
        endforeach;
?>