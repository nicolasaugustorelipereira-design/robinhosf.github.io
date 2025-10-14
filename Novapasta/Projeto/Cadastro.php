<?php
    include("conexaoBD.php");

    if($_SERVER["REQUEST_METHOD"] == "POST")
    {

        $rm=$_POST["rm"];
        $senha=$_POST["senha"];

        $sql = "INSERT INTO login (rm, senha) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $rm, $senha); 
        $stmt->execute();
        if ($stmt->affected_rows > 0) 
        {
            echo "Cadastro realizado com sucesso!";
            header("Location: Index.html"); 
            exit();
        } 
        else 
        {
            echo "Erro ao cadastrar.";
            header("Location: Menu.html"); 
            exit();
        }
        $stmt->close();
        $conn->close();
    }
    
?>