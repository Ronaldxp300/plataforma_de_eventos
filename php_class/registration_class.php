<?php
class Registration {
    private $evento;
    private $usuario;
    private $dataInscricao;
    private $valorPago;

    // Construtor da classe
    public function __construct($evento, $usuario, $dataInscricao, $valorPago) {
        $this->evento = $evento;
        $this->usuario = $usuario;
        $this->dataInscricao = $dataInscricao;
        $this->valorPago = $valorPago;
    }

    // Getters
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

    // Setters
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

    // Função para exibir informações da inscrição
    public function exibirInformacoes() {
        echo "Evento: " . $this->evento . "<br>";
        echo "Usuário: " . $this->usuario . "<br>";
        echo "Data de Inscrição: " . $this->dataInscricao . "<br>";
        echo "Valor Pago: " . $this->valorPago . "<br>";
    }
}
