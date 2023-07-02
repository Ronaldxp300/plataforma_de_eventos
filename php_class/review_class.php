<?php
class Review {
    private $evento;
    private $usuario;
    private $avaliacao;
    private $comentario;

    public function __construct($evento, $usuario, $avaliacao, $comentario) {
        $this->evento = $evento;
        $this->usuario = $usuario;
        $this->avaliacao = $avaliacao;
        $this->comentario = $comentario;
    }

    public function getEvento() {
        return $this->evento;
    }

    public function getUsuario() {
        return $this->usuario;
    }

    public function getAvaliacao() {
        return $this->avaliacao;
    }

    public function getComentario() {
        return $this->comentario;
    }

    // Setters
    public function setEvento($evento) {
        $this->evento = $evento;
    }

    public function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    public function setAvaliacao($avaliacao) {
        $this->avaliacao = $avaliacao;
    }

    public function setComentario($comentario) {
        $this->comentario = $comentario;
    }
}


