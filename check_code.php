<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $code = isset($_POST['code']) ? $_POST['code'] : '';

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

    $stmt = $conn->prepare("SELECT * FROM utilisateur WHERE code = ?");
    $stmt->bind_param("s", $code);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        echo 'unique';
    } else {
        echo 'not unique';
    }

    $stmt->close();
    $conn->close();
}
?>
