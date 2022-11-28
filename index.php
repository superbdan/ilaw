<?php
define('ILAW', true);
require_once "inquiry_submit.php";

//require_once "controllerUserData.php";

// $email = $_SESSION['email'];
// $password = $_SESSION['password'];
// if($email != false && $password != false){
//     $sql = "SELECT * FROM user_details WHERE user_email = '$email'";
//     $run_Sql = mysqli_query($con, $sql);
//     if($run_Sql){
//         $fetch_info = mysqli_fetch_assoc($run_Sql);
//         $status = $fetch_info['user_status'];
//         $code = $fetch_info['code'];
//         if($status == "Active"){
//             if($code != 0){
//                 header('Location: reset-code.php');
//             }
//         }else{
//             header('Location: user-otp.php');
//         }
//     }
// }else{
//     header('Location: login.php');
// }
?>
<?php
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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="linkscript/bootstrap5.1.min.css" crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" crossorigin="anonymous">
  <link rel="stylesheet" href="linkscript/owl.carousel.css" crossorigin="anonymous" />
  <script src="linkscript/jquery-1.12.4.min.js" crossorigin="anonymous"></script>
  <script src="linkscript/owl.carousel.min.js" crossorigin="anonymous"></script>
  <!-- Custom CSS-->
  <link href="admin/assets/css/style_loader.css" rel="stylesheet" />
  <link href="css/owl_carousel.css" rel="stylesheet" />
  <link href="css/style_e-commerce.css" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/e48d166edc.js" crossorigin="anonymous"></script>
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
    <a href="index_gallery.php#ilawgallery">
      <img type="button" class="logo_gallery animated tada position-fixed ml-2" src="images/Icons/Ilaw_Gallery.png" alt="Ilaw_Gallery" width="130px">
    </a>
    <div class="BG_Cover">
      <img class="mySlides" src="images/Others/BG_Stairs.png">
      <img class="mySlides" src="images/Others/BG_Houses.png">
      <img class="mySlides" src="images/Others/BG_TV.png">
      <div class="column">
        <h1>ILAW Lighting and Equipment Trading</h1>
        <h2>"Making life brighter one Filipino home at a time."</h2>
        <button class="learnmore_btn" onclick="window.location='about.php#about';" type="button">Learn More</button>
      </div>
    </div>
  </section>

  <section class="second_section">
    <div class='flex-box'>
      <div class="box">
        <img src="images/Icons/PQ.png" alt=""><br>
        <h3>Price is what you pay, quality is what you get.</h3><br>
        <p> Our goal is to give every Filipino the lighting solutions which is high in quality, competitive price and offers strong after sales.</p>
      </div>
      <div class="box2">
        <img src="images/Icons/II.png" alt=""><br>
        <h3>Improved and Innovative</h3><br>
        <p> We offer new and Improved RGB LED Strip Lights and we are open for your feedbacks and suggestions for us to improve more.</p>
      </div>
      <div class="box3">
        <img src="images/Icons/HMPB.png" alt=""><br>
        <h3>High end materials and Premium Brands</h3><br>
        <p> Transform your place into a safe and wonderful home with our next generation lighting solutions which offers competitive prices using high-end materials that you can have with premium brands.</p>
      </div>
      <div class="box4">
        <img src="images/Icons/FCES.png" alt=""><br>
        <h3>Full Customer Experience Service</h3><br>
        <p> We give our full attention on providing customer's needs. Whether It be from products or services, We will make sure to attain excellence and exceed our customer's satisfaction.</p>
      </div>
      <div class="line_DDI">
        <h2> The Daily Dose of ILAW</h2>
        <p>Choose the right brand and services who will take care of you and at the same time will not disappoint you with the quality and efficiency of its products.</p>
      </div>
  </section>

  <section class="third_section">
    <div class="line_BS">
      <h1><b>── Best Sellers ──</b></h1>
      <p>ILAW Ligting and Equipment provides you the top selling products of the month. View images below for more information.</p>
      <div class="container ">
        <div class="row">

          <div id="news-slider" class="owl-carousel">
            <?php
            $query  = "SELECT * FROM items INNER JOIN category ON category.category_id = items.category_id WHERE best_seller ='1' ";
            $res    = mysqli_query($con, $query);
            while ($row = mysqli_fetch_assoc($res)) {
              echo '
              <form action="product_single.php" method="post" id="prod_single_form">
              <div class="product">
              <div class="product-image"> <a href="" class="image"> <img src="admin/product_images/' . $row['product_img1'] . '" class="pic-1"> <img src="admin/product_images/' . $row['product_img2'] . '" class="pic-2"> </a> 
                <ul class="links">
                  <li>	<button type="submit" name="submit" data-toggle="tooltip" data-placement="bottom" title="View Product" style="background-color: transparent;" class="btn btn-xs p-0"><a href=""><i class="fa fa-eye fa-lg" aria-hidden="true"></i> </a></li>
                </ul>
              </div>
              <input type="hidden" id="product_single_id" name="product_single_id" value="'.$row['items_id'].'">
              <div class="content"> 
                <h3 class="title"><a>' . $row['items_name'] . '</a></h3>
              <div class="price">₱' . number_format(($row['items_price']), 2) . '</div>
                <span class="category"><a>' . $row['category_name'] . '</a></span>
              </div>
            </div>
            </form>
            ';
            }
            ?>
          </div>
        </div>
      </div>
    </div>
    </div>
  </section>

  <section class="fourth_section">
    <div class="line_BS">
      <h1><b>── New Arrival ──</b></h1>
      <p>ILAW Ligting and Equipment provides you the newest products. View images below for more information.</p>
      <div class="container">
        <div class="row">
          <div id="news-slider2" class="owl-carousel">
            <?php
            $query  = "SELECT * FROM items INNER JOIN category ON category.category_id = items.category_id WHERE new_arrival ='1'";
            $res    = mysqli_query($con, $query);
            while ($row = mysqli_fetch_assoc($res)) {
              echo '
              <form action="product_single.php" method="post" id="prod_single_form">
              <div class="product">
              <div class="product-image"> <a href="" class="image"> <img src="admin/product_images/' . $row['product_img1'] . '" class="pic-1"> <img src="admin/product_images/' . $row['product_img2'] . '" class="pic-2"> </a> 
                <ul class="links">
                  <li><button type="submit" name="submit" data-toggle="tooltip" data-placement="bottom" title="View Product" style="background-color: transparent;" class="btn btn-xs p-0"><a href=""><i class="fa fa-eye fa-lg" aria-hidden="true"></i> </a></li>
                </ul>
              </div>
              <input type="hidden" id="product_single_id" name="product_single_id" value="'.$row['items_id'].'">
              <div class="content">
              <h3 class="title"><a>' . $row['items_name'] . '</a></h3>
              <div class="price">₱' . number_format(($row['items_price']), 2) . '</div>
                <span class="category"><a>' . $row['category_name'] . '</a></span>
              </div>
            </div>
            </form>
            ';
            }
            ?>
          </div>
        </div>
      </div>
    </div>
    </div>
  </section>

  <section class="fifth_section">
    <div class="line_PFOS">
      <h1><b>── Product Features and Other Services ──</b></h1>
      <p>ILAW Ligting and Equipment provides you a complete information about the product, as well as the other services and ideas that can benefit you.</p>
    </div>
    <div class="PFOS_container">

      <img id="myImg" class="PFOS" src="images/Others/PFOS1.png" alt="Smart Features">
      <img id="myImg2" class="PFOS" src="images/Others/PFOS2.png" alt="Smart Features">
      <img id="myImg3" class="PFOS" src="images/Others/PFOS3.png" alt="Smart Features">
      <img id="myImg4" class="PFOS" src="images/Others/PFOS4.png" alt="Smart Features">
      <!-- The Modal -->
      <div id="myModal" class="modal">
        <span class="close">&times;</span>
        <img class="modal-content" id="img01">
        <div id="caption"></div>
      </div>

      <div class="second_column">
        <a href="https://www.facebook.com/groups/2664169983797064" target="_blank" class="SC_btn">Kisame (Ceiling Design)</a>
        <img id="myImg5" src="images/Others/Kisame1.png" alt="Ceiling Design Image">
      </div>
      <div class="second_column">
        <a href="" class="SC_btn">Installation Service</a>
        <img id="myImg6" src="images/Others/IS1.png" alt="Installation Service Image">
        <!-- The Modal -->
        <div id="myModal" class="modal">
          <span class="close">&times;</span>
          <img class="modal-content" id="img01">
          <div id="caption"></div>
        </div>
      </div>
  </section>

  <section class="testimonial text-center" style="background-image: url(images/Others/BG_Testimony2.png);">
    <div class="container">
      <div class="heading white-heading">
        <h1>── Testimonials ──</h1>
        <h6> What do our customers say about us?</h6>
      </div>
      <section class="testim" id="testim">
        <br><br>
        <div class="wrap">

          <span id="right-arrow" class="arrow right fa fa-chevron-right fade"></span>
          <span id="left-arrow" class="arrow left fa fa-chevron-left fade"></span>
          <ul class="dots" id="testim-dots">
            <?php
            $query  = "SELECT * FROM testimonies";
            $res    = mysqli_query($con, $query);
            while ($row = mysqli_fetch_assoc($res)) {
              echo '<li class="dot"></li>';
            }
            ?>
          </ul>
          <div class="cont" id="testim-content">
            <?php
            $query  = "SELECT * FROM testimonies";
            $res    = mysqli_query($con, $query);
            while ($row = mysqli_fetch_assoc($res)) {
              if ($row['rating'] == '5') {
                $rating = '<span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
              ';
              } elseif ($row['rating'] == '4') {
                $rating = '<span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star"></span>
              ';
              } elseif ($row['rating'] == '3') {
                $rating = '<span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span>';
              } elseif ($row['rating'] == '2') {
                $rating = '<span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span>';
              } elseif ($row['rating'] == '1') {
                $rating = '<span class="fa fa-star checked"></span>
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span>';
              }

              echo '
              <div>
              <div class="img"><img src="admin/testimony_images/' . $row['image'] . '"></div>
              <h2>' . $row['name'] . '</h2>
              <h6>' . $rating . '</h6>
              <h6>' . $row['title'] . '</h6>
              <p>' . $row['feedback'] . '</p>
              </div>';
            }
            ?>
          </div>
        </div>
      </section>
    </div>
  </section>

  <section class="seventh_section">
    <div class="container">
      <div class="line_contacts">
        <h4><b>── Location ──</b></h4>
        <p>ILAW Lighting and Equipment Trading Official Registered Map</p>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3866.4515980007286!2d121.04652826443179!3d14.285173768245173!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397d76f4fbc1dbd%3A0xd419d8ebd9513c10!2sILAW%20Lighting%20Equipment%20Trading!5e0!3m2!1sen!2sph!4v1630669985436!5m2!1sen!2sph" width:="100px" height="450px" class="shadow border" allowfullscreen="" loading="lazy"></iframe>
      </div>
      <div class="line_contacts ">
        <?php
        if (isset($_SESSION['info'])) {
        ?>
          <div class="alert alert-success text-center">
            <?php echo $_SESSION['info']; ?>
          </div>
        <?php
        }
        ?>
        <?php
        if (count($errors) > 0) {
        ?>
          <div class="alert alert-danger text-center">
            <b>
              <?php
              foreach ($errors as $showerror) {
                echo $showerror;
              }
              ?>
            </b>
          </div>
        <?php
        }
        ?>
        <h4 id="contact"><b>── Contact Us ──</b></h4>
        <p> Want to connect with us? Message us now and a friendly administrator will address your needs and queries.</p>

        <form method="post" action="" id="contact_frm">
          <input class="shadow border" type="text" name="first_name" id="first_name" placeholder="First Name" required>
          <input class="shadow border" type="text" name="last_name" id="last_name" placeholder="Last Name" required>
          <input class="shadow border" type="email" name="email" id="email" placeholder="Email" required>
          <input class="shadow border" type="number" name="number" id="number" placeholder="Contact #" min="0" required>
          <textarea class="shadow border" name="message" id="message" rows="5" placeholder="Write a message" required></textarea>

          <div class="form-group  mt-4">
            <button type="submit" name="inquiry" class="btn btn-primary text-white shadow border" id="alertify_success_top" required>Submit</button>
            <button type="reset" class="btn btn-danger shadow border">Clear</button>
          </div>
          <br>
      </div>
    </div>
    </form>
  </section>

  <?php
  include("footer/footer.php")
  ?>
  <script src="js/testimonyscript.js"></script>
  <script src="js/functions.js" type="text/javascript"></script>
  <!-- For Cart-->
  <script src="linkscript/main.js"></script>

</body>

</html>