<?php
include("../scripts/login/verificaLogin.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/global.css">
    <link rel="stylesheet" href="../styles/msg.css">
    <link rel="stylesheet" href="../styles/tabela.css">
    <link rel="icon" type="imagem/png" href="../assets/icon.png" />
    <title>Cadastro de Funcionario</title>
</head>
    <header>
        <nav>
            <ul id="menu">
                <li id="logo">BeloBiblio</li>
                <li><a href="home.php" id="home">Home</a></li>
                <li><a href="../scripts/login/logout.php" id="exit">Sair</a></li>
            </ul>
        </nav>
        <p><?php echo "Olá, {$_SESSION['user']}.";?></p>
    </header>
    <div id="content">
        <aside>
            <img src="../assets/avatar.svg" id="perfil" alt="Foto de perfil">
            <a href="cadastroCliente.php" id="optionsBtn">Cadastrar cliente</a>
            <a href="consultaCliente.php" id="optionsBtn">Consultar cliente</a>
            <a href="cadastroLivro.php" id="optionsBtn">Cadastrar livro</a>
            <a href="consultaLivro.php" id="optionsBtn">Consultar livro</a>
            <a href="cadastroEmprestimo.php" id="optionsBtn">Cadastrar empr&eacute;stimo</a>
            <a href="consultaEmprestimo.php" id="optionsBtn">Consultar empr&eacute;stimo</a>
            <a href="devolucaoLivros.php" id="optionsBtn">Devolu&ccedil;&atilde;o de livros</a>
        </aside>
        
    <main>
        <strong>Cadastro de Funcionario</strong>
        <div id="content_main">
            <form action="gerenteCadastrarFuncionario.php">
                <?php
                    include("../scripts/facade/conexao.php");
                    
                    if(persistencia::getInstance()->existFuncionario($_POST["cpfFuncionario"]) == false)
                    {
                        conexao::getInstance()->salvarFuncionario(
                            $_POST["cpfFuncionario"], 
                            strtoupper($_POST["nameFuncionario"]), 
                            $_POST["rgFuncionario"], 
                            $_POST["nascimentoFuncionario"],
                            $_POST["telefoneFuncionario"], 
                            strtoupper($_POST["cidadeFuncionario"]), 
                            strtoupper($_POST["bairroFuncionario"]),
                            strtoupper($_POST["ruaFuncionario"]),
                            strtoupper($_POST["numComplementoFuncionario"]),
                            $_POST['cargo'],
                            $_POST['loginFuncionario'],
                            $_POST['senhaFuncionario']
                        );

                        print('<div class="alerta sucesso">Funcionario cadastrado com sucesso.</div>');
                    }
                    else{
                        print('<div class="alerta error">Já existe um Funcionario cadastrado com este CPF.</div>');
                    }

                ?>
                <input type="submit" value="Voltar" id="botao">
            </form>
        </div>
    </main>
    </div>
</body>
</html>