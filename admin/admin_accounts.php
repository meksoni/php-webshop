<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_admins = $conn->prepare("DELETE FROM `admins` WHERE id = ?");
   $delete_admins->execute([$delete_id]);
   header('location:admin_accounts.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin Korisnici | Garderoba.rs</title>

   <link rel="apple-touch-icon" sizes="180x180" href="../images/apple-touch-icon.png">
   <link rel="icon" type="image/png" sizes="32x32" href="../images/favicon-32x32.png">
   <link rel="icon" type="image/png" sizes="16x16" href="../images/favicon-16x16.png">

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php'; ?>

<section class="accounts">

   <h1 class="heading">admin korisnici</h1>

   <div class="box-container">

   <div class="box">
      <p>Dodaj novog admina</p>
      <a href="register_admin.php" class="option-btn">Registruj Admina</a>
   </div>

   <?php
      $select_accounts = $conn->prepare("SELECT * FROM `admins`");
      $select_accounts->execute();
      if($select_accounts->rowCount() > 0){
         while($fetch_accounts = $select_accounts->fetch(PDO::FETCH_ASSOC)){   
   ?>
   <div class="box">
      <p> Admin ID : <span><?= $fetch_accounts['id']; ?></span> </p>
      <p> Admin Korisničko Ime : <span><?= $fetch_accounts['name']; ?></span> </p>
      <div class="flex-btn">
         <a href="admin_accounts.php?delete=<?= $fetch_accounts['id']; ?>" onclick="return confirm('Da li ste sigurni?')" class="delete-btn">Izbriši</a>
         <?php
            if($fetch_accounts['id'] == $admin_id){
               echo '<a href="update_profile.php" class="option-btn">Ažurirajte</a>';
            }
         ?>
      </div>
   </div>
   <?php
         }
      }else{
         echo '<p class="empty">Još uvek nema admin korisnika!</p>';
      }
   ?>

   </div>

</section>












<script src="../js/admin_script.js"></script>
   
</body>
</html>