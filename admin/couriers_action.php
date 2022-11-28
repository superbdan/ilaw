<?php

//couriers_action.php

include('database_connection.php');
$user = $_SESSION['type'];
if (isset($_POST['btn_action'])) {
	if ($_POST['btn_action'] == 'Add') {
		$query = "
		INSERT INTO couriers (courier_name, courier_fee, contact_no, address) 
		VALUES (:courier_name, :courier_fee, :contact_no, :address)
		";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':courier_name'	=>	$_POST["courier_name"],
				':courier_fee'	=>	$_POST["courier_fee"],
				':contact_no'	=>	$_POST["contact_no"],
				':address'	=>	$_POST["address"]
			)
		);
		$logquery = "
		INSERT INTO logs (action, user) 
		VALUES (:transaction_id, :user)
		";
		$logstmt = $connect->prepare($logquery);
		$logstmt->execute(
			array(
				':transaction_id'                => 'Added Courier '.$_POST["courier_name"].'',
				':user'                =>    $user,
			)
		);
		$result = $statement->fetchAll();
		if (isset($result)) {
			echo 'Courier Added Successfully!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
		}
	}

	if ($_POST['btn_action'] == 'fetch_single') {
		$query = "
		SELECT * FROM couriers WHERE courier_id = :courier_id
		";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':courier_id'	=>	$_POST["courier_id"]
			)
		);
		$result = $statement->fetchAll();
		foreach ($result as $row) {
			$output['courier_name'] = $row['courier_name'];
			$output['courier_fee'] = $row['courier_fee'];
			$output['contact_no'] = $row['contact_no'];
			$output['address'] = $row['address'];
		}
		echo json_encode($output);
	}
	if ($_POST['btn_action'] == 'Edit') {
		$query = "
		UPDATE couriers set 
		courier_name = :courier_name,
		courier_fee = :courier_fee, 
		contact_no = :contact_no, 
		address = :address
		WHERE courier_id = :courier_id
		";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':courier_name'	=>	$_POST["courier_name"],
				':courier_fee'	=>	$_POST["courier_fee"],
				':contact_no'	=>	$_POST["contact_no"],
				':address'	=>	$_POST["address"],
				':courier_id'		=>	$_POST["courier_id"]
			)
		);
		$logquery = "
		INSERT INTO logs (action, user) 
		VALUES (:transaction_id, :user)
		";
		$logstmt = $connect->prepare($logquery);
		$logstmt->execute(
			array(
				':transaction_id'                => 'Updated courier '.$_POST["courier_name"].'',
				':user'                =>    $user,
			)
		);
		$result = $statement->fetchAll();
		if (isset($result)) {
			echo 'Courier Edited Successfully!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
		}
	}

	if ($_POST['btn_action'] == 'delete') {
		$query = "
		DELETE FROM couriers WHERE courier_id = :courier_id
		";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':courier_id'		=>	$_POST["courier_id"]
			)
		);
		$logquery = "
		INSERT INTO logs (action, user) 
		VALUES (:transaction_id, :user)
		";
		$logstmt = $connect->prepare($logquery);
		$logstmt->execute(
			array(
				':transaction_id'                => 'Removed Courier '.$_POST["status"].'',
				':user'                =>    $user,
			)
		);
		$result = $statement->fetchAll();
		if (isset($result)) {
			echo 'Courier Removed! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
		}
	}
}
