<?php
require '../../config/database.php';
require '../../utils/response.php';

try {
    $stmt = $pdo->query("SELECT * FROM quotes");
    $quotes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    sendResponse($quotes);
} catch (Exception $e) {
    sendResponse(['error' => $e->getMessage()], 500);
}
?>
