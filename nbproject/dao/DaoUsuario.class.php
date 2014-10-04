<?php
class UsuarioDAO 
{
// irá receber uma conexão
	public $p = null;
// construtor
public function UsuarioDAO()
{
	$this->p = new Conexao();
}
// realiza uma inserção
public function Insere($usuario)
{
	try
	{
	$stmt = $this->p->prepare("INSERT INTO tb_usuario (nome, email, senha, endereco, bairro, cidade, estado) VALUES (?, ?, ?, ?, ?, ?, ?)");
	$stmt->bindValue(1, $usuario->getNome());
	$stmt->bindValue(2, $usuario->getEmail());
	$stmt->bindValue(3, $usuario->getSenha());
        $stmt->bindValue(4, $usuario->getEndereco());
        $stmt->bindValue(5, $usuario->getBairro());
        $stmt->bindValue(6, $usuario->getCidade());
        $stmt->bindValue(7, $usuario->getEstado());
	$stmt->execute();
	// fecho a conexão
	$this->p = null;
	// caso ocorra um erro, retorna o erro;
	}
	catch ( PDOException $ex )
	{  
		echo "Erro: ".$ex->getMessage(); 
	}
}
// realiza um Update
public function Update( $usuario, $condicao )
{
	try
	{
	// preparo a query de update – Prepare Statement
	$stmt = $this->p->prepare("UPDATE tb_usuario SET nome=?, email=?, senha=?, endereco=?, bairro=?, cidade=?, estado=? WHERE id_usuario=?");
	$this->p->beginTransaction();
	$stmt->bindValue(1, $usuario->getNome());
	$stmt->bindValue(2, $usuario->getEmail());
	$stmt->bindValue(3, $usuario->getSenha());
        $stmt->bindValue(4, $usuario->getEndereco());
        $stmt->bindValue(5, $usuario->getBairro());
        $stmt->bindValue(6, $usuario->getCidade());
        $stmt->bindValue(7, $usuario->getEstado());
	$stmt->bindValue(8, $condicao);
	// executo a query preparada
	$stmt->execute();
	$this->p->commit();
	// fecho a conexão
	$this->p = null;
	}
	catch ( PDOException $ex )
	{
		echo "Erro: ".$ex->getMessage();
	}
}
// remove um registro
public function Deleta( $id )
{
	try
	{
	$num = $this->p->exec("DELETE FROM tb_usuario WHERE id_usuario=$id");
	// caso seja execuado ele retorna o número de rows que foram afetadas.
	if( $num >= 1 )
		{
			return $num;
		} 
		else 
		{
			return 0;
		}
// caso ocorra um erro, retorna o erro;
	}
		catch ( PDOException $ex ){  echo "Erro: ".$ex->getMessage(); 
	}
}
public function Lista($query=null)
{
	try
	{
		if( $query == null )
		{
		$stmt = $this->p->query("SELECT * FROM tb_usuario");
		}
		else
		{
		$stmt = $this->p->query($query);
		}
		$this->p = null;
		return $stmt;
	}
		catch ( PDOException $ex )
		{  
			echo "Erro: ".$ex->getMessage(); 
		}
}
}