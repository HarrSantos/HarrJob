<?php
/* HarrJob — Listagem de vagas (somente front-end; dados MOCK, sem banco) */

$base        = '../../';
$paginaAtiva = 'vagas';

$modalidades = ['remoto' => 'Remoto', 'hibrido' => 'Híbrido', 'presencial' => 'Presencial'];
$contratos   = ['clt' => 'CLT', 'estagio' => 'Estágio', 'pj' => 'PJ', 'temporario' => 'Temporário'];
$reais       = fn(float $v): string => 'R$ ' . number_format($v, 0, ',', '.');
$e           = fn(string $s): string => htmlspecialchars($s, ENT_QUOTES, 'UTF-8');

/* MOCK — futuramente: vagas JOIN empresas (empresa_id → empresas.id) */
$vagas = [
  ['id' => 1, 'empresa' => 'Nova Tech',          'titulo' => 'Desenvolvedor Backend PHP',   'localizacao' => 'Santos, SP',       'modalidade' => 'remoto',     'contrato' => 'clt',        'salario_min' => 3000, 'salario_max' => 4500, 'criado_em' => '2026-09-30', 'status' => 'aberta'],
  ['id' => 2, 'empresa' => 'Costa Digital',      'titulo' => 'Analista de Suporte Técnico', 'localizacao' => 'São Paulo, SP',    'modalidade' => 'hibrido',    'contrato' => 'clt',        'salario_min' => 3000, 'salario_max' => null, 'criado_em' => '2026-09-28', 'status' => 'aberta'],
  ['id' => 3, 'empresa' => 'Porto Sistemas',     'titulo' => 'Estágio em Desenvolvimento Web', 'localizacao' => 'Santos, SP',    'modalidade' => 'presencial', 'contrato' => 'estagio',    'salario_min' => null, 'salario_max' => null, 'criado_em' => '2026-09-26', 'status' => 'aberta'],
  ['id' => 4, 'empresa' => 'Atlas Consultoria',  'titulo' => 'Analista de Dados',           'localizacao' => 'Campinas, SP',     'modalidade' => 'remoto',     'contrato' => 'pj',         'salario_min' => null, 'salario_max' => 4500, 'criado_em' => '2026-09-19', 'status' => 'aberta'],
  ['id' => 5, 'empresa' => 'Vale Logística',     'titulo' => 'Assistente Administrativo',   'localizacao' => 'Praia Grande, SP', 'modalidade' => 'presencial', 'contrato' => 'temporario', 'salario_min' => 2200, 'salario_max' => 2600, 'criado_em' => '2026-09-12', 'status' => 'encerrada'],
];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Vagas — HarrJob</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="../../css/style.css">
  <link rel="stylesheet" href="../../css/vagas.css">
</head>
<body>

  <?php include __DIR__ . '/../../includes/sidebar-usuario.php'; ?>

  <div class="app-main">
    <main id="paginaVagas" class="app-content">

      <header class="vagas-topo">
        <h1 id="tituloVagas" class="titulo-lg">Encontre sua próxima oportunidade</h1>
        <p class="texto-lead">Explore oportunidades e encontre uma vaga que faça sentido para sua trajetória.</p>
      </header>

      <form id="formBuscaVagas" class="busca" method="get" role="search" aria-label="Buscar vagas">
        <div class="busca-principal">
          <i class="bi bi-search" aria-hidden="true"></i>
          <label class="sr-only" for="pesquisaVagas">Cargo, tecnologia ou palavra-chave</label>
          <input class="busca-input" id="pesquisaVagas" name="pesquisa" type="search" placeholder="Cargo, tecnologia ou palavra-chave" autocomplete="off">
        </div>

        <div class="busca-filtros">
          <div class="filtro">
            <label class="filtro-label" for="filtroLocalizacao"><i class="bi bi-geo-alt" aria-hidden="true"></i> Localização</label>
            <input class="filtro-controle" id="filtroLocalizacao" name="localizacao" type="text" placeholder="Ex.: Santos, SP">
          </div>
          <div class="filtro">
            <label class="filtro-label" for="filtroModalidade"><i class="bi bi-laptop" aria-hidden="true"></i> Modalidade</label>
            <select class="filtro-controle" id="filtroModalidade" name="modalidade">
              <option value="">Todas</option>
              <?php foreach ($modalidades as $valor => $rotulo): ?>
              <option value="<?= $valor ?>"><?= $rotulo ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="filtro">
            <label class="filtro-label" for="filtroContrato"><i class="bi bi-file-earmark-text" aria-hidden="true"></i> Contrato</label>
            <select class="filtro-controle" id="filtroContrato" name="contrato">
              <option value="">Todos</option>
              <?php foreach ($contratos as $valor => $rotulo): ?>
              <option value="<?= $valor ?>"><?= $rotulo ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="filtro">
            <label class="filtro-label" for="filtroSalario"><i class="bi bi-cash-stack" aria-hidden="true"></i> Salário</label>
            <select class="filtro-controle" id="filtroSalario" name="salario">
              <option value="">Qualquer faixa</option>
              <option value="3000-4500">R$ 3.000 – R$ 4.500</option>
              <option value="min-3000">A partir de R$ 3.000</option>
              <option value="max-4500">Até R$ 4.500</option>
              <option value="nao-informado">Salário não informado</option>
            </select>
          </div>
          <button id="btnPesquisarVagas" class="btn btn-primary" type="submit">Buscar vagas</button>
        </div>
      </form>

      <section id="resultadosVagas">
        <h2 class="titulo-md resultados-titulo">Oportunidades disponíveis</h2>

        <ul id="listaVagas" class="lista-vagas">
          <?php foreach ($vagas as $vaga):
            $min = $vaga['salario_min'];
            $max = $vaga['salario_max'];
            if ($min !== null && $max !== null)  { $salario = $reais($min) . ' – ' . $reais($max); }
            elseif ($min !== null)               { $salario = 'A partir de ' . $reais($min); }
            elseif ($max !== null)               { $salario = 'Até ' . $reais($max); }
            else                                 { $salario = null; }
            $encerrada = $vaga['status'] === 'encerrada';
          ?>
          <li>
            <article class="vaga-item<?= $encerrada ? ' is-encerrada' : '' ?>">
              <div class="vaga-cabecalho">
                <!-- empresas.logo é opcional: sem logo, mostra a inicial -->
                <span class="empresa-logo" aria-hidden="true"><?= $e(strtoupper($vaga['empresa'][0])) ?></span>
                <p class="empresa-nome"><?= $e($vaga['empresa']) ?></p>
                <?php if ($encerrada): ?><span class="tag tag-encerrada">Encerrada</span><?php endif; ?>
              </div>

              <div>
                <h3 class="vaga-titulo"><?= $e($vaga['titulo']) ?></h3>
                <p class="vaga-local"><i class="bi bi-geo-alt" aria-hidden="true"></i> <?= $e($vaga['localizacao']) ?></p>
              </div>

              <div class="vaga-etiquetas">
                <span class="tag"><?= $modalidades[$vaga['modalidade']] ?></span>
                <span class="tag tag-neutra"><?= $contratos[$vaga['contrato']] ?></span>
              </div>

              <?php if ($salario !== null): ?>
              <p class="vaga-salario"><?= $salario ?></p>
              <?php else: ?>
              <p class="vaga-salario is-vazio">Salário não informado</p>
              <?php endif; ?>

              <div class="vaga-rodape">
                <time class="vaga-data" datetime="<?= $vaga['criado_em'] ?>">Publicada em <?= date('d/m/Y', strtotime($vaga['criado_em'])) ?></time>
                <?php if ($encerrada): ?>
                <button class="btn btn-secondary btn-sm" type="button" disabled>Ver oportunidade</button>
                <?php else: ?>
                <a class="btn btn-secondary btn-sm" href="vaga.php?id=<?= (int) $vaga['id'] ?>">Ver oportunidade <i class="bi bi-arrow-right" aria-hidden="true"></i></a>
                <?php endif; ?>
              </div>
            </article>
          </li>
          <?php endforeach; ?>
        </ul>

        <!-- Estados preparados para uso futuro (ocultos por padrão) -->
        <div id="estadoSemResultados" class="estado-vazio" hidden>
          <span class="icone-caixa"><i class="bi bi-search" aria-hidden="true"></i></span>
          <h3 class="titulo-md">Nenhuma vaga encontrada</h3>
          <p class="texto-2">Tente ajustar os filtros ou pesquisar por outro termo.</p>
        </div>
        <div id="estadoSemVagas" class="estado-vazio" hidden>
          <span class="icone-caixa"><i class="bi bi-briefcase" aria-hidden="true"></i></span>
          <h3 class="titulo-md">Nenhuma oportunidade disponível no momento.</h3>
        </div>
      </section>

    </main>
  </div>

</body>
</html>
