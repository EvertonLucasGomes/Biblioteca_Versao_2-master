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
    <link rel="stylesheet" href="../styles/cadastroForms.css">
    <link rel="icon" type="imagem/png" href="../assets/icon.png" />
    <title>Editar livro</title>
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
            <a href="gerenteCadastroLivro.php" id="optionsBtn">Cadastrar livro</a>
            <a href="gerenteConsultaLivro.php" id="optionsBtn">Consultar livro</a>
            <a href="gerenteCadastroEmprestimo.php" id="optionsBtn">Cadastrar empr&eacute;stimo</a>
            <a href="gerenteConsultaEmprestimo.php" id="optionsBtn">Consultar empr&eacute;stimo</a>
            <a href="gerenteDevolucaoLivros.php" id="optionsBtn">Devolu&ccedil;&atilde;o de livros</a>
            <a href="gerenteCadastrarFuncionario.php" id="optionsBtn">Cadastrar funcion&aacute;rio</a>
            <a href="gerenteConsultaFuncionario.php" id="optionsBtn">Consultar funcion&aacute;rio</a>
        </aside>
        
    <main>
        <strong>Editar livro</strong>
        <div id="content_main">
            
            <?php
                require_once('../scripts/persistencia/persistencia.php');
                    
                $livro = persistencia::getInstance()->getLivro($_POST['codigo']);

                print('
                <form action="gerenteInserirEditarLivro.php" method="POST">
                    
                    <fieldset>
                        <div class="field">
                            <label for="name">Nome do livro</label>
                            <input type="text" name="nome" id="" value="'.$livro->getNome().'" required>
                        </div>
                        
                        <div class="field-group">
                            <div class="field">
                                <label for="cod">C&oacute;digo do livro</label>
                                <input type="number" name="cod" id="" value="'.$livro->getCodigo().'" readonly>
                            </div>

                            <div class="field">
                                <label for="estante">Estante</label>
                                <input type="text" name="estante" id="" value="'.$livro->getEstante().'" required>
                            </div>

                            <div class="field">
                                <label for="prateleira">Prateleira</label>
                                <input type="text" name="prateleira" id="" value="'.$livro->getPrateleira().'" required>
                            </div>

                            <div class="field">
                                <label for="qtd">Quantidade</label>
                                <input type="number" name="qtd" id="" value="'.$livro->getQuantidade().'" required>
                            </div>
                        </div>

                        <div class="field-group">
                            <div class="field">
                                <label for="ano">Ano</label>
                                <input type="number" name="ano" id="" value="'.$livro->getAno().'" required>
                            </div>

                            <div class="field">
                                <label for="autor">Autor</label>
                                <input type="text" name="autor" id="" value="'.$livro->getAutor().'" required>
                            </div>
                        </div>

                        <div class="field-group">
                            <div class="field">
                                <label for="editora">Editora</label>
                                <input type="text" name="editora" id="" value="'.$livro->getEditora().'" required>
                            </div>
                            
                            <div class="field">
                                <label for="genero">G&ecirc;nero</label>
                                <select name="genero" id="">
                                    <option value="'.$livro->getGenero().'">'.$livro->getGenero().'</option>
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
                    <button type="submit">Atualizar Livro</button>
                </form>

                <form action="gerenteApagarLivro.php" method="POST">
                    <label for="cod">Deletar Livro Código:</label>
                    <input type="number" name="cod" id="" value="'.$livro->getCodigo().'" readonly>
                    <button type="submit">Excluir Livro</button>
                </form>
            ');

        ?>
        
        <form action="gerenteConsultaLivro.php">
            <button type="submit" id='botao'>Voltar</button>
        </form>
        
        </div>
    </main>
    </div>
    
</body>
</html>