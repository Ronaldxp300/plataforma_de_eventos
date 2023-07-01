<?php
$host = "localhost";
$db_name = "eventos";
$username = "root";
$password = "";

$conn = new mysqli($host, $username, $password, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
<?php

    /*CREATE database Eventos;
    
    CREATE TABLE users (
    id INT(6) UNSIGNED AUTO_INCREMENT,
    nome VARCHAR(40) NOT NULL,
    email VARCHAR(40) NOT NULL,
    senha VARCHAR(25) NOT NULL,
    tipo_usuario ENUM('organizador', 'participante', 'administrador') NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE events (
    id INT(6) UNSIGNED AUTO_INCREMENT,
    titulo VARCHAR(45) NOT NULL,
    descricao VARCHAR(200) NOT NULL,
    data_evento DATE NOT NULL,
    hora TIME NOT NULL,
    local VARCHAR(45),
    categoria VARCHAR(45),
    preco DECIMAL(10, 2),
    imagem LONGBLOB,
    PRIMARY KEY (id)
    COLUMN id_criador INT(6) UNSIGNED,
    FOREIGN KEY (id_criador) REFERENCES users (id);
);

CREATE TABLE registrations (
    id INT(6) UNSIGNED AUTO_INCREMENT,
    id_usuario INT(6) UNSIGNED,
    id_evento INT(6) UNSIGNED,
    status_pagamento ENUM('pendente', 'pago') NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (id_usuario) REFERENCES users (id),
    FOREIGN KEY (id_evento) REFERENCES events (id)
);

CREATE TABLE reviews (
    id INT(6) UNSIGNED AUTO_INCREMENT,
    id_usuario INT(6) UNSIGNED,
    id_evento INT(6) UNSIGNED,
    pontuacao INT(2) NOT NULL,
    comentario VARCHAR(100),
    PRIMARY KEY (id),
    FOREIGN KEY (id_usuario) REFERENCES users (id),
    FOREIGN KEY (id_evento) REFERENCES events (id)
);

CREATE TABLE categories (
    id INT(6) UNSIGNED AUTO_INCREMENT,
    nome VARCHAR(45),
    PRIMARY KEY (id)
);
*/
