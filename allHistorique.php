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

// Fetch commandes
$commandeQuery = "SELECT * FROM commande";
$commandeResult = $conn->query($commandeQuery);

$commandes = [];
if ($commandeResult->num_rows > 0) {
    while ($row = $commandeResult->fetch_assoc()) {
        $commandes[] = $row;
    }
}

echo json_encode(['commandes' => $commandes]);

$conn->close();
?>
