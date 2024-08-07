<?php
$host = 'localhost';
$db = 'deliver';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_POST['code'])) {
        $sql = "DELETE FROM commande WHERE code = :code";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':code', $_POST['code'], PDO::PARAM_INT);

        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['error' => 'Erreur lors de la suppression de la commande.']);
        }
    } else {
        echo json_encode(['error' => 'Code de la commande manquant.']);
    }
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
