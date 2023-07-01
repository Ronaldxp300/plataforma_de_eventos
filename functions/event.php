<?php
require_once '../php_class/event_class.php';
require_once '../data_base/banco_de_dados.php';

// Verifica se o formulário foi enviado via método POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar se todas as variáveis foram enviadas
    $requiredFields = ['titulo', 'descricao', 'data_evento', 'hora', 'local', 'categoria', 'preco'];
    $missingFields = array_filter($requiredFields, function ($field) {
        return empty($_POST[$field]);
    });

    if (!empty($missingFields)) {
        $error_message = "Por favor, preencha todos os campos do formulário.";
        echo "<script>alert('$error_message');</script>";
        exit();
    }

    // Obter os valores do formulário
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];
    $data_evento = $_POST['data_evento'];
    $hora = $_POST['hora'];
    $local = $_POST['local'];
    $categoria = $_POST['categoria'];
    $preco = $_POST['preco'];

    // Verificar se a imagem foi enviada corretamente
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === 0) {
        $imagem = $_FILES['imagem'];

        // Informações sobre a imagem
        $nome = $imagem['name'];
        $tipo = $imagem['type'];
        $tamanho = $imagem['size'];
        $caminho_temporario = $imagem['tmp_name'];

        // Diretório de destino para salvar a imagem
        $diretorio_destino = '../img/'; // Substitua pelo diretório correto

        // Verificar se o tipo de arquivo é válido
        $tipos_permitidos = ['image/jpeg', 'image/png']; // Adicione outros tipos permitidos, se necessário

        if (!in_array($tipo, $tipos_permitidos)) {
            $error_message = "Tipo de arquivo não suportado. Por favor, envie uma imagem JPEG ou PNG.";
            echo "<script>alert('$error_message');</script>";
            exit();
        }

        // Gerar um nome único para a imagem
        $nome_unico = uniqid() . '_' . $nome;

        // Mover o arquivo temporário para o diretório de destino
        if (move_uploaded_file($caminho_temporario, $diretorio_destino . $nome_unico)) {
            // Conectar ao banco de dados
            $conn = new mysqli("localhost", "root", "", "eventos");

            // Verificar se houve erros na conexão
            if ($conn->connect_error) {
                die("Falha na conexão com o banco de dados: " . $conn->connect_error);
            }

            // Verificar se o título já está cadastrado
            $sql_check_event_titulo = "SELECT * FROM events WHERE titulo = '$titulo'";
            $result_event_titulo = $conn->query($sql_check_event_titulo);

            if ($result_event_titulo->num_rows > 0) {
                $error_message = "Já existe um evento com esse título. Por favor, utilize outro título.";
                echo "<script>alert('$error_message');</script>";
                exit();
            }

            // Obter o ID do criador do evento
            session_start();
            if (!isset($_SESSION['user'])) {
                $error_message = "Usuário não autenticado. Faça login para criar um evento.";
                echo "<script>alert('$error_message');</script>";
                exit();
            }
            $id_criador = $_SESSION['user'];

            // Criação do objeto Event
            $evento = new Event($titulo, $descricao, $data_evento, $hora, $local, $categoria, $preco, $nome_unico, $id_criador);

            // Inserir os dados no banco de dados
            $sql_insert_event = "INSERT INTO events (titulo, descricao, data_evento, hora, local, categoria, preco, imagem, id_criador) VALUES ('$titulo', '$descricao', '$data_evento', '$hora', '$local', '$categoria', '$preco', '$nome_unico', '$id_criador')";

            if ($conn->query($sql_insert_event) === TRUE) {
                $success_message = "Evento criado com sucesso!";
                echo "<script>alert('$success_message'); window.location.href = '../pages/home.html';</script>";
                exit();
            } else {
                $error_message = "Erro ao realizar o registro: " . $conn->error;
                echo "<script>alert('$error_message');</script>";
                exit();
            }

            // Fechar a conexão com o banco de dados
            $conn->close();
        } else {
            $error_message = 'Erro ao salvar a imagem.';
            echo "<script>alert('$error_message');</script>";
            exit();
        }
    } else {
        $error_message = 'Erro no envio da imagem.';
        echo "<script>alert('$error_message');</script>";
        exit();
    }
}
?>
