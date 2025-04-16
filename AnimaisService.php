
<?php
require_once 'conexao.php';
header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        $stmt = $pdo->query("SELECT * FROM animais");
        echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
        break;
    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);
        $stmt = $pdo->prepare("INSERT INTO animais (nome, idade, porte,saude,foto) VALUES (?, ?, ?,?,?)");
        $stmt->execute([$data['nome'], $data['idade'], $data['porte'], $data['saude'], $data['foto']]);
        echo json_encode(['success' => 'Animal cadastrado']);
        break;
    case 'PUT':
        $data = json_decode(file_get_contents('php://input'), true);
        $stmt = $pdo->prepare("UPDATE animais SET nome = ?, idade = ?, porte = ?,saude=?,foto=? WHERE id = ?");
        $stmt->execute([$data['nome'],$data['idade'],$data['porte'],$data['saude'],$data['foto'],$data['id']]);
        echo json_encode(['success' => 'Animal atualizado']);
        break;
    case 'DELETE':
        $data = json_decode(file_get_contents('php://input'), true);
        $stmt = $pdo->prepare("DELETE FROM animais WHERE id = ?");
        $stmt->execute([$data['id']]);
        echo json_encode(['success' => 'Animal removido']);
        break;
    default:
        echo json_encode(['error' => 'Método não permitido']);
}
?>
