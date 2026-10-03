<?php /* HarrJob — Login (somente front-end; sem autenticação nesta etapa) */ ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Entrar — HarrJob</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../../css/style.css">
  <link rel="stylesheet" href="../../css/auth.css">
</head>
<body>

  <main id="loginPage" class="auth-page">
    <a class="auth-logo" href="../../index.php" aria-label="HarrJob — página inicial">
      <img class="brand-logo" src="../../assets/icons/logo.svg" alt="HarrJob">
    </a>

    <section id="loginCard" class="card auth-card" aria-labelledby="loginTitulo">
      <div class="auth-cabecalho">
        <h1 id="loginTitulo" class="titulo-lg">Bem-vindo de volta</h1>
        <p class="texto-2">Entre na sua conta para continuar no HarrJob.</p>
      </div>

      <form id="loginForm" class="auth-form" method="post">
        <div class="campo">
          <label class="campo-label" for="email">E-mail</label>
          <input class="input" id="email" name="email" type="email" autocomplete="email" required>
        </div>

        <div class="campo">
          <label class="campo-label" for="senha">Senha</label>
          <input class="input" id="senha" name="senha" type="password" autocomplete="current-password" required>
        </div>

        <a id="linkEsqueciSenha" class="link auth-esqueci" href="#">Esqueci minha senha</a>

        <button id="btnEntrar" class="btn btn-primary btn-lg btn-bloco" type="submit">Entrar</button>
      </form>

      <p class="auth-rodape">
        Ainda não possui uma conta?
        <a id="linkCadastro" class="link" href="cadastro.php">Criar conta</a>
      </p>
    </section>
  </main>

</body>
</html>
