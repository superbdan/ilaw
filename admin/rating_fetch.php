
<?php

//measurement_fetch.php

include('database_connection.php');


$query = '';

$output = array();

$query .= "SELECT * FROM review_table WHERE user_rating ='5'
";



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
    if ($row['user_rating'] == '5') {
        $rating = '⭐⭐⭐⭐⭐';
      } elseif ($row['user_rating'] == '4') {
        $rating = '⭐⭐⭐⭐';
      } elseif ($row['user_rating'] == '3') {
        $rating = '⭐⭐⭐';
      } elseif ($row['user_rating'] == '2') {
        $rating = '⭐⭐';
      } elseif ($row['user_rating'] == '1') {
        $rating = '⭐';
      } elseif ($row['user_rating'] == '0') {
        $rating = '😞';
      }
    $sub_array = array();
    $sub_array[] = '<center>'.$row['user_id'].'</center>';
    $sub_array[] = '<center><button type="button" name="user" id="'.$row["user_id"].'" class="btn btn-primary btn-sm user" data-id="'.$row["review_id"].'"><i class="fa fa-user"></i> View Customer</button></center>';
    $sub_array[] = '<center>'.$rating.'</center>';
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