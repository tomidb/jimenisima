  <!DOCTYPE html>
  <html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Jimenisima</title>

      <!-- Bootstrap CDN -->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

      <!-- Owl-carousel CDN -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha256-UhQQ4fxEeABh4JrcmAJ1+16id/1dnlOEVCFOxDef9Lw=" crossorigin="anonymous" />
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha256-kksNxjDRxd/5+jGurZUJd1sdR2v+ClrCl3svESBaJqw=" crossorigin="anonymous" />

      <!-- font awesome icons -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />

      <!-- Custom CSS file -->
      <link rel="stylesheet" href="style.css">

      <?php
      session_start();
      // require functions.php file
      require('functions.php');
      // generate user info
      require('helper/helper.php');
    $user = array();
    if(isset($_SESSION['user_id'])){
      $user = get_user_info($db->con,$_SESSION['user_id']);

  // AGREGADOS 
      $user_id = $_SESSION['user_id'];
      $in_cart = $Cart->getCartId($Cart->getUserCartItems($user_id));
    }else {
      $user_id = '1'; 
      $in_cart = []; 
    }
      ?>

  </head>
  <body>

  <!-- start #header -->

  <header id="header">

      <div class="strip d-flex justify-content-between px-4 py-1 bg-light">
          <p class="font-rale font-size-12 text-black-50 m-0">Hello! I'm Tomás de Breuil and i'm working here.<?php
              if(isset($_SESSION['user_id'])){
              echo $user['userName'];
              echo $user['user_id'];
                  } else {
                    echo "NO HAY NADIE ON";
                  }
                  ?>
          </p>
          <div class="font-rale font-size-14">
              <a href="#" class="px-3 border-right border-left text-dark">Login</a>
              <a href="#" class="px-3 border-right text-dark">Whishlist (0)</a>
          </div>
      </div>

      <!-- Primary Navigation -->
      <nav class="navbar navbar-expand-lg navbar-dark color-second-bg">
          <a class="navbar-brand" href="index.php"><img src="assets/jimenisima.png" class="jimenisima-logo" alt="Jimenisima"> Jimenísima</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
              <ul class="navbar-nav m-auto font-rubik">

                  <li class="nav-item active">
                      <a class="nav-link" href="#">Categorías <i class="fas fa-chevron-down"></i></a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="index.php#top-sale">Nuevos productos</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="index.php#blogs">La tienda en ferias</a>
                  </li>
                  <?php
                  if(isset($_SESSION['user_id']) && isset($user['email']) && $user['email'] == 'admin@jimenisima.com'){?>
                      <li class="nav-item">
                          <a class="nav-link" href="admin.php">Admin Panel</a>
                      </li>
                  <?php } ?>
                  <?php
                    if(isset($_SESSION['user_id'])) {
                   ?>
                    <li class="nav-item">
                      <a class="nav-link" href="logout.php">Cerrar sesión</a>
                    </li>
                  <?php
                  } else {
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="register.php">Registrarse</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Iniciar sesión</a>
                    </li>
                    <?php
                }
              ?>
              </ul>
              <form action="#" class="font-size-14 font-rale">  
                  <a href="cart.php" class="py-2 rounded-pill color-primary-bg">
                      <span class="font-size-16 px-2 text-white"><i class="fas fa-shopping-cart"></i></span>
                      <span class="px-3 py-2 rounded-pill text-dark bg-light"><?php 
                        if(isset($_SESSION['user_id'])) {
                        echo count($Cart->getUserCartItems($_SESSION['user_id']));
                        } else {
                          echo '0';
                        }
                       ?></span>
                  </a>
              </form>
          </div>
      </nav>
      <!-- !Primary Navigation -->

  </header>
  <!-- !start #header -->

  <!-- start #main-site -->
  <main id="main-site">