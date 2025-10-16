<?php
include("conexaoBD.php");

$nome = $_POST['nome'];
$RM = $_POST['RM'];
$email = $_POST['email'];
$tipo_conta = $_POST['tipo_conta'];
$senha = $_POST['senha'];

if ($tipo_conta == "aluno") {
    // Aluno - status ativo
    $status = 'ativo';
    $perfil = 'usuario'; // apenas 'usuario' ou 'admin'
    $mensagem = "Usuário cadastrado com sucesso! <a href='login.html'>Fazer login</a>";
} else {
    // Outros tipos de conta - status pendente
    $status = 'pendente';
    $perfil = 'usuario';
    $mensagem = "Pedido Pendente: Sua conta será analisada pela administração.";
}

$sql = "INSERT INTO usuarios (rm, nome, email, senha, perfil, status) 
        VALUES ('$RM', '$nome', '$email', '$senha', '$perfil', '$status')";

if ($conn->query($sql) === TRUE) {
    echo $mensagem;
} else {
    echo "Erro: " . $conn->error;
}

$conn->close();


?>



<!-- UPDATE usuarios SET status = 'ativo';
