<!-- Shopping cart section  -->
<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            if (isset($_POST['delete-cart-submit'])){
              $deletedrecord = $Cart->deleteCart($_POST['item_id']);
            }
            else if(isset($_POST['action'])){
              $qty = $_POST['qty'];
              $itemid = $_POST['itemid'];
              $user_id = $user['user_id'];
              $Cart->UpdateCartQuantity($itemid, $user_id, $qty);
            } else if(isset($_POST['confirm-order-submit'])){
              $user_id = mysqli_real_escape_string($db->con, $user['user_id']);
              $user_name = mysqli_real_escape_string($db->con, $user['userName']);
              $user_email = mysqli_real_escape_string($db->con, $user['email']);

              $userCartItems = $Cart->getUserCartItems($user_id);

              $total_price = 0;
              foreach ($userCartItems as $item) {
                      $cartQty = $Cart->getCartItemQty($item['item_id'], $user_id);
                      $total_price += $item['item_price'] * $cartQty;
              }
              
              $insert_query = "INSERT INTO orders (user_id, user_name, user_email, total_price) VALUES ('$user_id', '$user_name', '$user_email', '$total_price')";
              $insert_query_run = mysqli_query($db->con, $insert_query);

              if($insert_query_run){
                  $order_id = mysqli_insert_id($db->con);
                  $select_cart_items_query = "SELECT item_id, qty, item_name, item_image, item_price FROM cart WHERE user_id = '$user_id'";
                  $select_cart_items_query_run = mysqli_query($db->con, $select_cart_items_query);

                  $text = "*Hola WowArt!* Ya tengo listo mi pedido: \n\n";
                  foreach ($select_cart_items_query_run as $product) {
                    $product_id = $product['item_id'];
                    $product_qty = $product['qty'];
                    $product_name = $product['item_name'];
                    $product_image= $product['item_image'];
                    $product_price = $product['item_price'];

                    $insert_products_query = "INSERT INTO order_products (order_id, product_id, product_qty, product_price, product_image, product_name) VALUES ('$order_id', '$product_id', '$product_qty', '$product_price', '$product_image', '$product_name')";
                    $insert_products_query_run = mysqli_query($db->con, $insert_products_query);

                    $get_qty_query = "SELECT qty FROM product WHERE item_id = '$product_id'";
                    $stock_qty = mysqli_query($db->con, $get_qty_query);
                    $row = mysqli_fetch_assoc($stock_qty);
                    $actual_stock_qty = (int) $row['qty'];
                    $new_qty = $actual_stock_qty - $product_qty;

                    $text .= "*$product_name*\n" .
                                  "- precio por unidad: $$product_price\n" .
                                  "- cantidad: x $product_qty\n";

                    $update_stock_qty = "UPDATE product SET qty = '$new_qty' WHERE item_id = '$product_id'";
                    $update_stock_qty_run = mysqli_query($db->con, $update_stock_qty);
                  }
                  $delete_cart_query = "DELETE FROM cart WHERE user_id = '$user_id'";
                  $delete_cart_query_run = mysqli_query($db->con, $delete_cart_query);

                  $text .= 
                              "Nr de orden: *$order_id* \n" .
                              "Precio total: *$$total_price* \n" .
                              "Cliente: *$user_name* \n" .
                              "Email: *$user_email* \n\n" .
                              "Aguardaré tu respuesta para confirmar el pedido.";

                  $url = "https://api.whatsapp.com/send?phone=5493517594045&text=" . urlencode($text);
                  header("Location: $url");
              }
        }
    }
?>
<section id="cart" class="py-3 mb-5">
    <div class="container-fluid w-75">
                <?php
                  if(isset($_GET['sin-stock']) || isset($_POST['confirm-order-submit'])){
                        $user_id = $user['user_id'];
                        $user_name = $user['userName'];
                        $user_email = $user['email'];
                        $total_price = $_POST['total_price'];
                    ?>
                      <div class="alert alert-warning" role="alert">
                      <strong>Hey! <?= $user_id; ?>-<?= $user_name; ?>-<?= $user_email; ?>-<?= $total_price; ?></strong><p>Has alcanzado el límite de unidades en stock de ese producto.</p>
                      </div>
                    <?php 
                        unset($_SESSION['message']);
                  }
                ?>
        <h5 class="font-baloo font-size-20">Shopping Cart</h5>
        <!--  shopping cart items   -->
        <div class="row">
            <div class="col-sm-9">
                <?php
                 // get user cart products
                    $user_id = $_SESSION['user_id'];
                    $userCartItems = $Cart->getUserCartItems($user_id);
                    $subTotal = array();
                    foreach ($userCartItems as $item) :
                        $cart = $product->getProduct($item['item_id']);
                        $cartQty = $Cart->getCartItemQty($item['item_id'], $user_id);
                        $stockQty = $cart[0]['qty']; // Obtener la cantidad en stock del producto
            

                ?>
                <!-- cart item -->  
                <div class="row border-top py-3 mt-3">
                    <div class="col-sm-2">
                        <img src="<?php echo $item['item_image'] ?? "./assets/products/1.png" ?>" style="height: 120px;" alt="cart1" class="img-fluid">
                    </div>
                    <div class="col-sm-8">
                        <h5 class="font-baloo font-size-20"><?php echo $item['item_name'] ?? "Unknown"; ?></h5>
                        <p><?php  ?></p>
                        <small>by <?php echo $item['item_brand'] ?? "Brand"; ?></small>
                        <!-- product rating -->
                        <div class="d-flex">
                            <div class="stock text-warning font-size-12">
                                <input type="number" 
                                data-id="<?php echo $item['item_id'] ?? '0'; ?>" class="qty_stock"
                                value="<?php echo $stockQty ?? '15'; ?>" disabled>
                            <span class="px-2 font-rale font-size-14"> unidades en Stock.</span>
                            </div>

                        </div>
                        <!--  !product rating-->

                        <!-- product qty -->
                        <div class="qty d-flex pt-2">
                            <div class="d-flex font-rale w-25">
                                <button class="qty-up update-qty border bg-light" data-id="<?php echo $item['item_id'] ?? '0'; ?>"><i class="fas fa-angle-up"></i></button>
                                <input type="number" 
                                id="<?php echo $item['item_id'] ?? '0'; ?>"
                                data-id="<?php echo $item['item_id'] ?? '0'; ?>" class="qty_input border w-100 bg-light" disabled value="<?php echo $cartQty ?>" placeholder="1">
                                <button data-id="<?php echo $item['item_id'] ?? '0'; ?>" class="qty-down update-qty border bg-light"><i class="fas fa-angle-down"></i></button>
                            </div>

                        <!-- !product qty -->

                            <form method="post">
                                <input type="hidden" value="<?php echo $item['item_id'] ?? 0; ?>" name="item_id">
                                <button type="submit" name="delete-cart-submit" class="btn font-baloo text-danger px-3 border-right">Delete</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-sm-2 text-right">
                        <div class="font-size-20 text-danger font-baloo">
                            $<span class="product_price" data-id="<?php echo $item['item_id'] ?? '0'; ?>"><?php echo $item['item_price'] * $cartQty ?? 0; ?></span>
                        </div>
                    </div>
                </div>
                <!-- !cart item -->
                <?php
                        $subTotal[] = $item['item_price'] * $cartQty;
                    endforeach;
                    $total_price = array_sum($subTotal);
                ?>
            </div>
            <!-- subtotal section-->
            <div class="col-sm-3">
                <div class="sub-total border text-center mt-2">
                    <h6 class="font-size-12 font-rale text-success py-3"><i class="fas fa-check"></i> Clickea para enviar tu pedido al whatsapp de nuestros vendedores</h6>
                    <div class="border-top py-4">
                        <h5 class="font-baloo font-size-20">Subtotal ( <?php echo isset($subTotal) ? count($subTotal) : 0; ?> item):&nbsp; <span class="text-danger">$<span class="text-danger" id="deal-price"><?php echo isset($total_price) ? $total_price : 0; ?></span> </span> </h5>
                        <form method="post">
                            <input type="hidden" name="total_price" value="<?php echo $total_price; ?>">
                            <button type="submit" name="confirm-order-submit" class="btn btn-warning mt-3">Continuar por Whatsapp</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- !subtotal section-->
        </div>
        <!--  !shopping cart items   -->
    </div>
</section>
<!-- !Shopping cart section  -->