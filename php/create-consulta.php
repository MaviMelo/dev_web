<?php
require_once 'db.php';
require_once 'authenticate.php';

// Busca todos os pacientes
$stmt_pacientes = $pdo->query("SELECT id, nome FROM paciente ORDER BY nome;");
$pacientes = $stmt_pacientes->fetchAll(PDO::FETCH_ASSOC);

// Busca todos os médicos
$stmt_medicos = $pdo->query("SELECT id, nome FROM medico ORDER BY nome;");
$medicos = $stmt_medicos->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $paciente = $_POST['paciente'];
    $medico = $_POST['medico'];
    $data_hora = $_POST['data_hora'];
    $observacao = $_POST['observacao'];

    // Insere a nova consulta no banco de dados
    $stmt = $pdo->prepare("INSERT INTO medico_paciente (medico_id, paciente_id, data_hora, observacao) VALUES (?, ?, ?, ?);");
    $stmt->execute([$medico, $paciente, $data_hora, $observacao]);

    header('Location: index-consulta.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Consulta</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <header>
        <h1>Adicionar consulta</h1>
        <nav>
            <ul>
                <li><a href="../index.php">Home</a></li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li>Pacientes:
                        <a href="/php/create-paciente.php">Adicionar</a> |
                        <a href="/php/index-paciente.php">Listar</a>
                    </li>
                    <li>Médicos:
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

            <label for="paciente">Paciente:</label>
            <select id="paciente" name="paciente" required>
                <option value="">--Selecione o paciente--</option>
                <?php foreach ($pacientes as $marcar): ?>
                    <option value="<?= $marcar['id'] ?>"><?= $marcar['nome'] ?></option>
                <?php endforeach; ?>
            </select> <br>

            <label for="medico">Médico:</label>
            <select id="medico" name="medico" required>
                <option value="">--Selecione o médico--</option>
                <?php foreach ($medicos as $marcar): ?>
                    <option value="<?= $marcar['id'] ?>"><?= $marcar['nome'] ?></option>
                <?php endforeach; ?>
            </select> <br>

            <label for="data">Marcar data e horário:</label>
            <input type="datetime-local" id="data" name="data_hora" required> <br>

            <label for="observacao">Observalções pré-consulta:</label> <br>
            <textarea id="observacao" name="observacao" rows="4" placeholder="Máximo de 500 caractéres"></textarea> <br>

            <button type="submit">Adicionar</button>
        </form>
    </main>
</body>

</html>
