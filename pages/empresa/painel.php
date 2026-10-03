<?php
/* HarrJob — Painel da empresa (somente front-end; dados MOCK, sem banco) */

$base          = '../../';
$paginaAtiva   = 'painel';
$funcaoUsuario = 'administrador';   // mock de empresa_usuarios.funcao: administrador | recrutador

function esc($texto) { return htmlspecialchars((string) $texto, ENT_QUOTES, 'UTF-8'); }

function iniciais($nome) {
  $partes = preg_split('/\s+/', trim($nome));
  $ini = strtoupper(substr($partes[0], 0, 1));
  if (count($partes) > 1) { $ini .= strtoupper(substr($partes[count($partes) - 1], 0, 1)); }
  return $ini;
}

function formatar_reais($valor) { return 'R$ ' . number_format($valor, 0, ',', '.'); }

function formatar_salario($min, $max) {
  if ($min !== null && $max !== null) { return formatar_reais($min) . ' – ' . formatar_reais($max); }
  if ($min !== null) { return 'A partir de ' . formatar_reais($min); }
  if ($max !== null) { return 'Até ' . formatar_reais($max); }
  return null;
}

$modalidades = ['remoto' => 'Remoto', 'hibrido' => 'Híbrido', 'presencial' => 'Presencial'];
$contratos   = ['clt' => 'CLT', 'estagio' => 'Estágio', 'pj' => 'PJ', 'temporario' => 'Temporário'];
$statusRotulos = ['pendente' => 'Pendente', 'em_analise' => 'Em análise', 'aprovada' => 'Aprovada', 'rejeitada' => 'Rejeitada'];
$statusIcones  = ['pendente' => 'bi-hourglass-split', 'em_analise' => 'bi-eye', 'aprovada' => 'bi-check-circle', 'rejeitada' => 'bi-x-circle'];

/* MOCK — futuramente: empresas (via empresa_usuarios), vagas (empresa_id) e candidaturas + perfis */
$empresa = ['nome' => 'Nova Tech', 'logo' => null, 'localizacao' => 'Santos, SP'];

$vagas = [
  ['titulo' => 'Desenvolvedor Backend PHP',  'localizacao' => 'Santos, SP', 'modalidade' => 'remoto',     'contrato' => 'clt',        'salario_min' => 3000, 'salario_max' => 4500, 'criado_em' => '2026-09-30', 'status' => 'aberta'],
  ['titulo' => 'Desenvolvedor Front-end',    'localizacao' => 'Santos, SP', 'modalidade' => 'hibrido',    'contrato' => 'clt',        'salario_min' => 3500, 'salario_max' => null, 'criado_em' => '2026-09-25', 'status' => 'aberta'],
  ['titulo' => 'Estágio em Suporte de TI',   'localizacao' => 'Santos, SP', 'modalidade' => 'presencial', 'contrato' => 'estagio',    'salario_min' => null, 'salario_max' => null, 'criado_em' => '2026-09-18', 'status' => 'aberta'],
  ['titulo' => 'Analista de QA',             'localizacao' => 'Santos, SP', 'modalidade' => 'remoto',     'contrato' => 'pj',         'salario_min' => null, 'salario_max' => 5000, 'criado_em' => '2026-08-28', 'status' => 'encerrada'],
  ['titulo' => 'Designer de Interfaces',     'localizacao' => 'Santos, SP', 'modalidade' => 'hibrido',    'contrato' => 'temporario', 'salario_min' => 2500, 'salario_max' => 3500, 'criado_em' => '2026-08-10', 'status' => 'encerrada'],
];
$candidaturas = [
  ['candidato' => 'Mariana Souza',    'vaga' => 'Desenvolvedor Backend PHP', 'status' => 'em_analise', 'criado_em' => '2026-10-01'],
  ['candidato' => 'Rafael Lima',      'vaga' => 'Desenvolvedor Front-end',   'status' => 'pendente',   'criado_em' => '2026-10-01'],
  ['candidato' => 'Camila Nogueira',  'vaga' => 'Estágio em Suporte de TI',  'status' => 'pendente',   'criado_em' => '2026-09-29'],
  ['candidato' => 'João Pereira',     'vaga' => 'Desenvolvedor Backend PHP', 'status' => 'aprovada',   'criado_em' => '2026-09-27'],
  ['candidato' => 'Beatriz Almeida',  'vaga' => 'Desenvolvedor Front-end',   'status' => 'rejeitada',  'criado_em' => '2026-09-24'],
  ['candidato' => 'Lucas Martins',    'vaga' => 'Analista de QA',            'status' => 'rejeitada',  'criado_em' => '2026-09-05'],
  ['candidato' => 'Fernanda Rocha',   'vaga' => 'Analista de QA',            'status' => 'aprovada',   'criado_em' => '2026-09-01'],
  ['candidato' => 'Pedro Cardoso',    'vaga' => 'Designer de Interfaces',    'status' => 'pendente',   'criado_em' => '2026-08-20'],
];

/* Indicadores derivados (futuramente: COUNT em vagas e candidaturas) */
$totalAbertas = 0;
$totalEncerradas = 0;
foreach ($vagas as $item) {
  if ($item['status'] === 'aberta') { $totalAbertas++; } else { $totalEncerradas++; }
}
$totalCandidaturas    = count($candidaturas);
$vagasRecentes        = array_slice($vagas, 0, 4);
$candidaturasRecentes = array_slice($candidaturas, 0, 5);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Visão geral — <?= esc($empresa['nome']) ?> — HarrJob</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="../../css/style.css">
  <link rel="stylesheet" href="../../css/empresa.css">
</head>
<body>

  <?php include __DIR__ . '/../../includes/sidebar-empresa.php'; ?>

  <div class="app-main">
    <main id="paginaPainelEmpresa" class="app-content">

      <header class="painel-topo">
        <div class="painel-topo-texto">
          <h1 id="tituloPainelEmpresa" class="titulo-lg">Visão geral</h1>
          <p class="texto-lead">Olá, <?= esc($empresa['nome']) ?>. Acompanhe suas oportunidades e candidaturas em um só lugar.</p>
        </div>
        <a id="btnCriarVaga" class="btn btn-primary btn-lg" href="vagas.php"><i class="bi bi-plus-lg" aria-hidden="true"></i> Criar nova vaga</a>
      </header>

      <section id="resumoEmpresa" aria-label="Resumo da empresa">
        <ul class="resumo-empresa">
          <li class="card resumo-card">
            <span class="icone-caixa"><i class="bi bi-briefcase" aria-hidden="true"></i></span>
            <div><strong id="totalVagasAbertas" class="resumo-valor"><?= $totalAbertas ?></strong><span class="resumo-rotulo">Vagas abertas</span></div>
          </li>
          <li class="card resumo-card">
            <span class="icone-caixa"><i class="bi bi-inbox" aria-hidden="true"></i></span>
            <div><strong id="totalCandidaturas" class="resumo-valor"><?= $totalCandidaturas ?></strong><span class="resumo-rotulo">Candidaturas recebidas</span></div>
          </li>
          <li class="card resumo-card">
            <span class="icone-caixa"><i class="bi bi-archive" aria-hidden="true"></i></span>
            <div><strong id="totalVagasEncerradas" class="resumo-valor"><?= $totalEncerradas ?></strong><span class="resumo-rotulo">Vagas encerradas</span></div>
          </li>
        </ul>
      </section>

      <div class="painel-layout">

        <div class="painel-principal">

          <section id="vagasEmpresa">
            <div class="painel-secao-cab">
              <h2>Suas vagas</h2>
              <a class="link-acao" href="vagas.php">Ver todas as vagas</a>
            </div>

            <ul id="listaVagasEmpresa" class="vagas-empresa-lista">
              <?php foreach ($vagasRecentes as $vaga): $salario = formatar_salario($vaga['salario_min'], $vaga['salario_max']); ?>
              <li>
                <article class="vaga-empresa-card">
                  <div class="vaga-empresa-topo">
                    <h3 class="vaga-empresa-titulo"><?= esc($vaga['titulo']) ?></h3>
                    <?php if ($vaga['status'] === 'aberta'): ?>
                    <span class="tag vaga-empresa-status"><i class="bi bi-circle-fill vaga-ponto" aria-hidden="true"></i> Aberta</span>
                    <?php else: ?>
                    <span class="tag vaga-empresa-status status-encerrada">Encerrada</span>
                    <?php endif; ?>
                  </div>
                  <?php if (!empty($vaga['localizacao'])): ?>
                  <p class="vaga-empresa-local"><i class="bi bi-geo-alt" aria-hidden="true"></i> <?= esc($vaga['localizacao']) ?></p>
                  <?php endif; ?>
                  <p class="vaga-empresa-meta">
                    <span class="tag"><?= $modalidades[$vaga['modalidade']] ?></span>
                    <span class="tag tag-neutra"><?= $contratos[$vaga['contrato']] ?></span>
                  </p>
                  <?php if ($salario !== null): ?>
                  <p class="vaga-empresa-salario"><?= esc($salario) ?></p>
                  <?php endif; ?>
                  <div class="vaga-empresa-rodape">
                    <span>Publicada em <time datetime="<?= $vaga['criado_em'] ?>"><?= date('d/m/Y', strtotime($vaga['criado_em'])) ?></time></span>
                    <a class="link-acao" href="vagas.php" aria-label="Ver vaga: <?= esc($vaga['titulo']) ?>">Ver vaga</a>
                  </div>
                </article>
              </li>
              <?php endforeach; ?>
            </ul>

            <div id="estadoSemVagas" class="estado-vazio" hidden>
              <span class="icone-caixa"><i class="bi bi-briefcase" aria-hidden="true"></i></span>
              <h3 class="titulo-md">Sua empresa ainda não possui vagas.</h3>
              <a class="btn btn-primary" href="vagas.php">Criar primeira vaga</a>
            </div>
          </section>

          <section id="candidaturasRecentes">
            <div class="painel-secao-cab">
              <h2>Candidaturas recentes</h2>
              <a class="link-acao" href="candidaturas.php">Ver todas as candidaturas</a>
            </div>

            <div class="card candidaturas-recentes">
              <ul id="listaCandidaturasRecentes">
                <?php foreach ($candidaturasRecentes as $item): ?>
                <li class="candidatura-recente">
                  <span class="candidatura-avatar" aria-hidden="true"><?= esc(iniciais($item['candidato'])) ?></span>
                  <div class="candidatura-recente-info">
                    <p class="candidatura-candidato"><?= esc($item['candidato']) ?></p>
                    <p class="candidatura-vaga"><?= esc($item['vaga']) ?></p>
                  </div>
                  <div class="candidatura-recente-meta">
                    <span class="tag candidatura-recente-status status-<?= str_replace('_', '-', $item['status']) ?>"><i class="bi <?= $statusIcones[$item['status']] ?>" aria-hidden="true"></i> <?= $statusRotulos[$item['status']] ?></span>
                    <time class="candidatura-data" datetime="<?= $item['criado_em'] ?>"><?= date('d/m/Y', strtotime($item['criado_em'])) ?></time>
                  </div>
                  <a class="link-acao candidatura-recente-link" href="candidaturas.php" aria-label="Ver candidatura de <?= esc($item['candidato']) ?>">Ver candidatura</a>
                </li>
                <?php endforeach; ?>
              </ul>
            </div>

            <div id="estadoSemCandidaturasEmpresa" class="estado-vazio" hidden>
              <span class="icone-caixa"><i class="bi bi-inbox" aria-hidden="true"></i></span>
              <h3 class="titulo-md">Ainda não há candidaturas para suas vagas.</h3>
            </div>
          </section>

        </div>

        <aside class="painel-lateral">
          <section class="card empresa-card">
            <h2>Sua empresa</h2>
            <div class="empresa-card-cab">
              <span class="avatar avatar-empresa">
                <?php if (!empty($empresa['logo'])): ?>
                <img src="<?= esc($base . $empresa['logo']) ?>" alt="Logo da <?= esc($empresa['nome']) ?>">
                <?php else: ?>
                <span aria-hidden="true"><?= esc(strtoupper(substr($empresa['nome'], 0, 1))) ?></span>
                <?php endif; ?>
              </span>
              <div>
                <p class="empresa-card-nome"><?= esc($empresa['nome']) ?></p>
                <?php if (!empty($empresa['localizacao'])): ?>
                <p class="empresa-card-local"><i class="bi bi-geo-alt" aria-hidden="true"></i> <?= esc($empresa['localizacao']) ?></p>
                <?php endif; ?>
              </div>
            </div>
            <a class="link-acao" href="perfil.php">Ver perfil da empresa</a>
          </section>
        </aside>

      </div>
    </main>
  </div>

</body>
</html>
