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
            <form action="inserirLivro.php" method="POST">
                
                <fieldset>
                    <div class="field">
                        <label for="name">Nome do livro</label>
                        <input type="text" name="nome" id="" required>
                    </div>
                    
                    <div class="field-group">
                        <div class="field">
                            <label for="cod">C&oacute;digo do livro</label>
                            <input type="number" name="cod" id="" required>
                        </div>

                        <div class="field">
                            <label for="estante">Estante</label>
                            <input type="text" name="estante" id="" required>
                        </div>

                        <div class="field">
                            <label for="prateleira">Prateleira</label>
                            <input type="text" name="prateleira" id="" required>
                        </div>

                        <div class="field">
                            <label for="qtd">Quantidade</label>
                            <input type="number" name="qtd" id="" required>
                        </div>
                    </div>

                    <div class="field-group">
                        <div class="field">
                            <label for="ano">Ano</label>
                            <input type="number" name="ano" id="" required>
                        </div>

                        <div class="field">
                            <label for="autor">Autor</label>
                            <input type="text" name="autor" id="" required>
                        </div>
                    </div>

                    <div class="field-group">
                        <div class="field">
                            <label for="editora">Editora</label>
                            <input type="text" name="editora" id="" required>
                        </div>
                        
                        <div class="field">
                            <label for="genero">G&ecirc;nero</label>
                            <select name="genero" id="" required>
                                <option value="selecionar">Selecione o g&ecirc;nero</option>
                                <option value="Acad&ecirc;micos">Acad&ecirc;micos</option>
                                <option value="A&ccedil;&atilde;o/Aventura">A&ccedil;&atilde;o/Aventura</option>
                                <option value="Cient&iacute;ficos">Cient&iacute;ficos</option>
                                <option value="Fic&ccedil;&atilde;o_cient&iacute;fica">Fic&ccedil;&atilde;o cient&iacute;fica</option>
                                <option value="Gibis">Gibis</option>
                                <option value="Infantis">Infantis</option>
                                <option value="Poesia">Poesia</option>
                                <option value="Revistas">Revistas</option>
                            </select>
                        </div>
                    </div>
                    
                </fieldset>

                <button type="submit">Cadastrar</button>
            </form>
        </div>
    </main>
    </div>
    
</body>
</html>