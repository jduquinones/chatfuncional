<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once '../database/database.php'; // Ajusta la ruta si es necesario

header('Content-Type: application/json');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['userName'] ?? '');
    $email = trim($_POST['userEmail'] ?? '');
    $password = $_POST['userPassword'] ?? '';
    $rol = $_POST['userRole'] ?? '';

    if (empty($nombre) || empty($email) || empty($password)) {
        echo json_encode(['status' => 'error', 'message' => 'Todos los campos son obligatorios']);
        exit;
    }

    // Verificar si el email ya está registrado
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->fetch()) {
        echo json_encode(['status' => 'error', 'message' => 'El correo ya está registrado']);
        exit;
    }

    // Hashear contraseña
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    // Insertar usuario
    $stmt = $pdo->prepare("INSERT INTO users (nombre, email, password, rol) VALUES (?, ?, ?, ?)");
if ($stmt->execute([$nombre, $email, $passwordHash, $rol])) {
    $_SESSION['mensaje'] = [
        'tipo' => 'success',
        'texto' => 'Usuario registrado correctamente'
    ];
} else {
    $_SESSION['mensaje'] = [
        'tipo' => 'error',
        'texto' => 'Hubo un error al registrar el usuario'
    ];
}

header("Location: ../dashboard.php?view=registrar");
exit;
}
