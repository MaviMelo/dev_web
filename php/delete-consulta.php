<?php
require_once 'db.php';
require_once 'authenticate.php';

$chave = $_GET['chave'];


list($medico_id, $paciente_id, $data_hora) = explode('|', $chave);

// Prepara a instrução SQL para excluir a consulta pela chave composta.
$stmt = $pdo->prepare("DELETE FROM medico_paciente WHERE medico_id = ? AND paciente_id = ? AND data_hora = ? ;");
$stmt->execute([$medico_id, $paciente_id, $data_hora]);

// Redireciona de volta para a lista de consultas após a exclusão
header('Location: index-consulta.php');
exit();
?>
