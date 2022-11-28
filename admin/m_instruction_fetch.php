<?php


include('database_connection.php');

$query = '';

$output = array();

$query .= "SELECT * FROM instructions
";

if(isset($_POST["search"]["value"]))
{
	$query .= 'WHERE instruction1 LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR instruction2 LIKE "%'.$_POST["search"]["value"].'%" ';
	
}

if(isset($_POST['order']))
{
	$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
	$query .= 'ORDER BY id ASC ';
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
	if (($row['image1'])==""){
		$image1 = 'noimage.png';
	}else{
		$image1 = $row['image1'];
	}
	if (($row['image2'])==""){
		$image2 = 'noimage.png';
	}else{
		$image2 = $row['image2'];
	}
	$sub_array = array();
	$sub_array[] = '<div class="col align-middle text-center"><img class="shadow" src="instruction_images/'.$image1.'" alt="Best Seller Image" width="60px"/></div>';
    $sub_array[] = $row['title1'];
	$sub_array[] = $row['instruction1'];
    $sub_array[] = '<div class="col align-middle text-center"><img class="shadow" src="instruction_images/'.$image2.'" alt="Best Seller Image" width="60px"/></div>';
	$sub_array[] = $row['title2'];
	$sub_array[] = $row['instruction2'];
	$sub_array[] = '<center><button type="button" name="update" id="'.$row["id"].'" class="btn btn-primary btn-xs update" data-toggle="tooltip" data-placement="bottom" title="Edit Courier"><i class="fa fa-pencil"></i></button> <button type="button" name="delete" id="'.$row["id"].'" class="btn btn-danger btn-xs delete" data-toggle="tooltip" data-placement="bottom" title="Remove Best Seller" data-status="'.$row["id"].'"><i class="fa fa-trash"></i></button></center>';
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
	$statement = $connect->prepare("SELECT * FROM instructions");
	$statement->execute();
	return $statement->rowCount();
}

echo json_encode($output);
