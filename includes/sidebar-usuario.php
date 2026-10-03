<?php
/*
 * HarrJob — Sidebar da área do usuário (componente reutilizável).
 *
 * Antes do include, a página define:
 *   $base        → caminho relativo até a raiz do projeto (ex.: '../../')
 *   $paginaAtiva → 'vagas' | 'candidaturas' | 'perfil'
 *
 * Uso (a partir de pages/<pasta>/arquivo.php):
 *   <?php $base = '../../'; $paginaAtiva = 'vagas'; include __DIR__ . '/../../includes/sidebar-usuario.php'; ?>
 */
$base        = $base ?? '../../';
$paginaAtiva = $paginaAtiva ?? '';

// Mock visual — futuramente: perfis.nome, perfis.titulo_profissional, perfis.foto
$usuarioNome     = 'Mariana Souza';
$usuarioTitulo   = 'Desenvolvedora Front-end';
$usuarioIniciais = 'MS';

$ativo = fn(string $pagina): string => $paginaAtiva === $pagina ? ' is-active" aria-current="page' : '';
?>
<aside id="sidebarUsuario" class="sidebar">
  <a class="sidebar-brand" href="<?= $base ?>pages/vagas/index.php" aria-label="HarrJob — vagas">
    <img class="brand-logo" src="<?= $base ?>assets/icons/logo.svg" alt="HarrJob">
  </a>

  <div id="perfilResumoUsuario" class="perfil-resumo">
    <span class="avatar" aria-hidden="true"><?= htmlspecialchars($usuarioIniciais) ?></span>
    <div class="perfil-info">
      <p class="perfil-nome"><?= htmlspecialchars($usuarioNome) ?></p>
      <p class="perfil-titulo"><?= htmlspecialchars($usuarioTitulo) ?></p>
    </div>
  </div>

  <nav id="navUsuario" class="nav-usuario" aria-label="Área do usuário">
    <ul class="nav-lista">
      <li><a id="navVagas" class="nav-item<?= $ativo('vagas') ?>" href="<?= $base ?>pages/vagas/index.php"><i class="bi bi-briefcase" aria-hidden="true"></i> Vagas</a></li>
      <li><a id="navCandidaturas" class="nav-item<?= $ativo('candidaturas') ?>" href="<?= $base ?>pages/usuario/candidaturas.php"><i class="bi bi-file-earmark-text" aria-hidden="true"></i> Minhas candidaturas</a></li>
      <li><a id="navPerfil" class="nav-item<?= $ativo('perfil') ?>" href="<?= $base ?>pages/usuario/perfil.php"><i class="bi bi-person" aria-hidden="true"></i> Meu perfil</a></li>
    </ul>
    <ul class="nav-lista nav-lista-secundaria">
      <li><a id="navConfiguracoes" class="nav-item" href="#"><i class="bi bi-gear" aria-hidden="true"></i> Configurações</a></li>
      <li><a id="navSair" class="nav-item" href="#"><i class="bi bi-box-arrow-right" aria-hidden="true"></i> Sair</a></li>
    </ul>
  </nav>
</aside>
