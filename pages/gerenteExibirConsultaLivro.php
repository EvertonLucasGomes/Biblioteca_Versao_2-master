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
    <link rel="stylesheet" href="../styles/tabela.css">
    <link rel="stylesheet" href="../styles/msg.css">
    <link rel="stylesheet" href="../styles/consulta.css">
    <link rel="icon" type="imagem/png" href="../assets/icon.png" />
    <title>Consulta de cliente</title>
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
        <strong>Consulta de Livro</strong>
        <div id="content_main">
            <?php
                require_once('../scripts/persistencia/persistencia.php');
                
                $livro = persistencia::getInstance()->getLivro($_POST['codigo']);
                
                if($livro != null){
                    print('
                    <section>
                        <div class="tbl-content">
                            <table cellpadding="0" cellspacing="0" border="0">
                                <tbody>
                                    <tr>
                                        <th>CODIGO</th>
                                        <th colspan="2">NOME</th>
                                        <th>ESTANTE</th>
                                        <th>PRATELEIRA</th>
                                    </tr>
                                    
                                    <tr>
                                        <td>'.$livro->getCodigo().'</td>
                                        <td colspan="2">'.$livro->getNome().'</td>
                                        <td>'.$livro->getEstante().'</td>
                                        <td>'.$livro->getPrateleira().'</td>
                                    </tr>
                                    
                                    <tr>
                                        <th>QUANTIDADE</th>
                                        <th>ANO</th>
                                        <th>AUTOR</th>
                                        <th>EDITORA</th>
                                        <th>GENERO</th>
                                        </th>
                                    </tr>

                                    <tr>
                                        <td>'.$livro->getQuantidade().'</td>
                                        <td>'.$livro->getAno().'</td>
                                        <td>'.$livro->getAutor().'</td>
                                        <td>'.$livro->getEditora().'</td>
                                        <td>'.$livro->getGenero().'</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </section>
                    
                    <form action="gerenteEditarLivro.php" method="POST">
                        <span>Editar Livro</span>
                        <input type="text" name="codigo" value='.$livro->getCodigo().' readonly>
                        <input id="botao" type="submit" value="EDITAR">
                    </form>
                    ');
                }   
                else{
                    print('<div class="alerta atencao">Não existe nenhum livro cadastrado com este código.</div>');
                }
            ?>
            <form action="gerenteConsultaLivro.php">
                <button type="submit" id='botao'>Voltar</button>
            </form>
        </div>
    </main>
    </div>
    
</body>
</html>