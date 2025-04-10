<?php
require_once("conexao.php");
$senha = '123';
$senha_criptografada = password_hash($senha, PASSWORD_DEFAULT);

try {
    // Verificar se já existe um super administrador SAS
    $stmt = $pdo->query("SELECT COUNT(*) FROM usuarios WHERE nivel = 'SAS'");
    $count = $stmt->fetchColumn();

    if ($count == 0) {
        // Criar um usuário super administrador SAS
        $stmt = $pdo->prepare("INSERT INTO usuarios (empresa, nome, cpf, email, senha_criptografada, ativo, foto, nivel, telefone)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->execute([
    '0',
    'Administrador SAS',
    '000.000.000-00',
    'biel.leonardi@gmail.com',
    $senha_criptografada,
    'sim',
    'sem-foto.jpg',
    'SAS',
    '00000000'
]);
 // Adicionei um numero de telefone padrão.

        echo "Super administrador SAS criado com sucesso!";
    } else {
        echo ".";
    }
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
?>



?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema SaS</title>

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script><!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Estilo Customizado -->
    <link rel="stylesheet" href="http://192.168.0.10/vendas/css/login.css">
</head>

<div class="sidenav">
    <div class="login-main-text">
        <h2>SAS<br> Login Page</h2>
        <p>Login ou registro de novo Usuario.</p>
    </div>
</div>
<div class="main">
    <div class="col-md-6 col-sm-12">
        <div class="login-form">
            <!-- Apenas um <form>, com action e method corretos -->
            <form action="auth.php" method="post">
                <div class="form-group">
                    <label>Nome de Usuario ou E-mail</label>
                    <input type="text" name="usuario" class="form-control" placeholder="Email ou CPF" required>
                </div>
                <div class="form-group">
                    <label>Senha</label>
                    <input type="password" name="senha" class="form-control" placeholder="Senha" required>
                </div>
                <button type="submit" class="btn btn-black">Login</button>
            </form>
        </div>
    </div>
</div>