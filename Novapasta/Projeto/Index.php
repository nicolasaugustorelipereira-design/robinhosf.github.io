<?php
    include("conexaoBD.php"); 


    if($_SERVER["REQUEST_METHOD"] == "POST")
    {

        $rm=$_POST["rm"];
        $senha=$_POST["senha"];

        $sql = "SELECT * FROM login WHERE rm = ? AND senha = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $rm, $senha);
            $stmt->execute();
            
            $resultado = $stmt->get_result();
            
        if ($resultado->num_rows > 0) 
            {
                $mensagem = "Login realizado com sucesso!";
                header("Location: Menu.html"); 
                exit();  
            } 
            else 
            {
                $mensagem = "Nome ou senha incorretos!";
                header("Location: Index.html");  
                exit(); 
            }
        $stmt->close();
        $conn->close();
    }

?>