<?php
include("../connection.php");

if (isset($_POST['courier'])) {
    $courier = $_POST['courier'];
    $query = mysqli_query($con, "select * from couriers where courier_id ='$courier'");
    while ($row = mysqli_fetch_assoc($query)) {
        $courier_price['courier_fee'] =  $row["courier_fee"];
        
        echo json_encode($courier_price);
        // echo '<option value="'.$row["courier_fee"].'">'.$row["courier_fee"].'</option>';
    }
}
