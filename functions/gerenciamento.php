<?php
$host = "localhost";
$db_name = "eventos";
$username = "root";
$password = "";

// Criar conexão
$conn = new mysqli($host, $username, $password, $db_name);

// Checar conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Função para obter todos os eventos do banco de dados
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

// Função para obter todas as inscrições do banco de dados
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

// Função para obter todos os participantes do banco de dados
function getParticipantes()
{
    global $conn;
    $participantes = array();

    $sql = "SELECT * FROM users WHERE tipo_usuario = 'participante'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $participantes[] = $row;
        }
    }

    return $participantes;
}

// Função para deletar um evento pelo ID
function deletarEvento($id)
{
    global $conn;
    $id = $conn->real_escape_string($id);
    $sql = "DELETE FROM events WHERE id = $id";
    $conn->query($sql);
}

// Função para deletar uma inscrição pelo ID
function deletarInscricao($id)
{
    global $conn;
    $id = $conn->real_escape_string($id);
    $sql = "DELETE FROM registrations WHERE id = $id";
    $conn->query($sql);
}

// Função para deletar um participante pelo ID
function deletarParticipante($id)
{
    global $conn;
    $id = $conn->real_escape_string($id);
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

