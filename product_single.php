<?php
define('ILAW', true);

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
    <link rel="stylesheet" href="admin/assets/css/stylecopy.css">
    <link href="css/owl_carousel.css" rel="stylesheet" />
    <link href="css/style_e-commerce.css" rel="stylesheet" />


</head>
<!--Page loader-->
<div class="loader-wrapper overlay">
    <div class="loader-circle">
        <div class="loader"></div>
    </div>
</div>
<!--Page loader-->
<body onload="stockCheck();">

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
            <h1>Products</h1>
            <p> ILAW Lighting and Equipment Trading presents you the products with different model, specification, and detail price. View images below. </p>
        </div>
    </section>

    <?php
    $items_id = $_POST['product_single_id'];
    $query = "SELECT * FROM items
            INNER JOIN category ON category.category_id = items.category_id
            INNER JOIN measurement ON measurement.measurement_id = items.measurement_id
            WHERE items_id ='$items_id'";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();

    foreach ($result as $row) {
        $items_id = $row['items_id'];
        $items_category = $row['category_name'];
        $items_measurement = $row['measurement_name'];
        $items_descript = $row['item_descript'];
        $items_price = $row['items_price'];
        $items_name = $row['items_name'];
        $items_stocks = $row['items_stocks'];
        $items_price = $row['items_price'];
        $product_img1 = $row['product_img1'];
        $product_img2 = $row['product_img2'];
        $availability;
        if ($items_stocks <= 0) {
            $availability = "<span class='text-danger'><b>Out of Stock</b><span>";
            $addToCartbtn = "<a disabled data-toggle='tooltip' data-placement='bottom' title='Cannot be added'id='product' class='btn btn-xs text-white btn-danger'><i class='fa fa-shopping-cart'></i></a>";
        } else {
            $availability = "<span class='font-weight-bolder' style='color: #36bd0a'>In Stock</span>";
            $addToCartbtn = "<a pid='$items_id' data-toggle='tooltip' data-placement='bottom' title='Add to Cart'style='background-color:#F7941D;' id='product' class='btn btn-xs text-white'><i class='fa fa-shopping-cart'></i></a>";
        }
        echo '
                        <main class="product_main" id="prod_single">
                        <br>
                        <div class="mt-4 mb-4 p-3 bg-white border shadow-sm lh-sm container">
                        <!--Product detail-->
                        <div class="product-list">
                            <div class="row product">
                                <div class="col-sm-6 col-12 d-flex justify-content-center align-items-center">
                                <div class="slider-for border">
                                    <div class="product ">
                                    <div class="product-image">
                                        <a class="image">
                                            <img src="admin/product_images/' . $product_img1 . '" alt="product_single" width="100%" class="pic-1">
                                            <img src="admin/product_images/' . $product_img2 . '" alt="product_single"  width="100%" class="pic-2">
                                        </a>
                                    </div>
                                    </div>
                                </div>
                                    <div class="slider-nav bg-secondary shadow">
                                                    
                                                    </div>
                                                </div>
                                                
                                                <div class="col-sm-6 col-12">
                                                    <div class="p-2">
                                                        <div class="text-end h5">
                                                            <p class="small"><strong>Availability</strong>: ' . $availability . '
                                                        </div>
                                                        <h3 class="mb-3">' . $items_name . '</h3>
                                                        <p class="small"><strong>Category:</strong> ' . $items_category . '</p>
                                                        <p class="small"><strong>Unit of Measurement:</strong> ' . $items_measurement . '</p>
                                                        <h4>₱' . number_format($items_price, 2) . '</h4>
                                                        <hr>

                                                        <p class="product-slug">' . $items_descript . '</p>
                                                        <hr>

                                                        <center><div class="col-sm-6 col-6 pl-0 pr-4 mb-4 mt-4">
                                                        <p>Stocks: ' . $items_stocks . '</p>   
                                                        <input type="hidden" name="stocks" id="stocks" value="' . $items_stocks . '">
                                                        <input type="hidden" id="item_id_r" name="item_id_r" value="'.$items_id.'">
                                                        <div class="input-group mt-2">
                                                                <input id="qty" name="qty" type="number" onkeyup="myFunction()" size="3" class="form-control shadow-sm bg-light text-center mr-3 qty" value="1" min="1" maxlength="3">
                                                                &nbsp; &nbsp;
                                                           
                                                            <a pid="' . $items_id . '" data-toggle="tooltip" data-placement="bottom" title="Add to Cart" style="background-color:#F7941D;" id="product" class="btn btn-xs text-white"><i class="fa fa-shopping-cart"></i></a>

                                                            </div>
                                                        </div></center>
                                                    </div>

                                                </div>

                                            </div>

                                        </div>
            ';
    }

    ?>

    <!--Product Detail-->
    </div>
    <div class="container mt-4 mb-4 p-3 bg-white button-container  border shadow-sm">
        <div class="product-list custom-tabs">
            <nav>
                <div class="nav nav-tabs nav-fill" id="nav-customContent" role="tablist">
                    <a class="nav-item nav-link active" id="nav-home" data-toggle="tab" href="#custom-home" role="tab" aria-controls="nav-home" aria-selected="true"><strong> Product Reviews and Ratings</strong></a>
                </div>
            </nav>

            <div class="tab-content py-3 px-3 px-sm-0" id="nav-customContent">
                <div class="tab-pane fade show active p-3" id="custom-home" role="tabpanel" aria-labelledby="nav-home">
                <div id="get_reviews">
            <!--All Reviews Loops in the Action.php-->

                </div>
                </div>
                <!-- Loop this card for the Reviews-->
            </div>
            <!--/Feed tab-->

        </div>
        <div class="d-flex justify-content-end">
            <ul class="store-pagination" id="reviewspageno">

            </ul>
        </div>
    </div>
    </div>

    </div>
    </div>
    <br>

    <!--Main Content-->
    </main>

    <?php
    include("footer/footer.php")
    ?>
    <!-- For Cart-->
    <script src="linkscript/main.js"></script>
    <script src="js/jquery2.js"></script>
    <script src="js/functions.js" type="text/javascript"></script>
    <!-- Page JavaScript Files-->
    <script src="admin/assets/js/jquery.min.js"></script>
    <script src="admin/assets/js/jquery-1.12.4.min.js"></script>
    <!--Bootstrap-->
    <script src="admin/assets/js/bootstrap.min.js"></script>
    <!--Custom Js Script-->
    <script src="admin/assets/js/custom.js"></script>


    <script type="text/javascript">
        // document.getElementById("myFrame").onload = function() {myFunction()};

        	//reviews() is a funtion fetching product record from database whenever page is load
            let x = document.getElementById("item_id_r").value;
	reviews(x);
    function reviews(b){
		$.ajax({
			url	:	"action.php",
			method:	"POST",
			data	:	{getReviews:1,item_id:b},
			success	:	function(data){
				$("#get_reviews").html(data);
				reviews_page();
			}
		})
	}
    function reviews_page(){
      
		$.ajax({
			url	:	"action.php",
			method	:	"POST",
			data	:	{reviewspage:1,item_id:x},
			success	:	function(data){
				$("#reviewspageno").html(data);
			}
		})
	}
	$("body").delegate("#reviewspage","click",function(){
		var pn = $(this).attr("reviewspage");
        let x = document.getElementById("item_id_r").value;
		$.ajax({
			url	:	"action.php",
			method	:	"POST",
			data	:	{getReviews:1,setPage:1,pageNumber:pn,item_id:x},
			success	:	function(data){
				$("#get_reviews").html(data);
			}
		})
	})
    // reviews();
    // function reviews(){
	// 	$.ajax({
	// 		url	:	"action.php",
	// 		method:	"POST",
	// 		data	:	{getReviews:1,items_id_r:items_id_r},
	// 		success	:	function(data){
	// 			$("#get_reviews").html(data);
	// 			reviews_page();
	// 		}
	// 	})
	// }
    // reviews_page()
	// function reviews_page(){
	// 	$.ajax({
	// 		url	:	"action.php",
	// 		method	:	"POST",
	// 		data	:	{reviews_page:1},
	// 		success	:	function(data){
	// 			$("#reviewspageno").html(data);
	// 		}
	// 	})
	// }
	// $("body").delegate("#reviewspage","click",function(){
	// 	var pn = $(this).attr("reviewspage");
	// 	$.ajax({
	// 		url	:	"action.php",
	// 		method	:	"POST",
	// 		data	:	{getReviews:1,setPage:1,pageNumber:pn},
	// 		success	:	function(data){
	// 			$("#get_reviews").html(data);
	// 		}
	// 	})
	// })



        $("body").delegate("#qty", "onkeydown", function(event) {
            let stocks = document.getElementById("stocks").value;
            let qty = document.getElementById("qty").value;
            if (qty > stocks) {
                document.getElementById("product").style.backgroundColor = "red";
                document.getElementById("product")[0].disabled = true;

            }
        })

        function myFunction() {
            let stocks = parseInt(document.getElementById("stocks").value);
            let qty = parseInt(document.getElementById("qty").value);
            if (qty > stocks) {

                document.getElementById("qty").value = '';
            }
        }

        function stockCheck() {
            let stocks = document.getElementById("stocks").value;
            if (stocks <= 0) {
                document.getElementById("product").disabled = true;
            }
        }


        $("body").delegate("#product", "click", function(event) {
            var pid = $(this).attr("pid");
            let qty = document.getElementById("qty").value;
            event.preventDefault();
            $(".overlay").show();
            $.ajax({
                url: "action.php",
                method: "POST",
                data: {
                    addToCartSingle: 1,
                    proId: pid,
                    num: qty
                },
                success: function(data) {
                    count_item();
                    getCartItem();
                    $('#product_msg').html(data);
                    $('.overlay').hide();
                }
            })
        })
    </script>
</body>

</html>