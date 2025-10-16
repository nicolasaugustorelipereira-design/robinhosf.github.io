<?php
include("conexaoBD.php");

$RM = $_POST['RM'];
$senha = $_POST['senha'];


$sql = "SELECT * FROM usuarios WHERE rm='$RM' AND senha='$senha'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    
    if ($row['status'] == 'ativo') {
        header("Location: landpage.html");
        exit();
    } elseif ($row['status'] == 'pendente') {
        echo "Sua conta ainda está pendente de aprovação. <a href='login.html'>Voltar</a>";
    } elseif ($row['status'] == 'rejeitado') {
        echo "Sua conta foi rejeitada. <a href='login.html'>Voltar</a>";
    } else {
        echo "Status da conta inválido. Contate o administrador.";
    }

} else {
    echo "RM ou senha incorretos! <a href='login.html'>Tentar novamente</a>";
}

$conn->close();
?>
