<?php
require_once 'conexao.php';
header('Content-Type: application/json');

$termo = $_GET['termo'] ?? '';
$stmt = $pdo->prepare("SELECT * FROM animais WHERE nome LIKE ?");
$stmt->execute(['%' . $termo . '%']);
echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
?>
