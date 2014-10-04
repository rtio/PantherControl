<?php
class Escola {
    private $nome;
    private $endereco;
    private $codEscola;
    
    public function getNome() {
        return $this->nome;
    }

    public function getEndereco() {
        return $this->endereco;
    }

    public function getCodEscola() {
        return $this->codEscola;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setEndereco($endereco) {
        $this->endereco = $endereco;
    }

    public function setCodEscola($codEscola) {
        $this->codEscola = $codEscola;
    }

    function __construct($codEscola, $nome, $endereco) {
        $this->codEscola = $codEscola;
		$this->nome = $nome;
        $this->endereco = $endereco;
    }   
}