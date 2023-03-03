<?php

$host = "localhost";
$user = "root";
$pass = "";
$dbname = "dadoslogin";

try{
    
    $conn = new PDO("mysql:host=$host;dbname=" . $dbname, $user, $pass);

}catch(PDOException $erro){
    echo "Erro: Conexão com banco de dados não realizado com sucesso. Erro gerando " . $erro->getMessage();
}
?>