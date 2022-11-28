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
        $this->Cell(80, 10, 'ITEM LIST DATA REPORT', 0, 0, 'C');
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
        $this->Cell(60, 10, 'Prepared by: ' . $user['first_name'] .  '' . $user['last_name'] . '', 0, 0,'C');
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
$pdf->Cell(100, 8, 'ITEM NAME', 1);
$pdf->Cell(40, 8, 'CATEGORY', 1);
$pdf->Cell(15, 8, 'COST', 1);
$pdf->Cell(15, 8, 'PRICE', 1);
$pdf->Cell(15, 8, 'STOCKS', 1);
$pdf->Cell(40, 8, 'SUPPLIERS', 1);
$pdf->Cell(25, 8, 'MEASUREMENT', 1);
$pdf->Cell(25, 8, 'STATUS', 1);

$query = "SELECT * FROM items 
INNER JOIN category ON category.category_id = items.category_id 
INNER JOIN suppliers ON suppliers.supplier_id = items.supplier_id
INNER JOIN measurement ON measurement.measurement_id = items.measurement_id";
$result = mysqli_query($con, $query);
$no = 0;

while ($row = mysqli_fetch_array($result)) {
    $no = $no + 1;
    $pdf->Ln(8);
    $pdf->SetFont('Helvetica', '', 7);
    $pdf->Cell(100, 8, $row['items_name'], 1);
    $pdf->Cell(40, 8, $row['category_name'], 1);
    $pdf->Cell(15, 8,  number_format($row['items_cost'], 2), 1);
    $pdf->Cell(15, 8,  number_format($row['items_price'], 2), 1);
    $pdf->Cell(15, 8, $row['items_stocks'], 1);
    $pdf->Cell(40, 8, $row['supplier_name'], 1);
    $pdf->Cell(25, 8, $row['measurement_name'], 1);
    $pdf->Cell(25, 8, $row['stock_status'], 1);
}
$pdf->Output();
