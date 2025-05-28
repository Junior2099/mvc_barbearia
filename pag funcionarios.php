<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Funcionários</title>
    <link rel="icon" href="favicon.ico.png" type="image/x-icon">
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


    <script>
        function validarFormulario(event) {
            const senha = document.getElementById("password").value;

            if (senha.length < 6 || senha.length > 15) {
                alert("A senha deve conter no mínimo 6 e no máximo 15 caractéres.");
                event.preventDefault(); // Impede envio
                return;
            }

            alert("Cadastro realizado com sucesso!");
        }
    </script>
</head>
<body>
    <div class="container">
        <div class = "welcome-box">
        <h1>Registro de Funcionários</h1>
       <!-- <?php if ($message): ?>
            <div class="message <?= $message_class ?>"><?= $message ?></div>
        <?php endif; ?> -->
        <form method="post" onsubmit="validarFormulario(event)">

            <label for="fullname">Nome Completo:</label>
            
            <div class = "input-container">
            <input type="text" id="fullname" name="fullname" placeholder="Digite o nome completo" required>
       </div>
<br>
            <label for="email">Email:</label>

            <div class = "input-container">
            <input type="email" id="email" name="email" placeholder="Digite o email" required>
       </div>
       <br>
            <label for="username">Usuário:</label>

                  <div class = "input-container">
            <input type="text" id="username" name="username" placeholder="Digite o nome de usuário" required>
                  </div>
<br>
            <label for="password">Senha:</label>

                  <div class = "input-container">
            <input type="password" id="password" name="password" placeholder="Digite a senha" required>
       </div>

            <small>A senha deve conter no mínimo 6 e no máximo 15 caractéres.</small>

            <br>
            <div class = "button-container">
            <button type="submit" class = "btn" >Registrar Funcionário</button>
            <!-- Botão Voltar -->
            <button type="button" class="btn" onclick="window.location.href='index.php'">Voltar</button>
       </div>
        </div>
        </form>
    </div>
</body>
</html>
