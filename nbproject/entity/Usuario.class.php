<?php

class Usuario {

    private $nome;
    private $email;
    private $senha;
    private $endereco;
    private $bairro;
    private $cidade;
    private $estado;
    
    public function getBairro() {
        return $this->bairro;
    }

    public function setBairro($bairro) 
    {
        if(is_string($bairro))
        {
            $this->bairro = $bairro;
        }
    }
    
    public function getNome() {
        return $this->nome;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function getEndereco() {
        return $this->endereco;
    }

    public function getCidade() {
        return $this->cidade;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function getNumCasa() {
        return $this->numCasa;
    }

    public function setNome($nome) 
    {
        if(is_string($nome))
        {
            $this->nome = $nome;
        }
    }

    public function setEmail($email) 
    {
        if(is_string($email))
        {
            $this->email = $email;
        }
    }

    public function setSenha($senha) 
    {
        if(is_string($senha))
        {
            $this->senha = sha1($senha);
        }
    }

    public function setEndereco($endereco) 
    {
        if(is_string($endereco))
        {
            $this->endereco = $endereco;
        }
    }

    public function setCidade($cidade) 
    {
        if(is_string($cidade))
        {
            $this->cidade = $cidade;
        }
    }

    public function setEstado($estado) 
    {
        if(is_string($estado))
        {
            $this->estado = $estado;
        }
    }

    
    function __construct($nome, $email, $senha, $endereco, $bairro, $cidade, $estado) 
    {
        $this->nome = $nome;
        $this->email = $email;
        $this->senha = sha1(md5($senha));
        $this->endereco = $endereco;
        $this->bairro = $bairro;
        $this->cidade = $cidade;
        $this->estado = $estado;
    }



}

