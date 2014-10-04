<?php
class TrajetoDAO 
{
// irá receber uma conexão
	public $p = null;
// construtor

public function TrajetoDAO()
{
	$this->p = new Conexao();
}
// realiza uma inserção
public function Insere($trajeto)
{
	try
	{
	$stmt = $this->p->prepare("INSERT INTO tb_trajeto (fk_usuario, ponto_1, ponto_2, ponto_3, dist_12, dist_23, dist_total, data, periodo, veiculo, diferenca) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bindValue(1, $trajeto->getId_usuario());
        $stmt->bindValue(2, $trajeto->getPonto1());
	$stmt->bindValue(3, $trajeto->getPonto2());
	$stmt->bindValue(4, $trajeto->getPonto3());
        $stmt->bindValue(5, $trajeto->getDist_12());
        $stmt->bindValue(6, $trajeto->getDist_23());
        $stmt->bindValue(7, $trajeto->getDist_total());
        $stmt->bindValue(8, $trajeto->getData());
        $stmt->bindValue(9, $trajeto->getPeriodo());
        $stmt->bindValue(10, $trajeto->getVeiculo());
        $stmt->bindValue(11, $trajeto->getDiferenca());
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
	$num = $this->p->exec("DELETE FROM tb_trajeto WHERE id_trajeto=$id");
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
		$stmt = $this->p->query("SELECT * FROM `tb_trajeto`");
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


?>
