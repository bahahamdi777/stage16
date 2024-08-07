<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <title>Request Form</title>
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
  include "navbar.php";
  ?>
  <div class="container">
    <div class="row">
      <div class="offset-4 col-md-4 mt-3 mb-3">
         <div class="card" style="width: 430px">
          <div class="card-header">
            <h2>DEMANDE D INSCRIPTION</h2>
          </div>
          <div class="card-body">
            
            <form action="request.php" method="post">
              <div class="mb-3">
                <label for="name" class="form-label">Username</label>
                <input type="text" class="form-control form-control-sm" id="name" name="username" required>
              </div>

               
              <div class="mb-3">
                <label for="gsm" class="form-label">GSM</label>
                <input type="text" class="form-control form-control-sm" id="gsm" name="gsm" required>
              </div>
              
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control form-control-sm" id="email" name="email" required>
              </div>

              <div class="mb-3">
                <label for="comment" class="form-label">Commentaire</label>
                <input type="text" class="form-control form-control-sm" id="comment" name="comment">
              </div>

              <div class="d-grid">
                <button type="submit" class="btn btn-success btn-block text-center">Submit</button>
              <div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>




<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = isset($_POST['username']) ? $_POST['username'] : null;

    $gsm = isset($_POST['gsm']) ? $_POST['gsm'] : null;
    $email = isset($_POST['email']) ? $_POST['email'] : null;
    $comment = isset($_POST['comment']) ? $_POST['comment'] : null;


  
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

    // Insert the request into the user_request table
    $stmt = $conn->prepare("INSERT INTO user_request (username, gsm, email,comment) VALUES (?, ?, ?,?)");
    $stmt->bind_param("ssss", $username, $gsm, $email,$comment);

    if ($stmt->execute()) {
        echo "Request submitted successfully.";
        header("Location: home.php");
        exit();
    } else {
        echo "Failed to submit request: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
