




<?php
include("conexaoBD.php");
//if ($_SESSION['perfil'] != 'admin') {
  //  die("Acesso negado!");
//}




/
if (isset($_GET['acao']) && isset($_GET['id'])) {
    $id = intval($_GET['id']); 
    if ($_GET['acao'] == 'aprovar') {
        $novo_status = 'ativo';
    } elseif ($_GET['acao'] == 'rejeitar') {
        $novo_status = 'rejeitado';
    }

    if (isset($novo_status)) {
        $sql_update = "UPDATE usuarios SET status='$novo_status' WHERE id=$id";
        $conn->query($sql_update);
    }
}


$sql = "SELECT id, nome, email, rm FROM usuarios WHERE status='pendente'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Usuários Pendentes</title>
    <style>
        table {
            width: 80%;
            border-collapse: collapse;
            margin: 20px auto;
        }
        th, td {
            border: 1px solid #333;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #eee;
        }
        a.button {
            padding: 5px 10px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }
        a.rejeitar {
            background-color: #f44336;
        }
    </style>
</head>
<body>
    <h2 style="text-align:center;">Usuários Pendentes</h2>
    <table>
        <tr>
            <th>RM</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Ações</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['rm']}</td>
                        <td>{$row['nome']}</td>
                        <td>{$row['email']}</td>
                        <td>
                            <a class='button' href='?acao=aprovar&id={$row['id']}'>Aprovar</a>
                            <a class='button rejeitar' href='?acao=rejeitar&id={$row['id']}'>Rejeitar</a>
                        </td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='4'>Nenhum usuário pendente.</td></tr>";
        }
        ?>
    </table>
</body>
</html>

<?php
$conn->close();
?>
