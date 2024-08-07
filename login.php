<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Login Page</title>
    <style>
        body { 
            background-color: rgb(91, 139, 139);
        }
        /* .container {
            margin-top: 50px;
        } */
    
    </style>
</head>
<body>

  <?php 
  include "navbar0.php";
  ?>

  <div class="container" id="ajout1">
    <div class="row">
    <div class="offset-4 col-md-4 mt-3">
         <div class="card" style="width: 430px">
          <div class="card-header">
            <h2>CONNEXION</h2>
          </div>
          <div class="card-body">
              <img class=" mx-auto d-block rounded-circle card-img-top" src="user_icon11.jpg" style="width: 200px; height: 200px;">
              <form class="needs-validation" action="login.php" method="post" >
                <div class="mb-3">
                  <label for="email" class="form-label">EMAIL</label>
                  <input type="email" class="form-control" id="email" name="email" aria-describedby="name" required>
                  <div class="valid-feedback">
                    Looks good!
                  </div>
                  <div class="invalid-feedback">
                    Please fill username
                  </div>
                </div>
                <div class="mb-3">
                  <label for="password" class="form-label">PASSWORD</label>
                  <input type="password" class="form-control" id="password" name="pass" aria-describedby="price" required>
                  <div class="valid-feedback">
                    Looks good!
                  </div>
                  <div class="invalid-feedback">
                    Please fill the password
                  </div>
                </div>
                 <div class="row">
                   <div class="col d-grid">
                     <button id="Annul" type="reset" class="btn btn-danger  btn-block text-center">ANNULER</button>
                  </div>

                  <div class="col d-grid">
                    <button id="Ajout" type="submit" class="btn btn-success   btn-block text-center ">CONFIRMER</button> 
                  </div>

                </div>
              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>

</html>




<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["pass"];

    $servername = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "deliver";

    // Créer la connexion
    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

    // Vérifier la connexion
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Utiliser les instructions préparées pour prévenir les injections SQL
    $query = "SELECT * FROM Utilisateur WHERE email=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        // Si aucun user avec cet email n'est trouvé
        header("Location: login.php");  // Retourner au formulaire de login
        exit();
    } else {
        // Fetch user data
        $user = $result->fetch_assoc();

        // Vérifier le mot de passe
        if (password_verify($password, $user['password'])) {   // on compare le pass du form avec celle du base donne (hashed)
            // Check user role
            if ($user['role'] == '3') {
                header("Location: client0.php");  // Aller à la page commande pour les clients
            } else {
                // header("Location: crew.html");  // Aller à une autre page pour les non-clients
                header("Location: admin.php");  // Aller à une autre page pour les non-clients

            }
            exit();
        } else {
            // Mot de passe incorrect
            header("Location: login.php");  // Retourner au formulaire de login
            exit();
        }
    }

    $conn->close();
}
?>
