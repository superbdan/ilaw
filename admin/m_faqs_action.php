<?php

include('database_connection.php');
$user = $_SESSION['type'];
if (isset($_POST['btn_action'])) {
	if ($_POST['btn_action'] == 'Add') {

		$query = "
		INSERT INTO faqs (question, answer) 
		VALUES (:question, :answer)
		";

		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':question'	=>	$_POST["question"],
				':answer'	=>	$_POST["answer"],

			)
		);
		$logquery = "
		INSERT INTO logs (action, user) 
		VALUES (:transaction_id, :user)
		";
		$logstmt = $connect->prepare($logquery);
		$logstmt->execute(
			array(
				':transaction_id'                => 'Added a Frequently Asked Question',
				':user'                =>    $user,
			)
		);
		$result = $statement->fetchAll();
		if (isset($result)) {
			echo 'Question Added Successfully!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
		}
	}

	if ($_POST['btn_action'] == 'fetch_single') {
		$query = "
		SELECT * FROM faqs WHERE id = :id
		";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':id'	=>	$_POST["id"]
			)
		);
		$result = $statement->fetchAll();
		foreach ($result as $row) {
			$output['question'] = $row['question'];
			$output['answer'] = $row['answer'];
		}
		echo json_encode($output);
	}

	if ($_POST['btn_action'] == 'Edit') {
		$query = "
		UPDATE faqs set question = :question, answer = :answer
		WHERE id = :id
		";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(

				':question'	=>	$_POST["question"],
				':answer'	=>	$_POST["answer"],
				':id' => $_POST["id"],

			)
		);

		$logquery = "
		INSERT INTO logs (action, user) 
		VALUES (:transaction_id, :user)
		";
		$logstmt = $connect->prepare($logquery);
		$logstmt->execute(
			array(
				':transaction_id'                => 'Edited a Frequently Asked Question',
				':user'                =>    $user,
			)
		);
		$result = $statement->fetchAll();
		if (isset($result)) {
			echo 'Question Edited Successfully!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
		}
	}

	if ($_POST['btn_action'] == 'delete') {
		$query = "
		DELETE FROM faqs WHERE id = :id
		";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':id'		=>	$_POST["id"]
			)
		);
		$logquery = "
		INSERT INTO logs (action, user) 
		VALUES (:transaction_id, :user)
		";
		$logstmt = $connect->prepare($logquery);
		$logstmt->execute(
			array(
				':transaction_id'                => 'Deleted a Frequently Asked Question',
				':user'                =>    $user,
			)
		);
		$result = $statement->fetchAll();
		if (isset($result)) {
			echo 'Question Removed!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
		}
	}
}
