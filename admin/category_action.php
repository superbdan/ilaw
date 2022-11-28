<?php

//category_action.php

include('database_connection.php');
$user = $_SESSION['type'];
if(isset($_POST['btn_action']))
{
	if($_POST['btn_action'] == 'Add')
	{
		$query = "
		INSERT INTO category (category_name) 
		VALUES (:category_name)
		";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':category_name'	=>	$_POST["category_name"]
			)
		);
		$logquery = "
		INSERT INTO logs (action, user) 
		VALUES (:transaction_id, :user)
		";
        $logstmt = $connect->prepare($logquery);
        $logstmt->execute(
            array(
                ':transaction_id'                => 'Added Category '.$_POST["category_name"].'',
                ':user'                =>    $user,
            )
        );
		$result = $statement->fetchAll();
		if(isset($result))
		{
			echo 'Category Added Successfully! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
		}
	}
	
	if($_POST['btn_action'] == 'fetch_single')
	{
		$query = "SELECT * FROM category WHERE category_id = :category_id";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':category_id'	=>	$_POST["category_id"]
			)
		);
		$result = $statement->fetchAll();
		foreach($result as $row)
		{
			$output['category_name'] = $row['category_name'];
		}
		echo json_encode($output);
	}

	if($_POST['btn_action'] == 'Edit')
	{
		$query = "
		UPDATE category set category_name = :category_name  
		WHERE category_id = :category_id
		";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':category_name'	=>	$_POST["category_name"],
				':category_id'		=>	$_POST["category_id"]
			)
		);
		$logquery = "
		INSERT INTO logs (action, user) 
		VALUES (:transaction_id, :user)
		";
        $logstmt = $connect->prepare($logquery);
        $logstmt->execute(
            array(
                ':transaction_id'                => 'Updated Category '.$_POST['name'].' to '.$_POST["category_name"].'',
                ':user'                =>    $user,
            )
        );
		$result = $statement->fetchAll();
		if(isset($result))
		{
			echo 'Category Edited Successfully!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
		}
	}
	if($_POST['btn_action'] == 'delete')
	{
		$status = 'Active';
		if($_POST['status'] == 'active')
		{
			$status = 'Inactive';	
		}
		$query = "
		UPDATE category 
		SET category_status = :category_status 
		WHERE category_id = :category_id
		";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':category_status'	=>	$status,
				':category_id'		=>	$_POST["category_id"]
			)
		);
		$logquery = "
		INSERT INTO logs (action, user) 
		VALUES (:transaction_id, :user)
		";
        $logstmt = $connect->prepare($logquery);
        $logstmt->execute(
            array(
                ':transaction_id'                => 'Changed A Category Status',
                ':user'                =>    $user,
            )
        );
		$result = $statement->fetchAll();
		if(isset($result))
		{
			echo 'Category Status Change to <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>' . $status;
		}
	}
}
