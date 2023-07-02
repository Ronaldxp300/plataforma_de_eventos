<?php
require_once '../data_base/banco_de_dados.php';

class EventoSearch {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function buscarEventos($pesquisa) {
        $pesquisa = $this->conn->real_escape_string($pesquisa);
        $sql_code = "SELECT * FROM events WHERE titulo LIKE '%$pesquisa%' OR descricao LIKE '%$pesquisa%'";

        $sql_query = $this->conn->query($sql_code) or die("ERRO NA BUSCA!" . $this->conn->error);

        if ($sql_query->num_rows == 0) {
            echo 'Nenhum resultado encontrado';
        } else {
            while ($dados = $sql_query->fetch_assoc()) {
                echo '<div class="evento">';
                echo '<a href="event_details.php?id=' . $dados['id'] . '">';
                echo '<h3>' . $dados['titulo'] . '</h3>';
                echo '<img src="../img/' . $dados['imagem'] . '" alt="Imagem do Evento">';
                echo '</a>';
                echo '</div>';
            }
        }
    }
}

?>

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
    </header>

    <div class="buscar_eventos">
        <?php
        if (empty($_GET['busca'])) {
            echo "Digite algo para fazer a busca...";
        } else {
            $conn = new mysqli("localhost", "root", "", "eventos");

            if ($conn->connect_error) {
                die("Falha na conexão com o banco de dados: " . $conn->connect_error);
            }

            $eventoSearch = new EventoSearch($conn);
            $eventoSearch->buscarEventos($_GET['busca']);

            $conn->close();
        }
        ?>
    </div>

</body>
</html>
