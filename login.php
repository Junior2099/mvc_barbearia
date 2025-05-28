<?php
require 'config.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        session_start();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Usuário ou senha inválidos!";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="index.css">

    <style>

body {
    background-image: url('fundo.jpg');
    background-size: cover; 
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed; 
    min-height: 100vh;
  font-family: 'Roboto', sans-serif; }

</style>
</head>
<body>

    <header class="navbar">
        <h1 class="logo_barbearia">Barbearia</h1>
        <div class="links">
            <a href="index.php">Home</a>
            <a href="login.php">Login</a>
            <a href="funcionários.html">Funcionários</a>
        </div>
    </header>



    <div class="container">
        <div class ="welcome-box">
        <h1>Login</h1>
        
        <?php if (isset($error)): ?>
            <div class="message error"><?= $error ?></div>
        <?php endif; ?>
        <form method="post">
            
        <div class = "input-container">
            <input type="text" name="username" placeholder="Digite o usuário" required>
            <input type="password" name="password" placeholder="Digite a senha" required>
        </div>
        <br>
            <div class = "button-container">
            <button type="submit" class = "btn">Entrar</button>
            </div>
        </form>


        <div class = "button-container">
        <a href="index.php" class="btn">Voltar</a>
        </div>

        </div>
    </div>
</body>
</html>