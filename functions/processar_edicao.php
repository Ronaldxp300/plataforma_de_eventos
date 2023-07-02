<?php
require_once '../data_base/banco_de_dados.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $evento_id = $_POST['id'];
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];
    $data_evento = $_POST['data_evento'];
    $hora = $_POST['hora'];
    $local = $_POST['local'];
    $categoria = $_POST['categoria'];
    $preco = $_POST['preco'];

    $sql_update_evento = "UPDATE events SET titulo = '$titulo', descricao = '$descricao', data_evento = '$data_evento', hora = '$hora', local = '$local', categoria = '$categoria', preco = '$preco' WHERE id = $evento_id";

    if ($conn->query($sql_update_evento) === TRUE) {
        echo "<script>alert('Evento atualizado com sucesso!');</script>";
        echo "<script>window.location.href = '../pages/home_organizador.php';</script>";
    } else {
        echo "Erro ao atualizar o evento: " . $conn->error;
    }
}

$conn->close();
?>
