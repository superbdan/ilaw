<?php
include('../connection.php');
//For Price Low To High
if (($_POST['rate']) == "5") {

	$query = "select items_id,item_descript, items_name,items_price,items_stocks,product_img1,product_img2, rating from (SELECT items_id,item_descript,user_rating, items_name,items_price,items_stocks,product_img1,product_img2,  AVG(user_rating) as rating
	FROM items
	INNER JOIN product_review ON items.items_id = product_review.product_id
	group by items_name) t where rating = 5.00
	";

	$r = mysqli_query($con, $query);
	$count = mysqli_num_rows($r);
	if ($count == 0) {
		echo '<center><div class="container shadow border mt-2 pt-3 store-filter clearfix" style="background: #fff">
		<img src="images/Icons/No_Search.png" width="100px" alt="No Search Icon">
			<p>Oops! No Products Found.</p>
			<p></p>
	  		</div></center>';
	} else {

		while ($row = mysqli_fetch_assoc($r)) {
			$items_id    = $row['items_id'];
			$item_descript = $row['item_descript'];
			$items_name = $row['items_name'];
			$items_price = $row['items_price'];
			$items_stocks = $row['items_stocks'];
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
						<div class='col-12 h6 pt-1'><strong>5/5 Rating <span class='fa fa-star checked'></span>
						<span class='fa fa-star checked'></span>
						<span class='fa fa-star checked'></span>
						<span class='fa fa-star checked'></span>
						<span class='fa fa-star checked'></span></span></strong></div>
						<div class='col-12 h6 pt-1'><strong>₱$items_price.00 &nbsp;" . $availability . "</span></strong></div>
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
}
if (($_POST['rate']) == "4") {

	$query = "select items_id,item_descript, items_name,items_price,items_stocks,product_img1,product_img2, rating from (SELECT items_id,item_descript,user_rating, items_name,items_price,items_stocks,product_img1,product_img2,  AVG(user_rating) as rating
	FROM items
	INNER JOIN product_review ON items.items_id = product_review.product_id
	group by items_name) t where rating BETWEEN 4.00 and 4.99
	";

	$r = mysqli_query($con, $query);
	$count = mysqli_num_rows($r);
	if ($count == 0) {
		echo '<center><div class="container shadow border mt-2 pt-3 store-filter clearfix" style="background: #fff">
		<img src="images/Icons/No_Search.png" width="100px" alt="No Search Icon">
			<p>Oops! No Products Found.</p>
			<p></p>
	  		</div></center>';
	} else {
		while ($row = mysqli_fetch_assoc($r)) {
			$items_id    = $row['items_id'];
			$item_descript = $row['item_descript'];
			$items_name = $row['items_name'];
			$items_price = $row['items_price'];
			$items_stocks = $row['items_stocks'];
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
						<div class='col-12 h6 pt-1'><strong>4/5 Rating <span class='fa fa-star checked'></span>
						<span class='fa fa-star checked'></span>
						<span class='fa fa-star checked'></span>
						<span class='fa fa-star checked'></span>
						<span class='fa fa-star'></span></strong></div>
						<input type='hidden' name='stocks' id='stocks' value='.$items_stocks.'>
						<div class='col-12 h6 pt-1'><strong>₱$items_price.00 &nbsp;" . $availability . "</span></strong></div>
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
}
if (($_POST['rate']) == "3") {

	$query = "select items_id,item_descript, items_name,items_price,items_stocks,product_img1,product_img2, rating from (SELECT items_id,item_descript,user_rating, items_name,items_price,items_stocks,product_img1,product_img2,  AVG(user_rating) as rating
	FROM items
	INNER JOIN product_review ON items.items_id = product_review.product_id
	group by items_name) t where rating BETWEEN 3.00 and 3.99
	";

	$r = mysqli_query($con, $query);
	$count = mysqli_num_rows($r);
	if ($count == 0) {
		echo '<center><div class="container shadow border mt-2 pt-3 store-filter clearfix" style="background: #fff">
		<img src="images/Icons/No_Search.png" width="100px" alt="No Search Icon">
			<p>Oops! No Products Found.</p>
			<p></p>
	  		</div></center>';
	} else {
		while ($row = mysqli_fetch_assoc($r)) {
			$items_id    = $row['items_id'];
			$item_descript = $row['item_descript'];
			$items_name = $row['items_name'];
			$items_price = $row['items_price'];
			$items_stocks = $row['items_stocks'];
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
						<div class='col-12 h6 pt-1'><strong>3/5 Rating <span class='fa fa-star checked'></span>
						<span class='fa fa-star checked'></span>
						<span class='fa fa-star checked'></span>
						<span class='fa fa-star'></span>
						<span class='fa fa-star'></span></strong></div>
						<input type='hidden' name='stocks' id='stocks' value='.$items_stocks.'>
						<div class='col-12 h6 pt-1'><strong>₱$items_price.00 &nbsp;" . $availability . "</span></strong></div>
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
}
if (($_POST['rate']) == "2") {

	$query = "select items_id,item_descript, items_name,items_price,items_stocks,product_img1,product_img2, rating from (SELECT items_id,item_descript,user_rating, items_name,items_price,items_stocks,product_img1,product_img2,  AVG(user_rating) as rating
	FROM items
	INNER JOIN product_review ON items.items_id = product_review.product_id
	group by items_name) t where rating BETWEEN 2.00 and 2.99
	";

	$r = mysqli_query($con, $query);
	$count = mysqli_num_rows($r);
	if ($count == 0) {
		echo '<center><div class="container shadow border mt-2 pt-3 store-filter clearfix" style="background: #fff">
		<img src="images/Icons/No_Search.png" width="100px" alt="No Search Icon">
			<p>Oops! No Products Found.</p>
			<p></p>
	  		</div></center>';
	} else {

		while ($row = mysqli_fetch_assoc($r)) {
			$items_id    = $row['items_id'];
			$item_descript = $row['item_descript'];
			$items_name = $row['items_name'];
			$items_price = $row['items_price'];
			$items_stocks = $row['items_stocks'];
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
						<div class='col-12 h6 pt-1'><strong>2/5 Rating <span class='fa fa-star checked'></span>
						<span class='fa fa-star checked'></span>
						<span class='fa fa-star'></span>
						<span class='fa fa-star'></span>
						<span class='fa fa-star'></span></strong></div>
						<input type='hidden' name='stocks' id='stocks' value='.$items_stocks.'>
						<div class='col-12 h6 pt-1'><strong>₱$items_price.00 &nbsp;" . $availability . "</span></strong></div>
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
}
if (($_POST['rate']) == "1") {

	$query = "select items_id,item_descript, items_name,items_price,items_stocks,product_img1,product_img2, rating from (SELECT items_id,item_descript,user_rating, items_name,items_price,items_stocks,product_img1,product_img2,  AVG(user_rating) as rating
	FROM items
	INNER JOIN product_review ON items.items_id = product_review.product_id
	group by items_name) t where rating BETWEEN 1.00 and 1.99
	";

	$r = mysqli_query($con, $query);
	$count = mysqli_num_rows($r);
	if ($count == 0) {
		echo '<center><div class="container shadow border mt-2 pt-3 store-filter clearfix" style="background: #fff">
		<img src="images/Icons/No_Search.png" width="100px" alt="No Search Icon">
			<p>Oops! No Products Found.</p>
			<p></p>
	  		</div></center>';
	} else {

		while ($row = mysqli_fetch_assoc($r)) {
			$items_id    = $row['items_id'];
			$item_descript = $row['item_descript'];
			$items_name = $row['items_name'];
			$items_price = $row['items_price'];
			$items_stocks = $row['items_stocks'];
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
						<div class='col-12 h6 pt-1'><strong>1/5 Rating <span class='fa fa-star checked'></span>
						<span class='fa fa-star'></span>
						<span class='fa fa-star'></span>
						<span class='fa fa-star'></span>
						<span class='fa fa-star'></span></strong></div>
						<div class='col-12 h6 pt-1'><strong>₱$items_price.00 &nbsp;" . $availability . "</span></strong></div>
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
}
