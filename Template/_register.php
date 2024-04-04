<?php 
if($_SERVER['REQUEST_METHOD'] == 'POST'){
require('./database/register-process.php');
}
?>

<section id="register">
  <div class="row m-0">
    <div class="col-lg-4 offset-lg-4">
        <?php
    if(isset($_SESSION['message'])){
      ?>
        <div class="alert alert-warning" role="alert">
         <strong>Hey! </strong><?= $_SESSION['message']; ?>
        </div>
       <?php 
           unset($_SESSION['message']);
    }
  ?>
      <div class="text-center pb-5">
        <h5 class="login-title text-dark">Register</h5>
        <p class="p-1 m-0 font-ubuntu text-black-50">Register and enjoy additional features</p>
        <span>I already have <a href="login.php">Login</a></span>
      </div>
      <div class="d-flex justify-content-center">
        <form action="register.php" method="post" enctype="multipart/form-data" id="reg-form">
          <div class="form-row my-4">
            <div class="col">
              <input type="text" value="<?php if(isset($_POST['userName'])) echo $_POST['userName']; ?>"required   name="userName" id="userName" class="form-control" placeholder="Elige un nombre de usuario">
            </div>
          </div>
          <div class="form-row my-4">
            <div class="col">
              <input type="email" value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>" required name="email" id="email" class="form-control" placeholder="Ingresa tu email">
            </div>
          </div>
          <div class="form-row my-4">
            <div class="col">
              <input type="password" required name="password" id="password" class="form-control" placeholder="Elige una contraseña">
            </div>
          </div>
          <div class="form-row my-4">
            <div class="col">
              <input type="password" required name="confirm_pwd" id="confirm_pwd" class="form-control" placeholder="Confirma la contraseña">
              <small id="confirm_error" class="text-danger"></small>
            </div>
          </div>
          <div class="submit-btn text-center my-5">
            <button type="submit" class="btn btn-warning rounded-pill text-dark px-5">Continuar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>