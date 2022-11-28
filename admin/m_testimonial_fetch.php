<?php


include('database_connection.php');

$query = '';

$output = array();

$query .= "SELECT * FROM testimonies ";

if(isset($_POST["search"]["value"]))
{
	$query .= 'WHERE name LIKE "%'.$_POST["search"]["value"].'%" ';
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
    if($row['rating'] == '5')
	{
		$rating = '⭐⭐⭐⭐⭐';
	}elseif($row['rating'] == '4')
	{
		$rating = '⭐⭐⭐⭐';
	}elseif($row['rating'] == '3')
	{
		$rating = '⭐⭐⭐';
	}elseif($row['rating'] == '2')
	{
		$rating= '⭐⭐';
	}elseif($row['rating'] == '1')
	{
		$rating = '⭐';
	}
	$sub_array = array();
	$sub_array[] = '<div class="col align-middle text-center"><img class="shadow" src="testimony_images/'.$row['image'].'" alt="Testimonies" width="60px"/></div>';
	$sub_array[] = $row['name'];
    $sub_array[] = $row['title'];
    $sub_array[] = $row['feedback'];
    $sub_array[] = $rating;
	$sub_array[] = '<center><button type="button" name="update" id="'.$row["id"].'" class="btn btn-primary btn-xs update" data-toggle="tooltip" data-placement="bottom" title="Edit Courier"><i class="fa fa-pencil"></i></button> <button type="button" name="delete" id="'.$row["id"].'" class="btn btn-danger btn-xs delete" data-toggle="tooltip" data-placement="bottom" title="Remove Courier" data-status="'.$row["id"].'"><i class="fa fa-trash"></i></button></center>';
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
	$statement = $connect->prepare("SELECT * FROM testimonies");
	$statement->execute();
	return $statement->rowCount();
}

echo json_encode($output);
