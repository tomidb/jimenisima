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
          <h4>Agregar categoría</h4>
        </div>
        <div class="card-body">
              <form action="database/code.php" method="POST">
                    <div class="form-group">
                      <label for="category-name">Nombre</label>
                      <input type="text" class="form-control" id="category-name" name="name" placeholder="Ingrese el nombre de la categoría">
                    </div>
                    <button type="submit" class="btn btn-primary" name="add_category_btn">Añadir</button>
            </form>
        </div>
      </div>
    </div>
  </div>
</div>