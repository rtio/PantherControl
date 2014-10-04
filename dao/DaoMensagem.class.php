<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DaoMensagem
 *
 * @author rafael
 */
class MensagemDao {
// irá receber uma conexão
	public $p = null;
// construtor
public function MensagemDao()
{
	$this->p = new Conexao();
}
// realiza uma inserção
public function Insere($mensagem)
{
	try
	{
	$stmt = $this->p->prepare("INSERT INTO `tb_mensagem` (id_de, id_para, mensagem, data) VALUES (?, ?, ?, ?)");
	$stmt->bindValue(1, $mensagem->getId_de());
	$stmt->bindValue(2, $mensagem->getId_para());
	$stmt->bindValue(3, $mensagem->getMensagem());
        $stmt->bindValue(4, $mensagem->getData());
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

// remove um registro
public function Deleta( $id )
{
	try
	{
	$num = $this->p->exec("DELETE FROM `tb_mensagem` WHERE id_mensagem=$id");
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
		$stmt = $this->p->query("SELECT * FROM `tb_mensagem`");
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
