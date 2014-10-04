<?php
include_once 'relatorio.class.php';
include_once '../dao/DaoDriverConexao.class.php';
include_once '../dao/DaoTrajeto.class.php';

//recebendo os dados via post
$dataInicial = $_POST['dataInicial'];

$dataFinal = $_POST['dataFinal'];

$usuario = $_POST['usuario_id'];

$usuarioNome = $_POST['usuario_nome'];

$precoGas = $_POST['precoGasolina'];

$link = mysql_connect('localhost', 'root', '12345') or die(mysql_error());

mysql_select_db('projectx', $link) or die(mysql_error());

$DAO = new TrajetoDAO();

$pdf = new PDF();

$result = $DAO->Lista("SELECT DATE_FORMAT( `data` , '%d/%c/%Y' ) AS `data`, `periodo`, `veiculo`, `ponto_1`, `ponto_2`, `ponto_3`, `dist_total`, `diferenca` FROM `tb_trajeto` WHERE `data` >= '$dataInicial' AND `data` <= '$dataFinal' AND `fk_usuario` = '$usuario' ORDER BY `data`");

$queryCarro = "SELECT SUM(dist_total), SUM(diferenca) FROM `tb_trajeto` WHERE `data` >= '$dataInicial' AND `data` <= '$dataFinal' AND `fk_usuario` = '$usuario' AND `veiculo` = 'CARRO'";

$queryMoto = "SELECT SUM(dist_total), SUM(diferenca) FROM `tb_trajeto` WHERE `data` >= '$dataInicial' AND `data` <= '$dataFinal' AND `fk_usuario` = '$usuario' AND `veiculo` = 'MOTO'";

$resultCarro = mysql_query($queryCarro) or die(mysql_error());

$resultMoto = mysql_query($queryMoto) or die(mysql_error());

$header = array('Data', 'Horário', 'Veículo', 'Ponto 1', 'Ponto 2', 'Ponto 3', 'Dist Total Km', 'Diferença Km' );

$header = $pdf->utf8DecodeArray($header);



$pdf->AddPage();

$pdf->Header();

$dataInicial = strtotime($dataInicial);
$dataFinal = strtotime($dataFinal);

$dataInicial = date('d/m/Y', $dataInicial);
$dataFinal = date('d/m/Y', $dataFinal);

$pdf->SetFont('Arial','',10);

$pdf->Cell(93,6,"Periodo: ".$dataInicial." a ".$dataFinal,0 ,0,'L',"");
$pdf->Cell(93,6,utf8_decode("Usuário - ".$usuarioNome),0 ,0,'R',"");

$pdf->Ln();

$pdf->Cell(93,6,utf8_decode("Preço da Gasolina: ").$precoGas,0 ,0,'L',"");

$pdf->SetFont('Arial','',6);

$pdf->Ln(10);

$pdf->FancyTable($header,$result);

$pdf->Ln();

$pdf->SetFillColor(204, 204, 204);

$pdf->Cell(186,6,"Carro",1,0,'C',true);
$pdf->Ln();
$pdf->Cell(46.5,6,utf8_decode("Distância Total em Km"),1,0,'C',true);
$pdf->Cell(46.5,6,utf8_decode("Diferença Total em Km"),1,0,'C',true);
$pdf->Cell(46.5,6,utf8_decode("( Total - Diferença ) em Km"),1,0,'C',true);
$pdf->Cell(46.5,6,utf8_decode("[ ( Total - Diferença ) / 10 ] * Preço da gasolina"),1,0,'C',true);
$pdf->Ln();

while ($carro = mysql_fetch_array($resultCarro, MYSQL_NUM)) {
	$pdf->Cell(46.5,6,number_format($carro[0], 3, '.', ''),'LR',0,'L',"");
	$pdf->Cell(46.5,6,number_format($carro[1], 3, '.', ''),'LR',0,'L',"");
	$dif = $carro[0] - $carro[1];
	$pdf->Cell(46.5,6,number_format($dif, 3, '.', ''),'LR',0,'L',"");
	$totalCarro = ($dif / 10) * $precoGas;
	$pdf->Cell(46.5,6,"R$ ".number_format($totalCarro, 2, ',', ''),'LR',0,'R',"");
}

$pdf->Ln();



$pdf->Cell(186,6,"Moto",1,0,'C',true);
$pdf->Ln();
$pdf->Cell(46.5,6,utf8_decode("Distância Total em Km"),1,0,'C',true);
$pdf->Cell(46.5,6,utf8_decode("Diferença Total em Km"),1,0,'C',true);
$pdf->Cell(46.5,6,utf8_decode("( Total - Diferença ) em Km"),1,0,'C',true);
$pdf->Cell(46.5,6,utf8_decode("[ ( Total - Diferença ) / 20 ] * Preço da gasolina"),1,0,'C',true);
$pdf->Ln();
while ($moto = mysql_fetch_array($resultMoto, MYSQL_NUM)) {
	$pdf->Cell(46.5,6,number_format($moto[0], 3, '.', ''),'LR',0,'L',"");
	$pdf->Cell(46.5,6,number_format($moto[1], 3, '.', ''),'LR',0,'L',"");
	$dif = $moto[0] - $moto[1];
	$pdf->Cell(46.5,6,number_format($dif, 3, '.', ''),'LR',0,'L',"");
	$totalMoto = ($dif / 20) * $precoGas;
	$pdf->Cell(46.5,6,"R$ ".number_format($totalMoto, 2, ',', ''),'LR',0,'R',"");
}

$total = "R$ ".number_format($totalMoto + $totalCarro, 2, ',', '');
$pdf->Ln();
$pdf->Cell(139.5,6,"",'T',0,'C',false);
$pdf->SetFont('Arial','',12);
$pdf->Cell(46.5,12,$total,1,0,'C',true);
$pdf->SetFont('Arial','',6);

      $pdf->ln(50);
      $pdf->Cell(186,6,"______________________________________________________________________________",0 ,0,'C',"");
	   $pdf->ln();
           $pdf->SetFont('Arial','',10);
      $pdf->Cell(186,6,utf8_decode($usuarioNome),0 ,0,'C',"");
     
$pdf->Footer();

$pdf->Output();
?>
