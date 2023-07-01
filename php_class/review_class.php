<?php
class Review {
    private $evento;
    private $usuario;
    private $avaliacao;
    private $comentario;

    // Construtor da classe
    public function __construct($evento, $usuario, $avaliacao, $comentario) {
        $this->evento = $evento;
        $this->usuario = $usuario;
        $this->avaliacao = $avaliacao;
        $this->comentario = $comentario;
    }

    // Getters
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

    // Função para exibir informações da avaliação
    public function exibirInformacoes() {
        echo "Evento: " . $this->evento . "<br>";
        echo "Usuário: " . $this->usuario . "<br>";
        echo "Avaliação: " . $this->avaliacao . "<br>";
        echo "Comentário: " . $this->comentario . "<br>";
    }
}

// Criando um objeto de avaliação
$avaliacao = new Review(
    "Concerto de Jazz",
    "João",
    4.5,
    "Ótimo concerto, adorei a performance dos músicos!"
);

// Exibindo as informações da avaliação
$avaliacao->exibirInformacoes();

// Alterando a avaliação e o comentário
$avaliacao->setAvaliacao(5.0);
$avaliacao->setComentario("Simplesmente incrível, um dos melhores eventos que já participei!");

// Exibindo as novas informações da avaliação
$avaliacao->exibirInformacoes();

