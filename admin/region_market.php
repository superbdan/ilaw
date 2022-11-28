
<?php

//measurement_fetch.php

include('database_connection.php');


$query = '';

$output = array();

$query .= "SELECT region_name, Count(region_name) as customer
FROM table_region
INNER JOIN customer_order ON customer_order.region = table_region.region_id
WHERE status = '3'
group by region_name
Order by customer DESC
";



// // if(isset($_POST['order']))
// // {
// // 	$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
// // }
// // else
// // {
// // 	$query .= 'ORDER BY measurement_id ASC ';
// // }

// if ($_POST['length'] != -1) {
//     $query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
// }

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

$data = array();

$filtered_rows = $statement->rowCount();

foreach ($result as $row) {
    $sub_array = array();
    $sub_array[] = '<center><span class="mt-2">'.$row['region_name'].'</b></span></center>';
    $sub_array[] = '<center><h5 class="mt-2"><b>'.$row['customer'].'</b></h5></center>';
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
    $statement = $connect->prepare("SELECT * FROM review_table WHERE user_rating ='5'");
    $statement->execute();
    return $statement->rowCount();
}

echo json_encode($output);

?>