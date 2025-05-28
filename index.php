<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

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
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barbearia</title>
    <link rel="stylesheet" href="index.css">
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
        <div class="welcome-box">
            <h1>Bem-vindo à Barbearia</h1>
            <img src="logo.jpg" alt="logotipo" class="logo-image">
            <div class="button-container">
                <a href="login.php" class="btn">Login</a>
                <a href="register.usuario.php" class="btn">Cadastre-se </a>



                
            </div>
        </div>
    </div>



</body>
</html>