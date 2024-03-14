<?php 

function validate_input_text($textValue){
  if(!empty($textValue)){
    $trim_text = trim($textValue);
    // remove ilegal character
    $sanitize_str = filter_var($trim_text, FILTER_SANITIZE_STRING);
    return $sanitize_str;
  }
  return '';
}

function validate_input_email($emailValue){
  if(!empty($emailValue)){
    $trim_text = trim($emailValue);
    // remove ilegal character
    $sanitize_str = filter_var($trim_text, FILTER_SANITIZE_EMAIL);
    return $sanitize_str;
  }
  return '';
}

function get_user_info($con, $user_id){
  $query = "SELECT user_id, userName, email, password, rol, dateReg FROM user WHERE user_id=?";
  $q = mysqli_stmt_init($con);
  mysqli_stmt_prepare($q, $query);
  //bind statement
  mysqli_stmt_bind_param($q, "i", $user_id);
  // execute sql statement
  mysqli_stmt_execute($q);
  $result = mysqli_stmt_get_result($q);
  $row = mysqli_fetch_array($result);

  return empty($row) ? false : $row;
  
}