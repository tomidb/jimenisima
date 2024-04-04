<!-- Owl-carousel -->
<section id="banner-area">
                  <?php
    if(isset($_SESSION['message'])){
      ?>
        <div class="alert alert-warning mb-0" role="alert">
         <strong>Hey! </strong><?= $_SESSION['message']; ?>
        </div>
       <?php 
           unset($_SESSION['message']);
    }
  ?>
    <div class="owl-carousel owl-theme">
        <div class="item">
            <img src="./assets/Banner1.png" alt="Banner1">
        </div>
        <div class="item">
            <img src="./assets/Banner2.png" alt="Banner2">
        </div>
        <div class="item">
            <img src="./assets/Banner1.png" alt="Banner3">
        </div>
    </div>
</section>
<!-- !Owl-carousel -->
