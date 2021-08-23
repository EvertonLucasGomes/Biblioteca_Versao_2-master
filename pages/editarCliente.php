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
    <link rel="stylesheet" href="../styles/consulta.css">
    <link rel="icon" type="imagem/png" href="../assets/icon.png" />
    <title>Editar cliente</title>
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
        <strong>Editar cliente</strong>
        <div id="content_main">
            
            <?php
                require_once('../scripts/persistencia/persistencia.php');
                    
                $cliente = persistencia::getInstance()->getCliente($_POST['cpfCliente']);
                
                print('
                <form action="inserirEditarCliente.php" method="POST">
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

                <form action="apagarCliente.php" method="POST">
                    <span>Excluir Cliente</span>
                    <input type="text" name="cpfCliente" id="" value="'.$cliente->getCpf().'" required>
                    <button type="submit" id="botao">Excluir Cliente</button>
                </form>
            ');
        ?>
        <form action="consultaCliente.php">
            <button type="submit" id='botao'>Voltar</button>
        </form>
        
        </div>
    </main>
    </div>
    
</body>
</html>