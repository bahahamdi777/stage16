<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve POST data
    $noUtilisateur = isset($_POST['noUtilisateur']) ? $_POST['noUtilisateur'] : null;
    $code = isset($_POST['code']) ? $_POST['code'] : null;
    $nom_complet = isset($_POST['nom_complet']) ? $_POST['nom_complet'] : null;
    $gouvernerat = isset($_POST['gouvernerat']) ? $_POST['gouvernerat'] : null;
    $delegation = isset($_POST['delegation']) ? $_POST['delegation'] : null;
    $localite = isset($_POST['localite']) ? $_POST['localite'] : null;
    $adresse_complementaire = isset($_POST['adresse_complementaire']) ? $_POST['adresse_complementaire'] : null;
    $telephone = isset($_POST['telephone']) ? $_POST['telephone'] : null;
    $telephone2 = isset($_POST['telephone2']) ? $_POST['telephone2'] : null;
    $designation = isset($_POST['designation']) ? $_POST['designation'] : null;
    $nombre_article = isset($_POST['nombre_article']) ? $_POST['nombre_article'] : null;
    $prix = isset($_POST['prix']) ? $_POST['prix'] : null;
    $commentaire = isset($_POST['commentaire']) ? $_POST['commentaire'] : null;

    // Check required fields
    if (empty($nom_complet) || empty($gouvernerat) || empty($delegation) || empty($localite) || empty($adresse_complementaire) || empty($telephone) || empty($designation) || empty($nombre_article) || empty($prix) || empty($code)) {
        echo "<div class='alert alert-danger' role='alert'>Veuillez remplir tous les champs.</div>";
        exit();
    }

    $servername = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "deliver";

    // Create connection
    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("UPDATE commande SET   noUtilisateur=?,  nom_complet=?, gouvernerat=?, delegation=?, localite=?, adresse_complementaire=?, telephone=?, telephone2=?, designation=?, nombre_article=?, prix=?, commentaire=? WHERE code=?");
    $stmt->bind_param("issssssssidsi", $noUtilisateur ,$nom_complet, $gouvernerat, $delegation, $localite, $adresse_complementaire, $telephone, $telephone2, $designation, $nombre_article, $prix, $commentaire, $code);

    // Execute the query
    if ($stmt->execute()) {
        // Update successful, redirect to appropriate page
        header("Location: allHistorique.html"); // Adjust the redirection as needed
        exit();
    } else {
        // Update failed
        echo "<div class='alert alert-danger' role='alert'>Echec de la mise à jour: " . $stmt->error . "</div>";
    }

    // Close the statement
    $stmt->close();
    
    // Close the connection
    $conn->close();
}
?>
