<?php
require 'config.php';
$message = '';
$message_class = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $role = 'funcionario';

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
        $message = "Funcionário registrado com sucesso!";
        $message_class = 'success'; // Classe CSS para mensagem de sucesso
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Funcionário</title>
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
        <div class= "welcome-box">

        <h1>Cadastrar Funcionário</h1>
        <br>
        <?php if ($message): ?>
            <div class="message <?= $message_class ?>"><?= $message ?></div>
        <?php endif; ?>
        <form method="post">

  <div class = "input-container">
            <input type="text" name="username" placeholder="Digite o usuário" required>
            <input type="password" name="password" placeholder="Digite a senha" required>
        </div>
<br>
            <div class = "button-container">
            <button type="submit" class = "btn" >Cadastrar Funcionário</button>
  <a href="index.php" class="btn">Voltar</a>
        </div>

        </div>
           </div>

        </form>
      
 
</body>
</html>