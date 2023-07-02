<?php
session_start();

require_once '../data_base/banco_de_dados.php';
require_once '../php_class/user_class.php';

$conn = new mysqli($host, $username, $password, $db_name);

if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}

function alterarNome($novoNome, $conn)
{
    if (isset($_SESSION['user'])) {
        $user_id = $_SESSION['user'];

        $sql_code = "UPDATE users SET nome = '$novoNome' WHERE id = '$user_id'";
        $sql_query = $conn->query($sql_code) or die("Falha na execução do código SQL: " . $conn->error);

        exit(json_encode(['success' => true, 'message' => 'Nome alterado com sucesso.']));
    }
}

function alterarEmail($novoEmail, $conn)
{
    if (isset($_SESSION['user'])) {
        $user_id = $_SESSION['user'];

        $sql_code = "UPDATE users SET email = '$novoEmail' WHERE id = '$user_id'";
        $sql_query = $conn->query($sql_code) or die("Falha na execução do código SQL: " . $conn->error);

        exit(json_encode(['success' => true, 'message' => 'Email alterado com sucesso.']));
    }
}

function alterarSenha($novaSenha, $conn)
{
    if (isset($_SESSION['user'])) {
        $user_id = $_SESSION['user'];

        $sql_code = "UPDATE users SET senha = '$novaSenha' WHERE id = '$user_id'";
        $sql_query = $conn->query($sql_code) or die("Falha na execução do código SQL: " . $conn->error);

        exit(json_encode(['success' => true, 'message' => 'Senha alterada com sucesso.']));
    }
}

if (isset($_POST['nome'])) {
    $novoNome = $_POST['nome'];
    alterarNome($novoNome, $conn);
}

if (isset($_POST['email'])) {
    $novoEmail = $_POST['email'];
    alterarEmail($novoEmail, $conn);
}

if (isset($_POST['senha'])) {
    $novaSenha = $_POST['senha'];
    alterarSenha($novaSenha, $conn);
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar_conta</title>
    <link rel="stylesheet" href="../css/styless.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $("form").submit(function(event) {
                event.preventDefault();

                var formData = $(this).serialize();

                $.ajax({
                    type: "POST",
                    url: "<?php echo $_SERVER['PHP_SELF']; ?>",
                    data: formData,
                    dataType: "json",
                    success: function(response) {
                        if (response.success) {
                            alert(response.message);
                            location.reload();
                        } else {
                            alert("Ocorreu um erro ao realizar a alteração.");
                        }
                    }
                });
            });
        });
    </script>
</head>

<body>
    <h1>Gerenciamento de conta</h1>
    <form method="POST">
        <?php
        if (isset($_SESSION['user'])) {
            $user_id = $_SESSION['user'];

            $sql_code = "SELECT * FROM users WHERE id = '$user_id'";
            $sql_query = $conn->query($sql_code) or die("Falha na execução do código SQL: " . $conn->error);

            if ($sql_query->num_rows == 1) {
                $usuarioData = $sql_query->fetch_assoc();

                echo "<label for='nome'>Nome:</label> ";
                echo "<span>" . $usuarioData['nome'] . "</span>";
                echo "<input type='text' name='nome'>";
                echo "<input type='submit' value='Alterar'><br>";
            }
        }
        ?>
    </form>

    <form method="POST">
        <?php
        if (isset($_SESSION['user'])) {
            $user_id = $_SESSION['user'];

            $sql_code = "SELECT * FROM users WHERE id = '$user_id'";
            $sql_query = $conn->query($sql_code) or die("Falha na execução do código SQL: " . $conn->error);

            if ($sql_query->num_rows == 1) {
                $usuarioData = $sql_query->fetch_assoc();

                echo "<label for='email'>Email:</label> ";
                echo "<span>" . $usuarioData['email'] . "</span>";
                echo "<input type='email' name='email'>";
                echo "<input type='submit' value='Alterar'><br>";
            }
        }
        ?>
    </form>

    <form method="POST">
        <?php
        if (isset($_SESSION['user'])) {
            $user_id = $_SESSION['user'];

            $sql_code = "SELECT * FROM users WHERE id = '$user_id'";
            $sql_query = $conn->query($sql_code) or die("Falha na execução do código SQL: " . $conn->error);

            if ($sql_query->num_rows == 1) {
                $usuarioData = $sql_query->fetch_assoc();

                echo "<label for='senha'>Senha:</label> ";
                echo "<span>" . $usuarioData['senha'] . "</span>";
                echo "<input type='password' name='senha'>";
                echo "<input type='submit' value='Alterar'><br>";
            }
        }
        ?>
    </form>

</body>

</html>
