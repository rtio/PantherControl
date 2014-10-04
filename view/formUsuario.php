<?php
$title = "Cadastro de usuário";
$activeUsuario = "active";
function content(){
?>
        <form method="post" action="../model/postUsuario.php" class="form-horizontal" role="form">
            
            
   <div class="form-group">
            
            <input type="text" class="form-control" name="nome" placeholder="Nome" required>
 </div>
        <div class="form-group">    
            <input type="email" class="form-control" name="email" placeholder="email@computex.com.br" required>
             </div>
        <div class="form-group">    
            <input type="password" class="form-control" name="senha" placeholder="Senha" required>
             </div>
       <div class="form-group">     
            <input type="text" class="form-control" name="endereco" placeholder="Endereço" required>
             </div>
       <div class="form-group">     
            <input type="text" class="form-control" name="bairro" placeholder="Bairro" required>
             </div>
      <div class="form-group">      
            <input type="text" class="form-control" name="cidade" placeholder="Cidade" required>
             </div>
        <div class="form-group">    
            <select name="estado" class="form-control" required>
                   <option value="" selected disabled>Selecione o estado</option>
                    <?php
                        mysql_connect("localhost","root","12345");
                        mysql_select_db("projectx");
                        $resultado = mysql_query("SELECT sigla, nome FROM tb_estado ORDER BY sigla") or die ('A consulta falhou: ' . mysql_error());
                        while($arrayCidades = mysql_fetch_array($resultado))
                        { 
                            echo '<option value="'.$arrayCidades['sigla'].'">'.$arrayCidades['sigla'].'</option>';
                        } 
                    ?>
            </select>
             </div>
       <div class="form-group">     
            <button type="submit" class="btn btn-primary btn-lg btn-block">
                <span class="glyphicon glyphicon-saved"></span> Salvar
            </button>
             </div>

            </div>
        </form>
<?php
}
include_once 'template.php';
?>
