<?php

include '../components/connect.php';

session_start();

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);

   $select_admin = $conn->prepare("SELECT * FROM `admins` WHERE name = ? AND password = ?");
   $select_admin->execute([$name, $pass]);
   $row = $select_admin->fetch(PDO::FETCH_ASSOC);

   if($select_admin->rowCount() > 0){
      $_SESSION['admin_id'] = $row['id'];
      header('location:dashboard.php');
   }else{
      $message[] = 'Pogrešno Korisničko Ime / Lozinka';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Administrator Login | Garderoba.rs</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">

   <link rel="apple-touch-icon" sizes="180x180" href="../images/apple-touch-icon.png">
   <link rel="icon" type="image/png" sizes="32x32" href="../images/favicon-32x32.png">
   <link rel="icon" type="image/png" sizes="16x16" href="../images/favicon-16x16.png">

</head>
<body>

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

<section class="form-container">

   <form action="" method="post">
      <h3>Ulogujte se</h3>
      <p>Test nalog username = <span>admin</span> & password = <span>111</span></p>
      <input type="text" name="name" required placeholder="Unesite vaše korisničko ime" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="pass" required placeholder="Unesite vašu lozinku" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="Ulogujte se" class="btn" name="submit">
   </form>

</section>
   
</body>
</html>