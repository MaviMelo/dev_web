<?php
require_once 'db.php';
require_once 'authenticate.php';

$id = $_GET['id'];

// Seleciona o paciente específico pelo ID
$stmt = $pdo->prepare("SELECT * FROM paciente WHERE id = ?");
$stmt->execute([$id]);
$paciente = $stmt->fetch(PDO::FETCH_ASSOC);

// Obter todos os usuários para associar ao paciente
$stmt = $pdo->query("SELECT id, nome FROM usuario");
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $tipoSanguineo = $_POST['tipoSanguineo'];
    $dataNascimento = $_POST['dataNascimento'];
    // $email = $_POST['email'];
    $usuario_id = $_POST['usuario_id'];

    // Atualiza o paciente no banco de dados
    $stmt = $pdo->prepare("UPDATE paciente SET nome = ?, tipo_sanguineo = ?, data_nascimento = ?, usuario_id = ? WHERE id = ?");
    $stmt->execute([$nome, $tipoSanguineo, $dataNascimento, $usuario_id, $id]);

    header('Location: read-paciente.php?id=' . $id);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">:
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar paciente</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <header>
        <h1>Editar paciente</h1>
        <nav>
            <ul>
                <li><a href="../index.php">Home</a></li>
                <?php if (isset($_SESSION['user_id'])) : ?>
                    <li>pacientes:
                        <a href="/php/create-paciente.php">Adicionar</a> |
                        <a href="/php/index-paciente.php">Listar</a>
                    </li>
                    <li>Medico:
                        <a href="/php/create-medico.php">Adicionar</a> |
                        <a href="/php/index-medico.php">Listar</a>
                    </li>
                    <li>consultas:
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
            <input type="text" id="nome" name="nome" value="<?= $paciente['nome'] ?>" required>

            <label for="tipoSanguineo">Tipo sanguineo:</label>
            <input type="text" id="tipoSanguineo" name="tipoSanguineo" value="<?= $paciente['tipo_sanguineo'] ?>" required>

            <label for="dataNascimento">Data de Nascimento:</label>
            <input type="date" id="dataNascimento" name="dataNascimento" value="<?= $paciente['data_nascimento'] ?>" required>
            <!--  
            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" value="<?= $paciente['email'] ?>" required>
            -->
            <label for="usuario_id">Usuário:</label>
            <select id="usuario_id" name="usuario_id" required>
                <option value="">Selecione o usuário</option>
                <?php foreach ($usuarios as $usuario): ?>
                    <option value="<?= $usuario['id'] ?>" <?= $usuario['id'] == $paciente['usuario_id'] ? 'selected' : '' ?>>
                        <?= $usuario['nome'] ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <button type="submit">Atualizar</button>
        </form>
    </main>
</body>

</html>
