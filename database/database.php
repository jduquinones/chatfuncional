<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);


/** Las credenciales se deben de cambiar segun en el host en donde corra la app */
// $host = '172.26.96.1';
$host = '127.0.0.1';
$db = 'classonvirtual';
$user = 'root';
$pass = '123456';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Conexión fallida: " . $e->getMessage());
}
