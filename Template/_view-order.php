<?php
include_once('database/DBController.php');
include_once('database/adm-functions.php');
$db = new DBController();
if(isset($_GET['nr'])){
  $order_id = $_GET['nr'];
  $order_query = "SELECT * FROM orders WHERE order_id = $order_id";
  $order_query_run = mysqli_query($db->con, $order_query);
  $order_details = mysqli_fetch_assoc($order_query_run);


  ?>
  <div class="container">
  <div class="row">
    <div class="col-md-9">
      <div class="card">
        <div class="card-header">
          <h4>Información del pedido</h4>
        </div>
            <div class="card-body">
                <table class="table table-borderer table-striped">
                    <thead>
                      <tr>
                        <th>Nr</th>
                        <th>Cliente</th>
                        <th>Email</th>
                        <th>Total</th>
                      </tr>
                    </thead>
                    <tbody>
                          <tr>
                                <td><?= $order_id ?></td>
                                <td><?= $order_details['user_name']; ?></td>
                                <td><?= $order_details['user_email']; ?></td>
                                <td>$ <?= $order_details['total_price']; ?></td>
                         </tr>
                    </tbody>
                </table>
                <div class="row ml-3">
                  <form action="database/code.php" method="POST">
                    <input type="hidden" name="order_id" value="<?= $order_id ?>">
                    <label class="status-label">Estado</label>
                      <select name="order_status" id="" class="form-select ml-3">
                          <option value="0" <?= $order_details['order_status'] == 0?"selected":"" ?>>En proceso</option>
                          <option value="1" <?= $order_details['order_status'] == 1?"selected":"" ?>>Completado</option>
                          <option value="2" <?= $order_details['order_status'] == 2?"selected":"" ?>>Cancelado</option>
                      </select>
                      <button type="submit" class="btn btn-primary ml-3" name="update_status_btn">Actualizar Estado</button>
                  </form>
                </div>
            </div>
        <div class="card-header border-top">
          <h5>Productos encargados</h4>
        </div>
        <div class="card-body">
              <table class="table table-borderer table-striped">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Nombre</th>
                      <th>Imágen</th>
                      <th>Precio por unidad</th>
                      <th>Cantidad</th>

                    </tr>
                  </thead>
                  <tbody>
                    <?php
                        $order_products_query = "SELECT * FROM order_products WHERE order_id = $order_id";
                        $order_products_query_run = mysqli_query($db->con, $order_products_query);
                            foreach ($order_products_query_run as $product)
                             {
                          
                              ?>
                              <tr>
                                <td><?= $product['product_id']; ?></td>
                                <td><?= $product['product_name']; ?></td>
                                <td>
                                  <img src="<?= $product['product_image']; ?>" alt="<?= $product['product_name']; ?>" width="50px" height="50px">
                                </td>
                                <td>$ <?= $product['product_price']; ?></td>
                                <td><?= $product['product_qty']; ?></td>
                              </tr>
                              <?php
                            }
                    ?>   
                  </tbody>
              </table>
        </div>
      </div>
    </div>
  </div>
</div>
  <?php
}
?>
