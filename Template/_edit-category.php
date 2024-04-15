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
          <h4>Editar categoría</h4>
        </div>
        <div class="card-body">
          <?php
          if(isset($_GET['id'])){
            $id=$_GET['id'];
            $category = getByID($db, 'categories', $id);
            if(mysqli_num_rows($category) > 0){
              $data = mysqli_fetch_array($category);
            ?>
              <form action="database/code.php" method="POST">
                    <div class="form-group">
                      <input type="hidden" class="form-control" id="category-id" name="id" value="<?= $data['id']; ?>" placeholder="Id de la categoría">
                      <label for="category-name">Nombre</label>
                      <input type="text" class="form-control" id="category-name" name="name" value="<?= $data['name']; ?>" placeholder="Ingresa el nombre de la categoría">
                    </div>
                    <button type="submit" class="btn btn-primary" name="edit_category_btn">Editar</button>
            </form>
            <?php
            }
            else {
              echo '<p>Categoría no encontrada.</p>';
            }
          } else {
            echo '<p>Id no inluido en la url.</p>';
          }
          ?>

        </div>
      </div>
    </div>
  </div>
</div>