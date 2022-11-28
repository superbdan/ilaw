<?php
define('ILAW', true);

include('database_connection.php');
include('connection.php');
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
      $active = "";
      include("headers/admin_header.php");
    } else {
      $active = "";
      include("headers/customer_header.php");
    }
  } else {
    $active = "";
    include("headers/guest_header.php");
  }
  ?>

  <section class="first_section">
    <div class="BG_Cover">
      <img class="mySlides" src="images/Others/BG_Stairs.png">
      <img class="mySlides" src="images/Others/BG_Houses.png">
      <img class="mySlides" src="images/Others/BG_TV.png">
      <div class="column">
        <h1>ILAW Lighting and Equipment Trading</h1>
        <h2>"Making life brighter one Filipino home at a time."</h2>
        <button class="shopnow_btn" onclick="window.location='product.php#productnow';" type="button">Shop Now</button>
      </div>
    </div>

  </section>
  <section class="second_section">
    <div class="line_PFOS">
      <h1>Shopping Instructions</h1>
      <p>A complete guide on how to have a blast shopping!</p>
    </div>
  </section>
  <section class="cs_section">
    <div class="line_CS">


      <?php
      $query  = "SELECT * FROM instructions";
      $res    = mysqli_query($con, $query);
      $i = 0;
      while ($row = mysqli_fetch_assoc($res)) {
        echo '   <div class="row">
        <div class="col-sm-5 shadow"><img onclick="window.open(this.src)" class="" width="100%" src="admin/instruction_images/' . $row['image1'] . '" alt="Shopping Instructions"></div>
        <div class="col-sm-7 align-self-center">
          <center>
            <h4><b>' . $row['title1'] . '</b></h4>
          </center>
          <p>' . $row['instruction1'] . '</p>
        </div>
      </div>
  
      <div class="row">
        <div class="col-sm-7 align-self-center">
          <center>
            <h4><b>' . $row['title2'] . '</b></h4>
          </center>
          <p>' . $row['instruction2'] . '</p>
        </div>
        <div class="col-sm-5 shadow"><img onclick="window.open(this.src)" class="" width="100%" src="admin/instruction_images/' . $row['image2'] . '" alt="Shopping Instructions"></div>
      </div>';
      }
      ?>
    </div>















    </div>
  </section>
  <?php
  include("footer/footer.php")
  ?>
  <script src="js/functions.js" type="text/javascript"></script>
  <!-- For Cart-->
  <script src="linkscript/main.js"></script>
</body>

</html>