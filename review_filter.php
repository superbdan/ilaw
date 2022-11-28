<?php
include('connection.php');
// For Price Low To High
if (($_POST['sort']) == "recent") {
    $sql = "SELECT user_details.profile, user_name, user_rating, title_review, user_review, review_img, datetime 
    FROM review_table  
    LEFT JOIN user_details ON user_details.user_id = review_table.user_id
    ORDER BY datetime DESC";
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $image = $row['review_img'];
        $encode = json_decode($image);
        $timeStamp = $row['datetime'];
        $timeStamp = date("l jS, F Y h:i:s A", strtotime($timeStamp));
        if ($row['user_rating'] == '5') {
            $rating = '<i class="fas fa-star text-warning mr-1"></i><i class="fas fa-star text-warning mr-1"></i><i class="fas fa-star text-warning mr-1"></i><i class="fas fa-star text-warning mr-1"></i><i class="fas fa-star text-warning mr-1"></i>';
        } elseif ($row['user_rating'] == '4') {
            $rating = '<i class="fas fa-star text-warning mr-1"></i><i class="fas fa-star text-warning mr-1"></i><i class="fas fa-star text-warning mr-1"></i><i class="fas fa-star text-warning mr-1"></i><i class="fas fa-star star-light mr-1"></i>';
        } elseif ($row['user_rating'] == '3') {
            $rating = '<i class="fas fa-star text-warning mr-1"></i><i class="fas fa-star text-warning mr-1"></i><i class="fas fa-star text-warning mr-1"></i><i class="fas fa-star star-light mr-1"></i><i class="fas fa-star star-light mr-1"></i>';
        } elseif ($row['user_rating'] == '2') {
            $rating = '<i class="fas fa-star text-warning mr-1"></i><i class="fas fa-star text-warning mr-1"></i><i class="fas fa-star star-light mr-1"></i><i class="fas fa-star star-light mr-1"></i><i class="fas fa-star star-light mr-1"></i>';
        } elseif ($row['user_rating'] == '1') {
            $rating = '<i class="fas fa-star text-warning mr-1"></i><i class="fas fa-star star-light mr-1"></i><i class="fas fa-star star-light mr-1"></i><i class="fas fa-star star-light mr-1"></i><i class="fas fa-star star-light mr-1"></i>';
        } elseif ($row['user_rating'] == '0') {
            $rating = '<i class="fas fa-star star-light mr-1"></i><i class="fas fa-star star-light mr-1"></i><i class="fas fa-star star-light mr-1"></i><i class="fas fa-star star-light mr-1"></i><i class="fas fa-star star-light mr-1"></i>';
        };
        if (isset($row['profile']) == "") {
            $profile = 'Anonymous.png';
        } else {
            $profile = $row['profile'];
        };
        if (isset($row['profile']) == "") {
            echo '<div class="d-flex mb-3">
           <div class="col-12">
               <div class="card">
                   <div class="card-header"><img class="img-account-profile rounded-circle border shadow " style="vertical-align: middle; width: 45px; height: 45px;border-radius: 50%;" src="images/user-img/' . $profile . '" alt="user_Profile" />&nbsp;&nbsp;<b>'.$row['user_name'].'&nbsp;</b></div>
                   <div class="card-body">
                       ' . $rating . '
                       <br>
                       <div><b>' . $row['title_review'] . '</b></div>
                       ' . $row['user_review'] . '
                       <div>';
            } else {
                echo '<div class="d-flex mb-3">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header"><img class="img-account-profile rounded-circle border shadow " style="vertical-align: middle; width: 45px; height: 45px;border-radius: 50%;" src="images/user-img/' . $profile . '" alt="user_Profile" />&nbsp;&nbsp;<b>'.$row['user_name'].'&nbsp;</b><span class="text-success" style="font-size: 12px;"><i class="fa fa-check-circle" aria-hidden="true"></i><i><b>Verified Customer</b></i></span></div>
                        <div class="card-body">
                            ' . $rating . '
                            <br>
                            <div><b>' . $row['title_review'] . '</b></div>
                            ' . $row['user_review'] . '
                            <div>';
            };
        for ($i = 0; $i < count($encode); $i++) {

            echo '<img onclick="window.open(this.src)" alt="product_image" src="images/review-upload/' . $encode[$i] . '" style="height: auto; width: 10%; cursor: pointer;" />&nbsp;';
        }

        echo  '
                   </div>
               </div>
               <div class="card-footer text-right" style="font-size: 12px;"><b>On ' . $timeStamp . ' </b></div>
           </div>
       </div>
   </div> ';
    }
}


//For Price High To Low
if (($_POST['sort']) == 'highrating') {
    $sql = "SELECT user_details.profile, user_name, user_rating, title_review, user_review, review_img, datetime 
    FROM review_table  
    LEFT JOIN user_details ON user_details.user_id = review_table.user_id
    ORDER BY user_rating DESC";
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $image = $row['review_img'];
        $encode = json_decode($image);
        $timeStamp = $row['datetime'];
        $timeStamp = date("l jS, F Y h:i:s A", strtotime($timeStamp));
        if ($row['user_rating'] == '5') {
            $rating = '<i class="fas fa-star text-warning mr-1"></i><i class="fas fa-star text-warning mr-1"></i><i class="fas fa-star text-warning mr-1"></i><i class="fas fa-star text-warning mr-1"></i><i class="fas fa-star text-warning mr-1"></i>';
        } elseif ($row['user_rating'] == '4') {
            $rating = '<i class="fas fa-star text-warning mr-1"></i><i class="fas fa-star text-warning mr-1"></i><i class="fas fa-star text-warning mr-1"></i><i class="fas fa-star text-warning mr-1"></i><i class="fas fa-star star-light mr-1"></i>';
        } elseif ($row['user_rating'] == '3') {
            $rating = '<i class="fas fa-star text-warning mr-1"></i><i class="fas fa-star text-warning mr-1"></i><i class="fas fa-star text-warning mr-1"></i><i class="fas fa-star star-light mr-1"></i><i class="fas fa-star star-light mr-1"></i>';
        } elseif ($row['user_rating'] == '2') {
            $rating = '<i class="fas fa-star text-warning mr-1"></i><i class="fas fa-star text-warning mr-1"></i><i class="fas fa-star star-light mr-1"></i><i class="fas fa-star star-light mr-1"></i><i class="fas fa-star star-light mr-1"></i>';
        } elseif ($row['user_rating'] == '1') {
            $rating = '<i class="fas fa-star text-warning mr-1"></i><i class="fas fa-star star-light mr-1"></i><i class="fas fa-star star-light mr-1"></i><i class="fas fa-star star-light mr-1"></i><i class="fas fa-star star-light mr-1"></i>';
        } elseif ($row['user_rating'] == '0') {
            $rating = '<i class="fas fa-star star-light mr-1"></i><i class="fas fa-star star-light mr-1"></i><i class="fas fa-star star-light mr-1"></i><i class="fas fa-star star-light mr-1"></i><i class="fas fa-star star-light mr-1"></i>';
        };
        if (isset($row['profile']) == "") {
            $profile = 'Anonymous.png';
        } else {
            $profile = $row['profile'];
        };

        if (isset($row['profile']) == "") {
        echo '<div class="d-flex mb-3">
       <div class="col-12">
           <div class="card">
               <div class="card-header"><img class="img-account-profile rounded-circle border shadow " style="vertical-align: middle; width: 45px; height: 45px;border-radius: 50%;" src="images/user-img/' . $profile . '" alt="user_Profile" />&nbsp;&nbsp;<b>'.$row['user_name'].'&nbsp;</b></div>
               <div class="card-body">
                   ' . $rating . '
                   <br>
                   <div><b>' . $row['title_review'] . '</b></div>
                   ' . $row['user_review'] . '
                   <div>';
        } else {
            echo '<div class="d-flex mb-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-header"><img class="img-account-profile rounded-circle border shadow " style="vertical-align: middle; width: 45px; height: 45px;border-radius: 50%;" src="images/user-img/' . $profile . '" alt="user_Profile" />&nbsp;&nbsp;<b>'.$row['user_name'].'&nbsp;</b><span class="text-success" style="font-size: 12px;"><i class="fa fa-check-circle" aria-hidden="true"></i><i><b>Verified Customer</b></i></span></div>
                    <div class="card-body">
                        ' . $rating . '
                        <br>
                        <div><b>' . $row['title_review'] . '</b></div>
                        ' . $row['user_review'] . '
                        <div>';
        };
        for ($i = 0; $i < count($encode); $i++) {

            echo '<img onclick="window.open(this.src)" alt="product_image" src="images/review-upload/' . $encode[$i] . '" style="height: auto; width: 10%; cursor: pointer;" />&nbsp;';
        }

        echo  '
                   </div>
               </div>
               <div class="card-footer text-right" style="font-size: 12px;"><b>On ' . $timeStamp . ' </b></div>
           </div>
       </div>
   </div> ';
    }
}


if (($_POST['sort']) == 'lowrating') {
    $sql = "SELECT user_details.profile, user_name, user_rating, title_review, user_review, review_img, datetime 
    FROM review_table  
    LEFT JOIN user_details ON user_details.user_id = review_table.user_id
    ORDER BY user_rating ASC";
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $image = $row['review_img'];
        $encode = json_decode($image);
        $timeStamp = $row['datetime'];
        $timeStamp = date("l jS, F Y h:i:s A", strtotime($timeStamp));
        if ($row['user_rating'] == '5') {
            $rating = '<i class="fas fa-star text-warning mr-1"></i><i class="fas fa-star text-warning mr-1"></i><i class="fas fa-star text-warning mr-1"></i><i class="fas fa-star text-warning mr-1"></i><i class="fas fa-star text-warning mr-1"></i>';
        } elseif ($row['user_rating'] == '4') {
            $rating = '<i class="fas fa-star text-warning mr-1"></i><i class="fas fa-star text-warning mr-1"></i><i class="fas fa-star text-warning mr-1"></i><i class="fas fa-star text-warning mr-1"></i><i class="fas fa-star star-light mr-1"></i>';
        } elseif ($row['user_rating'] == '3') {
            $rating = '<i class="fas fa-star text-warning mr-1"></i><i class="fas fa-star text-warning mr-1"></i><i class="fas fa-star text-warning mr-1"></i><i class="fas fa-star star-light mr-1"></i><i class="fas fa-star star-light mr-1"></i>';
        } elseif ($row['user_rating'] == '2') {
            $rating = '<i class="fas fa-star text-warning mr-1"></i><i class="fas fa-star text-warning mr-1"></i><i class="fas fa-star star-light mr-1"></i><i class="fas fa-star star-light mr-1"></i><i class="fas fa-star star-light mr-1"></i>';
        } elseif ($row['user_rating'] == '1') {
            $rating = '<i class="fas fa-star text-warning mr-1"></i><i class="fas fa-star star-light mr-1"></i><i class="fas fa-star star-light mr-1"></i><i class="fas fa-star star-light mr-1"></i><i class="fas fa-star star-light mr-1"></i>';
        } elseif ($row['user_rating'] == '0') {
            $rating = '<i class="fas fa-star star-light mr-1"></i><i class="fas fa-star star-light mr-1"></i><i class="fas fa-star star-light mr-1"></i><i class="fas fa-star star-light mr-1"></i><i class="fas fa-star star-light mr-1"></i>';
        };
        if (isset($row['profile']) == "") {
            $profile = 'Anonymous.png';
        } else {
            $profile = $row['profile'];
        };

        if (isset($row['profile']) == "") {
            echo '<div class="d-flex mb-3">
           <div class="col-12">
               <div class="card">
                   <div class="card-header"><img class="img-account-profile rounded-circle border shadow " style="vertical-align: middle; width: 45px; height: 45px;border-radius: 50%;" src="images/user-img/' . $profile . '" alt="user_Profile" />&nbsp;&nbsp;<b>'.$row['user_name'].'&nbsp;</b></div>
                   <div class="card-body">
                       ' . $rating . '
                       <br>
                       <div><b>' . $row['title_review'] . '</b></div>
                       ' . $row['user_review'] . '
                       <div>';
            } else {
                echo '<div class="d-flex mb-3">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header"><img class="img-account-profile rounded-circle border shadow " style="vertical-align: middle; width: 45px; height: 45px;border-radius: 50%;" src="images/user-img/' . $profile . '" alt="user_Profile" />&nbsp;&nbsp;<b>'.$row['user_name'].'&nbsp;</b><span class="text-success" style="font-size: 12px;"><i class="fa fa-check-circle" aria-hidden="true"></i><i><b>Verified Customer</b></i></span></div>
                        <div class="card-body">
                            ' . $rating . '
                            <br>
                            <div><b>' . $row['title_review'] . '</b></div>
                            ' . $row['user_review'] . '
                            <div>';
            };
        for ($i = 0; $i < count($encode); $i++) {

            echo '<img onclick="window.open(this.src)" alt="product_image" src="images/review-upload/' . $encode[$i] . '" style="height: auto; width: 10%; cursor: pointer;" />&nbsp;';
        }

        echo  '
                   </div>
               </div>
               <div class="card-footer text-right" style="font-size: 12px;"><b>On ' . $timeStamp . ' </b></div>
           </div>
       </div>
   </div> ';
    }
}
