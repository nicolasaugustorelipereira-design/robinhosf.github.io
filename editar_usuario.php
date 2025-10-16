<?php
session_start();
if (!isset($_SESSION['perfil']) || $_SESSION['perfil'] != 'admin') {
    header("Location: ../portal_login.php");
    exit();
}
include("../conexaoBD.php");

// Verificar se o ID foi passado
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: listar_usuarios.php?erro=id_invalido");
    exit();
}

$id = intval($_GET['id']);

// Buscar dados do usuário
$sql = "SELECT id, rm, perfil FROM usuarios WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

// Verificar se usuário existe
if ($result->num_rows == 0) {
    header("Location: listar_usuarios.php?erro=usuario_nao_encontrado");
    exit();
}

$usuario = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $rm = $_POST['rm'];
    $senha = $_POST['senha'];
    $perfil = $_POST['perfil'];
    
    if (!empty($senha)) {
        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
        $sql = "UPDATE usuarios SET rm = ?, senha_hash = ?, perfil = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $rm, $senha_hash, $perfil, $id);
    } else {
        $sql = "UPDATE usuarios SET rm = ?, perfil = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $rm, $perfil, $id);
    }
    
    if ($stmt->execute()) {
        header("Location: listar_usuarios.php?sucesso=editado");
        exit();
    } else {
        $erro = "Erro ao atualizar usuário.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Editar Usuário</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            background: #f5f5f5;
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .form-group {
            margin: 20px 0;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #333;
        }
        input[type="text"], input[type="password"], select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background: #007bff;
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-right: 10px;
        }
        input[type="submit"]:hover {
            background: #0056b3;
        }
        .btn-cancelar {
            display: inline-block;
            padding: 10px 20px;
            background: #6c757d;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .btn-cancelar:hover {
            background: #545b62;
        }
        .erro {
            color: #dc3545;
            padding: 15px;
            background: #f8d7da;
            border-radius: 5px;
            margin: 20px 0;
            border: 1px solid #f5c6cb;
        }
        .info {
            color: #0c5460;
            padding: 15px;
            background: #d1ecf1;
            border-radius: 5px;
            margin: 20px 0;
            border: 1px solid #b8daff;
        }
        small {
            color: #666;
            font-size: 12px;
        }
        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>✏️ Editar Usuário</h1>
        
        <?php if (isset($erro)): ?>
            <div class="erro"><?php echo $erro; ?></div>
        <?php endif; ?>
        
        <div class="info">
            <strong>Editando usuário:</strong> <?php echo $usuario['rm']; ?> 
            <strong>ID:</strong> <?php echo $usuario['id']; ?>
        </div>
        
        <form method="POST">
            <div class="form-group">
                <label for="rm">RM:</label>
                <input type="text" id="rm" name="rm" value="<?php echo htmlspecialchars($usuario['rm']); ?>" required>
            </div>
            
            <div class="form-group">
                <label for="senha">Nova Senha:</label>
                <input type="password" id="senha" name="senha" placeholder="Deixe em branco para manter a senha atual">
                <small>Preencha apenas se desejar alterar a senha</small>
            </div>
            
            <div class="form-group">
                <label for="perfil">Perfil:</label>
                <select id="perfil" name="perfil">
                    <option value="usuario" <?php echo $usuario['perfil'] == 'usuario' ? 'selected' : ''; ?>>Usuário</option>
                    <option value="admin" <?php echo $usuario['perfil'] == 'admin' ? 'selected' : ''; ?>>Administrador</option>
                </select>
            </div>
            
            <div class="form-group">
                <input type="submit" value="💾 Atualizar Usuário">
                <a href="listar_usuarios.php" class="btn-cancelar">❌ Cancelar</a>
            </div>
        </form>
    </div>
</body>
</html>