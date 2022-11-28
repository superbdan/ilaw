<?php
include('database_connection.php');
include('connection.php');
if (empty($_SESSION['email'])) {
  header("Location: ../../ilaw2021/login.php");
} else ($email = $_SESSION['email']);
$sql = "SELECT * FROM user_details WHERE user_email = '$email' ";
$result = mysqli_query($con, $sql);
$user = mysqli_fetch_assoc($result);
$userid = $user['user_id'];

define('ILAW', true);
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
  body {
    position: relative;
    /* parent */
  }

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
  <section id="orderstatus" class="second_section">
    <div class="line_PFOS">
      <h1>Order Status</h1>
      <p> ILAW Lighting and Equipment Trading provides you a monitoring system for you to know the progress of your order.</p>
    </div>
  </section>
  <div class="text-center">
    <img src="admin/images/Logos/ILAW_Loader.png" id="loader" width="200" style="display:none;">
  </div>

  <section class="third_section" id="refresh">
    <br>
    <?php
    $query  = "SELECT * FROM customer_order 
    inner join order_tracking on customer_order.transaction_id = order_tracking.transaction_id
    where customer_id ='$userid' ORDER BY customer_order.id DESC";
    $res    = mysqli_query($con, $query);
    $i = 0;
    if (mysqli_num_rows($res) == 0) {
      echo '
			<img src="images/Icons/No_Item.png" alt="No_Item">
			<h1>There are no items added.</h1>
			<p>You must first add items to your shopping cart before proceeding to checkout.<br>On our website, you can discover a wide variety of items with awesome features.</p>
			<a type="button" href="product.php #checkout" class="btn icon-round m-2 text-white" style="background: #F7941D">Go To Shopping
			</a>
      </br>';
    } else {
      while ($row = mysqli_fetch_assoc($res)) {
        $transaction = $row["transaction_id"];
        switch ($row['status']) {
          case '0':
            $out = "<i class='fas fa-truck'></i> Parcel will be processed | <span class='text-primary'> Order Placed</span>";
            break;
          case '1':
            $out = "<i class='fas fa-truck'></i> Parcel validated | <span class='text-primary'> Order Confirmed</span>";
            break;
          case '2':
            $out = "<i class='fas fa-truck'></i> Parcel has been sent to courier | <span class='text-primary'> Order Shipped Out </span>";
            break;
          case '3':
            $out = "<i class='fas fa-truck'></i> Parcel has been delivered <span class='text-dark'>|<span><span class='text-success'> Order Completed</span>";
            break;
          case '4':
            $out = "<i class='fas fa-truck'></i> Parcel has been cancelled | <span class='text-danger'> Order Cancelled</span>";
            break;
        }
        $sql = "SELECT *
        FROM customer_order_product
        LEFT JOIN items ON customer_order_product.product_id = items.items_id
        WHERE transaction_id = '$transaction' 
        ORDER BY id ASC
        LIMIT 1";
        $itemquery = mysqli_query($con, $sql);
        $output = mysqli_fetch_assoc($itemquery);
        $sql2 = "select count(*) as total from customer_order_product WHERE transaction_id = '$transaction'";
        $rescount = mysqli_query($con, $sql2);
        $count = mysqli_fetch_assoc($rescount);
        // $date = strtotime($row['date_created']);
        // $datecreated = date("M d, Y h:i a", $date);
        $items = $count['total'];
        if ($items == 1) {
          $items = "";
        } else {
          $items -= 1;
          $items = "<b> $items more product(s) </b>";
        }
        if ($row['status'] == 3) {
          if ($row['rate'] == 0) {
            $button = '<button type="button" name="add_review" id="add_review" data-toggle="modal" data-target="#review_modal" data-transaction="' . $row['transaction_id'] . '" class="btn btn-primary review" data-toggle="modal"><i class="fas fa-star"></i> Rate Service</button>';
          } else {
            $button = '<button type="button" class="btn btn-outline-success" ><i class="fas fa-star"></i> Rated Successfully</button>';
          }


          echo '<div class="container">
          <a href="orderstatus2.php?id=' . $row["transaction_id"] . '#orderstatus2">
          <ul class="card-header border d-flex justify-content-between">
            <li class="text-dark"><b>Transaction ID: <i>' . $row['transaction_id'] . '</i>
            <li>&nbsp;
            <li class="text-primary">' . $out . '</li></b>
          </ul>
          <div class="card-body">
          <div class="row">
          <img alt="product_image" src="admin/product_images/' . $output['product_img1'] . '" style="width: 200px;" />
          <div class="col text-dark text-start">
          <div class="row">
          <div class="col-12 short-div text-bold"><b>' . $output['items_name'] . '</b></div>
          <div class="col-12 short-div item-description">' . $output['item_descript'] . '</div>
          <div class="col-12 short-div">x' . $output['quantity'] . '</div>
          <div class="col-12 short-div"><u>' . $items . '</u></div>
          </div>
              </div>
            </div>
          </div>
          <ul class="card-header d-flex justify-content-between">
            <li class="text-dark mt-2">Date Placed: <b>' . $row['order_placed'] . '</b></li></a>
            <li> ' . $button . '
            <a type="button" href="product.php" class="btn btn-success"><i class="fas fa-shopping-cart"></i> Buy Again</a>
        </li>
          </ul>
        </div>
    </div>
    </div>
    </div><br>';
        } else {
          echo '<div class="container">
          <a href="orderstatus2.php?id=' . $row["transaction_id"] . '#orderstatus2">
          <ul class="card-header border d-flex justify-content-between">
            <li class="text-dark"><b>Transaction ID: <i>' . $row['transaction_id'] . '</i>
            <li>&nbsp;
            <li class="text-primary">' . $out . '</li></b>
          </ul>
          <div class="card-body">
          <div class="row">
          <img alt="product_image" src="admin/product_images/' . $output['product_img1'] . '" style="width: 200px;" />
          <div class="col text-dark text-start">
          <div class="row">
          <div class="col-12 short-div text-bold"><b>' . $output['items_name'] . '</b></div>
          <div class="col-12 short-div item-description">' . $output['item_descript'] . '</div>
          <div class="col-12 short-div">x' . $output['quantity'] . '</div>
          <div class="col-12 short-div"><u>' . $items . '</u></div>
          </div>
              </div>
            </div>
          </div>
          <ul class="card-header d-flex justify-content-between">
          <li class="text-dark mt-2">Date Placed: <b>' . $row['order_placed'] . '</b></li></a>
          </ul>
        </div>
    </div>
    </div>
    </div><br>';
        }
      }
    }
    ?>



    <br>
    <div id="review_modal" class="modal fade popups " role="dialog" style="overflow:scroll;">
      <div class="modal-dialog modal-lg" role="document">
        <form enctype="multipart/form-data" action="" method="post" id="review_form">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title"><b>Review Any Product and Shop Services</b></h5>
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
                <label name="user_name"><b>Name:</b> <?php echo $user['first_name'], " ", $user['middle_name'], " ", $user['last_name'] ?></label>
                <input type="hidden" name="user_name" id="user_name" value="<?php echo $user['first_name'], " ", $user['middle_name'], " ", $user['last_name'] ?>">
                <input type="hidden" name="order_id" id="order_id" value="">
                <input type="hidden" name="user_id" id="user_id" value="<?php echo $user['user_id'] ?>">
                <!-- <input type="text" name="user_name" id="user_name" class="form-control" placeholder="Enter Your Name" value="<?php echo $user['first_name'], " ", $user['middle_name'], " ", $user['last_name'] ?>" required /> -->
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="js/functions.js" type="text/javascript"></script>
  <!--Bootstrap-->
  <script src="js/upload.js" type="text/javascript"></script>
  <script src="admin/assets/js/bootstrap.min.js"></script>
  <!--Progressbar JS-->

  <script src="admin/assets/js/progressbar.min.js"></script>

  <script>
    $(document).ready(function() {
      var rowCount = 1;
      $('.review').click(function() {
        $('#review_modal').modal('show');
        $('#review_form')[0].reset();
        $('.modal-title').html("<i class='fa fa-pencil-square-o'></i> Shop Services Review");
        var order_id = $(this).data("transaction");
        $('#order_id').val(order_id);
      });


      //IMG LIMIT 3
      $("#fileImg").on('change', function() {
        if ($("#fileImg")[0].files.length > 3) {
          Swal.fire('Maximum of 3 Images.', 'Image Upload is Maximum of 3', 'warning')
          $("#fileImg").val('');
        }
      });



      var rating_data = 0;

      $('#add_review').click(function() {

        $('#review_modal').modal('show');

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



      $(document).ready(function() {

        // $("#image").on('change', function() {
        //   var filename = $(this).val();
        //   $(".custom").html(filename);
        // });
        // $('.redirect').click(function() {
        //   var order_id = $(this).data("order");
        //   var url = "orderstatus2.php#orderstatus2";
        //   var form = $('<form action="' + url + '" method="post" id="formurl">' +
        //     '<input type="text" name="order_id" value="' + order_id + '" />' +
        //     '</form>');
        //   $('body').append(form); //append to the body
        //   form.submit();







        //   // $.ajax({
        //   //   url: url,
        //   //   type: "POST",
        //   //   data: {
        //   //     order_id: order_id
        //   //   },
        //   //   success: function() {
        //   //     $.redirect('orderstatus2.php', {'order_id': order_id});
        //   //     // window.location = "orderstatus2.php";
        //   //   }
        //   // });
        // });



        $("#review_form").submit(function(e) {
          // var form = new FormData(this);
          // var data = rating_data + '&' + form;
          e.preventDefault();

          $.ajax({
            url: 'submit_rating.php',
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
              })
            }
          });

        });
      });

      // $('#save_review').click(function() {

      //   // var formData = review_img;
      //   // var totalFiles = $("review_img").get(0).files.length;

      //   // for (var i = 0; i < totalFiles; i++) {
      //   //   formData.append("review_img[]", $("#review_img").get(0).files[i]);
      //   // }
      //   var user_name = $('#user_name').val();
      //   var user_id = $('#user_id').val();
      //   var user_review = $('#user_review').val();

      //   var title_review = $('#title_review').val();

      //   // var review_img = $('#review_img').val();

      //   if (user_name == '' || user_review == '') {
      //     alert("Please Fill Both Field");
      //     return false;
      //   } else {
      //     $.ajax({
      //       url: "submit_rating.php",
      //       method: "POST",
      //       data: {
      //         rating_data: rating_data,
      //         user_name: user_name,
      //         user_id: user_id,
      //         title_review: title_review,
      //         user_review: user_review,
      //         // review_img: review_img
      //       },

      //       success: function(data) {
      //         $('#review_modal').modal('hide');

      //         load_rating_data();

      //         alert(data);
      //       }
      //     })
      //   }

      // });


    });
  </script>

  <!-- For Cart-->
  <script src="linkscript/main.js"></script>
  <!--Custom Js Script-->
  <script src="admin/assets/js/custom.js"></script>
  <!-- Sweet Alert2 -->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- Sweet Alert1 -->
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</body>

</html>