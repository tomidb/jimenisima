<?php
session_start();
require ('DBController.php');
$db = new DBController();



if(isset($_POST['add_category_btn'])){
  $name = $_POST['name'];

  $cate_query = "INSERT INTO categories (name) VALUES ('$name')";
  $cate_query_run = mysqli_query($db->con, $cate_query);

  if($cate_query_run){
           $_SESSION['message'] = "Categoría añadida con éxito.";
            echo "<script>window.location.href='../add-category.php'</script>";
  }else{
           $_SESSION['message'] = "Algo salió mal.";
            echo "<script>window.location.href='../add-category.php'</script>";
  }

} else if (isset($_POST['edit_category_btn'])){
    $name = $_POST['name'];
    $id = $_POST['id'];

  $update_query = "UPDATE categories SET name='$name' WHERE id='$id'";
  $update_query_run = mysqli_query($db->con, $update_query);

  if($update_query_run){
           $_SESSION['message'] = "Categoría editada con éxito.";
            echo "<script>window.location.href='../categories.php'</script>";
  }else{
           $_SESSION['message'] = "Algo salió mal.";
            echo "<script>window.location.href='../edit-category.php'</script>";
  }


} else if (isset($_POST['del_category_btn'])){
  $category_id = mysqli_real_escape_string($db->con, $_POST['category_id']);
  $delete_query = "DELETE FROM categories WHERE id='$category_id'";
  $delete_query_run = mysqli_query($db->con,$delete_query);
  
  if($delete_query_run){
            $_SESSION['message'] = "Categoría eliminada con éxito.";
            echo "<script>window.location.href='../categories.php'</script>";
  }else{
                $_SESSION['message'] = "Algo salió mal.";
            echo "<script>window.location.href='../categories.php'</script>";
  }

} else if (isset($_POST['add_product_btn'])){
  $category = $_POST['category'];
  $name = $_POST['name'];
  $price = $_POST['price'];
  $qty = $_POST['qty'];

  $image = $_FILES['image']['name'];

  $path = "../assets/products";

  $image_ext = pathinfo($image, PATHINFO_EXTENSION);
  $filename = time().'.'.$image_ext;

  if($name != "" && $category != "" && $price != ""){
        $product_query = "INSERT INTO products ( category, name, price, image, qty ) VALUES ('$category','$name','$price','$filename','$qty')";

        $product_query_run = mysqli_query($db->con, $product_query);

        if($product_query_run){
          move_uploaded_file($_FILES['image']['tmp_name'], $path.'/'.$filename);
          $_SESSION['message'] = "Producto añadido con éxito.";
          echo "<script>window.location.href='../add-product.php'</script>";
        } else
        {
          $_SESSION['message'] = "Algo salió mal.";
          echo "<script>window.location.href='../add-product.php'</script>";
        }
  } else {
          $_SESSION['message'] = "Completa los campos requeridos.";
          echo "<script>window.location.href='../add-product.php'</script>";
  }


} else if (isset($_POST['update_product_btn'])){
  $product_id = $_POST['product_id'];

  $category = $_POST['category'];
  $name = $_POST['name'];
  $price = $_POST['price'];
  $qty = $_POST['qty'];

  $image = $_FILES['image']['name'];

  $path = "../assets/products";

  $new_image = $_FILES['image']['name'];
  $old_image = $_POST['old_image'];

  if($new_image != "")
  {
      $image_ext = pathinfo($new_image, PATHINFO_EXTENSION);
      $update_filename = time().'.'.$image_ext;
  }
  else
  {
    $update_filename = $old_image;
  }
 
  $update_product_query = "UPDATE products SET category='$category',name='$name',price='$price', qty='$qty', image='$update_filename' WHERE id='$product_id' ";
  $update_product_query_run = mysqli_query($db->con, $update_product_query);

  if($update_product_query_run){

      if($_FILES['image']['name'] != ""){

        move_uploaded_file($_FILES['image']['tmp_name'], $path.'/'.$update_filename);
        if(file_exists("../assets/products/$old_image")){
          unlink("../assets/products/$old_image");
        }
      }
          $_SESSION['message'] = "Producto actualizado con éxito.";
          echo "<script>window.location.href='../edit-product.php?id=$product_id'</script>";
  }
  else {
          $_SESSION['message'] = "Algo salió mal.";
          echo "<script>window.location.href='../edit-product.php?id=$product_id'</script>";
  }
} else if (isset($_POST['update_status_btn'])){
  $order_id = $_POST['order_id'];
  $order_status = $_POST['order_status'];
  if ($order_status == 0){
     echo "<script>window.location.href='../orders.php'</script>";
  } else if($order_status == 1) {
    $delete_order_query = "DELETE FROM orders WHERE order_id = $order_id";
    $delete_order_query_run = mysqli_query($db->con, $delete_order_query);
    $_SESSION['message'] = "Lista de pedidos en curso actualizada.";
    echo "<script>window.location.href='../orders.php'</script>";
  } else if ($order_status == 2){
    $order_products_query = "SELECT * FROM order_products WHERE order_id = $order_id";
    $order_products_query_run = mysqli_query($db->con, $order_products_query);
    foreach ($order_products_query_run as $product) {
      $order_product_qty = $product['product_qty'];
      $product_id = $product['product_id'];

      $get_qty_query = "SELECT qty FROM product WHERE item_id = $product_id";
      $stock_qty = mysqli_query($db->con, $get_qty_query);
      $row = mysqli_fetch_assoc($stock_qty);
      $actual_stock_qty = (int) $row['qty'];
      
      $new_stock_qty = $actual_stock_qty + $order_product_qty;

      $update_stock_qty = "UPDATE product SET qty = '$new_stock_qty' WHERE item_id = '$product_id'";
      $update_stock_qty_run = mysqli_query($db->con, $update_stock_qty);

      $delete_order_query = "DELETE FROM orders WHERE order_id = $order_id";
      $delete_order_query_run = mysqli_query($db->con, $delete_order_query);
      $_SESSION['message'] = "Lista de pedidos en curso actualizada.";
      echo "<script>window.location.href='../orders.php'</script>";
    }
  }
}

