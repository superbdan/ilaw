<?php


include('database_connection.php');

$query = '';

$output = array();

$query .= "SELECT * FROM `items` INNER JOIN category ON category.category_id = items.category_id WHERE best_seller = '1';
";

if(isset($_POST["search"]["value"]))
{
	$query .= 'OR category LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR price LIKE "%'.$_POST["search"]["value"].'%" ';
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
	$sub_array = array();
	$sub_array[] = '<div class="col align-middle text-center"><img class="shadow" src="product_images/'.$row['product_img1'].'" alt="Best Seller Image" width="60px"/></div>';
    $sub_array[] = '<div class="col align-middle text-center"><img class="shadow" src="product_images/'.$row['product_img2'].'" alt="Best Seller Image" width="60px"/></div>';
    $sub_array[] = $row['items_name'];
    $sub_array[] = $row['category_name'];
    $sub_array[] = '₱'. number_format($row['items_price'], 2);
	$sub_array[] = '<center><button type="button" name="delete" id="'.$row["items_id"].'" class="btn btn-danger btn-xs delete" data-toggle="tooltip" data-placement="bottom" title="Remove Best Seller" data-status="'.$row["items_id"].'"><i class="fa fa-trash"></i></button></center>';
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
	$statement = $connect->prepare("SELECT * FROM `items` INNER JOIN category ON category.category_id = items.category_id WHERE best_seller = '1';");

	return $statement->rowCount();
}

echo json_encode($output);

?>
