<?php
require_once 'db.php';
require_once 'authenticate.php';

$id = $_GET['id'];

/*
// Seleciona a consulta específica pelo medico_id + paciente_id.
$stmt = $pdo->prepare("SELECT medico_id, paciente_id, data_hora FROM medico_paciente");
$stmt->execute([$medico_id, $paciente_id, $data]);
$consultas = $stmt->fetch(PDO::FETCH_ASSOC);
 */


// Seleciona a consulta específica pelo medico_id + paciente_id.
$stmt = $pdo->prepare("SELECT medico_id, paciente_id, data_hora FROM medico_paciente");
$consultas = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Obter todos os médicos para associar à consulta
$stmt = $pdo->query("SELECT id, nome FROM medico");
$medicos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Obter todos os pacientes para associar à consulta
$stmt = $pdo->query("SELECT id, nome FROM pacienete");
$pacientes = $stmt->fetchAll(PDO::FETCH_ASSOC);

/*
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $disciplina = $_POST['disciplina'];
    $turno = $_POST['turno'];
    $medico_id = $_POST['medico_id'];
*/

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $observacao = $_POST['observacao'];
  $escolha_consulta = $_POST['escolha_consulta'];


    // Atualiza a observação em consulta no banco de dados
    $stmt = $pdo->prepare("UPDATE medico_paciente SET observacao = ? WHERE (medico_id = ?, paciente_id = ?, data_hora = ?)");
  $stmt->execute([$observacao, $escolha_consulta, $escolha_consulta, $escolha_consulta,]);

    header('Location: read-consulta.php?id=' . $id);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar consulta</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <header>
        <h1>Editar consulta</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
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
        <form method="POST">
            <label for="Observação:">Disciplina:</label>
            <input type="text" id="observacao" name="observacao"  required>


            <label for="escolha_consulta">medico:</label>
            <select id="escolha_consulta" name="escolha_consulta" required>
                <option value="">Selecione o medico</option>
                <?php foreach ($consultas as $consulta): ?>
                    <option value="<?= $medicos['id'], $pacientes['id'], $consultas['data_hora'] ?>" <?= $medicos['id'] == $consultas['medico_id'], $pacientes['id'] == $consultas['paciente_id'] ? 'selected' : '' ?>>
                        <?= [$medicos['nome'], $pacientes['nome'], $consultas['data_hora']] ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <button type="submit">Atualizar</button>
        </form>
    </main>
</body>
</html>





/**
 

<?php
require_once 'db.php';
require_once 'authenticate.php';

// Seleciona a consulta específica pelo medico_id + paciente_id.
$stmt = $pdo->prepare("SELECT medico_id, paciente_id, data_hora, observacao FROM medico_paciente WHERE medico_id = ? AND paciente_id = ? AND data_hora = ?");
$stmt->execute([$_GET["medico_id"], $_GET["paciente_id"], $_GET["data_hora"]]);
$consulta_selecionada = $stmt->fetch(PDO::FETCH_ASSOC);

// Obter todas as consultas para preencher o select
$stmt = $pdo->query("SELECT mp.medico_id, mp.paciente_id, mp.data_hora, m.nome as medico_nome, p.nome as paciente_nome FROM medico_paciente mp JOIN medico m ON mp.medico_id = m.id JOIN paciente p ON mp.paciente_id = p.id");
$consultas = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $observacao = $_POST['observacao'];
  $escolha_consulta = $_POST['escolha_consulta'];

  //Divide a string de escolha_consulta para obter medico_id, paciente_id e data_hora
  list($medico_id_post, $paciente_id_post, $data_hora_post) = explode('_', $escolha_consulta);

  // Atualiza a observação em consulta no banco de dados
  $stmt = $pdo->prepare("UPDATE medico_paciente SET observacao = ? WHERE medico_id = ? AND paciente_id = ? AND data_hora = ?");
  $stmt->execute([$observacao, $medico_id_post, $paciente_id_post, $data_hora_post]);

  header('Location: read-consulta.php?medico_id=' . $medico_id_post . '&paciente_id=' . $paciente_id_post . '&data_hora=' . $data_hora_post);
  exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar consulta</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <header>
        <h1>Editar consulta</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
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
        <form method="POST">
            <label for="observacao">Observação:</label>
            <input type="text" id="observacao" name="observacao" value="<?= htmlspecialchars($consulta_selecionada['observacao'] ?? '') ?>" required>

            <label for="escolha_consulta">Consulta:</label>
            <select id="escolha_consulta" name="escolha_consulta" required>
                <option value="">Selecione a consulta</option>
                <?php foreach ($consultas as $c): ?>
                    <option value="<?= $c['medico_id'] ?>_<?= $c['paciente_id'] ?>_<?= $c['data_hora'] ?>"
                        <?= ($consulta_selecionada['medico_id'] == $c['medico_id'] && $consulta_selecionada['paciente_id'] == $c['paciente_id'] && $consulta_selecionada['data_hora'] == $c['data_hora']) ? 'selected' : '' ?>>
                        Médico: <?= htmlspecialchars($c['medico_nome']) ?>, Paciente: <?= htmlspecialchars($c['paciente_nome']) ?>, Data/Hora: <?= htmlspecialchars($c['data_hora']) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <button type="submit">Atualizar</button>
        </form>
    </main>
</body>
</html>

**/
