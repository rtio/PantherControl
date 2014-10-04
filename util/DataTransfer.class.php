<?php

class DataTransfer
{
	function getData($arq_transf, $usuario)
	{

			$arq_open = fopen($arq_transf, "rw");
		
			$linha_transf = array();
		
			while(!feof($arq_open)) 
			{
		
				$linha_transf[] = fgets($arq_open);
			
			}
			
			fclose($arq_open);
			
			foreach($linha_transf as $dados)
			{
				$arrEscolas = explode(";", $dados);
					
					$escola = new Escola($arrEscolas[0], $arrEscolas[1], $arrEscolas[2], $arrEscolas[3]);
			
					$DAO = new EscolaDAO();
			
					$DAO ->Insere($escola, $usuario);
			}
	}
}