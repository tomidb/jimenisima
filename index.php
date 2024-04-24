<?php
error_reporting(E_ALL);
 ini_set('display_errors', 10);
    ob_start();
    // include header.php file
    include ('header.php');
?>

<?php

    /*  include banner area  */
        include ('Template/_banner-area.php');
    /*  include banner area  */

    /*  include new products section  */
        include ('Template/_new-phones.php');
    /*  include new products section  */

    /*  include categories section  */
         include ('Template/_special-price.php');
    /*  include categories section  */

    /*  include blog area  */
         include ('Template/_blogs.php');
    /*  include blog area  */

?>


<?php
// include footer.php file
include ('footer.php');
?>