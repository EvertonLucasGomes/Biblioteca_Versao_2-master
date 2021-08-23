<?php
include("../scripts/login/verificaLoginGerente.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/home.css">
    <link rel="stylesheet" href="../styles/global.css">
    <link rel="icon" type="imagem/png" href="../assets/icon.png" />
    <title>Home</title>
</head>
    <header>
        <nav>
            <ul id="menu">
                <li id="logo">BeloBiblio</li>
                <li><a href="gerenteHome.php" id="home">Home</a></li>
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
        <?php
            require_once('../scripts/persistencia/persistencia.php');
        ?>

        <strong>Home</strong>
        <div id="cards">
            <div id="livros" class="infos">
                <img src="../assets/livro_cadastrado.png" alt="Logotipo de livro">
                <p>Livros cadastrados</p>
                <p class="dados">
                    <?php
                        print(persistencia::getInstance()->getQuantidadeLivros());
                    ?>
                </p>
            </div>
            <div id="clientes" class="infos">
                <img src="../assets/student.png" alt="Logotipo de estudante">
                <p>Clientes cadastrados</p>
                <p class="dados">
                    <?php
                        print(persistencia::getInstance()->getQuantidadeClientes());
                    ?>
                </p>
            </div>
            <div id="emprestados" class="infos">
                <img src="../assets/Book_open1.png" alt="Logotipo de livro aberto">
                <p>Livros emprestados</p>
                <p class="dados">
                    <?php
                        print(persistencia::getInstance()->getQuantidadeEmprestimos());
                    ?>
                </p>
            </div>
        </div>
    </main>
    </div>
    
</body>
</html>