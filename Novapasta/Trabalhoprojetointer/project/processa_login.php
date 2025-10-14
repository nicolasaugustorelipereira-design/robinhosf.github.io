<?php
session_start();
include("conexaoBD.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $rm = $_POST['rm'];
    $senha = $_POST['senha'];
    
    $sql = "SELECT * FROM usuarios WHERE rm = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $rm);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows == 1) {
        $usuario = $result->fetch_assoc();
        
        if (password_verify($senha, $usuario['senha_hash'])) {
            $_SESSION['id'] = $usuario['id'];
            $_SESSION['rm'] = $usuario['rm'];
            $_SESSION['perfil'] = $usuario['perfil'];
            
            if ($usuario['perfil'] == 'admin') {
                header("Location: Administracao/dashboard.php");
            } else {
                header("Location: portal_login.php?erro=permissao");
            }
            exit();
        }
    }
    
    header("Location: portal_login.php?erro=credenciais");
    exit();
}
?>