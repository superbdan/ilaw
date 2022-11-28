<?php
// session_start();
// $user = $_SESSION['type'];

date_default_timezone_set('Asia/Manila');
require '../connection.php';
include('database_connection.php');
$user = $_SESSION['type'];
$user_name = $_SESSION['name'];
// Add products into the cart table
if (isset($_POST['pid'])) {

	$pid = $_POST['pid'];
	$puser = $_POST['puser'];
	$pname = $_POST['pname'];
	$pprice = $_POST['pprice'];
	$punit = $_POST['punit'];
	$pcode = $_POST['pcode'];
	$pqty = $_POST['pqty'];
	$total_price = $pprice * $pqty;

	$stmt = $con->prepare('SELECT product_code FROM admin_cart WHERE product_code=?');
	$stmt->bind_param('s', $pcode);
	$stmt->execute();
	$res = $stmt->get_result();
	$r = $res->fetch_assoc();
	$code = $r['product_code'] ?? '';

	if (!$code) {
		$query = $con->prepare('INSERT INTO admin_cart (transaction_id, product_id, product_name, unit, quantity, price, total, product_code) VALUES (?,?,?,?,?,?,?,?)');
		$query->bind_param('ssssssss', $puser, $pid, $pname, $punit, $pqty, $pprice, $total_price, $pcode);
		$query->execute();

		$output['feedback'] = "success";
		echo json_encode($output);;
	} else {
		$output['feedback'] = "failed";
		echo json_encode($output);;
	}
}


// Get no.of items available in the cart table
if (isset($_GET['cartItem']) && isset($_GET['cartItem']) == 'cart_item') {
	$stmt = $con->prepare('SELECT * FROM cart');
	$stmt->execute();
	$stmt->store_result();
	$rows = $stmt->num_rows;

	echo $rows;
}

// Remove single items from cart
if (isset($_POST['remove'])) {
	$id = $_POST['remove'];

	$stmt = $con->prepare('DELETE FROM admin_cart WHERE product_id=?');
	$stmt->bind_param('i', $id);
	$stmt->execute();

	$_SESSION['showAlert'] = 'block';
	$_SESSION['message'] = 'Item removed from the cart!';
	//   header('location:admin-ordering.php#product');
}

// Remove all items at once from cart
if (isset($_POST['clear'])) {
	$stmt = $con->prepare('DELETE FROM admin_cart');
	$stmt->execute();
	// $_SESSION['showAlert'] = 'block';
	// $_SESSION['message'] = 'All Item removed from the cart!';
	//   header('location:admin-ordering.php#product');
}

// Set total price of the product in the cart table
if (isset($_POST['qty'])) {
	$qty = $_POST['qty'];
	$pid = $_POST['pid'];
	$pprice = $_POST['pprice'];

	$tprice = $qty * $pprice;

	$stmt = $con->prepare('UPDATE admin_cart SET quantity=?, total=? WHERE product_id=?');
	$stmt->bind_param('isi', $qty, $tprice, $pid);
	$stmt->execute();
}

// Checkout and save customer info in the orders table


if (isset($_POST['btn_submit']) == 'Add') {
	if (isset($_POST['product_name'])) {
		$query = "
		INSERT INTO customer_order (transaction_id, customer_id, customer_name, email, customer_no, region, province, city, address, zip, total_amount, payment, payment_status, courier, status, date_created) 
		VALUES (:transaction_id, :customer_id, :customer_name, :email, :customer_no, :region, :province, :city, :address, :zip, :total_amount, :payment, :payment_status, :courier, :status, :date_created)
		";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':transaction_id'                =>    $_POST["transaction_id"],
				':customer_id'                   =>    $_POST["customer_id"],
				':customer_name'                 =>    $_POST['customer_name'],
				':email'						 =>    'noreply@noemail.com',
				':customer_no'                   =>    $_POST['customer_no'],
				':region' 						 =>	   $_POST['region'],
				':province'						 =>	   $_POST['province'],
				':city'							 =>	   $_POST['city'],
				':address'                       =>    $_POST['order_address'],
				':zip'							 =>	   $_POST['zip_code'],
				':total_amount'					 =>    $_POST['total'],
				':payment'						 =>    'Approved.png',
				':payment_status'				 =>    'validated',
				':courier'						 =>	   $_POST['courier'],
				':status'                        =>    '0',
				':date_created'                  =>    date("Y-m-d H:i:sa")
			)
		);
		$result = $statement->fetchAll();


		foreach ($_POST['product_name'] as $key => $value) {
			$query = "INSERT INTO customer_order_product(transaction_id, product_id, product_name, unit, price, quantity,total)VALUES(:transaction_id,:product_id, :product_name,:unit,:price,:quantity,:total_cost);";
			$stmt = $connect->prepare($query);
			$stmt->execute([
				'transaction_id' => $_POST['transaction_id'],
				'product_id' => $_POST['prod_id'][$key],
				'product_name' => $value,
				'unit' => $_POST['unit'][$key],
				'price' => $_POST['product_price'][$key],
				'quantity' => $_POST['quantity'][$key],
				'total_cost' => $_POST['total_cost'][$key]

			]);
			$prod_id = $_POST['prod_id'][$key];

			$prod_qty = $_POST['quantity'][$key];
			$stocksquery = "SELECT * FROM `items` WHERE items_id = '$prod_id'";
			$statement = $connect->prepare($stocksquery);
			$statement->execute();
			$result1 = $statement->fetchAll();
			// $data = array();
			// $filtered_rows = $statement->rowCount();
			$items_status;
			$stocks_latest;
			foreach($result1 as $row)  {
				$items_name = $row["items_name"];
				$items_stocks = $row["items_stocks"];
                $items_low = $row["items_low"];
                $target_stocks = $row["target_stocks"];
			}
			$stocks_latest = $items_stocks - $prod_qty;
            if ($stocks_latest <= $items_low){
                $items_status = "Critical";
            } elseif ($stocks_latest <= $items_low * 2){
                $items_status = "Warning";
            } elseif ($stocks_latest >= $target_stocks){
                $items_status = "Full";
            } else {
                $items_status = "Good";
            }
			$updatequery = "UPDATE `items` SET `items_stocks`='$stocks_latest',`stock_status`='$items_status' WHERE items_id = '$prod_id'";
			$stmt = $connect->prepare($updatequery);
			$stmt->execute();

			$stock_logs = "
            INSERT INTO stock_logs (item_name, stock_quantity, incharge, type, activity) 
            VALUES (:item_name, :quantity, :user, '2', 'added an order')
            ";
            $stockstmt = $connect->prepare($stock_logs);
            $stockstmt->execute(
                array(
                    ':item_name'                => $items_name,
                    ':user'                =>    $user_name,
                    ':quantity'                =>   $prod_qty,
                )
            );
			
		}

		$stmt2 = $connect->prepare('DELETE FROM admin_cart');
		$stmt2->execute();


		$query = "
		INSERT INTO order_tracking (transaction_id, order_placed) 
		VALUES (:transaction_id, :time)
		";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':transaction_id'                =>    $_POST["transaction_id"],
				':time'                =>    $_POST["time"],
			)
		);

		$logquery = "
		INSERT INTO logs (action, user) 
		VALUES (:transaction_id, :user)
		";
		$logstmt = $connect->prepare($logquery);
		$logstmt->execute(
			array(
				':transaction_id'                => 'Added an order '.   $_POST["transaction_id"],
				':user'                =>    $user,
			)
		);

		if (isset($result)) {
			$output['feedback'] = "Success";
			echo json_encode($output);
		}
	} else {
		$output['feedback'] = "Product Cart is Empty";
		echo json_encode($output);
		// echo 'Product Cart Is Empty <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
	}
}
