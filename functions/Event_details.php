<?php require_once '../data_base/banco_de_dados.php'; ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Evento</title>
    <link rel="stylesheet" href="../css/styless.css">
</head>
<body>
    <header>
        <h1>RP Events</h1>
        <form action="../functions/processar_busca.php" method="GET">
            <input type="text" id="busca" name="busca" placeholder="Buscar eventos...">
            <button type="submit">Pesquisar</button>
        </form>
    </header>

    <?php
    if (isset($_GET['id'])) {
        $id_evento = $_GET['id'];

        $sql = "SELECT * FROM events WHERE id = '$id_evento'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $titulo = $row['titulo'];
            $descricao = $row['descricao'];
            $data_evento = $row['data_evento'];
            $hora = $row['hora'];
            $local = $row['local'];
            $categoria = $row['categoria'];
            $preco = $row['preco'];
            $imagem = $row['imagem'];

            echo "<h2>$titulo</h2>";
            echo '<link rel="stylesheet" href="../css/styless.css">
                <img src="../img/' . $imagem . '" alt="Imagem do evento" class="imagem-evento">';
            echo "<p>$descricao</p>";
            echo "<p><strong>Data:</strong> $data_evento</p>";
            echo "<p><strong>Hora:</strong> $hora</p>";
            echo "<p><strong>Local:</strong> $local</p>";
            echo "<p><strong>Categoria:</strong> $categoria</p>";
            echo "<p><strong>Preço:</strong> R$ $preco</p>";

            session_start();
            if (isset($_SESSION['user'])) {
                $id_usuario = $_SESSION['user'];

                $sql_usuario = "SELECT tipo_usuario FROM users WHERE id = '$id_usuario'";
                $result_usuario = $conn->query($sql_usuario);

                if ($result_usuario->num_rows > 0) {
                    $row_usuario = $result_usuario->fetch_assoc();
                    $tipo_usuario = $row_usuario['tipo_usuario'];

                    if ($tipo_usuario === 'organizador' || $tipo_usuario === 'administrador') {
                        echo "<p>Usuários do tipo '$tipo_usuario' não podem se inscrever neste evento.</p>";
                    } else {
                        $sql_inscricao = "SELECT * FROM registrations WHERE id_usuario = '$id_usuario' AND id_evento = '$id_evento'";
                        $result_inscricao = $conn->query($sql_inscricao);

                        if ($result_inscricao->num_rows > 0) {
                            echo "<p>Você já está inscrito neste evento.</p>";
                        } else {
                            echo '<form action="../functions/processar_compra.php" method="POST">';
                            echo '<input type="hidden" name="id_usuario" value="' . $id_usuario . '">';
                            echo '<input type="hidden" name="id_evento" value="' . $id_evento . '">';
                            echo '<button type="submit" name="registrar">Comprar Ingresso</button>';
                            echo '</form>';
                        }
                    }
                } else {
                    echo "<p>Não foi possível obter informações do usuário.</p>";
                }
            } else {
                echo '<p>Faça login para comprar ingressos para este evento.</p>';
            }
        } else {
            echo "Evento não encontrado.";
        }
    } else {
        echo "ID do evento não fornecido.";
    }

    $conn->close();
    ?>
</body>
</html>
