<?php
require_once '../php_class/user_class.php';
require_once '../data_base/banco_de_dados.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['nome'], $_POST['email'], $_POST['Senha'], $_POST['tipo_usuario'])) {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['Senha'];
        $tipo_usuario = $_POST['tipo_usuario'];
        
        if (empty($nome)) {
            echo "Por favor, preencha o campo Nome";
        } elseif (empty($email)) {
            echo "Por favor, preencha o campo Email";
        } elseif (empty($senha)) {
            echo "Por favor, preencha o campo Senha";
        } elseif (empty($tipo_usuario)) {
            echo "Por favor, marque o tipo de usuario";
        }else {

            $sql_check_email = "SELECT * FROM users WHERE email = '$email'";
            $result_check_email = $conn->query($sql_check_email);

            if ($result_check_email->num_rows > 0) {
                echo "O email já está cadastrado. Por favor, utilize outro email.";
            } else {

                $usuario = new Usuario($nome, $email, $senha, $tipo_usuario);

                $sql_insert_user = "INSERT INTO users (nome, email, senha, tipo_usuario) VALUES ('$nome', '$email', '$senha', '$tipo_usuario')";

                if ($conn->query($sql_insert_user) != true) {
                    echo "Erro ao realizar o registro: " . $conn->error;
                } else {
                    header("Location: ../pages/login.html");
                    exit();
                }
            }
        }
    } else {
        echo "Por favor, preencha todos os campos do formulário.";
    }
}
?>
