<?php
session_start();
if (!isset($_SESSION['perfil']) || $_SESSION['perfil'] != 'admin') {
    header("Location: ../portal_login.php");
    exit();
}
include("../conexaoBD.php");

// Verificar se o ID foi passado e é numérico
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: listar_usuarios.php?erro=id_invalido");
    exit();
}

$id = intval($_GET['id']);

// Impedir que o admin exclua a si mesmo
if ($id == $_SESSION['id']) {
    header("Location: listar_usuarios.php?erro=auto_exclusao");
    exit();
}

// Verificar se o usuário existe antes de excluir
$sql_check = "SELECT id FROM usuarios WHERE id = ?";
$stmt_check = $conn->prepare($sql_check);
$stmt_check->bind_param("i", $id);
$stmt_check->execute();
$result_check = $stmt_check->get_result();

if ($result_check->num_rows == 0) {
    header("Location: listar_usuarios.php?erro=usuario_nao_encontrado");
    exit();
}

// Excluir o usuário
$sql = "DELETE FROM usuarios WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: listar_usuarios.php?sucesso=excluido");
    exit();
} else {
    header("Location: listar_usuarios.php?erro=exclusao");
    exit();
}
?>