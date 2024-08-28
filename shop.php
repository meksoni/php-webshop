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
   <title>Shop | neodigital.pro</title>

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

<section class="products">
   <h1 class="heading">Shop</h1>

   <section class="category">

        <!-- <a href="test-shop.php?category=muske+majice">
            <h3>Muške Majice</h3>
         </a>

         <a href="test-shop.php?category=muski+duks">
            <h3>Muške Dukserice</h3>
         </a> -->

   <div class="navigation_categories">

         <menu>
            <h2>Kategorije:</h2>            
            <a href="shop.php?category=muskarci">Muškarci</a>
            <a href="shop.php?category=zene">Žene</a>
            <a href="shop.php?category=sport">Sport</a>
         </menu>


         <menu>
            <h2>Muškarci:</h2>
            <a href="shop.php?category=muske+majice">Majice</a>
            <a href="shop.php?category=muski+duks">Duksevi</a>
            <a href="shop.php?category=muske+jakne">Jakne</a>
            <a href="shop.php?category=muske+trenerke">Trenerke</a>
            <h3>Obuća</h3>
            <a href="shop.php?category=muske+lifestyle">LifeStyle</a>
            <a href="shop.php?category=muske+sport+patike">Sport</a>
         </menu>

         <menu>
            <h2>Žene:</h2>
            <a href="shop.php?category=zenske+majice">Majice</a>
            <a href="shop.php?category=zenske+trenerke">Trenerke</a>
            <h3>Obuća</h3>
            <a href="shop.php?category=zenske+lifestyle">LifeStyle</a>
            <a href="shop.php?category=zenske+sport+patike">Sport</a>
         </menu>

         <menu>
            <h2>Sport:</h2>
            <a href="shop.php?category=fitnes">Teratana</a>
            <a href="shop.php?category=ranac">Rančevi</a>
            <a href="shop.php?category=lopte">Lopte</a>
         </menu>

         <menu>
            <h2>Brend:</h2>
            <a href="shop.php?category=nike">Nike</a>
            <a href="shop.php?category=adidas">Adidas</a>
            <a href="shop.php?category=puma">Puma</a>
            <a href="shop.php?category=reebok">Reebok</a>
         </menu>

         <input type="submit" value="submit">

   </div>


</section>

   <div class="box-container">

   <?php
     $category = $_GET['category'];
     $select_products = $conn->prepare("SELECT * FROM `products` WHERE name LIKE '%{$category}%' or details like '%{$category}%' or meta_tag like '%{$category}%'"); 
     $select_products->execute();
     if($select_products->rowCount() > 0){
      while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
            
   ?>
   <form action="" method="post" class="box">
      <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
      <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
      <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
      <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">
      <button class="fas fa-heart" type="submit" name="add_to_wishlist"></button>
      <a href="quick_view.php?pid=<?= $fetch_product['id']; ?>" class="fas fa-eye"></a>
      <img src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt="">
      <div class="name"><?= $fetch_product['name']; ?></div>
      <div class="flex">
         <div class="price"><span></span><?= $fetch_product['price']; ?><span> /- rsd</span></div>
         <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
      </div>
      <input type="submit" value="Dodaj u korpu" class="btn" name="add_to_cart">
   </form>
   <?php
      }
   }else{
      echo '<p class="empty">Nema na stanju!</p>';
   }
   ?>

   </div>

</section>

<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>