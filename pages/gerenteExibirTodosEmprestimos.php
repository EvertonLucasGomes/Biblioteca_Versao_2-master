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
        <strong>Consulta de Emprestimo de Livro</strong>
        <div id="content_main">
            <?php
                require_once('../scripts/persistencia/persistencia.php');

                $alugueis = persistencia::getInstance()->getTodosEmprestimos();
                
                if($alugueis != null){

                    foreach($alugueis as $aluguel){
                        print('
                            <section>
                                <div class="tbl-content">
                                    <table cellpadding="0" cellspacing="0" border="0">
                                        <tbody>
                                            <tr>
                                                <th>CODIGO</th>
                                                <th>CPF DO CLIENTE</th>
                                                <th colspan="3">NOME DO CLIENTE</th>
                                            </tr>

                                            <tr>
                                                <td>'.$aluguel->getId().'</td>
                                                <td>'.$aluguel->getClienteAluguel()->getCpf().'</td>
                                                <td colspan="3">'.$aluguel->getClienteAluguel()->getNome().'</td>
                                            </tr>
                                            
                                            <tr>
                                                <th>CODIGO DO LIVRO</th>
                                                <th>NOME DO LIVRO</th>
                                                <th>DATA DO ALUGUEL</th>
                                                <th>STATUS</th>
                                                <th>DATA DE DEVOLUÇÃO</th>
                                                </th>
                                            </tr>

                                            <tr>
                                                <td>'.$aluguel->getLivroAluguel()->getCodigo().'</td>
                                                <td>'.$aluguel->getLivroAluguel()->getNome().'</td>
                                                <td>'.$aluguel->getDataAluguel().'</td>
                                                <td>'.$aluguel->getStatus().'</td>
                                                <td>'.$aluguel->getDataDevolucao().'</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </section>
                            ');
                    }
                }
                else{
                    print('<div class="alerta atencao">Nenhum Emprestimo cadastrado.</div>');
                }
            ?>
            <form action="gerenteConsultaEmprestimo.php">
                <button type="submit" id="botao">Voltar</button>
            </form>
        </div>
    </main>
    </div>
</body>
</html>