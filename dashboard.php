<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/styledash.css" />
    <title>Dashboard</title>
</head>
<body>
    <div class="barra"> 
        <h2>Dashboard Info: Logado como "<?php echo $_SESSION['nome']; ?>"</h2>
        <a href="sair.php">Sair</a>
    </div>
    <div class="dash"> 
        <div class="up">  
            <h2>Bem-vindo, <?php echo $_SESSION['nome']; ?>!</h2>
            <h3>Este é o seu dashboard!</h3>    
        </div>
    </div>
</body>
</html>