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
    </header>

    <div class="detalhes_evento">
        <?php
        require_once '../data_base/banco_de_dados.php';

        // Verificar se o ID do evento foi fornecido na URL
        if (isset($_GET['id'])) {
            $id_evento = $_GET['id'];

            // Consultar as informações do evento pelo ID
            $sql = "SELECT * FROM events WHERE id = '$id_evento'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $titulo = $row['titulo'];
                $descricao = $row['descricao'];
                $imagem = $row['imagem'];

                echo "<h2>$titulo</h2>";
                echo '<img src="data:image/jpeg;base64,' . base64_encode($imagem) . '" alt="Imagem do evento">';
                echo "<p>$descricao</p>";

                // Verificar se o usuário está logado
                session_start();
                if (isset($_SESSION['user'])) {
                    $id_usuario = $_SESSION['user'];

                    // Verificar se o usuário já está inscrito no evento
                    $sql_inscricao = "SELECT * FROM registrations WHERE id_usuario = '$id_usuario' AND id_evento = '$id_evento'";
                    $result_inscricao = $conn->query($sql_inscricao);

                    if ($result_inscricao->num_rows > 0) {
                        // O usuário já está inscrito
                        echo "<p>Você já está inscrito neste evento.</p>";
                    } else {
                        // O usuário não está inscrito
                        echo '<form action="../functions/processar_compra.php" method="POST">';
                        echo '<input type="hidden" name="id_usuario" value="' . $id_usuario . '">';
                        echo '<input type="hidden" name="id_evento" value="' . $id_evento . '">';
                        echo '<button type="submit">Comprar Ingresso</button>';
                        echo '</form>';
                    }
                } else {
                    // O usuário não está logado
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
    </div>

</body>
</html>
