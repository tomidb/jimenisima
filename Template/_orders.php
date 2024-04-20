<?php
include_once('database/DBController.php');
include_once('database/adm-functions.php');
$db = new DBController();
?>

<div class="container">
  <div class="row">
    <div class="col-md-9">
                                <?php
                  if(isset($_SESSION['message'])){
                    ?>
                      <div class="alert alert-warning" role="alert">
                      <span><?= $_SESSION['message']; ?></span>
                      </div>
                    <?php 
                        unset($_SESSION['message']);
                  }
                ?>
      <div class="card">
        <div class="card-header">
          <h4>Lista de pedidos</h4>
        </div>
        <div class="card-body">
              <table class="table table-borderer table-striped">
                  <thead>
                    <tr>
                      <th>Nr</th>
                      <th>Cliente</th>
                      <th>Total</th>
                      <th>Estado</th>
                      <th>Detalles</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                        $orders = getAll($db, 'orders');
                        
                          if($orders)
                          {
                            foreach ($orders as $order)
                             {
                              ?>
                              <tr>
                                <td><?= $order['order_id']; ?></td>
                                <td><?= $order['user_name']; ?></td>
                                <td>$<?= $order['total_price']; ?></td>
                                <td><?= $order['order_status'] == 0? "En proceso": "" ?></td>
                                <td>
                                  <a href="view-order.php?nr=<?= $order['order_id']; ?>" class="btn btn-primary">Detalles</a>
                                </td>

                              </tr>
                              <?php
                            }
                          }
                          else
                          {
                            echo "No record founds";
                          }                 
                    ?>   
                  </tbody>
              </table>
        </div>
      </div>
    </div>
  </div>
</div>