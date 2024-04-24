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
          <h4>Editar producto</h4>
        </div>
        <?php
          if(isset($_GET['id'])){
            $id=$_GET['id'];
            $product = getByID($db, 'products', $id);
            if(mysqli_num_rows($product) > 0){
              $data = mysqli_fetch_array($product);
              ?>
                <div class="card-body">
                  <form action="database/code.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-12">
                                <label class="mb-2">Categoría</label>
                                <select name="category"class="form-control">
                                  <option selected>Selecciona una categoría</option>
                                  <?php
                                    $categories = getAll($db, 'categories');
                                    
                                    if(mysqli_num_rows($categories) > 0){
                                        foreach ($categories as $category) {
                                          ?>
                                          <option value="<?= $category['name']; ?>" <?= $data['category'] == $category['name']? 'selected' : ''?>><?= $category['name']; ?></option>
                                          <?php
                                        }
                                    }
                                    else {
                                      echo "No hay categorías disponibles";
                                    }
                                  ?>
                                </select>
                            </div>
                            <input type="hidden" name="product_id" value="<?= $data['item_id']; ?>">
                            <div class="col-md-12">
                                <label class="my-2">Nombre</label>
                                <input type="text" required class="form-control" name="name" value="<?= $data['item_name']; ?>" placeholder="Ingrese el nombre del producto">
                            </div>
                            <div class="col-md-6">
                                <label class="my-2">Precio</label>
                                <input type="text" required class="form-control" name="price" value="<?= $data['item_price']; ?>" placeholder="Ingrese el precio del producto">
                            </div>
                            <div class="col-md-12">
                                <label class="my-2">Actualizar imágen</label>
                                <input type="hidden" name="old_image" value="<?= $data['item_image']; ?>">
                                <input type="file" class="form-control form-file" name="image">
                                <label class="my-2">Imágen actual</label>
                                <img src="assets/products/<?= $data['item_image']; ?>" alt="<?= $data['item_name']; ?>" height="50px" width="50px" class="mt-2">
                            </div>
                            <div class="col-md-6">
                                <label class="my-2">Cantidad</label>
                                <input type="number" required class="form-control" name="qty" value="<?= $data['qty']; ?>" placeholder="Stock">
                            </div>
                            <div class="col-md-12 mt-3">
                                <button type="submit" class="btn btn-primary" name="update_product_btn">Editar</button>
                            </div>
                        </div>

                </form>
              </div>
              <?php
            }
          }
        ?>
      </div>
    </div>
  </div>
</div>