<?php
//error validate
$error = array();

$userName = validate_input_text($_POST['userName']);
if(empty($userName)){
  $error[]= "Olvidaste elegir un nombre de usuario";
}

$email = validate_input_email($_POST['email']);
if(empty($email)){
  $error[]= "Olvidaste introducir tu email";
}

$password = validate_input_text($_POST['password']);
if(empty($password)){
  $error[]= "Olvidaste introducir tu contraseña";
}

$confirm_pwd = validate_input_text($_POST['confirm_pwd']);
if(empty($confirm_pwd)){
  $error[]= "Olvidaste confirmar la contraseña";
}

// check if email already exist
$check_email_query = "SELECT email FROM user WHERE email='$email'";
$check_email_query_run = mysqli_query($db->con, $check_email_query);

if(mysqli_num_rows($check_email_query_run) > 0){
    $_SESSION['message'] = "Ya existe una cuenta registrada con ese email.";
} else {
    if(empty($error)){  
      // register new user
    $hashed_pass = password_hash($password, PASSWORD_DEFAULT);
    // create query
    $query = "INSERT INTO user (user_id, userName, email, password, rol, dateReg)";
    $query .= "VALUES ('', ?, ?, ?, 'user', current_timestamp())";
    //initialize statement
    $q = mysqli_stmt_init($db->con);
    mysqli_stmt_prepare($q, $query);
    // bind query values
    mysqli_stmt_bind_param($q, 'sss', $userName, $email, $hashed_pass);
    // execute stmt
    mysqli_stmt_execute($q);
    if(mysqli_stmt_affected_rows($q)  == 1){
      //start a new session
      //create session variable
      $_SESSION['user_id'] = mysqli_insert_id($db->con);
      echo "<script>window.location.href='index.php'</script>";
      exit();
    exit();
    } else{
      print("Error while registration");
    }
    }else{
    echo 'not validate';
    }
}
