<?php
//login.php
define('ILAW', true);

require_once "controllerUserData.php";

//in action.php page if user click on "ready to checkout" button that time we will pass data in a form from action.php page
if (isset($_POST["login_user_with_product"])) {
  //this is product list array
  $product_list = $_POST["items_id"];
  //here we are converting array into json format because array cannot be store in cookie
  $json_e = json_encode($product_list);
  //here we are creating cookie and name of cookie is product_list
  setcookie("product_list", $json_e, strtotime("+1 day"), "/", "", "", TRUE);
}

// if (isset($_SESSION['type'])) {
//   header("location: index.php");
// }
// //overall login part
// $message = '';

// if (isset($_POST["login"])) {
//   //query for Admin
//   $query = "
// 	SELECT * FROM user_details 
// 		WHERE user_email = :user_email
// 	";
//   $statement = $connect->prepare($query);
//   $statement->execute(
//     array(
//       'user_email'   =>  $_POST["user_email"]
//     )
//   );

//Session for Admin
//   $count = $statement->rowCount();
//   if ($count > 0) {
//     $result = $statement->fetchAll();
//     foreach ($result as $row) {
//       if ($row['user_status'] == 'Active') {
//         $pass1 = $_POST["password"];
//         $user = $result;

//         if (password_verify($pass1, $row['user_password'])) {

//           $_SESSION['type'] = $row['user_type'];
//           $_SESSION['user_id'] = $row['user_id'];
//           $_SESSION['user_address'] = $row['user_address'];
//           $_SESSION['user_contact'] = $row['user_contact'];
//           $_SESSION['user_name'] = $row['user_name'];
//           header("location:index.php");
//         } else {
//           $message = "<center><br><h6 style='color:#fff; background: #D9514EFF; padding:5px;'>Password Incorrect</h6></center>";
//         }
//       } else {
//         $message = "<center><br><h6 style='color:#fff; background: #D9514EFF; padding:5px'>Your account is disabled, Go to Admin Panel.</h6></center>";
//       }
//     }
//   } else {
//     $message = "<center><br><h6 style='color:#fff; background: #D9514EFF; padding:5px'>Wrong Email Address</h6></center>";
//   }
// }

?>

<?php
// $user_emailrror = NULL;

// if (isset($_POST['submit'])) {

//   //Get form data
//   $user_name = $_POST['fullname'];
//   $user_email = $_POST['email'];
//   $user_contact = $_POST['contacts'];
//   $user_address = $_POST['address'];
//   $user_password = $_POST['password'];
//   $user_password2 = $_POST['cpassword'];


//   if (strlen($user_name) < 5) {
//     $user_emailrror = "";
//   } else {
//     //Form is valid

//     //Connect to the database
//     $mysqli = new MySQLi('localhost', 'root', '', 'database');

//     //Sanitize form data
//     $user_name = $mysqli->real_escape_string($user_name);
//     $user_email = $mysqli->real_escape_string($user_email);
//     $user_contact = $mysqli->real_escape_string($user_contact);
//     $user_address = $mysqli->real_escape_string($user_address);
//     $user_password = $mysqli->real_escape_string($user_password);
//     $user_password2 = $mysqli->real_escape_string($user_password2);


//     //Generate Date and Time
//     $now = date_create()->format('Y-m-d H:i:s');

//     //Generate Vkey
//     $vkey = md5(time() . $user_name);

//     //Insert account into the database
//     $hashed_password = password_hash($user_password, PASSWORD_DEFAULT);
//     //$user_password = md5($user_password);
//     $user_password = $hashed_password;
//     $insert = $mysqli->query("INSERT INTO user_details(user_name,user_email,user_contact, user_address, user_password,user_type,vkey,user_status)
//         VALUES ('$user_name','$user_email','$user_contact','$user_address','$user_password','user','$vkey','Inactive')");

//     if ($insert) {
//       //Send email

//       $to = $user_email;
//       $subject = "Email Verification";
//       $message = "<h2>Account Verification:</h2>
//         <p> Good Day! We, from ILAW Lighting and Equipment Trading would like to inform you that you are about to create your ILAW Account, Please click the confirmation link below: </p><br>
//         <a href='http://localhost/Capstone/verify.php?vkey=$vkey'>Confirm to Register Account?</a><br>
//         <p>Thank you and have a blast shopping!</p>";

//       $headers = "From: ilawnatinto21@gmail.com \r\n";
//       $headers .= "MIME-Version: 1.0" . "\r\n";
//       $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

//       mail($to, $subject, $message, $headers);
//       header('location:msgVerify.php');
//     } else {
//       echo $mysqli->error;
//     }
//   }
// }

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ILAW</title>
  <link rel="shortcut icon" type="image/x-icon" href="images/Logo/ILAW_Logo2.png" />
  <!-- Font Awesome icons (free version)-->
  <script src="linkscript/fontawesome.js"></script>
  <!-- Bootstrap CSS-->
  <link rel="stylesheet" href="linkscript/bootstrap5.1.min.css" crossorigin="anonymous">
  <script src="linkscript/jquery-1.12.4.min.js" crossorigin="anonymous"></script>
  <!-- Custom CSS-->
  <link href="admin/assets/css/style_loader.css" rel="stylesheet" />
  <link href="css/login.css" rel="stylesheet" />
  <script src="main.js"></script>
  <script src="js/jquery2.js"></script>
  <link href="css/style_e-commerce.css" rel="stylesheet" />
</head>
<!--Page loader-->
<div class="loader-wrapper overlay">
    <div class="loader-circle">
        <div class="loader"></div>
    </div>
</div>
<!--Page loader-->
<body style=" background-image: url(images/Others/ILAW_BGF2.jpg);
  background-position: center center;
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-color: whitesmoke;
  background-size: cover;">

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
  <section style="margin-top:100px">
    <nav>
      <div class="nav nav-tabs nav-fill" style="border: none" id="nav-custom-2" role="tablist">
        <a class="nav-item nav-link active text-white" style="background: #282828;" id="nav-home" data-toggle="tab" href="#custom-home-2" role="tab" aria-controls="nav-home-2" aria-selected="true">Log In </a>
        <a class="nav-item nav-link text-white" style="background: #282828" id="nav-profile" data-toggle="tab" href="#custom-profile-2" role="tab" aria-controls="nav-profile-2" aria-selected="false">Register</a>
      </div>
    </nav>
    <div class="rounded-bottom container" style=" background: #282828; box-shadow: 0px 0px 8px 0px black; border-radius: 0px 0px 0px 5px;">

      <div class="tab-content p-5" id="nav-custom-2">
        <div class="tab-pane fade show active" id="custom-home-2" role="tabpanel" aria-labelledby="nav-home-2">
          <!--Login Form-->
          <form method="post" id="login">
            <a class="logo_banner" href="index.php"><img src="images/Banners/ILAW_Banner.png" alt="ILAW Logo" onclick="window.location='index.php';"></a>
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
            <div class="form-group">
              <label for="Email1" class="mb-0 text-white">Email</label>
              <input type="email" name="email" class="form-control" placeholder="example@gmail.com" data-validation="email" id="Email1" autofocus required>
            </div>
            <br>
            <div class="form-group">
              <label for="pass-vr" class="mb-0 text-white">Password</label>
              <input type="password" name="password" class="form-control" placeholder="Enter Password" id="myInput" required>
            </div>
            <div class="form-group">
              <div class="custom-control custom-checkbox">

                <label class="text-white"><input type="checkbox" onclick="myFunction()"> Show Password</label>
              </div>

            </div>
            <br>
            <center>
              <div class="text"><a href="forgot_password.php" style="color: white">Forgot password?</a></div>
            </center>
            <br>
            <div class="form-group text-center">
              <button type="reset" class="btn btn-danger">Clear</button>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <button type="submit" name="login" value="Login" class="btn btn-primary text-white" required>Login</button>
            </div>
          </form>

        </div>
        <div class="tab-pane fade" id="custom-profile-2" role="tabpanel" aria-labelledby="nav-profile-2">
          <form method="POST" id="register">
            <div class="form-group">
              <input type="text" name="first_name" class="form-control" placeholder="First Name" autofocus required>
            </div>
            <br>
            <div class="form-group">
              <div class="col-md-12 d-flex mr-5">
                <input type="text" name="middle_name" class="form-control" placeholder="Middle Name">
                &nbsp;
                <input type="text" name="last_name" class="form-control" placeholder="Last Name" required>
              </div>
            </div>
            <br>
            <div class="form-group">
              <input type="email" name="email" class="form-control" placeholder="Email Address" data-validation="email" id="Email1" required>
            </div>
            <br>
            <div class="form-group">
              <div class="col-md-12 d-flex mr-5">
                <select class="form-control" id="region" name="region" style="cursor: pointer;" required>
                  <option value="">--- Select Region ---</option>
                  <?php
                  $query = mysqli_query($con, "select * from table_region");
                  while ($row = mysqli_fetch_array($query)) {
                  ?>
                    <option value="<?php echo $row['region_id']; ?>"> <?php echo $row['region_name']; ?> </option>
                  <?php
                  }
                  ?>
                </select>
                &nbsp;
                <input type="number" name="zip_code" class="form-control" placeholder="Zip Code" required>
              </div>
            </div>
            <br>
            <div class="form-group">
              <div class="col-md-12 d-flex ">
                <select class="form-control" id="province" name="province" style="cursor: pointer;">
                  <option value="">--- Select Province ---</option>

                </select>
                &nbsp;
                <select class="form-control" id="city" name="city" style="cursor: pointer;">
                  <option value="">--- Select City ---</option>

                </select>
              </div>
            </div>
            <br>
            <div class="form-group">
              <input type="text" name="address" class="form-control" placeholder="Blk/Lot/Street/Barangay (Address)" required>
            </div>
            <br>
            <div class="form-group">
              <input type="number" name="contact" class="form-control" placeholder="Contact #" min="0" required>
            </div>
            <br>
            <label for="pasword" class="text-white text-center h6">Must have at least <b>1 Capital Letter</b>, <b> insert a Number</b>, and exceeds to <b>8 characters</b></label>
            <div class="form-group">
              <input type="password" name="password" class="form-control" placeholder="Password" id="myInput" pattern="(?=.*\d).{8,}" required>
            </div>
            <br>
            <div class="form-group">

              <input type="password" name="cpassword" class="form-control" placeholder="Confirm Password" id="myInput" pattern="(?=.*\d).{8,}" onkeyup='check();' required>
              <span class="field-icon2" id='message'></span>
            </div>
            <br>
            <div class="form-group text-center">
              <button type="reset" class="btn btn-danger">Clear</button>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <button type="submit" name="signup" class="btn btn-primary text-white" required>Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
  <div class="butnavbar">
    <p style="color: white;"> Copyright © 2022|ILAW Lighting and Equipment Trading </p>
  </div>
  <!--For Show Password-->
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
            $("#province").html(data);
          }

        });
      })
      $("#province").on('click', function() {
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


    function myFunction() {
      var x = document.getElementById("myInput");
      if (x.type === "password") {
        x.type = "text";
      } else {
        x.type = "password";
      }
    }
  </script>
  <script src="js/functions.js" type="text/javascript"></script>
  <!--Bootstrap-->
  <script src="admin/assets/js/bootstrap.min.js"></script>
  <!--Form validator-->
  <script src="admin/assets/js/form-validator/jquery.form-validator.min.js"></script>
  <!-- For Cart-->
  <script src="linkscript/main.js"></script>
</body>

</html>