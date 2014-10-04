<?php
class Escola {
    
    private $codEscola;
    private $nome;
    private $endereco;
    private $bairro;
    
    public function getBairro() {
        return $this->bairro;
    }

    public function setBairro($bairro) {
        $this->bairro = $bairro;
    }

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

    function __construct($codEscola, $nome, $endereco, $bairro) {
        $this->codEscola = $codEscola;
        $this->nome = $nome;
        $this->endereco = $endereco;
        $this->bairro = $bairro;
    }


}