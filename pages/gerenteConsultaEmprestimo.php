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
    <link rel="icon" type="imagem/png" href="../assets/icon.png" />
    <link rel="stylesheet" href="../styles/consulta.css">
    <title>Consultar empr&eacute;stimo de livro</title>
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
        <strong>Consultar empr&eacute;stimo de livro</strong>
        <div id="content_main">
            <form action="gerenteExibirConsultaClienteAlugaLivro.php" method="POST">
                <span>Informe o C&oacute;digo do empr&eacute;stimo</span>
                <input type="text" name="id_aluguel" required>
                <input id="botao" type="submit" value="Consultar">
            </form>
            
            <form action="gerenteExibirClienteEmprestimos.php" method="POST">
                <span>Informe o CPF do cliente</span>
                <input type="text" name="cpfCliente" id="cpfCliente" required>
                <input id="botao" type="submit" value="Consultar">
            </form>
            
            <form action="gerenteExibirTodosEmprestimos.php">
                <input id="botao" type="submit" value="Exibir Todos os Emprestimos">
            </form>
        </div>
    </main> 
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#cpfCliente").mask("999.999.999-99");
        });
    </script>
</body>
</html>