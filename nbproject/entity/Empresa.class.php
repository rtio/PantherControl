<?php 
class Empresa
{
    private $nome;
    private $endereco;
    
    public function getNome() {
        return $this->nome;
    }

    public function getEndereco() {
        return $this->endereco;
    }

    function __construct() {
        $this->nome = "Computex";
        $this->endereco = "Rua Barão de Aratanha, 1485";
    }
}