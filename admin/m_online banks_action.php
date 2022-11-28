<?php

//supplier_action.php

include('database_connection.php');
$user = $_SESSION['type'];
if (isset($_POST['btn_action'])) {
	if ($_POST['btn_action'] == 'Add') {
		$target_dir = "online_bank/";
		$fileTmpPath = $_FILES['bank_img']['tmp_name'];
		$target_file = $target_dir . basename($_FILES["bank_img"]["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
		// Check if image file is a actual image or fake image
		if (move_uploaded_file($fileTmpPath, $target_file)) {
			$message = 'File is successfully uploaded.';
		} else {
			$message = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
		}


		$query = "
		INSERT INTO online_banking (image, name, number) 
		VALUES (:image,  :name, :number)
		";

		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':image'	=>	basename($_FILES["bank_img"]["name"]),
				':name'	=>	$_POST["bank_name"],
				':number'	=>	$_POST["bank_details"],


			)
		);
		$logquery = "
		INSERT INTO logs (action, user) 
		VALUES (:transaction_id, :user)
		";
		$logstmt = $connect->prepare($logquery);
		$logstmt->execute(
			array(
				':transaction_id'                => 'Added a New Online Bank',
				':user'                =>    $user,
			)
		);
		$result = $statement->fetchAll();
		if (isset($result)) {
			echo 'A Bank is Added Successfully!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
		}
	}

	if ($_POST['btn_action'] == 'fetch_single') {
		$query = "
		SELECT * FROM online_banking WHERE id = :id
		";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':id'	=>	$_POST["id"]
			)
		);
		$result = $statement->fetchAll();
		foreach ($result as $row) {
			$output['image'] = $row['image'];
			$output['bank_name'] = $row['name'];
			$output['bank_details'] = $row['number'];
		}
		echo json_encode($output);
	}

	if ($_POST['btn_action'] == 'Edit') {
		$target_dir = "online_bank/";
		$fileTmpPath = $_FILES['bank_img']['tmp_name'];
		$target_file = $target_dir . basename($_FILES["bank_img"]["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
		// Check if image file is a actual image or fake image
		if (move_uploaded_file($fileTmpPath, $target_file)) {
			$message = 'File is successfully uploaded.';
		} else {
			$message = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
		}

		$query = "
		UPDATE online_banking set image = :image, name = :name, number = :number
		WHERE id = :id
		";

		$statement = $connect->prepare($query);
		$statement->execute(
			array(

				':image'	=>	basename($_FILES["bank_img"]["name"]),
				':name'	=>	$_POST["bank_name"],
				':number'	=>	$_POST["bank_details"],
				':id' => $_POST["id"]
			)
		);
		$logquery = "
		INSERT INTO logs (action, user) 
		VALUES (:transaction_id, :user)
		";
		$logstmt = $connect->prepare($logquery);
		$logstmt->execute(
			array(
				':transaction_id'                => 'Edited Online Bank',
				':user'                =>    $user,
			)
		);
		$result = $statement->fetchAll();
		if (isset($result)) {
			echo 'Online Banking Updated Successfully!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
		}
	}

	if ($_POST['btn_action'] == 'delete') {
		$query = "
		DELETE FROM online_banking WHERE id = :id
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
				':transaction_id'                => 'Removed an Online Bank',
				':user'                =>    $user,
			)
		);
		$result = $statement->fetchAll();
		if (isset($result)) {
			echo 'Bank has been Removed!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
		}
	}
}
