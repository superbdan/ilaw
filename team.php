<?php
define('ILAW',true);

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
  <link rel="shortcut icon" type="image/x-icon" href="images/Logo/ILAW_Logo2.png" />
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
  <section id="team" class="second_section">
    <div class="line_PFOS">
      <h1>Team</h1>
      <p style=> ILAW Lighting and Equipment Trading build their partnership to other company, you can also see the founder of <br>ILAW as well as the other member running the company. </p>
    </div>
  </section>
  <section class="third_section">
    <br>
    <h3><b>── ILAW Company ──</b></h3>
    <p>Meet our Team!</p>
    <div class='flex-box' >
      <!-- Add Another Company staff of ILAW, just copy the box_team code and edit the rest of the components -->
      <?php
        $query  = "SELECT * FROM company_team";
        $res    = mysqli_query($con, $query);
        $i = 0;
        while ($row = mysqli_fetch_assoc($res)) {
          echo '
          <div class="box_team border shadow">
          <img class="img-account-profile rounded-circle border shadow mb-2" style="vertical-align: middle; width: 100px; height: 100px;border-radius: 50%;" src="admin/team_member/'.$row['image'].'" alt="role"><br>
          <h6><b>'.$row['name'].'</b></h6>
          <h6>'.$row['role'].'</h6>
          <p> '. $row['description'] .'</p>
          <a href="javascript:void();" class="readmore-btn btn btn-primary">Read More</a>
          </div>'
          ;
        }
        
      ?>
            <!--cdnjs.com-->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
            <script>
                $(".readmore-btn").on('click', function() {
                    $(this).parent().toggleClass("showContent");


                    var replaceText = $(this).parent().hasClass("showContent") ? "Read Less" : "Read More";
                    $(this).text(replaceText);
                })
            </script>
      <!-- <div class="box_team border shadow">
        <img src="images/Others/Team.jpg" alt="CEO"><br>
        <h4>Mr. Patrick Lingahan</h4>
        <h6>Manager</h6>
        <p> Our goal is to give every Filipino the lighting solutions which is high in quality, competitive price and offers strong after sales.</p>
      </div>
      <div class="box_team border shadow">
        <img src="images/Others/Team.jpg" alt="CEO"><br>
        <h4>Mr. Patrick Lingahan</h4>
        <h6>Manager</h6>
        <p> Our goal is to give every Filipino the lighting solutions which is high in quality, competitive price and offers strong after sales.</p>
      </div>
      <div class="box_team border shadow">
        <img src="images/Others/Team.jpg" alt="CEO"><br>
        <h4>Mr. Patrick Lingahan</h4>
        <h6>Manager</h6>
        <p> Our goal is to give every Filipino the lighting solutions which is high in quality, competitive price and offers strong after sales.</p>
      </div>
      <div class="box_team border shadow">
        <img src="images/Others/Team.jpg" alt="CEO"><br>
        <h4>Mr. Patrick Lingahan</h4>
        <h6>Manager</h6>
        <p> Our goal is to give every Filipino the lighting solutions which is high in quality, competitive price and offers strong after sales.</p>
      </div>
      <div class="box_team border shadow">
        <img src="images/Others/Team.jpg" alt="CEO"><br>
        <h4>Mr. Patrick Lingahan</h4>
        <h6>Manager</h6>
        <p> Our goal is to give every Filipino the lighting solutions which is high in quality, competitive price and offers strong after sales.</p>
      </div> -->
    </div>
    <section class="unknown_section">
      <div class="line_partners">
        <h3><b>── Partners ──</b></h3>
        <p>Trusted by the best</p>
        <!-- Add Another Partner of ILAW, just copy the image code and edit the src & alt -->
        <!-- <img class="border shadow" src="images/Others/Zebedee.png" alt="Zebedee Logo">
        <img class="border shadow" src="images/Others/Zebedee.png" alt="Zebedee Logo">
        <img class="border shadow" src="images/Others/Zebedee.png" alt="Zebedee Logo">
        <img class="border shadow" src="images/Others/Zebedee.png" alt="Zebedee Logo">
        <img class="border shadow" src="images/Others/Zebedee.png" alt="Zebedee Logo">
        <img class="border shadow" src="images/Others/Zebedee.png" alt="Zebedee Logo">
        <img class="border shadow" src="images/Others/Zebedee.png" alt="Zebedee Logo">
        <img class="border shadow" src="images/Others/Zebedee.png" alt="Zebedee Logo">
        <img class="border shadow" src="images/Others/Zebedee.png" alt="Zebedee Logo">
        <img class="border shadow" src="images/Others/Zebedee.png" alt="Zebedee Logo">
        <img class="border shadow" src="images/Others/Zebedee.png" alt="Zebedee Logo"> -->
        <?php
        $query  = "SELECT * FROM suppliers";
        $res    = mysqli_query($con, $query);
        $i = 0;
        while ($row = mysqli_fetch_assoc($res)) {
          if ($row['supplier_status'] == 'active') {
            echo "<img class='' src='admin/supplier_images/{$row['supplier_img']}' alt='supplier' height='125' width='125'>";
          } 
        }
        ?>
      </div>



    </section>
  </section>
  <?php
  include("footer/footer.php")
  ?>
  <script src="js/functions.js" type="text/javascript"></script>
  <!-- For Cart-->
  <script src="linkscript/main.js"></script>
</body>

</html>