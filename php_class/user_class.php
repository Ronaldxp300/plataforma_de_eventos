<?php
class Usuario {
    private $id;
    private $nome;
    private $email;
    private $senha;
    private $tipo_usuario;

    public function __construct($nome, $email, $senha, $tipo_usuario) {
        $this->nome = $nome;
        $this->email = $email;
        $this->senha = $senha;
        $this->tipo_usuario = $tipo_usuario;
    }

    // Getters
    public function getId() {
        return $this->id;
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

    public function getTipo_usuario() {
        return $this->tipo_usuario;
    }

    // Setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setSenha($senha) {
        $this->senha = $senha;
    }

    public function setTipo_usuario($tipo_usuario) {
        $this->tipo_usuario = $tipo_usuario;
    }

}

