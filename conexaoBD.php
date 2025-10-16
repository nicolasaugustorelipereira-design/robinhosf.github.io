<?php
//$servername = "localhost"; 
//$username = "root"; 
//$password = '';   
//$database = 'repositoriods';

$servername = "robinhosf.gt.tc";       // host do banco 
$username = "if0_40187066";             // usuário MySQL
$password = "xpTEW1qM4tL4hc";           //  senha
$database = "repositoriods";             // nome do banco (sem o .sql pois é extensão)

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
?>

