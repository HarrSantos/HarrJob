CREATE DATABASE IF NOT EXISTS Harrjob;

USE Harrjob;

CREATE TABLE usuarios (
    id INT PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(255) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    criado_em DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL
);

CREATE TABLE perfis (
    id INT PRIMARY KEY AUTO_INCREMENT,
    usuario_id INT NOT NULL UNIQUE,
    nome VARCHAR(50) NOT NULL,
    foto VARCHAR(255),
    titulo_profissional VARCHAR(50),
    localizacao VARCHAR(50),
    sobre VARCHAR(500),
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE
);

CREATE TABLE empresas (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(50) NOT NULL,
    logo VARCHAR(255) NULL,
    cnpj VARCHAR(14) UNIQUE NOT NULL,
    descricao VARCHAR(500) NULL,
    site VARCHAR(255) NULL,
    localizacao VARCHAR(50) NULL
);

CREATE TABLE empresa_usuarios (
    id INT PRIMARY KEY AUTO_INCREMENT,
    empresa_id INT NOT NULL,
    usuario_id INT NOT NULL UNIQUE,
    funcao ENUM('administrador', 'recrutador') NOT NULL,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id),
    FOREIGN KEY (empresa_id) REFERENCES empresas(id)
);

CREATE TABLE formacoes (
    id INT PRIMARY KEY AUTO_INCREMENT,
    perfil_id INT NOT NULL,
    instituicao VARCHAR(100) NOT NULL,
    curso VARCHAR(100) NOT NULL,
    ano_inicio YEAR NOT NULL,
    ano_fim YEAR NULL,
    FOREIGN KEY (perfil_id) REFERENCES perfis(id) ON DELETE CASCADE
);

CREATE TABLE experiencias (
    id INT PRIMARY KEY AUTO_INCREMENT,
    perfil_id INT NOT NULL,
    cargo VARCHAR(100) NOT NULL,
    empresa VARCHAR(100) NOT NULL,
    descricao VARCHAR(500) NULL,
    ano_inicio YEAR NOT NULL,
    ano_fim YEAR NULL,
    FOREIGN KEY (perfil_id) REFERENCES perfis(id) ON DELETE CASCADE
);

CREATE TABLE competencias (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(50) UNIQUE NOT NULL
);

CREATE TABLE perfil_competencias (
    perfil_id INT NOT NULL,
    competencia_id INT NOT NULL,
    PRIMARY KEY (perfil_id, competencia_id),
    FOREIGN KEY (perfil_id) REFERENCES perfis(id) ON DELETE CASCADE,
    FOREIGN KEY (competencia_id) REFERENCES competencias(id)
);

CREATE TABLE vagas (
    id INT PRIMARY KEY AUTO_INCREMENT,
    empresa_id INT NOT NULL,
    titulo VARCHAR(100) NOT NULL,
    descricao TEXT NOT NULL,
    requisitos TEXT NULL,
    localizacao VARCHAR(100) NULL,
    modalidade ENUM('remoto', 'hibrido', 'presencial') NOT NULL,
    contrato ENUM('clt', 'estagio', 'pj', 'temporario') NOT NULL,
    salario_min DECIMAL(10,2) NULL,
    salario_max DECIMAL(10,2) NULL,
    criado_em DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL,
    status ENUM('aberta', 'encerrada') NOT NULL,
    FOREIGN KEY (empresa_id) REFERENCES empresas(id)
);

CREATE TABLE candidaturas (
    id INT PRIMARY KEY AUTO_INCREMENT,
    usuario_id INT NOT NULL,
    vaga_id INT NOT NULL,
    status ENUM('pendente', 'em_analise', 'aprovada', 'rejeitada') NOT NULL,
    criado_em DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL,
    UNIQUE (usuario_id, vaga_id),
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id),
    FOREIGN KEY (vaga_id) REFERENCES vagas(id)
);