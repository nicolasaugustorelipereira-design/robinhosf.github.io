<?php
session_start();
if (!isset($_SESSION['perfil']) || $_SESSION['perfil'] != 'admin') {
    header("Location: ../portal_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Painel Admin</title>
    <style>
        body { font-family: Arial; max-width: 800px; margin: 0 auto; padding: 20px; }
        .menu { display: grid; gap: 10px; margin: 30px 0; }
        .menu a { padding: 15px; background: #007bff; color: white; text-decoration: none; border-radius: 5px; text-align: center; }
        .menu a:hover { background: #0056b3; }
        .header { background: #f8f9fa; padding: 20px; border-radius: 5px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>👑 Painel Administrativo</h1>
        <p>Bem-vindo, <strong><?php echo $_SESSION['rm']; ?></strong>!</p>
    </div>
    
    <div class="menu">
        <a href="listar_usuarios.php">👥 Gerenciar Usuários</a>
        <a href="cadastrar_usuario.php">➕ Cadastrar Usuário</a>
        <a href="../logout.php">🚪 Sair</a>
    </div>
</body>
</html>