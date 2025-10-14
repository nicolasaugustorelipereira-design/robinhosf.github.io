<?php
include("conexaoBD.php");

$nome = $_POST['nome'];
$RM = $_POST['RM'];
$email = $_POST['email'];
$tipo_conta = $_POST['tipo_conta'];
$senha = $_POST['senha'];

$sql = "INSERT INTO usuarios (rm, nome, email, senha, perfil) VALUES ('$RM', '$nome', '$email', '$senha', '$tipo_conta')";

if ($conn->query($sql) === TRUE) {
    echo "Usuário cadastrado com sucesso! <a href='login.html'>Fazer login</a>";
} else {
    echo "Erro: " . $conn->error;
}

$conn->close();
?>