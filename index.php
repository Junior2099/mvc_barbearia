<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barbearia</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Bem-vindo à Barbearia</h1>
        <img src="./assets/logo.jpg" alt="logotipo" style="width:300px">
        <div class="button-container">
            <a href="login.php" class="btn">Login</a>
            <a href="register_usuario.php" class="btn">Registrar Usuário</a>
            <a href="register_funcionario.php" class="btn">Registrar Funcionário</a>
        </div>
    </div>
</body> 
</html>
