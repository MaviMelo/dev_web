<?php
require_once 'db.php';
require_once 'authenticate.php';


// Seleciona a consulta específica para o dropdown no formulário.
$stmt = $pdo->query(

    "SELECT 
     mp.medico_id,
     mp.paciente_id,
     mp.data_hora,
     mp.observacao,     
     m.nome AS nome_medico,
     p.nome AS nome_paciente 
   FROM
     medico_paciente mp
   INNER JOIN
     medico m ON mp.medico_id = m.id 
   JOIN
     paciente p ON mp.paciente_id = p.id 
   ORDER BY 
     mp.data_hora DESC"
);
$consultas = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Se estiver editando uma consulta específica, pegua a referencia da URL, 
// no caso a chave composta vindo atribuida no parametro '?chave=...'.
if (isset($_GET['chave'])) {
    list($medico_id, $paciente_id, $data_hora) = explode('|', $_GET['chave']);

    // Busca os dados da consulta especifica
    $stmt = $pdo->prepare(
        "SELECT * FROM medico_paciente
        WHERE medico_id = ? AND paciente_id = ? AND data_hora = ? ;"
    );
    $stmt->execute([$medico_id, $paciente_id, $data_hora]);
    $consulta_atual = $stmt->fetch();
};

// prepara o envio dos dados para o baco de dados.
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $observacao = $_POST['observacao'];
    $escolha_consulta = $_POST['escolha_consulta'];

    // separa o valor concatenado e obtido por mane="escolha_consulta" nos três componentes da chave primária atravéz 
    // da função 'explode()', que divide uma string em um array com base em um delimitador (no caso: '|').
    list($medico_id, $paciente_id, $data_hora) = explode('|', $escolha_consulta);

    // Atualiza 'observacao' na tabela 'medico_paciente' no banco de dados
    $stmt = $pdo->prepare(
        "UPDATE medico_paciente 
                            SET observacao = ? 
                            WHERE medico_id = ? AND paciente_id = ? AND data_hora = ? "
    );
    $stmt->execute([$observacao, $medico_id, $paciente_id, $data_hora]);

    header('Location: read-consulta.php?chave=' . $_GET['chave']);
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
        <form method="POST">

            <label for="escolha_consulta">Consulta:</label>
            <select id="escolha_consulta" name="escolha_consulta" required>
                <option value="">Selecione a consulta</option>
                <?php foreach ($consultas as $consulta): ?>

                    <?php
                    // cria o valor para o 'value' do 'option', cocatenando os três campos da chave primetia da tabela. 
                    $valor_option = $consulta['medico_id'] . '|' . $consulta['paciente_id'] . '|' . $consulta['data_hora'];

                    // formata a data para leitura mais convencional.
                    $data_formatada = date('d/m/Y H:i', strtotime($consulta['data_hora']));

                    // cria o texto exibido ao usuário:
                    $texto_option = "Médico: " . htmlspecialchars($consulta['nome_medico']) .
                        " | Paciente: " . htmlspecialchars($consulta['nome_paciente']) .
                        " | Data: " . $data_formatada;

                    $selecionado ='';
                    if (isset($_GET['chave']) && $_GET['chave'] == $valor_option) {
                        $selecionado = 'selected';
                    }
                    

                    ?>

                        <option value="<?= $valor_option ?>" <?= $selecionado ?>>
                        <?= $texto_option ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label for="observacao">Observação:</label>
            <textarea id="observacao" name="observacao" rows="4" placeholder="Máximo de 500 caractéres." required> <?php echo $consulta_atual['observacao'] ?> </textarea>

            <button type="submit">Atualizar</button>
        </form>
    </main>
</body>

</html>
