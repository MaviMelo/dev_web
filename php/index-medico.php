<?php
require_once 'db.php';
require_once 'authenticate.php';

// Seleciona todos os professores
$stmt = $pdo->query("SELECT professores.*, usuarios.username FROM professores LEFT JOIN usuarios ON professores.usuario_id = usuarios.id");
$professores = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Professores</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <header>
        <h1>Lista de Professores</h1>
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
                    <th>Nome</th>
                    <th>Área</th>
                    <th>Usuário Associado</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($professores as $professor): ?>
                    <tr>
                        <td><?= $professor['id'] ?></td>
                        <td><?= $professor['nome'] ?></td>
                        <td><?= $professor['area'] ?></td>
                        <td><?= $professor['username'] ?></td>
                        <td>
                            <a href="read-professor.php?id=<?= $professor['id'] ?>">Visualizar</a>
                            <a href="update-professor.php?id=<?= $professor['id'] ?>">Editar</a>
                            <a href="delete-professor.php?id=<?= $professor['id'] ?>" onclick="return confirm('Tem certeza que deseja excluir este professor?');">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
</body>
</html>
