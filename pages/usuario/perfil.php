<?php
/* HarrJob — Perfil profissional (somente front-end; dados MOCK, sem banco) */

$base        = '../../';
$paginaAtiva = 'perfil';

function esc($texto) { return htmlspecialchars((string) $texto, ENT_QUOTES, 'UTF-8'); }

function iniciais($nome) {
  $partes = preg_split('/\s+/', trim($nome));
  $ini = strtoupper(substr($partes[0], 0, 1));
  if (count($partes) > 1) { $ini .= strtoupper(substr($partes[count($partes) - 1], 0, 1)); }
  return $ini;
}

// ano_fim NULL => período em aberto (nunca exibir "NULL")
function formatar_periodo($inicio, $fim, $textoAberto) {
  if ($fim === null || $fim === '') { return $inicio . ' — ' . $textoAberto; }
  return $inicio . ' — ' . $fim;
}

/* MOCK — futuramente: perfis, perfil_competencias + competencias, experiencias, formacoes */
$perfil = [
  'nome'                => 'Mariana Souza',
  'foto'                => null,   // sem foto: mostra as iniciais
  'titulo_profissional' => 'Desenvolvedora Front-end',
  'localizacao'         => 'Santos, SP',
  'sobre'               => 'Desenvolvedora front-end em formação técnica, apaixonada por criar interfaces limpas, acessíveis e fáceis de usar. Trabalho com HTML, CSS e JavaScript e venho ampliando meus conhecimentos em PHP e MySQL para construir aplicações web completas. Gosto de trabalhar em equipe e aprender com projetos reais.',
];
$competencias = [
  ['id' => 1, 'nome' => 'PHP'],
  ['id' => 2, 'nome' => 'MySQL'],
  ['id' => 3, 'nome' => 'Git'],
  ['id' => 4, 'nome' => 'Bootstrap'],
  ['id' => 5, 'nome' => 'JavaScript'],
  ['id' => 6, 'nome' => 'HTML e CSS'],
];
$experiencias = [
  ['id' => 1, 'cargo' => 'Desenvolvedora Front-end', 'empresa' => 'Nova Tech',     'descricao' => 'Desenvolvimento de interfaces web responsivas e acessíveis, em colaboração com o time de backend na integração das telas com as APIs.', 'ano_inicio' => 2024, 'ano_fim' => null],
  ['id' => 2, 'cargo' => 'Estagiária de TI',         'empresa' => 'Porto Sistemas', 'descricao' => 'Suporte técnico a usuários, manutenção de páginas internas e apoio na documentação de sistemas.',                                          'ano_inicio' => 2023, 'ano_fim' => 2024],
];
$formacoes = [
  ['id' => 1, 'instituicao' => 'Faculdade Litoral', 'curso' => 'Tecnologia em Análise e Desenvolvimento de Sistemas', 'ano_inicio' => 2026, 'ano_fim' => null],
  ['id' => 2, 'instituicao' => 'ETEC',              'curso' => 'Técnico em Informática para Internet',                'ano_inicio' => 2023, 'ano_fim' => 2025],
];

$nomesCompetencias = [];
foreach ($competencias as $competencia) { $nomesCompetencias[] = $competencia['nome']; }
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Meu perfil — HarrJob</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="../../css/style.css">
  <link rel="stylesheet" href="../../css/perfil.css">
</head>
<body>

  <?php include __DIR__ . '/../../includes/sidebar-usuario.php'; ?>

  <div class="app-main">
    <main id="paginaPerfil" class="app-content perfil-pagina">

      <header id="cabecalhoPerfil" class="card perfil-cab">
        <div class="perfil-banner" aria-hidden="true"></div>
        <div class="perfil-cab-corpo">
          <div id="fotoPerfil" class="perfil-foto">
            <?php if (!empty($perfil['foto'])): ?>
            <img src="<?= esc($base . $perfil['foto']) ?>" alt="Foto de <?= esc($perfil['nome']) ?>">
            <?php else: ?>
            <span aria-hidden="true"><?= esc(iniciais($perfil['nome'])) ?></span>
            <?php endif; ?>
          </div>
          <div class="perfil-cab-info">
            <h1 id="nomePerfil" class="perfil-cab-nome"><?= esc($perfil['nome']) ?></h1>
            <?php if (!empty($perfil['titulo_profissional'])): ?>
            <p id="tituloProfissional" class="perfil-cab-titulo"><?= esc($perfil['titulo_profissional']) ?></p>
            <?php endif; ?>
            <?php if (!empty($perfil['localizacao'])): ?>
            <p id="localizacaoPerfil" class="perfil-local"><i class="bi bi-geo-alt" aria-hidden="true"></i> <?= esc($perfil['localizacao']) ?></p>
            <?php endif; ?>
          </div>
          <a id="btnEditarPerfil" class="btn btn-secondary" href="#editarPerfil"><i class="bi bi-pencil" aria-hidden="true"></i> Editar perfil</a>
        </div>
      </header>

      <div class="perfil-layout">

        <div class="perfil-principal">

          <section id="sobrePerfil" class="card perfil-secao sec-sobre">
            <h2>Sobre mim</h2>
            <?php if (!empty($perfil['sobre'])): ?>
            <p id="sobre" class="perfil-texto"><?= esc($perfil['sobre']) ?></p>
            <?php else: ?>
            <p id="sobre" class="perfil-vazio">Nenhuma apresentação adicionada ainda.</p>
            <?php endif; ?>
          </section>

          <section id="experiencias" class="card perfil-secao sec-experiencias">
            <div class="perfil-secao-cab">
              <h2>Experiência profissional</h2>
              <button id="btnAdicionarExperiencia" class="acao-add" type="button"><i class="bi bi-plus-lg" aria-hidden="true"></i> Adicionar experiência</button>
            </div>
            <ol id="listaExperiencias" class="timeline">
              <?php foreach ($experiencias as $exp): ?>
              <li class="timeline-item<?= $exp['ano_fim'] === null ? ' is-atual' : '' ?>">
                <article class="experiencia-card">
                  <div class="item-topo">
                    <div>
                      <h3 class="experiencia-cargo"><?= esc($exp['cargo']) ?></h3>
                      <p class="experiencia-empresa"><?= esc($exp['empresa']) ?></p>
                    </div>
                    <div class="acoes">
                      <button class="acao" type="button" aria-label="Editar experiência: <?= esc($exp['cargo']) ?>">Editar</button>
                      <button class="acao" type="button" aria-label="Excluir experiência: <?= esc($exp['cargo']) ?>">Excluir</button>
                    </div>
                  </div>
                  <p class="experiencia-periodo"><i class="bi bi-calendar3" aria-hidden="true"></i> <?= esc(formatar_periodo($exp['ano_inicio'], $exp['ano_fim'], 'Atual')) ?></p>
                  <?php if (!empty($exp['descricao'])): ?>
                  <p class="experiencia-descricao"><?= esc($exp['descricao']) ?></p>
                  <?php endif; ?>
                </article>
              </li>
              <?php endforeach; ?>
              <?php if (count($experiencias) === 0): ?>
              <li class="perfil-vazio">Nenhuma experiência adicionada ainda.</li>
              <?php endif; ?>
            </ol>
          </section>

          <section id="formacoes" class="card perfil-secao sec-formacoes">
            <div class="perfil-secao-cab">
              <h2>Formação</h2>
              <button id="btnAdicionarFormacao" class="acao-add" type="button"><i class="bi bi-plus-lg" aria-hidden="true"></i> Adicionar formação</button>
            </div>
            <ol id="listaFormacoes" class="timeline">
              <?php foreach ($formacoes as $formacao): ?>
              <li class="timeline-item<?= $formacao['ano_fim'] === null ? ' is-atual' : '' ?>">
                <article class="formacao-card">
                  <div class="item-topo">
                    <div>
                      <h3 class="formacao-instituicao"><?= esc($formacao['instituicao']) ?></h3>
                      <p class="formacao-curso"><?= esc($formacao['curso']) ?></p>
                    </div>
                    <div class="acoes">
                      <button class="acao" type="button" aria-label="Editar formação: <?= esc($formacao['curso']) ?>">Editar</button>
                      <button class="acao" type="button" aria-label="Excluir formação: <?= esc($formacao['curso']) ?>">Excluir</button>
                    </div>
                  </div>
                  <p class="formacao-periodo"><i class="bi bi-calendar3" aria-hidden="true"></i> <?= esc(formatar_periodo($formacao['ano_inicio'], $formacao['ano_fim'], 'Em andamento')) ?></p>
                </article>
              </li>
              <?php endforeach; ?>
              <?php if (count($formacoes) === 0): ?>
              <li class="perfil-vazio">Nenhuma formação adicionada ainda.</li>
              <?php endif; ?>
            </ol>
          </section>

        </div>

        <aside class="perfil-lateral">

          <section id="competencias" class="card perfil-secao sec-competencias">
            <h2>Competências</h2>
            <ul id="listaCompetencias" class="competencias-lista">
              <?php foreach ($competencias as $competencia): ?>
              <li class="competencia-chip"><?= esc($competencia['nome']) ?>
                <button class="competencia-remover" type="button" aria-label="Remover competência: <?= esc($competencia['nome']) ?>"><i class="bi bi-x-lg" aria-hidden="true"></i></button>
              </li>
              <?php endforeach; ?>
              <?php if (count($competencias) === 0): ?>
              <li class="perfil-vazio">Nenhuma competência adicionada ainda.</li>
              <?php endif; ?>
            </ul>
            <button id="btnAdicionarCompetencia" class="acao-add" type="button"><i class="bi bi-plus-lg" aria-hidden="true"></i> Adicionar competência</button>
          </section>

          <section id="curriculo" class="card perfil-secao sec-curriculo">
            <h2>Currículo</h2>
            <p class="curriculo-texto">Montado a partir do seu perfil, experiências, formações e competências.</p>
            <div class="curriculo-previa">
              <div class="curriculo-folha" aria-hidden="true">
                <p class="cv-nome"><?= esc($perfil['nome']) ?></p>
                <p class="cv-titulo"><?= esc($perfil['titulo_profissional']) ?><?= !empty($perfil['localizacao']) ? ' · ' . esc($perfil['localizacao']) : '' ?></p>
                <p class="cv-secao">Experiência</p>
                <?php foreach ($experiencias as $exp): ?>
                <p class="cv-linha"><strong><?= esc($exp['cargo']) ?></strong> — <?= esc($exp['empresa']) ?> (<?= esc(formatar_periodo($exp['ano_inicio'], $exp['ano_fim'], 'Atual')) ?>)</p>
                <?php endforeach; ?>
                <p class="cv-secao">Formação</p>
                <?php foreach ($formacoes as $formacao): ?>
                <p class="cv-linha"><strong><?= esc($formacao['curso']) ?></strong> — <?= esc($formacao['instituicao']) ?> (<?= esc(formatar_periodo($formacao['ano_inicio'], $formacao['ano_fim'], 'Em andamento')) ?>)</p>
                <?php endforeach; ?>
                <p class="cv-secao">Competências</p>
                <p class="cv-linha"><?= esc(implode(' · ', $nomesCompetencias)) ?></p>
              </div>
            </div>
            <div class="curriculo-acoes">
              <a id="btnVisualizarCurriculo" class="btn btn-secondary" href="#"><i class="bi bi-eye" aria-hidden="true"></i> Visualizar currículo</a>
              <a id="btnBaixarCurriculo" class="btn btn-primary" href="#"><i class="bi bi-download" aria-hidden="true"></i> Baixar currículo</a>
            </div>
          </section>

        </aside>

      </div>

      <section id="editarPerfil" class="card perfil-secao">
        <h2>Editar perfil</h2>
        <p class="texto-2">Atualize as informações que aparecem no topo do seu perfil.</p>

        <form id="perfilForm" class="perfil-form" method="post" enctype="multipart/form-data">
          <div class="perfil-grade-2">
            <div class="campo">
              <label class="campo-label" for="editarNome">Nome completo</label>
              <input class="input" id="editarNome" name="nome" type="text" maxlength="50" autocomplete="name" value="<?= esc($perfil['nome']) ?>" required>
            </div>
            <div class="campo">
              <label class="campo-label" for="editarTitulo">Título profissional</label>
              <input class="input" id="editarTitulo" name="titulo_profissional" type="text" maxlength="50" value="<?= esc($perfil['titulo_profissional']) ?>">
            </div>
          </div>
          <div class="perfil-grade-2">
            <div class="campo">
              <label class="campo-label" for="localizacao">Localização</label>
              <input class="input" id="localizacao" name="localizacao" type="text" maxlength="50" value="<?= esc($perfil['localizacao']) ?>">
            </div>
            <div class="campo">
              <label class="campo-label" for="editarFoto">Foto</label>
              <input class="input campo-arquivo" id="editarFoto" name="foto" type="file" accept="image/*">
            </div>
          </div>
          <div class="campo">
            <label class="campo-label" for="editarSobre">Sobre mim</label>
            <textarea class="input campo-area" id="editarSobre" name="sobre" rows="5" maxlength="500"><?= esc($perfil['sobre']) ?></textarea>
            <p class="campo-ajuda">Até 500 caracteres.</p>
          </div>
          <div class="perfil-form-acoes">
            <button id="btnSalvarPerfil" class="btn btn-primary btn-lg" type="submit">Salvar alterações</button>
          </div>
        </form>
      </section>

    </main>
  </div>

</body>
</html>
