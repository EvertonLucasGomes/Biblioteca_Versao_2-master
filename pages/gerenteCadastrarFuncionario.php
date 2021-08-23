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
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
    <title>Cadastro de Funcionario</title>
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
        <strong>Cadastro de funcion&aacute;rio</strong>
        <div id="content_main">
            
            <form action="gerenteInserirFuncionario.php" method="POST">
                <fieldset>
                    <div class="field">
                        <label for="nameFuncionario">Nome do Funcion&aacute;rio</label>
                        <input type="text" name="nameFuncionario" id="" required>
                    </div>
                    
                    <div class="field-group">
                        <div class="field">
                            <label for="cpfFuncionario">CPF</label>
                            <input type="text" name="cpfFuncionario" id="cpfFuncionario" required>
                        </div>

                        <div class="field">
                            <label for="rgFuncionario">RG</label>
                            <input type="number" name="rgFuncionario" id="" required>
                        </div>

                        <div class="field">
                            <label for="nascimentoFuncionario">Data de nascimento</label>
                            <input type="text" name="nascimentoFuncionario" id="nascimentoFuncionario" placeholder="AAAA-MM-DD" required> 
                        </div>

                        <div class="field">
                            <label for="telefoneFuncionario">Telefone</label>
                            <input type="text" name="telefoneFuncionario" id="telefoneFuncionario" required>
                        </div>
                    </div>

                    <div class="field-group">
                        <div class="field">
                            <label for="cidadeFuncionario">Cidade</label>
                            <input type="text" name="cidadeFuncionario" required>
                        </div>

                        <div class="field">
                            <label for="bairroFuncionario">Bairro</label>
                            <input type="text" name="bairroFuncionario" id="bairro" required>
                        </div>
                    </div>
                    
                    <div class="field-group">
                        <div class="field">
                            <label for="ruaFuncionario">Rua</label>
                            <input type="text" name="ruaFuncionario" id="" required>
                        </div>

                        <div class="field">
                            <label for="numComplementoFuncionario">N°/Complemento</label>
                            <input type="text" name="numComplementoFuncionario" id="" required>
                        </div>
                    </div>

                    <div class="field-group">
                        <div class="field">
                            <label for="cargo">Cargo</label>
                            <select name="cargo" id="">
                                <option value="selecionar">Selecione o cargo</option>
                                <option value="FUNCIONARIO">FUNCIONARIO</option>
                                <option value="GERENTE">GERENTE</option>
                            </select>
                        </div>
                        
                        <div class="field">
                            <label for="loginFuncionario">Login</label>
                            <input type="text" name="loginFuncionario" id="" required>
                        </div>
                        
                        <div class="field">
                            <label for="senhaFuncionario">Senha</label>
                            <input type="text" name="senhaFuncionario" id="" required>
                        </div>
                    </div>
                </fieldset>
                
                <button type="submit">Cadastrar</button>
            </form>
            
        </div>
    </main>
    </div>
    <script src="../scripts/cadastroCliente.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#cpfFuncionario").mask("999.999.999-99");
            $("#telefoneFuncionario").mask("(99)99999-9999");
            $("#nascimentoFuncionario").mask("9999-99-99");
        });
    </script>
</body>
</html>