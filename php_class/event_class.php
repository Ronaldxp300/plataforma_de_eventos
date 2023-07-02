<?php
class Event {
    private $titulo;
    private $descricao;
    private $data;
    private $hora;
    private $local;
    private $categoria;
    private $preco;
    private $imagens;
   

    // Construtor da classe
    public function __construct($titulo, $descricao, $data, $hora, $local, $categoria, $preco, $imagens) {
        $this->titulo = $titulo;
        $this->descricao = $descricao;
        $this->data = $data;
        $this->hora = $hora;
        $this->local = $local;
        $this->categoria = $categoria;
        $this->preco = $preco;
        $this->imagens = $imagens;
    }
    // Getters
    public function getTitulo() {
        return $this->titulo;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function getData() {
        return $this->data;
    }

    public function getHora() {
        return $this->hora;
    }

    public function getLocal() {
        return $this->local;
    }

    public function getCategoria() {
        return $this->categoria;
    }

    public function getPreco() {
        return $this->preco;
    }

    public function getImagens() {
        return $this->imagens;
    }

    // Setters
    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    public function setData($data) {
        $this->data = $data;
    }

    public function setHora($hora) {
        $this->hora = $hora;
    }

    public function setLocal($local) {
        $this->local = $local;
    }

    public function setCategoria($categoria) {
        $this->categoria = $categoria;
    }

    public function setPreco($preco) {
        $this->preco = $preco;
    }

    public function setImagens($imagens) {
        $this->imagens = $imagens;
    }
}



