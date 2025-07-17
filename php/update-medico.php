<?php
require_once 'db.php';
require_once 'authenticate.php';

$id = $_GET['id'];

// Seleciona o medico específico pelo ID
$stmt = $pdo->prepare("SELECT * FROM medico WHERE id = ?");
$stmt->execute([$id]);
$medico = $stmt->fetch(PDO::FETCH_ASSOC);

// Obter todos os usuários para associar ao medico
$stmt = $pdo->query("SELECT id, nome FROM usuario");
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $especialidade = $_POST['especialidade'];
    $usuario_id = $_POST['usuario_id'];

    // Atualiza o medico no banco de dados
    $stmt = $pdo->prepare("UPDATE medico SET nome = ?, especialidade = ?, crm = ?, usuario_id = ? WHERE id = ?");
    $stmt->execute([$nome, $especialidade, $crm, $usuario_id, $id]);

    header('Location: read-medico.php?id=' . $id);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar medico</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <header>
        <h1>Editar medico</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li>Pacientes: 
                        <a href="/php/create-paciente.php">Adicionar</a> | 
                        <a href="/php/index-paciente.php">Listar</a>
                    </li>
                    <li>Medicos: 
                        <a href="/php/create-medico.php">Adicionar</a> | 
                        <a href="/php/index-medico.php">Listar</a>
                    </li>
                    <li>Consultas: 
                        <a href="/php/create-consulta.php">Adicionar</a> | 
                        <a href="/php/index-consulta.php">Listar</a>
                    </li>
                    <li><a href="/php/logout.php">Logout (<?= $_SESSION['username'] ?>)</a></li>
                <?php else: ?>
                    <li><a href="/php/user-login.php">Login</a></li>
                    <li><a href="/php/user-register.php">Registrar</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    <main>
        <form method="POST">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" value="<?= $medico['nome'] ?>" required>
            <br>

            <label for="especialidade">Especialidade:</label>
            <input type="text" id="especialidade" name="especialidade" value="<?= $medico['especialidade'] ?>" required>
            <br>  

            <label for="crm">CRM:</label>
            <input type="text" id="crm" name="crm" placeholder="Ex.: 000000/xy" value="<?= $medico['crm'] ?>" required>
            <br>

            <label for="usuario_id">Usuário:</label>
            <select id="usuario_id" name="usuario_id" required>

                <option value="">Selecione o usuário</option>
                <?php foreach ($usuarios as $usuario): ?>
                    <option value="<?= $usuario['id'] ?>" <?= $usuario['id'] == $medico['usuario_id'] ? 'selected' : '' ?>>
                        <?= $usuario['nome'] ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <button type="submit">Atualizar</button>
        </form>
    </
