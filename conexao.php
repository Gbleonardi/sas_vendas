<?php
// Exibe codigos de erro
ini_set('display_errors', 1);  
ini_set('display_startup_errors', 1); 
error_reporting(E_ALL);

$banco = 'sas_vendas';       // Nome do Banco de dados
$usuario = 'root';            // Usuario do MySQL
$senha = '123890';            // Senha do MySQL
$servidor = '192.168.0.10:3306';  //IP do servidor MySQL e porta

date_default_timezone_set('America/Sao_Paulo');

try {

    //Criacao da conexao com o banco de dados usando PDO
    $pdo = new PDO("mysql:host=$servidor;dbname=$banco;charset=utf8", $usuario, $senha);

    //Configuracao do modo de erro do POD para execoes
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Conexão bem-sucedida!";
} catch (PDOException $e) {

    //Captura e exibe erros de conexao
    echo "Erro de conexão: " . $e->getMessage();
}
