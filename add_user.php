<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: index.php');
    exit;
}

require 'config.php';

$username = trim($_POST['username']);
$password = trim($_POST['password']);

if (empty($username) || empty($password)) {
    $_SESSION['error'] = 'Complete todos los campos para crear el usuario.';
    header('Location: dashboard.php');
    exit;
}

try {
    $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE username = ?");
    $stmt->execute([$username]);
    if ($stmt->fetch()) {
        $_SESSION['error'] = 'El nombre de usuario ya existe.';
        header('Location: dashboard.php');
        exit;
    }

    $stmt = $pdo->prepare("INSERT INTO usuarios (username, password) VALUES (?, ?)");
    $stmt->execute([$username, $password]);
    $_SESSION['success'] = 'Usuario admin creado correctamente.';
    header('Location: dashboard.php');
} catch (PDOException $e) {
    $_SESSION['error'] = 'Error al crear usuario: ' . $e->getMessage();
    header('Location: dashboard.php');
}
?>