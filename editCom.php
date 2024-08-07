<?php
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "deliver";

$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$code = isset($_GET['code']) ? $_GET['code'] : null;
$commande = null;

if ($code) {
    $stmt = $conn->prepare("SELECT * FROM commande WHERE code = ?");
    $stmt->bind_param("i", $code);
    $stmt->execute();
    $result = $stmt->get_result();
    $commande = $result->fetch_assoc();
}

if (!$commande) {
    echo "Commande not found.";
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <title>Edit Commande</title>
  <style>
    body { 
            background-color: rgb(91, 139, 139);
        }
</style>
</head>
<body>
  <div class="container" id="ajout1">
    <div class="row">
      <div class="offset-4 mt-5 mb-5">
        <div class="card" style="width: 350px">
          <div class="card-header">
            <h2>Edit Commande</h2>
          </div>
          <div class="card-body">
            <form class="needs-validation" action="updateCom.php" method="post">
              <input type="hidden" name="code" value="<?php echo $commande['code']; ?>">
              
              <div class="mb-3">
                
              </div>
              





 
            <!-- <div >
              <img class=" mx-auto d-block rounded-circle card-img-top" src="admin-user-icon.webp" style="width: 150px; height: 150px;">
            </div> -->
             
            <div class="row mt-3">
                <label for="nom_complet" class="form-label">noUtilisateur</label>
                <input type="text" class="form-control form-control-sm" id="noUtilisateur" name="noUtilisateur" value="<?php echo $commande['noUtilisateur']; ?>" required>
                <div class="valid-feedback">Looks good!</div>
                <div class="invalid-feedback">Veuillez entrer le nom complet.</div>
              </div>

              <div class="row mt-3">
                <label for="nom_complet" class="form-label">Nom Complet</label>
                <input type="text" class="form-control form-control-sm" id="nom_complet" name="nom_complet" value="<?php echo $commande['nom_complet']; ?>" required>
                <div class="valid-feedback">Looks good!</div>
                <div class="invalid-feedback">Veuillez entrer le nom complet.</div>
              </div>
                   
                  <div class="col">
                  <label for="gouvernerat" class="form-label">Gouvernerat</label>
                <input type="text" class="form-control form-control-sm" id="gouvernerat" name="gouvernerat" value="<?php echo $commande['gouvernerat']; ?>" required>
                <div class="valid-feedback">Looks good!</div>
                <div class="invalid-feedback">Veuillez entrer le gouvernerat.</div>

                <div class="col">
                  <label for="deleg" class="form-label">Delegation</label>
                <input type="text" class="form-control form-control-sm" id="deleg" name="delegation" value="<?php echo $commande['delegation']; ?>" required>
                <div class="valid-feedback">Looks good!</div>
                <div class="invalid-feedback">Veuillez entrer le gouvernerat.</div>
                
            


              <div class="row mt-3">
                  <div class="col">
                      <label for="locid" class="form-label">LOCALITE</label>
                      <input type="text" id="locid" name="localite" placeholder="saisir..." class="form-control form-control-sm"  value="<?php echo $commande['localite']; ?>" required>
                  </div>
                  <div class="col">
                      <label for="adressid" class="form-label">ADRESSE COMPLEMENTAIRE</label>
                      <input type="text" id="adressid" name="adresse_complementaire"  class="form-control form-control-sm" value="<?php echo $commande['adresse_complementaire']; ?>"  required>
                  </div>
              </div>

              <div class="row mt-3">

                <div class="col ">
                    <div class="form-group">
                        <label for="phoneNumber">Numéro de téléphone 1</label>
                        <input type="text"  name="telephone" class="form-control form-control-sm phone-input" id="phoneNumber" placeholder="nn nnn nnn"   value="<?php echo $commande['telephone']; ?>" required>
                    </div>
                </div>

                <div class="col ">
                    <div class="form-group">
                        <label for="phoneNumber">Numéro de téléphone 2</label>
                        <input type="text"  name="telephone2" class="form-control form-control-sm phone-input" id="phoneNumber" placeholder="nn nnn nnn"  value="<?php echo $commande['telephone2']; ?>">
                    </div>
                </div>
            </div>
              <div class="row mt-3">
                  <div class="col">
                      <label for="designationid" class="form-label">DESIGNATION</label>
                      <input type="text" id="designationid" name="designation" placeholder="saisir..." class="form-control form-control-sm"    value="<?php echo $commande['designation']; ?>" required>
                  </div>
                  <div class="col">
                      <label for="numid" class="form-label">NOMBRE D'ARTICLE</label>
                      <input type="number" id="numid" name="nombre_article" placeholder="quantitue..." class="form-control form-control-sm"  value="<?php echo $commande['nombre_article']; ?>" required>
                  </div>
              </div>
            
              <div class="row mt-3 mb-3">
                  <div class="col-9">
                          <label for="idcode" class="form-label">PRIX</label>
                          <input type="number" id="idcode" name="prix" placeholder="veuillez saisir les frais de livraison" class="form-control form-control-sm" value="<?php echo $commande['prix']; ?>" required>
                  </div>
              </div>

              <div class="row">
                  <div class="col-9">
                      <div class="mt-3">
                          <label for="idcomment" class="form-label">COMMENTAIRE : </label><br>
                         <textarea id="idcomments" name="commentaire" rows="4" cols="50" placeholder="veuillez saisir votre commentaire" class="form-control form-control-sm" value="<?php echo $commande['commentaire']; ?>"></textarea><br>
                         </div>
                  </div>
              </div>






              <button id="Annul" type="reset" class="btn btn-danger text-center">Annuler</button>
              <button id="Ajout" type="submit" class="btn btn-success text-center">Valider</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
