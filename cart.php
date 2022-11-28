<?php
    define('ILAW',true);
    include('database_connection.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ILAW</title>
    <link rel = "shortcut icon" type="image/x-icon" href="images/Logo/ILAW_Logo2.png" />
    <!-- Font Awesome icons (free version)-->
    <script src="linkscript/fontawesome.js"></script>
    <!-- Owl Carousel (free version)-->
    <link rel="stylesheet" href="linkscript/bootstrap5.1.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="linkscript/owl.carousel.css" crossorigin="anonymous" />
    <script src="linkscript/jquery-1.12.4.min.js" crossorigin="anonymous"></script>
    <script src="linkscript/owl.carousel.min.js" crossorigin="anonymous"></script>
    <!-- Custom CSS-->
    <link href="admin/assets/css/style_loader.css" rel="stylesheet" />
    <link href="css/owl_carousel.css" rel="stylesheet" />
    <link href="css/style_e-commerce.css" rel="stylesheet" />
		<link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<!--Page loader-->
<div class="loader-wrapper overlay">
    <div class="loader-circle">
        <div class="loader"></div>
    </div>
</div>
<!--Page loader-->
<body>
  
<?php
  if (isset($_SESSION['type'])) {
    if ($_SESSION['type'] == 'master') {
      $active = " ";
      include("headers/admin_header.php");
    } elseif ($_SESSION['type'] == 'staff') {
      $active = " ";
      include("headers/staff_header.php");
    } else {
      $active = " ";
      include("headers/customer_header.php");
    }
  } else {
    $active = " ";
    include("headers/guest_header.php");
  }
  ?>

    <section class="first_section">
    <div class ="BG_Cover">
        <img class="mySlides" src="images/Others/BG_Stairs.png">
        <img class="mySlides" src="images/Others/BG_Houses.png">
        <img class="mySlides" src="images/Others/BG_TV.png">
        <div class= "column">
        <h1>ILAW Lighting and Equipment Trading</h1>
        <h2>"Making life brighter one Filipino home at a time."</h2>
        <button class ="shopnow_btn" onclick="window.location='product.php#productnow';" type="button">Shop Now</button>   
        </div>       
    </div>
    </section>
    <section id="cart" class= "second_section" >
    <div class = "line_PFOS">
          <h1>Shopping Cart</h1>
          <p> ILAW Lighting and Equipment Trading introduce you the virtual shopping cart in which it allows you to save products that you prefer, order it later or collect products to checkout. </p>
        </div>
    </section>
    <section class= "third_section" >
      <!--<div class="no_item fade">
      <br>
      <br>
      <br>
        <h1>There are no items added.</h1>
        <p>You must first add items to your shopping cart before proceeding to checkout.<br>
On our website, you can discover a wide variety of items with awesome features.</p>
<button class ="shopnow_btn" onclick="window.location='product.php #productnow';" type="button">Go Shopping Now!</button> 
        <br><br><br>
      </div> -->
      <div class="col-md-12" id="cart_msg">
				<!--Cart Message--> 
			</div>
      <div class="item_cart">
      <div class="display_product">
        <div class = "product_container2">
          <div class="table-responsive product-list m-3">
            <div id="cart_checkout">
          
              
			
         
            </div>
          </div>
        </div>
      </div>
    </section>

    <script>var CURRENCY = '<?php echo CURRENCY; ?>';</script>
    <?php
          include("footer/footer.php")
    ?>
    <script src="js/functions.js" type="text/javascript"></script>
    <script src="js/jquery2.js"></script>
		<!-- For Cart-->
    <script src="linkscript/main.js"></script>
</body>
</html>