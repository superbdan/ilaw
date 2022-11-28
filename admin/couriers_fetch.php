<?php

//couriers_fetch.php

include('database_connection.php');

$query = '';

$output = array();
$query .= "SELECT * FROM couriers ";

if(isset($_POST["search"]["value"]))
{
	$query .= 'WHERE couriers.courier_id LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR couriers.courier_name LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR couriers.contact_no LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR couriers.address LIKE "%'.$_POST["search"]["value"].'%" ';
}

if(isset($_POST["order"]))
{
	$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
	$query .= 'ORDER BY couriers.courier_id ASC ';
}

if($_POST["length"] != -1)
{
	$query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

$data = array();

$filtered_rows = $statement->rowCount();

foreach($result as $row)
{
	$status = '';
	if($row['courier_name'] == '')
	{
		$status = '<center><span class="badge badge-success mt-2">Active</span>';
	}
	else
	{
		$status = '<center><span class="badge badge-danger mt-2">Inactive</span>';
	}
	$sub_array = array();
	$sub_array[] = $row['courier_name'];
	$sub_array[] = "₱". + number_format($row['courier_fee'],2);
	$sub_array[] = $row['contact_no'];
	$sub_array[] = $row['address'];
	$sub_array[] = '<center><button type="button" name="update" id="'.$row["courier_id"].'" class="btn btn-primary btn-xs update" data-toggle="tooltip" data-placement="bottom" title="Edit Courier"><i class="fa fa-pencil"></i></button> <button type="button" name="delete" id="'.$row["courier_id"].'" class="btn btn-danger btn-xs delete" data-toggle="tooltip" data-placement="bottom" title="Remove Courier" data-status="'.$row["courier_name"].'"><i class="fa fa-trash"></i></button></center>';
	$data[] = $sub_array;
}

$output = array(
	"draw"				=>	intval($_POST["draw"]),
	"recordsTotal"		=>	$filtered_rows,
	"recordsFiltered"	=>	get_total_all_records($connect),
	"data"				=>	$data
);

function get_total_all_records($connect)
{
	$statement = $connect->prepare('SELECT * FROM couriers');
	$statement->execute();
	return $statement->rowCount();
}

echo json_encode($output);
