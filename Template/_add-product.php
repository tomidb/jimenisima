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
          <h4>Agregar producto</h4>
        </div>
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
                                      <option value="<?= $category['name']; ?>"><?= $category['name']; ?></option>
                                      <?php
                                    }
                                }
                                else {
                                  echo "No hay categorías disponibles";
                                }
                              ?>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label class="my-2">Nombre</label>
                            <input type="text" required class="form-control" name="name" placeholder="Ingrese el nombre del producto">
                        </div>

                        <div class="col-md-6">
                            <label class="my-2">Precio</label>
                            <input type="text" required class="form-control" name="price" placeholder="Ingrese el precio del producto">
                        </div>
                        <div class="col-md-12">
                            <label class="my-2">Subir imágen</label>
                            <input type="file" required class="form-control form-file" name="image">
                        </div>
                        <div class="col-md-6">
                            <label class="my-2">Cantidad</label>
                            <input type="number" required class="form-control" name="qty" placeholder="Stock">
                        </div>
                        <div class="col-md-12 mt-3">
                            <button type="submit" class="btn btn-primary" name="add_product_btn">Añadir</button>
                        </div>
                    </div>

            </form>
        </div>
      </div>
    </div>
  </div>
</div>