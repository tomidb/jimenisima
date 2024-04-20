<?php
ob_start();
// include header.php file
include ('header.php');
?>

<?php
    /*  include cart items if it is not empty */
    if(isset($user_id)){
              count($Cart->getUserCartItems($user_id)) ? include ('Template/_cart-template.php') :  include ('Template/notFound/_cart_notFound.php');
    } else {
      include ('Template/notFound/_cart_notFound.php');
    }

    /*  include top sale section */
        include ('Template/_new-phones.php');
    /*  include top sale section */
?>

<?php
// include footer.php file
include ('footer.php');
?>


