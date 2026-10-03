<?php

$host = 'localhost';
$dbname = 'harrjob';
$port = '3306';
$usuario = 'root';
$senha = '';

$dsn = "mysql:host=$host;dbname=$dbname;port=$port;charset=utf8mb4";

try {
    $pdo = new PDO($dsn, $usuario, $senha);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    error_log($e->getMessage(), 3, __DIR__ . '/erros.log');
    echo 'Erro na conexão!';
}