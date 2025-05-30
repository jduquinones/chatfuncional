<?php

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
require_once '../database/database.php';

header('Content-Type: application/json');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['userName'] ?? '');
    $email = trim($_POST['userEmail'] ?? '');
    $password = $_POST['userPassword'] ?? '';
    $rol = $_POST['userRole'] ?? '';

    if (empty($nombre) || empty($email) || empty($password)) {
        $_SESSION['mensaje'] = [
            'tipo' => 'error',
            'texto' => 'Todos los campos son obligatorios'
        ];
        header("Location: ../form/agregar.php");
        exit;
    }

    // Verificar si el email ya está registrado
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->fetch()) {
        $_SESSION['mensaje'] = [
            'tipo' => 'error',
            'texto' => 'El correo ya está registrado'
        ];
        header("Location: ../form/agregar.php");
        exit;
    }

    // Hashear contraseña
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    // Insertar usuario
    $stmt = $pdo->prepare("INSERT INTO users (nombre, email, password, rol) VALUES (?, ?, ?, ?)");


    if ($stmt->execute([$nombre, $email, $passwordHash, $rol])) {
        $userId = $pdo->lastInsertId();


        $_SESSION['mensaje'] = [
            'tipo' => 'success',
            'texto' => 'Usuario registrado correctamente'
        ];

        $data = [
            'id' => $userId,
            'nombre' => $nombre,
            'email' => $email,
            'rol' => $rol,
            'gender' => 'male' // o el género correspondiente
        ];

        // Configurar la solicitud a Socket.io
        $options = [
            'http' => [
                'header'  => "Content-type: application/json\r\n",
                'method'  => 'POST',
                'content' => json_encode($data),
                'timeout' => 5 // Tiempo de espera en segundos
            ]
        ];

        $context  = stream_context_create($options);
        $result = @file_get_contents('http://localhost:3001/user-registered', false, $context);

        if ($result === FALSE) {
            error_log("Error al notificar a Socket.io sobre nuevo usuario");
        }

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

    header("Location: ../form/agregar.php");
    exit;
}
