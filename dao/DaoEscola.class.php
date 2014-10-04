<?php
class EscolaDAO 
{
// irá receber uma conexão
	public $p = null;
// construtor
public function EscolaDAO()
{
	$this->p = new Conexao();
}
// realiza uma inserção
public function Insere($escola)
{
	try
	{
            $stmt = $this->p->prepare("INSERT INTO tb_escola (codEscola, nome, endereco, bairro) VALUES (?, ?, ?, ?)");
            $stmt->bindValue(1, $escola->getCodEscola());
        	$stmt->bindValue(2, $escola->getNome());
        	$stmt->bindValue(3, $escola->getEndereco());
            $stmt->bindValue(4, $escola->getBairro());
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
public function Update( $escola, $condicao )
{
	try
	{
	// preparo a query de update – Prepare Statement
	$stmt = $this->p->prepare("UPDATE tb_escola SET codEscola=?, nome=?, endereco=? WHERE id_escola=?");
	$this->p->beginTransaction();
	$stmt->bindValue(1, $escola->getCodEscola());
	$stmt->bindValue(2, $escola->getNome());
	$stmt->bindValue(3, $escola->getEndereco());
	$stmt->bindValue(4, $condicao);
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
public function UpdateIfNotExists($escola, $codEscola)
{
	try
	{
	// preparo a query de update – Prepare Statement
	$stmt = $this->p->prepare("INSERT INTO tb_escola (codEscola, nome, endereco) VALUES (?, ?, ?) WHERE NOT EXISTS (SELECT * FROM tb_escola WHERE codEscola=?)");
	$this->p->beginTransaction();
	$stmt->bindValue(1, $escola->getCodEscola());
	$stmt->bindValue(2, $escola->getNome());
	$stmt->bindValue(3, $escola->getEndereco());
        $stmt->bindValue(4, $codEscola);
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
public function Deleta( $id_escola )
{
	try
	{
	$num = $this->p->exec("DELETE FROM `tb_escola` WHERE `id_escola` = '$id_usuario'");
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
                    $stmt = $this->p->query("SELECT * FROM tb_escola");
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