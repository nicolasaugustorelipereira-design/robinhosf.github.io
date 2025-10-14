<?php
// upload_simples.php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['arquivo'])) {
    $pasta_destino = 'uploads/';
    
    // Criar pasta se não existir
    if (!is_dir($pasta_destino)) {
        mkdir($pasta_destino, 0777, true);
    }
    
    $nome_arquivo = $_FILES['arquivo']['name'];
    $caminho_temporario = $_FILES['arquivo']['tmp_name'];
    $caminho_destino = $pasta_destino . $nome_arquivo;
    
    // Mover arquivo para a pasta de uploads
    if (move_uploaded_file($caminho_temporario, $caminho_destino)) {
        $mensagem = "✅ Arquivo <strong>'$nome_arquivo'</strong> enviado com sucesso!";
        $cor_mensagem = "success";
    } else {
        $mensagem = "❌ Erro ao enviar o arquivo.";
        $cor_mensagem = "error";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Simples de Arquivos</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .upload-container {
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
            text-align: center;
            max-width: 500px;
            width: 100%;
        }

        h1 {
            color: #333;
            margin-bottom: 10px;
            font-size: 2em;
        }

        .subtitle {
            color: #666;
            margin-bottom: 30px;
            font-size: 1.1em;
        }

        .upload-form {
            margin: 30px 0;
        }

        .file-input {
            width: 100%;
            padding: 15px;
            border: 2px dashed #667eea;
            border-radius: 10px;
            background: #f8f9ff;
            margin-bottom: 20px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .file-input:hover {
            border-color: #764ba2;
            background: #f0f2ff;
        }

        .btn-upload {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 15px 30px;
            font-size: 1.1em;
            border-radius: 8px;
            cursor: pointer;
            transition: transform 0.2s ease;
            width: 100%;
        }

        .btn-upload:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .message {
            padding: 15px;
            border-radius: 8px;
            margin-top: 20px;
            font-weight: bold;
        }

        .success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .file-info {
            margin-top: 10px;
            font-size: 0.9em;
            color: #666;
        }

        .icon {
            font-size: 3em;
            margin-bottom: 20px;
            color: #667eea;
        }
    </style>
</head>
<body>
    <div class="upload-container">
        <div class="icon">📁</div>
        <h1>Upload de Arquivos</h1>
        <p class="subtitle">Envie seus arquivos para o sistema</p>
        
        <form class="upload-form" method="POST" enctype="multipart/form-data">
            <input type="file" name="arquivo" class="file-input" required>
            <p class="file-info">Selecione qualquer tipo de arquivo para upload</p>
            
            <button type="submit" class="btn-upload">
                📤 Enviar Arquivo
            </button>
        </form>

        <?php if (isset($mensagem)): ?>
            <div class="message <?php echo $cor_mensagem; ?>">
                <?php echo $mensagem; ?>
                <?php if (isset($nome_arquivo) && $cor_mensagem === 'success'): ?>
                    <br><small>Arquivo salvo em: uploads/<?php echo $nome_arquivo; ?></small>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <div style="margin-top: 20px; padding-top: 20px; border-top: 1px solid #eee;">
            <a href="materiais.php" style="color: #667eea; text-decoration: none;">
                📥 Ver arquivos disponíveis para download
            </a>
        </div>
    </div>

    <script>
        // Mostrar nome do arquivo selecionado
        document.querySelector('input[type="file"]').addEventListener('change', function(e) {
            const fileName = e.target.files[0]?.name;
            if (fileName) {
                document.querySelector('.file-info').textContent = `Arquivo selecionado: ${fileName}`;
            }
        });
    </script>
</body>
</html>