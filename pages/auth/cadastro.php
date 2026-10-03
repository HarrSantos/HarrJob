<?php /* HarrJob — Cadastro (somente front-end; sem processamento nesta etapa) */ ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Criar conta — HarrJob</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="../../css/style.css">
  <link rel="stylesheet" href="../../css/auth.css">
</head>
<body>

  <main id="cadastroPage" class="auth-page">
    <a class="auth-logo" href="../../index.php" aria-label="HarrJob — página inicial">
      <img class="brand-logo" src="../../assets/icons/logo.svg" alt="HarrJob">
    </a>

    <section id="cadastroCard" class="card auth-card auth-card-largo" aria-labelledby="cadastroTitulo">
      <header class="auth-cabecalho">
        <h1 id="cadastroTitulo" class="titulo-lg">Crie sua conta</h1>
        <p class="texto-2">Faça parte do HarrJob e dê o próximo passo na sua trajetória profissional.</p>
      </header>

      <form id="cadastroForm" class="auth-form cadastro-form" method="post" enctype="multipart/form-data">

        <input class="tipo-radio" type="radio" id="tipoCandidato" name="tipo_cadastro" value="candidato" checked>
        <input class="tipo-radio" type="radio" id="tipoEmpresa" name="tipo_cadastro" value="empresa">

        <fieldset class="tipo-escolha">
          <legend class="grupo-legenda">Como você vai usar o HarrJob?</legend>
          <div class="tipo-opcoes">
            <label class="tipo-card" for="tipoCandidato">
              <i class="bi bi-check-circle-fill tipo-check" aria-hidden="true"></i>
              <span class="icone-caixa"><i class="bi bi-person" aria-hidden="true"></i></span>
              <span class="titulo-md">Sou candidato</span>
              <p>Encontre oportunidades e construa seu perfil profissional.</p>
            </label>
            <label class="tipo-card" for="tipoEmpresa">
              <i class="bi bi-check-circle-fill tipo-check" aria-hidden="true"></i>
              <span class="icone-caixa"><i class="bi bi-building" aria-hidden="true"></i></span>
              <span class="titulo-md">Sou empresa</span>
              <p>Publique oportunidades e gerencie sua equipe.</p>
            </label>
          </div>
          <p class="tipo-nota">Você terá uma única conta no HarrJob, com o mesmo login para tudo.</p>
        </fieldset>

        <fieldset id="dadosConta">
          <legend class="grupo-legenda">Dados de acesso</legend>
          <div class="grupo-campos">
            <div class="campo">
              <label class="campo-label" for="email">E-mail</label>
              <input class="input" id="email" name="email" type="email" autocomplete="email" required>
            </div>
            <div class="grade-2">
              <div class="campo">
                <label class="campo-label" for="senha">Senha</label>
                <input class="input" id="senha" name="senha" type="password" autocomplete="new-password" required>
              </div>
              <div class="campo">
                <label class="campo-label" for="confirmarSenha">Confirmar senha</label>
                <input class="input" id="confirmarSenha" name="confirmar_senha" type="password" autocomplete="new-password" required>
              </div>
            </div>
          </div>
        </fieldset>

        <section id="cadastroCandidato" aria-labelledby="legendaCandidato">
          <fieldset>
            <legend id="legendaCandidato" class="grupo-legenda">Seu perfil</legend>
            <div class="grupo-campos">
              <div class="campo">
                <label class="campo-label" for="nome">Nome completo</label>
                <input class="input" id="nome" name="nome" type="text" autocomplete="name" aria-required="true">
                <p class="campo-ajuda">O restante do perfil você completa depois, com calma.</p>
              </div>
            </div>
          </fieldset>
        </section>

        <section id="cadastroEmpresa" aria-labelledby="legendaEmpresa">
          <fieldset>
            <legend id="legendaEmpresa" class="grupo-legenda">Dados da empresa</legend>
            <div class="grupo-campos">
              <div class="grade-2">
                <div class="campo">
                  <label class="campo-label" for="nomeEmpresa">Nome da empresa</label>
                  <input class="input" id="nomeEmpresa" name="nome_empresa" type="text" autocomplete="organization" aria-required="true">
                </div>
                <div class="campo">
                  <label class="campo-label" for="cnpj">CNPJ</label>
                  <input class="input" id="cnpj" name="cnpj" type="text" inputmode="numeric" maxlength="14" aria-required="true" aria-describedby="ajudaCnpj">
                  <p id="ajudaCnpj" class="campo-ajuda">Somente números.</p>
                </div>
              </div>
              <div class="campo">
                <label class="campo-label" for="descricaoEmpresa">Descrição</label>
                <textarea class="input input-area" id="descricaoEmpresa" name="descricao" rows="4"></textarea>
              </div>
              <div class="grade-2">
                <div class="campo">
                  <label class="campo-label" for="siteEmpresa">Site</label>
                  <input class="input" id="siteEmpresa" name="site" type="url" autocomplete="url">
                </div>
                <div class="campo">
                  <label class="campo-label" for="localizacaoEmpresa">Localização</label>
                  <input class="input" id="localizacaoEmpresa" name="localizacao" type="text">
                </div>
              </div>
              <div class="campo">
                <label class="campo-label" for="logoEmpresa">Logo</label>
                <input class="input input-arquivo" id="logoEmpresa" name="logo" type="file" accept="image/*">
              </div>
              <p class="campo-ajuda">Você será o administrador desta empresa no HarrJob.</p>
            </div>
          </fieldset>
        </section>

        <button id="btnCriarConta" class="btn btn-primary btn-lg btn-bloco" type="submit">Criar conta</button>
        <p class="auth-termos">Ao criar sua conta, você concorda com os termos de uso do HarrJob.</p>
      </form>

      <p class="auth-rodape">
        Já possui uma conta?
        <a id="linkLogin" class="link" href="login.php">Entrar</a>
      </p>
    </section>
  </main>

</body>
</html>
