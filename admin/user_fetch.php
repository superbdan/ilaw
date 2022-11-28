<?php

//user_fetch.php

include('database_connection.php');

$query = '';

$output = array();

$query .= "
SELECT * FROM user_details
";

if (isset($_POST["search"]["value"])) {

	$query .= 'WHERE user_id LIKE "%' . $_POST["search"]["value"] . '%" ';
	$query .= 'OR last_name LIKE "%' . $_POST["search"]["value"] . '%" ';
	$query .= 'OR user_email LIKE "%' . $_POST["search"]["value"] . '%" ';
	$query .= 'OR home_address LIKE "%' . $_POST["search"]["value"] . '%" ';
	$query .= 'OR user_type LIKE "%' . $_POST["search"]["value"] . '%" ';
	$query .= 'OR user_status LIKE "%' . $_POST["search"]["value"] . '%" ';
}

if (isset($_POST['order'])) {
	$query .= 'ORDER BY ' . $_POST['order']['0']['column'] . ' ' . $_POST['order']['0']['dir'] . ' ';
} else {
	$query .= 'ORDER BY user_type DESC ';
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
	$user_id = $row['user_id'];
	$querylocation = "SELECT * FROM user_details INNER JOIN table_province ON user_details.province = table_province.province_id
    INNER JOIN table_municipality ON user_details.city = table_municipality.municipality_id
    INNER JOIN table_region ON user_details.region = table_region.region_id WHERE user_id = '$user_id'";
    
	$location = $connect->prepare($querylocation);
	$location->execute();
	while ($rowloc = $location->fetch(PDO::FETCH_ASSOC)) {
		$region = $rowloc['region_name'];
		$province = $rowloc['province_name'];
		$city = $rowloc['municipality_name'];
		$zip = $rowloc['zip_code'];
	};
	$status = '';
	if ($row['user_status'] == 'Active') {
		$status = '<center><span class="badge badge-success mt-2">Active</span>';
	} else {
		$status = '<center><span class="badge badge-danger mt-2">Inactive</span>';
	}
	$sub_array = array();
	$sub_array[] = $row['user_id'];
	$sub_array[] = '' . $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'] . '';
	$sub_array[] = $row['user_email'];
	$sub_array[] = $row['user_contact'];
	$sub_array[] = $row['home_address'] . " " . $city . " " . $province . " " . $region . " " . $zip;
	$sub_array[] = $row['user_type'];
	$sub_array[] = $status;
	$sub_array[] = '<center><button type="button" name="update" id="' . $row["user_id"] . '" class="btn btn-secondary btn-xs  update" data-toggle="tooltip" data-placement="bottom" title="Change Availability" data-status="' . $row["user_status"] . '"> <i class="fa fa-adjust"></i></button> <button type="button" name="delete" id="' . $row["user_id"] . '" class="btn btn-danger btn-xs delete" data-toggle="tooltip" data-placement="bottom" title="Remove User" data-status="' . $row["user_id"] . '"><i class="fa fa-trash"></i></button></center>';
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
	$statement = $connect->prepare("SELECT * FROM user_details");
	$statement->execute();
	return $statement->rowCount();
}

echo json_encode($output);
