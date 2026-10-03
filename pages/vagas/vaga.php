<?php
/* HarrJob — Detalhes da vaga (somente front-end; dados MOCK, sem banco) */

$base        = '../../';
$paginaAtiva = 'vagas';

function esc($texto) { return htmlspecialchars((string) $texto, ENT_QUOTES, 'UTF-8'); }

function formatar_reais($valor) { return 'R$ ' . number_format($valor, 0, ',', '.'); }

function formatar_salario($min, $max) {
  if ($min !== null && $max !== null) { return formatar_reais($min) . ' – ' . formatar_reais($max); }
  if ($min !== null) { return 'A partir de ' . formatar_reais($min); }
  if ($max !== null) { return 'Até ' . formatar_reais($max); }
  return null;
}

$modalidades = ['remoto' => 'Remoto', 'hibrido' => 'Híbrido', 'presencial' => 'Presencial'];
$contratos   = ['clt' => 'CLT', 'estagio' => 'Estágio', 'pj' => 'PJ', 'temporario' => 'Temporário'];

/* MOCK — futuramente: vagas JOIN empresas (vagas.empresa_id → empresas.id) */
$vaga = [
  'id'          => 1,
  'titulo'      => 'Desenvolvedor Backend PHP',
  'descricao'   => "A Nova Tech está em busca de uma pessoa desenvolvedora backend para atuar no desenvolvimento e na evolução de sistemas web utilizados por seus clientes.\n\n"
                 . "Você vai trabalhar com PHP e MySQL na criação de rotinas, integrações e APIs, escrevendo código limpo e fácil de manter e colaborando com o time de desenvolvimento no dia a dia.\n\n"
                 . "Buscamos alguém que goste de resolver problemas, aprender novas tecnologias e trabalhar em equipe.",
  'requisitos'  => "Conhecimento sólido em PHP e programação orientada a objetos\n"
                 . "Experiência com bancos de dados relacionais, especialmente MySQL\n"
                 . "Noções de HTML, CSS e JavaScript\n"
                 . "Familiaridade com Git e versionamento de código\n"
                 . "Boa comunicação e capacidade de trabalhar em equipe",
  'localizacao' => 'Santos, SP',
  'modalidade'  => 'remoto',
  'contrato'    => 'clt',
  'salario_min' => 3000,
  'salario_max' => 4500,
  'criado_em'   => '2026-09-30 09:00:00',
  'status'      => 'aberta',   // aberta | encerrada
];
$empresa = [
  'nome'        => 'Nova Tech',
  'logo'        => null,       // sem logo: mostra a inicial
  'descricao'   => 'A Nova Tech desenvolve soluções de software para empresas de diferentes setores, com foco em sistemas web simples, confiáveis e fáceis de usar.',
  'site'        => 'https://www.novatech.example',
  'localizacao' => 'Santos, SP',
];

$salario   = formatar_salario($vaga['salario_min'], $vaga['salario_max']);
$encerrada = ($vaga['status'] === 'encerrada');
$inicial   = strtoupper(substr($empresa['nome'], 0, 1));
$dataIso   = date('Y-m-d', strtotime($vaga['criado_em']));
$dataBr    = date('d/m/Y', strtotime($vaga['criado_em']));
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= esc($vaga['titulo']) ?> — HarrJob</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="../../css/style.css">
  <link rel="stylesheet" href="../../css/vaga.css">
</head>
<body>

  <?php include __DIR__ . '/../../includes/sidebar-usuario.php'; ?>

  <div class="app-main">
    <main id="paginaVaga" class="app-content">

      <a id="btnVoltarVagas" class="voltar" href="index.php"><i class="bi bi-arrow-left" aria-hidden="true"></i> Voltar para vagas</a>

      <div class="vaga-layout">

        <article id="detalhesVaga" class="vaga-principal">

          <header class="card vaga-hero">
            <div class="vaga-topo">
              <div id="logoVaga" class="empresa-logo">
                <?php if (!empty($empresa['logo'])): ?>
                <img src="<?= esc($base . $empresa['logo']) ?>" alt="Logo da <?= esc($empresa['nome']) ?>">
                <?php else: ?>
                <span aria-hidden="true"><?= esc($inicial) ?></span>
                <?php endif; ?>
              </div>
              <p id="empresaVaga" class="vaga-empresa-nome"><?= esc($empresa['nome']) ?></p>
            </div>

            <h1 id="tituloVaga" class="vaga-titulo"><?= esc($vaga['titulo']) ?></h1>
            <?php if ($encerrada): ?>
            <p class="vaga-aviso"><i class="bi bi-lock" aria-hidden="true"></i> Esta vaga está encerrada</p>
            <?php endif; ?>

            <ul class="info-grid">
              <li class="info-item">
                <span class="info-icone"><i class="bi bi-geo-alt" aria-hidden="true"></i></span>
                <span class="info-texto">
                  <span class="info-rotulo">Localização</span>
                  <?php if (!empty($vaga['localizacao'])): ?>
                  <strong id="localizacaoVaga" class="info-valor"><?= esc($vaga['localizacao']) ?></strong>
                  <?php else: ?>
                  <strong id="localizacaoVaga" class="info-valor is-vazio">Não informada</strong>
                  <?php endif; ?>
                </span>
              </li>
              <li class="info-item">
                <span class="info-icone"><i class="bi bi-laptop" aria-hidden="true"></i></span>
                <span class="info-texto">
                  <span class="info-rotulo">Modalidade</span>
                  <strong id="modalidadeVaga" class="info-valor"><?= esc($modalidades[$vaga['modalidade']]) ?></strong>
                </span>
              </li>
              <li class="info-item">
                <span class="info-icone"><i class="bi bi-file-earmark-text" aria-hidden="true"></i></span>
                <span class="info-texto">
                  <span class="info-rotulo">Contrato</span>
                  <strong id="contratoVaga" class="info-valor"><?= esc($contratos[$vaga['contrato']]) ?></strong>
                </span>
              </li>
              <li class="info-item">
                <span class="info-icone"><i class="bi bi-cash-stack" aria-hidden="true"></i></span>
                <span class="info-texto">
                  <span class="info-rotulo">Salário</span>
                  <?php if ($salario !== null): ?>
                  <strong id="salarioVaga" class="info-valor"><?= esc($salario) ?></strong>
                  <?php else: ?>
                  <strong id="salarioVaga" class="info-valor is-vazio">Salário não informado</strong>
                  <?php endif; ?>
                </span>
              </li>
              <li class="info-item">
                <span class="info-icone"><i class="bi bi-calendar3" aria-hidden="true"></i></span>
                <span class="info-texto">
                  <span class="info-rotulo">Publicada em</span>
                  <time id="dataPublicacao" class="info-valor" datetime="<?= $dataIso ?>"><?= $dataBr ?></time>
                </span>
              </li>
              <li class="info-item">
                <span class="info-icone"><i class="bi bi-circle" aria-hidden="true"></i></span>
                <span class="info-texto">
                  <span class="info-rotulo">Status</span>
                  <?php if ($encerrada): ?>
                  <span id="statusVaga" class="tag tag-encerrada">Encerrada</span>
                  <?php else: ?>
                  <span id="statusVaga" class="tag"><i class="bi bi-circle-fill vaga-ponto" aria-hidden="true"></i> Aberta</span>
                  <?php endif; ?>
                </span>
              </li>
            </ul>
          </header>

          <section id="descricaoVaga" class="card vaga-secao vaga-desc">
            <h2>Sobre a vaga</h2>
            <div class="vaga-texto">
              <?php foreach (explode("\n\n", $vaga['descricao']) as $paragrafo): ?>
              <p><?= esc($paragrafo) ?></p>
              <?php endforeach; ?>
            </div>
          </section>

          <section id="requisitosVaga" class="card vaga-secao vaga-req">
            <h2>Requisitos</h2>
            <?php if (!empty($vaga['requisitos'])): ?>
            <ul class="req-lista">
              <?php foreach (explode("\n", $vaga['requisitos']) as $requisito): ?>
              <li><i class="bi bi-check2" aria-hidden="true"></i> <span><?= esc($requisito) ?></span></li>
              <?php endforeach; ?>
            </ul>
            <?php else: ?>
            <p class="texto-2">Requisitos não informados.</p>
            <?php endif; ?>
          </section>

        </article>

        <aside class="vaga-lateral">

          <section id="empresaDetalhes" class="card vaga-empresa">
            <h2>Sobre a empresa</h2>
            <div class="empresa-cab">
              <div class="empresa-logo empresa-logo-sm">
                <?php if (!empty($empresa['logo'])): ?>
                <img src="<?= esc($base . $empresa['logo']) ?>" alt="Logo da <?= esc($empresa['nome']) ?>">
                <?php else: ?>
                <span aria-hidden="true"><?= esc($inicial) ?></span>
                <?php endif; ?>
              </div>
              <p class="empresa-nome"><?= esc($empresa['nome']) ?></p>
            </div>
            <?php if (!empty($empresa['descricao'])): ?>
            <p id="descricaoEmpresa" class="texto-2"><?= esc($empresa['descricao']) ?></p>
            <?php endif; ?>
            <?php if (!empty($empresa['localizacao'])): ?>
            <p id="localizacaoEmpresa" class="empresa-linha"><i class="bi bi-geo-alt" aria-hidden="true"></i> <?= esc($empresa['localizacao']) ?></p>
            <?php endif; ?>
            <?php if (!empty($empresa['site'])): ?>
            <a id="siteEmpresa" class="empresa-site" href="<?= esc($empresa['site']) ?>" target="_blank" rel="noopener noreferrer">Ver site da empresa <i class="bi bi-box-arrow-up-right" aria-hidden="true"></i></a>
            <?php endif; ?>
          </section>

          <section class="card vaga-cand">
            <h2>Candidate-se a esta oportunidade</h2>
            <?php if ($encerrada): ?>
            <p class="cand-texto">Esta vaga foi encerrada e não recebe novas candidaturas.</p>
            <?php else: ?>
            <p class="cand-texto">Sua candidatura usa as informações do seu perfil profissional.</p>
            <?php endif; ?>

            <form id="candidaturaForm" method="post">
              <input type="hidden" name="vaga_id" value="<?= (int) $vaga['id'] ?>">
              <?php if ($encerrada): ?>
              <button id="btnCandidatar" class="btn btn-primary btn-lg cand-botao" type="button" disabled>Candidatar-se</button>
              <p class="cand-aviso"><i class="bi bi-slash-circle" aria-hidden="true"></i> Candidatura indisponível</p>
              <?php else: ?>
              <button id="btnCandidatar" class="btn btn-primary btn-lg cand-botao" type="submit">Candidatar-se</button>
              <?php endif; ?>
            </form>
          </section>

        </aside>

      </div>
    </main>
  </div>

</body>
</html>
