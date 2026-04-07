<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: index.php');
    exit;
}

require 'config.php';

try {
    $stmt = $pdo->query("SELECT name, age, email FROM datos ORDER BY id DESC");
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmtUsers = $pdo->query("SELECT username FROM usuarios ORDER BY id DESC");
    $users = $stmtUsers->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $data = [];
    $users = [];
    // Opcional: mostrar error
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <header>
            <div>
                <h1>Bienvenido, <?php echo $_SESSION['username']; ?></h1>
                <p style="color: #64748b; margin: 8px 0 0;">Administra informacion de estudiantes de forma segura y rápida.</p>
            </div>
            <a class="logout-link" href="logout.php">Cerrar Sesión</a>
        </header>
        <?php
        if (isset($_SESSION['error'])) {
            echo '<div class="message error">' . $_SESSION['error'] . '</div>';
            unset($_SESSION['error']);
        }
        if (isset($_SESSION['success'])) {
            echo '<div class="message success">' . $_SESSION['success'] . '</div>';
            unset($_SESSION['success']);
        }
        ?>
        <div class="card">
            <h2>Ingresar Datos</h2>
            <form id="dataForm" action="save_data.php" method="POST">
                <div>
                    <label for="name">Nombre:</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div>
                    <label for="age">Edad:</label>
                    <input type="number" id="age" name="age" required min="1" max="120">
                </div>
                <div>
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <button type="submit">Guardar</button>
            </form>
        </div>
        <div class="card" style="margin-top: 24px;">
            <h2>Agregar Usuario Admin</h2>
            <form id="addUserForm" action="add_user.php" method="POST">
                <div>
                    <label for="new_username">Usuario:</label>
                    <input type="text" id="new_username" name="username" required>
                </div>
                <div>
                    <label for="new_password">Contraseña:</label>
                    <input type="password" id="new_password" name="password" required>
                </div>
                <button type="submit">Crear Usuario</button>
            </form>
        </div>
        <div class="card" style="margin-top: 24px;">
            <h2>Usuarios Admin</h2>
            <table id="usersTable">
                <thead>
                    <tr>
                        <th>Usuario</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($user['username']); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="card" style="margin-top: 24px;">
            <h2>Datos Ingresados</h2>
            <table id="dataTable">
                <thead>
                    <tr>
                        <th onclick="sortTable(0)">Nombre</th>
                        <th onclick="sortTable(1)">Edad</th>
                        <th onclick="sortTable(2)">Email</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $row): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td><?php echo htmlspecialchars($row['age']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>