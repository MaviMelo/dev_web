<?php
require_once 'db.php';
require_once 'authenticate.php';

// Obter todos os professores para associar à turma
$stmt = $pdo->query("SELECT id, nome FROM professores");
$professores = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $disciplina = $_POST['disciplina'];
    $turno = $_POST['turno'];
    $professor_id = $_POST['professor_id'];

    // Insere a nova turma no banco de dados
    $stmt = $pdo->prepare("INSERT INTO turmas (disciplina, turno, professor_id) VALUES (?, ?, ?)");
    $stmt->execute([$disciplina, $turno, $professor_id]);

    header('Location: index-turma.php');
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Turma</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <header>
        <h1>Adicionar Turma</h1>
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
        <form method="POST">
            <label for="disciplina">Disciplina:</label>
            <input type="text" id="disciplina" name="disciplina" required>

            <label for="turno">Turno:</label>
            <input type="text" id="turno" name="turno" required>

            <label for="professor_id">Professor:</label>
            <select id="professor_id" name="professor_id" required>
                <option value="">Selecione o professor</option>
                <?php foreach ($professores as $professor): ?>
                    <option value="<?= $professor['id'] ?>"><?= $professor['nome'] ?></option>
                <?php endforeach; ?>
            </select>

            <button type="submit">Adicionar</button>
        </form>
    </main>
</body>
</html>
