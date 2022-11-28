<?php

//order_action.php

include('database_connection.php');

include('../function.php');

if (isset($_POST['btn_action'])) {
    if ($_POST['btn_action'] == 'Add') {
        $query = "
		INSERT INTO customer_order (transaction_id, customer_id, customer_name, customer_no, address, status, date_created) 
		VALUES (:transaction_id, :customer_id, :customer_name, :customer_no, :address, :status, :date_created)
		";
        $statement = $connect->prepare($query);
        $statement->execute(
            array(
                ':transaction_id'                =>    $_POST["transaction_id"],
                ':customer_id'                   =>    $_POST["customer_id"],
                ':customer_name'                 =>    $_POST['customer_name'],
                ':customer_no'                   =>    $_POST['customer_no'],
                ':address'                       =>    $_POST['order_address'],
                ':status'                        =>    '0',
                ':date_created'                  =>    date("Y-m-d")
            )
        );
        $result = $statement->fetchAll();

        foreach ($_POST['product_name'] as $key => $value) {
            // $price = $_POST['product_price'];
            // $qty = $_POST['quantity'];
            // $sum = $price * $qty;
            $query = "INSERT INTO customer_order_product(transaction_id, product_name, unit, quantity, price, total)VALUES(:transaction_id,:product_name,:unit,:quantity, :price, :total_cost);";
            $stmt = $connect->prepare($query);
            $stmt->execute([
                'transaction_id' => $_POST['transaction_id'],
                'product_name' => $value,
                'unit' => $_POST['unit'][$key],
                'quantity' => $_POST['quantity'][$key],
                'price' => $_POST['product_price'][$key],
                'total_cost' => $_POST['total_cost'][$key]
                
            ]);
        }

        $query = "
		INSERT INTO order_tracking (transaction_id, order_received) 
		VALUES (:transaction_id, :time)
		";
        $statement = $connect->prepare($query);
        $statement->execute(
            array(
                ':transaction_id'                =>    $_POST["transaction_id"],
                ':time'                =>    $_POST["time"],
            )
        );




        if (isset($result)) {
            echo 'Customer was added <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
            echo $_POST["transaction_id"];
        }
    }
}
