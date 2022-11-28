
<?php

//measurement_fetch.php

include('database_connection.php');


$query = '';

$output = array();

$query .= "select items_name, sum(customer_order_product.quantity) as productssold, min(customer_order.date_created) as firstsale, max(customer_order.date_created) as lastsale, DATEDIFF( curdate() ,  min(customer_order.date_created)) as timespan, sum(customer_order_product.quantity) / 30 as averagesold from items join customer_order_product on items.items_id = customer_order_product.product_id join customer_order on customer_order_product.transaction_id = customer_order.transaction_id WHERE customer_order.date_created BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE() + INTERVAL 1 DAY AND status != '0' AND '4' group by items.items_id having averagesold >= 'desired value' ORDER BY `averagesold` DESC;
";


$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

$data = array();

$filtered_rows = $statement->rowCount();

foreach ($result as $row) {
    $sub_array = array();
    $sub_array[] = $row['items_name'];
     $sub_array[] = $row['productssold'];
    $sub_array[] =  $row['averagesold'];
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
