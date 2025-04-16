<?php
require_once 'conexao.php';
header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        $stmt = $pdo->query("SELECT * FROM adotantes");
        echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
        break;
    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);
        $stmt = $pdo->prepare("INSERT INTO adotantes (nome, contato) VALUES (?, ?)");
        $stmt->execute([$data['nome'], $data['contato']]);
        echo json_encode(['success' => 'Adotante cadastrado']);
        break;
    case 'PUT':
        $data = json_decode(file_get_contents('php://input'), true);
        $stmt = $pdo->prepare("UPDATE adotantes SET nome = ?, contato = ? WHERE id = ?");
        $stmt->execute([$data['nome'], $data['contato'], $data['id']]);
        echo json_encode(['success' => 'Adotante atualizado']);
        break;
    case 'DELETE':
        $data = json_decode(file_get_contents('php://input'), true);
        $stmt = $pdo->prepare("DELETE FROM adotantes WHERE id = ?");
        $stmt->execute([$data['id']]);
        echo json_encode(['success' => 'Adotante removido']);
        break;
    default:
        echo json_encode(['error' => 'Método não permitido']);
}
?>
