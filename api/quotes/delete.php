<?php
require '../../config/database.php';
require '../../utils/response.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    sendResponse(['error' => 'ID is required'], 400);
}

try {
    $stmt = $pdo->prepare("DELETE FROM quotes WHERE id = ?");
    $stmt->execute([$id]);
    sendResponse(['message' => 'Opération réussi avec seulement ']);
} catch (Exception $e) {
    sendResponse(['error' => $e->getMessage()], 500);
}
?>
