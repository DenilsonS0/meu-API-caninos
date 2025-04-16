<?php
require_once 'conexao.php';
header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        $stmt = $pdo->query("SELECT * FROM doacoes");
        echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
        break;
    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);
        $stmt = $pdo->prepare("INSERT INTO doacoes (valor, doador) VALUES (?, ?)");
        $stmt->execute([$data['valor'], $data['doador']]);
        echo json_encode(['success' => 'Doação cadastrada']);
        break;
    case 'DELETE':
        $data = json_decode(file_get_contents('php://input'), true);
        $stmt = $pdo->prepare("DELETE FROM doacoes WHERE id = ?");
        $stmt->execute([$data['id']]);
        echo json_encode(['success' => 'Doação removida']);
        break;
    default:
        echo json_encode(['error' => 'Método não permitido']);
}
?>
