<?php
require_once 'db.php';
require_once 'authenticate.php';

$id = $_GET['id'];

// Seleciona o professor específico pelo ID
$stmt = $pdo->prepare("SELECT professores.*, usuarios.username FROM professores LEFT JOIN usuarios ON professores.usuario_id = usuarios.id WHERE professores.id = ?");
$stmt->execute([$id]);
$professor = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Professor</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <header>
        <h1>Detalhes do Professor</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li>Alunos: 
                        <a href="/php/create-aluno.php">Adicionar</a> | 
                        <a href="/php/index-aluno.php">Listar</a>
                    </li>
                    <li>Professores: 
                        <a href="/php/create-professor.php">Adicionar</a> | 
                        <a href="/php/index-professor.php">Listar</a>
                    </li>
                    <li>Turmas: 
                        <a href="/php/create-turma.php">Adicionar</a> | 
                        <a href="/php/index-turma.php">Listar</a>
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
        <?php if ($professor): ?>
            <p><strong>ID:</strong> <?= $professor['id'] ?></p>
            <p><strong>Nome:</strong> <?= $professor['nome'] ?></p>
            <p><strong>Área:</strong> <?= $professor['area'] ?></p>
            <p><strong>Usuário Associado:</strong> <?= $professor['username'] ?></p>
            <p>
                <a href="update-professor.php?id=<?= $professor['id'] ?>">Editar</a>
                <a href="delete-professor.php?id=<?= $professor['id'] ?>">Excluir</a>
            </p>
        <?php else: ?>
            <p>Professor não encontrado.</p>
        <?php endif; ?>
    </main>
</body>
</html>
