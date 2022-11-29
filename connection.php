<?php
$servername = "127.0.0.1";
$database = "database";
$username = "root";
$password = "";
// Create connection
$con = mysqli_connect($servername, $username, $password, $database);
// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
$con->set_charset("utf8");
// echo "Connected successfully";
// mysqli_close($con);
?>
