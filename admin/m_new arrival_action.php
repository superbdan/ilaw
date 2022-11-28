<?php

//supplier_action.php

include('database_connection.php');
$user = $_SESSION['type'];
if(isset($_POST['btn_action']))
{
	if($_POST['btn_action'] == 'Add')
	{	
		$items_id = $_POST["items_id"];
		
		$query = "
		UPDATE items set new_arrival = '1'
		WHERE items_id = $items_id
		";
		$statement = $connect->prepare($query);
		$statement->execute();

		$logquery = "
		INSERT INTO logs (action, user) 
		VALUES (:transaction_id, :user)
		";
		$logstmt = $connect->prepare($logquery);
		$logstmt->execute(
			array(
				':transaction_id'                => 'Added a New Arrival Item',
				':user'                =>    $user,
			)
		);
		$result = $statement->fetchAll();
		if(isset($result))
		{
			echo 'A New Released Item is Added Successfully!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
		}
	}

	if($_POST['btn_action'] == 'fetch_single')
	{
		$query = "
		SELECT * FROM new_arrival WHERE id = :id
		";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':id'	=>	$_POST["id"]
			)
		);
		$result = $statement->fetchAll();
		foreach($result as $row)
		{
            $output['image1'] = $row['image1'];
            $output['image2'] = $row['image2'];
			$output['name'] = $row['name'];
			$output['category'] = $row['category'];
            $output['price'] = $row['price'];


		}
		echo json_encode($output);
	}

	if($_POST['btn_action'] == 'delete')
	{
		$items_id = $_POST["id"];
		
		$query = "
		UPDATE items set new_arrival = '0'
		WHERE items_id = $items_id
		";

		$statement = $connect->prepare($query);
		$statement->execute();

		$logquery = "
		INSERT INTO logs (action, user) 
		VALUES (:transaction_id, :user)
		";
		$logstmt = $connect->prepare($logquery);
		$logstmt->execute(
			array(
				':transaction_id'                => 'Deleted a New Arrival Item',
				':user'                =>    $user,
			)
		);
		$result = $statement->fetchAll();
		if(isset($result))
		{
			echo 'New Arrival has been Removed!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
		}
	}
}
