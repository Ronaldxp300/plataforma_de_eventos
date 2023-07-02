<?php
session_start();

if (isset($_POST['registrar'])) {
    $id_usuario = $_POST['id_usuario'];
    $id_evento = $_POST['id_evento'];

    require_once '../data_base/banco_de_dados.php';

    $sql_inscricao = "SELECT * FROM registrations WHERE id_usuario = '$id_usuario' AND id_evento = '$id_evento'";
    $result_inscricao = $conn->query($sql_inscricao);

    if ($result_inscricao->num_rows > 0) {
        echo "Você já está inscrito neste evento.";
    } else {
        $sql_registrar = "INSERT INTO registrations (id_usuario, id_evento, status_pagamento) VALUES ('$id_usuario', '$id_evento', 'pendente')";

        if ($conn->query($sql_registrar) === TRUE) {
            echo "Registro realizado com sucesso!";
            header("Location: ../pages/home_participante.php");
            exit;
        } else {
            echo "Erro ao registrar no evento: " . $conn->error;
        }
    }

    $conn->close();
} else {
    echo "Ação inválida.";
}
?>
