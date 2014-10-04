<?php
require('../fpdf/fpdf.php');

class PDF extends FPDF
{
  function Header()
{
      global $pdf;
      $pdf -> SetY(10);
      $pdf->SetFont('Arial','I',18);
      $pdf->Cell(0, 8,utf8_decode( "PANTHER - ROTAS"), 1, 0,'C');
      $pdf -> SetXY(10, 40);
      $pdf -> ln(5);
}  
 function Footer()
{
       global $pdf;
      $pdf->SetY(265);
      $pdf->SetFont('Arial','I',6);
      $pdf->Cell(0, 4,utf8_decode( "Relatório gerado por: Panther, sistema de rotas."), 0, 0);
      $pdf->ln();
      $pdf->Cell(0, 4, "Telefone: (85) 9224-6865 / E-mail: meneses.tio@gmail.com", 0, 0);
}
// Load data
function LoadData($file)
{
	// Read file lines
	$lines = file($file);
	$data = array();
	foreach($lines as $line)
		$data[] = explode(';',trim($line));
	return $data;
}

//Função para decodificar os dados
function utf8DecodeArray($array) 
{
    $utf8DecodedArray = array();
    
    foreach ($array as $key => $value) 
    {
        if (is_array($value)) 
        {
            $utf8DecodedArray[$key] = utf8DecodeArray($value);
            continue;
        }
        
        $utf8DecodedArray[$key] = utf8_decode($value);
    }
    
    return $utf8DecodedArray;
}

// Simple table
function BasicTable($header, $data)
{
	// Header
	foreach($header as $col)
		$this->Cell(40,7,$col,1);
	$this->Ln();
	// Data
	foreach($data as $row)
	{
		foreach($row as $col)
			$this->Cell(40,6,$col,1);
		$this->Ln();
	}
}

// Better table
function ImprovedTable($header, $data)
{
	// Column widths
	$w = array(40, 35, 40, 45);
	// Header
	for($i=0;$i<count($header);$i++)
		$this->Cell($w[$i],7,$header[$i],1,0,'C');
	$this->Ln();
	// Data
	foreach($data as $row)
	{
		$this->Cell($w[0],6,$row[0],'LR');
		$this->Cell($w[1],6,$row[1],'LR');
		$this->Cell($w[2],6,number_format($row[2]),'LR',0,'R');
		$this->Cell($w[3],6,number_format($row[3]),'LR',0,'R');
		$this->Ln();
	}
	// Closing line
	$this->Cell(array_sum($w),0,'','T');
}

// Colored table
function FancyTable($header, $data)
{
	// Colors, line width and bold font
	$this->SetFillColor(204, 204, 204);
	$this->SetTextColor(0);
	$this->SetDrawColor(128,0,0);
	$this->SetLineWidth(.3);
	$this->SetFont('','B');
	// Header
	$w = array(12, 12, 12, 13, 82, 15, 20, 20);
	for($i=0;$i<count($header);$i++)
		$this->Cell($w[$i],7,$header[$i],1,0,'C',true);
	$this->Ln();
	// Color and font restoration
	$this->SetFillColor(224,235,255);
	$this->SetTextColor(0);
	$this->SetFont('');
	// Data
	$fill = false;
	foreach($data as $row)
	{
		$this->Cell($w[0],6,$row[0],'LR',0,'L',$fill);
		$this->Cell($w[1],6,$row[1],'LR',0,'L',$fill);
                $this->Cell($w[2],6,$row[2],'LR',0,'L',$fill);
                $this->Cell($w[3],6,$row[3],'LR',0,'L',$fill);
                $this->Cell($w[4],6,$row[4],'LR',0,'L',$fill);
                $this->Cell($w[5],6,$row[5],'LR',0,'L',$fill);
                $this->Cell($w[6],6,$row[6],'LR',0,'L',$fill);
                $this->Cell($w[7],6,$row[7],'LR',0,'L',$fill);
         //     $this->Cell($w[7],6,$row[7],'LR',0,'L',$fill);
        //      $this->Cell($w[8],6,$row[8],'LR',0,'L',$fill);
	//	$this->Cell($w[9],6,$row[9],'LR',0,'L',$fill);
		$this->Ln();
		$fill = !$fill;
	}
	// Closing line
	$this->Cell(array_sum($w),0,'','T');
}

}