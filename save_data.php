<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: index.php');
    exit;
}

require 'config.php';

$name = trim($_POST['name']);
$age = (int)$_POST['age'];
$email = trim($_POST['email']);

if (empty($name) || $age < 1 || $age > 120 || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['error'] = 'Datos inválidos';
    header('Location: dashboard.php');
    exit;
}

try {
    $stmt = $pdo->prepare("INSERT INTO datos (name, age, email) VALUES (?, ?, ?)");
    $stmt->execute([$name, $age, $email]);
    header('Location: dashboard.php');
} catch (PDOException $e) {
    $_SESSION['error'] = 'Error al guardar datos: ' . $e->getMessage();
    header('Location: dashboard.php');
}
?>