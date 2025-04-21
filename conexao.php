<?php
// Exibe erros
ini_set('display_errors', 1);  
ini_set('display_startup_errors', 1); 
error_reporting(E_ALL);

// Inicia sessão se necessário
@session_start();

// Carrega o autoloader do Composer
require_once __DIR__ . '/vendor/autoload.php';

// Carrega as variáveis de ambiente do .env
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Configura o fuso horário
date_default_timezone_set('America/Sao_Paulo');

try {
    // Recupera variáveis do .env
    $host = $_ENV['DB_HOST'];
    $port = $_ENV['DB_PORT'];
    $dbname = $_ENV['DB_NAME'];
    $user = $_ENV['DB_USER'];
    $pass = $_ENV['DB_PASS'];

    // Cria a conexão PDO
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "";
} catch (PDOException $e) {
    echo "Erro de conexão: " . $e->getMessage();
}
