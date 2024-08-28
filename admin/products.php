<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};

if(isset($_POST['add_product'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $price = $_POST['price'];
   $price = filter_var($price, FILTER_SANITIZE_STRING);
   $details = $_POST['details'];
   $details = filter_var($details, FILTER_SANITIZE_STRING);

   $meta_tag = $_POST['meta_tag'];
   $meta_tag = filter_var($meta_tag, FILTER_SANITIZE_STRING);

   $image_01 = $_FILES['image_01']['name'];
   $image_01 = filter_var($image_01, FILTER_SANITIZE_STRING);
   $image_size_01 = $_FILES['image_01']['size'];
   $image_tmp_name_01 = $_FILES['image_01']['tmp_name'];
   $image_folder_01 = '../uploaded_img/'.$image_01;
   

   $image_02 = $_FILES['image_02']['name'];
   $image_02 = filter_var($image_02, FILTER_SANITIZE_STRING);
   $image_size_02 = $_FILES['image_02']['size'];
   $image_tmp_name_02 = $_FILES['image_02']['tmp_name'];
   $image_folder_02 = '../uploaded_img/'.$image_02;

   $image_03 = $_FILES['image_03']['name'];
   $image_03 = filter_var($image_03, FILTER_SANITIZE_STRING);
   $image_size_03 = $_FILES['image_03']['size'];
   $image_tmp_name_03 = $_FILES['image_03']['tmp_name'];
   $image_folder_03 = '../uploaded_img/'.$image_03;


   $select_products = $conn->prepare("SELECT * FROM `products` WHERE name = ?");
   $select_products->execute([$name]);

   if($select_products->rowCount() > 10000){
      $message[] = 'Proizvod već postoji!';
   }else{

      $insert_products = $conn->prepare("INSERT INTO `products`(name, details, price, image_01, image_02, image_03, meta_tag) VALUES(?,?,?,?,?,?,?)");
      $insert_products->execute([$name, $details, $price, $image_01, $image_02, $image_03, $meta_tag]);

      if($insert_products){
         if($image_size_01 > 2000000 OR $image_size_02 > 2000000 OR $image_size_03 > 2000000){
            $message[] = 'Velicina slike je prevelika!';
         }else{
            move_uploaded_file($image_tmp_name_01, $image_folder_01);
            move_uploaded_file($image_tmp_name_02, $image_folder_02);
            move_uploaded_file($image_tmp_name_03, $image_folder_03);
            $message[] = 'Uspesno ste dodali proizvod!';
         }

      }

   }  

};

if(isset($_GET['delete'])){

   $delete_id = $_GET['delete'];
   $delete_product_image = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
   $delete_product_image->execute([$delete_id]);
   $fetch_delete_image = $delete_product_image->fetch(PDO::FETCH_ASSOC);
   unlink('../uploaded_img/'.$fetch_delete_image['image_01']);
   unlink('../uploaded_img/'.$fetch_delete_image['image_02']);
   unlink('../uploaded_img/'.$fetch_delete_image['image_03']);
   $delete_product = $conn->prepare("DELETE FROM `products` WHERE id = ?");
   $delete_product->execute([$delete_id]);
   $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE pid = ?");
   $delete_cart->execute([$delete_id]);
   $delete_wishlist = $conn->prepare("DELETE FROM `wishlist` WHERE pid = ?");
   $delete_wishlist->execute([$delete_id]);
   header('location:products.php');
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Proizvodi | Garderoba.rs</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">

   <link rel="apple-touch-icon" sizes="180x180" href="../images/apple-touch-icon.png">
   <link rel="icon" type="image/png" sizes="32x32" href="../images/favicon-32x32.png">
   <link rel="icon" type="image/png" sizes="16x16" href="../images/favicon-16x16.png">

</head>
<body>

<?php include '../components/admin_header.php'; ?>

<section class="add-products">

   <h1 class="heading">Dodajte novi proizvod</h1>

   <form action="" method="post" enctype="multipart/form-data">
      <div class="flex">
         <div class="inputBox">
            <span>Naziv proizvoda*</span>
            <input type="text" class="box" required maxlength="100" placeholder="Unesite naziv proizvoda" name="name">
         </div>
         <div class="inputBox">
            <span>Cena proizvoda*</span>
            <input type="number" min="0" class="box" required max="9999999999" placeholder="Unesite cenu proizvoda" onkeypress="if(this.value.length == 10) return false;" name="price">
         </div>
        <div class="inputBox" id="dropContainer">
            <span>Slika 1* <small>( ili prevucite fotografiju )</small></span>
            <input type="file" name="image_01" accept="image/jpg, image/jpeg, image/png, image/webp" class="box" required id="fileInput">
        </div>
        <div class="inputBox" id="dropContainer">
            <span>Slika 2</span>
            <input type="file" name="image_02" accept="image/jpg, image/jpeg, image/png, image/webp" class="box" id="fileInput">
        </div>
        <div class="inputBox" id="dropContainer">
            <span>Slika 3</span>
            <input type="file" name="image_03" accept="image/jpg, image/jpeg, image/png, image/webp" class="box" id="fileInput">
        </div>
         <div class="inputBox">
            <span>Detalji proizvoda*</span>
            <textarea name="details" placeholder="Unesite detalje proizvoda" class="box" required maxlength="500" cols="30" rows="10"></textarea>
         </div>

         <div class="inputBox">
            <span>Meta Tag*</span>
            <input type="text" name="meta_tag" placeholder="Unesite Meta Tagove Za Proizvod" class="box" required>
         </div>


      </div>
      
      <input type="submit" value="Dodajte proizvod" class="btn" name="add_product">
   </form>

   <div class="meta_tagovi">
         <h1>Meta Tagovi</h1>
         <p>Lopta - <br><span>lopta,sport,adidas,lopte</span></p>
         <div class="line"></div>
         <p>Teretana - <br><span>teg,sport,trening,tegovi,fitnes,teretana</span></p>
         <div class="line"></div>
         <p>Muške LifeStyle Patike - <br><span>patike,adidas,lifestyle,muske, muske patike, muške patike, muškarci,muskarci, muske lifestyle</span></p>
         <div class="line"></div>
         <p>Muške Sport Patike - <br><span>muske sport patike,patike,nike,sport,muske,muske patike, muške patike, muškarci,muskarci</span></p>
         <div class="line"></div>
         <p>Ženske LifeStyle Patike <br><span>zenske lifestyle,patike,nike,lifestyle,ženske, zenske patike, ženske patike, žene,zene</span></p>
         <div class="line"></div>
         <p>Ženske Sport Patike <br><span>zenske sport patike,patike,nike,sport,zenske,zenske patike, ženske patike,žene,zene</span></p>
         <div class="line"></div>
   
         <h2>Majice - Duksevi - Trenerke - Jakne</h2>
   
         <h3>Muškarci</h3>
         <p><span>jakna,jakne,adidas,jakne za zimu,muske,muške,muske jakne, muške jakne, muškarci,muskarci</span></p>
         <p>Samo menjate brend,marku,model</p>
         <div class="line"></div>
   
         <h3>Žene</h3>
         <p><span>majica,majice,reebok,zenske,ženske,zenske majice, ženske majice, žene,zene</span></p>
         <p>Samo menjate brend,marku,model</p>
         <div class="line"></div>
   </div>

</section>

<section class="show-products">

   <h1 class="heading">Dodati proizvodi</h1>

   <div class="box-container">

   <?php
      $select_products = $conn->prepare("SELECT * FROM `products`");
      $select_products->execute();
      if($select_products->rowCount() > 0){
         while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){ 
   ?>
   <div class="box">
      <img src="../uploaded_img/<?= $fetch_products['image_01']; ?>" alt="">
      <div class="name"><?= $fetch_products['name']; ?></div>
      <div class="price"><span><?= $fetch_products['price']; ?></span> /- rsd</div>
      <div class="details"><span><?= $fetch_products['details']; ?></span></div>
      <div class="flex-btn">
         <a href="update_product.php?update=<?= $fetch_products['id']; ?>" class="option-btn">Azurirajte</a>
         <a href="products.php?delete=<?= $fetch_products['id']; ?>" class="delete-btn" onclick="return confirm('delete this product?');">Obrisite</a>
      </div>

      <div style="display:none;"><p><?php $fetch_products['meta_tag']; ?></p></div>
   </div>
   <?php
         }
      }else{
         echo '<p class="empty">Jos uvek nemate dodatih proizvoda na prodavnici!</p>';
      }
   ?>
   
   </div>

</section>








<script src="../js/admin_script.js"></script>

<script>
   dropContainer.ondragover = dropContainer.ondraggenter = function(evt) {
      dropContainer.ondrop = function(evt) {
         fileInput.files = evt.dataTransfer.files;
      }
   }
</script>

   
</body>
</html>