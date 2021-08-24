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
    <link rel="icon" type="imagem/png" href="../assets/icon.png" />
    <link rel="stylesheet" href="../styles/consulta.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
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
            <a href="cadastroCliente.php" id="optionsBtn">Cadastrar cliente</a>
            <a href="consultaCliente.php" id="optionsBtn">Consultar cliente</a>
            <a href="cadastroLivro.php" id="optionsBtn">Cadastrar livro</a>
            <a href="consultaLivro.php" id="optionsBtn">Consultar livro</a>
            <a href="cadastroEmprestimo.php" id="optionsBtn">Cadastrar empr&eacute;stimo</a>
            <a href="consultaEmprestimo.php" id="optionsBtn">Consultar empr&eacute;stimo</a>
            <a href="devolucaoLivros.php" id="optionsBtn">Devolu&ccedil;&atilde;o de livros</a>
        </aside>
        
    <main>
        <strong>Empr&eacute;stimo de livro</strong>
        <div id="content_main">
            
            <form action="inserirEmprestimo.php" method="POST">
                <fieldset>
                    <div class="field">
                        <label for="cpfCliente">CPF do cliente</label>
                        <input type="text" name="cpfCliente" id="cpfCliente" placeholder="000.000.000-00" required>
                    </div>
                    
                    <div class="field-group">
                        <div class="field">
                            <label for="codLivro">Código do livro</label>
                            <input type="number" name="codLivro" id="" required>
                        </div>
                    </div>
                    
                    <div class="field-group">
                        <div class="field">
                            <label for="aluguelData">Data do aluguel</label>
                            <input type="text" name="aluguelData" id="aluguelData"  required>
                        </div>
                    </div>
                </fieldset>

                <button type="submit">Salvar empr&eacute;stimo</button>
            </form>
            
        </div>
    </main>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#cpfCliente").mask("999.999.999-99");
            $("#aluguelData").mask("9999-99-99");
        });
    </script>
    
</body>
</html>