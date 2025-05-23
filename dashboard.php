<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: /');
    exit;
}

// echo '<pre>';
// print_r($_SESSION);
// echo '</pre>';

$user_nombre = $_SESSION['usuario']['nombre'] ?? 'Usuario';
$user_rol = $_SESSION['usuario']['rol'] ?? 'Invitado';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Panel de Control</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <!-- CAMBIOS APLICADOS EN EL BLOQUE <style> -->

    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f8f9fa;
        }

        .sidebar {
            height: 100vh;
            background-color: #145A9C;
            padding-top: 1rem;
            position: fixed;
            width: 250px;
            color: white;
        }

        .sidebar h4 {
            color: white;
            margin-bottom: 2rem;
        }

        .sidebar a {
            color: #ffffffcc;
            padding: 12px 20px;
            display: block;
            text-decoration: none;
            transition: background-color 0.2s ease;
        }

        .sidebar a:hover {
            background-color: #FCA311;
            color: #000;
        }

        .content {
            margin-left: 250px;
            padding: 20px;
        }

        .navbar-custom {
            background-color: #FCA311;
            color: white;
        }

        .navbar-custom .navbar-text {
            color: #000;
            font-weight: bold;
        }

        .card {
            border: none;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, .05);
        }

        .logout-link {
            color: #ffd5d5;
            text-decoration: none;
        }

        .logout-link:hover {
            color: #ff4d4d;
            background-color: #fff;
        }

        h1,
        h3 {
            color: #145A9C;
        }

        .btn-primary {
            background-color: #FCA311;
            border-color: #FCA311;
            color: black;
        }

        .btn-primary:hover {
            background-color: #e89406;
            border-color: #e89406;
            color: white;
        }
    </style>

</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h4 class="text-white text-center mb-4"><i class="bi bi-speedometer2 me-2" style="color: #FCA311;"></i> Dashboard</h4>
        <a href="dashboard.php?view=chat"><i class="bi bi-chat-dots"></i> Chat</a>
        <a href="dashboard.php?view=registrar"><i class="bi bi-person-plus"></i> Registrar usuarios</a>
        <a href="auth/logout.php" class="logout-link"><i class="bi bi-box-arrow-right"></i> Cerrar sesión</a>
    </div>


    <!-- Contenido principal -->
    <div class="content">
        <!-- Navbar superior -->
        <nav class="navbar navbar-expand-lg navbar-light navbar-custom mb-4">
            <div class="container-fluid">
                <span class="navbar-text">
                    Bienvenido, <strong><?= htmlspecialchars($user_nombre) ?></strong> (<?= htmlspecialchars($user_rol) ?>)
                </span>
            </div>
        </nav>

        <?php
        $view = $_GET['view'] ?? 'inicio';

        switch ($view) {
            case 'registrar':
                if (isset($_SESSION['mensaje'])) {
                    $mensaje = $_SESSION['mensaje'];
                    echo '<div class="alert alert-' . htmlspecialchars($mensaje['tipo']) . ' alert-dismissible fade show" role="alert">'
                        . htmlspecialchars($mensaje['texto']) .
                        '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';

                    // Borrar el mensaje para que no se muestre de nuevo
                    unset($_SESSION['mensaje']);
                }

                include 'resources/views/registrarUsuarios.php';
                break;
            case 'chat':
                echo '<h3><i class="bi bi-chat-dots"></i> Chat en construcción</h3>';
                break;
            default:
                // Vista por defecto: pantalla de bienvenida
        ?>
                <div class="text-center mt-5">
                    <h1 class="display-5" style="color: #145A9C;">
                        <i class="bi bi-house-door-fill" style="color: #FCA311;"></i>
                        Bienvenido al Panel de <strong style="color: #FCA311;">ClassOnVirtual</strong>
                    </h1>
                    <p class="lead mt-3 text-muted">Utiliza el menú lateral para navegar entre las secciones disponibles.</p>
                </div>

        <?php
                break;
        }
        ?>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>