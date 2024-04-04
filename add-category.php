<?php
// include header.php file
include ('header.php');
include('helper/adminMiddleware.php');
?>
<div class="row vh-100">
  <div class="col-3 my-4">
          <div class="list-group">
            <a href="add-category.php" class="list-group-item list-group-item-action active" aria-current="true">
              Agregar categoría
            </a>
            <a href="#" class="list-group-item list-group-item-action">Editar categoría</a>
            <a href="#" class="list-group-item list-group-item-action">Agregar producto</a>
            <a href="#" class="list-group-item list-group-item-action">Editar producto</a>
            <a class="list-group-item list-group-item-action disabled">A disabled link item</a>
          </div>
  </div>
  <div class="col-9 my-4">
          <?php
          include ('Template/_add-category.php');
          ?>
  </div>
</div>
<?php
// include footer.php file
include ('footer.php');
?>