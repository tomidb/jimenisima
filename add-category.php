<?php
// include header.php file
include ('header.php');
include('helper/adminMiddleware.php');
?>
<div class="row" style="min-height: 100vh !important;">
  <div class="col-3 my-4">
          <div class="list-group adm-menu">
            <h4  class="list-group-item list-group-item-action" style="margin-bottom: 0px;">
              Panel de administración
            </h4>
            <a href="add-category.php" class="list-group-item list-group-item-action active" aria-current="true">
              Agregar categoría
            </a>
            <a href="categories.php" class="list-group-item list-group-item-action">Categorías</a>
            <a href="products.php" class="list-group-item list-group-item-action">Productos</a>
            <a href="add-product.php" class="list-group-item list-group-item-action">Agregar producto</a>
            <a href="orders.php" class="list-group-item list-group-item-action">Pedidos</a>
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