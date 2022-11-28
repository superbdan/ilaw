<link rel="shortcut icon" type="image/x-icon" href="images/Logo/ILAW_Logo2.png" />
<?php
define('ILAW', true);

include('database_connection.php');
include('connection.php');
if (empty($_SESSION['email'])) {
    $email = "";
} else {
    $email = $_SESSION['email'];
    $sql = "SELECT * FROM user_details WHERE user_email = '$email' ";
    $result = mysqli_query($con, $sql);
    $user = mysqli_fetch_assoc($result);
    $userid = $user['user_id'];
};


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ILAW</title>
    <!-- Owl Carousel (free version)-->
    <link rel="stylesheet" href="linkscript/bootstrap5.1.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="linkscript/owl.carousel.css" crossorigin="anonymous" />
    <script src="linkscript/jquery-1.12.4.min.js" crossorigin="anonymous"></script>
    <script src="linkscript/owl.carousel.min.js" crossorigin="anonymous"></script>
    <!-- Custom CSS-->
    <link href="admin/assets/css/style_loader.css" rel="stylesheet" />
    <link href="css/owl_carousel.css" rel="stylesheet" />
    <link href="css/style_e-commerce.css" rel="stylesheet" />
    <link href="css/upload.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
</head>

<!--DONT DELETE THIS IMPORTNAT CSS-->
<style>
    .fab {
        margin-top: 12px;
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
    <section id="reviews" class="second_section">
        <div class="line_PFOS">
            <h1>Reviews</h1>
            <p>ILAW Lighting and Equipment Trading provides you a rating page in which you will see any customer's feedback to help your further decisions, and you can also give feedback if you are registered on the website.</p>
        </div>
    </section>
    <main class="product_main">
        <div class="mt-4 mb-4 pt-3 pb-3 border shadow">
            <div class="container ">
                <div class="card border shadow">
                    <div class="card-header border"><b>Reviews and Ratings</b></div>
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-sm-4 text-center">
                                <h1 class="text-warning mt-4 mb-1">
                                    <b><span id="average_rating">0.0</span> / 5</b>
                                </h1>
                                <div class="mb-3">
                                    <i class="fas fa-star star-light mr-1 main_star"></i>
                                    <i class="fas fa-star star-light mr-1 main_star"></i>
                                    <i class="fas fa-star star-light mr-1 main_star"></i>
                                    <i class="fas fa-star star-light mr-1 main_star"></i>
                                    <i class="fas fa-star star-light mr-1 main_star"></i>
                                </div>
                                <h3><span id="total_review">0</span> Reviews</h3>
                            </div>
                            <div class="col-sm-4">
                                <p>
                                <div class="progress-label-left"><b>5</b> <i class="fas fa-star text-warning"></i></div>

                                <div class="progress-label-right">(<span id="total_five_star_review">0</span>)</div>
                                <div class="progress">
                                    <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="five_star_progress"></div>
                                </div>
                                </p>
                                <p>
                                <div class="progress-label-left"><b>4</b> <i class="fas fa-star text-warning"></i></div>

                                <div class="progress-label-right">(<span id="total_four_star_review">0</span>)</div>
                                <div class="progress">
                                    <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="four_star_progress"></div>
                                </div>
                                </p>
                                <p>
                                <div class="progress-label-left"><b>3</b> <i class="fas fa-star text-warning"></i></div>

                                <div class="progress-label-right">(<span id="total_three_star_review">0</span>)</div>
                                <div class="progress">
                                    <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="three_star_progress"></div>
                                </div>
                                </p>
                                <p>
                                <div class="progress-label-left"><b>2</b> <i class="fas fa-star text-warning"></i></div>

                                <div class="progress-label-right">(<span id="total_two_star_review">0</span>)</div>
                                <div class="progress">
                                    <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="two_star_progress"></div>
                                </div>
                                </p>
                                <p>
                                <div class="progress-label-left"><b>1</b> <i class="fas fa-star text-warning"></i></div>

                                <div class="progress-label-right">(<span id="total_one_star_review">0</span>)</div>
                                <div class="progress">
                                    <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="one_star_progress"></div>
                                </div>
                                </p>
                            </div>
                            <?php
                            if (empty($_SESSION['email'])) {
                                echo '<div class="col-sm-4 text-center">
                                <button type="button" onclick="LAlert()" class="btn btn-primary mt-4">Write a Review</button>
                            </div>';
                            } else {
                                echo ' <div class="col-sm-4 text-center">
                                <button type="button" name="add_review" id="add_review" class="btn btn-primary mt-4">Write a Review</button>
                            </div>';
                            }

                            ?>
                            <div class="text-end">
                                <select name="sort" class="shadow" style="cursor:pointer" id="sort">
                                    <option value="recent">Most Recent</option>
                                    <option value="highrating">Highest Rating</option>
                                    <option value="lowrating">Lowest Rating</option>
                                </select>
                            </div>
                            <br>
                            <br>
                            <span><b>Page No:</b></span>
                            <div class="container">
                            <div class="mb-2">
                            <div class="card-header shadow-sm p-0" >
                                <div class="row">
                                    
                                    <div class="col-12">
                                    <ul class="store-pagination pt-3" id="ratingspageno"></ul>
                                    </div>
                                    
                                </div>
                        </div>
                        </div>
                        </div>
                             
                           <!-- Customer Reviews -->
                            <div id="show">
                                <div id="get_rating">
                                
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>

            <div id="review_modal" class="modal fade popups " role="dialog" style="overflow:scroll;">
                <div class="modal-dialog modal-lg" role="document">
                    <form enctype="multipart/form-data" action="" method="post" id="review_form">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title"><i class="fa fa-user-secret" id="icon" aria-hidden="true"></i> <b>Review Any Product and Shop Services</b></h5>
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
                                    <center><label id="name_id" name="user_name"><b>Name:</b> <?php echo $user['first_name'], " ", $user['middle_name'], " ", $user['last_name'] ?></label>
                                        <center><label id="name_an" name="user_name"><b>Anonymous User</label>
                                            <input type="text" style="display:none" name="user_name" id="user_name" value="<?php echo $user['first_name'], " ", $user['middle_name'], " ", $user['last_name'] ?>">
                                            <input type="text" style="display:none" name="user_id" id="user_id" value="<?php echo $user['user_id'] ?>">
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
                                        <center>
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
                                    <input type="hidden" name="image" id="image" value="0" />
                                    <input type="submit" class="btn btn-primary" id="submit" name="submit" value="Submit">
                                </div>
                    </form>
                </div>
            </div>


        </div>




    </main>
    
    <script src="js/functions.js" type="text/javascript"></script>
    <script src="js/upload.js" type="text/javascript"></script>
    <!--Popper JS-->
    <script src="admin/assets/js/popper.min.js"></script>
    <!--Bootstrap-->
    <script src="admin/assets/js/bootstrap.min.js"></script>
    <?php
    include("footer/footer.php")
    ?>

    <script>
        $(document).ready(function() {

            var rating_data = 0;

            $('#add_review').click(function() {
                Swal.fire({
                    // icon: 'warning',
                    title: 'Do you want to review anonymously?',
                    imageUrl: 'admin/images/Logos/Anonymous.png',
                    imageWidth: 200,
                    imageHeight: 200,
                    showDenyButton: true,
                    denyButtonColor: '#87CEEB',
                    confirmButtonText: 'Yes',
                    denyButtonText: 'Use own Account'
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        $('#review_modal').modal('show');
                        $("#review_form")[0].reset();
                        $('#user_name').val('Anonymous')
                        $('#user_id').val('Anonymous')
                        $('#name_id').hide();
                        $('#name_an').show();
                        $('#icon').show();

                        // $('#anonymous_review').modal('show');

                    } else if (result.isDenied) {
                        $('#review_modal').modal('show');
                        $("#review_form")[0].reset();

                        // $('#user_name').val('mouse')
                        // $('#user_id').val('mouse')
                        $('#name_id').show();
                        $('#name_an').hide();
                        $('#icon').hide();
                    }

                });



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



            load_rating_data();

            function load_rating_data() {
                var get = "getimages";
                $.ajax({
                    url: "submit_rating.php",
                    method: "POST",
                    data: {
                        action: 'load_data',
                        images: get
                    },
                    dataType: "JSON",
                    success: function(data) {
                        $('#average_rating').text(data.average_rating);
                        $('#total_review').text(data.total_review);

                        var count_star = 0;

                        $('.main_star').each(function() {
                            count_star++;
                            if (Math.ceil(data.average_rating) >= count_star) {
                                $(this).addClass('text-warning');
                                $(this).addClass('star-light');
                            }
                        });

                        $('#total_five_star_review').text(data.five_star_review);

                        $('#total_four_star_review').text(data.four_star_review);

                        $('#total_three_star_review').text(data.three_star_review);

                        $('#total_two_star_review').text(data.two_star_review);

                        $('#total_one_star_review').text(data.one_star_review);

                        $('#five_star_progress').css('width', (data.five_star_review / data.total_review) * 100 + '%');

                        $('#four_star_progress').css('width', (data.four_star_review / data.total_review) * 100 + '%');

                        $('#three_star_progress').css('width', (data.three_star_review / data.total_review) * 100 + '%');

                        $('#two_star_progress').css('width', (data.two_star_review / data.total_review) * 100 + '%');

                        $('#one_star_progress').css('width', (data.one_star_review / data.total_review) * 100 + '%');

                        if (data.review_data.length > 0) {
                            var html = '';

                            for (var count = 0; count < data.review_data.length; count++) {
                                
                            }

                            $('#review_content').html(html);
                        }
                    }
                })
            }
            $("#fileImg").on('change', function() {
                $('#image').val("1");
                if ($("#fileImg")[0].files.length > 3) {
                    Swal.fire('Maximum of 3 Images.', 'Image Upload is Maximum of 3', 'warning');
                    $("#fileImg").val('');
                    $('#image').val("0");
                } else if ($("#fileImg")[0].files.length = 0) {
                    $("#fileImg").val('');
                    $('#image').val("0");
                };
            });

            $("#sort").on('change', function() {
                var sort = $(this).val();
                $.ajax({
                    method: "POST",
                    url: "review_filter.php",
                    data: {
                        sort: sort
                    },
                    success: function(data) {
                        $("#show").html(data);

                    }

                });
            });
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
                        $("#review_form")[0].reset();
                        Swal.fire({
                            icon: 'success',
                            type: 'success',
                            title: 'Review',
                            text: 'Thank You for sending us your review',
                            showConfirmButton: false,
                            timer: 2000
                        })
                        // $("#show").load(location.href + " #show")
                        ratings();
                        page();


                    }
                });

            });


        });
        ratings();
        function ratings(){
		$.ajax({
			url	:	"action.php",
			method:	"POST",
			data	:	{getRatings:1},
			success	:	function(data){
				$("#get_rating").html(data);
			
			}
		})
	}
    page();
    function page(){
		$.ajax({
			url	:	"action.php",
			method	:	"POST",
			data	:	{ratingspage:1},
			success	:	function(data){
				$("#ratingspageno").html(data);
			}
		})
	}
	$("body").delegate("#ratingspage","click",function(){
		var pn = $(this).attr("ratingspage");
		$.ajax({
			url	:	"action.php",
			method	:	"POST",
			data	:	{getRatings:1,setPage:1,pageNumber:pn},
			success	:	function(data){
				$("#get_rating").html(data);
			}
		})
	})

        function openImg() {
            var image = document.getElementById('rev_img');
            var source = image.src;
            window.open(source);
        }

        function LAlert() {
            //alert ("Saved Successfully!");  
            swal({
                    title: "Review requires an Account",
                    text: 'You will be redirect to login form click "ok" to proceed',
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willLogin) => {
                    if (willLogin) {
                        window.location.href = "login.php";;
                    }
                });
        }
    </script>
    <!-- For Cart-->
    <script src="linkscript/main.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</body>

</html>
