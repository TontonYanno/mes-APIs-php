<?php
require '../../config/database.php';
require '../../utils/response.php';

$id = $_GET['id'] ?? null;
$data = json_decode(file_get_contents('php://input'), true);

if (!$id || !isset($data['author']) || !isset($data['content'])) {
    sendResponse(['error' => 'ID, author, and content are required'], 400);
}

try {
    $stmt = $pdo->prepare("UPDATE quotes SET author = ?, content = ? WHERE id = ?");
    $stmt->execute([$data['author'], $data['content'], $id]);
    sendResponse(['message' => 'Opération réussi avec succès ']);
} catch (Exception $e) {
    sendResponse(['error' => $e->getMessage()], 500);
}
?>
