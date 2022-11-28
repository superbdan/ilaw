<?php

//customer_fetch.php

include('database_connection.php');

// $sample = $_POST['prod'];

// public function sel_prod_by_id($id){
// 	$query = "SELECT * items_cost WHERE items_name = '$id'";
// 	$result = $query->row_array();
// 	echo json_encode($result);
// 	}

$query = '';

$output = array();

$query .= "
SELECT * FROM customer_order WHERE status ='0'
";

if (isset($_POST["search"]["value"])) {

	$query .= 'and customer_name LIKE "%' . $_POST["search"]["value"] . '%" ';
	// $query .= 'AND customer_id LIKE "%'.$_POST["search"]["value"].'%" ';
}

if (isset($_POST['order'])) {
	$query .= 'ORDER BY UNIX_TIMESTAMP(date_created) ASC,  ' . $_POST['order']['0']['column'] . ' ' . $_POST['order']['0']['dir'] . ' ';
} else {
	$query .= 'ORDER BY UNIX_TIMESTAMP(date_created) ASC ';
}

if ($_POST['length'] != -1) {
	$query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}



$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

$data = array();

$filtered_rows = $statement->rowCount();

foreach ($result as $row) {
	$transaction = $row['transaction_id'];
	$querylocation = "SELECT * FROM customer_order INNER JOIN table_province ON customer_order.province = table_province.province_id
    INNER JOIN table_municipality ON customer_order.city = table_municipality.municipality_id
    INNER JOIN table_region ON customer_order.region = table_region.region_id
    WHERE transaction_id ='$transaction'";
	$location = $connect->prepare($querylocation);
	$location->execute();
	while ($rowloc = $location->fetch(PDO::FETCH_ASSOC)) {
		$region = $rowloc['region_name'];
		$province = $rowloc['province_name'];
		$city = $rowloc['municipality_name'];
		$zip = $rowloc['zip'];
	};
	if ($row['status'] == '0') {
		$status = '<center><span class="badge badge-pill badge-warning mt-2">Pending</span>';
	}
	$sub_array = array();
	// $sub_array[] = $row['id'];
	$sub_array[] = $row['transaction_id'];
	$sub_array[] = $row['customer_id'];
	$sub_array[] = $row['customer_name'];
	$sub_array[] = $row['customer_no'];
	$sub_array[] = $row['address'] . " " . $city . " " . $province . " " . $region . " " . $zip;
	$sub_array[] = $status;
	$sub_array[] = '<center><a href = "counter.php?id=' . $row["transaction_id"] . '" name="next" id="order_fetch.php?id=' . $row["transaction_id"] . '" class="btn btn-primary btn-xs update" data-toggle="tooltip" data-placement="bottom" title="Place to Counter"><i class="fa fa-shopping-cart" style="color:white"></i></a></center>';
	$data[] = $sub_array;
}

$output = array(
	"draw"			=>	intval($_POST["draw"]),
	"recordsTotal"  	=>  $filtered_rows,
	"recordsFiltered" 	=> 	get_total_all_records($connect),
	"data"				=>	$data
);

function get_total_all_records($connect)
{
	$statement = $connect->prepare("SELECT * FROM customer_order WHERE status ='0'");
	$statement->execute();
	return $statement->rowCount();
}

echo json_encode($output);
