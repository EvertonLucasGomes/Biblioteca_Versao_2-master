<?php
include("../scripts/login/verificaLoginGerente.php");
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
    <title>Empr&eacute;stimo de livro</title>
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
            <a href="gerenteCadastroCliente.php" id="optionsBtn">Cadastrar cliente</a>
            <a href="gerenteConsultaCliente.php" id="optionsBtn">Consultar cliente</a>
            <a href="gerenteCadastraLivro.php" id="optionsBtn">Cadastrar livro</a>
            <a href="gerenteConsultaLivro.php" id="optionsBtn">Consultar livro</a>
            <a href="gerenteCadastraEmprestimo.php" id="optionsBtn">Cadastrar empr&eacute;stimo</a>
            <a href="gerenteConsultaEmprestimo.php" id="optionsBtn">Consultar empr&eacute;stimo</a>
            <a href="gerenteDevolucaoLivro.php" id="optionsBtn">Devolu&ccedil;&atilde;o de livros</a>
            <a href="gerenteCadastrarFuncionario.php" id="optionsBtn">Cadastrar funcion&aacute;rio</a>
            <a href="gerenteConsultaFuncionario.php" id="optionsBtn">Consultar funcion&aacute;rio</a>
        </aside>
        
    <main>
        <strong>Empr&eacute;stimo de livro</strong>
        <div id="content_main">
            <form action="gerenteCadastroEmprestimo.php">
                <?php
                    include("../scripts/facade/conexao.php");
                    
                    if(persistencia::getInstance()->existCliente($_POST['cpfCliente']) == false){
                        print('<div class="alerta error">Cliente não existe.</div>');
                        util::generateLog('emprestimo do livro '. $_POST["codLivro"]. ' não cadastrado. Cliente não encontrado.');
                    }
                    elseif(persistencia::getInstance()->existLivro($_POST['codLivro']) == false){
                        print('<div class="alerta error">Livro não existe.</div>');
                        util::generateLog('emprestimo do livro '. $_POST["codLivro"]. ' não cadastrado. Livro não existente.');
                    }
                    elseif(persistencia::getInstance()->getQuantidadeLivro($_POST['codLivro']) == 0){
                        print('<div class="alerta error">Quantidade do livro indisponível indisponível.</div>');
                        util::generateLog('emprestimo do livro '. $_POST["codLivro"]. ' não cadastrado. Quantidade insuficiente');
                    }
                    else{
                        conexao::getInstance()->salvarClienteAlugaLivro(
                            $_POST['cpfCliente'],
                            $_POST['codLivro'],
                            $_POST['aluguelData']
                        );
                        print('<div class="alerta sucesso">Emprestimo cadastrado.</div>');
                        util::generateLog('Emprestimo do livro '. $_POST["codLivro"]. ' Cadastrado com sucesso');

                    }
                ?>
                <input type="submit" value="Voltar" id="botao">
            </form>
        </div>
    </main>
    </div>
</body>
</html>