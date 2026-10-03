<?php
/*
 * HarrJob — Sidebar da área empresarial (componente reutilizável).
 *
 * Antes do include, a página define:
 *   $base          → caminho relativo até a raiz do projeto (ex.: '../../')
 *   $paginaAtiva   → 'painel' | 'vagas' | 'candidaturas' | 'equipe' | 'perfil'
 *   $funcaoUsuario → 'administrador' | 'recrutador'   (empresa_usuarios.funcao)
 *   $empresa       → ['nome' => ..., 'logo' => ...]    (empresas.nome / empresas.logo)
 *
 * Uso (a partir de pages/empresa/arquivo.php):
 *   <?php $base = '../../'; $paginaAtiva = 'painel'; include __DIR__ . '/../../includes/sidebar-empresa.php'; ?>
 *
 * A diferença entre funções é só de apresentação (Equipe aparece para administrador).
 * Isso NÃO é segurança: o backend futuro deve validar empresa_usuarios.funcao.
 */
$base          = isset($base) ? $base : '../../';
$paginaAtiva   = isset($paginaAtiva) ? $paginaAtiva : '';
$funcaoUsuario = isset($funcaoUsuario) ? $funcaoUsuario : 'administrador';
if (!isset($empresa)) { $empresa = ['nome' => 'Nova Tech', 'logo' => null]; }   // mock visual

$ehAdministrador = ($funcaoUsuario === 'administrador');
$rotuloFuncao    = $ehAdministrador ? 'Administrador' : 'Recrutador';

$ativoPainel       = ($paginaAtiva === 'painel')       ? ' is-active" aria-current="page' : '';
$ativoVagas        = ($paginaAtiva === 'vagas')        ? ' is-active" aria-current="page' : '';
$ativoCandidaturas = ($paginaAtiva === 'candidaturas') ? ' is-active" aria-current="page' : '';
$ativoEquipe       = ($paginaAtiva === 'equipe')       ? ' is-active" aria-current="page' : '';
$ativoPerfil       = ($paginaAtiva === 'perfil')       ? ' is-active" aria-current="page' : '';
?>
<aside id="sidebarEmpresa" class="sidebar">
  <a class="sidebar-brand" href="<?= $base ?>pages/empresa/painel.php" aria-label="HarrJob — visão geral da empresa">
    <img class="brand-logo" src="<?= $base ?>assets/icons/logo.svg" alt="HarrJob">
  </a>

  <div id="perfilResumoEmpresa" class="perfil-resumo">
    <span class="avatar avatar-empresa">
      <?php if (!empty($empresa['logo'])): ?>
      <img src="<?= htmlspecialchars($base . $empresa['logo'], ENT_QUOTES, 'UTF-8') ?>" alt="Logo da <?= htmlspecialchars($empresa['nome'], ENT_QUOTES, 'UTF-8') ?>">
      <?php else: ?>
      <span aria-hidden="true"><?= htmlspecialchars(strtoupper(substr($empresa['nome'], 0, 1)), ENT_QUOTES, 'UTF-8') ?></span>
      <?php endif; ?>
    </span>
    <div class="perfil-info">
      <p class="perfil-nome"><?= htmlspecialchars($empresa['nome'], ENT_QUOTES, 'UTF-8') ?></p>
      <p class="perfil-titulo"><?= $rotuloFuncao ?></p>
    </div>
  </div>

  <nav id="navEmpresa" class="nav-usuario" aria-label="Área da empresa">
    <ul class="nav-lista">
      <li><a id="navPainel" class="nav-item<?= $ativoPainel ?>" href="<?= $base ?>pages/empresa/painel.php"><i class="bi bi-grid" aria-hidden="true"></i> Visão geral</a></li>
      <li><a id="navVagasEmpresa" class="nav-item<?= $ativoVagas ?>" href="<?= $base ?>pages/empresa/vagas.php"><i class="bi bi-briefcase" aria-hidden="true"></i> Vagas</a></li>
      <li><a id="navCandidaturasEmpresa" class="nav-item<?= $ativoCandidaturas ?>" href="<?= $base ?>pages/empresa/candidaturas.php"><i class="bi bi-inbox" aria-hidden="true"></i> Candidaturas</a></li>
      <?php if ($ehAdministrador): ?>
      <li><a id="navEquipe" class="nav-item<?= $ativoEquipe ?>" href="<?= $base ?>pages/empresa/equipe.php"><i class="bi bi-people" aria-hidden="true"></i> Equipe</a></li>
      <?php endif; ?>
    </ul>
    <ul class="nav-lista nav-lista-secundaria">
      <li><a id="navPerfilEmpresa" class="nav-item<?= $ativoPerfil ?>" href="<?= $base ?>pages/empresa/perfil.php"><i class="bi bi-building" aria-hidden="true"></i> Perfil da empresa</a></li>
      <li><a id="navVoltarUsuario" class="nav-item" href="<?= $base ?>pages/usuario/perfil.php"><i class="bi bi-person" aria-hidden="true"></i> Voltar ao meu perfil</a></li>
      <li><a id="navSairEmpresa" class="nav-item" href="#"><i class="bi bi-box-arrow-right" aria-hidden="true"></i> Sair</a></li>
    </ul>
  </nav>
</aside>
