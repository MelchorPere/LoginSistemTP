<?php
include 'db_connection.php';
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}

// Fetch logs from database
$sqlLogs = "SELECT Accion, NombreUsuario, FechaHora, Mensaje FROM LogsAcceso INNER JOIN Usuarios ON LogsAcceso.UsuarioID = Usuarios.UsuarioID ORDER BY FechaHora DESC";
$resultLogs = $conn->query($sqlLogs);

// Fetch users from database
$sqlUsers = "SELECT UsuarioID, NombreUsuario, CorreoElectronico, Perfil FROM Usuarios WHERE EsEliminado = 0";
$resultUsers = $conn->query($sqlUsers);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BD Estudiantes - Ingreso</title>
    <link rel="stylesheet" href="styles-home.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">
    <script>
        function openPopup(nombre, email) {
            alert("Editar usuario: " + nombre + "\nCorreo: " + email);
        }
    </script>
</head>
<body style="margin: 0;">
    <div class="header-home">
        <nav class="nav-menu">
            <div class="logo-unso">
                <img src="img/logo-unso1.png" alt="logo-unso-san-isidro" width="250">
            </div>
            <div class="btn-log-out">
                <a href="logout.php">Cerrar sesión</a>
            </div>
        </nav>
    </div>

    <div class="conteiner-home">
        <h1>BD ESTUDIANTES</h1>
        <h2 class="title-h2">Bienvenido/a <?php echo htmlspecialchars($_SESSION['usuario']); ?></h2>
        <h3 class="logs">Logs</h3>
        <table class="styled-table">
            <thead>
              <tr>
                <th>Accion</th>
                <th>Mensaje</th>
                <th>Nombre</th>
                <th>Date</th>
              </tr>
            </thead>
            <tbody>
              <?php if ($resultLogs->num_rows > 0): ?>
                  <?php while ($row = $resultLogs->fetch_assoc()): ?>
                      <tr>
                          <td><?php echo htmlspecialchars($row['Accion']); ?></td>
                          <td><?php echo htmlspecialchars($row['Mensaje']); ?></td>
                          <td><?php echo htmlspecialchars($row['NombreUsuario']); ?></td>
                          <td><?php echo htmlspecialchars($row['FechaHora']); ?></td>
                      </tr>
                  <?php endwhile; ?>
              <?php else: ?>
                  <tr>
                      <td colspan="4">No hay registros de logs.</td>
                  </tr>
              <?php endif; ?>
            </tbody>
        </table>

        <h3 class="users">Usuarios Registrados</h3>
        <table class="user-table">
            <thead>
              <tr>
                <th>ID</th>
                <th>Nombre y apellido</th>
                <th>Correo electrónico</th>
                <th>Perfil</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              <?php if ($resultUsers->num_rows > 0): ?>
                  <?php while ($row = $resultUsers->fetch_assoc()): ?>
                      <tr>
                          <td><?php echo htmlspecialchars($row['UsuarioID']); ?></td>
                          <td><?php echo htmlspecialchars($row['NombreUsuario']); ?></td>
                          <td><?php echo htmlspecialchars($row['CorreoElectronico']); ?></td>
                          <td><?php echo htmlspecialchars($row['Perfil']); ?></td>
                          <td>
                              <a href="#" class="user-delete">Desactivar (no disponible)</a>
                          </td>
                      </tr>
                  <?php endwhile; ?>
              <?php else: ?>
                  <tr>
                      <td colspan="5">No hay usuarios registrados.</td>
                  </tr>
              <?php endif; ?>
            </tbody>
        </table>          
    </div>
</body>
</html>

<?php
$conn->close();
?>