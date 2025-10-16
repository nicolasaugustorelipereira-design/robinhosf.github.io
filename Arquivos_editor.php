<?php
session_start();
// Inclua sua conexão com o banco de dados
include 'conexao.php';

// Verifique se o usuário está logado e é um administrador
if (!isset($_SESSION['usuario']) || $_SESSION['perfil'] != 'admin') {
    header('Location: index.php');
    exit;
}

// Processamento do formulário de upload
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['arquivo'])) {
    $nome_arquivo = $_FILES['arquivo']['name'];
    $caminho_temporario = $_FILES['arquivo']['tmp_name'];
    $caminho_destino = 'uploads/' . $nome_arquivo;

    // Move o arquivo para a pasta de uploads
    if (move_uploaded_file($caminho_temporario, $caminho_destino)) {
        // Insere as informações do arquivo no banco de dados
        $id_usuario = $_SESSION['id'];
        $sql = "INSERT INTO arquivos (nome_arquivo, caminho_arquivo, id_usuario) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nome_arquivo, $caminho_destino, $id_usuario]);
        echo "Arquivo enviado com sucesso!";
    } else {
        echo "Erro ao enviar o arquivo.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Upload de Arquivos</title>
</head>
<body>
    <h1>Upload de Arquivos</h1>
    <form method="POST" enctype="multipart/form-data">
        <input type="file" name="arquivo" required>
        <button type="submit">Enviar</button>
    </form>
</body>
</html>