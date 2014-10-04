<?php
require('fpdf.php');

$pdf = new FPDF(A4);
$pdf->AddPage(1);
$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,10,'Hello World!');
$pdf->Output();
?>