<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <title>Envoyer un Colis</title>
  <style>
        body { 
            background-color: rgb(91, 139, 139);
        }
  </style>
</head>
<body>
  <?php include "navbar2.php"; ?>

  <div class="container" id="ajout1">
    <div class="offset-3 mt-3 mb-3">
      <div class="card" style="width: 600px">
        <div class="card-header">
          <h2>Envoyer un Colis</h2>
        </div>
        <div class="card-body">
          <form class="needs-validation" action="commande.php" method="post">
            <input type="hidden" name="noUtilisateur" value="<?php echo isset($noUtilisateur) ? $noUtilisateur : ''; ?>">
            
              <div class="row mt-3">
                  <div class="col">
                      <label for="villeId" class="form-label">NOM COMPLET</label>
                      <input type="text" id="villeId" name="ville" class="form-control form-control-sm" required>
                  </div>
                  <div class="col">
                    <label for="stateid" class="form-label">GOUVERNERAT</label>
                    <select name="state" id="stateid" class="form-select form-select-sm" required>
                        <option selected disabled>Choisissez...</option>
                        <option value="Tunis">Tunis</option>
                        <option value="Ariana">Ariana</option>
                        <option value="Ben Arous">Ben Arous</option>
                        <option value="Manouba">Manouba</option>
                        <option value="Nabeul">Nabeul</option>
                        <option value="Zaghouan">Zaghouan</option>
                        <option value="Bizerte">Bizerte</option>
                        <option value="Béja">Béja</option>
                        <option value="Jendouba">Jendouba</option>
                        <option value="Kef">Kef</option>
                        <option value="Siliana">Siliana</option>
                        <option value="Kairouan">Kairouan</option>
                        <option value="Kasserine">Kasserine</option>
                        <option value="Sidi Bouzid">Sidi Bouzid</option>
                        <option value="Sousse">Sousse</option>
                        <option value="Monastir">Monastir</option>
                        <option value="Mahdia">Mahdia</option>
                        <option value="Gabès">Gabès</option>
                        <option value="Médenine">Médenine</option>
                        <option value="Tataouine">Tataouine</option>
                        <option value="Tozeur">Tozeur</option>
                        <option value="Gafsa">Gafsa</option>
                        <option value="El Kef">El Kef</option>
                        <option value="La Manouba">La Manouba</option>
                    </select>
                </div>
                <div class="col">
                    <label for="delegationid" class="form-label">DELEGATION</label>
                    <select name="delegation" id="delegationid" class="form-select form-select-sm" required>
                        <option selected disabled>Choisissez...</option>
                    </select>
                </div>
                
            
              <div class="row mt-3">
                  <div class="col">
                      <label for="locid" class="form-label">LOCALITE</label>
                      <input type="text" id="locid" name="local" placeholder="saisir..." class="form-control form-control-sm" required>
                  </div>
                  <div class="col">
                      <label for="adressid" class="form-label">ADRESSE COMPLEMENTAIRE</label>
                      <input type="text" id="adressid" name="adresse" placeholder="Cité..." class="form-control form-control-sm" required>
                  </div>
              </div>

              <div class="row mt-3">

                <div class="col ">
                    <div class="form-group">
                        <label for="phoneNumber">Numéro de téléphone 1</label>
                        <input type="text"  name="telephone" class="form-control form-control-sm phone-input" id="phoneNumber" placeholder="nn nnn nnn" required>
                    </div>
                </div>

                <div class="col ">
                    <div class="form-group">
                        <label for="phoneNumber">Numéro de téléphone 2</label>
                        <input type="text"  name="telephone2" class="form-control form-control-sm phone-input" id="phoneNumber" placeholder="nn nnn nnn" >
                    </div>
                </div>
            </div>
              <div class="row mt-3">
                  <div class="col">
                      <label for="designationid" class="form-label">DESIGNATION</label>
                      <input type="text" id="designationid" name="designation" placeholder="saisir..." class="form-control form-control-sm" required>
                  </div>
                  <div class="col">
                      <label for="numid" class="form-label">NOMBRE D'ARTICLE</label>
                      <input type="number" id="numid" name="nombre_article" placeholder="quantitue..." class="form-control form-control-sm" required>
                  </div>
              </div>
            
              <div class="row mt-3 mb-3">
                  <div class="col-9">
                          <label for="idcode" class="form-label">PRIX</label>
                          <input type="number" id="idcode" name="prix" placeholder="veuillez saisir les frais de livraison" class="form-control form-control-sm" required>
                  </div>
              </div>

              <div class="row">
                  <div class="col-9">
                      <div class="mt-3">
                          <label for="idcomment" class="form-label">COMMENTAIRE : </label><br>
                         <textarea id="idcomments" name="commentaire" rows="4" cols="50" placeholder="veuillez saisir votre commentaire" class="form-control form-control-sm"></textarea><br>
                         </div>
                  </div>
              </div>

            <div class="row"> 
              <div class="col d-grid">
                  <button class="btn btn-success btn-block mt-3" type="submit">VALIDER</button>
              </div>
              <div class="col d-grid">
                  <button class="btn btn-danger btn-block mt-3" type="reset">ANNULER</button>
              </div>
            </div>


            </form>
             



        </div>
      </div>
    </div>
  </div>

  <script src="commande.js"></script>
</body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $noUtilisateur = isset($_POST['noUtilisateur']) ? $_POST['noUtilisateur'] : null;
    $nom_complet = isset($_POST['ville']) ? $_POST['ville'] : null;
    $gouvernerat = isset($_POST['state']) ? $_POST['state'] : null;
    $delegation = isset($_POST['delegation']) ? $_POST['delegation'] : null;
    $localite = isset($_POST['local']) ? $_POST['local'] : null;
    $adresse_complementaire = isset($_POST['adresse']) ? $_POST['adresse'] : null;
    $telephone = isset($_POST['telephone']) ? $_POST['telephone'] : null;
    $telephone2 = isset($_POST['telephone2']) ? $_POST['telephone2'] : null;
    $designation = isset($_POST['designation']) ? $_POST['designation'] : null;
    $nombre_article = isset($_POST['nombre_article']) ? $_POST['nombre_article'] : null;
    $prix = isset($_POST['prix']) ? $_POST['prix'] : null;
    $commentaire = isset($_POST['commentaire']) ? $_POST['commentaire'] : null;

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

    // Ensure the form fields are not empty
    // if ($nom_complet && $gouvernerat && $delegation && $localite && $adresse_complementaire && $telephone && $designation && $nombre_article && $prix) {
        if ($noUtilisateur) {
            $stmt = $conn->prepare("INSERT INTO commande (noUtilisateur, nom_complet, gouvernerat, delegation, localite, adresse_complementaire, telephone, telephone2, designation, nombre_article, prix, commentaire) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("isssssssisds", $noUtilisateur, $nom_complet, $gouvernerat, $delegation, $localite, $adresse_complementaire, $telephone, $telephone2, $designation, $nombre_article, $prix, $commentaire);
        } else {
            $stmt = $conn->prepare("INSERT INTO commande (nom_complet, gouvernerat, delegation, localite, adresse_complementaire, telephone, telephone2, designation, nombre_article, prix, commentaire) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssssssiss", $nom_complet, $gouvernerat, $delegation, $localite, $adresse_complementaire, $telephone, $telephone2, $designation, $nombre_article, $prix, $commentaire);
        }

        if ($stmt->execute()) {
            echo "Commande ajoutée avec succès";
            exit();
        } else {
            echo "Echec d'ajout: " . $stmt->error;
        }

        $stmt->close();
    // } else {
    //     echo "Veuillez remplir tous les champs.";
    // }

    $conn->close();
}
?>
