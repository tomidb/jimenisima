<?php
// Incluye DBController.php para tener acceso a la clase DBController
include_once('DBController.php');

// Definición de la función getData()
function getAll($db, $table = 'product') {
  $query = "SELECT * FROM $table";
  return $query_run = mysqli_query($db->con, $query);
    /*
    $result = $db->con->query("SELECT * FROM {$table}");
    $resultArray = array();

    // Fetch product data one by one
while ($item = mysqli_fetch_assoc($result)) {
    $resultArray[] = $item;
}

    return $resultArray;
     */
}

function getByID($db, $table, $id){
  $query = "SELECT * FROM $table WHERE id='$id'";
  return $query_run = mysqli_query($db->con, $query);
  /*
    $result = $db->con->query("SELECT * FROM {$table} WHERE id='$id'");
    $resultArray = array();

    while ($item = mysqli_fetch_assoc($result)) {
    $resultArray[] = $item;
}

    return $resultArray;
    */
}
?>
