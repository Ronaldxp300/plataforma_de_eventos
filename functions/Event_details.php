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

        if (isset($_GET['id'])) {
            $id_evento = $_GET['id'];

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

                session_start();
                if (isset($_SESSION['user'])) {
                    $id_usuario = $_SESSION['user'];

                    $sql_inscricao = "SELECT * FROM registrations WHERE id_usuario = '$id_usuario' AND id_evento = '$id_evento'";
                    $result_inscricao = $conn->query($sql_inscricao);

                    if ($result_inscricao->num_rows > 0) {
                        echo "<p>Você já está inscrito neste evento.</p>";
                    } else {
                        echo '<form action="../functions/processar_compra.php" method="POST">';
                        echo '<input type="hidden" name="id_usuario" value="' . $id_usuario . '">';
                        echo '<input type="hidden" name="id_evento" value="' . $id_evento . '">';
                        echo '<button type="submit" name="registrar" onclick="exibirPopup()">Comprar Ingresso</button>';
                        echo '</form>';
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
    </div>

    <script>
        function exibirPopup() {
            alert("Inscrição realizada com sucesso!");
        }
    </script>

</body>
</html>
