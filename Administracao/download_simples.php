<?php
$pasta = 'uploads/';
if (isset($_GET['arquivo'])) {
    $arquivo = $_GET['arquivo'];
    $caminho_completo = $pasta . $arquivo;
     if (file_exists($caminho_completo)) {
    
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $arquivo . '"');
        header('Content-Length: ' . filesize($caminho_completo));
        
        
        readfile($caminho_completo);
        exit;
    } else {
        die('Arquivo não encontrado: ' . $arquivo);
    }
}


$arquivos = glob($pasta . '*');
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Download de Arquivos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
        }
        .arquivo {
            padding: 10px;
            border: 1px solid #ddd;
            margin: 5px 0;
            background: #f9f9f9;
        }
        .btn-download {
            background: #28a745;
            color: white;
            padding: 5px 10px;
            text-decoration: none;
            border-radius: 3px;
            display: inline-block;
        }
    </style>
</head>
<body>
    <h1>📥 Download de Arquivos</h1>
    
    <?php if (count($arquivos) > 0): ?>
        <?php foreach ($arquivos as $arquivo): ?>
            <?php
            $nome_arquivo = basename($arquivo);
            $tamanho = filesize($arquivo);
            ?>
            <div class="arquivo">
                <strong><?php echo $nome_arquivo; ?></strong>
                <br>
                Tamanho: <?php echo number_format($tamanho / 1024, 2); ?> KB
                <br>
                <a href="download_simples.php?arquivo=<?php echo $nome_arquivo; ?>" class="btn-download">
                    Baixar Arquivo
                </a>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Nenhum arquivo disponível para download.</p>
        <p>Use o <a href="upload_simples.php">upload_simples.php</a> para enviar arquivos.</p>
    <?php endif; ?>
</body>
</html>