<?php
require '../../config/database.php';
require '../../utils/response.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    sendResponse(['error' => 'ID is required'], 400);
}

try {
    $stmt = $pdo->prepare("SELECT * FROM quotes WHERE id = ?");
    $stmt->execute([$id]);
    $quote = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$quote) {
        sendResponse(['error' => 'Quote not found'], 404);
    }

    sendResponse($quote);
} catch (Exception $e) {
    sendResponse(['error' => $e->getMessage()], 500);
}
?>
