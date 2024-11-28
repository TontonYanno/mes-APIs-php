<?php
require '../../config/database.php'; // Connexion à la base de données
require '../../utils/response.php'; // Pour formater les réponses JSON

// Récupérer les données envoyées via la requête HTTP (corps JSON)
$data = json_decode(file_get_contents('php://input'), true);

// Vérification des champs obligatoires
if (!isset($data['author']) || !isset($data['content'])) {
    sendResponse(['error' => 'Author and content fields are required'], 400);
    exit;
}

// Préparer et exécuter l'insertion dans la base de données
try {
    $stmt = $pdo->prepare("INSERT INTO quotes (author, content) VALUES (?, ?)");
    $stmt->execute([$data['author'], $data['content']]);
    
    // Retourner une réponse de succès avec l'ID de la citation ajoutée
    sendResponse([
        'message' => 'Opération réussi avec succès ',
        'id' => $pdo->lastInsertId()
    ], 201);
} catch (Exception $e) {
    // Gestion des erreurs d'insertion
    sendResponse(['error' => 'Database error: ' . $e->getMessage()], 500);
}
?>
