<?php

//supplier_action.php

include('database_connection.php');
$user = $_SESSION['type'];
if (isset($_POST['btn_action'])) {
    if ($_POST['btn_action'] == 'Add') {
        //first upload
        $target_dir = "instruction_images/";
        $fileTmpPath = $_FILES['image1']['tmp_name'];
        $target_file = $target_dir . basename($_FILES["image1"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        if (move_uploaded_file($fileTmpPath, $target_file)) {
            $message ='File is successfully uploaded.';
        } else {
            $message = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
        }
        //second upload
        $target_dir2 = "instruction_images/";
        $fileTmpPath2 = $_FILES['image2']['tmp_name'];
        $target_file2 = $target_dir2 . basename($_FILES["image2"]["name"]);
        $uploadOk2 = 1;
        $imageFileType2 = strtolower(pathinfo($target_file2, PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        if (move_uploaded_file($fileTmpPath2, $target_file2)) {
            $message = 'File is successfully uploaded.';
        } else {
            $message = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
        }



        $query = "
		INSERT INTO instructions(image1, title1, instruction1, image2, title2, instruction2) 
		VALUES (:image1, :title1, :instruction1, :image2, :title2, :instruction2)
		";

        $statement = $connect->prepare($query);
        $statement->execute(
            array(
                ':image1'    =>    basename($_FILES["image1"]["name"]),
                ':title1'    =>    $_POST["title1"],
                ':instruction1'    =>    $_POST["instruction1"],
                ':image2'    =>    basename($_FILES["image2"]["name"]),
                ':title2'    =>    $_POST["title2"],
                ':instruction2'    =>    $_POST["instruction2"],



            )
        );


        $logquery = "
		INSERT INTO logs (action, user) 
		VALUES (:transaction_id, :user)
		";
        $logstmt = $connect->prepare($logquery);
        $logstmt->execute(
            array(
                ':transaction_id'                => 'Added A New Instructions',
                ':user'                =>    $user,
            )
        );



        $result = $statement->fetchAll();
        if (isset($result)) {
            echo 'A New Instruction is Set Successfully!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
        }
    }

    if ($_POST['btn_action'] == 'fetch_single') {
        $query = "
    	SELECT * FROM instructions WHERE id = :id
    	";
        $statement = $connect->prepare($query);
        $statement->execute(
            array(
                ':id'    =>    $_POST["id"]
            )
        );
        $result = $statement->fetchAll();
        foreach ($result as $row) {
            $output['instruction1'] = $row['instruction1'];
            $output['instruction2'] = $row['instruction2'];
            $output['title1'] = $row['title1'];
            $output['title2'] = $row['title2'];
        }
        echo json_encode($output);
    }

    if ($_POST['btn_action'] == 'Edit') {
        //first upload
        if ($_FILES['image1']['size'] == 0 && $_FILES['image2']['size'] == 0) {
            $query = "
            UPDATE instructions set title1 = :title1, instruction1 = :instruction1, title2 = :title2, instruction2 = :instruction2
            WHERE id = :id
            ";

            $statement = $connect->prepare($query);
            $statement->execute(
                array(

                    ':instruction1'    =>    $_POST["instruction1"],
                    ':instruction2'    =>    $_POST["instruction2"],
                    ':title1'    =>    $_POST["title1"],
                    ':title2'    =>    $_POST["title2"],
                    ':id'    =>    $_POST["id"],

                )
            );

            $logquery = "
            INSERT INTO logs (action, user) 
            VALUES (:transaction_id, :user)
            ";
            $logstmt = $connect->prepare($logquery);
            $logstmt->execute(
                array(
                    ':transaction_id'                => 'Updated an Instructions',
                    ':user'                =>    $user,
                )
            );
        } elseif (($_FILES['image1']['size'] == 0)) {
            //second upload
            $target_dir = "instruction_images/";
            $fileTmpPath = $_FILES['image2']['tmp_name'];
            $target_file = $target_dir . basename($_FILES["image2"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            // Check if image file is a actual image or fake image
            if (move_uploaded_file($fileTmpPath, $target_file)) {
                $message = 'File is successfully uploaded.';
            } else {
                $message = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
            }

            $query = "
         UPDATE instructions set title1 = :title1, instruction1 = :instruction1, title2 = :title2, instruction2 = :instruction2, image2 = :image2
         WHERE id = :id
         ";

            $statement = $connect->prepare($query);
            $statement->execute(
                array(


                    ':instruction1'    =>    $_POST["instruction1"],
                    ':image2'    =>    basename($_FILES["image2"]["name"]),
                    ':instruction2'    =>    $_POST["instruction2"],
                    ':title1'    =>    $_POST["title1"],
                    ':title2'    =>    $_POST["title2"],
                    ':id'    =>    $_POST["id"],

                )
            );

            $logquery = "
         INSERT INTO logs (action, user) 
         VALUES (:transaction_id, :user)
         ";
            $logstmt = $connect->prepare($logquery);
            $logstmt->execute(
                array(
                    ':transaction_id'                => 'Updated an Instructions',
                    ':user'                =>    $user,
                )
            );
        } elseif ($_FILES['image2']['size'] == 0) {
            $target_dir = "instruction_images/";
            $fileTmpPath = $_FILES['image1']['tmp_name'];
            $target_file = $target_dir . basename($_FILES["image1"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            // Check if image file is a actual image or fake image
            if (move_uploaded_file($fileTmpPath, $target_file)) {
                $message = 'File is successfully uploaded.';
            } else {
                $message = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
            }
            $query = "
            UPDATE instructions set image1 = :image1, title1 = :title1, instruction1 = :instruction1, title2 = :title2, instruction2 = :instruction2
            WHERE id = :id
            ";

            $statement = $connect->prepare($query);
            $statement->execute(
                array(

                    ':image1'    =>    basename($_FILES["image1"]["name"]),
                    ':instruction1'    =>    $_POST["instruction1"],
                    ':instruction2'    =>    $_POST["instruction2"],
                    ':title1'    =>    $_POST["title1"],
                    ':title2'    =>    $_POST["title2"],
                    ':id'    =>    $_POST["id"],

                )
            );

            $logquery = "
            INSERT INTO logs (action, user) 
            VALUES (:transaction_id, :user)
            ";
            $logstmt = $connect->prepare($logquery);
            $logstmt->execute(
                array(
                    ':transaction_id'                => 'Updated an Instructions',
                    ':user'                =>    $user,
                )
            );
        } else {
            $target_dir = "instruction_images/";
            $fileTmpPath = $_FILES['image1']['tmp_name'];
            $target_file = $target_dir . basename($_FILES["image1"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            // Check if image file is a actual image or fake image
            if (move_uploaded_file($fileTmpPath, $target_file)) {
                $message = 'File is successfully uploaded.';
            } else {
                $message = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
            }
            //second upload
            $target_dir = "instruction_images/";
            $fileTmpPath = $_FILES['image2']['tmp_name'];
            $target_file = $target_dir . basename($_FILES["image2"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            // Check if image file is a actual image or fake image
            if (move_uploaded_file($fileTmpPath, $target_file)) {
                $message = 'File is successfully uploaded.';
            } else {
                $message = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
            }

            $query = "
    	UPDATE instructions set image1 = :image1, title1 = :title1, instruction1 = :instruction1, title2 = :title2, instruction2 = :instruction2, image2 = :image2
    	WHERE id = :id
    	";

            $statement = $connect->prepare($query);
            $statement->execute(
                array(

                    ':image1'    =>    basename($_FILES["image1"]["name"]),
                    ':instruction1'    =>    $_POST["instruction1"],
                    ':image2'    =>    basename($_FILES["image2"]["name"]),
                    ':instruction2'    =>    $_POST["instruction2"],
                    ':title1'    =>    $_POST["title1"],
                    ':title2'    =>    $_POST["title2"],
                    ':id'    =>    $_POST["id"],

                )
            );

            $logquery = "
    	INSERT INTO logs (action, user) 
    	VALUES (:transaction_id, :user)
    	";
            $logstmt = $connect->prepare($logquery);
            $logstmt->execute(
                array(
                    ':transaction_id'                => 'Updated an Instructions',
                    ':user'                =>    $user,
                )
            );
        }

        $result = $statement->fetchAll();
        if (isset($result)) {
            echo 'Instruction Updated Successfully!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
        }
    }

    if ($_POST['btn_action'] == 'delete') {
        $query = "
    	DELETE FROM instructions WHERE id = :id
    	";
        $statement = $connect->prepare($query);
        $statement->execute(
            array(
                ':id'        =>    $_POST["id"]
            )
        );
        $logquery = "
    	INSERT INTO logs (action, user) 
    	VALUES (:transaction_id, :user)
    	";
        $logstmt = $connect->prepare($logquery);
        $logstmt->execute(
            array(
                ':transaction_id'                => 'Removed an Intruction',
                ':user'                =>    $user,
            )
        );

        $result = $statement->fetchAll();
        if (isset($result)) {
            echo 'Instruction has been Removed!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
        }
    }
}
