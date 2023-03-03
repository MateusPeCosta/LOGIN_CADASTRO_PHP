<?php
session_start();
ob_start();
include_once 'conexao.php';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <title>SISTEMA DE LOGIN</title>
</head>

<body>
    <div class="main-login">
        <div class= "left-login">
            <h1>Objetivo do Projeto:<br>Sistema de Login e Cadastro com PHP e CSS</h1>
            <img src="css/tech.svg" class="left-login-image" alt="tech">
        </div>
        <div class= "right-login">
            <div class="card-login">
                <h1>ENTRAR</h1>
            
                <?php
                $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

                if (!empty($dados['SendLogin'])) {

                    $query_usuario = "SELECT id, nome, email, senha
                                    FROM usuarios
                                    WHERE email =:email
                                    LIMIT 1";
                    $result_usuario = $conn->prepare($query_usuario);
                    $result_usuario->bindParam(':email', $dados['email'], PDO::PARAM_STR);
                    $result_usuario->execute();
                
                
                    if(($result_usuario) and ($result_usuario->rowCount() != 0)){
                        $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);
                        
                        if(password_verify($dados['senha'], $row_usuario['senha'])){
                            $_SESSION['id'] =  $row_usuario['id'];
                            $_SESSION['nome'] =  $row_usuario['nome'];
                            header("Location: dashboard.php");
                
                            $retorna = ['erro'=> false, 'dados' => $row_usuario];
                        }else{
                            $_SESSION['msg'] = "<p style='color: #ff0000'>Erro: Usuário ou senha inválida!</p>";
                        }
                    }else{
                        $_SESSION['msg'] = "<p style='color: #ff0000'>Erro: Usuário ou senha inválida!</p>";
                    }

                    
                }

                if(isset($_SESSION['msg'])){
                    echo $_SESSION['msg'];
                    unset($_SESSION['msg']);
                }
                ?>

                <form method="POST" action="">
                    <div class="textfield">
                        <label>Usuário</label>
                        <input type="email" name="email" placeholder="Digite o usuário" value="<?php 
                        if(isset($dados['email'])){ 
                            echo $dados['email']; } 
                            ?>">
                    </div>
                    <div class="textfield">
                        <label>Senha</label>
                        <input type="password" name="senha" placeholder="Digite a senha" value="<?php 
                        if(isset($dados['senha'])){
                             echo $dados['senha']; } 
                             ?>">
                    </div>
                    <div class="boton">
                        <input type="submit" value="Acessar" name="SendLogin">
                    </div>
                    <div class="regis">
                        <a href="cadastro.php">Registrar nova Conta!</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>