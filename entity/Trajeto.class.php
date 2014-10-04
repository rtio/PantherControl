<?php
include_once 'Usuario.class.php';
class Trajeto {
    private $ponto1;
    private $ponto2;
    private $ponto3;
    private $dist_12;
    private $dist_23;
    private $dist_total;
    private $data;
    private $periodo;
    private $id_usuario;
    private $veiculo;
    private $diferenca;
    
    public function getDiferenca() {
        return $this->diferenca;
    }

    public function setDiferenca($diferenca) {
        $this->diferenca = $diferenca;
    }

        public function getVeiculo() {
        return $this->veiculo;
    }

    public function setVeiculo($veiculo) {
        $this->veiculo = $veiculo;
    }

        public function getId_usuario() {
        return $this->id_usuario;
    }

    public function setId_usuario($id_usuario) {
        $this->id_usuario = $id_usuario;
    }

        public function getPonto1() {
        return $this->ponto1;
    }

    public function getPonto2() {
        return $this->ponto2;
    }

    public function getPonto3() {
        return $this->ponto3;
    }

    public function getDist_12() {
        return $this->dist_12;
    }

    public function getDist_23() {
        return $this->dist_23;
    }

    public function getDist_total() {
        return $this->dist_total;
    }

    public function getData() {
        return $this->data;
    }

    public function getPeriodo() {
        return $this->periodo;
    }

    public function setPonto1($ponto1) {
        $this->ponto1 = $ponto1;
    }

    public function setPonto2($ponto2) {
        $this->ponto2 = $ponto2;
    }

    public function setPonto3($ponto3) {
        $this->ponto3 = $ponto3;
    }

    public function setDist_12($dist_12) {
        $this->dist_12 = $dist_12;
    }

    public function setDist_23($dist_23) {
        $this->dist_23 = $dist_23;
    }

    public function setDist_total($dist_total) {
        $this->dist_total = $dist_total;
    }

    public function setData($data) {
        $this->data = $data;
    }

    public function setPeriodo($periodo) {
        $this->periodo = $periodo;
    }
    function __construct($ponto1, $ponto2, $ponto3, $dist_12, $dist_23, $dist_total, $data, $periodo, $id_usuario, $veiculo, $diferenca) {
        $this->ponto1 = $ponto1;
        $this->ponto2 = $ponto2;
        $this->ponto3 = $ponto3;
        $this->dist_12 = $dist_12;
        $this->dist_23 = $dist_23;
        $this->dist_total = $dist_total;
        $this->data = $data;
        $this->periodo = $periodo;
        $this->id_usuario = $id_usuario;
        $this->veiculo = $veiculo;
        $this->diferenca = $diferenca;
    }





}

