<?php
require_once __DIR__ . '/../vendor/autoload.php'; // Ajusta la ruta según dónde esté tu vendor

use Dotenv\Dotenv;

// Cargar variables de entorno del archivo .env
$dotenv = Dotenv::createImmutable(__DIR__ . '/../'); // Ruta a la carpeta raíz donde esté .env
$dotenv->load();

// Obtener variables de entorno
$host = $_ENV['DB_HOST'] ?? '127.0.0.1';
$db   = $_ENV['DB_NAME'] ?? 'classonvirtual';
$user = $_ENV['DB_USER'] ?? 'root';
$pass = $_ENV['DB_PASS'] ?? '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Conexión fallida: " . $e->getMessage());
}
