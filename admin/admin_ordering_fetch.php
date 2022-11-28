<?php

//category_fetch.php

include('database_connection.php');

$query = '';

$output = array();

$query .= "SELECT measurement.measurement_name, product_img1, items_name, items_id, items_price, items_status, items_stocks FROM measurement INNER JOIN items ON measurement.measurement_id = items.measurement_id 
";

if(isset($_POST["search"]["value"]))
{
	$query .= 'WHERE items_name LIKE "%'.$_POST["search"]["value"].'%" ';
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

foreach ($result as $row) {
    if($row['items_stocks'] == 0){
        $availability = '<span class="text-danger">Out of Stocks<span>';
        $button = '<center><button type="button" class="btn btn-danger p-1 mt-2 text-white" title="Add to Cart" ><i class="fa fa-shopping-cart fa-lg"></i> Add </button>';
    }else{
        $availability = '<span class="text-success">In Stocks<span>';
        $button = '<center><button type="button" name="addItemBtn" id="' . $row['items_id'] . '" class="btn btn-info p-1 mt-2 text-white addItemBtn" data-pname="' . $row['items_name'] . '" data-punit="' . $row['measurement_name'] . '" data-pprice="' . $row['items_price'] . '" data-pcode="' . $row['items_id'] . '" data-pstock="' . $row['items_stocks'] . '" title="Add to Cart" ><i class="fa fa-shopping-cart fa-lg"></i> Add </button>';
    }
    $sub_array = array();
    $sub_array[] = '<td>
    <div class="col align-middle text-center"><img src="product_images/' . $row['product_img1'] . '" width="100px" class="shadow" /></div></td>';
    $sub_array[] = '<td class="text-center">' . $row['items_name'] . '</td>';
    $sub_array[] = '<center><div class="col-md-6"><b>'.$availability.'</b><input type="number" class="form-control" name="1" id="1" min="1" value="'.$row['items_stocks'].'"  style="text-align:center" disabled></div></center>';
    $sub_array[] = '<td class="text-center">₱' . number_format($row['items_price'], 2) . '</td>';
    $sub_array[] = $button;
    $data[] = $sub_array;
}

$output = array(
    "draw"            =>    intval($_POST["draw"]),
    "recordsTotal"      =>  $filtered_rows,
    "recordsFiltered"     =>     get_total_all_records($connect),
    "data"                =>    $data
);

function get_total_all_records($connect)
{
    $statement = $connect->prepare("SELECT measurement.measurement_name, product_img1, items_name, items_id, items_price FROM measurement INNER JOIN items ON measurement.measurement_id = items.measurement_id");
    $statement->execute();
    return $statement->rowCount();
}

echo json_encode($output);
