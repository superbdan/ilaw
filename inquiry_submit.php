<?php
require "connection.php";
$email = "";
$name = "";
$errors = array();
//if index page inquiry
if (isset($_POST['inquiry'])) {
    $fname = mysqli_real_escape_string($con, $_POST['first_name']);
    $lname = mysqli_real_escape_string($con, $_POST['last_name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $number = mysqli_real_escape_string($con, $_POST['number']);
    $message = mysqli_real_escape_string($con, $_POST['message']);

    $subject = "New Inquiry for ILAW";
    $body = "<div style='font-family: Helvetica,Arial,sans-serif;min-width:1000px;overflow:auto;line-height:2'>
            <div style='margin:50px auto;width:70%;padding:20px 0'>
              <div style='border-bottom:1px solid #eee'>
                <a href='' style='font-size:1.4em;color: #00466a;text-decoration:none;font-weight:600'>New Inquiry for ILAW</a>
              </div>
              <p style='font-size:1.1em'>New Inquiry from $email</p>
              <p>Good Day!, An inquiry started from Customer $fname $lname</p>
              <p>Contact Number: $number</p>
              <p>Message: $message</p>
              <p style='font-size:0.9em;'>Regards,<br>Thank you</p>
              <hr style='border:none;border-top:1px solid #eee'/>
              <div style='float:right;padding:8px 0;color:#aaa;font-size:0.8em;line-height:1;font-weight:300'>
                <p>Ilaw Lighting and Equipment Trading</p>
                <p>Carmona Estates Phase 11 Block 14 Lot 48</p>
                <p>Carmona, Cavite</p>
              </div>
            </div>
          </div>";
    $sender = "MIME-Version: 1.0" . "\r\n";
    $sender .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    // More headers
    $sender .= 'From: ' . $email . '' . "\r\n";
    $ilawemail = "ilawnatinto21@gmail.com";
    if (mail($ilawemail, $subject, $body, $sender)) {
        $info = "Your Inquiry Has been Sent";
        $_SESSION['info'] = $info;
        header('location: index.php#contact_frm');
        exit();
    } else {
        $errors['error-sending'] = "Failed while sending inquiry";
    }
}
