<?php
require_once '../data_base/banco_de_dados.php';
require_once '../php_class/user_class.php';

class Autenticacao {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function realizarLogin($email, $senha) {
        if (empty($email)) {
            echo "Preencha seu e-mail";
        } else if (empty($senha)) {
            echo "Preencha sua senha";
        } else {
            $email = $this->conn->real_escape_string($email);
            $senha = $this->conn->real_escape_string($senha);
            $sql_code = "SELECT * FROM users WHERE email = '$email' AND senha = '$senha'";
            $sql_query = $this->conn->query($sql_code) or die("Falha na execução do código SQL: " . $this->conn->error);

            $quantidade = $sql_query->num_rows;

            if ($quantidade == 1) {
                $usuarioData = $sql_query->fetch_assoc();

                $usuario = new Usuario($usuarioData['nome'], $usuarioData['email'], $usuarioData['senha'], $usuarioData['tipo_usuario']);
                $usuario->setId($usuarioData['id']);
                    
                if (!isset($_SESSION)) {
                    session_start();
                }
                $_SESSION['user'] = $usuario->getId();
                $_SESSION['nome'] = $usuario->getNome();

                if ($usuario->getTipo_usuario() == 'participante') {
                    header("Location: ../pages/home_participante.php");
                } else if ($usuario->getTipo_usuario() == 'organizador') {
                    header("Location: ../pages/home_organizador.php");
                } else if ($usuario->getTipo_usuario() == 'administrador') {
                    header("Location: ../pages/home_administrador.php");
                }
                exit();
            } else {
                echo "Falha no login, e-mail ou senha incorretos";
            }
        }
    }
}

if (isset($_POST['email']) && isset($_POST['senha'])) {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $autenticacao = new Autenticacao($conn);
    $autenticacao->realizarLogin($email, $senha);
}
?>
