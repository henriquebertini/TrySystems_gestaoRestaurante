<?php
$host = "localhost";
$usuario = "root";
$senha = "";
$banco = "trysystems_cardapiorestaurante";

$conexao = new mysqli($host, $usuario, $senha, $banco);

if ($conexao->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conexao->connect_error);
}

return $conexao;

$action = $_POST['action'];

switch($action) {
    case 'get':
        $query = "SELECT * FROM estoque";
        $result = $conn->query($query);
        $items = [];

        while($row = $result->fetch_assoc()) {
            $items[] = $row;
        }

        echo json_encode($items);
        break;

    case 'save':
        $nome = $_POST['itemName'];
        $quantidade = $_POST['itemQuantity'];
        $preco = $_POST['itemPrice'];

        $query = "INSERT INTO estoque (nome, quantidade, preco) VALUES ('$nome', '$quantidade', '$preco')";
        $conn->query($query);

        echo "Saved";
        break;

    case 'delete':
        $id = $_POST['id'];
        $query = "DELETE FROM estoque WHERE id='$id'";
        $conn->query($query);

        echo "Deleted";
        break;

    default:
        echo "Invalid Action";
}

$conn->close();
?>
