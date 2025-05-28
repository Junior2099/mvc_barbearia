<?php
try {
    $pdo = new PDO('sqlite:'.__DIR__.'/database.sqlite');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erro ao conectar ao banco de dados: " . $e->getMessage();
    exit();
}

$pdo->exec("CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    username TEXT NOT NULL,
    password TEXT NOT NULL,
    role TEXT NOT NULL
)");

$pdo->exec("CREATE TABLE IF NOT EXISTS agendamentos (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    funcionario_id INTEGER NOT NULL,
    usuario_id INTEGER,
    data TEXT NOT NULL,
    FOREIGN KEY(funcionario_id) REFERENCES users(id),
    FOREIGN KEY(usuario_id) REFERENCES users(id)
)");

try {
    $pdo->exec("ALTER TABLE agendamentos ADD COLUMN usuario_id INTEGER");
} catch (PDOException $e) {
    // Coluna já existe
}


?>
