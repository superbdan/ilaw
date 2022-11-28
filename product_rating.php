<?php 

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
			INSERT INTO product_review
			(user_name, user_id, product_id, user_rating, title_review, user_review, review_img) 
			VALUES (:user_name, :user_id, :product_id, :user_rating, :title_review, :user_review, :image)
			";

		$statement = $connect->prepare($query);

		$statement->execute(
			array(
				':user_name'		=>	$_POST["user_name"],
				':user_id' 			=> $_POST["user_id"],
                ':product_id' 			=> $_POST["product_id"],
				':user_rating'		=>	$_POST["rate"],
				':title_review'		=>	$_POST["title_review"],
				':user_review'		=>	$_POST["user_review"],
				':image' 			=> $filesArray
			)
		);

        $transaction_id = $_POST['order_id'];
        $product_id =  $_POST["product_id"];

		$query = "
        UPDATE customer_order_product SET rate = '1'
        WHERE transaction_id = '$transaction_id' AND product_id = '$product_id'
		";
		$statement = $connect->prepare($query);
		$statement->execute();



		echo "Your Review & Rating Successfully Submitted";
	}
}
