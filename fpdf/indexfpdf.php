<?php
include_once 'fpdf.php';

$pdf = new FPDF();

$pdf->AddPage();

$pdf->SetFont('Arial','B',16);


$arrText[0] = "tia";
$arrText[1] = "tio";
$arrText[2] = "primo";
$arrText[3] = "prima";
$arrText[4] = "irmão";
$arrText[5] = "irmã";

foreach ($arrText as $dados){
$pdf->Cell(50,10,$dados,1,2,'l',false);
}
$pdf->Output();

?>