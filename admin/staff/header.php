<?php
if (isset($_SESSION['type'])) {
    if ($_SESSION['type'] == 'master') {
        header('location: ../../error_page.php');
        die();
    } elseif ($_SESSION['type'] == 'user') {
        header('location: ../../error_page.php');
        die();
    }
  }else {
    $active = " ";
    header('location:../../error_page.php');
    die();
  }

$con = mysqli_connect('localhost', 'u707920109_root', 'Ilawadmin2021', 'u707920109_database');
$email = $_SESSION['email'];
$sql = "SELECT * FROM user_details WHERE user_email = '$email' ";
$result = mysqli_query($con, $sql);
$user = mysqli_fetch_assoc($result);
?>


<!--Page Wrapper-->

<div class="container-fluid">

<!--Header-->
<div class="row header shadow-sm">
    
    <!--Logo-->
    <div class="col-sm-3 pl-0 text-center header-logo">
       <div class="bg-theme mr-2 pt-1 pb-1 mb-0">
            <h3 class="logo"><a href="dashboard.php" class="text-secondary logo"><img src="../images/Logos/ILAW_Banner.png" width="150rem"  alt="ILAW_Logo"></a></h3>
       </div>
    </div>
    <!--Logo-->

    <!--Header Menu-->
    <div class="col-sm-9 header-menu pt-3 pb-0">
        <div class="row">
            
            <!--Menu Icons-->
            <div class="col-sm-4 col-8 pl-0">
                    <!--Toggle sidebar-->
                    <span class="menu-icon" onclick="toggle_sidebar()">
                        <span id="sidebar-toggle-btn"></span>
                    </span>
                    <!--Toggle sidebar-->
                </div>
                          

            <!--Profile and Logout-->
            <div class="col-sm-8 col-4 text-right flex-header-menu justify-content-end">
                <div class="mr-4">
                    <a class="" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="../../images/user-img/<?php echo $user['profile'] ?>" alt="Staff" class="rounded-circle" width="40px" height="40px">
                    </a>
                    <div class="dropdown-menu dropdown-menu-right mt-13" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="../../profile.php #profile"><i class="fa fa-user pr-2"></i> Profile</a>
                        <a class="dropdown-item" href="../../index.php"><i class="fa fa-building pr-2"></i> E-Commerce</a>
                        <a class="dropdown-item" style="cursor:pointer" id="show_alert_promise_three"><i class="fa fa-power-off pr-2"></i> Logout</a>
                    </div>
                </div>
            </div>
            <!--Profile and Logout-->
        </div>    
    </div>
    <!--Header Menu-->
</div>
<!--Header-->
