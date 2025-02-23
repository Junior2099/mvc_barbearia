<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];

    // Exclui todos os agendamentos relacionados ao usuário
    $stmt = $pdo->prepare("DELETE FROM agendamentos WHERE usuario_id = :user_id OR funcionario_id = :user_id");
    $stmt->execute(['user_id' => $user_id]);

    // Exclui o usuário
    $stmt = $pdo->prepare("DELETE FROM users WHERE id = :user_id");
    $stmt->execute(['user_id' => $user_id]);

    // Destroi a sessão
    session_destroy();
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir Conta</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Excluir Conta</h1>
        <p>Tem certeza de que deseja excluir sua conta? Esta ação não pode ser desfeita.</p>
        <form method="post">
            <button type="submit">Excluir Conta</button>
        </form>
        <a href="dashboard.php" class="btn">Voltar</a>
    </div>
</body>
</html>
