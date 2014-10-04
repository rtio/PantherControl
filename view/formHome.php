<?php
include_once '../dao/DaoDriverConexao.class.php';
include_once '../dao/DaoTrajeto.class.php';

function content() {
    global $usuario;
    $DAO = new TrajetoDAO();
    ?>
    <form class="form-inline" role="form" method="POST" action="../rel/relPorData.php" target="_blank">
        <div class="row">
            <div class="form-group col-lg-3">
                <label class="label label-default" for="dataInicial">Data inicial</label>
                <input type="date" class="form-control" id="dataInicial" name="dataInicial" required>
            </div>
            <div class="form-group col-lg-3">
                <label class="label label-default" for="dataFinal">Data final</label>
                <input type="date" class="form-control" id="dataFinal" name="dataFinal" required>
            </div>
            <div class="form-group col-lg-3">
                <label class="label label-default" for="precoGasolina">Preço da Gasolina</label>
                <input type="text" class="form-control money" id="precoGasolina" name="precoGasolina" placeholder ="Preço da Gasolina" required>
            </div>
            <div class="form-group col-lg-3">
                <label class="label label-default" for="imprimir">Preencher tudo antes</label>
                <button type="submit" id="imprimir"class="btn btn-default"><span class="glyphicon glyphicon-print"></span> Imprimir</button>
            </div>
        </div>
        <input type="hidden" name="usuario_nome" value="<?php echo $usuario['nome']; ?>">
        <input type="hidden" name="usuario_id" value="<?php echo $usuario['id_usuario']; ?>">
    </form>
</br>
    <table class="table table-hover table-striped table-condensed">
        <tr>
            <th>
                Data
            </th>
            <th>
                Horário
            </th>
            <th>
                Ponto 1
            </th>
            <th>
                Ponto 2
            </th>
            <th>
                Ponto 3
            </th>
            <th>
                Sub Total
            </th>
            <th>
                Veículo
            </th>
            <th>
                Ações
            </th>
        </tr>
        <?php
        foreach ($DAO->Lista("SELECT * FROM tb_trajeto WHERE fk_usuario = '" . $usuario['id_usuario'] . "' ORDER BY `data`") as $trajeto) {
            $timestamp = strtotime($trajeto['data']);

            $data = date('d/m/Y', $timestamp);

            echo '<tr>
            <td>' . $data . '</td>
            <td>' . $trajeto['periodo'] . '</td>
            <td>' . $trajeto['ponto_1'] . '</td>
            <td>' . utf8_encode($trajeto['ponto_2']) . '</td>
            <td>' . $trajeto['ponto_3'] . '</td>
            <td>' . $trajeto['dist_total'] . ' km</td>
            <td>' . $trajeto['veiculo'] . '</td>
            <td><a href="../control/deletarTrajeto.php?id_trajeto='.$trajeto['id_trajeto'].'" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove"></span></a>
    ';
        }
        ?>



    </table>  
            <script src="../static/js/jquery.min.js"></script>
            <script src="../static/js/jquery.mask.min.js"></script>
            <script src="../static/bootstrap/js/bootstrap.min.js"></script>
<script>
$(function() {
    $('.money').mask('#.##0.00', {reverse: true, maxlength: false});
  });
</script>
    <?php
}

$activeHome = "active";
$title = "Home";
include_once 'template.php';
?>
