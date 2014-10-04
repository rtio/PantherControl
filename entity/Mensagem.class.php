<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Mensagem
 *
 * @author rafael
 */
class Mensagem {
    private $id_de;
    private $id_para;
    private $mensagem;
    private $data;
    
    function __construct($id_de, $id_para, $mensagem, $data) {
        $this->id_de = $id_de;
        $this->id_para = $id_para;
        $this->mensagem = $mensagem;
        $this->data = $data;
    }

    public function getId_de() {
        return $this->id_de;
    }

    public function getId_para() {
        return $this->id_para;
    }

    public function getMensagem() {
        return $this->mensagem;
    }

    public function getData() {
        return $this->data;
    }

    public function setId_de($id_de) {
        $this->id_de = $id_de;
    }

    public function setId_para($id_para) {
        $this->id_para = $id_para;
    }

    public function setMensagem($mensagem) {
        $this->mensagem = $mensagem;
    }

    public function setData($data) {
        $this->data = $data;
    }


}
