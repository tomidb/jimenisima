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
            <img src="./assets/banner-1.jpg" alt="Banner1" class="banner-img">
        </div>
        <div class="item">
            <img src="./assets/banner-2.jpg" alt="Banner2" class="banner-img">
        </div>
        <div class="item">
            <img src="./assets/banner-3.jpg" alt="Banner3" class="banner-img">
        </div>
    </div>
</section>
<!-- !Owl-carousel -->
