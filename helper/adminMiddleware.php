<?php 
    if(isset($_SESSION['user_id'])){
      if($user['rol'] != 'admin'){
       $_SESSION['message'] = "No tienes permisos para acceder a esta página.";
       echo "<script>window.location.href='index.php'</script>";
       exit();
      }
    } else {
       $_SESSION['message'] = "Primero tienes que iniciar sesión.";
      echo "<script>window.location.href='login.php'</script>";
       exit();
    }
?>