<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['create'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $perfil = $_POST['perfil'];

    $sql = "INSERT INTO Usuarios (NombreUsuario, CorreoElectronico, ContrasenaHash, Perfil) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $username, $email, $password, $perfil);

    if ($stmt->execute()) {
        echo "User created successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Read Users
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['read'])) {
    $sql = "SELECT UsuarioID, NombreUsuario, CorreoElectronico, Perfil, EstadoCuenta FROM Usuarios WHERE EsEliminado = 0";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "ID: " . $row['UsuarioID'] . " - Name: " . $row['NombreUsuario'] . " - Email: " . $row['CorreoElectronico'] . " - Profile: " . $row['Perfil'] . " - Status: " . $row['EstadoCuenta'] . "<br>";
        }
    } else {
        echo "No users found.";
    }
}

// Update User
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $userid = $_POST['userid'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $perfil = $_POST['perfil'];

    $sql = "UPDATE Usuarios SET NombreUsuario = ?, CorreoElectronico = ?, Perfil = ? WHERE UsuarioID = ? AND EsEliminado = 0";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $username, $email, $perfil, $userid);

    if ($stmt->execute()) {
        echo "User updated successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Delete User
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $userid = $_POST['userid'];

    $sql = "UPDATE Usuarios SET EsEliminado = 1 WHERE UsuarioID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userid);

    if ($stmt->execute()) {
        echo "User deleted successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>