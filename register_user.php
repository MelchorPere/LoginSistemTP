<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $perfil = "Usuario";

    $sql = "INSERT INTO Usuarios (NombreUsuario, CorreoElectronico, ContrasenaHash, Perfil) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $username, $email, $password, $perfil);

    if ($stmt->execute()) {
        echo "User registered successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>