<?php
require_once 'db.php';
require_once 'authenticate.php';

$id = $_GET['id'];

// Seleciona o aluno específico pelo ID
$stmt = $pdo->prepare("SELECT alunos.*, usuarios.username FROM alunos LEFT JOIN usuarios ON alunos.usuario_id = usuarios.id WHERE alunos.id = ?");
$stmt->execute([$id]);
$aluno = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Aluno</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <header>
        <h1>Detalhes do Aluno</h1>
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
        <?php if ($aluno): ?>
            <p><strong>ID:</strong> <?= $aluno['id'] ?></p>
            <p><strong>Nome:</strong> <?= $aluno['nome'] ?></p>
            <p><strong>Matrícula:</strong> <?= $aluno['matricula'] ?></p>
            <p><strong>Data de Nascimento:</strong> <?= $aluno['data_nascimento'] ?></p>
            <p><strong>E-mail:</strong> <?= $aluno['email'] ?></p>
            <p><strong>Usuário Associado:</strong> <?= $aluno['username'] ?></p>
            <p>
                <a href="update-aluno.php?id=<?= $aluno['id'] ?>">Editar</a>
                <a href="delete-aluno.php?id=<?= $aluno['id'] ?>">Excluir</a>
            </p>
        <?php else: ?>
            <p>Aluno não encontrado.</p>
        <?php endif; ?>
    </main>
</body>
</html>
