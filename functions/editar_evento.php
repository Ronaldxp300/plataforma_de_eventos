<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RP Events - Editar Evento</title>
    <link rel="stylesheet" href="../css/styless.css">
</head>
<body>
    <header>
        <h1>RP Events</h1>
        <button onclick="location.href='../pages/gerenciar_conta.php'" class="gerenciar_conta_btn">Gerenciar Conta</button>
        <button onclick="location.href='../pages/login.html'" class="logout">Sair</button>
    </header>

    <?php
    require_once '../data_base/banco_de_dados.php';

    if (isset($_GET['id'])) {
        $evento_id = $_GET['id'];
        $sql_select_evento = "SELECT * FROM events WHERE id = $evento_id";
        $result_evento = $conn->query($sql_select_evento);

        if ($result_evento->num_rows > 0) {
            $evento = $result_evento->fetch_assoc();
            $titulo = $evento['titulo'];
            $descricao = $evento['descricao'];
            $data_evento = $evento['data_evento'];
            $hora = $evento['hora'];
            $local = $evento['local'];
            $categoria = $evento['categoria'];
            $preco = $evento['preco'];

            echo "
            <form action=\"../functions/processar_edicao.php\" method=\"POST\">
                <input type=\"hidden\" name=\"id\" value=\"$evento_id\">
                <label for=\"titulo\">Título:</label>
                <input type=\"text\" id=\"titulo\" name=\"titulo\" value=\"$titulo\" required>
                <label for=\"descricao\">Descrição:</label>
                <textarea id=\"descricao\" name=\"descricao\" required>$descricao</textarea>
                <label for=\"data_evento\">Data do Evento:</label>
                <input type=\"date\" id=\"data_evento\" name=\"data_evento\" value=\"$data_evento\" required>
                <label for=\"hora\">Hora:</label>
                <input type=\"time\" id=\"hora\" name=\"hora\" value=\"$hora\" required>
                <label for=\"local\">Local:</label>
                <input type=\"text\" id=\"local\" name=\"local\" value=\"$local\">
                <label for=\"categoria\">Categoria:</label>
                <input type=\"text\" id=\"categoria\" name=\"categoria\" value=\"$categoria\">
                <label for=\"preco\">Preço:</label>
                <input type=\"number\" id=\"preco\" name=\"preco\" step=\"0.01\" value=\"$preco\">
                <button type=\"submit\">Salvar</button>
            </form>
            ";
        } else {
            echo "<p>Evento não encontrado.</p>";
        }
    } else {
        echo "<p>ID do evento não fornecido.</p>";
    }
    ?>

</body>
</html>

<?php
$conn->close();
?>
