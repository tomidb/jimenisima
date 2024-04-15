<?php
// include header.php file
include ('header.php');
include('helper/adminMiddleware.php');
?>
<div class="row vh-100">
  <div class="col-3 my-4">
          <div class="list-group adm-menu">
            <a href="add-category.php" class="list-group-item list-group-item-action" aria-current="true">
              Agregar categoría
            </a>
            <a href="categories.php" class="list-group-item list-group-item-action">Categorías</a>
            <a href="products.php" class="list-group-item list-group-item-action">Productos</a>
            <a href="add-product.php" class="list-group-item list-group-item-action">Agregar producto</a>
            <a class="list-group-item list-group-item-action disabled">A disabled link item</a>
          </div>
  </div>
  <div class="col-9 my-4">

          <?php
          include ('Template/_edit-product.php');
          ?>
  </div>
</div>
<?php
// include footer.php file
include ('footer.php');
?>