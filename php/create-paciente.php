<?php
require_once 'db.php';
require_once 'authenticate.php';

// Obter todos os usuários para associar ao paciente
$stmt = $pdo->query("SELECT id, nome FROM usuario");
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $tipoSanguineo = $_POST['tipoSanguineo'];
    $dataNascimento = $_POST['dataNascimento'];
    $email = $_POST['email'];
    $usuario_id = $_POST['usuario_id'];

    // Insere o novo paciente no banco de dados
    $stmt = $pdo->prepare("INSERT INTO paciente (nome, tipo_sanguineo, data_nascimento, usuario_id) VALUES (?, ?, ?, ?)");
    $stmt->execute([$nome, $tipoSanguineo, $dataNascimento, $usuario_id]);

    header('Location: index-paciente.php');
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Paciente</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <header>
        <h1>Adicionar Paciente</h1>
    </header>
    <main>
        <form method="POST">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required>

            <label for="dataNascimento">Data de Nascimento:</label>
            <input type="date" id="dataNascimento" name="dataNascimento" required>

            <label for="tipoSanguineo">Tipo Sanguineo:</label>
            <input type="tipoSanguineo" id="tipoSanguineo" name="tipoSanguineo" required>

            <label for="usuario_id">Usuário:</label>
            <select id="usuario_id" name="usuario_id" required>
                <option value="">Selecione o usuário</option>
                <?php foreach ($usuarios as $usuario): ?>
                    <option value="<?= $usuario['id'] ?>"><?= $usuario['nome'] ?></option>
                <?php endforeach; ?>
            </select>

            <button type="submit">Adicionar</button>
        </form>
    </main>
</body>
</html>
