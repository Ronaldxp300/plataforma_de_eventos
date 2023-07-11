<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RP Events - Página Inicial</title>
    <link rel="stylesheet" href="../css/styless.css">
</head>
<body>
    <header>
        <h1>RP Events</h1>
        <form action="../functions/processar_busca.php" method="GET">
            <input type="text" id="busca" name="busca" placeholder="Buscar eventos...">
            <button type="submit">Pesquisar</button>
        </form>
        <button onclick="location.href='gerenciar_conta.php'" class="gerenciar_conta_btn">Gerenciar Conta</button>
        <button onclick="location.href='home.php'" class="logout">Sair</button>
    </header>

    <div class="eventos_destaque">
        <h2>Meus Eventos</h2>

        <?php
        session_start();

        if (!isset($_SESSION['user'])) {
            header("Location: ../pages/login.html");
            exit();
        }

        $id_usuario = $_SESSION['user'];

        $conn = new mysqli("localhost", "root", "", "eventos");

        if ($conn->connect_error) {
            die("Falha na conexão com o banco de dados: " . $conn->connect_error);
        }

        $sql_select_eventos = "SELECT * FROM events WHERE id_criador = '$id_usuario'";
        $result_eventos = $conn->query($sql_select_eventos);

        if ($result_eventos->num_rows > 0) {

            while ($row = $result_eventos->fetch_assoc()) {
                $evento_id = $row['id']; 
                $titulo = $row['titulo'];
                $descricao = $row['descricao'];
                $imagem = $row['imagem'];

                echo "<div class='evento'>";
                echo "<a href='../functions/editar_evento.php?id=$evento_id'>";
                echo "<img src='../img/$imagem' alt='Imagem do Evento'>";
                echo "<h3>$titulo</h3>";
                echo "</a>";
                echo "</div>";
            }
        } else {
            echo "<p>Você ainda não criou nenhum evento.</p>";
        }

        $conn->close();
        ?>
    </div>

    <div class="Criar_Evento">
        <a href="Create_event.html">Criar Evento</a>
    </div>
</body>
</html>
