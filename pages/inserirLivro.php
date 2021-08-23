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
    <link rel="stylesheet" href="../styles/cadastroForms.css">
    <link rel="stylesheet" href="../styles/msg.css">
    <link rel="icon" type="imagem/png" href="../assets/icon.png" />
    <title>Cadastro de livro</title>
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
        <strong>Cadastro de Livro</strong>
        <div id="content_main">
            <?php
                include("../scripts/facade/conexao.php");

                if(util::existNumero($_POST["autor"]) == false)
                {
                    if(persistencia::getInstance()->existLivro($_POST['cod']) == false){
                        conexao::getInstance()->salvarLivro(
                            $_POST['cod'],
                            strtoupper($_POST['nome']),
                            $_POST['estante'],
                            $_POST['prateleira'],
                            $_POST['qtd'],
                            $_POST['ano'],
                            $_POST['autor'],
                            $_POST['editora'],
                            $_POST['genero']
                        );
                        print('<div class="alerta sucesso">Livro cadastrado.</div>');
                    }
                    else{
                        print('<div class="alerta error">Já existe um livro cadastrado com este código.</div>');
                    }
                }else{
                    print('<div class="alerta error">Não pode ter número nos campos de nome e cidade.</div>');
                }
            ?>
            
            <form action="cadastroLivro.php">
                <button type="submit" id="botao">Voltar</button>
            </form>
        </div>
    </main>
    </div>
    
</body>
</html>