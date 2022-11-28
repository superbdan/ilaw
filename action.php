<?php
$ip_add = $_SERVER['REMOTE_ADDR'];
include('database_connection.php');
include('connection.php');
include('courier_amount.php');
if(isset($_POST["category"])){
	/*$category_query = "SELECT * FROM category";
	$run_query = mysqli_query($con,$category_query) or die(mysqli_error($con));
	echo "
		<div class='nav nav-pills nav-stacked'>
			<li class='active'><a href='#'><h4>Categories</h4></a></li>
	";
	if(mysqli_num_rows($run_query) > 0){
		while($row = mysqli_fetch_array($run_query)){
			$cid = $row["category_id"];
			$cat_name = $row["category_name"];
			echo "
					<li><a href='#' class='category' cid='$cid'>$cat_name</a></li>
			";
		}
		echo "</div>";
	}*/

	$query = "SELECT * FROM category";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	echo "
		<div class='nav nav-pills nav-stacked'>
			<li class='active'><a href='#'><h4>Categories</h4></a></li>
	";
	foreach($result as $row)
		{
			$cid = $row["category_id"];
			$cat_name = $row["category_name"];
			echo "
					<li><a href='#' class='category' cid='$cid'>$cat_name</a></li>
			";
		}
		echo "</div>";
	
	
}
if(isset($_POST["brand"])){
	/*$brand_query = "SELECT * FROM suppliers";
	$run_query = mysqli_query($con,$brand_query);
	echo "
		<div class='nav nav-pills nav-stacked'>
			<li class='active'><a href='#'><h4>Brands</h4></a></li>
	";
	if(mysqli_num_rows($run_query) > 0){
		while($row = mysqli_fetch_array($run_query)){
			$bid = $row["supplier_id"];
			$brand_name = $row["supplier_name"];
			echo "
					<li><a href='#' class='selectBrand' bid='$bid'>$brand_name</a></li>
			";
		}
		echo "</div>";
	}*/

	$query = "SELECT * FROM suppliers";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	echo "
		<div class='nav nav-pills nav-stacked'>
			<li class='active'><a href='#'><h4>Brands</h4></a></li>
	";
	foreach($result as $row)
	{
		$bid = $row["supplier_id"];
		$brand_name = $row["supplier_name"];
		echo "
				<li><a href='#' class='selectBrand' bid='$bid'>$brand_name</a></li>
		";
	}
	echo "</div>";
}
$category="";
$limit = 12;
if(isset($_POST["page"])){
	if(isset($_POST["pid"])){
		$category = $_POST['pid'];
		$sql = "SELECT * FROM `items` WHERE category_id = $category";
	}else{
		$sql = "SELECT * FROM items";
	}
	$run_query = mysqli_query($con,$sql);
	$count = mysqli_num_rows($run_query);
	$pageno = ceil($count/$limit);
	for($i=1;$i<=$pageno;$i++){
		echo "
			<li><a href='#product-row' page='$i' id='page' class='active'>$i</a></li>
			<input type='hidden' class='pid' id='pid' pid='$category' name='pid' value='".$category."'>
		";
	}
}
if(isset($_POST["getProduct"])){
	
	if(isset($_POST["setPage"])){
		$pageno = $_POST["pageNumber"];
		$start = ($pageno * $limit) - $limit;
	}else{
		$start = 0;
	}

	if(isset($_POST["pid"]) && $_POST["pid"] !='' ){
		$category = $_POST['pid'];
		$query = "SELECT * FROM `items` WHERE category_id = $category LIMIT $start,$limit";
	}else{
		$query = "SELECT * FROM `items` LIMIT $start,$limit";
	}



	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		$items_id    = $row['items_id'];
		$item_descript = $row['item_descript'];
			$items_name = $row['items_name'];
			$items_price = $row['items_price'];
			$items_stocks = $row['items_stocks'];
			$product_img1 = $row['product_img1'];
			$product_img2 = $row['product_img2'];
	
			$availability;
			if ($items_stocks <= 0){
				$availability = "<span class='text-danger'><b>Out of Stock</b><span>";
				$addToCartbtn = "<a disabled data-toggle='tooltip' data-placement='bottom' title='Cannot be added'id='product' class='btn btn-xs text-white btn-danger'><i class='fa fa-shopping-cart'></i></a>";
			} else {
				$availability = "<span class='font-weight-bolder' style='color: #36bd0a'>In Stock</span>";
				$addToCartbtn = "<a pid='$items_id' data-toggle='tooltip' data-placement='bottom' title='Add to Cart'style='background-color:#F7941D;' id='product' class='btn btn-xs text-white'><i class='fa fa-shopping-cart'></i></a>";
			}
			echo "
			<form action='product_single.php' method='post' id='prod_single_form'>
			<input type='hidden' id='product_single_id' name='product_single_id' value='$items_id'>
			<li class='myItem shadow border'>
				<div class=' p-2 product' >
					<div class='row product-image'>
							<img class='pic-1' alt='product_image' src='admin/product_images/$product_img1' style='width: 260px; padding:10px'/>
								<img class='pic-2' alt='product_image' src='admin/product_images/$product_img2' style='width: 260px; padding:10px'/>
					<div class='col p-2'>
						<div class='row'>
  							<div class='col-12 h5 text-primary item-name'><strong>$items_name</strong></div>
							  <p class='item-description'>
							 $item_descript
							</p>
							<input type='hidden' name='stocks' id='stocks' value='.$items_stocks.'>
							<div class='col-12 h6 pt-1'><strong>₱".number_format($items_price,2)." &nbsp;".$availability."</span></strong></div>
						</div>
						<footer>
							<button type='submit' name='submit' data-toggle='tooltip' data-placement='bottom' title='View Product' class='btn btn-primary btn-xs'><i class='fa fa-eye'></i></button>
							";


							echo $addToCartbtn;


							echo "	
						</footer>
					</div>
					</div>
				</div>
        	</li>
			</form>

			";
	}
	
}

$rlimit = 20;
if(isset($_POST["reviewspage"])){
	$items_id = $_POST["item_id"];
	$sql = "SELECT * FROM product_review WHERE product_id = $items_id";
	$run_query = mysqli_query($con,$sql);
	$count = mysqli_num_rows($run_query);
	$pageno = ceil($count/$rlimit);
	for($i=1;$i<=$pageno;$i++){
		echo "
			<li><a href='#reviews-row' reviewspage='$i' id='reviewspage' class='active'>$i</a></li>
		";
	}
}
if(isset($_POST["getReviews"])){

	$items_id = $_POST["item_id"];
	if(isset($_POST["setPage"])){
		$pageno = $_POST["pageNumber"];
		$start = ($pageno * $rlimit) - $rlimit;
	}else{
		$start = 0;
	}
	// $items_id = $_POST['product_single_id'];
	$sql = "SELECT user_details.profile, user_name, product_id, user_rating, title_review, user_review, review_img, datetime 
	FROM product_review 
	LEFT JOIN user_details ON user_details.user_id = product_review.user_id
	WHERE product_id = '$items_id'
	ORDER BY review_id DESC
	LIMIT $start,$rlimit";
	$result2 = mysqli_query($con, $sql);
	if (mysqli_num_rows($result2) == 0) {
		echo ' <center><img width="20%"src="images/Icons/rate.png" alt="No_Item">
	   <h1>No Reviews Yet</h1>
	   <p>Shop Now and Write a Review</p>
	   <a type="button" href="product.php#checkout" class="btn m-2 text-white" style="background: #F7941D">Go To Shopping
	   </a>
	   </br';
	} else {
		while ($row = mysqli_fetch_assoc($result2)) {
			$image = $row['review_img'];
			$encode = json_decode($image);
			$timeStamp = $row['datetime'];
			$timeStamp = date("l jS, F Y h:i:s A", strtotime($timeStamp));
			if ($row['user_rating'] == '5') {
				$rating = '<i class="fas fa-star text-warning mr-1"></i><i class="fas fa-star text-warning mr-1"></i><i class="fas fa-star text-warning mr-1"></i><i class="fas fa-star text-warning mr-1"></i><i class="fas fa-star text-warning mr-1"></i>';
			} elseif ($row['user_rating'] == '4') {
				$rating = '<i class="fas fa-star text-warning mr-1"></i><i class="fas fa-star text-warning mr-1"></i><i class="fas fa-star text-warning mr-1"></i><i class="fas fa-star text-warning mr-1"></i><i class="fas fa-star star-light mr-1"></i>';
			} elseif ($row['user_rating'] == '3') {
				$rating = '<i class="fas fa-star text-warning mr-1"></i><i class="fas fa-star text-warning mr-1"></i><i class="fas fa-star text-warning mr-1"></i><i class="fas fa-star star-light mr-1"></i><i class="fas fa-star star-light mr-1"></i>';
			} elseif ($row['user_rating'] == '2') {
				$rating = '<i class="fas fa-star text-warning mr-1"></i><i class="fas fa-star text-warning mr-1"></i><i class="fas fa-star star-light mr-1"></i><i class="fas fa-star star-light mr-1"></i><i class="fas fa-star star-light mr-1"></i>';
			} elseif ($row['user_rating'] == '1') {
				$rating = '<i class="fas fa-star text-warning mr-1"></i><i class="fas fa-star star-light mr-1"></i><i class="fas fa-star star-light mr-1"></i><i class="fas fa-star star-light mr-1"></i><i class="fas fa-star star-light mr-1"></i>';
			} elseif ($row['user_rating'] == '0') {
				$rating = '<i class="fas fa-star star-light mr-1"></i><i class="fas fa-star star-light mr-1"></i><i class="fas fa-star star-light mr-1"></i><i class="fas fa-star star-light mr-1"></i><i class="fas fa-star star-light mr-1"></i>';
			};
			// if (isset($row['profile']) == "") {
			//     $profile = 'Anonymous.png';
			// } else {
			//     $profile = $row['profile'];
			// };


			echo '<div class="d-flex">
	   <div class="col-12">
		   <div class="card">
			   <div class="card-header"><img class="img-account-profile rounded-circle border shadow " style="vertical-align: middle; width: 45px; height: 45px;border-radius: 50%;" src="images/user-img/' . $row['profile'] . '" alt="user_Profile" />&nbsp;&nbsp;<b>' . $row['user_name'] . '&nbsp;</b><span class="text-success" style="font-size: 12px;"><i class="fa fa-check-circle" aria-hidden="true"></i><i><b>Verified Customer</b></i></span></div>
			   <div class="card-body">
				   '. $rating .'
				   <div><b>' . $row['title_review'] . '</b></div>
				   ' . $row['user_review'] . '
				   <div>';
			for ($i = 0; $i < count($encode); $i++) {

				echo '<img onclick="window.open(this.src)" alt="product_image" src="images/review-upload/' . $encode[$i] . '" style="height: auto; width: 10%; cursor: pointer;" />&nbsp;';
			}

			echo  '
				   </div>
			   </div>
			   <div class="card-footer text-right" style="font-size: 12px;"><b>On ' . $timeStamp . ' </b></div>
		   </div>
	   </div>
   </div> ';
		}
	}
}
$ratinglimit = 20;
if(isset($_POST["ratingspage"])){
	$sql = "SELECT * FROM review_table";
	$run_query = mysqli_query($con,$sql);
	$count = mysqli_num_rows($run_query);
	$pageno = ceil($count/$ratinglimit);
	for($i=1;$i<=$pageno;$i++){
		echo "
			<li><a href='#ratings-row' ratingspage='$i' id='ratingspage' class='active'>$i</a></li>
		";
	}
}
if(isset($_POST["getRatings"])){
	
	if(isset($_POST["setPage"])){
		$pageno = $_POST["pageNumber"];
		$start = ($pageno * $ratinglimit) - $ratinglimit;
	}else{
		$start = 0;
	}
	
	$sql = "SELECT user_details.profile, user_name, user_rating, title_review, user_review, review_img, datetime 
	FROM review_table  
	LEFT JOIN user_details ON user_details.user_id = review_table.user_id
	ORDER BY review_id DESC
	LIMIT $start,$ratinglimit";
   $result = mysqli_query($con, $sql);
   while ($row = mysqli_fetch_assoc($result)) {
	   $image = $row['review_img'];
	   $encode = json_decode($image);
	   $timeStamp = $row['datetime'];
	   $timeStamp = date("l jS, F Y h:i:s A", strtotime($timeStamp));
	   if ($row['user_rating'] == '5') {
		   $rating = '<i class="fas fa-star text-warning mr-1"></i><i class="fas fa-star text-warning mr-1"></i><i class="fas fa-star text-warning mr-1"></i><i class="fas fa-star text-warning mr-1"></i><i class="fas fa-star text-warning mr-1"></i>';
	   } elseif ($row['user_rating'] == '4') {
		   $rating = '<i class="fas fa-star text-warning mr-1"></i><i class="fas fa-star text-warning mr-1"></i><i class="fas fa-star text-warning mr-1"></i><i class="fas fa-star text-warning mr-1"></i><i class="fas fa-star star-light mr-1"></i>';
	   } elseif ($row['user_rating'] == '3') {
		   $rating = '<i class="fas fa-star text-warning mr-1"></i><i class="fas fa-star text-warning mr-1"></i><i class="fas fa-star text-warning mr-1"></i><i class="fas fa-star star-light mr-1"></i><i class="fas fa-star star-light mr-1"></i>';
	   } elseif ($row['user_rating'] == '2') {
		   $rating = '<i class="fas fa-star text-warning mr-1"></i><i class="fas fa-star text-warning mr-1"></i><i class="fas fa-star star-light mr-1"></i><i class="fas fa-star star-light mr-1"></i><i class="fas fa-star star-light mr-1"></i>';
	   } elseif ($row['user_rating'] == '1') {
		   $rating = '<i class="fas fa-star text-warning mr-1"></i><i class="fas fa-star star-light mr-1"></i><i class="fas fa-star star-light mr-1"></i><i class="fas fa-star star-light mr-1"></i><i class="fas fa-star star-light mr-1"></i>';
	   } elseif ($row['user_rating'] == '0') {
		   $rating = '<i class="fas fa-star star-light mr-1"></i><i class="fas fa-star star-light mr-1"></i><i class="fas fa-star star-light mr-1"></i><i class="fas fa-star star-light mr-1"></i><i class="fas fa-star star-light mr-1"></i>';
	   };
	   if (isset($row['profile']) == "") {
		   $profile = 'Anonymous.png';
	   } else {
		   $profile = $row['profile'];
	   }
   
echo '
	   <div class="d-flex mb-3">
		   <div class="col-12">
			   <div class="card">
				   <div class="card-header"><img class="img-account-profile rounded-circle border shadow " style="vertical-align: middle; width: 45px; height: 45px;border-radius: 50%;" src="images/user-img/'.$profile.'" alt="user_Profile" />&nbsp;&nbsp;<b>
				   ';
				   echo $row["user_name"].'
			';
				   if (isset($row["profile"]) == "") {
					  
				   } else {
					echo ' </b><span class="text-success" style="font-size: 12px;"><i class="fa fa-check-circle" aria-hidden="true"></i><i><b>Verified Customer</b></i></span>';
				   }
				echo'
				   </div>
				   <div class="card-body">
					';
					  echo $rating;
					   echo '<br>
					   <div><b>';
					   echo $row["title_review"],'</b></div>';
					    echo $row["user_review"],
					   '<div>';
							   for ($i = 0; $i < count($encode); $i++) {

								  echo '<img onclick="window.open(this.src)" alt="product_image" src="images/review-upload/' . $encode[$i] . '" style="height: auto; width: 10%; cursor: pointer;" />&nbsp;';
							   }
			echo'
							   
					   </div>
				   </div>
				   <div class="card-footer text-right" style="font-size: 12px;"><b>On'; echo $timeStamp,'
				    </b></div>
			   </div>
		   </div>
	   </div>
	   ';
	}
}
if(isset($_POST["get_seleted_Category"]) || isset($_POST["selectBrand"]) || isset($_POST["search"])){
	/*if(isset($_POST["get_seleted_Category"])){
		$id = $_POST["cat_id"];
		$sql = "SELECT * FROM items WHERE category_id = '$id'";
	}else if(isset($_POST["selectBrand"])){
		$id = $_POST["brand_id"];
		$sql = "SELECT * FROM items WHERE supplier_id = '$id'";
	}else {
		$keyword = $_POST["keyword"];
		$sql = "SELECT * FROM items WHERE items_name LIKE '%$keyword%'";
	}
	
	$run_query = mysqli_query($con,$sql);
	while($row=mysqli_fetch_array($run_query)){
        $items_id    = $row['items_id'];
        $items_name = $row['items_name'];
        $items_price = $row['items_price'];
        $product_img1 = $row['product_img1'];
			echo "
				<div class='col-md-4'>
							<div class='panel panel-info'>
								<div class='panel-heading'>$items_id</div>
								<div class='panel-body'>
									<img src='product_images/$product_img1' style='width:160px; height:250px;'/>
								</div>
								<div class='panel-heading'>$.$items_price.00
									<button pid='$items_id' style='float:right;' id='product' class='btn btn-danger btn-xs'>AddToCart</button>
								</div>
							</div>
						</div>	
			";
		}
	}*/
	if(isset($_POST["get_seleted_Category"])){
		$id = $_POST["cat_id"];
		$query = "SELECT * FROM items WHERE category_id = '$id'";
	}else if(isset($_POST["selectBrand"])){
		$id = $_POST["brand_id"];
		$query = "SELECT * FROM items WHERE supplier_id = '$id'";
	}else {
		$keyword = $_POST["keyword"];
		$query = "SELECT * FROM items WHERE items_name LIKE '%$keyword%'";
	}
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row){
        $items_id    = $row['items_id'];
        $items_name = $row['items_name'];
        $items_price = $row['items_price'];
        $product_img1 = $row['product_img1'];
			echo "
				<div class='col-md-4'>
							<div class='panel panel-info'>
								<div class='panel-heading'>$items_id</div>
								<div class='panel-body'>
									<img src='admin/product_images/$product_img1' style='width:160px; height:250px;'/>
								</div>
								<div class='panel-heading'>$.$items_price.00
									<button pid='$items_id' style='float:right;' id='product' class='btn btn-danger btn-xs'>AddToCart</button>
								</div>
							</div>
						</div>	
			";
		}
	}
	//Add to Cart feature
	if(isset($_POST["addToCart"])){
		$p_id = $_POST["proId"];
		if(isset($_SESSION["uid"])){
		$user_id = $_SESSION["uid"];
		$query = "SELECT * FROM cart WHERE p_id = '$p_id' AND user_id = '$user_id'";
		$res = $connect->query($query);
			$count = $res->fetchColumn();
			if($count > 0){
			echo "
				<div class='alert alert-warning'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<b>Product is already added into the cart Continue Shopping..!</b>
				</div>
			";//not in video
			}else{
			$query = "INSERT INTO cart(p_id, ip_add, user_id, qty)VALUES(:p_id, :ip_add, :user_id, '1')";
			$statement = $connect->prepare($query);
			$statement->execute(
				array(
					':p_id' => $p_id,
					':ip_add' => $ip_add,
					':user_id' => $user_id,
				)
			);
			$result = $statement->fetchAll();
			if(isset($result)){
				echo "
					<div class='alert alert-success'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<b>Product is Added..!</b>
					</div>
				";
			}
		}
		}else{
			if(isset($_POST["cartAdded"])){
header("location: https://ilawnatinto.store/login.php",  true,  301 );  exit;
}
// 			alert("Hello! I am an alert box!!");
// 			echo"<script>window.location.href='https://ilawnatinto.store/login.php'</script>";
			
// 			header("location: https://ilawnatinto.store/login.php",  true,  301 );  exit;
// 			echo "<script type='text/javascript'>window.top.location='https://ilawnatinto.store/login.php';</script>"; exit;
// 			$query = "SELECT id FROM cart WHERE ip_add = '$ip_add' AND p_id = '$p_id' AND user_id = -1";
// 			$res = $connect->query($query);
// 			$count = $res->fetchColumn();
// 			if($count > 0){
// 				echo "
// 					<div class='alert alert-warning'>
// 							<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
// 							<b>Product is already added into the cart Continue Shopping..!</b>
// 					</div>";
// 					exit();
// 			}
// 			$query = "INSERT INTO `cart`(`p_id`, `ip_add`, `user_id`, `qty`)VALUES ('$p_id','$ip_add','-1','1')";
// 			$statement = $connect->prepare($query);
// 			$statement->execute(
// 				array(
// 					':p_id' => $p_id,
// 					':ip_add' => $ip_add,
// 				)
// 			);
// 			$result = $statement->fetchAll();
// 			if(isset($result)){
// 				echo "
// 					<div class='alert alert-success'>
// 						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
// 						<b>Your product is Added Successfully..!</b>
// 					</div>
// 				";
// 				exit();
// 			}
		
		}
		
	}


//Add to Cart feature in Product Single
if(isset($_POST["addToCartSingle"])){
	$p_id = $_POST["proId"];
	$qty = $_POST["num"];
	if(isset($_SESSION["uid"])){
	$user_id = $_SESSION["uid"];
	$query = "SELECT * FROM cart WHERE p_id = '$p_id' AND user_id = '$user_id'";
	$res = $connect->query($query);
		$count = $res->fetchColumn();
		if($count > 0){
			$query = "UPDATE cart SET qty='$qty' WHERE p_id = '$p_id' AND user_id = '$_SESSION[uid]'";
			$statement = $connect->prepare($query);
			$statement->execute();
		}else{
		$query = "INSERT INTO cart(p_id, ip_add, user_id, qty)VALUES(:p_id, :ip_add, :user_id, :qty)";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':p_id' => $p_id,
				':ip_add' => $ip_add,
				':user_id' => $user_id,
				':qty' => $qty,
			)
		);
		$result = $statement->fetchAll();
		if(isset($result)){
			echo "
				<div class='alert alert-success'>
					<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
					<b>Product is Added..!</b>
				</div>
			";
		}
	}
	}else{
// 		$query = "SELECT id FROM cart WHERE ip_add = '$ip_add' AND p_id = '$p_id' AND user_id = -1";
// 		$res = $connect->query($query);
// 		$count = $res->fetchColumn();
// 		if($count > 0){
// 			echo "
// 				<div class='alert alert-warning'>
// 						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
// 						<b>Product is already added into the cart Continue Shopping..!</b>
// 				</div>";
// 				exit();
// 		}
// 		$query = "INSERT INTO `cart`(`p_id`, `ip_add`, `user_id`, `qty`)VALUES ('$p_id','$ip_add','-1','1')";
// 		$statement = $connect->prepare($query);
// 		$statement->execute(
// 			array(
// 				':p_id' => $p_id,
// 				':ip_add' => $ip_add,
// 			)
// 		);
// 		$result = $statement->fetchAll();
// 		if(isset($result)){
// 			echo "
// 				<div class='alert alert-success'>
// 					<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
// 					<b>Your product is Added Successfully..!</b>
// 				</div>
// 			";
// 			exit();
// 		}
	
	}
	
}


//Count User cart item
if (isset($_POST["count_item"])) {
	//When user is logged in then we will count number of item in cart by using user session id
	if (isset($_SESSION["uid"])) {
		$query = "SELECT COUNT(*) AS count_item FROM cart WHERE user_id = '$_SESSION[uid]'";
	}else{
		//When user is not logged in then we will count number of item in cart by using users unique ip address
		$query = "SELECT COUNT(*) AS count_item FROM cart WHERE ip_add = '$ip_add' AND user_id < 0";
	}
	$statement = $connect->query($query);
	$num_rows = $statement->fetchColumn();
	echo $num_rows;
	exit();
}
//Get Cart Item From Database to Dropdown menu
if (isset($_POST["Common"])) {

	if (isset($_SESSION["uid"])) {
		//When user is logged in this query will execute
		$query = "SELECT a.items_id,a.items_name,a.items_price,a.product_img1,b.id,b.qty FROM items a,cart b WHERE a.items_id=b.p_id AND b.user_id='$_SESSION[uid]'";
	}else{
		//When user is not logged in this query will execute
		$query = "SELECT a.items_id,a.items_name,a.items_price,a.product_img1,b.id,b.qty FROM items a,cart b WHERE a.items_id=b.p_id AND b.ip_add='$ip_add' AND b.user_id < 0";
	}
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	if (isset($_POST["getCartItem"])) {
		//display cart item in dropdown menu
		if(! $result){
			echo '<center><img width="40%" src="images/Icons/No_Item.png" alt="No_Item">
			<h6>No Products Yet</h6></center>';
		}elseif(isset($result)) {
			$n=0;
			foreach($result as $row) {
				$n++;
				$items_id = $row["items_id"];
				$items_name = $row["items_name"];
				$items_price = $row["items_price"];
				$product_img1 = $row["product_img1"];
				$cart_item_id = $row["id"];
				$qty = $row["qty"];
				echo '
					<div class="row ">
						<div class="col mb-1"><img class="shadow" width="80px" src="admin/product_images/'.$product_img1.'" /></div>
						<div class="col-8 mt-3 text-truncate">'.$items_name.'<br>'.CURRENCY.''.number_format($items_price,2).'</div>
					</div>';
			}
		}
			?>
			<?php
			exit();
		
	}
	if (isset($_POST["checkOutDetails"])) {
		if(! $result){
			echo '
			<img src="images/Icons/No_Item.png" alt="No_Item">
			<h1>There are no items added.</h1>
			<p>You must first add items to your shopping cart before proceeding to checkout.<br>On our website, you can discover a wide variety of items with awesome features.</p>
			<a type="button" href="product.php#checkout" class="btn icon-round m-2 text-white" style="background: #F7941D">Go To Shopping
			</a>';
		}elseif(isset($result)) {
			//display user cart item with "Ready to checkout" button if user is not login
			echo "<form method='POST' action='login_form.php'>
					<div class='cart_header container row' style='display: flex;
						align-items: center;'>
						<div class='col-2'>
							<div class='align-middle'><strong>ACTION</strong></div>
						</div>
						<div class='col'>
							<div class='align-middle'><strong>PRODUCT IMAGES</strong></div>
						</div>
						<div class='col-md-3'>
							<div class='align-middle'><strong>PRODUCT NAME</strong></div>
						</div>
						<div class='col-sm-1'>
							<div class='align-middle'><strong>QUANTITY</strong></div>
						</div>
						<div class='col-md-2'>
							<div class='align-middle'><strong>PRICE</strong></div>
						</div>
						<div class='col-md-2'>
							<div class='align-middle'><strong>SUB TOTAL</strong></div>
						</div>
                 	</div>
			";
				$n=0;
				$x=0;
				foreach($result as $row){
					$n++;
					$x++;
					$items_id = $row["items_id"];
					$items_name = $row["items_name"];
					$items_price =$row["items_price"];
					$product_img1 = $row["product_img1"];
					$cart_item_id = $row["id"];
					$qty = $row["qty"];
					$total = $row["qty"] * $row["items_price"];
					$subtotal = $total;
					$query3 =  "SELECT * FROM `items` WHERE items_id = '$items_id'";
					$statement = $connect->prepare($query3);
					$statement->execute();
					$result = $statement->fetchAll();

					foreach($result as $row){
					$items_stocks = $row["items_stocks"];
					}
					echo 
					'
					<hr>
						<div class="container row" style="display: flex;
						align-items: center;">
								<div class="col-2">
									<div class="align-middle">
										<a remove_id="'.$items_id.'" class="btn btn-danger remove" data-toggle="tooltip" data-placement="bottom" title="Remove Product"><i class="fa fa-trash"></i></a>
										<a update_id="'.$items_id.'" class="btn btn-primary update" data-toggle="tooltip" data-placement="bottom" title="Update Product"><i class="fa fa-edit"></i></a>
									</div>
								</div>

								<input type="hidden" id="total_count" name="total_count" value="'.$x.'">
								<input type="hidden" name="items_id[]" value="'.$items_id.'"/>
								
								<input type="hidden" name="" value="'.$cart_item_id.'"/>
									<div class="col">
										<img class="img-responsive bg-white shadow" width="150px" src="admin/product_images/'.$product_img1.'">
									</div>
									<div class="col-md-3" id="items_name" name="items_name" value="'.$items_name.'">'.$items_name.'</div>
									<div class="col"><div id="items_stocks" name="items_stocks" value="'.$items_stocks.'">Stock: '.$items_stocks.'</div>
									<input type="number" min="1" class="form-control form-control-sm qty bg-white shadow" id="qty" name="qty" value="'.$qty.'" ></div>
									<div class="col-md-2"><input type="hidden" class="form-control price" id="items_price" name="items_price" value="'.$items_price.'" readonly="readonly">'.CURRENCY.''.number_format($items_price,2).'</div>
									<div class="col-md-2"><input type="hidden" class="form-control total" value="'.$items_price.'" readonly="readonly">'.CURRENCY.''.number_format($subtotal,2).'</div>
							</div>';
				}
				
				echo '<center>
				<hr>
				<div class="col-md-6">
				  <br>
				</div> <div class="text-left mt-1">
				<h3 class="mt-3"><b class="net_total"></b></h3>
				<p>Shipping Fee will be calculated at checkout.</p>
				</div>
				</form>
								
					';
				if (!isset($_SESSION["uid"])) {
					// echo '
					// <a type="button" href="product.php #products" class="btn btn-secondary icon-round mb-3">Update Cart</a>&nbsp;
                    // <a type="button" href="checkout.php #checkout" class="btn icon-round mb-3 text-white" style="background: #F7941D">Checkout
                    // </a>
					// 		</form>';
					
					echo '<a type="button" href="product.php#products" class="btn btn-secondary icon-round mb-3">Update Cart</a>&nbsp;
                    <a type="button" href="checkout.php#checkout" class="btn icon-round mb-3 text-white" style="background: #F7941D">Checkout
                    </a>
					</form>';

				}else if(isset($_SESSION["uid"])){
					//Paypal checkout form
				echo '
				
				<form action="checkout.php" method="POST">
					<input type="hidden" name="cmd" value="_cart">
					<input type="hidden" name="business" value="shoppingcart@puneeth.com">
					<input type="hidden" name="upload" value="1">';
					  
					
					$query = "SELECT a.items_id,a.items_name,a.items_price,a.product_img1,b.id,b.qty FROM items a,cart b WHERE a.items_id=b.p_id AND b.user_id='$_SESSION[uid]'";

					$statement = $connect->prepare($query);
					$statement->execute();
					$result = $statement->fetchAll();
					$n=0;
					$x=0;
						foreach($result as $row) {
							$x++;
							echo  	

								'<input type="hidden" name="total_count" value="'.$x.'">
								<input type="hidden" name="items_name'.$x.'" value="'.$row["items_name"].'">
								<input type="hidden" name="item_number_'.$x.'" value="'.$x.'">
								<input type="hidden" name="items_price'.$x.'" value="'.$row["items_price"].'">
								<input type="hidden" name="qty'.$x.'" value="'.$row["qty"].'">';
						}
					  
					echo   
						'<input type="hidden" name="return" value="http://localhost/myfiles/public_html/payment_success.php"/>
							<input type="hidden" name="notify_url" value="http://localhost/myfiles/public_html/payment_success.php">
							<input type="hidden" name="cancel_return" value="http://localhost/myfiles/public_html/cancel.php"/>
							<input type="hidden" name="currency_code" value="USD"/>
							<input type="hidden" name="custom" value="'.$_SESSION["uid"].'"/>
							
							<a type="button" href="product.php#products" class="btn btn-secondary icon-round">Update Cart</a>&nbsp;
							<input type="submit" id="submit" "name="login_user_with_product" name="submit" class="btn btn-primary" value="Checkout">
							<br>
							<br>
							</form>

							
						';
						
				}
			}
	}
}
if (isset($_POST["Regular"])) {

	if (isset($_SESSION["uid"])) {
		//When user is logged in this query will execute
		$query = "SELECT a.items_id,a.items_name,a.items_price,a.product_img1,b.id,b.qty FROM items a,cart b WHERE a.items_id=b.p_id AND b.user_id='$_SESSION[uid]'";
		$query1 = "SELECT * FROM user_details 
				   INNER JOIN table_province ON user_details.province = table_province.province_id
				   INNER JOIN table_municipality ON user_details.city = table_municipality.municipality_id
				   INNER JOIN table_region ON user_details.region = table_region.region_id WHERE user_id = '$_SESSION[uid]'";
	}else{
		//When user is not logged in this query will execute
		$query = "SELECT a.items_id,a.items_name,a.items_price,a.product_img1,b.id,b.qty FROM items a,cart b WHERE a.items_id=b.p_id AND b.ip_add='$ip_add' AND b.user_id < 0";
	}
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();

	$statement1 = $connect->prepare($query1);
	$statement1->execute();
	$result1 = $statement1->fetchAll();
	// print_r($result1);
	if (isset($_POST["getCartItem"])) {
		//display cart item in dropdown menu
		if(! $result){
			echo '<center><img width="40%" src="images/Icons/No_Item.png" alt="No_Item">
			<h6>No Products Yet</h6></center>';
		}elseif(isset($result)) {
			$n=0;
			foreach($result as $row) {
				$n++;
				$items_id = $row["items_id"];
				$items_name = $row["items_name"];
				$items_price = $row["items_price"];
				$product_img1 = $row["product_img1"];
				$cart_item_id = $row["id"];
				$qty = $row["qty"];
				echo '
					<div class="row ">
						<div class="col mb-1"><img class="shadow" width="80px" src="admin/product_images/'.$product_img1.'" /></div>
						<div class="col-8 mt-3 text-truncate">'.$items_name.'<br>'.CURRENCY.''.$items_price.'</div>
					</div>';
			}
		}
			?>
			<?php
			exit();
		
	}

	if (isset($_POST["userAddress"])) {
		$n=0;
		foreach($result1 as $row) {
		  $n++;
		  $first_name = $row["first_name"];
		  $last_name = $row["last_name"];
		  $user_contact = $row["user_contact"];
		  $home_address = $row["home_address"];
		  $city = $row["municipality_name"];
		  $province = $row["province_name"];
		  $region = $row["region_name"];
		//   $user_address = '$home_address + '' + $city';

		echo '<div class="p-4 border-top border-primary button-container shadow-sm blockquote pb-3 m-1" style="background: #f1f5f9;">
			<h6 class="text-primary"><i class="fas fa-map-marker-alt"></i><strong> Delivery Address</strong>
				<center>
						<div class="form-group row d-flex">
						<div class="col-sm-3 pt-3">
						<input type="text" readonly class="form-control form-control-sm center " style="text-align: center; resize: vertical; background: #f1f5f9; border: none" placeholder="Full Name" value="'.$first_name.' '.$last_name.'" />
						<span style="font-size: 12px"><strong>'.$user_contact.'</strong></span>
						</div>
						
						<div class="col-sm-5 pt-2">
						<textarea type="text" readonly class="form-control center" style=" text-align: center; resize: none; background: #f1f5f9; border: none" placeholder="Full Address">'.$home_address.', '.$city.', '.$province.', '.$region.'</textarea>
						</div>
						<div class="col-sm-2 pt-3">
						<span style="font-size: 12px"><strong>Default</strong></span>
						</div>
						<div class="col-sm-2 pt-2">
						<center><button type="button" name="deliver_add" id="delivery_add"
						data-toggle="modal" data-target="#deliveryModal" class="btn btn-outline-secondary">Change</button></center>
						</div>
					</div>
				</center>
					</div>';
	}
	}
if (isset($_POST["viewCart"])) {
	echo '    
      <div class="container col-sm-12 p-3 mt-4 mb-2 border shadow-sm text-start" style="background: #f1f5f9;">
      <h5 class="text-primary"><i class="fas fa-cubes"></i><strong> Product Preview</strong></h6>
          <div class="cart_header row text-center mt-3" style="display: flex; align-items: center;">
						<div class="col-2">
							<div class="align-middle"><strong>PRODUCT IMAGES</strong></div>
						</div>
						<div class="col-4">
							<div class="align-middle"><strong>PRODUCT NAME</strong></div>
						</div>
						<div class="col-2">
							<div class="align-middle"><strong>QUANTITY</strong></div>
						</div>
						<div class="col-2">
							<div class="align-middle"><strong>PRICE</strong></div>
						</div>
						<div class="col-2">
							<div class="align-middle"><strong>SUB TOTAL</strong></div>
						</div>
          </div>';
		$n=0;
		$total_price = 0;
		foreach($result as $row) {
		  $n++;
		  $items_id = $row["items_id"];
		  $items_name = $row["items_name"];
		  $items_price = $row["items_price"];
		  $product_img1 = $row["product_img1"];
		  $cart_item_id = $row["id"];
		  $qty = $row["qty"];
		  $subtotal = $row["qty"] * $row["items_price"];
		  $total = $subtotal + $subtotal;
		 
		  $total_price += $subtotal;
		  echo '
			<hr>
			<div class="row text-center" style="display: flex; align-items: center;">
				<div class="col">
					<img src="admin/product_images/'.$product_img1.'" width="60%" class="shadow"  alt="product">
				</div>
				<div class="col-4 text-truncate">'.$items_name.'</div>
				<div class="col-2">'.$qty.'</div>
				<div class="col-2 align-middle">'.CURRENCY.''.number_format($items_price,2).'</div>
				<div class="col-2 align-middle">'.CURRENCY.''.number_format($subtotal,2).'</div>
			</div>
		'  ;
		
	}
	  }
	  if (isset($_POST["paymentTotal"])) {

        // $query  = "SELECT * FROM couriers LIMIT 1";
        // $res    = mysqli_query($con, $query);
   
        // while ($row = mysqli_fetch_assoc($res)) {
        //   $fee = $row['courier_fee'];
        // }
	
		$n=0;
		$total_price = 0;
		foreach($result as $row) {

		  $n++;
		  $qty = $row["qty"];
		  $subtotal = $row["qty"] * $row["items_price"];
		  $total = $subtotal + $subtotal;
		  $total_price += $subtotal;
		// $total_payment = $total_price + $courier_price;
		  

		}
		echo '
		<div class="row">
		<div class="col align-middle text-end border p-2">Merchandise Subtotal:</div>
		<div class="col border p-2"><b class="net_total" id= "total_price" value="'.$total_price.'">'.CURRENCY.''.number_format($total_price,2).'</b></div>
		<div class="w-100"></div>
		<div class="col align-middle text-end border p-2">Shipping Fee:</div>
		<div class="col border p-2" id="courier_fee"></div>
		<div class="w-100"></div>
		<div class="col align-middle text-end border bg-dark text-white p-2">Total Payment:</div>
		<div class="col border bg-dark text-white p-2" id="total_payment"></div>

	  </div> 
	  </div>
	  ';
	  }

	}

//Remove Item From cart
if (isset($_POST["removeItemFromCart"])) {
	$remove_id = $_POST["rid"];
	if (isset($_SESSION["uid"])) {
		$query = "DELETE FROM cart WHERE p_id = '$remove_id' AND user_id = '$_SESSION[uid]'";
	}else{
		$query = "DELETE FROM cart WHERE p_id = '$remove_id' AND ip_add = '$ip_add'";
	}
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	if(isset($result)){
		echo "<div class='alert alert-danger'>			
						<b>Product is removed from cart</b>
				</div>";
		exit();
	}
}


//Update Item From cart
if (isset($_POST["updateCartItem"])) {
	$update_id = $_POST["update_id"];
	$qty = $_POST["qty"];
	$query3 =  "SELECT * FROM `items` WHERE items_id = '$update_id'";
	$statement = $connect->prepare($query3);
	$statement->execute();
	$result = $statement->fetchAll();

	foreach($result as $row){
	$items_stocks = $row["items_stocks"];
	}
	
	if (isset($_SESSION["uid"])) {
		if ($qty <= $items_stocks){
		$query = "UPDATE cart SET qty='$qty' WHERE p_id = '$update_id' AND user_id = '$_SESSION[uid]'";
		 } else {
			echo "<div class='alert alert-info'>
			<b>Quantity exceed!</b>
	</div>";
	exit();
		 }
	}else{
		if ($qty <= $items_stocks){
		$query = "UPDATE cart SET qty='$qty' WHERE p_id = '$update_id' AND ip_add = '$ip_add'";
		} else{
			echo "<div class='alert alert-info'>
			<b>Quantity exceed!</b>
	</div>";
	exit();
		}
	}
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	if(isset($result)){
		echo "<div class='alert alert-info'>
						<b>Product is updated</b>
				</div>";
		exit();
	}
}
?>
