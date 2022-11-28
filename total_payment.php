<?php
include("database_connection.php");

if (isset($_POST['courierId'])) {
    $courierId = $_POST['courierId'];
    $query = "select * from couriers where courier_id ='$courierId'";
    $statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    foreach($result as $row) {
        $courier_price =  $row["courier_fee"];

    }
}


if (isset($_POST['paymentId'])) {
    $query = "SELECT a.items_id,a.items_name,a.items_price,a.product_img1,b.id,b.qty FROM items a,cart b WHERE a.items_id=b.p_id AND b.user_id='$_SESSION[uid]'";
    $statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $n=0;
    $total_price = 0;
    foreach($result as $row) {
        $n++;
        $qty = $row["qty"];
        $subtotal = $row["qty"] * $row["items_price"];
        $total = $subtotal + $subtotal;
        $total_price += $subtotal;
        $total_payment = $total_price + $courier_price;

       
    }
    echo "₱".''.number_format($total_payment,2);
}