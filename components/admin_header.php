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

      <a href="../admin/dashboard.php" class="logo">Admin<span>Panel</span>.</a>

      <nav class="navbar">
         <a href="../admin/dashboard.php">Dashboard</a>
         <a href="../admin/products.php">Proizvodi</a>
         <a href="../admin/placed_orders.php">Porudzbine</a>
         <a href="../admin/admin_accounts.php">Admin</a>
         <a href="../admin/users_accounts.php">Korisnici</a>
         <a href="../admin/messages.php">Poruke</a>
      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="profile">
         <?php
            $select_profile = $conn->prepare("SELECT * FROM `admins` WHERE id = ?");
            $select_profile->execute([$admin_id]);
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <p>Dobrodosli ~ <?= $fetch_profile['name']; ?></p>
         <a href="../admin/update_profile.php" class="btn">Izmenite profil</a>
         <!-- <div class="flex-btn">
            <a href="../admin/register_admin.php" class="option-btn">register</a>
            <a href="../admin/admin_login.php" class="option-btn">login</a>
         </div> -->
         <a href="../components/admin_logout.php" class="delete-btn" onclick="return confirm('Da li ste sigurni?');">Izlogujte se</a> 
      </div>

   </section>

</header>