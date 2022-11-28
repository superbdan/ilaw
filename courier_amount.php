<?php
include("connection.php");

if (isset($_POST['courierId'])) {
    $courierId = $_POST['courierId'];
    $query = mysqli_query($con, "select * from couriers where courier_id ='$courierId'");
    while ($row = mysqli_fetch_assoc($query)) {
        $courier_price =  $row["courier_fee"];
        echo "₱".''.number_format($courier_price,2);
    }
}

