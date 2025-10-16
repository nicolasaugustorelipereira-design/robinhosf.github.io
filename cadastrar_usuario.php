<?php
session_start();
if (!isset($_SESSION['perfil']) || $_SESSION['perfil'] != 'admin') {
    header("Location: ../portal_login.php");
    exit();
}
include("../conexaoBD.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $rm = $_POST['rm'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    $perfil = $_POST['perfil'];
    
    $sql = "INSERT INTO usuarios (rm, senha_hash, perfil) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $rm, $senha, $perfil);
    
    if ($stmt->execute()) {
        header("Location: listar_usuarios.php?sucesso=cadastrado");
        exit();
    } else {
        $erro = "Erro ao cadastrar usuário. RM já existe?";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Cadastrar Usuário</title>
    <style>
        body { font-family: Arial; max-width: 500px; margin: 0 auto; padding: 20px; }
        .form-group { margin: 15px 0; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input[type="text"], input[type="password"], select { 
            width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; 
        }
        input[type="submit"] { 
            background: #007bff; color: white; padding: 10px 20px; border: none; 
            border-radius: 4px; cursor: pointer; 
        }
        .btn-cancelar { 
            display: inline-block; margin-left: 10px; padding: 8px 15px; 
            background: #6c757d; color: white; text-decoration: none; border-radius: 4px; 
        }
        .erro { 
            color: #dc3545; padding: 10px; background: #f8d7da; 
            border-radius: 4px; margin: 10px 0; 
        }
    </style>
</head>
<body>
    <h1>➕ Cadastrar Novo Usuário</h1>
    
    <?php if (isset($erro)): ?>
        <div class="erro"><?php echo $erro; ?></div>
    <?php endif; ?>
    
    <form method="POST">
        <div class="form-group">
            <label>RM:</label>
            <input type="text" name="rm" required>
        </div>
        
        <div class="form-group">
            <label>Senha:</label>
            <input type="password" name="senha" required>
        </div>
        
        <div class="form-group">
            <label>Perfil:</label>
            <select name="perfil">
                <option value="usuario">Usuário</option>
                <option value="admin">Administrador</option>
            </select>
        </div>
        
        <div class="form-group">
            <input type="submit" value="Cadastrar">
            <a href="listar_usuarios.php" class="btn-cancelar">Cancelar</a>
        </div>
    </form>
</body>
</html>