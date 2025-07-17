<?php
require_once 'db.php';
require_once 'authenticate.php';

$id = $_GET['id'];

// Seleciona a turma específica pelo ID
$stmt = $pdo->prepare("SELECT turmas.*, professores.nome AS professor_nome FROM turmas LEFT JOIN professores ON turmas.professor_id = professores.id WHERE turmas.id = ?");
$stmt->execute([$id]);
$turma = $stmt->fetch(PDO::FETCH_ASSOC);

// Seleciona os alunos não matriculados na turma
$stmt = $pdo->prepare("SELECT * FROM alunos WHERE id NOT IN (SELECT aluno_id FROM matriculas WHERE turma_id = ?)");
$stmt->execute([$id]);
$alunosDisponiveis = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Seleciona os alunos matriculados na turma
$stmt = $pdo->prepare("SELECT alunos.* FROM alunos INNER JOIN matriculas ON alunos.id = matriculas.aluno_id WHERE matriculas.turma_id = ?");
$stmt->execute([$id]);
$alunosMatriculados = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Manipulação da matrícula
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['matricular'])) {
        $aluno_id = $_POST['aluno_id'];
        $stmt = $pdo->prepare("INSERT INTO matriculas (aluno_id, turma_id) VALUES (?, ?)");
        $stmt->execute([$aluno_id, $id]);
    } elseif (isset($_POST['desmatricular'])) {
        $aluno_id = $_POST['aluno_id'];
        $stmt = $pdo->prepare("DELETE FROM matriculas WHERE aluno_id = ? AND turma_id = ?");
        $stmt->execute([$aluno_id, $id]);
    }

    header("Location: read-turma.php?id=$id");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes da Turma</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <header>
        <h1>Detalhes da Turma</h1>
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
        <?php if ($turma): ?>
            <p><strong>ID:</strong> <?= $turma['id'] ?></p>
            <p><strong>Disciplina:</strong> <?= $turma['disciplina'] ?></p>
            <p><strong>Turno:</strong> <?= $turma['turno'] ?></p>
            <p><strong>Professor:</strong> <?= $turma['professor_nome'] ?></p>
            
            <h2>Matricular Aluno</h2>
            <form method="POST">
                <label for="aluno_id">Selecionar Aluno:</label>
                <select id="aluno_id" name="aluno_id" required>
                    <option value="">Selecione o aluno</option>
                    <?php foreach ($alunosDisponiveis as $aluno): ?>
                        <option value="<?= $aluno['id'] ?>"><?= $aluno['nome'] ?></option>
                    <?php endforeach; ?>
                </select>
                <button type="submit" name="matricular">Matricular</button>
            </form>

            <h2>Alunos Matriculados</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($alunosMatriculados as $aluno): ?>
                        <tr>
                            <td><?= $aluno['id'] ?></td>
                            <td><?= $aluno['nome'] ?></td>
                            <td>
                                <form method="POST" style="display:inline;">
                                    <input type="hidden" name="aluno_id" value="<?= $aluno['id'] ?>">
                                    <button type="submit" name="desmatricular">Desmatricular</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <p>
                <a href="update-turma.php?id=<?= $turma['id'] ?>">Editar</a>
                <a href="delete-turma.php?id=<?= $turma['id'] ?>">Excluir</a>
            </p>
        <?php else: ?>
            <p>Turma não encontrada.</p>
        <?php endif; ?>
    </main>
</body>
</html>
