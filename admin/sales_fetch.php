
<?php

//measurement_fetch.php

include('database_connection.php');


$query = '';

$output = array();

$query .= "SELECT * FROM customer_order WHERE status ='3'";



// if(isset($_POST['order']))
// {
// 	$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
// }
// else
// {
// 	$query .= 'ORDER BY measurement_id ASC ';
// }

if ($_POST['length'] != -1) {
    $query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

$data = array();

$filtered_rows = $statement->rowCount();

foreach ($result as $row) {
    switch ($row['status']) {
        case '0':
            $out = "<center><span class='badge badge-pill badge-warning'>Pending</span></center>";
            break;
        case '1':
            $out = "<center><span class='badge badge-pill badge-info'>To Ship</span></center>";
            break;
        case '2':
            $out = "<center><span class='text-center badge badge-pill badge-primary'>To Recieved</span></center>";
            break;
        case '3':
            $out = "<center><span class='text-center badge badge-pill badge-success'>Completed</span></center>";
            break;
        case '4':
            $out = "<center><span class='text-center badge badge-pill badge-danger'>Cancelled</span></center>";
            break;
    }
    $sub_array = array();
    $sub_array[] = $row['transaction_id'];
    $sub_array[] = '<center><button type="button" name="user" id="' . $row["customer_id"] . '" class="btn btn-primary btn-sm user" data-id="' . $row["transaction_id"] . '"><i class="fa fa-user"></i> View Customer</button></center>';
    $sub_array[] = '<center><button type="button" name="order" id="' . $row["transaction_id"] . '" class="btn btn-success btn-sm order"><i class="fa fa-shopping-cart"></i> View Items</button></center>';
    $sub_array[] = '₱' . number_format($row['total_amount'], 2);
    $sub_array[] = $out;
    $sub_array[] = $row['date_created'];
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
    $statement = $connect->prepare("SELECT * FROM customer_order WHERE status ='3'");
    $statement->execute();
    return $statement->rowCount();
}

echo json_encode($output);

?>