<?php
include('../../connection.php');
if (isset($_SESSION['type'])) {
    if ($_SESSION['type'] == 'master') {
        header('location: ../../index.php');
        die();
    } elseif ($_SESSION['type'] == 'user') {
        header('location: ../../index.php');
        die();
    } elseif ($_SESSION['type'] == ''){
        header('location: ../../index.php');
        die();
    }
  }
// include('../database_connection.php');
// $con = mysqli_connect('localhost', 'root', '', 'database');
$email = $_SESSION['email'];
$sql = "SELECT * FROM user_details WHERE user_email = '$email' ";
$result = mysqli_query($con, $sql);
$user = mysqli_fetch_assoc($result);
?>

<!--Page loader-->
<div class="loader-wrapper">
        <div class="loader-circle">
            <div class="loader"> </div>
        </div>
    </div>
<!--Page loader-->
<!--Main Content-->


<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="description" content="" >
    <meta name="author" content="">
    <meta name="keywords" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!--Meta Responsive tag-->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>ILAW</title>
    <!--Browser Icon-->
    <link rel="icon" type="image/x-icon" href="images/Logos/ILAW_Logo.png" >
    <!--Bootstrap CSS-->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <!--Custom style.css-->
    <link rel="stylesheet" href="../assets/css/quicksand.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <!--Font Awesome-->
    <link rel="stylesheet" href="../assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="../assets/css/fontawesome.css">
    <!--Animate CSS-->
    <link rel="stylesheet" href="../assets/css/animate.min.css">
    <!--Chartist CSS-->
    <link rel="stylesheet" href="../assets/css/chartist.min.css">
    <!--Map-->
    <link rel="stylesheet" href="../assets/css/jquery-jvectormap-2.0.2.css">
    <!--Bootstrap Calendar-->
    <link rel="stylesheet" href="../assets/js/calendar/bootstrap_calendar.css">
    <!--Nice select -->
    <link rel="stylesheet" href="../assets/css/nice-select.css">
    <!--DataTables-->
    <link rel="stylesheet" href="../assets/css/dataTables.bootstrap4.min.css" />
</head>
<body>

<div class="row main-content">
            <!--Sidebar left-->
            <div class="col-sm-3 col-xs-6 sidebar pl-0">
                <div class="inner-sidebar mr-2">
                    <!--Admin Profile-->
                    <div class="avatar text-center">
                        <img src="../../images/user-img/<?php echo $user['profile'] ?>" alt="Staff_Profile" class="rounded-circle" />
                        <p><strong><?php echo $user['first_name'], " ", $user['middle_name'], " ", $user['last_name'] ?></strong></p>
                    <span class="small" style="color: #25AAE2"><strong>Stock Personnel</strong></span>
                    </div>
                     <!--Admin Profile-->

                    <!--Sidebar Navigation Menu-->

    <div class="sidebar-menu-container">
        <ul class="sidebar-menu mt-4 mb-4">
            <!-- Dashboard Page -->
            <?php 
                    if($active == "Dashboard"){
                    ?>
                   <li class="parent">
                        <a href="dashboard.php"  class="active"><i class="fa fa-home mr-3"> </i>
                        <span class="none">Dashboard</span>
                        </a>
                    </li>
                    <?php }else{ ?>
                    <li class="parent">
                        <a href="dashboard.php"><i class="fa fa-home mr-3"> </i>
                        <span class="none">Dashboard</span>
                        </a>
                    </li>
            <?php  } ?>
            <!-- Customers Page -->
            <?php 
                    if($active == "Customers"){
                    ?>
                    <li class="parent">
                        <a href="customers.php"  class="active"><i class="fa fa-group (alias) mr-3"> </i>
                        <span class="none">Customers</span>
                        </a>
                    </li>
                    <?php }else{ ?>
                    <li class="parent">
                        <a href="customers.php"><i class="fa fa-group (alias) mr-3"> </i>
                        <span class="none">Customers</span>
                        </a>
                    </li>
            <?php  } ?>
             <!-- Items Page -->
             <?php 
                    if($active == "Items"){
                    ?>
                    <li class="parent">
                        <a href="items.php"  class="active"><i class="fa fa-suitcase mr-3"></i>
                            <span class="none">Items</span>
                        </a>
                    </li>
                    <?php }else{ ?>
                    <li class="parent">
                        <a href="items.php"><i class="fa fa-suitcase mr-3"></i>
                            <span class="none">Items</span>
                        </a>
                    </li>
            <?php  } ?>
           <!-- Suppliers Page -->
           <?php 
                    if($active == "Suppliers"){
                    ?>
                    <li class="parent">
                        <a href="supplier.php"  class="active"><i class="fa fa-cubes mr-3"> </i>
                        <span class="none">Suppliers</span>
                        </a>
                    </li>
                    <?php }else{ ?>
                    <li class="parent">
                        <a href="supplier.php"><i class="fa fa-cubes mr-3"> </i>
                        <span class="none">Suppliers</span>
                        </a>
                    </li>
            <?php  } ?>
            <!-- Categories Page -->
            <?php 
                    if($active == "Categories"){
                    ?>
                    <li class="parent">
                        <a href="categories.php"  class="active"><i class="fa fa-folder-open mr-3"> </i>
                        <span class="none">Categories</span>
                        </a>
                    </li>
                    <?php }else{ ?>
                    <li class="parent">
                        <a href="categories.php"><i class="fa fa-folder-open mr-3"> </i>
                        <span class="none">Categories</span>
                        </a>
                    </li>
            <?php  } ?>
            <!-- Unit of Measurement Page -->
            <?php 
                    if($active == "Measurement"){
                    ?>
                    <li class="parent">
                        <a href="measurement.php"  class="active"><i class="fa fa-tasks mr-3"> </i>
                        <span class="none">Unit of Measurement</span>
                        </a>
                    </li>
                    <?php }else{ ?>
                    <li class="parent">
                        <a href="measurement.php"><i class="fa fa-tasks mr-3"> </i>
                        <span class="none">Unit of Measurement</span>
                        </a>
                    </li>
            <?php  } ?>
            <!-- Couriers Page -->
            <?php 
                    if($active == "Couriers"){
                    ?>
                    <li class="parent">
                        <a href="couriers.php"  class="active"><i class="fa fa-send mr-3"> </i>
                        <span class="none">Couriers</span>
                        </a>
                    </li>
                    <?php }else{ ?>
                        <li class="parent">
                            <a href="couriers.php"><i class="fa fa-send mr-3"> </i>
                            <span class="none">Couriers</span>
                            </a>
                        </li>
            <?php  } ?>
            
        </ul>
    </div>
<!-- End of Sidebar Navigation Menu-->
    </div>
</div>
            <!--Sidebar left-->

<!-- Page JavaScript Files-->
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/jquery-1.12.4.min.js"></script>
    <!--Popper JS-->
    <script src="../assets/js/popper.min.js"></script>
    <!--Bootstrap-->
    <script src="../assets/js/bootstrap.min.js"></script>
    <!--Sweet alert JS-->
    <script src="../assets/js/sweetalert.js"></script>
    <!--Progressbar JS-->
    <script src="../assets/js/progressbar.min.js"></script>
    <!--Flot.JS-->
    <script src="../assets/js/charts/jquery.flot.min.js"></script>
    <script src="../assets/js/charts/jquery.flot.pie.min.js"></script>
    <script src="../assets/js/charts/jquery.flot.categories.min.js"></script>
    <script src="../assets/js/charts/jquery.flot.stack.min.js"></script>
    <!--Chart JS-->
    <script src="../assets/js/charts/chart.min.js"></script>
    <!--Chartist JS-->
    <script src="../assets/js/charts/chartist.min.js"></script>
    <script src="../assets/js/charts/chartist-data.js"></script>
    <script src="../assets/js/charts/demo.js"></script>
    <!--Maps-->
    <script src="../assets/js/maps/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="../assets/js/maps/jquery-jvectormap-world-mill-en.js"></script>
    <script src="../assets/js/maps/jvector-maps.js"></script>
    <!--Bootstrap Calendar JS-->
    <script src="../assets/js/calendar/bootstrap_calendar.js"></script>
    <script src="../assets/js/calendar/demo.js"></script>
    <!--Nice select-->
    <script src="../assets/js/jquery.nice-select.min.js"></script>

    <!--Custom Js Script-->
    <script src="../assets/js/custom.js"></script>
    
    <script>
        //Nice select
        $('.bulk-actions').niceSelect();
    </script>
     </body>
</html>