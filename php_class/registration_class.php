<?php
class Registration {
    private $evento;
    private $usuario;
    private $dataInscricao;
    private $valorPago;

    public function __construct($evento, $usuario, $dataInscricao, $valorPago) {
        $this->evento = $evento;
        $this->usuario = $usuario;
        $this->dataInscricao = $dataInscricao;
        $this->valorPago = $valorPago;
    }

    public function getEvento() {
        return $this->evento;
    }

    public function getUsuario() {
        return $this->usuario;
    }

    public function getDataInscricao() {
        return $this->dataInscricao;
    }

    public function getValorPago() {
        return $this->valorPago;
    }

    public function setEvento($evento) {
        $this->evento = $evento;
    }

    public function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    public function setDataInscricao($dataInscricao) {
        $this->dataInscricao = $dataInscricao;
    }

    public function setValorPago($valorPago) {
        $this->valorPago = $valorPago;
    }
}