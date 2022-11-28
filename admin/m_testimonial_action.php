<?php

//supplier_action.php

include('database_connection.php');
$user = $_SESSION['type'];
if (isset($_POST['btn_action'])) {
	if ($_POST['btn_action'] == 'Add') {
		$target_dir = "testimony_images/";
		$fileTmpPath = $_FILES['testimony_img']['tmp_name'];
		$target_file = $target_dir . basename($_FILES["testimony_img"]["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
		// Check if image file is a actual image or fake image
		if (move_uploaded_file($fileTmpPath, $target_file)) {
			$message = 'File is successfully uploaded.';
		} else {
			$message = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
		}


		$query = "
		INSERT INTO testimonies (image, name, title, feedback, rating) 
		VALUES (:image, :name, :title, :feedback, :rating)
		";

		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':image'	=>	basename($_FILES["testimony_img"]["name"]),
				':name'	=>	$_POST["name"],
				':title'	=>	$_POST["title"],
				':feedback'	=>	$_POST["feedback"],
				':rating'	=>	$_POST["rating"],


			)
		);
		$logquery = "
		INSERT INTO logs (action, user) 
		VALUES (:transaction_id, :user)
		";
		$logstmt = $connect->prepare($logquery);
		$logstmt->execute(
			array(
				':transaction_id'                => 'Added a Testimony',
				':user'                =>    $user,
			)
		);
		$result = $statement->fetchAll();
		if (isset($result)) {
			echo 'Testimony is Added Successfully!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
		}
	}

	if ($_POST['btn_action'] == 'fetch_single') {
		$query = "
		SELECT * FROM testimonies WHERE id = :id
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
			$output['title'] = $row['title'];
			$output['feedback'] = $row['feedback'];
			$output['rating'] = $row['rating'];
		}
		echo json_encode($output);
	}

	if ($_POST['btn_action'] == 'Edit') {
		$target_dir = "testimony_images/";
		$fileTmpPath = $_FILES['testimony_img']['tmp_name'];
		$target_file = $target_dir . basename($_FILES["testimony_img"]["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
		// Check if image file is a actual image or fake image
		if (move_uploaded_file($fileTmpPath, $target_file)) {
			$message = 'File is successfully uploaded.';
		} else {
			$message = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
		}


		$query = "
		UPDATE testimonies set image = :image, name = :name, title = :title, feedback = :feedback, rating = :rating
		WHERE id = :id
		";

		$statement = $connect->prepare($query);
		$statement->execute(
			array(

				':image'	=>	basename($_FILES["testimony_img"]["name"]),
				':name'	=>	$_POST["name"],
				':title'	=>	$_POST["title"],
				':feedback'	=>	$_POST["feedback"],
				':rating'	=>	$_POST["rating"],
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
				':transaction_id'                => 'Edited a Testimony',
				':user'                =>    $user,
			)
		);
		$result = $statement->fetchAll();
		if (isset($result)) {
			echo 'A testimony is Updated Successfully!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
		}
	}

	if ($_POST['btn_action'] == 'delete') {
		$query = "
		DELETE FROM testimonies WHERE id = :id
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
				':transaction_id'                => 'Deleted a Testimony',
				':user'                =>    $user,
			)
		);
		$result = $statement->fetchAll();
		if (isset($result)) {
			echo 'A Testimony has been Removed!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
		}
	}
}
