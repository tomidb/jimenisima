<?php 
$error = array();

$email = validate_input_email($_POST['email']);
if(empty($email)){
  $error[]= "Olvidaste introducir tu email";
}

$password = validate_input_text($_POST['password']);
if(empty($password)){
  $error[]= "Olvidaste introducir tu contraseña";
}

if(empty($error)){
// sql query
$query = "SELECT user_id, userName, email, password, rol, dateReg FROM user WHERE email=?";
$q = mysqli_stmt_init($db->con);
mysqli_stmt_prepare($q, $query);
// bind params
mysqli_stmt_bind_param($q, 's', $email);
// execute query
mysqli_stmt_execute($q);
$result = mysqli_stmt_get_result($q);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

if(!empty($row)){
  // verify password
  if(password_verify($password, $row['password'])){
    header('Location: index.php');
    exit();
  }
}else{
  print("Debes registrarte si aun no tienes cuenta.");
}
}else{
  echo "Completa el email y la contraseña para ingresar.";
}