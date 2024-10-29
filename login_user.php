<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT UsuarioID, NombreUsuario, ContrasenaHash, Perfil FROM Usuarios WHERE NombreUsuario = ? AND EsEliminado = 0";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['ContrasenaHash'])) {
            echo "Login successful. Welcome, " . $user['NombreUsuario'];
            // Record login success in LogsAcceso
            $logSql = "INSERT INTO LogsAcceso (UsuarioID, Accion, Exitoso) VALUES (?, 'Login', 1)";
            $logStmt = $conn->prepare($logSql);
            $logStmt->bind_param("i", $user['UsuarioID']);
            $logStmt->execute();
            $logStmt->close();
        } else {
            echo "Invalid credentials.";
            // Record login failure in LogsAcceso
            $logSql = "INSERT INTO LogsAcceso (UsuarioID, Accion, Exitoso, Mensaje) VALUES (?, 'Login', 0, 'Incorrect password')";
            $logStmt = $conn->prepare($logSql);
            $logStmt->bind_param("i", $user['UsuarioID']);
            $logStmt->execute();
            $logStmt->close();
        }
    } else {
        echo "User not found.";
    }

    $stmt->close();
}
?>