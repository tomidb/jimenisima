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
          <h4>Todas las categorías</h4>
        </div>
        <div class="card-body">
              <table class="table table-borderer table-striped">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Nombre</th>
                      <th>Editar</th>
                      <th>Eliminar</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                        $categories = getAll($db, 'categories');
                        
                          if($categories)
                          {
                            foreach ($categories as $category)
                             {
                              ?>
                              <tr>
                                <td><?= $category['id']; ?></td>
                                <td><?= $category['name']; ?></td>
                                <td>
                                  <a href="edit-category.php?id=<?= $category['id']; ?>" class="btn btn-primary">Editar</a>
                                </td>
                                <td>
                                  <form action="database/code.php" method="POST">
                                    <input type="hidden" name="category_id" value="<?= $category['id']; ?>">
                                    <button type="submit" class="btn btn-primary" name="del_category_btn">Eliminar</button>
                                  </form>
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