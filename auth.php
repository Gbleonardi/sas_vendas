<?php
require_once("conexao.php");

try {
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    $stmt = $pdo->prepare("SELECT senha_criptografada FROM usuarios WHERE email = ?");
    $stmt->execute([$usuario]);
    $senha_hash = $stmt->fetchColumn();
    


    if ($senha_hash && password_verify($senha, $senha_hash)) {
        echo "Login bem-sucedido!";
        // Inicie a sessão, redirecione, etc.
    } else {
        echo "Usuário ou senha incorretos.";
    }

} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
?>