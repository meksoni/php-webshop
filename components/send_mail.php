<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

//  KLIJENTOVI PODACI SA KONTAKT FORME



$clientName = $_POST['name'];
$clientPhone = $_POST['number'];
$clientEmail = $_POST['email'];
$paymentMethod = $_POST['method'];
$clientAddress = $_POST['flat'];
$clientCity = $_POST['city'];
$clientState = $_POST['state'];
$clientCountry = $_POST['country'];
$clientZip = $_POST['pin_code'];

$clientName = $_POST['name'];   //Ime
$clientSurname = $_POST['surname'];   //Prezime
$client = $_POST['client'];   //Email
$clientPhone = $_POST['phone'];   //Telefon
$clientCompany = $_POST['company']; //Firma  
$clientMessage = $_POST['message'];   //Poruka

$ourOffer = $_POST['service']; // Nasa Usluge & Njihovo Pitanje

//if(isset($_POST['submit'])) {


$mail = new PHPMailer(true);

if(isset($_POST['order']))  {

//Enable SMTP debugging.
$mail->SMTPDebug = 3;  

$mail->CharSet = 'UTF-8';
//Set PHPMailer to use SMTP.
$mail->isSMTP();            
//Set SMTP host name                          
$mail->Host = "smtp.cnt.rs";
//Set this to true if SMTP host requires authentication to send email
$mail->SMTPAuth = true;                 
//Provide username and password     
$mail->Username = "info@xyz-design.rs";  
$mail->Password = "KqMwLMbw";                    
//If SMTP requires TLS encryption then set it
$mail->SMTPSecure = 'tls';             
//Set TCP port to connect to
$mail->Port = 587;

$mail->From = $clientEmail;  // Poslato sa -> (Klijentov Email)
$mail->FromName = $clientName .' ~ '. $clientEmail;  

$mail->addAddress("info@xyz-design.rs", 'Centar Novih Tehnologija | Office');
$mail->addReplyTo($clientEmail); 



$mail->isHTML(true);

$mail->Subject = 'Podrska | www.cnt.rs';

$message = "<i>Ime:</i> " . "<b>$clientName</b>" . "<br>" . "<i>Prezime:</i> " . "<b>$clientSurname</b>" . "<br>" . "<i>Kontakt Telefon:</i> " . "<b>$clientPhone</b>" . "<br>" . "<i>Firma:</i> " . "<b>$clientCompany</b>" . "<br>" . "<i>Usluga:</i> " . "<b>$ourOffer</b>" . "<br><br>" . "<i>Poruka:</i> <br>" . "<b>$clientMessage</b>" ;
$mail->Body = $message;

try {
    $mail->send();
     header("Location: ../checkout.php?$message");
     e.preventDefault();
    echo "Message sent successfully!";
} catch (Exception $e) {
    header("Location: ../checkout.php");
    e.preventDefault();
    //echo "Mailer Error: " . $mail->ErrorInfo;  // Ako ima neki problem, ukljuciti opciju
}

} else {
    header("Location: ../checkout.php?$message", true);
}



?>