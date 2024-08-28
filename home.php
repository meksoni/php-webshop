<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

include 'components/wishlist_cart.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta name="description" content="Author Of This Project is Mihajlo Varga from Ruma, Serbia">
   <title>Početna | neodigital.pro</title>

   <link rel="apple-touch-icon" sizes="180x180" href="images/apple-touch-icon.png">
   <link rel="icon" type="image/png" sizes="32x32" href="images/favicon-32x32.png">
   <link rel="icon" type="image/png" sizes="16x16" href="images/favicon-16x16.png">
   
   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<div class="home-bg">

<section class="home">

   <div class="swiper home-slider">
   
   <div class="swiper-wrapper">

      <div class="swiper-slide slide">
         <div class="image">
            <img src="images/banner_img_1.png" alt="">
         </div>
         <div class="content">
            <span>popusti do 50% na</span>
            <h3>Muške LifeStyle Patike</h3>
            <a href="category.php?category=muske+lifestyle" class="btn">Pogledajte ponudu</a>
         </div>
      </div>

      <div class="swiper-slide slide">
         <div class="image">
            <img src="images/banner_img_3.png" alt="">
         </div>
         <div class="content">
            <span>popusti do 30% na</span>
            <h3>Sportsku Opremu</h3>
            <a href="category.php?category=sport" class="btn">Pogledajte ponudu</a>
         </div>
      </div>

      <div class="swiper-slide slide">
         <div class="image">
            <img src="images/banner_img_2.png" alt="">
         </div>
         <div class="content">
            <span>popusti do 50% na</span>
            <h3>Muški Nike Duksevi</h3>
            <a href="category.php?category=muski+nike+duks" class="btn">Pogledajte ponudu</a>
         </div>
      </div>

   </div>

      <div class="swiper-pagination"></div>

   </div>

</section>

</div>

<section class="category">

   <h1 class="heading">Kategorije</h1>

   <div class="swiper category-slider">

   <div class="swiper-wrapper category-swipper_wrapper">

   <a href="man.php" class="swiper-slide slide" style="width:3px;">
      <img src="images/man.png" alt="">
      <h3>Muškarci</h3>
   </a>

   <a href="woman.php" class="swiper-slide slide">
      <img src="images/woman.png" alt="">
      <h3>Žene</h3>
   </a>

   <a href="sport.php" class="swiper-slide slide">
      <img src="images/sport.png" alt="">
      <h3>Sport</h3>
   </a>

   </div>

   </div>

</section>

<section class="home-products">

   <h1 class="heading">popularni proizvodi</h1>

   <div class="swiper products-slider">

   <div class="swiper-wrapper">

   <?php
     $select_products = $conn->prepare("SELECT * FROM `products` order by RAND() LIMIT 6"); 
     $select_products->execute();
     if($select_products->rowCount() > 0){
      while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
   ?>
   <form action="" method="post" class="swiper-slide slide">
      <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
      <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
      <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
      <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">
      <button class="fas fa-heart" type="submit" name="add_to_wishlist"></button>
      <a href="quick_view.php?pid=<?= $fetch_product['id']; ?>" class="fas fa-eye"></a>
      <img src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt="">
      <div class="name"><?= $fetch_product['name']; ?></div>
      <div class="flex">
         <div class="price"><?= $fetch_product['price']; ?> <span>/- rsd</span></div>
         <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
      </div>
      <input type="submit" value="Dodaj u korpu" class="btn" name="add_to_cart">
   </form>
   <?php
      }
   }else{
      echo '<p class="empty">Još uvek nemate dodatih proizvoda na prodavnici!</p>';
   }
   ?>

   </div>

   <div class="swiper-pagination"></div>

   </div>

</section>









<?php include 'components/footer.php'; ?>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<script src="js/script.js"></script>

<script>

var swiper = new Swiper(".home-slider", {
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   autoplay: {
      delay:5000,
   }
});

 var swiper = new Swiper(".category-slider", {
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   loop:false,
   spaceBetween: 20,
   // autoplay: {
   //    false
   // },

   
   breakpoints: {
      0: {
         slidesPerView: 2,
       },
      650: {
        slidesPerView: 3,
      },
      768: {
        slidesPerView: 4,
      },
      1024: {
        slidesPerView: 5,
      },
   },
});

var swiper = new Swiper(".products-slider", {
   loop:true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   breakpoints: {
      550: {
        slidesPerView: 2,
      },
      768: {
        slidesPerView: 2,
      },
      1024: {
        slidesPerView: 3,
      },
   },
});

</script>

</body>
</html>