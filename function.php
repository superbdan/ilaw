<?php
//function.php
include('connection.php');

function fill_category_list($connect)
{
	$query = "
	SELECT * FROM category 
	WHERE category_status = 'active' 
	ORDER BY category_name ASC
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach ($result as $row) {
		$output .= '<option value="' . $row["category_id"] . '">' . $row["category_name"] . '</option>';
	}
	return $output;
}

function fill_suppliers_list($connect)
{
	$query = "SELECT * FROM suppliers 
	ORDER BY supplier_name ASC";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach ($result as $row) {
		$output .= '<option value="' . $row["supplier_id"] . '">' . $row["supplier_name"] . '</option>';
	}
	return $output;
}

function fill_measurement_list($connect)
{
	$query = "
	SELECT * FROM measurement 
	WHERE measurement_status = 'active' 
	ORDER BY measurement_name ASC
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach ($result as $row) {
		$output .= '<option value="' . $row["measurement_id"] . '">' . $row["measurement_name"] . '</option>';
	}
	return $output;
}

function get_customer_name($connect, $customer_id)
{
	$query = "
	SELECT customer_name FROM customer_details WHERE customer_id = '" . $customer_id . "'
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach ($result as $row) {
		return $row['customer_name'];
	}
}

function get_user_name($connect, $user_id)
{
	$query = "
	SELECTuser_name FROM user_details WHERE user_id = '" . $user_id . "'
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach ($result as $row) {
		return $row['user_name'];
	}
}

function count_total_user($connect)
{
	$query = "
	SELECT * FROM user_details WHERE user_status='active'";
	$statement = $connect->prepare($query);
	$statement->execute();
	return $statement->rowCount();
}

function count_total_category($connect)
{
	$query = "
	SELECT * FROM category WHERE category_status='active'
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	return $statement->rowCount();
}

function count_total_suppliers($connect)
{
	$query = "
	SELECT * FROM suppliers
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	return $statement->rowCount();
}

//Items
function fill_product_list($connect)
{
	$query = "
	SELECT * FROM items 
	WHERE items_low != '0' 
	ORDER BY items_id ASC
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach ($result as $row) {
		$output .= '<option value="' . $row["items_id"] . '">' . $row["items_name"] . '</option>';
	}
	return $output;
}
//ITems Name only
function fill_product_name($connect)
{
	$query = "
	SELECT * FROM items 
	WHERE items_low != '0' 
	ORDER BY items_id ASC
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach ($result as $row) {
		$output .= '<option value="' . $row["items_name"] . '">' . $row["items_name"] . '</option>';
	}
	return $output;
}
//category NAME only 
function fill_category_name($connect)
{
	$query = "
	SELECT * FROM category 
	WHERE category_status = 'active' 
	ORDER BY category_name ASC
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach ($result as $row) {
		$output .= '<option value="' . $row["category_name"] . '">' . $row["category_name"] . '</option>';
	}
	return $output;
}
//measurement NAME only 
function fill_measurement_name($connect)
{
	$query = "
	SELECT * FROM measurement 
	WHERE measurement_status = 'active' 
	ORDER BY measurement_name ASC
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach ($result as $row) {
		$output .= '<option value="' . $row["measurement_name"] . '">' . $row["measurement_name"] . '</option>';
	}
	return $output;
}
// courier PRICE only
function fill_courier_price($connect)
{
	$query = "SELECT * FROM couriers 
	ORDER BY courier_name ASC";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach ($result as $row) {
		$output .= '<option value="' . $row["courier_id"] . '">' . $row["courier_name"] . '</option>';
	}
	return $output;
}



function fetch_product_details($product_id, $connect)
{
	$query = "
	SELECT * FROM product 
	WHERE product_id = '" . $product_id . "'";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach ($result as $row) {
		$output['product_name'] = $row["product_name"];
		$output['quantity'] = $row["product_quantity"];
		$output['price'] = $row['product_base_price'];
		$output['tax'] = $row['product_tax'];
	}
	return $output;
}

function available_product_quantity($connect, $product_id)
{
	$product_data = fetch_product_details($product_id, $connect);
	$query = "
	SELECT 	inventory_order_product.quantity FROM inventory_order_product 
	INNER JOIN inventory_order ON inventory_order.inventory_order_id = inventory_order_product.inventory_order_id
	WHERE inventory_order_product.product_id = '" . $product_id . "' AND
	inventory_order.inventory_order_status = 'active'
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$total = 0;
	foreach ($result as $row) {
		$total = $total + $row['quantity'];
	}
	$available_quantity = intval($product_data['quantity']) - intval($total);
	if ($available_quantity == 0) {
		$update_query = "
		UPDATE product SET 
		product_status = 'inactive' 
		WHERE product_id = '" . $product_id . "'
		";
		$statement = $connect->prepare($update_query);
		$statement->execute();
	}
	return $available_quantity;
}
function count_total_product($connect)
{
	$query = "
	SELECT * FROM product WHERE product_status='active'
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	return $statement->rowCount();
}

function count_total_order_value($connect)
{
	$query = "
	SELECT sum(inventory_order_total) as total_order_value FROM inventory_order 
	WHERE inventory_order_status='active'
	";
	if ($_SESSION['type'] == 'user') {
		$query .= ' AND user_id = "' . $_SESSION["user_id"] . '"';
	}
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach ($result as $row) {
		return number_format($row['total_order_value'], 2);
	}
}

function count_total_cash_order_value($connect)
{
	$query = "
	SELECT sum(inventory_order_total) as total_order_value FROM inventory_order 
	WHERE payment_status = 'cash' 
	AND inventory_order_status='active'
	";
	if ($_SESSION['type'] == 'user') {
		$query .= ' AND user_id = "' . $_SESSION["user_id"] . '"';
	}
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach ($result as $row) {
		return number_format($row['total_order_value'], 2);
	}
}

function count_total_credit_order_value($connect)
{
	$query = "
	SELECT sum(inventory_order_total) as total_order_value FROM inventory_order WHERE payment_status = 'credit' AND inventory_order_status='active'
	";
	if ($_SESSION['type'] == 'user') {
		$query .= ' AND user_id = "' . $_SESSION["user_id"] . '"';
	}
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach ($result as $row) {
		return number_format($row['total_order_value'], 2);
	}
}

function get_user_wise_total_order($connect)
{
	$query = '
	SELECT sum(inventory_order.inventory_order_total) as order_total, 
	SUM(CASE WHEN inventory_order.payment_status = "cash" THEN inventory_order.inventory_order_total ELSE 0 END) AS cash_order_total, 
	SUM(CASE WHEN inventory_order.payment_status = "credit" THEN inventory_order.inventory_order_total ELSE 0 END) AS credit_order_total, 
	user_details.user_name 
	FROM inventory_order 
	INNER JOIN user_details ON user_details.user_id = inventory_order.user_id 
	WHERE inventory_order.inventory_order_status = "active" GROUP BY inventory_order.user_id
	';
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '
	<div class="table-responsive">
		<table class="table table-bordered table-striped">
			<tr>
				<th>User Name</th>
				<th>Total Order Value</th>
				<th>Total Cash Order</th>
				<th>Total Credit Order</th>
			</tr>
	';

	$total_order = 0;
	$total_cash_order = 0;
	$total_credit_order = 0;
	foreach ($result as $row) {
		$output .= '
		<tr>
			<td>' . $row['user_name'] . '</td>
			<td align="right">$ ' . $row["order_total"] . '</td>
			<td align="right">$ ' . $row["cash_order_total"] . '</td>
			<td align="right">$ ' . $row["credit_order_total"] . '</td>
		</tr>
		';

		$total_order = $total_order + $row["order_total"];
		$total_cash_order = $total_cash_order + $row["cash_order_total"];
		$total_credit_order = $total_credit_order + $row["credit_order_total"];
	}
	$output .= '
	<tr>
		<td align="right"><b>Total</b></td>
		<td align="right"><b>$ ' . $total_order . '</b></td>
		<td align="right"><b>$ ' . $total_cash_order . '</b></td>
		<td align="right"><b>$ ' . $total_credit_order . '</b></td>
	</tr></table></div>
	';
	return $output;
}
function fill_items_list($connect)
{
	$query = "
	SELECT * FROM items 
	WHERE items_status = 'active' 
	ORDER BY items_name ASC
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach ($result as $row) {
		$output .= '<option value="' . $row["items_id"] . '">' . $row["items_name"] . '</option>';
	}
	return $output;
}
function count_total_items($connect)
{
	$query = "
	SELECT * FROM items WHERE items_status='active'
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	return $statement->rowCount();
}
function get_invoice_no($connect)
{


	// $connect = mysqli_connect("localhost", "root", "", "database");
	// $IDquery = "SELECT transaction_id FROM customer_order ORDER BY transaction_id DESC";
	// $IDresult = mysqli_query($connect, $IDquery);
	// $row = mysqli_fetch_array($IDresult);
	// $lastid = $row['transaction_id'];
	// if (empty($lastid)) {
	// 	$number = "ILAW-0000001";
	// } else {
	// 	$idd = str_replace("ILAW-", "", $lastid);
	// 	$id = str_pad($idd + 1, 7, 0, STR_PAD_LEFT);
	// 	$number = 'ILAW-' . $id;
	// }
	$number = "Ilaw-" . strtoupper(uniqid());
	return $number;
}

function get_master_id($con)
{
	$query = "SELECT user_id FROM user_details WHERE user_id LIKE 'M%' ORDER BY user_id DESC";
	$result = mysqli_query($con, $query);
	$row = mysqli_fetch_array($result);
	$lastid = $row['user_id'];
	if (empty($lastid)) {
		$uid = "MST-001";
	} else {
		$idd = str_replace("MST-", "", $lastid);
		$id = str_pad($idd + 1, 3, 0, STR_PAD_LEFT);
		$uid = 'MST-' . $id;
	}
	return $uid;
}
function get_user_id($con)
{
	$query = "SELECT user_id FROM user_details WHERE user_id LIKE 'C%' ORDER BY user_id DESC";
	$result = mysqli_query($con, $query);
	$row = mysqli_fetch_array($result);
	$lastid = $row['user_id'];
	if (empty($lastid)) {
		$uid = "CUS-0000001";
	} else {
		$idd = str_replace("CUS-", "", $lastid);
		$id = str_pad($idd + 1, 7, 0, STR_PAD_LEFT);
		$uid = 'CUS-' . $id;
	}
	return $uid;
}
function get_staff_id($con)
{

	$query = "SELECT user_id FROM user_details WHERE user_id LIKE 'S%' ORDER BY user_id DESC";
	$result = mysqli_query($con, $query);
	$row = mysqli_fetch_array($result);
	$lastid = $row['user_id'];
	if (empty($lastid)) {
		$uid = "STF-001";
	} else {
		$idd = str_replace("STF-", "", $lastid);
		$id = str_pad($idd + 1, 3, 0, STR_PAD_LEFT);
		$uid = 'STF-' . $id;
	}
	return $uid;
}
function fill_couriers_list($connect)
{
	$query = "SELECT * FROM couriers 
	ORDER BY courier_name ASC";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach ($result as $row) {
		$output .= '<option value="' . $row["courier_id"] . '">' . $row["courier_name"] . '</option>';
	}
	return $output;
}

function count_total_couriers($connect)
{
	$query = "
	SELECT * FROM couriers
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	return $statement->rowCount();
}

//For Checkout
function fill_municipality_list($connect)
{
	$query = "
	SELECT * FROM table_municipality 
	ORDER BY municipality_name ASC
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach ($result as $row) {
		$output .= '<option value="' . $row["municipality_id"] . '">' . $row["municipality_name"] . '</option>';
	}
	return $output;
}
function fill_province_list($connect)
{
	$query = "
	SELECT * FROM table_province
	ORDER BY province_name ASC
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach ($result as $row) {
		$output .= '<option value="' . $row["province_id"] . '">' . $row["province_name"] . '</option>';
	}
	return $output;
}

function fill_region_list($connect)
{
	$query = "
	SELECT * FROM table_region
	ORDER BY region_name ASC
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach ($result as $row) {
		$output .= '<option value="' . $row["region_id"] . '">' . $row["region_name"] . '</option>';
	}
	return $output;
}
