<?php
$title = "Cadastro de escola";
$activeEscola = "active";
function content(){
?>
        <form method="post" class="form-horizontal" action="../model/postEscola.php">
            <div class="form-group">
            <input type="text" class="form-control" name="codEscola" placeholder="Código da Escola" required>
            </div>
            <div class="form-group">
            <input type="text" class="form-control" name="nome" placeholder="Nome" required>
            </div>
            <div class="form-group">
            <input type="text" class="form-control" name="endereco" placeholder="Endereço" required>
            </div>
             <div class="form-group">     
            <button type="submit" class="btn btn-primary btn-lg btn-block">
                <span class="glyphicon glyphicon-saved"></span> Salvar
            </button>
             </div>
            
        </form>

<?php
}
include_once 'template.php';
?>