<?php
session_start();

function conectarBanco() {
    $host = "localhost";
    $usuario = "root";
    $senha = "";
    $banco = "trysystems_cardapiorestaurante";

    $conexao = new mysqli($host, $usuario, $senha, $banco);

    if ($conexao->connect_error) {
        die("Erro na conexão com o banco de dados: " . $conexao->connect_error);
    }

    return $conexao;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conexao = conectarBanco();

    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM cardapio_restaurante_usuarios WHERE usuario = '$username' AND senha = '$password'";
        $result = $conexao->query($sql);

        if ($result->num_rows == 1) {
            $_SESSION['username'] = $username;
            header('Location: ../painel_loja.php');
        } else {
            echo "Credenciais inválidas. Tente novamente.";
        }
    } else {
        echo "Campos de usuário e senha devem ser preenchidos.";
    }

    $conexao->close();
}

?>
