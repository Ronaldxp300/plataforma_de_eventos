<?php
require_once '../data_base/banco_de_dados.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function getEventos()
{
    global $conn;
    $eventos = array();

    $sql = "SELECT * FROM events";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $eventos[] = $row;
        }
    }

    return $eventos;
}

function getInscricoes()
{
    global $conn;
    $inscricoes = array();

    $sql = "SELECT * FROM registrations";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $inscricoes[] = $row;
        }
    }

    return $inscricoes;
}

function getParticipantes()
{
    global $conn;
    $participantes = array();

    $sql = "SELECT * FROM users WHERE tipo_usuario IN ('participante', 'organizador')";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $participantes[] = $row;
        }
    }

    return $participantes;
}


function getNomeEvento($id)
{
    global $conn;
    $id = $conn->real_escape_string($id);
    $sql = "SELECT titulo FROM events WHERE id = $id";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['titulo'];
    }

    return "";
}

function getNomeParticipante($id)
{
    global $conn;
    $id = $conn->real_escape_string($id);
    $sql = "SELECT nome FROM users WHERE id = $id";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['nome'];
    }

    return "";
}


function deletarEvento($id)
{
    global $conn;
    $id = $conn->real_escape_string($id);

    $sql = "DELETE FROM registrations WHERE id_evento = $id";
    $conn->query($sql);

    $sql = "DELETE FROM users WHERE id IN (SELECT id_usuario FROM registrations WHERE id_evento = $id)";
    $conn->query($sql);

    $sql = "DELETE FROM reviews WHERE id_evento = $id";
    $conn->query($sql);

    $sql = "DELETE FROM events WHERE id = $id";
    $conn->query($sql);
}

function deletarInscricao($id)
{
    global $conn;
    $id = $conn->real_escape_string($id);
    $sql = "DELETE FROM registrations WHERE id = $id";
    $conn->query($sql);
}

function deletarParticipante($id)
{
    global $conn;
    $id = $conn->real_escape_string($id);

    $sql = "DELETE FROM registrations WHERE id_usuario = $id";
    $conn->query($sql);

    $sql = "DELETE FROM reviews WHERE id_usuario = $id";
    $conn->query($sql);

    $sql = "SELECT id FROM events WHERE id_criador = $id";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $id_evento = $row["id"];

        $sql = "DELETE FROM registrations WHERE id_evento = $id_evento";
        $conn->query($sql);

        $sql = "DELETE FROM events WHERE id = $id_evento";
        $conn->query($sql);
    }

    $sql = "DELETE FROM users WHERE id = $id";
    $conn->query($sql);
}


if (isset($_GET['action'])) {
    $action = $_GET['action'];

    switch ($action) {
        case 'deletar_evento':
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                deletarEvento($id);
                header("Location: gerenciamento.php");
                exit();
            }
            break;
        case 'deletar_inscricao':
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                deletarInscricao($id);
                header("Location: gerenciamento.php");
                exit();
            }
            break;
        case 'deletar_participante':
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                deletarParticipante($id);
                header("Location: gerenciamento.php");
                exit();
            }
            break;
    }
}
?>

