<?php
include('../connection.php');
//For Price Low To High
if (($_POST['sort']) == "asc") {

    $query = "SELECT * FROM items ORDER BY items_price ASC";

    $r = mysqli_query($con, $query);
    $count = mysqli_num_rows($r);

    while ($row = mysqli_fetch_assoc($r)) {
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
						<div class='col-12 h6 pt-1'><strong>₱$items_price.00 &nbsp;".$availability."</span></strong></div>
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

//For Price High To Low
if (($_POST['sort']) == 'desc') {

    $query = "SELECT * FROM items ORDER BY items_price DESC";

    $r = mysqli_query($con, $query);
    $count = mysqli_num_rows($r);
    while ($row = mysqli_fetch_assoc($r)) {
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
							<div class='col-12 h6 pt-1'><strong>₱$items_price.00 &nbsp;".$availability."</span></strong></div>
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

//For Alphabet A -Z Filter
if (($_POST['sort']) == 'alphaAz') {

    $query = "SELECT * FROM items ORDER BY items_name ASC";

    $r = mysqli_query($con, $query);
    $count = mysqli_num_rows($r);
    while ($row = mysqli_fetch_assoc($r)) {
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
						<div class='col-12 h6 pt-1'><strong>₱$items_price.00 &nbsp;".$availability."</span></strong></div>
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

//Alphabet Z-A Filter
if (($_POST['sort']) == 'alphaZa') {

    $query = "SELECT * FROM items ORDER BY items_name DESC";

    $r = mysqli_query($con, $query);
    $count = mysqli_num_rows($r);
    while ($row = mysqli_fetch_assoc($r)) {
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
						<div class='col-12 h6 pt-1'><strong>₱$items_price.00 &nbsp;".$availability."</span></strong></div>
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

//For Old To New Date Filter
if (($_POST['sort']) == 'oldNew') {

    $query = "SELECT * FROM items ORDER BY datecreated ASC";

    $r = mysqli_query($con, $query);
    $count = mysqli_num_rows($r);
    while ($row = mysqli_fetch_assoc($r)) {
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
							<div class='col-12 h6 pt-1'><strong>₱$items_price.00 &nbsp;".$availability."</span></strong></div>
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

//For Best Selling Filter
if (($_POST['sort']) == 'bsell') {


    $query = "SELECT items_id,item_descript,items_name,items_price,items_stocks,product_img1,product_img2, product_name, sum(quantity) as mostsell
	FROM items
	INNER JOIN customer_order_product ON items.items_name = customer_order_product.product_name
	group by product_name
	order by mostsell desc";

    $r = mysqli_query($con, $query);
    $count = mysqli_num_rows($r);
    while ($row = mysqli_fetch_assoc($r)) {
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
							<div class='col-12 h6 pt-1'><strong>₱$items_price.00 &nbsp;".$availability."</span></strong></div>
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

//For New to Old Date Filter
if (($_POST['sort']) == 'newOld') {

    $query = "SELECT * FROM items ORDER BY datecreated DESC";

    $r = mysqli_query($con, $query);
    $count = mysqli_num_rows($r);
    while ($row = mysqli_fetch_assoc($r)) {
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
							<div class='col-12 h6 pt-1'><strong>₱$items_price.00 &nbsp;".$availability."</span></strong></div>
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


//For Extra 
if (($_POST['sort']) == "") {

    $query = "SELECT * FROM items ORDER BY items_price ASC";

    $r = mysqli_query($con, $query);
    $count = mysqli_num_rows($r);

    while ($row = mysqli_fetch_assoc($r)) {
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
							<div class='col-12 h6 pt-1'><strong>₱$items_price.00 &nbsp;".$availability."</span></strong></div>
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
