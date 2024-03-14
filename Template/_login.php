  <?php
  session_start();
  require('./helper/helper.php');
  $user = array();
  if(isset($_SESSION['user_id'])){
    $user = get_user_info($db->con, $_SESSION['user_id']);
  }

  if($_SERVER['REQUEST_METHOD'] == 'POST'){
  require('./database/login-process.php');
  }

  ?>

  <section id="login">
    <div class="row m-0">
      <div class="col-lg-4 offset-lg-4">
        <div class="text-center pb-5">
          <h5 class="login-title text-dark">Iniciar Sesión</h5>
          <p class="p-1 m-0 font-ubuntu text-black-50">Login and enjoy additional features.</p>
          <span>Crear una <a href="register.php">cuenta nueva.</a></span>
        </div>
        <div class="d-flex justify-content-center">
          <form action="login.php" method="post" enctype="multipart/form-data" id="log-form">
            <div class="form-row my-4">
              <div class="col">
                <input type="email" required name="email" id="email" class="form-control" placeholder="Ingresa tu email">
              </div>
            </div>
            <div class="form-row my-4">
              <div class="col">
                <input type="password" required name="password" id="password" class="form-control" placeholder="Elige una contraseña">
              </div>
            </div>
            <div class="submit-btn text-center my-5">
              <button type="submit" class="btn btn-warning rounded-pill text-dark px-5">Ingresar a la Tienda</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>