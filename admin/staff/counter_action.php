<?php
include('database_connection.php');
$user = $_SESSION['type'];
date_default_timezone_set('Asia/Manila');


if ($_POST['btn_action'] == 'courier') {

    $query = "
        UPDATE customer_order
        SET status = :status 
        WHERE transaction_id = :transaction_id
        ";
    $statement = $connect->prepare($query);
    $statement->execute(
        array(
            ':status'    =>    "2",
            ':transaction_id'    =>    $_POST['transaction_id']

        )
    );
    $result = $statement->fetchAll();
    $query = "

            UPDATE order_tracking SET order_shipped_out = :time
            WHERE transaction_id = :transaction_id
            ";
    $statement = $connect->prepare($query);
    $statement->execute(
        array(
            ':transaction_id'                =>    $_POST["transaction_id"],
            ':time'                =>    $_POST["time"],
        )
    );
    $logquery = "
    INSERT INTO logs (action, user) 
    VALUES (:transaction_id, :user)
    ";
    $logstmt = $connect->prepare($logquery);
    $logstmt->execute(
        array(
            ':transaction_id'                => 'Parcel ' .$_POST['transaction_id']. ' has been sent to courier' ,
            ':user'                =>    $user,
        )
    );
    if (isset($result)) {
        echo '<div class="alert alert-success">Order Transfered<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
    }
}


if ($_POST['btn_action'] == 'completed') {

    $query = "
    UPDATE customer_order
    SET status = :status 
    WHERE transaction_id = :transaction_id
    ";
    $statement = $connect->prepare($query);
    $statement->execute(
        array(
            ':status'    =>    "3",
            ':transaction_id'    =>    $_POST['transaction_id']

        )
    );
    $result = $statement->fetchAll();
    $query = "

            UPDATE order_tracking SET order_completed = :time
            WHERE transaction_id = :transaction_id
            ";
    $statement = $connect->prepare($query);
    $statement->execute(
        array(
            ':transaction_id'                =>    $_POST["transaction_id"],
            ':time'                =>    date("Y-m-d H:i:sa"),
        )
    );
    $logquery = "
    INSERT INTO logs (action, user) 
    VALUES (:transaction_id, :user)
    ";
    $logstmt = $connect->prepare($logquery);
    $logstmt->execute(
        array(
            ':transaction_id'                => 'Parcel ' .$_POST['transaction_id']. ' has been set completed' ,
            ':user'                =>    $user,
        )
    );

    if (isset($result)) {
        echo '<div class="alert alert-success">Order Completed<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
    }
}
