<?php
$link = mysql_connect('localhost', 'root', '');

mysql_select_db('projectx', $link);

$dataInicial = "2013-9-18";

$dataFinal = "2013-9-19";

$usuario = 4;

$queryCarro = "SELECT SUM(dist_total), SUM(diferenca) FROM `tb_trajeto` WHERE `data` >= '$dataInicial' AND `data` <= '$dataFinal' AND `fk_usuario` = '$usuario' AND `veiculo` = 'CARRO'";

$queryMoto = "SELECT SUM(dist_total), SUM(diferenca) FROM `tb_trajeto` WHERE `data` >= '$dataInicial' AND `data` <= '$dataFinal' AND `fk_usuario` = '$usuario' AND `veiculo` = 'CARRO'";

$resultCarro = mysql_query($queryCarro);

$resultMoto = mysql_query($queryMoto);

while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
    echo number_format($row[0], 3, '.', '')." ".number_format($row[1], 3, '.', '');
}

?>