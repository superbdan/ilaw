<?php

//category_action.php

include('database_connection.php');
$user = $_SESSION['type'];
$user_name = $_SESSION['name'];
if (isset($_POST['btn_action'])) {
    if ($_POST['btn_action'] == 'validate') {
        $query = "
        UPDATE customer_order
        SET payment_status = :payment_status 
        WHERE transaction_id = :transaction_id
        
		";
        $statement = $connect->prepare($query);
        $statement->execute(
            array(
                ':payment_status'    =>    "validated",
                ':transaction_id'    =>    $_POST['transaction_id']

            )
        );

        $logquery = "
		INSERT INTO logs (action, user) 
		VALUES (:transaction_id, :user)
		";
        $logstmt = $connect->prepare($logquery);
        $logstmt->execute(
            array(
                ':transaction_id'                => 'Order ' . $_POST["transaction_id"] . ' has been validated',
                ':user'                =>    $user,
            )
        );

        $result = $statement->fetchAll();
        if (isset($result)) {
            echo 'Proof Validated Succesfully ! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
        }
    }

    if ($_POST['btn_action'] == 'invalidate') {
        $query = "
        UPDATE customer_order
        SET payment_status = :payment_status 
        WHERE transaction_id = :transaction_id
        
		";
        $statement = $connect->prepare($query);
        $statement->execute(
            array(
                ':payment_status'    =>    "invalidated",
                ':transaction_id'    =>    $_POST['transaction_id']

            )
        );
        $logquery = "
		INSERT INTO logs (action, user) 
		VALUES (:transaction_id, :user)
		";
        $logstmt = $connect->prepare($logquery);
        $logstmt->execute(
            array(
                ':transaction_id'                => 'Order ' . $_POST["transaction_id"] . ' has been Invalidated',
                ':user'                =>    $user,
            )
        );
        $result = $statement->fetchAll();
        if (isset($result)) {
            echo 'Proof Invalidated! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
        }
    }

    if ($_POST['btn_action'] == 'process') {
        if ($_POST['status'] == 'pending') {
            echo '<div class="alert alert-warning"> Validate the Proof of Payment <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
        } elseif ($_POST['status'] == 'invalidated') {
            echo '<div class="alert alert-danger">The proof of payment is invalid<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
        } elseif ($_POST['status'] == 'validated') {

            $query = "
            UPDATE customer_order
            SET status = :status 
            WHERE transaction_id = :transaction_id
            ";
            $statement = $connect->prepare($query);
            $statement->execute(
                array(
                    ':status'    =>    "1",
                    ':transaction_id'    =>    $_POST['transaction_id']

                )
            );
            $result = $statement->fetchAll();
            $query = "

            UPDATE order_tracking SET order_confirmed = :time
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
                    ':transaction_id'                => 'Order ' . $_POST["transaction_id"] . ' has been Processed',
                    ':user'                =>    $user,
                )
            );
            

            if (isset($result)) {
                echo '<div class="alert alert-success">Order Confirmed<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
            }
        }
    }

    if ($_POST['btn_action'] == 'cancel') {

        $query = "
            UPDATE customer_order
            SET status = :status 
            WHERE transaction_id = :transaction_id
            ";
        $statement = $connect->prepare($query);
        $statement->execute(
            array(
                ':status'    =>    "4",
                ':transaction_id'    =>    $_POST['transaction_id']

            )
        );

		$query = "SELECT * FROM customer_order_product WHERE transaction_id = :transaction_id";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':transaction_id'	=>	$_POST["transaction_id"]
			)
		);
        $result = $statement->fetchAll();
       
        foreach($result as $row)
        {
			$items_id = $row["product_id"];
            $quantity = $row["quantity"];

            $stocksquery = "SELECT * FROM `items` WHERE items_id = '$items_id'";
			$statement = $connect->prepare($stocksquery);
			$statement->execute();
			$result1 = $statement->fetchAll();

            $items_status;
			$stocks_latest;

			foreach($result1 as $row)  {
                $items_name = $row["items_name"];
				$items_stocks = $row["items_stocks"];
                $items_low = $row["items_low"];
                $target_stocks = $row["target_stocks"];
			}

            $stocks_latest = $items_stocks + $quantity;
            if ($stocks_latest <= $items_low){
                $items_status = "Critical";
            } elseif ($stocks_latest <= $items_low * 2){
                $items_status = "Warning";
            } elseif ($stocks_latest >= $target_stocks){
                $items_status = "Full";
            } else {
                $items_status = "Good";
            }
			$updatequery = "UPDATE `items` SET `items_stocks`='$stocks_latest',`stock_status`='$items_status' WHERE items_id = '$items_id'";
			$stmt = $connect->prepare($updatequery);
			$stmt->execute();

            if ($user=='master'){
                $user_type = 'Admin: ';
            } elseif ($user=='staff'){
                $user_type = 'Staff: ';
            } else{
                $user_type = 'Customer: ';
            }
            $stock_logs = "
            INSERT INTO stock_logs (item_name, stock_quantity, incharge, type, activity) 
            VALUES (:item_name, :quantity, :user, '1', 'cancelled order')
            ";
            $stockstmt = $connect->prepare($stock_logs);
            $stockstmt->execute(
                array(
                    ':item_name'                => $items_name,
                    ':user'                =>   $user_type.''.$user_name,
                    ':quantity'                =>    $quantity,
                )
            );
		}

 

        $logquery = "
		INSERT INTO logs (action, user) 
		VALUES (:transaction_id, :user)
		";
        $logstmt = $connect->prepare($logquery);
        $logstmt->execute(
            array(
                ':transaction_id'                => 'Order ' . $_POST["transaction_id"] . ' has been Cancelled',
                ':user'                =>    $user,
            )
        );
        $result = $statement->fetchAll();
        if (isset($result)) {
            echo '<div class="alert alert-danger">Order is Cancelled<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
        }
    }








    // if($_POST['btn_action'] == 'fetch_single')
    // {
    // 	$query = "SELECT * FROM category WHERE category_id = :category_id";
    // 	$statement = $connect->prepare($query);
    // 	$statement->execute(
    // 		array(
    // 			':category_id'	=>	$_POST["category_id"]
    // 		)
    // 	);
    // 	$result = $statement->fetchAll();
    // 	foreach($result as $row)
    // 	{
    // 		$output['category_name'] = $row['category_name'];
    // 	}
    // 	echo json_encode($output);
    // }

    // if($_POST['btn_action'] == 'Edit')
    // {
    // 	$query = "
    // 	UPDATE category set category_name = :category_name  
    // 	WHERE category_id = :category_id
    // 	";
    // 	$statement = $connect->prepare($query);
    // 	$statement->execute(
    // 		array(
    // 			':category_name'	=>	$_POST["category_name"],
    // 			':category_id'		=>	$_POST["category_id"]
    // 		)
    // 	);
    // 	$result = $statement->fetchAll();
    // 	if(isset($result))
    // 	{
    // 		echo 'Category Edited Successfully!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
    // 	}
    // }
    // if($_POST['btn_action'] == 'delete')
    // {
    // 	$status = 'Active';
    // 	if($_POST['status'] == 'active')
    // 	{
    // 		$status = 'Inactive';	
    // 	}
    // 	$query = "
    // 	UPDATE category 
    // 	SET category_status = :category_status 
    // 	WHERE category_id = :category_id
    // 	";
    // 	$statement = $connect->prepare($query);
    // 	$statement->execute(
    // 		array(
    // 			':category_status'	=>	$status,
    // 			':category_id'		=>	$_POST["category_id"]
    // 		)
    // 	);
    // 	$result = $statement->fetchAll();
    // 	if(isset($result))
    // 	{
    // 		echo 'Category Status Change to <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>' . $status;
    // 	}
    // }
}
