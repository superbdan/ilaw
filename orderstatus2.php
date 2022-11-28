<?php
define('ILAW', true);

include('database_connection.php');
date_default_timezone_set('Asia/Manila');
//get transaction
include('connection.php');
if (empty($_SESSION['email'])) {
  header("Location: ../../ilaw2021/login.php");
} else {
  $email = $_SESSION['email'];
  $sql = "SELECT * FROM user_details WHERE user_email = '$email' ";
  $result = mysqli_query($con, $sql);
  $user = mysqli_fetch_assoc($result);
}

if (isset($_GET['id']) == 0) {
  $transaction = '000';
} else {
  $transaction =  $_GET['id'];
};

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ILAW</title>
  <link rel="shortcut icon" type="image/x-icon" href="images/Logo/ILAW_Logo2.png" />

  <!-- Owl Carousel (free version)-->
  <link rel="stylesheet" href="linkscript/bootstrap5.1.min.css" crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" crossorigin="anonymous">
  <link rel="stylesheet" href="linkscript/owl.carousel.css" crossorigin="anonymous" />
  <script src="linkscript/jquery-1.12.4.min.js" crossorigin="anonymous"></script>
  <script src="linkscript/owl.carousel.min.js" crossorigin="anonymous"></script>
  <!-- Custom CSS-->
  <link href="admin/assets/css/style_loader.css" rel="stylesheet" />
  <link href="css/owl_carousel.css" rel="stylesheet" />
  <link href="css/listandgrid.css" rel="stylesheet" />
  <link href="css/style_e-commerce.css" rel="stylesheet" />
  <link href="css/upload.css" rel="stylesheet" />
  <link href="css/orderstatus.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
  <!-- UniIcon CDN Link  -->
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
</head>
<style>
  .swal2-container {
    z-index: 20000 !important;
  }
</style>
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
  <section id="orderstatus2" class="second_section">
    <div class="line_PFOS">
      <h1>Order Status</h1>
      <p> ILAW Lighting and Equipment Trading provides you a monitoring system for you to know the progress of your order.</p>
    </div>
  </section>
  <section class="third_section">
    <br>
    <!-- <label class="p-2"><strong>Track your order by searching the  <span class="text-primary">Order ID <i>(ex. ILAW-002931)</i></span> in the search bar.</strong></label> -->

    <!-- Insert this code if there are no orders pending 
      <img src="images/Icons/Qbox.png" width="300px" alt="No_Item">
			<h1>You haven't ordered anything yet.</h1>
			<p>You must have a pending order sent to ILAW.<br>Thank you very much and have a blast shopping!</p>
			<a type="button" href="product.php #checkout" class="btn icon-round m-2 text-white" style="background: #F7941D">Go To Shopping
			</a>
      <br><br>-->

    <!-- <form>
    <div class="container d-flex">
    <input class="form-control" type="search" placeholder="Search" aria-label="Search">
    <button class="btn btn-outline-primary" type="submit"><i class="fa fa-search"></i></button>
    </div>
  </form> -->
    <div class="container">
      <div class="card border shadow">
        <ul class="card-header border d-flex justify-content-between">
          <li class="text-dark"><b>
              <buton type="button" class="btn btn-secondary" title="Return to previous page" type="button" onclick="window.location='orderstatus.php#orderstatus';"><i class="fas fa-arrow-left"></i> Back</button>
            </b>
          <li>&nbsp;
            <?php
            $query  = "SELECT * FROM customer_order where transaction_id ='$transaction'";
            $res    = mysqli_query($con, $query);
            while ($row = mysqli_fetch_assoc($res)) {
              $transaction = $row["transaction_id"];
              $status = $row['status'];
              switch ($row['status']) {
                case '0':
                  echo "<li class='text-primary m-2'><b>Transaction ID: <i> $transaction </i><span class='text-dark'> |<span><span class='text-primary'> Order Placed</span></li></b>";
                  break;
                case '1':
                  echo "<li class='text-primary m-2'><b>Transaction ID: <i> $transaction </i><span class='text-dark'> |<span><span class='text-primary'> Order Confirmed</span></li></b>";
                  break;
                case '2':
                  echo "<li class='text-primary m-2'><b>Transaction ID: <i> $transaction </i><span class='text-dark'> |<span><span class='text-primary'> Order Shipped Out</span></li></b>";
                  break;
                case '3':
                  echo "<li class='text-primary m-2'><b>Transaction ID: <i> $transaction </i><span class='text-dark'> |<span><span class='text-success'> Order Completed</span></li></b>";
                  break;
                case '4':
                  echo "<li class='text-primary m-2'><b>Transaction ID: <i> $transaction </i><span class='text-dark'> |<span><span class='text-danger'> Order Cancelled</span></li></b>";
                  break;
              }
            }
            ?>
        </ul>
        <br>
        <?php
        $query  = "SELECT * FROM order_tracking where transaction_id ='$transaction'";
        $res    = mysqli_query($con, $query);

        while ($row = $res->fetch_assoc()) :
          if (mysqli_num_rows($res) == 0) {
            $dateReceive = '';
            $dateShip = '';
            $dateConfirmed = '';
            $dateShip = '';
            $dateArrived = '';
          } else {
            if (isset($row["order_placed"]) == 1) {
              $one  = 'active';
              $stepReceive = 'Order Placed';
              $dateReceive = $row['order_placed'];
            } else {
              $one  = '';
              $stepReceive = '';
              $dateReceive = '';
            }
            if (isset($row["order_confirmed"]) == 1) {
              $two  = 'active';
              $stepConfirmed = 'Order Confirmed';
              $dateConfirmed = $row['order_confirmed'];
            } else {
              $two  = '';
              $stepConfirmed = '';
              $dateConfirmed = '';
            }
            if (isset($row["order_shipped_out"]) == 1) {
              $three  = 'active';
              $stepShip = 'Order Shipped Out';
              $dateShip = $row['order_shipped_out'];
            } else {
              $three  = '';
              $stepShip = '';
              $dateShip = '';
            }
            if (isset($row["order_completed"]) == 1) {
              $four  = 'active';
              $stepArrived = 'Order Completed';
              $rate = 'Rate Now!';
              $date = strtotime($row['order_completed']);
              $dateArrived = date("M d, Y h:i a", $date);
            } else {
              $four  = '';
              $stepArrived = '';
              $rate = '';
              $dateArrived = '';
            }
          }
        ?>
          <ul class="ul_progress">
            <li class="li_progress">
              <i class="icon uil uil-clipboard-notes "></i>
              <div class="step_progress one <?php echo $one ?>">
                <p>1</p>
                <i class="uil uil-check"></i>
              </div>
              <p class="text"><?php echo $stepReceive ?><br><?php echo $dateReceive ?></p>
            </li>
            <li class="li_progress">
              <i class="icon uil uil-money-bill"></i>
              <div class="step_progress two <?php echo $two ?>">
                <p>2</p>
                <i class="uil uil-check"></i>
              </div>
              <p class="text"><?php echo $stepConfirmed ?><br><?php echo $dateConfirmed ?></p>
            </li>
            <li class="li_progress">
              <i class="icon uil uil-truck-loading"></i>
              <div class="step_progress three <?php echo $three ?>">
                <p>3</p>
                <i class="uil uil-check"></i>
              </div>
              <p class="text"><?php echo $stepShip ?><br><?php echo $dateShip ?></p>
            </li>
            <li class="li_progress">
              <i class="icon uil uil-package"></i>
              <div class="step_progress four <?php echo $four ?>">
                <p>4</p>
                <i class="uil uil-check"></i>
              </div>
              <p class="text"><?php echo $stepArrived ?><br><?php echo $dateArrived ?></p>
            </li>
            <li class="li_progress">
              <i class="icon uil uil-star"></i>
              <div class="step_progress five <?php echo $four ?>">
                <p>5</p>
                <i class="uil uil-check"></i>
              </div>
              <p class="text"><?php echo $rate ?><br><span class="fade"><?php echo $dateArrived ?></span></p>
            </li>
          </ul>


        <?php endwhile; ?>






        <div class="border-top border-primary button-container p-2 shadow-sm" style="background: #f1f5f9;">
          <?php
          $query = "SELECT *
          FROM customer_order_product
          inner JOIN items ON customer_order_product.product_id = items.items_id
          WHERE transaction_id = '$transaction' ORDER BY id ASC";
          $res    = mysqli_query($con, $query);
          $qty = 0;
          $subtotal = 0;
          if (mysqli_num_rows($res) == 0) {
            echo '
            <img src="images/Icons/No_Item.png" alt="No_Item">
            <h1>Order Not Existing</h1>
            <p>You must first add items to your shopping cart before proceeding to checkout.<br>On our website, you can discover a wide variety of items with awesome features.</p>
            <a type="button" href="product.php#checkout" class="btn icon-round m-2 text-white" style="background: #F7941D">Go To Shopping
            </a>
            </br';
            $subtotal = 0;
            $fee = 0;
            $Total = 0;
          } else {
            if ($status == 3) {
              while ($row = mysqli_fetch_assoc($res)) {
                $courier = "SELECT courier_fee FROM couriers LEFT JOIN customer_order ON couriers.courier_id = customer_order.courier where customer_order.transaction_id ='$transaction'";
                $courierRes = mysqli_query($con, $courier);
                $rescourier = mysqli_fetch_assoc($courierRes);
                $fee = $rescourier['courier_fee'];
                $subtotal += $row['total'];
                $Total = $subtotal + $fee;
                if ($row['rate'] == 0) {
                  $button = '<a role="button" class="btn btn-primary shadow add_review" data-toggle="modal" data-product="' . $row['product_id'] . '"><i class="fas fa-star"></i>Rate</a>';
                } else {
                  $button = '<a role="button" class="btn btn-success shadow"><i class="fas fa-star"></i>Rated</a>';
                }

                echo '
              <form action="" class="form_submit">
                <div class="card-body border">
                  <div class="row">
                    <img alt="product_image" src="admin/product_images/' . $row['product_img1'] . '" style="width: 150px;" />
                    <div class="col text-dark text-start">
                      <div class="row">
                        <div class="col-12 short-div text-bold" id="product"><b>' . $row['items_name'] . '</b></div>
                        <div class="col-12 short-div item-name">' . $row['item_descript'] . '</div>
                        <div class="col-12 short-div">' . $row['quantity'] . 'x</div>
                      </div>
                    </div>
                    <div class="col-3 text-dark mt-2">
                      <div class="row">
                        <div class="btn btn-light short-div">₱ ' . number_format($row['total'], 2) . '</div>
                        <input type="hidden" class="prod" value="' . $row['product_name'] . '">
                        ' . $button . '
                        <div class="col-sm-4 text-center">
                        </div>
                      </div>
                    </div>

                  </div>
                </div>
              </form>';
              }
            } else {
              while ($row = mysqli_fetch_assoc($res)) {
                $courier = "SELECT courier_fee FROM couriers LEFT JOIN customer_order ON couriers.courier_id = customer_order.courier where customer_order.transaction_id ='$transaction'";
                $courierRes = mysqli_query($con, $courier);
                $rescourier = mysqli_fetch_assoc($courierRes);
                $fee = $rescourier['courier_fee'];
                $subtotal += $row['total'];
                $Total = $subtotal + $fee;
                echo ' <div class="card-body border">
            <div class="row">
            <img alt="product_image" src="admin/product_images/' . $row['product_img1'] . '" style="width: 150px;"/>
            <div class="col text-dark text-start">
              <div class="row">
                  <div class="col-12 short-div text-bold"><b>' . $row['product_name'] . '</b></div>
                  <div class="col-12 short-div item-name">' . $row['item_descript'] . '</div>
                  <div class="col-12 short-div">x' . $row['quantity'] . '</div>
              </div>
            </div>
            <div class="col-3 text-dark mt-2">
              <div class="row">
              <div class="btn btn-light short-div">₱' .  number_format($row['total'], 2) . '</div>
                <div class="col-sm-4 text-center">
              </div>
              </div>
            </div>
          </div>
          </div>';
              }
            }
          }
          ?>
          <br>
          <div class="container border">
            <div class="row">
              <div class="col align-middle text-end border">Merchandise Subtotal:</div>
              <div class="col border"><b>₱<?php echo number_format(($subtotal), 2) ?></b></div>
              <div class="w-100"></div>
              <div class="col align-middle text-end border">Shipping Fee:</div>
              <div class="col border"><b>₱<?php echo number_format(($fee), 2) ?></b></div>
              <div class="w-100"></div>
              <div class="col align-middle text-end border bg-dark text-white">Total Payment:</div>
              <div class="col border bg-dark text-white"><b>₱<?php echo number_format(($Total), 2) ?></b></div>
            </div>
          </div>

        </div>
      </div>
    </div><br>
    <div id="review_modal" class="modal fade popups " role="dialog" style="overflow:scroll;">
      <div class="modal-dialog modal-lg" role="document">
        <form enctype="multipart/form-data" action="" method="post" id="review_form">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title"><b>Review Product:</b></h5>
              <a type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><i class="fas fa-times"></i></span>
              </a>
            </div>
            <div class="modal-body ">
              <h4 class="text-center mt-2 mb-4 ">
                <i class="fas fa-star star-light submit_star mr-1" id="submit_star_1" data-rating="1" role="button"></i>
                <i class="fas fa-star star-light submit_star mr-1" id="submit_star_2" data-rating="2" role="button"></i>
                <i class="fas fa-star star-light submit_star mr-1" id="submit_star_3" data-rating="3" role="button"></i>
                <i class="fas fa-star star-light submit_star mr-1" id="submit_star_4" data-rating="4" role="button"></i>
                <i class="fas fa-star star-light submit_star mr-1" id="submit_star_5" data-rating="5" role="button"></i>
              </h4>
              <div class="form-group">
                <input type="hidden" name="product_id" id="product_id" class="form-control" value="" required />
                <label name="user_name"><b>Name:</b> <?php echo $user['first_name'], " ", $user['middle_name'], " ", $user['last_name'] ?></label>
                <input type="hidden" name="user_name" id="user_name" value="<?php echo $user['first_name'], " ", $user['middle_name'], " ", $user['last_name'] ?>">
                <input type="hidden" name="order_id" id="order_id" value="<?php echo $transaction ?>">
                <input type="hidden" name="user_id" id="user_id" value="<?php echo $user['user_id'] ?>">
              </div>
              <br>
              <div class="form-group">
                <input type="text" name="title_review" id="title_review" class="form-control" placeholder="Enter Title" required />
              </div>
              <br>
              <div class="form-group">
                <textarea name="user_review" id="user_review" class="form-control" style="resize: none; height:100px" placeholder="Type Review Here" required></textarea>
              </div>

              <!-- Upload Image and Video -->
              <div class="wrap-upload-buttons">
                <div class="container">
                  <br>
                  <h5>Picture Upload (Optional)</h5>
                  <center>
                    <div class="upload_box">
                      <ul id="media-list" class="clearfix" role="button">
                        <div class="mb-3">

                          <input class="form-control" type="file" name="fileImg[]" id="fileImg" multiple accept="image/*">
                        </div>
                      </ul>
                    </div>
                </div>
              </div>

              <div class="form-group text-center mt-4">
                <input type="hidden" name="rate" id="rate" value="0" />
                <input type="submit" class="btn btn-primary" id="submit" name="submit" value="Submit">
              </div>
        </form>
      </div>
    </div>

  </section>

  <?php
  include("footer/footer.php")
  ?>
  <script src="js/upload.js" type="text/javascript"></script>
  <script src="js/functions.js" type="text/javascript"></script>
  <!-- <script src="js/orderstatus.js" type="text/javascript"></script> -->
  <!--Bootstrap-->

  <script src="admin/assets/js/bootstrap.min.js"></script>
  <!--Progressbar JS-->

  <script src="admin/assets/js/progressbar.min.js"></script>

  <script>
    $(document).ready(function() {

      var rating_data = 0;

      $('.add_review').click(function(e) {
        e.preventDefault();
        var $form = $(this).closest(".form_submit");
        var product = $form.find(".prod").val();
        var product_id = $(this).data("product");
        $('#product_id').val(product_id);
        $('#review_modal').modal('show');
        $('#review_form')[0].reset();
        $('.modal-title').html('<h5 class="modal-title"><b>Product Review</b> ' + product + '</h5>');
      });

      $("#fileImg").on('change', function() {
        if ($("#fileImg")[0].files.length > 3) {
          Swal.fire('Maximum of 3 Images.', 'Image Upload is Maximum of 3', 'warning')
          $("#fileImg").val('');
        }
      });

      $(document).on('mouseenter', '.submit_star', function() {

        var rating = $(this).data('rating');

        reset_background();

        for (var count = 1; count <= rating; count++) {

          $('#submit_star_' + count).addClass('text-warning');

        }

      });

      function reset_background() {
        for (var count = 1; count <= 5; count++) {

          $('#submit_star_' + count).addClass('star-light');

          $('#submit_star_' + count).removeClass('text-warning');

        }
      }

      $(document).on('mouseleave', '.submit_star', function() {

        reset_background();

        for (var count = 1; count <= rating_data; count++) {

          $('#submit_star_' + count).removeClass('star-light');

          $('#submit_star_' + count).addClass('text-warning');
        }

      });

      $(document).on('click', '.submit_star', function() {

        rating_data = $(this).data('rating');
        $('#rate').val(rating_data);
      });

      $("#review_form").submit(function(e) {
        e.preventDefault();
        $.ajax({
          url: 'product_rating.php',
          method: 'POST',
          processData: false,
          contentType: false,
          cache: false,
          data: new FormData(this),
          success: function(response) {
            $('#review_modal').modal('hide');
            Swal.fire({
              icon: 'success',
              type: 'success',
              title: 'Review',
              text: 'Thank You for sending us your review',
              showConfirmButton: false,
              timer: 2000
            }).then(function() {
              location.reload();
              // alert('hello');
            })
          }
        });

      });
    });
  </script>

  <!-- For Cart-->
  <script src="linkscript/main.js"></script>
  <!--Custom Js Script-->
  <script src="admin/assets/js/custom.js"></script>
  <!-- sweetalert2 -->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- sweet alert1 -->
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</body>

</html>