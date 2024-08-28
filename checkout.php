<?php

include 'components/connect.php';

session_start();


if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:user_login.php');
};


// PHP Mailer - Stizu poruke sa WEBSHOP-a , narudzbina sa klijentovim podacima.

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$myMail = "shop-garderoba@xyz-design.rs";
$myPassword = "csCO5g7r";
$myServer = "smtp.cnt.rs";
$mySmtpSecure = "tls";
$mySmtpAuth = "true";
$myPort = "587";

$mail = new PHPMailer(true);

if(isset($_POST['order'])) {

   $name = $_POST['name'];  // Klijentovo Ime
   $name = filter_var($name, FILTER_SANITIZE_STRING);

   $number = $_POST['number'];  //Klijentov Kontakt Telefon
   $number = filter_var($number, FILTER_SANITIZE_STRING);

   $email = $_POST['email'];  // Klijentov Email
   $email = filter_var($email, FILTER_SANITIZE_STRING);

   $method = $_POST['method'];  //Nacin Placanja
   $method = filter_var($method, FILTER_SANITIZE_STRING);

   $address = $_POST['flat'];  // Ulica i kucni broj
   $address = filter_var($address, FILTER_SANITIZE_STRING);

   $city = $_POST['city'];  // Grad
   $city = filter_var($city, FILTER_SANITIZE_STRING);

   $state = $_POST['state'];  // Opstina
   $state = filter_var($city, FILTER_SANITIZE_STRING);

   $country = $_POST['country'];   // Drzava
   $country = filter_var($country, FILTER_SANITIZE_STRING);

   $zip_code = $_POST['pin_code'];   // Postanski Broj Grada
   $zip_code = filter_var($zip_code, FILTER_SANITIZE_STRING);

   $total_products = $_POST['total_products'];  // Proizvodi koje je klijent porucio
   $total_price = $_POST['total_price'];  // Ukupna cena tih proizvoda

   $check_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
   $check_cart->execute([$user_id]);

   $mail->SMTPDebug = 1;   // smtp debug - sluzi za otklanjanje gresaka

   $mail->CharSet = 'UTF-8';

   $mail->isSMTP();   // Ovde kazemo Mailer-u da cemo da koristimo smtp podesavanja

   $mail->Host = $myServer;  // Host server

   $mail->SMTPAuth = $mySmtpAuth;   // Autentifikacija ( Ako SMTP ime Autentifikaciju )

   $mail->Username = $myMail;   // Nas mejl

   $mail->Password = $myPassword;   // Sifra mejla

   $mail->SMTPSecure = $mySmtpSecure;   // Ako SMTP Ima enkripciju

   $mail->Port = $myPort;   // 587 je standard -> ako ne radi na 587 probati na 25

   $mail->From = $email;   // Od koga nam stize mejl
   $mail->FromName = $name;

   $mail->addAddress($myMail, "Web Shop | Garderoba");   // Nasa Email adresa i odakle stize
   $mail->addReplyTo($email);   // Mozemo odgovoriti klijenti klikom na Reply , vec imamo njegovu email adresu

   $mail->isHTML(true);  // Setujemo PHP Mailer da koristimo HTML zbog poruke

   $mail->Subject = 'Web Shop | Nova Porudzbina';  // Subject Mejla

   // Poruka koja ce stici na mejl sa sajta
   $poruka = "<i>Ime:</i> " . "<b>$name</b>" . "<br>" .
              "<i>Kontakt Telefon:</i> " . "<b>$number</b>" . "<br>" .
              "<i>Email:</i> " . "<b>$email</b>" . "<br>" .
              "<i>Način Plaćanja:</i> " . "<b>$method</b>" . "<br>" .
              "<i>Adresa:</i> " . "<b>$address</b>" . "<br>" .
              "<i>Grad:</i> " . "<b>$city</b>" . "<br>" .
              "<i>Opština:</i> " . "<b>$state</b>" . "<br>" .
              "<i>Država:</i> " . "<b>$country</b>" . "<br>" .
              "<i>Poštanski Broj:</i> " . "<b>$zip_code</b>" . "<br><br>" .
              "<i>Proizvodi:</i> " . "<b>$total_products</b>" . "<br>" .
              "<i>Ukupna Cena:</i> " . "<b>$total_price</b> /- rsd";

   $mail->Body = $poruka;

   // Ovde gledamo da li stvarno ima nesto u korpi ako ima porucujemo  --- ako nema pogledati ELSE
   if($check_cart->rowCount() > 0){

      $insert_order = $conn->prepare("INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price) VALUES(?,?,?,?,?,?,?,?)");
      $insert_order->execute([$user_id, $name, $number, $email, $method, $address, $total_products, $total_price]);

      $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
      $delete_cart->execute([$user_id]);

      $mail->send();

      header("Location: checkout.php?success");
      e.preventDefault();

   }else{

      header("Location: checkout.php?error");
      e.preventDefault();
      //echo "Mailer Error: " . $mail->ErrorInfo;   // Ovo ukljucujemo ako Mejl ne stize na adresu -> Pogledati greske
   } 

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Poručite | neodigital.pro</title>

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

<section class="checkout-orders">

   <form action="" method="POST">

   <h3>Vaše porudžbine</h3>

   <div>
            <?php
            $message = 'Vaša korpa je prazna ili pokušajte kasnije!';

            if(isset($_GET['error'])) {
               echo '<div class="message_checkout">
                        <span>'.$message.'</span>
                        <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
                     </div>';
            }

            $message = 'Uspešno ste poručili, <a href="orders.php">proverite status vaše poruǆbine</a>.';

            if(isset($_GET['success'])) {
               echo '<div class="message_checkout">
                        <span>'.$message.'</span>
                        <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
                     </div>';
            }

            ?>
   </div>

      <div class="display-orders">
      <?php
         $grand_total = 0;
         $cart_items[] = '';
         $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
         $select_cart->execute([$user_id]);
         if($select_cart->rowCount() > 0){
            while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){
               $cart_items[] = $fetch_cart['name'].' ('.$fetch_cart['price'].' x '. $fetch_cart['quantity'].') - ';
               $total_products = implode($cart_items);
               $grand_total += ($fetch_cart['price'] * $fetch_cart['quantity']);
      ?>
         <p> <?= $fetch_cart['name']; ?> : <span>rsd (<?= ''.$fetch_cart['price'].'/- x '. $fetch_cart['quantity']; ?>)</span> </p>
      <?php
            }
         }else{
            echo '<p class="empty">Vaša korpa je prazna!</p>';
         }
      ?>
         <input type="hidden" name="total_products" value="<?= $total_products; ?>">
         <input type="hidden" name="total_price" value="<?= $grand_total; ?>" value="">
         <div class="grand-total">Ukupno : <span><?= $grand_total; ?>/- rsd</span></div>
      </div>

      <h3>Podaci za Naplatu</h3>

      <div class="flex">
         <div class="inputBox">
            <span>Vaše Ime :</span>
            <input type="text" name="name" placeholder="Unesite vaše Ime" class="box" maxlength="20" required>
         </div>
         <div class="inputBox">
            <span>Vaš Telefon :</span>
            <input type="number" name="number" placeholder="Unesite vaš Telefon" class="box" min="0" max="9999999999" onkeypress="if(this.value.length == 10) return false;" required>
         </div>
         <div class="inputBox">
            <span>Vaš Email :</span>
            <input type="email" name="email" placeholder="Unesite vaš Email" class="box" maxlength="50" required>
         </div>
         <div class="inputBox">
            <span>Način plaćanja:</span>
            <select name="method" class="box" required>
               <option value="Plaćanje pouzećem">Plaćanje pouzećem</option>
               <option value="Kartica">Karticom</option>
               <option value="Bitcoin">Bitcoin</option>
               <option value="PayPal">PayPal</option>
            </select>
         </div>
         <div class="inputBox">
            <span>Adresa :</span>
            <input type="text" name="flat" placeholder="Pere Popadića 15/3" class="box" maxlength="50" required>
         </div>

         <div class="inputBox">
            <span>Grad :</span>
            <input type="text" name="city" placeholder="Beograd" class="box" maxlength="50" required>
         </div>
         <div class="inputBox">
            <span>Opština :</span>
            <input type="text" name="state" placeholder="Karaburma" class="box" maxlength="50" required>
         </div>
         <div class="inputBox">
            <span>Država :</span>
            <input type="text" name="country" placeholder="Srbija" class="box" maxlength="50" required>
         </div>
         <div class="inputBox">
            <span>Poštanski Broj :</span>
            <input type="number" min="0" name="pin_code" placeholder="11000" min="0" max="999999" onkeypress="if(this.value.length == 6) return false;" class="box" required>
         </div>
      </div>

      <input type="submit" name="order" class="btn <?= ($grand_total > 1)?'':'disabled'; ?>" value="Poručite">

   </form>

</section>













<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>