<?php

//supplier_action.php

include('database_connection.php');
$user = $_SESSION['type'];
if (isset($_POST['btn_action'])) {
	if ($_POST['btn_action'] == 'Add') {
		$target_dir = "team_member/";
		$fileTmpPath = $_FILES['team_img']['tmp_name'];
		$target_file = $target_dir . basename($_FILES["team_img"]["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
		// Check if image file is a actual image or fake image
		if (move_uploaded_file($fileTmpPath, $target_file)) {
			$message = 'File is successfully uploaded.';
		} else {
			$message = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
		}



		$query = "
		INSERT INTO company_team (image, name, role, description) 
		VALUES (:image, :name, :role, :description)
		";

		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':image'	=>	basename($_FILES["team_img"]["name"]),
				':name'	=>	$_POST["name"],
				':role'	=>	$_POST["role"],
				':description'	=>	$_POST["description"],

			)
		);
		$logquery = "
		INSERT INTO logs (action, user) 
		VALUES (:transaction_id, :user)
		";
		$logstmt = $connect->prepare($logquery);
		$logstmt->execute(
			array(
				':transaction_id'                => 'Added a New Team Member',
				':user'                =>    $user,
			)
		);
		$result = $statement->fetchAll();
		if (isset($result)) {
			echo 'A Team Member is Added Successfully!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
		}
	}

	if ($_POST['btn_action'] == 'fetch_single') {
		$query = "
		SELECT * FROM company_team WHERE id = :id
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
			$output['name'] = $row['name'];
			$output['role'] = $row['role'];
			$output['description'] = $row['description'];
		}
		echo json_encode($output);
	}

	if ($_POST['btn_action'] == 'Edit') {
		$target_dir = "team_member/";
		$fileTmpPath = $_FILES['team_img']['tmp_name'];
		$target_file = $target_dir . basename($_FILES["team_img"]["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
		// Check if image file is a actual image or fake image
		if (move_uploaded_file($fileTmpPath, $target_file)) {
			$message = 'File is successfully uploaded.';
		} else {
			$message = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
		}

		$query = "
		UPDATE company_team set image = :image, name = :name, role = :role, description = :description
		WHERE id = :id
		";

		$statement = $connect->prepare($query);
		$statement->execute(
			array(

				':image'	=>	basename($_FILES["team_img"]["name"]),
				':name'	=>	$_POST["name"],
				':role'	=>	$_POST["role"],
				':description'	=>	$_POST["description"],
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
				':transaction_id'                => 'Edited A Team Member',
				':user'                =>    $user,
			)
		);
		$result = $statement->fetchAll();
		if (isset($result)) {
			echo 'A Team Member is Edited Successfully!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
		}
	}

	if ($_POST['btn_action'] == 'delete') {
		$query = "
		DELETE FROM company_team WHERE id = :id
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
				':transaction_id'                => 'Removed A Team Member',
				':user'                =>    $user,
			)
		);
		$result = $statement->fetchAll();
		if (isset($result)) {
			echo 'Member Removed!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
		}
	}
}
