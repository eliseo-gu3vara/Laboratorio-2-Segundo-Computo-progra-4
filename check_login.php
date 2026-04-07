<?php
session_start();
require 'config.php';

$username = $_POST['username'];
$password = $_POST['password'];

try {
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE username = ? AND password = ?");
    $stmt->execute([$username, $password]);
    $user = $stmt->fetch();

    if ($user) {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        header('Location: dashboard.php');
    } else {
        $_SESSION['error'] = 'Usuario o contraseña incorrectos';
        header('Location: index.php');
    }
} catch (PDOException $e) {
    $_SESSION['error'] = 'Error en la base de datos: ' . $e->getMessage();
    header('Location: index.php');
}
?>