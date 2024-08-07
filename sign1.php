<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <title>Ajouter un utilisateur</title>
  <style>
    body { 
      background-color: rgb(91, 139, 139);
    }
  </style>
</head>
<body>
  <?php include "navbar3.php"; ?>
  <div class="container" id="ajout1">
    <div class="row">
      <div class="offset-4 col-md-4 mt-3">
        <div class="card" style="width: 430px">
          <div class="card-header">
            <h2>Ajouter un utilisateur</h2>
          </div>
          <div class="card-body">
            <div>
              <img class="mx-auto d-block rounded-circle card-img-top" src="admin-user-icon.webp" style="width: 150px; height: 150px;">
            </div>
            <form class="needs-validation" action="sign1.php" method="post" novalidate>
              <div class="mb-3">
                <label for="name" class="form-label">USERNAME</label>
                <input type="text" class="form-control form-control-sm" id="name" name="nom" required>
                <div class="valid-feedback">
                  Looks good!
                </div>
                <div class="invalid-feedback">
                  Veuillez taper son username
                </div>
              </div>

              <div class="mb-3">
                <label for="password" class="form-label">PASSWORD</label>
                <input type="password" class="form-control form-control-sm" id="password" name="pass" required>
                <div class="valid-feedback">
                  Looks good!
                </div>
                <div class="invalid-feedback">
                  Veuillez taper son mot de passe
                </div>
              </div>

              <div class="mb-3">
                <label for="codeid" class="form-label">CODE A BARRE</label>
                <div class="input-group">
                    <input type="text" class="form-control form-control-sm" id="codeid" name="code" aria-describedby="codee" required>
                    <button type="button" class="btn btn-secondary" id="generateCode">Générer</button>
                </div>
                <div class="valid-feedback">
                  Looks good!
                </div>
                <div class="invalid-feedback">
                  Veuillez taper son code à barre
                </div>
              </div>

              <div class="mb-3">
                <label for="Categorie" class="form-label">ROLE</label>
                <select class="form-select" id="Categorie" name="ROLE" required>
                  <option value="" selected disabled hidden>Veuillez mentionner son rôle</option>
                  <option value="1">Admin</option>
                  <option value="2">Employee</option>
                  <option value="3">Client</option>
                </select>
                <div class="valid-feedback">
                  Looks good!
                </div>
                <div class="invalid-feedback">
                  Veuillez sélectionner un rôle.
                </div>
              </div>

              <div class="mb-3">
                <label for="numero" class="form-label">GSM</label>
                <input type="text" class="form-control form-control-sm" id="numero" name="gsm" required>
                <div class="valid-feedback">
                  Looks good!
                </div>
                <div class="invalid-feedback">
                  Veuillez taper son numéro mobile.
                </div>
              </div>

              <div class="mb-3">
                <label for="email" class="form-label">EMAIL</label>
                <input type="email" class="form-control form-control-sm" id="email" name="email" required>
                <div class="valid-feedback">
                  Looks good!
                </div>
                <div class="invalid-feedback">
                  Veuillez taper son adresse email.
                </div>
              </div>

              <div class="row">
                <div class="col d-grid">
                  <button id="Annul" type="reset" class="btn btn-danger btn-block text-center">ANNULER</button>
                </div>
                <div class="col d-grid">
                  <button id="valid" type="submit" class="btn btn-success btn-block text-center">VALIDER</button> 
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    document.getElementById('generateCode').addEventListener('click', function() {
        function generateRandomCode() {
            var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            var code = '';
            for (var i = 0; i < 6; i++) {
                code += characters.charAt(Math.floor(Math.random() * characters.length));
            }
            return code;
        }

        function checkCodeUniqueness(code, callback) {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'check_code.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    callback(xhr.responseText == 'unique');
                }
            };
            xhr.send('code=' + code);
        }

        function generateUniqueCode() {
            var code = generateRandomCode();
            checkCodeUniqueness(code, function(isUnique) {
                if (isUnique) {
                    document.getElementById('codeid').value = code;
                } else {
                    generateUniqueCode();
                }
            });
        }

        generateUniqueCode();
    });
  </script>
</body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = isset($_POST['nom']) ? $_POST['nom'] : null;
    $code = isset($_POST['code']) ? $_POST['code'] : null;
    $password = isset($_POST['pass']) ? $_POST['pass'] : null;
    $role = isset($_POST['ROLE']) ? $_POST['ROLE'] : null;
    $gsm = isset($_POST['gsm']) ? $_POST['gsm'] : null;
    $email = isset($_POST['email']) ? $_POST['email'] : null;

    // Hash du mot de passe
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

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
    if ($username && $password && $role) {
        // Use prepared statements to prevent SQL injection
        $query = "SELECT * FROM utilisateur WHERE username=? OR email=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 0) {
            // No matching user found, insert new one
            $stmt = $conn->prepare("INSERT INTO utilisateur (username, code, password, role, gsm, email) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssss", $username, $code, $hashed_password, $role, $gsm, $email);

            if ($stmt->execute()) {
                echo "Ajout avec succès d'un utilisateur";
                exit();
            } else {
                echo "Échec d'ajout: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Utilisateur déjà existant.";
            exit();
        }
    } else {
        echo "Veuillez remplir tous les champs.";
    }

    $conn->close();
}
?>
