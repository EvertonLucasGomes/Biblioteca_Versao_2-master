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
    <link rel="stylesheet" href="../styles/consulta.css">
    <link rel="stylesheet" href="../styles/msg.css">
    <link rel="icon" type="imagem/png" href="../assets/icon.png" />
    <title>Devolu&ccedil;&atilde;o de livros</title>
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
        <strong>Devolu&ccedil;&atilde;o de livros</strong>
        <div id="content_main">
        <?php
            require_once("../scripts/facade/conexao.php");

            if (persistencia::getInstance()->existEmprestimo($_POST['idAluguel'])){
                conexao::getInstance()->salvarEntregaLivro(
                    $_POST['idAluguel'],
                    $_POST['dataDevolucao']
                );
                print('<div class="alerta sucesso">Livro entregue com sucesso.</div>');
                util::generateLog('Emprestimo '. $_POST["idAluguel"].' Devolvido com sucesso.');

            }
            else{
                print('<div class="alerta atencao">Emprestimo não existe ou já foi entregue.</div>');
                util::generateLog('Falha ao devolver emprestimo '. $_POST["idAluguel"]);

            }
        ?>
        <form action="devolucaoLivros.php">
            <input type="submit" value="voltar" id="botao">
        </form>
        </div>
    </main>
    </div>
</body>
</html>

