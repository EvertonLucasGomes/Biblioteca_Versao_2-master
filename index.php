<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="styles/login.css" />
    <link rel="stylesheet" href="css/bulma.min.css" />
    <link rel="icon" type="imagem/png" href="../assets/icon.png" />
    <title>Login</title>
  </head>
  <body>
    <div id="page-auth">
    
      <main>
        <div class="main-content">
          <h2>Login</h2>
          <p>
            Para acessar o sistema, por favor, fa&ccedil;a o login com seus
            dados de acesso.
          </p>
          <?php
              if(isset($_SESSION['nao_autenticado'])):
          ?>
        <div class="erro-login">
          ERRO: Usuário ou senha inválidos.
        </div>
      <?php
      endif;
      unset($_SESSION['nao_autenticado']);
      ?>
          <form action="pages/login.php" method="POST">
            <input
              type="text"
              name="user"
              id="user"
              placeholder="Informe seu usu&aacute;rio"
              required
            />
            <input
              type="password"
              name="password"
              id="password"
              placeholder="Informe sua senha"
              required
            />
            <button type="submit">ENTRAR</button>
          </form>
      </main>
      
      <aside>
        <img src="assets/books.png" alt="Imagem de livros empilhados" />
        <strong>BeloBiblio</strong>
        <p>Biblioteca P&uacute;blica do Munic&iacute;pio de Belo Jardim</p>
      </aside>
    </div>
  </body>
</html>
