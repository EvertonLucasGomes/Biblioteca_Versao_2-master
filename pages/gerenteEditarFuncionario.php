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
    <link rel="stylesheet" href="../styles/msg.css">
    <link rel="icon" type="imagem/png" href="../assets/icon.png" />
    <title>Editar funcionario</title>
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
        <strong>Editar funcionario</strong>
        <div id="content_main">
            
            <?php
                require_once('../scripts/persistencia/persistencia.php');
                    
                $funcionario = persistencia::getInstance()->getFuncionario($_POST['cpf']);
                
                if(persistencia::getInstance()->existFuncionario($_POST['cpf'])){

                    print('
                    <form action="gerenteInserirEditarFuncionario.php" method="POST">
                        <fieldset>
                            <div class="field">
                                <label for="nameFuncionario">Nome do Funcionario</label>
                                <input type="text" name="nameFuncionario" id="" value="'.$funcionario->getNome().'" required>
                            </div>
                            
                            <div class="field-group">
                                <div class="field">
                                    <label for="cpfFuncionario">CPF</label>
                                    <input type="text" name="cpfFuncionario" id="cpfFuncionario" value="'.$funcionario->getCpf().'" readonly>
                                </div>

                                <div class="field">
                                    <label for="rgFuncionario">RG</label>
                                    <input type="number" name="rgFuncionario" id="" value="'.$funcionario->getRg().'" required>
                                </div>

                                <div class="field">
                                    <label for="nascimentoFuncionario">Data de nascimento</label>
                                    <input type="text" name="nascimentoFuncionario" id="nascimentoFuncionario" placeholder="AAAA-MM-DD" value="'.$funcionario->getDataNascimento().'" required>
                                </div>

                                <div class="field">
                                    <label for="telefoneFuncionario">Telefone</label>
                                    <input type="text" name="telefoneFuncionario" id="telefoneFuncionario" value="'.$funcionario->getTelefone().'" required>
                                </div>
                            </div>

                            <div class="field-group">
                                <div class="field">
                                    <label for="cidadeFuncionario">Cidade</label>
                                    <input type="text" name="cidadeFuncionario" id="cidadeFuncionario" value="'.$funcionario->getCidade().'" required>   
                                </div>

                                <div class="field">
                                    <label for="bairroFuncionario">Bairro</label>
                                    <input type="text" name="bairroFuncionario" id="" value="'.$funcionario->getBairro().'" required>
                                </div>
                            </div>
                            
                            <div class="field-group">
                                <div class="field">
                                    <label for="ruaFuncionario">Rua</label>
                                    <input type="text" name="ruaFuncionario" id="" value="'.$funcionario->getRua().'" required>
                                </div>

                                <div class="field">
                                    <label for="numComplementoFuncionario">N°/Complemento</label>
                                    <input type="text" name="numComplementoFuncionario" id="" value="'.$funcionario->getNumeroComplemento().'" required>
                                </div>
                            </div>
                            
                            <div class="field-group">
                            <div class="field">
                                <label for="cargoFuncionario">Cargo</label>
                                <select name="cargoFuncionario" id="">
                                    <option value="'.$funcionario->getCargo().'">'.$funcionario->getCargo().'</option>
                                    <option value="FUNCIONARIO">FUNCIONARIO</option>
                                    <option value="GERENTE">GERENTE</option>
                                </select>
                            </div>
                            
                            <div class="field">
                                <label for="loginFuncionario">Login</label>
                                <input type="text" name="loginFuncionario" id="" value="'.$funcionario->getLogin().'" required>
                            </div>
                            
                            <div class="field">
                                <label for="senhaFuncionario">Senha</label>
                                <input type="text" name="senhaFuncionario" id="" >
                            </div>
                        </div>
                        
                        </fieldset>

                        <button type="submit">Atualizar Funcionario</button>
                    </form>

                    <form action="gerenteApagarFuncionario.php" method="POST">
                        <span>Excluir Funcionario</span>
                        <input type="text" name="cpfFuncionario"value="'.$funcionario->getCpf().'" required>
                        <button type="submit" id="botao">Excluir Funcionario</button>
                    </form>
                ');
            }
            else{
                print('<div class="alerta atencao">Não existe funcionario com este CPF.</div>');
            }
        ?>
        <form action="gerenteConsultaFuncionario.php">
            <button type="submit" id='botao'>Voltar</button>
        </form>

        </div>
    </main>
    </div>
    
</body>
</html>