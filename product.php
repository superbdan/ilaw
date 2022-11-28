<?php
define('ILAW', true);
require "database_connection.php";
include('connection.php');
include('function.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="UTF-8">

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
  <link href="css/listandgrid.css" rel="stylesheet" />
  <!-- For Filter Price CSS-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/themes/base/jquery-ui.min.css" integrity="sha512-ELV+xyi8IhEApPS/pSj66+Jiw+sOT1Mqkzlh8ExXihe4zfqbWkxPRi8wptXIO9g73FSlhmquFlUOuMSoXz5IRw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<!--Page loader-->
<div class="loader-wrapper overlay">
    <div class="loader-circle">
        <div class="loader"></div>
    </div>
</div>
<!--Page loader-->
<body onload="addDisable();">

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
  <section class="second_section" id="productnow">
    <div class="line_PFOS">
      <h1>Products</h1>
      <p> ILAW Lighting and Equipment Trading presents you the products with different model, specification, and detail price. View images below. </p>
    </div>
  </section>
  <main id="products" class="product_main">
    <div class="p-3">
      <hr>
      <div class="products_option">
        <div> View As:&nbsp;
          <button class="mybtn" data-toggle="tooltip" data-placement="bottom" title="List View" onclick="Button(0); List();"><i class="fas fa-th-list fa-lg" style="cursor: pointer;"></i></button>
          <button class="mybtn Active" data-toggle="tooltip" data-placement="bottom" title="Grid View" onclick="Button(1); Grid();"><i class="fas fa-th fa-lg" style="cursor: pointer;"></i></button>
        </div>

        <form action="" method="GET">
          <div class="shadow d-flex">
            <select name="sort" style="cursor:pointer" id="sort" class=" form-control">
              <option value="">--- Filter Products ---</option>
              <option value="bsell">Best Selling</option>
              <option value="asc">Price Low to High</option>
              <option value="desc">Price High to Low</option>
              <option value="alphaAz">Alphabetically A-Z</option>
              <option value="alphaZa">Alphabetically Z-A</option>
              <option value="oldNew">Date Old to New</option>
              <option value="newOld">Date New to Old</option>
            </select>
          </div>
          </center>
        </form>
      </div>
      <hr>
      <!-- Search Product Name -->
      <input class="form-control mb-3" id="search_text" type="text" placeholder="Search Product Name..">
      <!-- End of Search Product Name -->

      <div class="all_product">
        <div class="dropdown_product">
          <div class="option_container  shadow border bg-white">
            <ul class="sidebar-menu mt-4 mb-4">
              <li class="parent">
                <a onclick="toggle_menu('category')" style="cursor: pointer;"><i class="fa fa-angle-down "> </i>
                  <span> Product Categories </span>
                </a>
                <?php $sql = "SELECT * FROM category  WHERE category_status ='active' order by category_name";
                $result = $con->query($sql);
                while ($row = $result->fetch_assoc()) {
                  $category = $row['category_id'];
                  $sql2 = "select count(*) as total from items WHERE category_id = '$category'";
                  $rescount = mysqli_query($con, $sql2);
                  $count = mysqli_fetch_assoc($rescount);
                  $items = $count['total'];
                ?>
                  <ul>
                    <li class="child_product item" style="cursor:pointer;" id="product" value="<?= $row['category_name'] ?>"><i class="fa fa-angle-right item"></i> <?= $row['category_name'] ?> (<?= $items ?>)</a></li>
                    <input type="hidden" class="pid" value="<?= $row['category_id'] ?>">
                  </ul>
                <?php } ?>
              </li>
              <hr>
            </ul>

            <ul class="sidebar-menu mt-4 mb-4">
              <li class="parent">
                <a onclick="toggle_menu('stock');" style="cursor: pointer;"><i class="fa fa-angle-down "> </i>
                  <span> Availability </span>
                </a>
                <ul id="stock">
                  <li class="child"><input type="checkbox" class="form-check-input stock_check" value="instock" id="instock"> In Stocks</li>
                  <li class="child"><input type="checkbox" class="form-check-input stock_check" value="outstock" id="outstock"> Out of Stocks</li>

                </ul>
              </li>
              <hr>
            </ul>

            <ul class="sidebar-menu mt-4 mb-4">
              <li class="parent">
                <a onclick="toggle_menu('filter_price');" style="cursor: pointer;"><i class="fa fa-angle-down "> </i>
                  <span> Filter Price </span>
                </a>
                <ul id="filter_price">
                  <div class="price-range-block">

                    <br>
                    <div id="slider-range" class="price-filter-range" name="rangeInput"></div>

                    <div class="shadow-sm  d-flex" style="margin:30px auto">
                      <input type="number" min=0 max="9900" oninput="validity.valid||(value='0');" id="min_price" class="price-range-field form-control" value='0' />
                      <input type="number" min=0 max="10000" oninput="validity.valid||(value='10000');" id="max_price" class="price-range-field form-control" value='10000' />
                    </div>

                    <div id="searchResults" class="search-results-block"></div>
                  </div>


                </ul>
                <hr>

            </ul>
            <ul class="sidebar-menu mt-4 mb-4">
              <li class="parent">
                <a onclick="toggle_menu('review_ratings');" style="cursor: pointer;"><i class="fa fa-angle-down "> </i>
                  <span> Review Ratings </span>
                </a>
                <br>
                <ul id="review_ratings">
                  <li class="five_star rating" data-rating="5" style="cursor:pointer;"> <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                  </li>
                  <li class="four star rating" data-rating="4" style="cursor:pointer;"> <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star"></span>
                  </li>
                  <li class="three_star rating" data-rating="3" style="cursor:pointer;"> <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                  </li>
                  <li class="two star rating" data-rating="2" style="cursor:pointer;"> <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                  </li>
                  <li class="one star rating" data-rating="1" style="cursor:pointer;"> <span class="fa fa-star checked"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                  </li>
                </ul>
                <hr>
            </ul>
          </div>
        </div>
        <div>
          <div class="item_grid" id="get_product">
            <!--All Products Loops in the Action.php-->


          </div>

        </div>

      </div>
      <!--End of Main Content-->
      <!-- store bottom filter -->
      <div class="shadow border mt-2 pt-3" style="background: #fff; padding: 0px 15px 0px 15px">
        <?php
        function rowCount($connect, $query)
        {
          $statement = $connect->prepare($query);
          $statement->execute();
          return $statement->rowCount();
        }
        ?>

        <div class="d-flex justify-content-between">
          <a class="btn btn-default mb-3" href="product.php#products">Total: <b><?php echo rowCount($connect, "SELECT items_id FROM items ORDER BY items_id"); ?> Products</b></i></a>
          <div>
            <ul class="store-pagination" id="pageno">

            </ul>
          </div>
        </div>

      </div>
      <!-- /store bottom filter -->
  </main>
  <?php
  include("footer/footer.php")
  ?>

  <!-- For Cart-->
  <script src="linkscript/main.js"></script>
  <!-- For Product View-->
  <script src="js/functions.js" type="text/javascript"></script>
  <script src="js/listandgrid.js" type="text/javascript"></script>
  <!-- Page JavaScript Files-->
  <script src="admin/assets/js/jquery.min.js"></script>
  <script src="admin/assets/js/jquery-1.12.4.min.js"></script>
  <!--Bootstrap-->
  <script src="admin/assets/js/bootstrap.min.js"></script>
  <!--Custom Js Script-->
  <script src="admin/assets/js/custom.js"></script>
  <script src="js/filterprice.js" type="text/javascript"></script>

  <script type="text/javascript">
    function addDisable() {
      let stocks = document.getElementById("stocks").value;
      if (stocks <= 0) {
        document.getElementById("product").disabled = true;
      }
    }

    $(document).ready(function() {
      function filterProducts() {

        $("#get_product").html("<center><div class='container shadow border mt-2 pt-3 store-filter clearfix' style='background: #fff; color: #F7941D;'><h5><b>Loading...</b></h5></div></center>")

        var min_price = $("#min_price").val();
        var max_price = $("#max_price").val();
        //alert(min_price + max_price);

        $.ajax({
          url: "filterproducts/pricerange_fetch.php",
          type: "POST",
          data: {
            min_price: min_price,
            max_price: max_price
          },
          success: function(data) {
            $("#get_product").html(data);
          }
        });
      }
      $('#min_price, #max_price').on('keyup', function() {
        filterProducts();
      })

      $("#slider-range").slider({
        range: true,
        orientation: "horizontal",
        min: 0,
        max: 10000,
        values: [0, 10000],
        step: 100,

        slide: function(event, ui) {
          if (ui.values[0] == ui.values[1]) {
            return false;
          }

          $("#min_price").val(ui.values[0]);
          $("#max_price").val(ui.values[1]);
          filterProducts();
        }
      });
      $("#min_price").val($("#slider-range").slider("values", 0));
      $("#max_price").val($("#slider-range").slider("values", 1));
    });



    $("#sort").on('change', function() {
      var sort = $(this).val();
      $.ajax({
        method: "POST",
        url: "filterproducts/dropdownfilter_fetch.php",
        data: {
          sort: sort
        },
        success: function(data) {
          $("#get_product").html(data);

        }

      });
    })

    $('#search_text').keyup(function() {
      var search = $(this).val();

      $.ajax({
        url: "filterproducts/searchfilter.php",
        method: "POST",
        data: {
          search: search
        },
        success: function(data) {
          $('#get_product').html(data);
        }
      });

    });

    $(".stock_check").click(function() {
      var action = 'data';
      // var instock = $('#instock').val();
      // var outstock = $('#outstock').val();
      var instock = get_filter_text('instock');
      var outstock = get_filter_text('outstock');

      $.ajax({
        url: 'filterproducts/checkboxfilter_fetch.php',
        method: 'POST',
        data: {
          action: action,
          instock: instock,
          outstock: outstock
        },
        success: function(response) {
          $("#get_product").html(response);
        }
      });



    });


    function get_filter_text(text_id) {
      var filterData = [];
      $('#' + text_id + ':checked').each(function() {
        filterData.push($(this).val());
      });
      return filterData;
    }

    $(".rating").click(function() {
      var rate = $(this).data("rating");
      // alert(rate);

      $.ajax({
        url: 'filterproducts/product_rating_filter.php',
        method: 'post',
        cache: false,
        data: {
          rate: rate
        },
        success: function(response) {
          $("#get_product").html(response);
          // $("#total").load(location.href + " #total");
        }
      });



    });

//  $(".item").on('click', function() {
//       var $el = $(this).closest('ul');
//       var pid = $el.find(".pid").val();
//       // location.reload(true);
//       $.ajax({
//         url: 'filterproducts/category_fetch.php',
//         method: 'post',
//         cache: false,
//         data: {
//           pid: pid     
//         },
//         success: function(response) {
//           $("#get_product").html(response);
//           $.ajax({
//             url	:	"filterproducts/category_fetch.php",
//             method	:	"POST",
//             data	:	{page:1,pid:pid},
//             success	:	function(data){
//               $("#pageno").html(data);
//             }
// 		      })
//         }
//       });
//     });

    $(".item").on('click', function() {
      var $el = $(this).closest('ul');
      var pid = $el.find(".pid").val();
      // location.reload(true);
      $.ajax({
        url: 'action.php',
        method: 'post',
        cache: false,
        data: {
          pid: pid,
          pageid: pid,
          getProduct:1
        },
        success: function(data) {
          $("#get_product").html(data);
          page(pid);
        }
      });
    });

  
	function page(a){
		$.ajax({
			url	:	"action.php",
			method	:	"POST",
			data	:	{page:1,pid:a},
			success	:	function(data){
				$("#pageno").html(data);
			}
		})
	}
  // page();

	$("body").delegate("#page","click",function(){
		var pn = $(this).attr("page");
    var pid = $(this).attr("pid");
    var pid = $("#pid").val();
		$.ajax({
			url	:	"action.php",
			method	:	"POST",
			data	:	{getProduct:1,setPage:1,pageNumber:pn,pid:pid},
			success	:	function(data){
				$("#get_product").html(data);
			}
		})
	})


  //   page();
	// function page(){
	// 	$.ajax({
	// 		url	:	"action.php",
	// 		method	:	"POST",
	// 		data	:	{page:1},
	// 		success	:	function(data){
	// 			$("#pageno").html(data);
	// 		}
	// 	})
	// }
	// $("body").delegate("#page","click",function(){
	// 	var pn = $(this).attr("page");
  //   var $el = $(this).closest('ul');
  //     var pid = $el.find(".pid").val();
	// 	$.ajax({
	// 		url	:	"filterproducts/category_fetch.php",
	// 		method	:	"POST",
	// 		data	:	{setPage:1,pageNumber:pn,pid:pid},
	// 		success	:	function(data){
	// 			$("#get_product").html(data);
	// 		}
	// 	})
	// })






    // $(".item").on('click', function() {
    //   var $el = $(this).closest('ul');
    //   var pid = $el.find(".pid").val();

    //   // location.reload(true);
    //   $.ajax({
    //     url: 'filterproducts/category_fetch.php',
    //     method: 'post',
    //     cache: false,
    //     data: {
    //       pid: pid
    //     },
    //     success: function(response) {
    //       $("#get_product").html(response);
    //       // $("#total").load(location.href + " #total");
    //     }
    //   });
    // });
  </script>
  <script>
    // Basic example
    $(document).ready(function() {
      $('#get_product').DataTable({
        "pagingType": "simple" // "simple" option for 'Previous' and 'Next' buttons only
      });
      $('.dataTables_length').addClass('bs-select');
    });
  </script>

  <!-- Jquery for Filter Price -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js" integrity="sha512-57oZ/vW8ANMjR/KQ6Be9v/+/h6bq9/l3f0Oc7vn6qMqyhvPd1cvKBRWWpzu0QoneImqr2SkmO4MSqU+RpHom3Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>

</html>