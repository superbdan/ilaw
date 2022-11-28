<?php

//supplier_fetch.php

include('database_connection.php');

$query = '';

$output = array();
$query .= "SELECT * FROM suppliers ";

if(isset($_POST["search"]["value"]))
{
	$query .= 'WHERE suppliers.supplier_id LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR suppliers.supplier_name LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR suppliers.contact_no LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR suppliers.address LIKE "%'.$_POST["search"]["value"].'%" ';
}

if(isset($_POST["order"]))
{
	$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
	$query .= 'ORDER BY suppliers.supplier_id ASC ';
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
	if($row['supplier_name'] == '')
	{
		$status = '<center><span class="badge badge-success mt-2">Active</span>';
	}
	else
	{
		$status = '<center><span class="badge badge-danger mt-2">Inactive</span>';
	}
	$sub_array = array();
	$sub_array[] = '<div class="col align-middle text-center"><img src="../supplier_images/'.$row['supplier_img'].'" width="60px"/></div>';
	$sub_array[] = $row['supplier_name'];
	$sub_array[] = $row['contact_no'];
	$sub_array[] = $row['address'];
	$sub_array[] = '<center><button type="button" name="update" id="'.$row["supplier_id"].'" class="btn btn-primary btn-xs update" data-toggle="tooltip" data-placement="bottom" title="Edit Supplier"><i class="fa fa-pencil"></i></button> <button type="button" name="delete" id="'.$row["supplier_id"].'" class="btn btn-danger btn-xs delete" data-toggle="tooltip" data-placement="bottom" title="Remove Supplier" data-status="'.$row["supplier_name"].'"><i class="fa fa-trash"></i></button></center>';
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
	$statement = $connect->prepare('SELECT * FROM suppliers');
	$statement->execute();
	return $statement->rowCount();
}

echo json_encode($output);

?>