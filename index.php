<?php /* HarrJob — Landing Page */ ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>HarrJob — Encontre sua próxima oportunidade</title>
  <meta name="description" content="Descubra vagas que combinam com seu perfil e dê o próximo passo na sua carreira com o HarrJob.">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/landing.css">
</head>
<body>

  <header id="siteHeader" class="site-header">
    <div class="container header-inner">
      <a id="linkLogo" href="index.php" aria-label="HarrJob — página inicial">
        <img class="brand-logo" src="assets/icons/logo.svg" alt="HarrJob">
      </a>
      <nav id="navPrincipal" class="main-nav" aria-label="Navegação principal">
        <a id="navVagas" class="nav-link" href="pages/vagas/index.php">Vagas</a>
        <a id="navComoFunciona" class="nav-link" href="#comoFunciona">Como funciona</a>
      </nav>
      <div class="header-actions">
        <a id="btnEntrar" class="btn btn-ghost" href="pages/auth/login.php">Entrar</a>
        <a id="btnHeaderCriarConta" class="btn btn-primary" href="pages/auth/cadastro.php">Criar conta</a>
      </div>
    </div>
  </header>

  <main id="mainContent">

    <section id="hero" class="hero">
      <div class="container hero-grid">
        <div class="hero-texto">
          <h1 class="titulo-xl">Encontre sua próxima oportunidade profissional</h1>
          <p class="texto-lead">Descubra vagas que combinam com seu perfil e dê o próximo passo na sua carreira.</p>
          <div class="hero-acoes">
            <a id="btnEncontrarVagas" class="btn btn-primary btn-lg" href="pages/vagas/index.php">Encontrar vagas</a>
            <a id="btnCriarConta" class="btn btn-secondary btn-lg" href="pages/auth/cadastro.php">Criar minha conta</a>
          </div>
        </div>

        <div id="heroPreview" class="hero-visual" aria-hidden="true">
          <article class="card vaga-card">
            <div class="vaga-topo">
              <span class="vaga-empresa-logo">N</span>
              <div>
                <p class="vaga-empresa">Nova Tech</p>
                <h2 class="titulo-md">Desenvolvedor Backend</h2>
              </div>
            </div>
            <p class="vaga-local"><i class="bi bi-geo-alt"></i> Santos, SP</p>
            <div class="vaga-tags">
              <span class="tag">Remoto</span>
              <span class="tag tag-neutra">CLT</span>
            </div>
            <p class="vaga-salario">R$ 3.000 - R$ 4.500</p>
            <p class="vaga-rodape">Ver oportunidade</p>
          </article>
          <div class="card status-card">
            <span class="icone-caixa"><i class="bi bi-clipboard-check"></i></span>
            <p><strong>Candidatura enviada</strong>Status: em análise</p>
          </div>
        </div>
      </div>
    </section>

    <section id="comoFunciona" class="section">
      <div class="container">
        <div class="secao-topo">
          <h2 class="titulo-lg">Como funciona</h2>
          <p class="texto-lead">Três passos entre o seu perfil e a sua próxima vaga.</p>
        </div>
        <ol class="passos">
          <li class="card passo">
            <span class="passo-numero">1</span>
            <h3 class="titulo-md">Crie seu perfil</h3>
            <p class="texto-2">Reúna formações, experiências e competências em um só lugar.</p>
          </li>
          <li class="card passo">
            <span class="passo-numero">2</span>
            <h3 class="titulo-md">Encontre oportunidades</h3>
            <p class="texto-2">Pesquise vagas por localização, modalidade e tipo de contrato.</p>
          </li>
          <li class="card passo">
            <span class="passo-numero">3</span>
            <h3 class="titulo-md">Candidate-se</h3>
            <p class="texto-2">Envie sua candidatura e acompanhe cada etapa pelo HarrJob.</p>
          </li>
        </ol>
      </div>
    </section>

    <section id="paraCandidatos" class="section">
      <div class="container candidatos-grid">
        <div>
          <h2 class="titulo-lg">Tudo o que você precisa para se candidatar</h2>
          <ul class="recursos">
            <li class="recurso">
              <span class="icone-caixa"><i class="bi bi-person-vcard"></i></span>
              <div>
                <h3 class="titulo-md">Perfil profissional</h3>
                <p>Organize suas informações profissionais, experiências, formações e competências.</p>
              </div>
            </li>
            <li class="recurso">
              <span class="icone-caixa"><i class="bi bi-search"></i></span>
              <div>
                <h3 class="titulo-md">Oportunidades</h3>
                <p>Encontre vagas usando pesquisa, localização, modalidade e tipo de contrato.</p>
              </div>
            </li>
            <li class="recurso">
              <span class="icone-caixa"><i class="bi bi-clipboard-check"></i></span>
              <div>
                <h3 class="titulo-md">Candidaturas</h3>
                <p>Acompanhe o status das suas candidaturas.</p>
              </div>
            </li>
          </ul>
        </div>

        <div id="previaCandidaturas" class="card candidaturas-preview" aria-hidden="true">
          <h3 class="titulo-md">Minhas candidaturas</h3>
          <ul>
            <li class="candidatura-item">
              <div>
                <p class="candidatura-cargo">Desenvolvedor Backend</p>
                <p class="candidatura-empresa">Nova Tech</p>
              </div>
              <span class="tag">Em análise</span>
            </li>
            <li class="candidatura-item">
              <div>
                <p class="candidatura-cargo">Analista de Suporte</p>
                <p class="candidatura-empresa">Costa Digital</p>
              </div>
              <span class="tag tag-neutra">Pendente</span>
            </li>
            <li class="candidatura-item">
              <div>
                <p class="candidatura-cargo">Estagiário de TI</p>
                <p class="candidatura-empresa">Porto Sistemas</p>
              </div>
              <span class="tag">Aprovada</span>
            </li>
          </ul>
        </div>
      </div>
    </section>

    <section id="paraEmpresas" class="section">
      <div class="container">
        <div class="empresas-bloco">
          <div class="empresas-texto">
            <h2 class="titulo-lg">Para empresas</h2>
            <p class="texto-lead">Publique oportunidades, acompanhe candidaturas e organize sua equipe no HarrJob.</p>
            <a id="btnCriarContaEmpresarial" class="btn btn-inverso btn-lg" href="pages/auth/cadastro.php">Criar conta empresarial</a>
          </div>
          <ul class="empresas-lista">
            <li><i class="bi bi-briefcase"></i> Publique vagas</li>
            <li><i class="bi bi-inbox"></i> Acompanhe candidaturas</li>
            <li><i class="bi bi-people"></i> Organize sua equipe</li>
          </ul>
        </div>
      </div>
    </section>

    <section id="ctaFinal" class="cta-final">
      <div class="container">
        <div class="card cta-caixa">
          <h2 class="titulo-lg">Pronto para dar o próximo passo?</h2>
          <p class="texto-lead">Encontre oportunidades e construa sua trajetória profissional no HarrJob.</p>
          <div class="cta-acoes">
            <a id="btnCtaEncontrarVagas" class="btn btn-primary btn-lg" href="pages/vagas/index.php">Encontrar vagas</a>
            <a id="btnCtaCriarConta" class="btn btn-secondary btn-lg" href="pages/auth/cadastro.php">Criar conta</a>
          </div>
        </div>
      </div>
    </section>

  </main>

  <footer id="siteFooter" class="site-footer">
    <div class="container">
      <div class="footer-inner">
        <a id="footerLogo" href="index.php" aria-label="HarrJob — página inicial">
          <img class="brand-logo" src="assets/icons/logo.svg" alt="HarrJob">
        </a>
        <nav id="footerNav" class="footer-nav" aria-label="Rodapé">
          <a class="nav-link" href="pages/vagas/index.php">Vagas</a>
          <a class="nav-link" href="#comoFunciona">Como funciona</a>
          <a class="nav-link" href="pages/auth/login.php">Entrar</a>
          <a class="nav-link" href="pages/auth/cadastro.php">Criar conta</a>
        </nav>
      </div>
      <p class="footer-copy">© <?= date('Y') ?> HarrJob</p>
    </div>
  </footer>

</body>
</html>
