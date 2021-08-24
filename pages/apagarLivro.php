<?php
include("../scripts/login/verificaLogin.php");
include("../scripts/util/util.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/global.css">
    <link rel="stylesheet" href="../styles/msg.css">
    <link rel="stylesheet" href="../styles/consulta.css">
    <link rel="stylesheet" href="../styles/tabela.css">
    <link rel="icon" type="imagem/png" href="../assets/icon.png" />
    <title>Apagar Livro</title>
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
        <strong>Apagar Livro</strong>
        <div id="content_main">
            
            <?php
                require_once('../scripts/persistencia/persistencia.php');

                if(!persistencia::getInstance()->dependenciaLivro($_POST['cod'])){
                    persistencia::getInstance()->deleteLivro(
                        $_POST['cod']
                    );
                    print('<div class="alerta sucesso">Livro excluido.</div>');

                    util::generateLog('Livro '. $_POST["cod"]. ' Removido com sucesso');

                }
                else{
                    print('<div class="alerta error">Você não pode excluir um livro com alguel pendente.</div>');
                    util::generateLog('Livro '. $_POST["cod"]. ' Não removido. Livro com emprestimo pendente.');
                }
            ?>

            <form action="consultaLivro.php">
                <button type="submit" id='botao'>Voltar</button>
            </form>
        </div>
    </main>
    </div>
    
</body>
</html>
