<?php

//measurement_action.php

include('database_connection.php');
$user = $_SESSION['type'];
if (isset($_POST['btn_action'])) {
	if ($_POST['btn_action'] == 'Add') {
		$query = "
		INSERT INTO measurement (measurement_name) 
		VALUES (:measurement_name)
		";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':measurement_name'	=>	$_POST["measurement_name"]
			)
		);
		$logquery = "
		INSERT INTO logs (action, user) 
		VALUES (:transaction_id, :user)
		";
		$logstmt = $connect->prepare($logquery);
		$logstmt->execute(
			array(
				':transaction_id'                => 'Added a new Measurement '.$_POST["measurement_name"].'',
				':user'                =>    $user,
			)
		);
		$result = $statement->fetchAll();
		if (isset($result)) {
			echo 'Unit of Measurement Added <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
		}
	}

	if ($_POST['btn_action'] == 'fetch_single') {
		$query = "SELECT * FROM measurement WHERE measurement_id = :measurement_id";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':measurement_id'	=>	$_POST["measurement_id"]
			)
		);
		$result = $statement->fetchAll();
		foreach ($result as $row) {
			$output['measurement_name'] = $row['measurement_name'];
		}
		echo json_encode($output);
	}

	if ($_POST['btn_action'] == 'Edit') {
		$query = "
		UPDATE measurement set measurement_name = :measurement_name  
		WHERE measurement_id = :measurement_id
		";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':measurement_name'	=>	$_POST["measurement_name"],
				':measurement_id'		=>	$_POST["measurement_id"]
			)
		);
		$logquery = "
		INSERT INTO logs (action, user) 
		VALUES (:transaction_id, :user)
		";
		$logstmt = $connect->prepare($logquery);
		$logstmt->execute(
			array(
				':transaction_id'                => 'Edited Measurement '.$_POST["name"].' to '.$_POST["measurement_name"].'',
				':user'                =>    $user,
			)
		);
		$result = $statement->fetchAll();
		if (isset($result)) {
			echo 'Unit of Measurement Edited Successfully!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
		}
	}
	if ($_POST['btn_action'] == 'delete') {
		$status = 'Active';
		if ($_POST['status'] == 'active') {
			$status = 'Inactive';
		}
		$query = "
		UPDATE measurement 
		SET measurement_status = :measurement_status 
		WHERE measurement_id = :measurement_id
		";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':measurement_status'	=>	$status,
				':measurement_id'		=>	$_POST["measurement_id"]
			)
		);
		$logquery = "
		INSERT INTO logs (action, user) 
		VALUES (:transaction_id, :user)
		";
		$logstmt = $connect->prepare($logquery);
		$logstmt->execute(
			array(
				':transaction_id'                => 'Changed A Measurement Status',
				':user'                =>    $user,
			)
		);
		$result = $statement->fetchAll();
		if (isset($result)) {
			echo 'Unit of Measurement Status Change to <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>' . $status;
		}
	}
}
