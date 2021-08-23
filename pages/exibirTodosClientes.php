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
    <link rel="stylesheet" href="../styles/tabela.css">
    <link rel="icon" type="imagem/png" href="../assets/icon.png" />
    <title>Consulta de cliente</title>
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
        <strong>Consulta de cliente</strong>
        <div id="content_main">
            
                <?php
                    require_once('../scripts/persistencia/persistencia.php');

                    $clientes = persistencia::getInstance()->getTodosClientes();

                    if($clientes != null){
                        
                        foreach($clientes as $cliente){
                            print('
                                <section>
                                    <div class="tbl-content">
                                        <table cellpadding="0" cellspacing="0" border="0">
                                            <tbody>
                                                <tr>
                                                    <th>CPF</th>
                                                    <th colspan="2">NOME</th>
                                                    <th>RG</th>
                                                    <th>DATA DE NASCIMENTO</th>
                                                </tr>

                                                <tr>
                                                    <td>'.$cliente->getCpf().'</td>
                                                    <td colspan="2">'.$cliente->getNome().'</td>
                                                    <td>'.$cliente->getRg().'</td>
                                                    <td>'.$cliente->getDataNascimento().'</td>
                                                </tr>

                                                <tr>
                                                    <th>TELEFONE</th>
                                                    <th>CIDADE</th>
                                                    <th>BAIRRO</th>
                                                    <th>RUA</th>
                                                    <th>NUMERO/COMPLEMENTO</th>
                                                    </th>
                                                </tr>

                                                <tr>
                                                    <td>'.$cliente->getTelefone().'</td>
                                                    <td>'.$cliente->getCidade().'</td>
                                                    <td>'.$cliente->getBairro().'</td>
                                                    <td>'.$cliente->getRua().'</td>
                                                    <td>'.$cliente->getNumeroComplemento().'</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </section>
                            ');
                        }
                    }
                    else{
                        print("NENHUM CLIENTE CADASTRADO !");
                    }
                ?>
            <form action="consultaCliente.php">
                <input type="submit" value="Voltar" id='botao'>
            </form>
        </div>
    </main>
    </div>
    
</body>
</html>