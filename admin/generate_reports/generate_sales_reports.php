<?php
//include connection file 
include('../database_connection.php');
include('../../connection.php');
require('../pdf/fpdf.php');
date_default_timezone_set('Asia/Manila');
class PDF extends FPDF
{
    // Page header
    function Header()
    {
        include('../../connection.php');
        $email = $_SESSION['email'];
        $sql = "SELECT * FROM user_details WHERE user_email = '$email' ";
        $result = mysqli_query($con, $sql);
        $user = mysqli_fetch_assoc($result);
        // Logo
        $this->Image('../images/Logos/ILAW_Logo.png', 5, 5, 18);
        $this->SetFont('Helvetica', 'B', 20);
        // Move to the right
        $this->Cell(100);
        // Title
        $this->Cell(80, 10, 'SALES REPORT', 0, 0, 'C');
        $this->Ln(5);
        $this->SetFont('Helvetica', '', 10);
        $this->Cell(100);
        $this->Cell(80, 10, 'ILAW Lighting And Equipment Trading', 0, 0, 'C');
        // Line break
        $this->Ln(10);
        $this->SetFont('Helvetica', 'B', 10);
        $this->Cell(110);
        $this->Cell(60, 10, 'Date Generated: ' . date('M d, Y h:i a'), 0, 0, "C");
        $this->Ln(5);
        $this->Cell(110);
        $this->Cell(60, 10, 'Prepared by: ' . $user['first_name'] .  '' . $user['last_name'] . '', 0, 0, 'C');
        $this->Ln(10);
    }

    // Page footer
    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '', 0, 0, 'C');
    }
}
$pdf = new PDF();
$pdf->AddPage('L', 'A4', 0);
$pdf->SetFont('Helvetica', 'B', 8);
$pdf->Cell(55, 8, 'TRANSACTION ID', 1);
$pdf->Cell(55, 8, 'USER ID', 1);
$pdf->Cell(65, 8, 'NAME', 1);
$pdf->Cell(50, 8, 'TOTAL ITEMS', 1);
$pdf->Cell(50, 8, 'TOTAL', 1);

$query = "SELECT customer_order.transaction_id,user_id, concat(first_name,' ',middle_name,' ',last_name) as name,total, count(product_name) as items FROM customer_order 
INNER JOIN user_details ON customer_order.customer_id = user_details.user_id
LEFT JOIN customer_order_product on customer_order.transaction_id = customer_order_product.transaction_id
WHERE status = '3'
group by customer_order.transaction_id
";
$result = mysqli_query($con, $query);
$no = 0;

while ($row = mysqli_fetch_array($result)) {
    $no = $no + 1;
    $pdf->Ln(8);
    $pdf->SetFont('Helvetica', '', 7);
    $pdf->Cell(55, 8, $row['transaction_id'], 1);
    $pdf->Cell(55, 8, $row['user_id'], 1);
    $pdf->Cell(65, 8, $row['name'], 1);
    $pdf->Cell(50, 8, $row['items'], 1);
    $pdf->Cell(50, 8, number_format($row['total'], 2), 1);
    
}
$pdf->Output();
