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
} catch (PDOException $e) {
    $data = [];
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
        <h1>Bienvenido, <?php echo $_SESSION['username']; ?></h1>
        <a href="logout.php">Cerrar Sesión</a>
        <?php
        if (isset($_SESSION['error'])) {
            echo '<div id="error">' . $_SESSION['error'] . '</div>';
            unset($_SESSION['error']);
        }
        ?>
        <h2>Ingresar Datos</h2>
        <form id="dataForm" action="save_data.php" method="POST">
            <label for="name">Nombre:</label>
            <input type="text" id="name" name="name" required>
            <label for="age">Edad:</label>
            <input type="number" id="age" name="age" required min="1" max="120">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <button type="submit">Guardar</button>
        </form>
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
    <script src="script.js"></script>
</body>
</html>