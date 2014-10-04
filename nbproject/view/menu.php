    <ul class="nav navbar-nav">
      <li class="<?php echo $activeHome; ?>"><a href="<?php echo 'formHome.php'; ?>">Home</a></li>
      <li class="<?php echo $activeRotas; ?>"><a href="<?php echo 'formRota.php'; ?>">Cadastrar rotas</a></li>
      <li class="<?php echo $activeUsuario; ?>"><a href="<?php echo 'formUsuario.php'; ?>">Cadastrar usuário</a></li>
      <li class="<?php echo $activeEscola; ?>"><a href="<?php echo 'formEscola.php'; ?>">Cadastrar escola</a></li>
      <li class="<?php echo $activeArquivo; ?>"><a href="<?php echo 'formArquivo.php'; ?>">Importar banco</a></li>
    </ul>

<ui class="nav navbar-nav navbar-right">
      <?php  
      if(!empty($_SESSION['usuario']))
      {
          echo '<li><a>'.$usuario['nome'].'</a></li>';
          echo '<li><a href="../control/logout.php">Sair</a></li>';
      }
      ?>
</ui>    
