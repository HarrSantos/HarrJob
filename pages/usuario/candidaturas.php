<?php
/* HarrJob — Minhas candidaturas (somente front-end; dados MOCK, sem banco) */

$base        = '../../';
$paginaAtiva = 'candidaturas';

function esc($texto) { return htmlspecialchars((string) $texto, ENT_QUOTES, 'UTF-8'); }

$statusRotulos  = ['pendente' => 'Pendente', 'em_analise' => 'Em análise', 'aprovada' => 'Aprovada', 'rejeitada' => 'Rejeitada'];
$statusIcones   = ['pendente' => 'bi-hourglass-split', 'em_analise' => 'bi-eye', 'aprovada' => 'bi-check-circle', 'rejeitada' => 'bi-x-circle'];
$filtrosStatus  = ['pendente' => 'Pendentes', 'em_analise' => 'Em análise', 'aprovada' => 'Aprovadas', 'rejeitada' => 'Rejeitadas'];
$modalidades    = ['remoto' => 'Remoto', 'hibrido' => 'Híbrido', 'presencial' => 'Presencial'];
$contratos      = ['clt' => 'CLT', 'estagio' => 'Estágio', 'pj' => 'PJ', 'temporario' => 'Temporário'];

/* MOCK — futuramente: candidaturas JOIN vagas JOIN empresas, filtradas por usuario_id.
   'criado_em' é a data da CANDIDATURA (candidaturas.criado_em). */
$candidaturas = [
  ['vaga_id' => 1, 'empresa' => 'Nova Tech',         'logo' => null, 'titulo' => 'Desenvolvedor Backend PHP',      'localizacao' => 'Santos, SP',       'modalidade' => 'remoto',     'contrato' => 'clt',        'status' => 'em_analise', 'criado_em' => '2026-10-01 14:20:00'],
  ['vaga_id' => 2, 'empresa' => 'Costa Digital',     'logo' => null, 'titulo' => 'Analista de Suporte Técnico',    'localizacao' => 'São Paulo, SP',    'modalidade' => 'hibrido',    'contrato' => 'clt',        'status' => 'pendente',   'criado_em' => '2026-09-30 09:05:00'],
  ['vaga_id' => 3, 'empresa' => 'Porto Sistemas',    'logo' => null, 'titulo' => 'Estágio em Desenvolvimento Web', 'localizacao' => 'Santos, SP',       'modalidade' => 'presencial', 'contrato' => 'estagio',    'status' => 'aprovada',   'criado_em' => '2026-09-22 16:40:00'],
  ['vaga_id' => 4, 'empresa' => 'Atlas Consultoria', 'logo' => null, 'titulo' => 'Analista de Dados',              'localizacao' => 'Campinas, SP',     'modalidade' => 'remoto',     'contrato' => 'pj',         'status' => 'rejeitada',  'criado_em' => '2026-09-18 11:10:00'],
  ['vaga_id' => 5, 'empresa' => 'Vale Logística',    'logo' => null, 'titulo' => 'Assistente Administrativo',      'localizacao' => 'Praia Grande, SP', 'modalidade' => 'presencial', 'contrato' => 'temporario', 'status' => 'pendente',   'criado_em' => '2026-09-14 08:30:00'],
];

/* Resumo derivado das candidaturas (futuramente: COUNT agrupado por status) */
$totais = ['pendente' => 0, 'em_analise' => 0, 'aprovada' => 0, 'rejeitada' => 0];
foreach ($candidaturas as $item) { $totais[$item['status']]++; }
$total = count($candidaturas);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Minhas candidaturas — HarrJob</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="../../css/style.css">
  <link rel="stylesheet" href="../../css/candidaturas.css">
</head>
<body>

  <?php include __DIR__ . '/../../includes/sidebar-usuario.php'; ?>

  <div class="app-main">
    <main id="paginaCandidaturas" class="app-content">

      <header class="candidaturas-topo">
        <h1 id="tituloCandidaturas" class="titulo-lg">Minhas candidaturas</h1>
        <p class="texto-lead">Acompanhe suas candidaturas e veja o status de cada oportunidade.</p>
      </header>

      <section id="resumoCandidaturas" class="candidaturas-secao">
        <h2 class="sr-only">Resumo das candidaturas</h2>
        <ul class="resumo-lista">
          <li class="resumo-item is-total"><span class="resumo-rotulo">Total de candidaturas</span><strong id="totalCandidaturas" class="resumo-valor"><?= $total ?></strong></li>
          <li class="resumo-item"><span class="resumo-rotulo">Pendentes</span><strong id="totalPendentes" class="resumo-valor"><?= $totais['pendente'] ?></strong></li>
          <li class="resumo-item"><span class="resumo-rotulo">Em análise</span><strong id="totalEmAnalise" class="resumo-valor"><?= $totais['em_analise'] ?></strong></li>
          <li class="resumo-item"><span class="resumo-rotulo">Aprovadas</span><strong id="totalAprovadas" class="resumo-valor"><?= $totais['aprovada'] ?></strong></li>
          <li class="resumo-item"><span class="resumo-rotulo">Rejeitadas</span><strong id="totalRejeitadas" class="resumo-valor"><?= $totais['rejeitada'] ?></strong></li>
        </ul>
      </section>

      <section class="candidaturas-secao">
        <h2 class="sr-only">Buscar e filtrar candidaturas</h2>
        <form id="formFiltroCandidaturas" class="card candidaturas-filtros" method="get" role="search">
          <div class="campo filtro-busca">
            <label class="campo-label" for="pesquisaCandidaturas">Buscar por vaga ou empresa</label>
            <div class="busca-campo">
              <i class="bi bi-search" aria-hidden="true"></i>
              <input class="input" id="pesquisaCandidaturas" name="pesquisa" type="search" autocomplete="off">
            </div>
          </div>
          <div class="campo filtro-status">
            <label class="campo-label" for="filtroStatusCandidatura">Status</label>
            <select class="input" id="filtroStatusCandidatura" name="status">
              <option value="">Todas</option>
              <?php foreach ($filtrosStatus as $valor => $rotulo): ?>
              <option value="<?= $valor ?>"><?= $rotulo ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <button id="btnFiltrarCandidaturas" class="btn btn-primary" type="submit">Filtrar</button>
        </form>
      </section>

      <section class="candidaturas-secao">
        <h2>Candidaturas enviadas</h2>

        <ul id="listaCandidaturas" class="lista-candidaturas">
          <?php foreach ($candidaturas as $item): ?>
          <li>
            <article class="candidatura-card">
              <div class="candidatura-logo">
                <?php if (!empty($item['logo'])): ?>
                <img src="<?= esc($base . $item['logo']) ?>" alt="Logo da <?= esc($item['empresa']) ?>">
                <?php else: ?>
                <span aria-hidden="true"><?= esc(strtoupper(substr($item['empresa'], 0, 1))) ?></span>
                <?php endif; ?>
              </div>

              <div class="candidatura-corpo">
                <p class="candidatura-empresa"><?= esc($item['empresa']) ?></p>
                <h3 class="candidatura-titulo"><?= esc($item['titulo']) ?></h3>
                <p class="candidatura-meta">
                  <?php if (!empty($item['localizacao'])): ?>
                  <span class="candidatura-local"><i class="bi bi-geo-alt" aria-hidden="true"></i> <?= esc($item['localizacao']) ?></span>
                  <?php endif; ?>
                  <span class="tag"><?= $modalidades[$item['modalidade']] ?></span>
                  <span class="tag tag-neutra"><?= $contratos[$item['contrato']] ?></span>
                </p>
              </div>

              <div class="candidatura-lateral">
                <span class="tag candidatura-status status-<?= str_replace('_', '-', $item['status']) ?>"><i class="bi <?= $statusIcones[$item['status']] ?>" aria-hidden="true"></i> <?= $statusRotulos[$item['status']] ?></span>
                <p class="candidatura-data">Candidatura enviada em <time datetime="<?= date('Y-m-d', strtotime($item['criado_em'])) ?>"><?= date('d/m/Y', strtotime($item['criado_em'])) ?></time></p>
                <a class="candidatura-link" href="../vagas/vaga.php?id=<?= (int) $item['vaga_id'] ?>" aria-label="Ver vaga: <?= esc($item['titulo']) ?>">Ver vaga <i class="bi bi-arrow-right" aria-hidden="true"></i></a>
              </div>
            </article>
          </li>
          <?php endforeach; ?>
        </ul>

        <!-- Estados preparados para uso futuro (ocultos por padrão) -->
        <div id="estadoSemResultadosCandidaturas" class="estado-vazio" hidden>
          <span class="icone-caixa"><i class="bi bi-search" aria-hidden="true"></i></span>
          <h3 class="titulo-md">Nenhuma candidatura encontrada</h3>
          <p class="texto-2">Tente alterar sua busca ou filtro.</p>
        </div>
        <div id="estadoSemCandidaturas" class="estado-vazio" hidden>
          <span class="icone-caixa"><i class="bi bi-file-earmark-text" aria-hidden="true"></i></span>
          <h3 class="titulo-md">Você ainda não se candidatou a nenhuma vaga.</h3>
          <p class="texto-2">Explore as oportunidades disponíveis e encontre sua próxima oportunidade.</p>
          <a class="btn btn-primary" href="../vagas/index.php">Encontrar vagas</a>
        </div>
      </section>

    </main>
  </div>

</body>
</html>
