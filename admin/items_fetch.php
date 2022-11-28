<?php

//items_fetch.php

include('database_connection.php');

$query = '';

$output = array();

$query .= "
	SELECT * FROM items 
INNER JOIN category ON category.category_id = items.category_id 
INNER JOIN suppliers ON suppliers.supplier_id = items.supplier_id
INNER JOIN measurement ON measurement.measurement_id = items.measurement_id
";

if(isset($_POST["search"]["value"]))
{
	
	$query .= 'WHERE items_name LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR stock_status LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR items_id LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR category_name LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR supplier_name LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR measurement_name LIKE "%'.$_POST["search"]["value"].'%" ';
}

if(isset($_POST['order']))
{
	$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
	$query .= 'ORDER BY items_id ASC ';
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
	if($row['items_status'] == 'active')
	{
		$status = '<span class="label label-success">Active</span>';
	}
	else
	{
		$status = '<span class="label label-danger">Inactive</span>';
	}
	$sub_array = array();
	$sub_array[] = $row['items_name'];
	$sub_array[] = $row['category_name'];
	$sub_array[] = "₱". number_format($row['items_cost'], 2);
	$sub_array[] = "₱". number_format($row['items_price'], 2);
	$sub_array[] = $row['items_stocks'];
	$sub_array[] = $row['supplier_name'];
	$sub_array[] = $row['measurement_name'];
	if ($row['stock_status'] == "Critical"){
		$sub_array[] = '<center><a style="color: #C23531; text-shadow: black 0px 0px 1px; font-weight: bold;">'.$row['stock_status'].'</a></center>';
	}
	elseif ($row['stock_status'] == "Warning"){
		$sub_array[] = '<center><a style="color: #D48265; text-shadow: black 0px 0px 1px; font-weight: bold;">'.$row['stock_status'].'</a></center>';
	} 
	elseif ($row['stock_status'] == "Full"){
		$sub_array[] = '<center><a style=" color: #2F4553; text-shadow: black 0px 0px 1px; font-weight: bold;">'.$row['stock_status'].'</a></center>';
	}
	else
	{
		$sub_array[] = '<center><a style="color: #61A0A8; text-shadow: black 0px 0px 1px; font-weight: bold;">'.$row['stock_status'].'</a></center>';
	}
	
	$sub_array[] = '<center><button data-toggle="tooltip" data-placement="bottom" title="View Item" type="button" name="view" id="'.$row["items_id"].'" class="btn btn-warning btn-xs view"><i class="fa fa-eye"></i></button> <button type="button" name="update" id="'.$row["items_id"].'" class="btn btn-primary btn-xs update" data-toggle="tooltip" data-placement="bottom" title="Edit Item"><i class="fa fa-pencil"></i></button> <button type="button" name="delete" id="'.$row["items_id"].'" class="btn btn-danger btn-xs delete" data-toggle="tooltip" data-placement="bottom" title="Remove Item" data-status="'.$row["items_name"].'"><i class="fa fa-trash"></i></button></center>';
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
	$statement = $connect->prepare("SELECT * FROM items");
	$statement->execute();
	return $statement->rowCount();
}

echo json_encode($output);

?>