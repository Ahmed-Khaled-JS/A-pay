<?php
include '../controllers/dbconnect.php'; // Include your MySQL connection script
require '../fpdf185/fpdf.php';
function getTransaction(){
    $query = 'select * from trans';
    $db = new dbconnect();

    $result = mysqli_query($db->connect(), $query);
    $res=array();
    while ($row=mysqli_fetch_assoc($result)) {
    $res[]=$row;
    }
    return $res;
}
function get_columns($table){
    $query='show columns from '.$table;
    $db = new dbconnect();

    $result = mysqli_query($db->connect(), $query);
    $res=array();
    while ($row=mysqli_fetch_assoc($result)) {
        $res[]=$row['Field'];
    }
    return array_values($res);
}
$pdf = new FPDF();
$pdf->AddPage();

// Define column headers
$header = get_columns('trans');

$data = getTransaction();

$pdf->SetFont('Arial', '', 6);

// Print column headers
foreach($header as $col) {
    $pdf->Cell(30, 7, $col, 1);
}
$pdf->Ln();

// Print table data
foreach($data as $row) {
    foreach($row as $col) {
        $pdf->Cell(30, 7, $col, 1);
    }
    $pdf->Ln();
}

$pdf->Output();
?>
