<?php
require 'config.php';
$message = '';
$message_class = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $role = 'usuario';

    // Verifica se o nome de usuário já existe
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = :username");
    $stmt->execute(['username' => $username]);
    $count = $stmt->fetchColumn();

    if ($count > 0) {
        $message = "Nome de usuário já existe. Por favor, escolha outro.";
        $message_class = 'error'; // Classe CSS para mensagem de erro
    } else {
        $stmt = $pdo->prepare("INSERT INTO users (username, password, role) VALUES (:username, :password, :role)");
        $stmt->execute(['username' => $username, 'password' => $password, 'role' => $role]);
        $message = "Usuário registrado com sucesso!";
        $message_class = 'success'; // Classe CSS para mensagem de sucesso
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Usuário</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Registrar Usuário</h1>
        <?php if ($message): ?>
            <div class="message <?= $message_class ?>"><?= $message ?></div>
        <?php endif; ?>
        <form method="post">
            <input type="text" name="username" placeholder="Usuário" required>
            <input type="password" name="password" placeholder="Senha" required>
            <button type="submit">Registrar Usuário</button>
        </form>
        <a href="index.php" class="btn">Voltar</a>
    </div>
</body>
</html>
