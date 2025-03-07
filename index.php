<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BD Estudiantes - Ingreso</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
    <div class="header-login">
        <div><h1>|||||||| BD ESTUDIANTES</h1></div>
    </div>

    <div class="conteiner-login-main">
        <div class="logo-unso"><img src="https://www.unso.edu.ar/assets/images/logo-blanco.png" alt="logo-unso-san-isidro" width="300"></div>
        <h2>Ingresa tu cuenta</h2>
        <div class="form-login">
            <form method="POST" action="login_user.php">
                <input type="email" placeholder="Correo electrónico" aria-label="Correo electrónico"  name="email" required>
                <input type="password" placeholder="Contraseña" aria-label="Contraseña"  name="password" required>
                <button type="submit" class="btn-ingresar" name="login">Ingresar</button>
            </form>
            <a href="sign-up.html" class="btn-external-link">Regístrate</a><br>
            <a href="recovery.html" target="_blank" class="btn-external-link">¿Olvidaste tu contraseña?</a>
        </div>
    </div>
</body>
</html>
