<?php
header('Content-Type: application/json');

$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "deliver";

$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

if ($conn->connect_error) {
    die(json_encode(['error' => 'Connection failed: ' . $conn->connect_error]));
}

// Get noUtilisateur from the query parameters
if (!isset($_GET['noUtilisateur'])) {
    echo json_encode(['error' => 'Utilisateur non authentifié.']);
    exit();
}

$noUtilisateur = intval($_GET['noUtilisateur']);

// Fetch commandes for the given user
$commandeQuery = "SELECT * FROM commande WHERE noUtilisateur = ?";
$stmt = $conn->prepare($commandeQuery);
$stmt->bind_param("i", $noUtilisateur);
$stmt->execute();
$result = $stmt->get_result();

$commandes = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $commandes[] = $row;
    }
}

echo json_encode(['commandes' => $commandes]);

$stmt->close();
$conn->close();
?>
