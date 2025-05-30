<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

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

        // echo "Email recibido: $email\n\n";
        // echo "Usuario encontrado:\n";
        // print_r($_SESSION['usuario']);
        // echo "\n";

        // Obtener usuarios según rol
        $currentRole = $usuario['rol'];

        if ($currentRole === 'docente') {
            // Docentes ven estudiantes y admins (excepto ellos mismos)
            $stmt = $pdo->prepare("SELECT * FROM users WHERE rol IN ('estudiante', 'admin') AND id != ?");
            $stmt->execute([$usuario['id']]);
            $_SESSION['allUsers'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } elseif ($currentRole === 'estudiante') {
            // Estudiantes ven docentes y admins (excepto ellos mismos)
            $stmt = $pdo->prepare("SELECT * FROM users WHERE rol IN ('docente', 'admin') AND id != ?");
            $stmt->execute([$usuario['id']]);
            $_SESSION['allUsers'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            // Admins ven a TODOS los usuarios (excepto ellos mismos)
            $stmt = $pdo->prepare("SELECT * FROM users WHERE id != ?");
            $stmt->execute([$usuario['id']]);
            $_SESSION['allUsers'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        // echo "Email recibido: $email\n\n";
        // echo "Usuario encontrado:\n";
        // print_r($_SESSION['allUsers']);
        // echo "\n";

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
