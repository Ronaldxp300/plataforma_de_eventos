<?php
$host = "localhost";
$db_name = "eventos";
$username = "root";
$password = "";


$conn = new mysqli($host, $username, $password, $db_name);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];


    $query = "SELECT * FROM events WHERE id = $id";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        $evento = $result->fetch_assoc();
    } else {
        echo "Evento não encontrado.";
        exit;
    }
} else {
    echo "ID inválido.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];
    $data_evento = $_POST['data_evento'];
    $hora = $_POST['hora'];
    $local = $_POST['local'];
    $categoria = $_POST['categoria'];
    $preco = $_POST['preco'];

    $query = "UPDATE events SET titulo = '$titulo', descricao = '$descricao', data_evento = '$data_evento', hora = '$hora', local = '$local', categoria = '$categoria', preco = '$preco' WHERE id = $id";

    if ($conn->query($query) === TRUE) {
        echo "Evento atualizado com sucesso.";
        header("Location: lista_eventos.php");
        exit;
    } else {
        echo "Erro ao atualizar o evento: " . $conn->error;
    }
}
?>