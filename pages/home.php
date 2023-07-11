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
        <div class="login_criacao_conta">
            <div class="login">
                <a href="login.html">Login</a>
            </div>
            <div class="criacao_conta">
                <a href="User_registration.html">Criar conta</a>
            </div>
        </div>
    </header>

    <div class="eventos_destaque">
        <h2>Eventos em destaque</h2>
        
        <?php
        require_once '../data_base/banco_de_dados.php';

        $sql = "SELECT events.id, events.titulo, events.imagem, COUNT(registrations.id) AS total_inscricoes
                FROM events
                LEFT JOIN registrations ON events.id = registrations.id_evento
                GROUP BY events.id
                ORDER BY total_inscricoes DESC
                LIMIT 6";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $evento_id = $row['id']; 
                $titulo = $row['titulo'];
                $imagem = $row['imagem'];

                echo "<div class='evento'>";
                echo "<a href='../functions/event_details.php?id=$evento_id'>";
                echo "<img src='../img/$imagem' alt='Imagem do Evento' class='imagem-evento'>";
                echo "<h3>$titulo</h3>";
                echo "</a>";
                echo "</div>";
            }
        } else {
            echo "Nenhum evento cadastrado";
        }

        $conn->close();
        ?>
    </div>

</body>
</html>