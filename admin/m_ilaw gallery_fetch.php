<?php


include('database_connection.php');

$query = '';

$output = array();

$query .= "SELECT * FROM gallery ";

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
	if($row['status'] == 'active')
	{
		$status = '<center><span class="badge badge-success mt-2">Active</span>';
	}
	else
	{
		$status = '<center><span class="badge badge-danger mt-2">Inactive</span>';
	}
	$sub_array = array();
	$sub_array[] = '<div class="col align-middle text-center"><img class="shadow" src="ilaw_gallery/'.$row['image'].'" alt="Gallery Image" width="60px"/></div>';
	$sub_array[] = $status;
    $sub_array[] = $row['date'];
	$sub_array[] = '<center><button type="button" name="change" id="'.$row["id"].'" class="btn btn-secondary btn-xs  change" data-toggle="tooltip" data-placement="bottom" title="Change Availability" data-status="'.$row["status"].'"><i class="fa fa-adjust"></i></button> <button type="button" name="delete" id="'.$row["id"].'" class="btn btn-danger btn-xs delete" data-toggle="tooltip" data-placement="bottom" title="Remove New Arrival" data-status="'.$row["id"].'"><i class="fa fa-trash"></i></button></center>';
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
	$statement = $connect->prepare("SELECT * FROM gallery");
	$statement->execute();
	return $statement->rowCount();
}

echo json_encode($output);

?>
