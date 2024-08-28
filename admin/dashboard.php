<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin Dashboard | Garderoba.rs</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">

   <link rel="apple-touch-icon" sizes="180x180" href="../images/apple-touch-icon.png">
   <link rel="icon" type="image/png" sizes="32x32" href="../images/favicon-32x32.png">
   <link rel="icon" type="image/png" sizes="16x16" href="../images/favicon-16x16.png">

</head>
<body>

<?php include '../components/admin_header.php'; ?>

<section class="dashboard">

   <h1 class="heading">dashboard</h1>

   <div class="box-container">

      <div class="box">
         <h3>Dobrodošli!</h3>
         <p><?= $fetch_profile['name']; ?></p>
         <a href="update_profile.php" class="btn">Ažurirajte profil</a>
      </div>

      <div class="box">
         <?php
            $total_pendings = 0;
            $select_pendings = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
            $select_pendings->execute(['pending']);
            if($select_pendings->rowCount() > 0){
               while($fetch_pendings = $select_pendings->fetch(PDO::FETCH_ASSOC)){
                  $total_pendings += $fetch_pendings['total_price'];
               }
            }
         ?>
         <h3><span></span><?= $total_pendings; ?><span> /- rsd</span></h3>
         <p>Poruǆbine na čekanju</p>
         <a href="placed_orders.php" class="btn">Poruǆbine</a>
      </div>

      <div class="box">
         <?php
            $total_completes = 0;
            $select_completes = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
            $select_completes->execute(['completed']);
            if($select_completes->rowCount() > 0){
               while($fetch_completes = $select_completes->fetch(PDO::FETCH_ASSOC)){
                  $total_completes += $fetch_completes['total_price'];
               }
            }
         ?>
         <h3><span></span><?= $total_completes; ?><span> /- rsd</span></h3>
         <p>Završene Poruǆbine</p>
         <a href="placed_orders.php" class="btn">Poruǆbine</a>
      </div>

      <div class="box">
         <?php
            $select_orders = $conn->prepare("SELECT * FROM `orders`");
            $select_orders->execute();
            $number_of_orders = $select_orders->rowCount()
         ?>
         <h3><?= $number_of_orders; ?></h3>
         <p>Ukupno Poruǆbina</p>
         <a href="placed_orders.php" class="btn">Poruǆbine</a>
      </div>

      <div class="box">
         <?php
            $select_products = $conn->prepare("SELECT * FROM `products`");
            $select_products->execute();
            $number_of_products = $select_products->rowCount()
         ?>
         <h3><?= $number_of_products; ?></h3>
         <p>Ukupno Proizvoda</p>
         <a href="products.php" class="btn">Proizvodi</a>
      </div>

      <div class="box">
         <?php
            $select_users = $conn->prepare("SELECT * FROM `users`");
            $select_users->execute();
            $number_of_users = $select_users->rowCount()
         ?>
         <h3><?= $number_of_users; ?></h3>
         <p>Ukupno Korisnika</p>
         <a href="users_accounts.php" class="btn">Korisnici</a>
      </div>

      <div class="box">
         <?php
            $select_admins = $conn->prepare("SELECT * FROM `admins`");
            $select_admins->execute();
            $number_of_admins = $select_admins->rowCount()
         ?>
         <h3><?= $number_of_admins; ?></h3>
         <p>Ukupno Admin korisnika</p>
         <a href="admin_accounts.php" class="btn">Admini</a>
      </div>

      <div class="box">
         <?php
            $select_messages = $conn->prepare("SELECT * FROM `messages`");
            $select_messages->execute();
            $number_of_messages = $select_messages->rowCount()
         ?>
         <h3><?= $number_of_messages; ?></h3>
         <p>Ukupno poruka</p>
         <a href="messages.php" class="btn">Poruke</a>
      </div>

   </div>

</section>












<script src="../js/admin_script.js"></script>
   
</body>
</html>