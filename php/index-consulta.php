<?php
require_once 'db.php';
require_once 'authenticate.php';

// Seleciona todas as turmas
$stmt = $pdo->query("SELECT turmas.*, professores.nome AS professor_nome FROM turmas LEFT JOIN professores ON turmas.professor_id = professores.id");
$turmas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Turmas</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <header>
        <h1>Lista de Turmas</h1>
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
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Disciplina</th>
                    <th>Turno</th>
                    <th>Professor</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($turmas as $turma): ?>
                    <tr>
                        <td><?= $turma['id'] ?></td>
                        <td><?= $turma['disciplina'] ?></td>
                        <td><?= $turma['turno'] ?></td>
                        <td><?= $turma['professor_nome'] ?></td>
                        <td>
                            <a href="read-turma.php?id=<?= $turma['id'] ?>">Visualizar</a>
                            <a href="update-turma.php?id=<?= $turma['id'] ?>">Editar</a>
                            <a href="delete-turma.php?id=<?= $turma['id'] ?>" onclick="return confirm('Tem certeza que deseja excluir esta turma?');">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
</body>
</html>
