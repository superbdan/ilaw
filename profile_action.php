<?php
include('connection.php');
include('database_connection.php');

if (isset($_FILES["image"]["name"])) {
    $id = $_POST["id"];
    $name = $_POST["name"];

    $target_dir = "images/user-img/";
    $imageSize = $_FILES["image"]["size"];
    $fileTmpPath = $_FILES['image']['tmp_name'];
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
    if (move_uploaded_file($fileTmpPath, $target_file)) {
        $message = 'File is successfully uploaded.';
    } else {
        $message = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
    }
    
    $query = "
		UPDATE user_details set profile = :image 
		WHERE user_id = :id
		";

    $statement = $connect->prepare($query);
    $statement->execute(
        array(

            ':image'    =>    basename($_FILES["image"]["name"]),
            ':id' => $id
        )
    );
    $result = $statement->fetchAll();
    if (isset($result)) {
       
    }

    // $imageName = $_FILES["image"]["name"];
    // $imageSize = $_FILES["image"]["size"];
    // $tmpName = $_FILES["image"]["tmp_name"];

    // $validImageExtension = ['jpg', 'jpeg', 'png'];
    // $imageExtension = explode('.', $imageName);
    // $imageExtension = strtolower(end($imageExtension));


    // if (!in_array($imageExtension, $validImageExtension)) {
    //     echo
    //     "
    //     <script>
    //         alert('Invalid Image Extension');
    //     </script>
    //     ";
    // } elseif ($imageSize > 1200000) {
    //     echo
    //     "
    //         <script>
    //             alert('Image Size is Too Large');
    //         </script>
    //         ";
    // } else {
    //     $newImageName = $name . " - " . $id;
    //     $newImageName .= "." . $imageExtension;
    //     $query = "UPDATE user_details SET profile = '$newImageName' WHERE user_id = '$id'";
    //     mysqli_query($con, $query);
    //     move_uploaded_file($tmpName, 'images/user-img/' . $newImageName);
    //     // echo
    //     // "
    //     //     <script>
    //     //     window.location.reload();'
    //     //     </script>
    //     //     ";
    // }
}



if (isset($_POST["save"])) {
    $email = $_POST['email'];
    $user_fname = $_POST['first_name'];
    $user_mname = $_POST['middle_name'];
    $user_lname = $_POST['last_name'];
    $region = $_POST['region'];
    $province = $_POST['province'];
    $city = $_POST['city'];
    $zip_code = $_POST['zip_code'];
    $contact = $_POST['contact'];
    $home_address = $_POST['address'];
    $query = "UPDATE user_details SET first_name ='$user_fname', middle_name = '$user_mname', last_name ='$user_lname', 
    region = '$region', province = '$province', city = '$city', home_address = '$home_address', zip_code ='$zip_code', user_contact ='$contact' WHERE user_email = '$email'
    ";
    $result = mysqli_query($con, $query);
}
