<?php
define('ILAW',true);

include('database_connection.php');
include('function.php');
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
  <link href="css/upload.css" rel="stylesheet" />
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
  <section id="checkout" class="second_section">
    <div class="line_PFOS">
      <h1>Checkout</h1>
      <p> ILAW Lighting and Equipment Trading introduce you the virtual shopping cart in which it allows you to save products that you prefer, order it later or collect products to checkout. </p>
    </div>
  </section>
  <section class="third_section">
    <div class="p-3 border button-container shadow-sm pb-1 " style="background: #f1f5f9;">
      <nav aria-label="breadcrumb ">
        <ol class="breadcrumb pt-1d-flex justify-content-between">
          <li class="d-flex">
            &nbsp;&nbsp;&nbsp;
            <a href="index.php"><img src="images/Logo/ILAW_Logo2.png" alt="ILAW Logo" onclick="window.location='index.php';" width="35px"></a>&nbsp;&nbsp;
            <span class="vr" style="width: 2px"></span>
            <span class="breadcrumb-item pt-2" aria-current="page">&nbsp;Checkout</span>
          </li>

          <li><a type="button" class="btn btn-secondary pb-2" data-toggle="tooltip" data-placement="bottom" title="Back to Shopping Cart" href="cart.php#cart"><i class="fas fa-arrow-left"></i></a>

            <a tabindex="0" class="btn btn-primary pb-2" role="button" data-toggle="popover" data-trigger="focus" title="Content Guide" data-content="The Shopping Cart Page will display all the customer's information, as well as the orders to be confirmed. Make sure to recheck all details before sending to us."><i class="fa fa-info"></i></a>
          </li>

          <script>
            $(function() {
              $('[data-toggle="popover"]').popover()
            })
          </script>
        </ol>
      </nav>
    </div>

    <!-- The Looping Order List -->
    <div class="container-fluid" style="overflow-x: auto;" id="cart_view">
      <hr>

      <!-- End of The Looping Order List -->
    </div>

    </div>

    <div class="container-fluid">
      <div class="row-checkout">
        <?php
        if (isset($_SESSION["uid"])) {
          $query = "SELECT * FROM user_details 
              INNER JOIN table_province ON user_details.province = table_province.province_id
              INNER JOIN table_municipality ON user_details.city = table_municipality.municipality_id
              INNER JOIN table_region ON user_details.region = table_region.region_id WHERE user_id = '$_SESSION[uid]'";
          $statement = $connect->prepare($query);
          $statement->execute();
          $result = $statement->fetchAll();
          $n = 0;
          foreach ($result as $row) {
            $n++;
            $first_name = $row["first_name"];
            $last_name = $row["last_name"];
            $user_contact = $row["user_contact"];
            $home_address = $row["home_address"];
            $city = $row["municipality_name"];
            $province = $row["province_name"];
            $region = $row["region_name"];
            $city_id = $row["city"];
            $province_id = $row["province"];
            $region_id = $row["region"];
            $zip_code = $row["zip_code"];

            echo '
                    <form action="checkout_process.php" method="POST"  enctype="multipart/form-data">
                    <div class="container col-sm-12 p-3 mt-4 mb-4 border shadow-sm text-start" style="background: #f1f5f9;">

                    <div class="row mb-2">
                    <div class="col-6">
                      <h5 class="text-primary"><i class="fas fa-credit-card"></i><strong> Billing Address</strong></h5>
                    </div>
                    <div class="col-6">
                      <label type="hidden" name="transaction_id"> <?php echo get_invoice_no($connect); ?></label>
                      <input type="hidden" name="transaction_id" value="', get_invoice_no($connect), '">
                    </div>
                        <div class="row mb-2">
                        <div class="col-6">
                          <label for="full_name" class="text-primary"><i class="fa fa-user " ></i> Full Name</label>
                          <input type="text" id="full_name" class="form-control" name="full_name" pattern="^[a-zA-Z ]+$"  value="' . $row["first_name"] . ' ' . $row["last_name"] . '" required>
                        </div>
                          
                        <div class="col-6">
                          <label for="email" class="text-primary"><i class="fa fa-envelope"></i> Email</label>
                          <input type="text" id="email" name="email" class="form-control" pattern="^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9]+(\.[a-z]{2,4})$" value="' . $row["user_email"] . '" required>
                        </div>
                        </div>
                        
                        <div class="row mb-2">
                        <div class="col-6">
                          <label for="customer_no" class="text-primary"><i class="fa fa-phone"></i> Contact No</label>
                          <input type="text" id="customer_no" name="customer_no" class="form-control" value="' . $row["user_contact"] . '" required>
                        </div>
                        <div class="col-6">
                          <label for="adr" class="text-primary"><i class="fas fa-map-marker-alt"></i> Address</label>
                          <input type="text" id="adr" name="address" class="form-control" value="' . $row["home_address"] . '" required>
                        </div>
                        </div>

                        <div class="row mb-2">
                        <div class="col-6">
                          <label for="region" class="text-primary"><i class="fa fa-globe"></i> Region</label>
                            <select style="cursor:pointer"  name="region" id="region" class="form-control" required>
                                <option value="' . $region_id . '">' . $region . '</option>', fill_region_list($connect),
            '</select>', '
                        </div>
                        <div class="col-6">
                          <label for="province" class="text-primary"><i class="fa fa-globe"></i> Province</label>
                            <select style="cursor:pointer"  name="province" id="province" class="form-control" required>
                              <option value="' . $province_id . '">' . $province . '</option>', fill_province_list($connect), '</select>', '
                        </div>
                        </div>      
                        
                        <div class="row mb-2">
                        <div class="col-6">
                          <label for="city" class="text-primary"><i class="fa fa-globe"></i> City</label>
                            <select style="cursor:pointer"  name="city" id="city" class="form-control" required>
                              <option value="' . $city_id . '">' . $city . '</option>', fill_municipality_list($connect), '</select>', '
                        </div>
                        <div class="col-6">
                          <label for="zip" class="text-primary"><i class="fa fa-globe"></i> Zip</label>
                          <input type="text" id="zip" name="zip" value="' . $zip_code . '" class="form-control" required>
                          </div> 
                          </div>

          ';
            $i = 1;
            $total = 0;
            $total_count = $_POST['total_count'];
            while ($i <= $total_count) {
              $items_name = $_POST['items_name' . $i];
              $items_price = $_POST['items_price' . $i];
              $qty = $_POST['qty' . $i];
              $total = $total + $items_price;
              $sql = "SELECT * FROM items INNER JOIN measurement ON measurement.measurement_id = items.measurement_id WHERE items_name='$items_name'";
              $query = mysqli_query($con, $sql);
              $row = mysqli_fetch_array($query);
              $items_id = $row["items_id"];
              $measurement_name = $row['measurement_name'];
              echo "	
						<input type='hidden' name='prod_id_$i' value='$items_id'>
            <input type='hidden' name='prod_name_$i' value='$items_name'>
            <input type='hidden' name='prod_unit_$i' value='$measurement_name'>
						<input type='hidden' name='prod_price_$i' value='$items_price'>
						<input type='hidden' name='prod_qty_$i' value='$qty'>
						";
              $i++;
            }

            echo '	
				<input type="hidden" name="total_count" value="' . $total_count . '">
					<input type="hidden" name="total_price" value="' . $total . '">
          ';
          }
        } else {
          echo "<script>window.location.href = 'cart.php'</script>";
        }
        ?>

      </div>
    </div>

    <div class="d-flex justify-content-center">
      <div class="container col-sm-12 p-3 mt-2 mb-4 border shadow-sm" style="background: #f1f5f9;">
        <center>
          <h6 class="text-primary"><i class="fas fa-envelope"></i><strong> Customer Note </strong>
            <div class="col-sm-12 pt-2">
              <input type="text" class="form-control" style="resize: none; background: #f9f9f9;" name="customer_note" id="customer_note" placeholder="Write your message here..." value="N/A">
            </div>
            <h6 class="text-primary pt-3"><i class="fas fa-paper-plane"></i><strong> Courier</strong>

              <div class="col-sm-3 pt-3">
                <select class="bg-white btn- form-control" id="courier" name="courier" style="cursor:pointer;" required>
                  <?php
                  $query = mysqli_query($con, "select * from couriers");
                  while ($row = mysqli_fetch_array($query)) {
                  ?>
                    <option value="<?php echo $row['courier_id']; ?>"> <?php echo $row['courier_name']; ?> </option>
                  <?php
                  }
                  ?>
                </select><br>
                <span class="text-dark" style="font-size: 12px"><strong>Note: Courier fee varies on courier service.</strong></span>
              </div>
        </center>
      </div>
    </div>
    <div class="container col-sm-12 p-3 mt-2 mb-4 border shadow-sm">
      <div  style="background: #f1f5f9;">
        <nav aria-label="breadcrumb ">
          <ul class="pt-1 pb-0 breadcrumb d-flex justify-content-between">
            <h5 class="text-primary pt-1"><i class="fas fa-credit-card"></i><strong> Payment Method</strong></h5>
            &nbsp; &nbsp;
            <script src="js/easyResponsiveTabs.js" type="text/javascript"></script>
            <script type="text/javascript">
              $(document).ready(function() {
                $('#horizontalTab').easyResponsiveTabs({
                  type: 'default', //Types: default, vertical, accordion           
                  width: 'auto', //auto or any width like 600px
                  fit: true // 100% fit in a container
                });
              });
            </script>
            <div id="horizontalTab" style="display: block; width: 100%; margin: 0px;">
              <li class="resp-tab-item" id="online" aria-controls="tab_item-0" role="tab"><span><label class="pic1"><i class="fas fa-desktop"></i> Payment Centers / e-Wallets </label></span></li>
              <li class="resp-tab-item" id="cod" aria-controls="tab_item-1" role="tab"><span><label class="pic2"><i class="fa fa-money-bill"></i> Cash On Delivery</label></span></li>
             
              <div class="resp-tabs-container">
                <div class="tab-1 resp-tab-content" aria-labelledby="tab_item-0">
                  <div class="payment-info">
                    <center>
                      <h6 style="font-size: 12px"><strong>Note: Please proceed to pay on any online wallet below.</strong></h6>
                    </center>
                    <div class="container border">
                      <div class="row">

                        <div class="col text-center border bg-primary text-white pt-2">
                          <h5><b>E-WALLETS</b></h5>
                        </div>
                        <div class="col border text-center bg-primary text-white pt-2">
                          <h5><b>DETAILS</b></h5>
                        </div>
                        <div class="w-100"></div>
                        <?php
                        $query  = "SELECT * FROM online_banking";
                        $res    = mysqli_query($con, $query);
                        while ($row = mysqli_fetch_assoc($res)) {
                          echo '
                            <div class="col align-middle text-center border pt-3 pb-3"><b><img src="admin/online_bank/' . $row['image'] . '" width="80px" class="shadow" alt="online bank"></b></div>
                            <div class="col text-center border pt-4">' . $row['name'] . '<br><b>' . $row['number'] . '</b></div>
                            <div class="w-100"></div>';
                        }
                        ?>
                      </div>
                    </div>
                  </div>
                  <br>
                  <div class="container d-flex flex-wrap justify-content-center">
                    <div class="col-md-6 align-center">
                      <div class="form-group p-2 pt-5 border" style="background: #f1f5f9;">
                        <div class="input-group">
                          <span class="input-group-btn">
                            <span class="btn btn-outline-secondary btn-file">
                              <i class="fas fa-upload fa-lg" aria-hidden="true"></i> Upload
                              <input type="file" id="payment" name="payment" accept=".jpg, .png" class="form-control" style="cursor: pointer;" required>
                            </span>

                          </span>
                          <input type="text" class="form-control" readonly required>
                        </div>
                        <center>
                          <h6 class="pt-2" style="font-size: 12px"><strong>Note: Screenshot your proof of payment and upload it here. </strong></h6>
                        </center>
                        <div class="form-group pr-5 pl-5 border bg-secondary d-flex justify-content-center" style="padding: 120px 0px 120px 0px">
                          <img style="width: 70%; height: auto;" id='img-upload' />
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6 d-flex justify-content-center align-items-center">
                      <div class="form-group p-2 pt-5">
                        <div class="input-group">
                          <span>
                            <label class="pt-1">Bank Name: </label>
                          </span>
                          &nbsp;
                          <input type="text" name="bank_name" id="bank_name" class="form-control" required>

                        </div>
                        <center>
                          <h6 class="pt-4" style="font-size: 12px"><strong>Note: Bank Name Must be accurate and similar to the screenshot.</strong></h6>
                        </center>
                        <br>

                        <div class="container border" id="payment_total">
                            <!-- Total Payment -->
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                
                <!-- For The COD Tab -->
              <div class="row text-center">
                <div class="col-sm-12">
                <img src="images/Icons/Reminder.png" width="200px" alt="No_Item">
                </div>
              <div class="container">
              <strong>Reminders to our Beloved Customer:</strong><br>
              <p>1. All information above will be our basis upon delivery. Make sure to recheck all fields.<br>
              2. After order confirmation, as a customer, you must prepare your payment before the arrival of your parcel.<br>
              3. You can track your order in our "Order Status" feature.<br>
           </p>
            </div>
            </div>
            <br>
                <p>Thank you for trusting ILAW! Have a Great day.😊</p>
                    <hr>
                <a class="btn btn-secondary pb-2 mt-3" role="button" onclick="showAlert_Order()"><i class="fa fa-info"></i></a>
                  <input type="submit" id="submit" value="Place Order" class="btn btn-primary checkout-btn mt-3">
              </div>
            </div>
      </div>
    </div>
    </form>
    <br>
  </section>

  <?php
  include("footer/footer.php")
  ?>
  <script>
    function showAlert_Order() {
      //alert ("Saved Successfully!");
      swal("Before Placing Order", "Make sure to double check all information above.", "warning")
    }
  </script>
  <script src="js/functions.js" type="text/javascript"></script>
  <script>
    $(document).ready(function() {
      $("#region").on('change', function() {
        var regionId = $(this).val();
        $.ajax({
          method: "POST",
          url: "locajax.php",
          data: {
            regionId: regionId
          },
          dataType: "html",
          success: function(data) {
            $("#province").text(data);
          }

        });
      })

      $("#province").on('change', function() {
        var provinceId = $(this).val();
        $.ajax({
          method: "POST",
          url: "locajax.php",
          data: {
            provinceId: provinceId
          },
          dataType: "html",
          success: function(data) {
            $("#city").html(data);
          }

        });
      })


    });
    $("#courier").on('change', function() {
      var courierId = $(this).val();
      $.ajax({
        method: "POST",
        url: "courier_amount.php",
        data: {
          courierId: courierId
        },
        dataType: "html",
        success: function(data) {
          $("#courier_fee").html(data);

        }
      });
    })

    $("#courier").on('change', function() {
      var paymentId = $(this).val();
      var courierId = $(this).val();
      $.ajax({
        method: "POST",
        url: "total_payment.php",
        data: {
          paymentId: paymentId, courierId: courierId
        },
        dataType: "html",
        success: function(data) {
          $("#total_payment").html(data);
      

        }
      });
    })

    $('#online').click(function() {
      $('#courier').prop('required',true);
      $('#payment').prop('required',true);
      $('#bank_name').prop('required',true);
    });

    $('#cod').click(function() {
      $('#courier').removeAttr('required');
      $('#payment').removeAttr('required');
      $('#bank_name').removeAttr('required');
    });

    $('#add_button').click(function() {
      $('#category_form')[0].reset();
      $('.modal-title').html("<i class='fa fa-plus'></i> Add Category");
      $('#action').val('Add');
      $('#btn_action').val('Add');
    });

    $(document).on('submit', '#category_form', function(event) {
      event.preventDefault();
      $('#action').attr('disabled', 'disabled');
      var form_data = $(this).serialize();
      $.ajax({
        url: "category_action.php",
        method: "POST",
        data: form_data,
        success: function(data) {
          $('#category_form')[0].reset();
          $('#categoryModal').modal('hide');
          $('#alert_action').fadeIn().html('<div class="alert alert-success">' + data + '</div>');
          $('#action').attr('disabled', false);
          categorydataTable.ajax.reload();
        }
      })
    });
    $(document).ready(function() {
      $(document).on('change', '.btn-file :file', function() {
        var input = $(this),
          label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.trigger('fileselect', [label]);
      });

      $('.btn-file :file').on('fileselect', function(event, label) {

        var input = $(this).parents('.input-group').find(':text'),
          log = label;

        if (input.length) {
          input.val(log);
        } else {
          if (log) alert(log);
        }

      });

      function readURL(input) {
        if (input.files && input.files[0]) {
          var reader = new FileReader();

          reader.onload = function(e) {
            $('#img-upload').attr('src', e.target.result);
          }

          reader.readAsDataURL(input.files[0]);
        }
      }

      $("#payment").change(function() {
        readURL(this);
      });
    });
  </script>
  <!--Popper JS-->
  <script src="admin/assets/js/popper.min.js"></script>
  <!--Bootstrap-->
  <script src="admin/assets/js/bootstrap.min.js"></script>
  <!-- For Cart-->
  <script src="linkscript/main.js"></script>
</body>

</html>
