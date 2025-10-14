<?php
session_start();
if (isset($_SESSION['perfil']) && $_SESSION['perfil'] == 'admin') {
    header("Location: Administracao/dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Login Admin</title>
    <style>
        body { font-family: Arial; max-width: 400px; margin: 100px auto; padding: 20px; }
        .login-box { border: 1px solid #ddd; padding: 30px; border-radius: 10px; }
        input[type="text"], input[type="password"] { width: 100%; padding: 10px; margin: 10px 0; }
        input[type="submit"] { background: #007bff; color: white; padding: 10px 20px; border: none; cursor: pointer; }
    </style>
</head>
<body>
    <div class="login-box">
        <h1>🔐 Login Administrativo</h1>
        <form method="POST" action="processa_login.php">
            <input type="text" name="rm" placeholder="RM" value="admin" required>
            <input type="password" name="senha" placeholder="Senha" value="password" required>
            <input type="submit" value="Entrar">
        </form>
    </div>
</body>
</html>