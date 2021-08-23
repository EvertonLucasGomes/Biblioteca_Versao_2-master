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
    <link rel="stylesheet" href="../styles/consulta.css">
    <link rel="icon" type="imagem/png" href="../assets/icon.png" />
    <title>Editar cliente</title>
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
        <strong>Editar cliente</strong>
        <div id="content_main">
            
            <?php
                require_once('../scripts/persistencia/persistencia.php');
                    
                $cliente = persistencia::getInstance()->getCliente($_POST['cpfCliente']);
                
                print('
                <form action="gerenteInserirEditarCliente.php" method="POST">
                    <fieldset>
                        <div class="field">
                            <label for="nameCliente">Nome do Cliente</label>
                            <input type="text" name="nameCliente" id="" value="'.$cliente->getNome().'" required>
                        </div>
                        
                        <div class="field-group">
                            <div class="field">
                                <label for="cpfCliente">CPF</label>
                                <input type="text" name="cpfCliente" id="cpfCliente" value="'.$cliente->getCpf().'" readonly>
                            </div>

                            <div class="field">
                                <label for="rgCliente">RG</label>
                                <input type="number" name="rgCliente" id="" value="'.$cliente->getRg().'" required>
                            </div>

                            <div class="field">
                                <label for="nascimentoCliente">Data de nascimento</label>
                                <input type="text" name="nascimentoCliente" id="nascimentoCliente" placeholder="AAAA-MM-DD" value="'.$cliente->getDataNascimento().'" required>
                            </div>

                            <div class="field">
                                <label for="telefoneCliente">Telefone</label>
                                <input type="text" name="telefoneCliente" id="telefoneCliente" value="'.$cliente->getTelefone().'" required>
                            </div>
                        </div>

                        <div class="field-group">
                            <div class="field">
                                <label for="cidadeCliente">Cidade</label>
                                <input type="text" name="cidadeCliente" id="cidadeCliente" value="'.$cliente->getCidade().'" required>   
                            </div>

                            <div class="field">
                                <label for="bairroCliente">Bairro</label>
                                <input type="text" name="bairroCliente" id="" value="'.$cliente->getBairro().'" required>
                            </div>
                        </div>
                        
                        <div class="field-group">
                            <div class="field">
                                <label for="ruaCliente">Rua</label>
                                <input type="text" name="ruaCliente" id="" value="'.$cliente->getRua().'" required>
                            </div>

                            <div class="field">
                                <label for="numComplementoCliente">N°/Complemento</label>
                                <input type="text" name="numComplementoCliente" id="" value="'.$cliente->getNumeroComplemento().'" required>
                            </div>
                        </div>
                        
                    </fieldset>

                    <button type="submit">Atualizar Cliente</button>
                </form>

                <form action="gerenteApagarCliente.php" method="POST">
                    <span>Excluir Cliente</span>
                    <input type="text" name="cpfCliente" id="" value="'.$cliente->getCpf().'" required>
                    <button type="submit" id="botao">Excluir Cliente</button>
                </form>
            ');
        ?>
        <form action="gerenteConsultaCliente.php">
            <button type="submit" id='botao'>Voltar</button>
        </form>
        
        </div>
    </main>
    </div>
    
</body>
</html>