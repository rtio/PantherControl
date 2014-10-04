<?php

function content() {

    include_once '../entity/Empresa.class.php';

    $empresa = new Empresa();

    global $usuario;
        
        ?>
<meta charset="utf-8">

    <script src="http://maps.google.com/maps?file=api&v=2.x&key=ABQIAAAAVr5mPPLDy_bfjIr5EGw_YRQJJTmMFgh90lBDn52esDHY_5eerhR4K2UH2MlX9dgLKYgdvssFxiowiQ" type="text/javascript"></script>

    <script type="text/javascript" src="../static/js/ajax.js"></script>

    <script type="text/javascript" src="../static/js/distancia.js"></script>

    <form name="formTrajeto" class="form-horizontal" method="post" action="../model/postRota.php">

        <div class="form-group">
            <h5><label for="select" class="col-lg-1 control-label">Veiculo:</label></h5>
            <div class="col-lg-2">
                <select required class="form-control input-sm" name="veiculo">
                    <option selected disabled></option>
                    <option value="MOTO">MOTO</option>
                    <option value="CARRO">CARRO</option>
                </select>
            </div>
            <h5><label for="select" class="col-lg-1 control-label">Horário:</label></h4>
            <div class="col-lg-2">
                <select required class="form-control input-sm" id="select" name="periodo">
                    <option selected disabled></option>
                    <option value="AB">AB</option>
                    <option value="CD">CD</option>
                </select>
            </div>
            <h5><label for="data" class="col-lg-1 control-label">Data:</label></h5>
                <div class="col-lg-3">
                    <input type="date" class="form-control input-sm" required id="data" name="data">
                </div>
            
        </div>



        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Ponto 1</h3>
            </div>
            <div class="panel-body">
                <div class="radio">
                    <label>
                        <input type="radio" name="ponto1" id="ponto1" required value="<?php echo $usuario['endereco'] . ", " . $usuario['bairro'] . ", " . $usuario['cidade'] . ", " . $usuario['estado']; ?>">
                        Casa
                        <input type="hidden" name="ponto1persist" id="ponto1persist">
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="ponto1" id="ponto1-1" value="<?php echo $empresa->getEndereco(); ?>" required>
                        Computex
                        <input type="hidden" name="ponto1-1persist" id="ponto1-1persist">
                    </label>
                </div>
            </div>
        </div>


        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Ponto 2</h3>
            </div>
            <div class="panel-body">
                <div class="row">

                    <div class="col-lg-2">
                        <div class="input-group">
                            <span class="input-group-btn">
                                <button type="button" name="btnPesquisar" value="Pesquisar" onclick="getDados();" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
                            </span>
                            <div id="Pesquisar">
                                <input type="text" class="form-control" name="pesquisa" id="pesquisa" placeholder="Cód"/> 
                            </div>
                        </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->    

                    <div class="col-lg-3">
                        <input type="text" id="ponto2persist" name="ponto2persist" required class="form-control" placeholder="Nome da escola">
                    </div>
                    <div class="col-lg-6">
                        <input type="text" id="ponto2" name="ponto2" required class="form-control" placeholder="Endereço da escola">
                    </div>
                    <div id="loading"></div>
                </div>
            </div>
        </div>


        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Ponto 3</h3>
            </div>
            <div class="panel-body">
                <div class="radio">
                    <label>
                        <input type="radio" name="ponto3" id="ponto3" required value="<?php echo $usuario['endereco'] . ", " . $usuario['bairro'] . ", " . $usuario['cidade'] . ", " . $usuario['estado']; ?>">
                        Casa
                        <input type="hidden" name="ponto3persist" id="ponto3persist">
                    </label>
                </div>

                <div class="radio">
                    <label>
                        <input type="radio" name="ponto3" id="ponto3-1" value="<?php echo $empresa->getEndereco(); ?>" required>
                        Computex
                        <input type="hidden" name="ponto3-1persist" id="ponto3-1persist">
                    </label>
                </div>
            </div>
        </div>

        <button  type="button" onclick="initialize()" class="btn btn-primary btn-lg btn-block">
            <span class="glyphicon glyphicon-time"></span> Calcular Distância
        </button>

        </br>

        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Distancias em km</h3>
            </div>
            <div class="panel-body">
                                    <input class="form-control"  type="hidden" id="ab" name="dist_12" required/>
                                    <input class="form-control" type="hidden" id="bc" name="dist_23" required/>
                Distância A + B + C: <input class="form-control" type="text" id="abc" name="dist_total" required/>
            </div>
        </div>


        <input type=hidden name="id_usuario" value="<?php echo $usuario['id_usuario']; ?>">

        <button type="submit" class="btn btn-primary btn-lg btn-block">
            <span class="glyphicon glyphicon-plus"></span> Adicionar rota
        </button>


    </form>

    </br>

    <div id="mapa" style="z-index: 102; width: 600px; height: 300px; "></div>

    <?php
}

$activeRotas = "active";
$title = "Cadastro de rotas";
include_once 'template.php';
?>