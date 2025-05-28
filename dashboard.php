<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require 'config.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de Controle</title>
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
            <a href="dashboard.php">Painel</a>
            <a href="logout.php">Sair</a>
        </div>
    </header>

    <div class="container">
        <div class = "welcome-box">
        <h1>Bem-vindo ao Painel de Controle</h1>
<br>
        <?php if ($_SESSION['role'] == 'funcionario'): ?>
            <a href="agendamento.php" class="btn">Cadastrar Datas para Agendamento</a>
            <br><br><br>
            <h2>Suas Datas Disponíveis:</h2>
            <br>
            <?php
            $stmt = $pdo->query("SELECT * FROM agendamentos WHERE funcionario_id = " . $_SESSION['user_id']);
            while ($row = $stmt->fetch()): 
                $data_brasil = (new DateTime($row['data']))->format('d/m/Y');
            ?>
                <div class='agendamento'>
                    <span>Data: <?= $data_brasil ?></span>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>

        <?php if ($_SESSION['role'] == 'usuario'): ?>
            <h2>Agendamentos Disponíveis:</h2>
            <br>
            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['agendar'])) {
                $agendamento_id = $_POST['agendamento_id'];
                $stmt = $pdo->prepare("UPDATE agendamentos SET usuario_id = :usuario_id WHERE id = :id");
                $stmt->execute(['usuario_id' => $_SESSION['user_id'], 'id' => $agendamento_id]);
                echo "<div class='message'>Agendamento realizado com sucesso!</div>";
            } elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cancelar'])) {
                $agendamento_id = $_POST['agendamento_id'];
                $stmt = $pdo->prepare("UPDATE agendamentos SET usuario_id = NULL WHERE id = :id");
                $stmt->execute(['id' => $agendamento_id]);
                echo "<div class='message'>Agendamento cancelado com sucesso!</div>";
            }

            $stmt = $pdo->query("SELECT * FROM agendamentos WHERE usuario_id IS NULL");
            while ($row = $stmt->fetch()): 
                $data_brasil = (new DateTime($row['data']))->format('d/m/Y');
            ?>
                <form method='post' class='agendamento'>
                    <span>Data: <?= $data_brasil ?></span>
                    <input type='hidden' name='agendamento_id' value='<?= $row['id'] ?>'>
                    <button type='submit' name='agendar' class='btn'>Agendar</button>
                </form>
            <?php endwhile; ?>

            <h2>Seus Agendamentos:</h2>
            <?php
            $stmt = $pdo->query("SELECT * FROM agendamentos WHERE usuario_id = " . $_SESSION['user_id']);
            while ($row = $stmt->fetch()): 
                $data_brasil = (new DateTime($row['data']))->format('d/m/Y');
            ?>
                <form method='post' class='agendamento'>
                    <span>Data: <?= $data_brasil ?></span>
                    <input type='hidden' name='agendamento_id' value='<?= $row['id'] ?>'>
                    <button type='submit' name='cancelar' class='btn'>Cancelar</button>
                </form>
            <?php endwhile; ?>
        <?php endif; ?>

           <div class="button-container">
        <a href="delete_account.php" class="btn btn-danger">Excluir Minha Conta</a>
        <a href="logout.php" class="btn">Sair</a>
            </div>
    </div>
</body>
</html>