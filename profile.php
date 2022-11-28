<?php
define('ILAW', true);

include('database_connection.php');
include('connection.php');

if (empty($_SESSION['email'])) {
    header("Location: login.php");
} else ($email = $_SESSION['email']);


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
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
    <section class="second_section">
        <div class="line_PFOS">
            <h1>My Profile</h1>
            <p><i>Note: As a customer, your update information will be used upon ordering for order details. </i></p>
        </div>
    </section>
    <section class="profile_section" id="myprofile">
        <div class="upload ">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-lg-4">
                    <!-- Profile picture card-->
                    <div class="card mb-4 mb-xl-0 border shadow" id="refresh">
                        <?php
                        $sql = "SELECT * FROM user_details WHERE user_email = '$email' ";
                        $result = mysqli_query($con, $sql);
                        $user = mysqli_fetch_assoc($result);
                        $cusId = $user['user_id'];
                        $name = $user['last_name'];
                        $img = $user['profile'];

                        ?>
                        <form class="form" id="profile" action="" enctype="multipart/form-data" method="post">
                            <div class="card-header">Profile Picture</div>
                            <div class="card-body text-center">
                                <!-- Profile picture image-->
                                <img class="img-account-profile rounded-circle border shadow mb-2" style="vertical-align: middle; width: 100px; height: 100px;border-radius: 50%;" src="images/user-img/<?php echo $img ?>" alt="" title="<?php echo $img ?>" alt="profile_picture">
                                <!-- Profile picture help block-->
                                <div class="small font-italic text-muted mb-2">JPG or PNG no larger than 5 MB</div>
                                <!-- Profile picture upload button-->
                                <input type="hidden" name="id" value="<?php echo $cusId ?>">
                                <input type="hidden" name="name" value="<?php echo $name ?>">
                                <input class="form-control form-control-sm mb-2 submit" type="file" name="image" id="image" accept=".jpg, .jpeg, .png">
                                <span class="mt-2"><i class="fa fa-envelope"></i> <?php echo $email ?></span>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-xl-8">
                    <!-- Account details card-->
                    <div class="card mb-4  border shadow">
                        <div class="card-header">Account Details</div>
                        <div class="card-body">
                            <form method="POST" id="update">
                                <!-- Form Row-->
                                <div class="row">
                                    <!-- Form Group (first name)-->
                                    <div class="col-md-6">
                                        <h5><label for="inputFirstName">First Name</label></h5>
                                        <input class="form-control" name="first_name" type="text" placeholder="Enter your first name" value="<?php echo $user['first_name'] ?>" required>
                                    </div>
                                    <!-- Form Group (middle name)-->
                                    <div class="col-md-6">
                                        <h5><label for="inputMiddleName">Middle Name</label></h5>
                                        <input class="form-control" name="middle_name" type="text" placeholder="Enter your middle name" value="<?php echo $user['middle_name'] ?>">
                                    </div>
                                    <!-- Form Group (last name)-->
                                    <div class="col-md-6 mt-2">
                                        <h5><label for="inputLastName">Last Name</label></h5>
                                        <input class="form-control" name="last_name" type="text" placeholder="Enter your last name" value="<?php echo $user['last_name'] ?>" required>
                                    </div>
                                    <!-- Form Group (phone number)-->
                                    <div class="col-md-6 mt-2">
                                        <h5><label for="inputPhone">Mobile Number</label></h5>
                                        <input class="form-control" name="contact" type="number" placeholder="Enter your phone number" minlength="11" value="<?php echo $user['user_contact'] ?>" required>
                                    </div>
                                </div>
                                <!-- Form Row-->
                                <div class="row">
                                    <!-- Form Group (region)-->
                                    <div class="col-md-6 mt-2">
                                        <h5><label>Region</label></h5>
                                        <select class="form-control" id="region" name="region" style="cursor: pointer;">
                                            <option value="<?php
                                                            $region = $user['region'];
                                                            $query = mysqli_query($con, "SELECT * FROM table_region WHERE region_id = '$region'");
                                                            while ($row = mysqli_fetch_array($query)) {
                                                                echo $row['region_id'];
                                                            }
                                                            ?>"><?php
                                                                $region = $user['region'];
                                                                $query = mysqli_query($con, "SELECT * FROM table_region WHERE region_id = '$region'");
                                                                while ($row = mysqli_fetch_array($query)) {
                                                                    echo $row['region_name'];
                                                                }
                                                                ?></option>
                                            <?php
                    
                                            $query = mysqli_query($con, "select * from table_region");
                                            while ($row = mysqli_fetch_array($query)) {
                                            ?>
                                                <option value="<?php echo $row['region_id']; ?>"> <?php echo $row['region_name']; ?> </option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <!-- Form Group (zip code)-->
                                    <div class="col-md-6 mt-2">
                                        <h5><label>Zip Code</label></h5>
                                        <input class="form-control" name="zip_code" type="number" placeholder="Enter your zip code" value="<?php echo $user['zip_code'] ?>">
                                    </div>
                                    <!-- Form Group (Province)-->
                                    <div class="col-md-6 mt-2">
                                        <h5><label>Province</label></h5>
                                        <select class="form-control" id="province" name="province" style="cursor: pointer;">
                                            <option value="<?php
                                                            $province = $user['province'];
                                                            $query = mysqli_query($con, "SELECT * FROM table_province WHERE province_id = '$province'");
                                                            while ($row = mysqli_fetch_array($query)) {
                                                                echo $row['province_id'];
                                                            }
                                                            ?>"><?php
                                                                $province = $user['province'];
                                                                $query = mysqli_query($con, "SELECT * FROM table_province WHERE province_id = '$province'");
                                                                while ($row = mysqli_fetch_array($query)) {
                                                                    echo $row['province_name'];
                                                                }
                                                                ?></option>
                                            <?php
                                            $query = mysqli_query($con, "select * from table_province");
                                            while ($row = mysqli_fetch_array($query)) {
                                            ?>
                                                <option value="<?php echo $row['province_id']; ?>"> <?php echo $row['province_name']; ?> </option>
                                            <?php
                                            }
                                            ?>

                                        </select>
                                    </div>
                                    <!-- Form Group (City)-->
                                    <div class="col-md-6 mt-2">
                                        <h5><label>City</label></h5>
                                        <select class="form-control" id="city" name="city" style="cursor: pointer;">
                                            <option value=" <?php
                                                            $municipality = $user['city'];
                                                            $query = mysqli_query($con, "SELECT * FROM table_municipality WHERE municipality_id = '$municipality'");
                                                            while ($row = mysqli_fetch_array($query)) {
                                                                echo $row['municipality_id'];
                                                            }
                                                            ?>"> <?php
                                                                    $municipality = $user['city'];
                                                                    $query = mysqli_query($con, "SELECT * FROM table_municipality WHERE municipality_id = '$municipality'");
                                                                    while ($row = mysqli_fetch_array($query)) {
                                                                        echo $row['municipality_name'];
                                                                    }
                                                                    ?></option>
                                        </select>
                                    </div>
                                    <!-- Form Group (remaining address)-->
                                    <div class="mt-2">
                                        <h5><label for="inputEmailAddress">Home Address</label></h5>
                                        <input class="form-control" name="address" type="text" placeholder="Enter your Blk/Lot/Street" value="<?php echo $user['home_address'] ?>" required>
                                    </div>
                                </div>
                                <!-- Save changes button-->
                                <div class="form-group text-center">
                                    <!-- <button type="submit" name="update_details" class="btn" style="background: #11cf1a; color: #fff" required>Submit</button> -->
                                    <input type="hidden" name="email" id="email" value="<?php echo $email ?>" />
                                    <input type="hidden" name="save" id="save" value="update" />
                                    <button class="btn btn-primary mt-2" type="submit" name="update_details"><i class="fa fa-save fa-lg"></i> Save Changes</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="line_transactions">
            <h3><b>My Transactions</b></h3>
            <p>You can view all order transactions that you placed from this account. </p>
            <!--Datatable-->
            <div class="table-responsive">
                <table id="category_data" class="table table-striped table-bordered w-100 d-block d-md-table">
                    <thead>
                        <tr>
                            <th><b>TRANSACTION ID</b></th>
                            <th><b>NO. OF ITEM(S) PURCHASED</b></th>
                            <th><b>TOTAL EXPENSES</b></th>
                            <th><b>ORDER STATUS</b></th>
                            <th><b>ORDER DATE</b></th>
                        </tr>

                    </thead>
                    <?php
                    $query  = "SELECT * FROM customer_order where customer_id ='$cusId'";
                    $result    = mysqli_query($con, $query);
                    while ($row = mysqli_fetch_array($result)) {
                        $transaction = $row["transaction_id"];
                        switch ($row['status']) {
                            case '0':
                                $out = "<i class='fas fa-truck'></i> Parcel will be processed | <span class='text-primary'> Order Placed</span>";
                                break;
                            case '1':
                                $out = "<i class='fas fa-truck'></i> Parcel has been sent to courier | <span class='text-primary'> Order Shipped Out</span>";
                                break;
                            case '2':
                                $out = "<i class='fas fa-truck'></i> Parcel is to recieved | <span class='text-primary'> Order is to recieve </span>";
                                break;
                            case '3':
                                $out = "<i class='fas fa-truck'></i> Parcel has been delivered <span class='text-dark'>|<span><span class='text-success'> Order Completed</span>";
                                break;
                            case '4':
                                $out = "<i class='fas fa-truck'></i> Parcel has been cancelled | <span class='text-danger'> Order Cancelled</span>";
                                break;
                        }
                        $sql = "select count(*) as total from customer_order_product WHERE transaction_id = '$transaction'";
                        $res = mysqli_query($con, $sql);
                        $count = mysqli_fetch_assoc($res);
                        echo '  
                               <tr>
                                    <div>  
                                    <td>' . $row["transaction_id"] . '</td>
                                    <td>' . $count['total'] . '</td>
                                    <td>' . $row['total_amount'] . '</td>
                                    <td>' . $out . '</td>       
                                    <td>' . $row["date_created"] . '</td>
                                    </div>
                               </tr>  
                               ';
                    }
                    ?>
                </table>
            </div>
            <!-- <span id="alert_action"></span> -->
            <!--/Datatable-->
        </div>
    </section>

    <?php
    include("footer/footer.php")
    ?>
    <script src="js/functions.js" type="text/javascript"> </script>
    <script type="text/javascript">
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

            $(document).on('change', '#profile', function(event) {
                event.preventDefault();
                var form_data = $(this).serialize();
                $.ajax({
                    url: "profile_action.php",
                    method: "POST",
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        $("#refresh").load(location.href + " #refresh");
                        $('#alert_action').fadeIn().html('<div class="alert alert-success">' + data + '</div>');
                        Swal.fire({
                            icon: 'success',
                            type: 'success',
                            title: 'Item',
                            text: 'Profile Updated Successfully',
                            showConfirmButton: false,
                            timer: 2000
                        })
                    }
                })
            });

            $(document).on('submit', '#update', function(event) {
                event.preventDefault();
                var form_data = $(this).serialize();

                Swal.fire({
                    icon: 'info',
                    title: 'Are you sure you want to save details?',
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonText: 'Yes'
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {

                        $.ajax({
                            url: "profile_action.php",
                            method: "POST",
                            data: form_data,
                            success: function(data) {
                                Swal.fire({
                                    icon: 'success',
                                    type: 'success',
                                    title: 'Details',
                                    text: 'Updated Successfully',
                                    showConfirmButton: false,
                                    timer: 2000
                                })

                            }
                        })
                    }

                });

            });
        });






        // document.getElementById("image").onchange = function() {
        //     document.getElementById('form').submit();
        // }

        // $(document).ready(function() {


        //     var readURL = function(input) {
        //         if (input.files && input.files[0]) {
        //             var reader = new FileReader();

        //             reader.onload = function(e) {
        //                 $('.avatar').attr('src', e.target.result);
        //             }

        //             reader.readAsDataURL(input.files[0]);
        //         }
        //     }


        //     $(".file-upload").on('change', function() {
        //         readURL(this);
        //     });
        // });




        function showAlert_profile() {
            //alert ("Saved Successfully!");  
            swal({
                title: "Profile Successfully Edited!",
                text: "You Updated your Profile.",
                timer: 50000,
                icon: "success",
                button: false,
            }).then(
                function() {},
                // handling the promise rejection
                function(dismiss) {
                    if (dismiss === 'timer') {
                        //console.log('I was closed by the timer')
                    }
                }
            )
        }
    </script>
    <!-- For Cart-->
    <script src="linkscript/main.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>