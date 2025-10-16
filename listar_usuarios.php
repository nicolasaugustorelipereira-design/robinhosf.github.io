<?php
session_start();
if (!isset($_SESSION['perfil']) || $_SESSION['perfil'] != 'admin') {
    header("Location: ../portal_login.php");
    exit();
}
include("../conexaoBD.php");

$sql = "SELECT id, rm, perfil FROM usuarios";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Listar Usuários</title>
    <style>
        body { font-family: Arial; max-width: 1000px; margin: 0 auto; padding: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        th { background-color: #f2f2f2; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        .btn { padding: 5px 10px; text-decoration: none; border-radius: 3px; color: white; }
        .btn-editar { background: #28a745; }
        .btn-excluir { background: #dc3545; }
        .btn-voltar { background: #6c757d; padding: 8px 15px; }
    </style>
</head>
<body>
    <h1>👥 Lista de Usuários</h1>
    <a href="dashboard.php" class="btn btn-voltar">← Voltar ao Painel</a>

    <?php if ($result->num_rows > 0): ?>
    <table>
        <tr>
            <th>ID</th>
            <th>RM</th>
            <th>Perfil</th>
            <th>Ações</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['rm'] ?></td>
            <td><?= $row['perfil'] ?></td>
            <td>
                <a href="editar_usuario.php?id=<?= $row['id'] ?>" class="btn btn-editar">Editar</a>
                <a href="excluir_usuario.php?id=<?= $row['id'] ?>" class="btn btn-excluir" onclick="return confirm('Tem certeza que deseja excluir este usuário?')">Excluir</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
    <?php else: ?>
        <p style="margin-top: 20px; color: #666;">Nenhum usuário cadastrado.</p>
    <?php endif; ?>
</body>
</html>