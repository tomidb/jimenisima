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
          <h4>Todos los productos</h4>
        </div>
        <div class="card-body">
              <table class="table table-borderer table-striped">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Categoría</th>
                      <th>Nombre</th>
                      <th>Precio</th>
                      <th>Imágen</th>
                      <th>Cantidad</th>
                      <th>Editar</th>
                      <th>Eliminar</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                        $products = getAll($db, 'product');
                        
                          if(mysqli_num_rows($products) > 0)
                          {
                            foreach ($products as $product)
                             {
                              ?>
                              <tr>
                                <td><?= $product['item_id']; ?></td>
                                <td><?= $product['category']; ?></td>
                                <td><?= $product['item_name']; ?></td>
                                <td><?= $product['item_price']; ?></td>
                                <td>
                                  <img src="assets/products/<?= $product['item_image']; ?>" alt="<?= $product['item_name']; ?>" width="50px" height="50px">
                                </td>
                                <td><?= $product['qty']; ?></td>
                                <td>
                                  <a href="edit-product.php?id=<?= $product['item_id']; ?>" class="btn btn-primary btn-sm">Editar</a>
                                </td>
                                <td>
                                  <form action="database/code.php" method="POST">
                                    <input type="hidden" name="id" value="<?= $product['item_id']; ?>">
                                    <button type="submit" class="btn btn-primary btn-sm" name="del_product_btn">Eliminar</button>
                                  </form>
                                </td>
                              </tr>
                              <?php
                            }
                          }
                          else
                          {
                            echo "<p>No se encontraron productos</p>";
                          }                 
                    ?>   
                  </tbody>
              </table>
        </div>
      </div>
    </div>
  </div>
</div>