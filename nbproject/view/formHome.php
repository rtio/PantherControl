<?php
include_once '../dao/DaoDriverConexao.class.php';
include_once '../dao/DaoTrajeto.class.php';

function content() {
    global $usuario;
    $DAO = new TrajetoDAO();
    ?>

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
        </tr>
        <?php
        foreach ($DAO->Lista("SELECT * FROM tb_trajeto WHERE fk_usuario = '" . $usuario['id_usuario'] . "'") as $trajeto) {
            $timestamp = strtotime($trajeto['data']);

            $data = date('d/m/Y', $timestamp);

            echo '<tr>
            <td>' . $data . '</td>
            <td>' . $trajeto['periodo'] . '</td>
            <td>' . $trajeto['ponto_1'] . '</td>
            <td>' . $trajeto['ponto_2'] . '</td>
            <td>' . $trajeto['ponto_3'] . '</td>
            <td>' . $trajeto['dist_total'] . ' km</td>
            <td>' . $trajeto['veiculo'] . '</td>
    ';
        }
        ?>



    </table>         


    <?php
}

$activeHome = "active";
$title = "Home";
include_once 'template.php';
?>
