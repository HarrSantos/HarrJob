<?php

include __DIR__ . '/../../config/conexao.php';

header('Content-Type: application/json; charset=utf-8');

// Função para enviar resposta de erro em formato JSON //
function respostaErro($mensagem)
{
    echo json_encode([
        'sucesso' => false,
        'mensagem' => $mensagem
    ]);

    exit;
}

// Verifica se o método de requisição é POST //

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    respostaErro('Método não permitido.');
}

$tipoCadastro = $_POST['tipo_cadastro'];
$email = trim($_POST['email']);
$senha = $_POST['senha'];
$confirmarSenha = $_POST['confirmar_senha'];

// Valida o tipo de cadastro //

if ($tipoCadastro !== 'candidato' && $tipoCadastro !== 'empresa') {
    respostaErro('Tipo de cadastro inválido.');
}

// Valida o email //

if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
    respostaErro('Email inválido.');
}

if (strlen($email) > 255) {
    respostaErro('O e-mail não pode ter mais de 255 caracteres.');
}

try {
$sql = 'SELECT id FROM usuarios WHERE email = ? LIMIT 1';

$stmt = $pdo->prepare($sql);
$stmt->execute([$email]);

if ($stmt->fetch()) {
    respostaErro('Email já cadastrado.');
}

} catch (Exception $e) {
    respostaErro('Falha em consultar email');
}

// Valida a senha //

if (strlen($senha) < 8) {
    respostaErro('A senha deve ter pelo menos 8 caracteres.');
}

if ($senha !== $confirmarSenha) {
    respostaErro('As senhas não coincidem.');
}

$senhaHash = password_hash($senha, PASSWORD_DEFAULT);

$caminhoLogo = null;
$caminhoLogoBanco = null;

if ($tipoCadastro === 'candidato') {

    $nome = trim($_POST['nome']);

    // valida o nome //

    if ($nome === '') {
        respostaErro('O nome é obrigatório.');
    }

    if (mb_strlen($nome, 'UTF-8') < 3 || mb_strlen($nome, 'UTF-8') > 50) {
        respostaErro('O nome não pode ter menos de 3 ou mais de 50 caracteres.');
    }

} elseif ($tipoCadastro === 'empresa') {

    $cnpj = trim($_POST['cnpj']);
    $nomeEmpresa = trim($_POST['nome_empresa']);
    $descricao = trim($_POST['descricao']);
    $site = trim($_POST['site']);
    $localizacao = trim($_POST['localizacao']);
    $logo = $_FILES['logo'];

    // valida cnpj //

    if ($cnpj === '') {
        respostaErro('O CNPJ é obrigatório.');
    }

    if (strlen($cnpj) !== 14 || !ctype_digit($cnpj)) {
        respostaErro('CNPJ inválido. Deve conter exatamente 14 dígitos numéricos.');
    }

    try {
        $sql = 'SELECT id FROM empresas WHERE cnpj = ? LIMIT 1';

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$cnpj]);

        if ($stmt->fetch()) {
            respostaErro('CNPJ já cadastrado.');
        }
    } catch (Exception $e) {
        respostaErro('Falha em consultar CNPJ');
    }

    // valida nome da empresa //

    if ($nomeEmpresa === '') {
        respostaErro('O nome da empresa é obrigatório.');
    }

    if (mb_strlen($nomeEmpresa, 'UTF-8') < 3 || mb_strlen($nomeEmpresa, 'UTF-8') > 50) {
        respostaErro('O nome da empresa não pode ter menos de 3 ou mais de 50 caracteres.');
    }

    // valida descricao //

    if (mb_strlen($descricao, 'UTF-8') > 500) {
        respostaErro('A descrição não pode ter mais de 500 caracteres.');
    }

    // valida site //

    if (mb_strlen($site, 'UTF-8') > 255) {
        respostaErro('O site não pode ter mais de 255 caracteres.');
    }

    if ($site !== '' && !filter_var($site, FILTER_VALIDATE_URL)) {
        respostaErro('URL do site inválida.');
    }

    // valida localizacao //

    if (mb_strlen($localizacao, 'UTF-8') > 50) {
        respostaErro('A localização não pode ter mais de 50 caracteres.');
    }

    // valida logo //

    if ($logo['error'] !== UPLOAD_ERR_NO_FILE) {

        if ($logo['error'] !== UPLOAD_ERR_OK) {
            respostaErro('Erro ao enviar o logo.');
        }

        if ($logo['size'] > 2 * 1024 * 1024) {
            respostaErro('O logo não pode ter mais de 2MB.');
        }

        $tipoLogoPermitido = [
            'image/jpeg',
            'image/png',
            'image/webp'
        ];

        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $tipoLogo = $finfo->file($logo['tmp_name']);

        if (!in_array($tipoLogo, $tipoLogoPermitido, true)) {
            respostaErro('O logo deve ser um arquivo JPEG, PNG ou WEBP.');
        }

        switch ($tipoLogo) {
            case 'image/jpeg':
                $extensao = 'jpg';
                break;
            case 'image/png':
                $extensao = 'png';
                break;
            case 'image/webp':
                $extensao = 'webp';
                break;
            default:
                respostaErro('Tipo de arquivo de logo não suportado.');
        }

        $nomeArquivoLogo = bin2hex(random_bytes(16)) . '.' . $extensao;

        $caminhoLogo = __DIR__ . '/../../uploads/empresas/' . $nomeArquivoLogo;

        if (!move_uploaded_file($logo['tmp_name'], $caminhoLogo)) {
            respostaErro('Erro ao salvar o logo.');
        }

        $caminhoLogoBanco = 'uploads/empresas/' . $nomeArquivoLogo;

    }

}

try {

    $pdo->beginTransaction();

    $sql = 'INSERT INTO usuarios (email, senha) VALUES (?, ?)';

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email, $senhaHash]);

    $usuarioId = $pdo->lastInsertId();

    if ($tipoCadastro === 'candidato') {

        $sql = 'INSERT INTO perfis (usuario_id, nome) VALUES (?, ?)';

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$usuarioId, $nome]);

    } elseif ($tipoCadastro === 'empresa') {

        $sql = 'INSERT INTO empresas (nome, logo, cnpj, descricao, site, localizacao) VALUES (?, ?, ?, ?, ?, ?)';

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nomeEmpresa, $caminhoLogoBanco, $cnpj, $descricao, $site, $localizacao]);

        $empresaId = $pdo->lastInsertId();

        $sql = 'INSERT INTO empresa_usuarios (empresa_id, usuario_id, funcao) VALUES (?, ?, ?)';

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$empresaId, $usuarioId, 'administrador']);
    }

    $pdo->commit();

    echo json_encode([
        'sucesso' => true,
        'mensagem' => 'Conta criada com sucesso.',
        'tipo_cadastro' => $tipoCadastro
    ]);

} catch (Exception $e) {

    if ($pdo->inTransaction()) {
        $pdo->rollBack();
    }

    if ($caminhoLogo !== null && file_exists($caminhoLogo)) {
        unlink($caminhoLogo);
    }

    error_log($e->getMessage(), 3, __DIR__ . '/../../config/erros.log');

    respostaErro('Erro ao cadastrar usuário.');
}