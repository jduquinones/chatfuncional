<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
require_once '../database/database.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['userEmail'] ?? '';
    $password = $_POST['userPassword'] ?? '';

    if (empty($email) || empty($password)) {
        echo json_encode(['status' => 'error', 'message' => 'Campos obligatorios']);
        exit;
    }

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email != ?");
    $stmt->execute([$email]);
    $allUsers = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($usuario && password_verify($password, $usuario['password'])) {
        session_start();
        $_SESSION['usuario'] = $usuario;
        $_SESSION['allUsers'] = $allUsers;
        // header("Location: ../dashboard.php");
        header("Location: ../service.php");
        exit;
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Correo o contraseña incorrectos']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Método no permitido']);
}
