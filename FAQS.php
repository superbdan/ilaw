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
<body>
<!--Page loader-->
<div class="loader-wrapper overlay">
    <div class="loader-circle">
        <div class="loader"></div>
    </div>
</div>
<!--Page loader-->
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
    <section class="cs_section">
        <div class = "line_CS">
        <center><h3><b>── Frequently Asked Questions ──</b></h3>
        <p>These are the most common questions from our customers.</p></center>
	<div class="container_faqs">
		<!-- Accordion Starts-->
		<?php
          $query = "SELECT * FROM faqs ";
          $res    = mysqli_query($con, $query);
		  $count = 0;
          while ($row = mysqli_fetch_assoc($res)) {
			$count++;
            echo '<div class="acc">
			<h3>Question '.$count.': '.$row['question'].'</h3>
			<div class="content_main">
				<div class="content-inner">
					<p>'.$row['answer'].'</p>
				</div>
			</div>
			</div>
			';
          }
          ?>
	</div>
           
        </div>
    </section>
    <?php
          include("footer/footer.php")
    ?>
    <script src="js/faqs.js" type="text/javascript"></script>
    <script src="js/functions.js" type="text/javascript"></script>
	 <!-- For Cart-->
	 <script src="linkscript/main.js"></script>
</body>
</html>