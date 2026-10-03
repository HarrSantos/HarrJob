<?php
/* HarrJob — Vagas da empresa (somente front-end; dados MOCK, sem banco) */

$base          = '../../';
$paginaAtiva   = 'vagas';
$funcaoUsuario = 'administrador';   // mock de empresa_usuarios.funcao; ambas as funções usam esta mesma página

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

/* MOCK — futuramente: SELECT em vagas WHERE empresa_id = (empresa do usuário via empresa_usuarios) */
$empresa = ['nome' => 'Nova Tech', 'logo' => null];
$vagas = [
  ['id' => 1, 'titulo' => 'Desenvolvedor Backend PHP',  'localizacao' => 'Santos, SP',       'modalidade' => 'remoto',     'contrato' => 'clt',        'salario_min' => 3000, 'salario_max' => 4500, 'criado_em' => '2026-09-30', 'status' => 'aberta'],
  ['id' => 2, 'titulo' => 'Analista de Suporte Técnico', 'localizacao' => 'São Paulo, SP',    'modalidade' => 'hibrido',    'contrato' => 'clt',        'salario_min' => null, 'salario_max' => null, 'criado_em' => '2026-09-28', 'status' => 'aberta'],
  ['id' => 5, 'titulo' => 'Assistente Administrativo',   'localizacao' => 'Praia Grande, SP', 'modalidade' => 'presencial', 'contrato' => 'temporario', 'salario_min' => 2200, 'salario_max' => 2600, 'criado_em' => '2026-09-12', 'status' => 'encerrada'],
];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Vagas — <?= esc($empresa['nome']) ?> — HarrJob</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="../../css/style.css">
  <link rel="stylesheet" href="../../css/empresa.css">
  <link rel="stylesheet" href="../../css/empresa-vagas.css">
</head>
<body>

  <?php include __DIR__ . '/../../includes/sidebar-empresa.php'; ?>

  <div class="app-main">
    <main id="paginaVagasEmpresa" class="app-content">

      <header class="vagas-topo">
        <h1 id="tituloVagasEmpresa" class="titulo-lg">Vagas da empresa</h1>
        <p class="texto-lead">Publique novas oportunidades e acompanhe as vagas da <?= esc($empresa['nome']) ?> em um só lugar.</p>
      </header>

      <div class="vagas-gestao">

        <section id="novaVaga" class="sec-nova-vaga">
          <div class="painel-secao-cab"><h2>Nova vaga</h2></div>
          <div class="card vaga-form-card">
            <p class="vaga-form-nota">Campos sem “(opcional)” são obrigatórios.</p>

            <form id="vagaForm" class="vaga-form" method="post">
              <div class="campo">
                <label class="campo-label" for="tituloVaga">Título</label>
                <input class="input" id="tituloVaga" name="titulo" type="text" maxlength="100" placeholder="Ex.: Desenvolvedor Backend PHP" required>
              </div>

              <div class="campo">
                <label class="campo-label" for="descricaoVaga">Descrição</label>
                <textarea class="input campo-area" id="descricaoVaga" name="descricao" rows="6" aria-describedby="ajudaDescricao" required></textarea>
                <p id="ajudaDescricao" class="campo-ajuda">Descreva a oportunidade, as principais responsabilidades e o contexto da vaga.</p>
              </div>

              <div class="campo">
                <label class="campo-label" for="requisitosVaga">Requisitos <span class="campo-opcional">(opcional)</span></label>
                <textarea class="input campo-area" id="requisitosVaga" name="requisitos" rows="4"></textarea>
              </div>

              <div class="campo">
                <label class="campo-label" for="localizacaoVaga">Localização <span class="campo-opcional">(opcional)</span></label>
                <input class="input" id="localizacaoVaga" name="localizacao" type="text" maxlength="100">
              </div>

              <div class="vagas-grade-2">
                <div class="campo">
                  <label class="campo-label" for="modalidadeVaga">Modalidade</label>
                  <select class="input" id="modalidadeVaga" name="modalidade" required>
                    <option value="" selected disabled>Selecione</option>
                    <?php foreach ($modalidades as $valor => $rotulo): ?>
                    <option value="<?= $valor ?>"><?= $rotulo ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="campo">
                  <label class="campo-label" for="contratoVaga">Contrato</label>
                  <select class="input" id="contratoVaga" name="contrato" required>
                    <option value="" selected disabled>Selecione</option>
                    <?php foreach ($contratos as $valor => $rotulo): ?>
                    <option value="<?= $valor ?>"><?= $rotulo ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>

              <fieldset>
                <legend>Faixa salarial <span class="campo-opcional">(opcional)</span></legend>
                <div class="vagas-grade-2">
                  <div class="campo">
                    <label class="campo-label" for="salarioMin">Salário mínimo</label>
                    <div class="input-moeda"><span aria-hidden="true">R$</span><input class="input" id="salarioMin" name="salario_min" type="number" min="0" max="99999999.99" step="0.01" inputmode="decimal" aria-describedby="ajudaSalario"></div>
                  </div>
                  <div class="campo">
                    <label class="campo-label" for="salarioMax">Salário máximo</label>
                    <div class="input-moeda"><span aria-hidden="true">R$</span><input class="input" id="salarioMax" name="salario_max" type="number" min="0" max="99999999.99" step="0.01" inputmode="decimal" aria-describedby="ajudaSalario"></div>
                  </div>
                </div>
                <p id="ajudaSalario" class="campo-ajuda">Informe a faixa salarial, caso deseje exibi-la na oportunidade. O valor máximo deve ser igual ou maior que o mínimo.</p>
              </fieldset>

              <p class="vaga-status-info"><span class="tag"><i class="bi bi-circle-fill vaga-ponto" aria-hidden="true"></i> Aberta</span> Toda nova vaga é publicada como aberta.</p>

              <button id="btnCriarVaga" class="btn btn-primary btn-lg" type="submit">Publicar vaga</button>
            </form>
          </div>
        </section>

        <section id="suasVagas" class="sec-suas-vagas">
          <div class="painel-secao-cab"><h2>Suas vagas</h2></div>

          <form id="formFiltroVagasEmpresa" class="vagas-filtros" method="get" role="search">
            <div class="campo filtro-busca">
              <label class="campo-label" for="pesquisaVagasEmpresa">Buscar entre suas vagas</label>
              <div class="busca-campo">
                <i class="bi bi-search" aria-hidden="true"></i>
                <input class="input" id="pesquisaVagasEmpresa" name="pesquisa" type="search" autocomplete="off">
              </div>
            </div>
            <div class="campo filtro-status">
              <label class="campo-label" for="filtroStatusVaga">Status</label>
              <select class="input" id="filtroStatusVaga" name="status">
                <option value="">Todas</option>
                <option value="aberta">Abertas</option>
                <option value="encerrada">Encerradas</option>
              </select>
            </div>
            <button id="btnFiltrarVagasEmpresa" class="btn btn-secondary" type="submit">Filtrar</button>
          </form>

          <ul id="listaVagasEmpresa" class="vagas-empresa-lista">
            <?php foreach ($vagas as $vaga): $salario = formatar_salario($vaga['salario_min'], $vaga['salario_max']); $aberta = ($vaga['status'] === 'aberta'); ?>
            <li>
              <article class="vaga-empresa-card<?= $aberta ? '' : ' is-encerrada' ?>">
                <div class="vaga-empresa-cabecalho">
                  <h3 class="vaga-empresa-titulo"><?= esc($vaga['titulo']) ?></h3>
                  <?php if ($aberta): ?>
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
                <?php else: ?>
                <p class="vaga-empresa-salario is-vazio">Salário não informado</p>
                <?php endif; ?>
                <p class="vaga-empresa-data">Publicada em <time datetime="<?= $vaga['criado_em'] ?>"><?= date('d/m/Y', strtotime($vaga['criado_em'])) ?></time></p>

                <div class="vaga-empresa-acoes">
                  <a class="btn btn-secondary btn-ver-vaga" href="../vagas/vaga.php?id=<?= (int) $vaga['id'] ?>" aria-label="Ver vaga: <?= esc($vaga['titulo']) ?>">Ver vaga</a>
                  <?php if ($aberta): ?>
                  <form class="form-encerrar-vaga" method="post">
                    <input type="hidden" name="vaga_id" value="<?= (int) $vaga['id'] ?>">
                    <button class="btn btn-encerrar-vaga" type="submit" aria-label="Encerrar vaga: <?= esc($vaga['titulo']) ?>">Encerrar vaga</button>
                  </form>
                  <?php endif; ?>
                </div>
              </article>
            </li>
            <?php endforeach; ?>
          </ul>

          <!-- Estados preparados para uso futuro (ocultos por padrão) -->
          <div id="estadoSemResultadosVagasEmpresa" class="estado-vazio" hidden>
            <span class="icone-caixa"><i class="bi bi-search" aria-hidden="true"></i></span>
            <h3 class="titulo-md">Nenhuma vaga encontrada</h3>
            <p class="texto-2">Tente alterar sua busca ou filtro.</p>
          </div>
          <div id="estadoSemVagasEmpresa" class="estado-vazio" hidden>
            <span class="icone-caixa"><i class="bi bi-briefcase" aria-hidden="true"></i></span>
            <h3 class="titulo-md">Sua empresa ainda não possui vagas.</h3>
            <a class="btn btn-primary" href="#novaVaga">Criar primeira vaga</a>
          </div>
        </section>

      </div>
    </main>
  </div>

</body>
</html>
