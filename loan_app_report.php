<?php
include('includes/db_connect.php');
require_once('assets/fpdf/fpdf.php');
require_once ('assets/fpdf/rotation.php');



$pdf = new FPDF();
$pdf->SetTitle('Payment Receipt');

$pdf->AddPage('L', 'A4', 0);

$pdf->Image('assets/swift_personal.png',8,9,21);

if (isset($_GET['loan_id'])) {
    $loan_id = $_GET['loan_id'];
}

$pdf->Ln();
$pdf-> Cell(20);
$pdf->SetFont('Times','B',12);
$pdf->Write(4,'Microfinance NV consists of financial experts who offer the opportunity for cheap loans');
$pdf->Ln();
$pdf-> Cell(20);
$pdf->SetFont('Times','B',12);
$pdf->Write(4, '25737 US Rt 11, Evans Mills NY 13637');
$pdf->Ln();
$pdf-> Cell(20);
$pdf->SetFont('Times','B',12);
$pdf->Write(4,'Phone: 0175465465, Email:info@microfinancenv.com');
$pdf->Ln();
$pdf-> Cell(20);
$pdf->SetFont('Times','B',12);
$pdf->Write(4,'Web: www.microfinancenv.com');
$pdf-> Cell(20);
$pdf->SetFont('Times','B',12);
$pdf->Write(5, '________________________________________________________________________________________________________________________________');
$pdf->Ln();
$pdf->Ln();


$pdf->SetFont('Times','',13);


$query=mysqli_query($conn,"SELECT * from loan_list where id = ".$loan_id);
while($data=mysqli_fetch_array($query)){
$pdf->Cell(55, 5, 'Reference code :', 0, 0);
$pdf->Cell(58, 5,$data['ref_no'], 0, 0);

$pdf->Cell(27, 5, 'Date Created :', 0, 0);
$pdf->Cell(52, 5, $data['date_created'], 0, 1);

$pdf->Cell(55, 5, 'Amount :', 0, 0);
$pdf->Cell(58, 5, 'SRD '.$data['amount'], 0, 0);

$pdf->Cell(55, 5, 'Status :', 0, 0);
$pdf->Cell(58, 5, $data['status'], 0, 1);
}
$query=mysqli_query($conn,"SELECT * from loan_types where id = ".$loan_id);
while($data=mysqli_fetch_array($query)){

$pdf->Cell(55, 5, 'Loan-Type :', 0, 0);
$pdf->Cell(58, 5, $data['type_name'], 0, 1);
}

$pdf-> Cell(20);
$pdf->SetFont('Times','',12);
$pdf->Write(5, '________________________________________________________________________________________________________________________________');


$pdf->Ln(10);
$a='%';
$query=mysqli_query($conn,"SELECT * from loan_plan where id = ".$loan_id);
while($data=mysqli_fetch_array($query)){
$pdf->SetFont('Times','',13);
$pdf->Cell(55, 5, 'Loan Plan :', 0, 0);
$pdf->Cell(58, 5, $data['id'], 0, 1);

$pdf->Cell(55, 5, 'Interest :', 0, 0);
$pdf->Cell(58, 5, $data['interest_percentage'].'%', 0, 1);

$pdf->Cell(55, 5, 'Over dure Penalty :', 0, 0); 
$pdf->Cell(58, 5, $data['penalty_rate'].'%', 0, 1);
}

$query=mysqli_query($conn,"SELECT * from payments where id = ".$loan_id);
while($data=mysqli_fetch_array($query)){
$pdf->Cell(55, 5, 'Monthly Payment :', 0, 0);
$pdf->Cell(58, 5, 'SRD '.$data['amount'], 0, 1);

$pdf->Cell(55, 5, 'Interest Arrears :', 0, 0);
$pdf->Cell(58, 5, 'SRD '.$data['penalty_amount'], 0, 1);
}

$pdf-> Cell(20);
$pdf->SetFont('Times','',12);
$pdf->Write(5, '________________________________________________________________________________________________________________________________');

$pdf->Ln(10);

$query=mysqli_query($conn,"SELECT * from payments where id = ".$loan_id);
while($data=mysqli_fetch_array($query)){
$pdf->SetFont('Times','',13);
$pdf->Cell(55, 5, 'Paid By :', 0, 0);
$pdf->Cell(58, 5, $data['payee'], 0, 1); 

$pdf->Cell(55, 5, 'Transaction Date :', 0, 0);
$pdf->Cell(58, 5, $data['date_created'], 0, 1);
}

$query=mysqli_query($conn,"SELECT * from borrowers where id = ".$loan_id);
while($data=mysqli_fetch_array($query)){
$pdf->Cell(55, 5, 'ID-Number :', 0, 0);
$pdf->Cell(58, 5, $data['id_number'], 0, 1); 

$pdf->Cell(55, 5, 'Company-Name :', 0, 0);
$pdf->Cell(58, 5, $data['companyname'], 0, 1);
}


$pdf-> Cell(20);
$pdf->SetFont('Times','',12);
$pdf->Write(5, '                                                                                                          ______________________________');

$pdf->Ln(5);
$pdf->Cell(140, 5, '', 0, 0);
$pdf->Cell(52, 5, ': Signature', 0, 1, 'C');


$pdfTitle = 'Payment_Receipt_2021_2022';

$pdf->Output( 'I', $pdfTitle, true );




?>