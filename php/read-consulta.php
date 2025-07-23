<?php
require_once 'db.php';
require_once 'authenticate.php';

isset($_GET['chave']);
$chave = $_GET['chave'];
list($medico_id, $paciente_id, $data_hora) = explode('|', $_GET['chave']);

// Seleciona consultas e outras colunas de tabelas relacionadas
$stmt = $pdo->prepare(
    "SELECT 
        mp.*,
        m.nome AS nome_medico,
        m.especialidade,
        p.nome AS nome_paciente,
        p.data_nascimento
    FROM 
        medico_paciente mp 
    LEFT JOIN 
        medico m ON mp.medico_id = m.id
    JOIN
        paciente p ON mp.paciente_id = p.id
    WHERE 
        mp.medico_id = ? AND mp.paciente_id = ? AND mp.data_hora = ?"
);
$stmt->execute([$medico_id, $paciente_id, $data_hora]);
$consulta = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes da Consulta</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <header>
        <h1>Detalhes da Consulta</h1>
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
        <table>
            <thead>
                <tr>
                    <th>Consulta</th>
                    <th>Médico</th>
                    <th>Especialidade</th>
                    <th>Paciente</th>
                    <th>Data de Nascimento</th>
                    <th>Data da Consulta</th>
                    <th>Observações</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?= htmlspecialchars($_GET['chave']) ?></td>
                    <td><?= htmlspecialchars($consulta['nome_medico']) ?></td>
                    <td><?= htmlspecialchars($consulta['especialidade']) ?></td>
                    <td><?= htmlspecialchars($consulta['nome_paciente']) ?></td>
                    <td><?= htmlspecialchars($consulta['data_nascimento']) ?></td>
                    <td><?= htmlspecialchars($consulta['data_hora']) ?></td>
                    <td><?= htmlspecialchars($consulta['observacao']) ?></td>
                </tr>
            </tbody>
        </table>

        <p>
            <a href="update-consulta.php?chave=<?= $chave ?>">Editar</a>
            <a href="delete-consulta.php?chave=<?= $_GET['chave'] ?>">Excluir</a>
        </p>
    </main>
</body>

</html>
