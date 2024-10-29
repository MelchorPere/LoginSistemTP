<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Inicio - Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="buttons-container">
        <button onclick="showForm('loginContainer')">Login</button>
        <button onclick="showForm('registerContainer')">Registro</button>
    </div>

    <div id="loginContainer" class="container">
        <h2>Login</h2>
        <form method="POST" action="login_user.php">
            <label for="username">Nombre de Usuario:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit" name="login">Iniciar Sesión</button>
        </form>
    </div>

    <div id="registerContainer" class="container">
        <h2>Registro</h2>
        <form method="POST" action="register_user.php">
            <label for="reg_username">Nombre de Usuario:</label>
            <input type="text" id="reg_username" name="username" required>

            <label for="reg_email">Correo Electrónico:</label>
            <input type="email" id="reg_email" name="email" required>

            <label for="reg_password">Contraseña:</label>
            <input type="password" id="reg_password" name="password" required>

            <button type="submit" name="register">Registrarse</button>
        </form>
    </div>

    <script src="scripts.js"></script>
</body>
</html>