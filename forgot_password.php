<?php require_once "controllerUserData.php";
define('ILAW',true);

?>
<?php
//login.php



// if(isset($_SESSION['type']))
// {
// 	header("location: index.php");
// }
// //overall login part
// $message = '';

// if(isset($_POST["login"]))
// {
//   //query for Admin
// 	$query = "
// 	SELECT * FROM user_details 
// 		WHERE user_email = :user_email
// 	";
// 	$statement = $connect->prepare($query);
// 	$statement->execute(
// 		array(
// 				'user_email' 	=>	$_POST["user_email"]
// 			)
// 	);

//   //Session for Admin
// 	$count = $statement->rowCount();
// 	if($count > 0)
// 	{
// 		$result = $statement->fetchAll();
// 		foreach($result as $row)
// 		{
// 			if($row['user_status'] == 'Active')
// 			{
// 				$pass1 = $_POST["password"];
// 				$user = $result;

// 				if(password_verify($pass1, $row['user_password']))
// 				{

// 					$_SESSION['type'] = $row['user_type'];
// 					$_SESSION['user_id'] = $row['user_id'];
//           $_SESSION['user_address'] = $row['user_address'];
//           $_SESSION['user_contact'] = $row['user_contact'];
// 					$_SESSION['user_name'] = $row['user_name'];
// 					header("location:index.php");
// 				}
// 				else
// 				{
// 					$message = "<center><br><h6 style='color:#fff; background: #D9514EFF; padding:5px;'>Password Incorrect</h6></center>";
// 				}
// 			}
// 			else
// 			{
// 				$message = "<center><br><h6 style='color:#fff; background: #D9514EFF; padding:5px'>Your account is disabled, Go to Admin Panel.</h6></center>";
// 			}
// 		}
// 	}

// 	else
// 	{
// 		$message = "<center><br><h6 style='color:#fff; background: #D9514EFF; padding:5px'>Wrong Email Address</h6></center>";
// 	}
// }

// 
?>

<?php
// $user_emailrror = NULL;

// if(isset($_POST['submit'])){

//     //Get form data
//     $user_name = $_POST['fullname'];
//     $user_email = $_POST['email'];
//     $user_contact = $_POST['contacts'];
//     $user_address = $_POST['address'];
//     $user_password = $_POST['password'];
//     $user_password2 = $_POST['cpassword'];


//     if(strlen($user_name) < 5){
//         $user_emailrror = "";
//     }else{
//         //Form is valid

//         //Connect to the database
//         $mysqli = NEW MySQLi('localhost','root','','database');

//         //Sanitize form data
//         $user_name = $mysqli->real_escape_string($user_name);
//         $user_email = $mysqli->real_escape_string($user_email);
//         $user_contact = $mysqli->real_escape_string($user_contact);
//         $user_address = $mysqli->real_escape_string($user_address);
//         $user_password = $mysqli->real_escape_string($user_password);
//         $user_password2 = $mysqli->real_escape_string($user_password2);


//         //Generate Date and Time
//         $now = date_create()->format('Y-m-d H:i:s');

//         //Generate Vkey
//         $vkey = md5(time() .$user_name);

//         //Insert account into the database
//         $hashed_password = password_hash($user_password, PASSWORD_DEFAULT);
//         //$user_password = md5($user_password);
//         $user_password = $hashed_password;
//         $insert = $mysqli->query("INSERT INTO user_details(user_name,user_email,user_contact, user_address, user_password,user_type,vkey,user_status)
//         VALUES ('$user_name','$user_email','$user_contact','$user_address','$user_password','user','$vkey','Inactive')");

//         if($insert){
//             //Send email

//         $to = $user_email;
//         $subject = "Email Verification";
//         $message = "<h2>Account Verification:</h2>
//         <p> Good Day! We, from ILAW Lighting and Equipment Trading would like to inform you that you are about to create your ILAW Account, Please click the confirmation link below: </p><br>
//         <a href='http://localhost/Capstone/verify.php?vkey=$vkey'>Confirm to Register Account?</a><br>
//         <p>Thank you and have a blast shopping!</p>";

//         $headers = "From: ilawnatinto21@gmail.com \r\n";
//         $headers .= "MIME-Version: 1.0" . "\r\n";
//         $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

//         mail($to,$subject,$message,$headers);
//         header('location:msgVerify.php');            
//         }else{
//             echo $mysqli->error;
//         }


//     }

// }

?>


<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ILAW</title>
  <link rel = "shortcut icon" type="image/x-icon" href="images/Logo/ILAW_Logo2.png" />
  <!-- Font Awesome icons (free version)-->
  <script src="linkscript/fontawesome.js"></script>
  <!-- Bootstrap CSS-->
  <link rel="stylesheet" href="linkscript/bootstrap5.1.min.css" crossorigin="anonymous">
  <script src="linkscript/jquery-1.12.4.min.js" crossorigin="anonymous"></script>
  <!-- Custom CSS-->
  <link href="css/login.css" rel="stylesheet" />
  <link href="css/style_e-commerce.css" rel="stylesheet" />
</head>

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
    <div class="rounded-bottom container" style=" background: #282828; box-shadow: 0px 0px 8px 0px black; border-radius: 0px 0px 0px 5px;">
      <form method="post" id="login">
        <a class="logo_banner" href="index.php"><img src="images/Banners/ILAW_Banner.png" alt="ILAW Logo" onclick="window.location='index.php';"></a>
        <div class="col-md-12 login-box-form p-4">
          <center>
            <h4 class="mb-4 text-white">Forgot password:</h4>
            <?php
            if (count($errors) > 0) {
            ?>
              <div class="alert alert-danger text-center">
                <?php
                foreach ($errors as $error) {
                  echo $error;
                }
                ?>
              </div>
            <?php
            }
            ?>
            <form action="" class="mt-2">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text pb-3" id="basic-addon1"><i class="fa fa-envelope fa-lg mt-2"></i></span>
                </div>
                <input type="email" class="form-control mt-0" name ="email" placeholder="Email address" aria-label="email" aria-describedby="basic-addon1" required>
              </div>

              <div class="form-group">
                <button class="btn btn-primary btn-block p-2 mb-1 text-white" name="check-email">Send</button>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <a class="btn btn-danger btn-block p-2 mb-1 text-white" href="login.php">Back</a>
              </div>
            </form>
        </div>
    </div>
    </div>
    </div>
  </section>
  <div class="butnavbar">
    <d style="color: white"> Copyright © 2021|ILAW Lighting and Equipment Trading </d>
  </div>
  <!--For Show Password-->
  <script>
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
</body>

</html>