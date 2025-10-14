<?php
include("conexaoBD.php");

$RM = $_POST['RM'];
$senha = $_POST['senha'];

$sql = "SELECT * FROM usuarios WHERE rm='$RM' AND senha='$senha'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    header("Location: index.html");
    exit();
} else {
   
    echo "RM ou senha incorretos! <a href='login.html'>Tentar novamente</a>";
}

$conn->close();
?>