<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container auth-card">
        <header>
            <div>
                <h1>Login</h1>
                <p style="color: #64748b; margin: 8px 0 0;">Ingresa tus credenciales para continuar.</p>
            </div>
        </header>
        <?php
        session_start();
        if (isset($_SESSION['error'])) {
            echo '<div id="error">' . $_SESSION['error'] . '</div>';
            unset($_SESSION['error']);
        }
        ?>
        <form id="loginForm" action="check_login.php" method="POST">
            <div class="input-group">
                <label for="username">Usuario:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="input-group">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Iniciar Sesión</button>
        </form>
        <p class="login-note">Usuario de prueba: admin / Contraseña: admin123</p>
    </div>
    <script src="script.js"></script>
</body>
</html>