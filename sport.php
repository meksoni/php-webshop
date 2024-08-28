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
     <title>Sport Oprema | neodigital.pro</title>

     <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />


   <link rel="apple-touch-icon" sizes="180x180" href="images/apple-touch-icon.png">
   <link rel="icon" type="image/png" sizes="32x32" href="images/favicon-32x32.png">
   <link rel="icon" type="image/png" sizes="16x16" href="images/favicon-16x16.png">
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section class="category">

   <h1 class="heading">Oprema za Sport</h1>

   <div class="swiper category-slider">

   <div class="swiper-wrapper category-swipper_wrapper">

   <a href="category.php?category=fitnes" class="swiper-slide slide">
      <img src="images/fitnes.png" alt="">
      <h3>Teretana</h3>
   </a>

   <a href="category.php?category=ranac" class="swiper-slide slide">
      <img src="images/backpack.png" alt="">
      <h3>Ranac</h3>
   </a>

   <a href="category.php?category=lopte" class="swiper-slide slide">
      <img src="images/ball-main.png" alt="">
      <h3>Lopte</h3>
   </a>

   </div>

   </div>

</section>












<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<script src="js/swipper_for_solo_page.js"></script>

</body>
</html>