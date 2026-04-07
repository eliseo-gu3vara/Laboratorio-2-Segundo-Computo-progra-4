<?php
// Configuración de conexión a la base de datos
$host = 'localhost';
$db = 'bdugb';
$user = 'root';
$pass = 'Roberlopez971*'; 

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión a la base de datos: " . $e->getMessage());
}
?>