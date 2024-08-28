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
    <title>neodigital</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php include 'components/user_header.php'; ?>

<style>
   div {
      font-size:1.5rem;
   }
   input[type='checkbox'] {
      width:30px;
      height:30px;
      font-size:2rem;
   }

   button {
      height: 40px;
      font-size:2rem;
   }
</style>

    
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-3">
                    <div class="card-header">
                        <h4>Filter Kategorije</h4>
                    </div>
                </div>
            </div>

            <!-- Brand List  -->
            <div class="col-md-3">
                <form action="" method="GET">
                    <div class="card shadow mt-3">
                        <div class="card-header">
                            <h5>Filter 
                                <button type="submit" class="btn btn-primary  float-end">Search</button>
                            </h5>
                        </div>
                        <div class="card-body">
                            <h2>Kategorije</h2>
                            <hr>
                            <?php
                              $conn = mysqli_connect("localhost","xyzdev","xyzdesign","shop_db");

                                $brand_query = "SELECT * FROM category";
                                $brand_query_run  = mysqli_query($conn, $brand_query);

                                if(mysqli_num_rows($brand_query_run) > 0)
                                {
                                    foreach($brand_query_run as $brandlist)
                                    {
                                        $checked = [];
                                        if(isset($_GET['brands']))
                                        {
                                            $checked = $_GET['brands'];
                                        }
                                        ?>
                                            <div>
                                                <input type="checkbox" name="brands[]" value="<?= $brandlist['id']; ?>" 
                                                    <?php if(in_array($brandlist['id'], $checked)){ echo "checked"; } ?>
                                                 />
                                                <?= $brandlist['name']; ?>
                                            </div>
                                        <?php
                                    }
                                }
                                else
                                {
                                    echo "Trenutno nema kategorija!";
                                }
                            ?>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Brand Items - Products -->
            <div class="col-md-9 mt-3">
                <div class="card ">
                    <div class="card-body row">
                        <?php
                            if(isset($_GET['brands']))
                            {
                                $branchecked = [];
                                $branchecked = $_GET['brands'];
                                foreach($branchecked as $rowbrand)
                                {
                                    // echo $rowbrand;
                                    $products = "SELECT * FROM products WHERE category IN ($rowbrand) or sub_cat IN ($rowbrand) or brand IN ($rowbrand)";
                                    $products_run = mysqli_query($conn, $products);
                                    if(mysqli_num_rows($products_run) > 0)
                                    {
                                        foreach($products_run as $proditems) :
                                            ?>
                                                <div class="col-md-4 mt-3">
                                                    <div class="border p-2">
                                                        <h6><?= $proditems['name']; ?></h6>
                                                        <h6><?= $proditems['price']; ?></h6>
                                                    </div>
                                                </div>
                                            <?php
                                        endforeach;
                                    }
                                }
                            }
                            else
                            {
                                $products = "SELECT * FROM products";
                                $products_run = mysqli_query($conn, $products);
                                if(mysqli_num_rows($products_run) > 0)
                                {
                                    foreach($products_run as $proditems) :
                                        ?>
                                            <div class="col-md-4 mt-3" id="results">
                                                <div class="border p-2">
                                                    <h6><?= $proditems['name']; ?></h6>

                                                </div>
                                            </div>
                                        <?php
                                    endforeach;
                                }
                                else
                                {
                                    echo "Nema trazenih proizvoda";
                                }
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php include 'components/footer.php'; ?>

    <script src="js/script.js"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
