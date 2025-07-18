<?php
require_once 'db.php';
require_once 'authenticate.php';

// Seleciona todas as consultas 
$stmt = $pdo->query(
    "SELECT 
        medico_paciente.*,
        medico.nome AS medico_nome,
        paciente.nome AS paciente_nome
    FROM 
        medico_paciente
    JOIN
        medico ON medico_paciente.medico_id = medico.id
    JOIN
        paciente ON medico_paciente.paciente_id = paciente.id"
);
$consultas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de consultas</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <header>
        <h1>Lista de Consultas</h1>
        <nav>
            <ul>
                <li><a href="../index.php">Home</a></li>
                <?php if (isset($_SESSION['user_id'])) : ?>
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
                    <th>Médico</th>
                    <th>Paciente</th>
                    <th>Data da consulta</th>
                    <th>Observasões médicas</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($consultas as $consulta): ?>
                    <?php
                    // 1. CRIAR A CHAVE COMPOSTA
                    // Concatena os 3 valores com um separador '|'
                    $chaveComposta = $consulta['medico_id'] . '|' .
                        $consulta['paciente_id'] . '|' .
                        $consulta['data_hora'];
                    ?>
                    <tr>
                        <td><?= $consulta['medico_nome'] ?></td>
                        <td><?= $consulta['paciente_nome'] ?></td>
                        <td><?= $consulta['data_hora'] ?></td>
                        <td><?= $consulta['observacao'] ?></td>
                        <td>
                            <!-- 2. USAR A CHAVE COMPOSTA NOS LINKS -->
                            <!-- Usamos urlencode() para garantir que a chave seja segura para a URL -->
                            <a href="read-consulta.php?chave=<?= urlencode($chaveComposta) ?>">Visualizar</a>
                            <a href="update-consulta.php?chave=<?= urlencode($chaveComposta) ?>">Editar</a>
                            <a href="delete-consulta.php?chave=<?= urlencode($chaveComposta) ?>"
                                onclick="return confirm('Tem certeza que deseja excluir esta consulta?');">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
</body>

</html>
