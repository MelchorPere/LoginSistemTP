<?php
include 'db_connection.php';
session_start(); // Iniciar sesión para guardar los datos del usuario

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT UsuarioID, NombreUsuario, ContrasenaHash, Perfil FROM Usuarios WHERE CorreoElectronico = ? AND EsEliminado = 0";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['ContrasenaHash'])) {
            $_SESSION['usuario'] = $user['NombreUsuario'];
            $_SESSION['perfil'] = $user['Perfil'];

            $logSql = "INSERT INTO LogsAcceso (UsuarioID, Accion, Exitoso, Mensaje) VALUES (?, 'Login', 1, 'Login exitoso')";
            $logStmt = $conn->prepare($logSql);
            $logStmt->bind_param("i", $user['UsuarioID']);
            $logStmt->execute();
            $logStmt->close();

            if ($user['Perfil'] === 'Administrador') {
                header("Location: home_admin.php");
            } else {
                header("Location: home_user.php");
            }
            exit(); 
        } else {
            echo "Invalid credentials.";
            $logSql = "INSERT INTO LogsAcceso (UsuarioID, Accion, Exitoso, Mensaje) VALUES (?, 'Login', 0, 'Credenciales incorrectass')";
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
