<?php
@session_start();
require_once("conexao.php");
require_once("logs/logger.php");

//Evita erros ao acessar o script diretamente
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    exit ('Acesso invalido!');
}

//Valida os campos antes de consultar o banco
if (empty($_POST['usuario']) || empty($_POST['senha'])) {
    echo '<script>alert("Preencha todos os campos!");</script>';
    echo '<script>window.location.href = "index.php";</script>';
    exit();
}

try {
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    $stmt = $pdo->prepare("SELECT id, nome, nivel, empresa, senha_criptografada, ativo FROM usuarios WHERE email = ?");
    $stmt->execute([$usuario]);
    $usuario_dados = $stmt->fetch(PDO::FETCH_ASSOC);



    if ($usuario_dados && password_verify($senha, $usuario_dados['senha_criptografada'])) {
        $_SESSION['id'] = $usuario_dados['id'];
        $_SESSION['nome'] = $usuario_dados['nome'];
        $_SESSION['nivel'] = $usuario_dados['nivel'];
        $_SESSION['empresa'] = $usuario_dados['empresa'];
        $_SESSION['ativo'] = $usuario_dados['ativo'];

        if (trim(strtolower($_SESSION['ativo'])) != 'sim') {
            echo '<script>alert("Usuário inativo, contacte o Administrador!");</script>';
            echo '<script>window.location.href = "index.php";</script>';
            exit();
        }

        //log de sucesso
        log_acesso("Login bem-sucedido para o usuário: $usuario (ID: {$usuario_dados['id']})");

        if ($_SESSION['nivel'] == 'SAS') {
            echo '<script>window.location="SAS";</script>';
        } else {
            echo '<script>window.location="SISTEMA";</script>';
        }
        // Inicie a sessão, redirecione, etc.
    } else {
        //log de erro
        log_erro("Tentativa de login falhou para o e-mail: $usuario");

        echo '<script>alert("Usuário ou senha inválidos!");</script>';
        echo '<script>window.location.href = "index.php";</script>';
    }
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}