<?php

// submit_rating.php
include('database_connection.php');

include('connection.php');

if (isset($_POST["rate"])) {
	if (isset($_FILES['fileImg']['name'])) {

		$totalFiles = count($_FILES['fileImg']['name']);
		$filesArray = array();

		for ($i = 0; $i < $totalFiles; $i++) {
			$imageName = $_FILES["fileImg"]["name"][$i];
			$tmpName = $_FILES["fileImg"]["tmp_name"][$i];

			$imageExtension = explode('.', $imageName);

			$name = $imageExtension[0];
			$imageExtension = strtolower(end($imageExtension));

			$newImageName = $name; // Generate new image name
			if (empty($newImageName)) {
				$newImageName = 'No Image';
			}

			if (empty($imageExtension)) {
				$imageExtension = 'jpg';
			}
			$newImageName .= '.' . $imageExtension;

			move_uploaded_file($tmpName, 'images/review-upload/' . $newImageName);
			$filesArray[] = $newImageName;
		}

		$filesArray = json_encode($filesArray);

		$query = "
			INSERT INTO review_table 
			(user_name, user_id, user_rating, title_review, user_review, review_img) 
			VALUES (:user_name, :user_id, :user_rating, :title_review, :user_review, :image)
			";

		$statement = $connect->prepare($query);

		$statement->execute(
			array(
				':user_name'		=>	$_POST["user_name"],
				':user_id' 			=> $_POST["user_id"],
				':user_rating'		=>	$_POST["rate"],
				':title_review'		=>	$_POST["title_review"],
				':user_review'		=>	$_POST["user_review"],
				':image' 			=> $filesArray
			)
		);


		$query = "

			UPDATE customer_order SET rate = :rate
			WHERE transaction_id = :transaction_id
		";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':transaction_id'      =>    $_POST["order_id"],
				':rate'                =>   '1',
			)
		);



		echo "Your Review & Rating Successfully Submitted";
	}



























	// }
	// if (isset($_FILES["fileImg"]["name"])) {
	// 	$totalFiles = count($_FILES['fileImg']['name']);
	// 	$filesArray = array();

	// 	for ($i = 0; $i < $totalFiles; $i++) {
	// 		$imageName = $_FILES["fileImg"]["name"][$i];
	// 		$tmpName = $_FILES["fileImg"]["tmp_name"][$i];

	// 		$imageExtension = explode('.', $imageName);

	// 		$name = $imageExtension[0];
	// 		$imageExtension = strtolower(end($imageExtension));

	// 		$newImageName = $name . " - " . uniqid(); // Generate new image name
	// 		$newImageName .= '.' . $imageExtension;

	// 		move_uploaded_file($tmpName, 'images/review-upload/' . $newImageName);
	// 		$filesArray[] = $newImageName;
	// 	}

	// 	$filesArray = json_encode($filesArray);

	// 	$data = array(
	// 		':user_name'		=>	$_POST["user_name"],
	// 		':user_id' 			=> $_POST["user_id"],
	// 		':user_rating'		=>	$_POST["rate"],
	// 		':title_review'		=>	$_POST["title_review"],
	// 		':user_review'		=>	$_POST["user_review"],
	// 		':image' 			=> $filesArray
	// 	);

	// 	$query = "
	// 	INSERT INTO review_table 
	// 	(user_name, user_id, user_rating, title_review, user_review, review_img) 
	// 	VALUES (:user_name, :user_id, :user_rating, :title_review, :user_review, :image)
	// 	";

	// 	$statement = $connect->prepare($query);

	// 	$statement->execute($data);

	// 	echo "Your Review & Rating Successfully Submitted";
	// }else{
	// 	echo "Please Fill Out The Form!";
}



// if (isset($_POST["rating_data"])) {

// 	$data = array(
// 		':user_name'		=>	$_POST["user_name"],
// 		':user_id' 			=> $_POST["user_id"],
// 		':user_rating'		=>	$_POST["rating_data"],
// 		':title_review'		=>	$_POST["title_review"],
// 		':user_review'		=>	$_POST["user_review"]
// 	);

// 	$query = "
// 	INSERT INTO review_table 
// 	(user_name, user_id, user_rating, title_review, user_review) 
// 	VALUES (:user_name, :user_id, :user_rating, :title_review, :user_review)
// 	";

// 	$statement = $connect->prepare($query);

// 	$statement->execute($data);


// 	echo "Your Review & Rating Successfully Submitted";
// }









if (isset($_POST["action"])) {


	$average_rating = 0;
	$total_review = 0;
	$five_star_review = 0;
	$four_star_review = 0;
	$three_star_review = 0;
	$two_star_review = 0;
	$one_star_review = 0;
	$total_user_rating = 0;
	$review_content = array();


	$query = "
	SELECT user_details.profile, user_name, user_rating, title_review, user_review, review_img, datetime 
	FROM review_table  
	LEFT JOIN user_details ON user_details.user_id = review_table.user_id
	ORDER BY review_id DESC;
	";

	$result = $connect->query($query, PDO::FETCH_ASSOC);



	foreach ($result as $row) {
		$timeStamp = $row['datetime'];
		$timeStamp = date("l jS, F Y h:i:s A", strtotime($timeStamp));
		$image = $row['review_img'];
		$encode = json_decode($image);


		$review_content[] = array(
			'user_profile' => $row["profile"],
			'user_name'		=>	$row["user_name"],
			'user_review'	=>	$row["user_review"],
			'title_review'	=>	$row["title_review"],
			'rating'		=>	$row["user_rating"],
			'datetime'		=>	$timeStamp
		);



		if ($row["user_rating"] == '5') {
			$five_star_review++;
		}

		if ($row["user_rating"] == '4') {
			$four_star_review++;
		}

		if ($row["user_rating"] == '3') {
			$three_star_review++;
		}

		if ($row["user_rating"] == '2') {
			$two_star_review++;
		}

		if ($row["user_rating"] == '1') {
			$one_star_review++;
		}

		$total_review++;

		$total_user_rating = $total_user_rating + $row["user_rating"];
	};

	$average_rating = $total_user_rating / $total_review;

	$output = array(
		'average_rating'	=>	number_format($average_rating, 1),
		'total_review'		=>	$total_review,
		'five_star_review'	=>	$five_star_review,
		'four_star_review'	=>	$four_star_review,
		'three_star_review'	=>	$three_star_review,
		'two_star_review'	=>	$two_star_review,
		'one_star_review'	=>	$one_star_review,
		'review_data'		=>	$review_content
	);

	echo json_encode($output);
}
