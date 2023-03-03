<?php
include_once './conexao.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="css/style.css" />
        <title>SISTEMA DE CADASTRO</title>
    </head>
    <body>
        <div class="main-login">
            <div class= "left-login">
                <h1>Objetivo do Projeto:<br>Sistema de Login e Cadastro com PHP e CSS</h1>
                <img src="css/tech.svg" class="left-login-image" alt="tech">
            </div>
            <div class= "right-login">
                <div class="card-login">
                    <h1>CADASTRAR</h1>
                    <?php
                    //Receber os dados do formulário
                    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

                    //Verificar se o usuário clicou no botão
                    if (!empty($dados['CadUsuario'])) {

                        $empty_input = false;

                        $dados = array_map('trim', $dados);
                        if (in_array("", $dados)) {
                            $empty_input = true;
                            echo "<p style='color: #f0ffffde;'>Erro: Necessário preencher todos campos!</p>";
                        } elseif (!filter_var($dados['email'], FILTER_VALIDATE_EMAIL)) {
                            $empty_input = true;
                            echo "<p style='color: #f0ffffde;'>Erro: Necessário preencher com e-mail válido!</p>";
                        }

                        if (!$empty_input) {
                            $query_usuario = "INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha) ";
                            $senhacad = password_hash( $dados['senha'],PASSWORD_DEFAULT);
                            $cad_usuario = $conn->prepare($query_usuario);
                            $cad_usuario->bindParam(':nome', $dados['nome'], PDO::PARAM_STR);
                            $cad_usuario->bindParam(':email', $dados['email'], PDO::PARAM_STR);
                            $cad_usuario->bindParam(':senha', $senhacad, PDO::PARAM_STR);
                            $cad_usuario->execute();
                            if ($cad_usuario->rowCount()) {
                                echo "<p style='color: green;'>Usuário cadastrado com sucesso!</p>";
                                unset($dados);
                                header("Location: index.php");
                            } else {
                                echo "<p style='color: #f00;'>Erro: Usuário não cadastrado !</p>";
                            }
                        }
                    }
                    ?>
                    <form name="cad-usuario" method="POST" action="">

                            <div class="textfield">
                                <label>Nome: </label>
                                <input type="text" name="nome" id="nome" placeholder="Nome" value="<?php
                                if (isset($dados['nome'])) {
                                    echo $dados['nome'];
                                }
                                ?>">
                            </div>
                            <div class="textfield">
                                <label>E-mail: </label>
                                <input type="email" name="email" id="email" placeholder="E-mail" value="<?php
                                if (isset($dados['email'])) {
                                    echo $dados['email'];
                                }
                                ?>">
                            </div>
                            <div class="textfield">
                                <label>Senha: </label>
                                <input type="password" name="senha" id="senha" placeholder="Senha" value="<?php
                                if (isset($dados['senha'])) {
                                    echo $dados['senha'];
                                }
                                ?>">
                            </div> 
                                <div class="boton">
                                    <input type="submit" value="Cadastrar" name="CadUsuario">
                                </div> 
                                <div class="regis">
                                    <a href="index.php">Já tenho Conta!</a>
                                </div> 
                        </div>
                    </form>
                </div>
            </div> 
        </div> 
    </body>
</html>
