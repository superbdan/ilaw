
<?php

//measurement_fetch.php

include('database_connection.php');


$query = '';

$output = array();

$query .= "SELECT * FROM measurement ";

if(isset($_POST["search"]["value"]))
{
	
	$query .= 'WHERE measurement_name LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR measurement_status LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR measurement_id LIKE "%'.$_POST["search"]["value"].'%" ';
}

if(isset($_POST['order']))
{
	$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
	$query .= 'ORDER BY measurement_id ASC ';
}

if($_POST['length'] != -1)
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
	if($row['measurement_status'] == 'active')
	{
		$status = '<center><span class="badge badge-success mt-2">Active</span>';
	}
	else
	{
		$status = '<center><span class="badge badge-danger mt-2">Inactive</span>';
	}
	$sub_array = array();
	$sub_array[] = $row['measurement_name'];
	$sub_array[] = $status;
	$sub_array[] = '<center><button type="button" name="delete" id="'.$row["measurement_id"].'" class="btn btn-secondary btn-xs  delete" data-toggle="tooltip" data-placement="bottom" title="Change Availability" data-status="'.$row["measurement_status"].'"><i class="fa fa-adjust"></i></button> ';
	$sub_array[] = '<center><button type="button" name="update" id="'.$row["measurement_id"].'" class="btn btn-primary btn-xs update " data-toggle="tooltip" data-placement="bottom" title="Edit Measurement"  data-name="'.$row["measurement_name"].'"><i class="fa fa-pencil"></i></button></center>';
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
	$statement = $connect->prepare("SELECT * FROM measurement");
	$statement->execute();
	return $statement->rowCount();
}

echo json_encode($output);

?>