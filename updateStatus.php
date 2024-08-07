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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $code = $_POST['code'];
    $status = $_POST['status'];

    $stmt = $conn->prepare("UPDATE commande SET status = ? WHERE code = ?");
    $stmt->bind_param("si", $status, $code);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['error' => 'Erreur lors de la mise à jour du statut.']);
    }

    $stmt->close();
}

$conn->close();
?>
