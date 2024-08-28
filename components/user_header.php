<?php
   if(isset($message)){
      foreach($message as $message){
         echo '
         <div class="message">
            <span>'.$message.'</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
         </div>
         ';
      }
   }
?>

<header class="header">

   <section class="flex">

      <a href="home.php" class="logo">
         <img src="./images/logo.png" width="70px" alt="">
      </a>

      <nav class="navbar">
         <a href="home.php">Home</a>
         <!-- <a href="about.php">About</a> -->
         <a href="man.php">Muškarci</a>
         <a href="woman.php">Žene</a>
         <a href="sport.php">Sport</a>
         <a href="orders.php">Porudžbine</a>
         <a href="shop.php">Shop</a>
         <a href="contact.php">Kontakt</a>
      </nav>

      <div class="icons">
         <?php
            $count_wishlist_items = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ?");
            $count_wishlist_items->execute([$user_id]);
            $total_wishlist_counts = $count_wishlist_items->rowCount();

            $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
            $count_cart_items->execute([$user_id]);
            $total_cart_counts = $count_cart_items->rowCount();
         ?>
         <div id="menu-btn" class="fas fa-bars"></div>
         <a href="search_page.php"><i class="fas fa-search"></i></a>
         <a href="wishlist.php"><i class="fas fa-heart"></i><span>(<?= $total_wishlist_counts; ?>)</span></a>
         <a href="cart.php"><i class="fas fa-shopping-cart"></i><span>(<?= $total_cart_counts; ?>)</span></a>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="profile">
         <?php          
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$user_id]);
            if($select_profile->rowCount() > 0){
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <p>Dobrodošli: ~ <?= $fetch_profile["name"]; ?></p>
         <p><?= $fetch_profile["email"]; ?></p>
         <a href="update_user.php" class="btn">Ažurirajte profil</a>
         <a href="components/user_logout.php" class="delete-btn" onclick="return confirm('Sigurni ste?');">Izlogujte se</a> 
         <?php
            }else{
         ?>
         <p>Registracija / Logovanje</p>
         <div class="flex-btn">
            <a href="user_register.php" class="option-btn">Registrujte se</a>
            <a href="user_login.php" class="option-btn">Ulogujte se</a>
         </div>
         <?php
            }
         ?>      
         
         
      </div>

   </section>

</header>