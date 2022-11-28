<?php
include('database_connection.php');
include('function.php');
include('connection.php');
$user_name = $_SESSION['name'];
$user = $_SESSION['type'];

if (isset($_SESSION["uid"])) {

//upload
$target_dir = "admin/proof_of_payment/";
$uploadOk = 1;
$imgname = $_FILES["payment"]["name"];
$imageFileType = strtolower(pathinfo($imgname,PATHINFO_EXTENSION));
$randomno=rand(0,100000);
$rename='Payment'.date('Ymd').$randomno;
$newname=$rename.'.'.$imageFileType;	
$fileTmpPath = $_FILES['payment']['tmp_name'];
$target_file = $target_dir . $newname;
// $payment= basename($_FILES["payment"]["name"]);
// Check if image file is a actual image or fake image
if(move_uploaded_file($fileTmpPath, $target_file))
{
  $message ='File is successfully uploaded.';
}
else
{
  $message = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
}

    $courierId = $_POST['courier'];
    $query = mysqli_query($con, "select * from couriers where courier_id ='$courierId'");
    while ($row = mysqli_fetch_assoc($query)) {
        $courier_price =  $row["courier_fee"];
    }

    $query = mysqli_query($con, "SELECT a.items_id,a.items_name,a.items_price,a.product_img1,b.id,b.qty FROM items a,cart b WHERE a.items_id=b.p_id AND b.user_id='$_SESSION[uid]'");

    $n=0;
    $total_price = 0;
    while ($row = mysqli_fetch_assoc($query)) {
   
        $n++;
        $qty = $row["qty"];
        $subtotal = $row["qty"] * $row["items_price"];
        $total = $subtotal + $subtotal;
        $total_price += $subtotal;
        $total_payment = $total_price;
    }
   
	$full_name = $_POST["full_name"];
	$email = $_POST['email'];
	$address = $_POST['address'];
    $city = $_POST['city']; 
    $province = $_POST['province'];
    $region = $_POST['region'];
    $zip= $_POST['zip'];
    $customer_no = $_POST['customer_no'];
    $courier = $_POST['courier'];
    $customer_note = $_POST['customer_note'];
    $bank_name = $_POST['bank_name'];
	date_default_timezone_set("Asia/Manila"); 
    $date = date("Y-m-d H:i:sa");
    // $payment_method= $_POST['payment_method'];
   $payment = $newname;
    $payment_method = "Payment Center / e-Wallet";
    if ($bank_name==''){
        $payment_method = "COD";
        $payment = 'COD.png';
    };
    $user_id=$_SESSION["uid"];
    $transaction_id = $_POST["transaction_id"];
    $total_count=$_POST['total_count'];
    $prod_total = $total_payment +  $courier_price;

	$sql = "INSERT INTO `customer_order`(`transaction_id`, `customer_id`, `customer_name`, `email`, `customer_no`, `address`, `city`,`province`, `region`,`zip`,`total_amount`, `payment_method`, `payment`,`bank_name`,`courier`,`customer_note`,`status`,`date_created`)
	VALUES ('$transaction_id', '$user_id','$full_name','$email', '$customer_no', '$address', '$city','$province','$region','$zip','$prod_total','$payment_method', '$payment','$bank_name','$courier','$customer_note','0','$date')";

    if(mysqli_query($con,$sql)){
        $i=1;
        $prod_id_=0;
        $prod_price_=0;
        $prod_qty_=0;
        $prod_name_="";
        $prod_unit_=0;
        while($i<=$total_count){
            $str=(string)$i;
            $prod_id_+$str = $_POST['prod_id_'.$i];
            $prod_id=$prod_id_+$str;
            $prod_name = $_POST['prod_name_'.$i];
           
            $prod_unit= $_POST['prod_unit_'.$i];
            $prod_price_+$str = $_POST['prod_price_'.$i];
            $prod_price=$prod_price_+$str;
            $prod_qty_+$str = $_POST['prod_qty_'.$i];
            $prod_qty=$prod_qty_+$str;
            $sub_total=(int)$prod_price*(int)$prod_qty;
            $sql1="INSERT INTO `customer_order_product`(`transaction_id`,`product_id`, `product_name`, `unit`, `quantity`, `price`, `total`) VALUES ('$transaction_id','$prod_id','$prod_name','$prod_unit','$prod_qty', '$prod_price','$sub_total')";
            $query = mysqli_query($con, "SELECT * FROM `items` WHERE items_id = '$prod_id'");
            $n=0;
            $items_status;
            while ($row = mysqli_fetch_assoc($query)) {
                $n++;
                $items_stocks = $row["items_stocks"];
                $items_low = $row["items_low"];
                $target_stocks = $row["target_stocks"];
            }
            $stocks_latest = $items_stocks - $prod_qty;
            if ($stocks_latest <= $items_low){
                $items_status = "Critical";
            } elseif ($stocks_latest <= $items_low * 2){
                $items_status = "Warning";
            } elseif ($stocks_latest >= $target_stocks){
                $items_status = "Full";
            } else {
                $items_status = "Good";
            }
            $con -> query("UPDATE `items` SET `items_stocks`='$stocks_latest',`stock_status`='$items_status' WHERE items_id = '$prod_id'");
            if ($user=='master'){
                $user_type = 'Admin: ';
            } elseif ($user=='staff'){
                $user_type = 'Staff: ';
            } else{
                $user_type = 'Customer: ';
            }
            $stock ="INSERT INTO `stock_logs`(`item_name`,`stock_quantity`, `incharge`, `type`, `activity`) VALUES ('$prod_name','$prod_qty','$user_type$user_name','2','purchased')";
            $con->query($stock);
            if(mysqli_query($con,$sql1)){
                $del_sql="DELETE from cart where user_id = '$user_id'";
                if(mysqli_query($con,$del_sql)){
                    
                    $dt = date("M d, Y h:i a");
                   $query = mysqli_query($con,"INSERT INTO order_tracking (`transaction_id`, `order_placed`) VALUES ('$transaction_id', '$dt')");
                echo"<script>window.location.href='index.php'</script>";
                }else{
                    echo(mysqli_error($con));
                }

            }else{
                echo(mysqli_error($con));
            }

            $i++;


        }
    }else{

        echo(mysqli_error($con));
        
    }
    
}
else{
    echo"<script>window.location.href='index.php'</script>";
}
	




?>
