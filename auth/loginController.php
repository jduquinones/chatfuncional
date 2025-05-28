<?php
session_start(); // ¡Debe estar al inicio siempre!

require_once '../database/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['userEmail'] ?? '';
    $password = $_POST['userPassword'] ?? '';

    if (empty($email) || empty($password)) {
        $_SESSION['mensaje'] = [
            'tipo' => 'error',
            'texto' => 'Todos los campos son obligatorios'
        ];
        header("Location: ../form/agregar.php");
        exit;
    }

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario && password_verify($password, $usuario['password'])) {
        // Usuario autenticado, guardamos en sesión
        $_SESSION['usuario'] = $usuario;

        // Obtener usuarios según rol
        $currentRole = $usuario['rol'];

        if ($currentRole === 'docente') {
            $stmt = $pdo->prepare("SELECT * FROM users WHERE rol = 'estudiante'");
            $stmt->execute();
            $_SESSION['allUsers'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } elseif ($currentRole === 'estudiante') {
            $stmt = $pdo->prepare("SELECT * FROM users WHERE rol = 'docente'");
            $stmt->execute();
            $_SESSION['allUsers'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            // admin u otros roles ven todos excepto a sí mismos
            $stmt = $pdo->prepare("SELECT * FROM users WHERE id != ?");
            $stmt->execute([$usuario['id']]);
            $_SESSION['allUsers'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        header("Location: ../service.php");
        exit;
    } else {
        $_SESSION['mensaje'] = [
            'tipo' => 'error',
            'texto' => 'Correo o contraseña incorrectos'
        ];
        header("Location: ../form/agregar.php");
        exit;
    }
} else {
    $_SESSION['mensaje'] = [
        'tipo' => 'error',
        'texto' => 'Método no permitido'
    ];
    header("Location: ../form/agregar.php");
    exit;
}
