<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="style.css">
    <title>FORMULARIO DE REGISTRO E INICIO SESIÓN</title>
</head>

<body>
    <style>
        .form-group {
            position: relative;
            margin-bottom: 15px;
        }

        .form-group label {
            display: flex;
            align-items: center;
            border: 1px solid #ccc;
            border-radius: 50px;
            padding: 10px;
            background-color: #fff;
            height: 40px;

        }

        .form-group i {
            margin-right: 10px;
            color: #555;
            font-size: 18px;
        }

        .form-group input,
        .form-group select {
            border: none;
            outline: none;
            width: 100%;
            font-size: 16px;
            background-color: transparent;
            padding: 5px 0;
            color: #333;
            appearance: none;
            height: 30px;
        }

        /* Opcional: ícono de flechita para el select */
        .form-group select {
            background-image: url("data:image/svg+xml;charset=US-ASCII,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 4 5'%3E%3Cpath fill='%23666' d='M2 0L0 2h4z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 10px center;
            background-size: 10px;
            padding-right: 30px;
        }

        .notificacion {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 15px 20px;
            border-radius: 5px;
            color: white;
            font-weight: 500;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.2);
            z-index: 1000;
            animation: slideIn 0.5s, fadeOut 0.5s 2.5s forwards;
        }

        .notificacion.error {
            background-color: #ff4444;
        }

        .notificacion.success {
            background-color: #00C851;
        }

        @keyframes slideIn {
            from {
                transform: translateX(100%);
            }

            to {
                transform: translateX(0);
            }
        }

        @keyframes fadeOut {
            from {
                opacity: 1;
            }

            to {
                opacity: 0;
            }
        }
    </style>
    <?php // include "../inc/header.php" 
    session_start();
    // Mostrar mensaje si existe
    $mensaje = $_SESSION['mensaje'] ?? null;
    // Eliminar el mensaje después de mostrarlo para que no persista
    unset($_SESSION['mensaje']);
    ?>

    <?php if ($mensaje): ?>
        <div class="notificacion <?php echo $mensaje['tipo']; ?>">
            <?php echo $mensaje['texto']; ?>
        </div>
    <?php endif; ?>

    <div class="container-form register">
        <div class="information">
            <div class="info-childs">
                <h2>Bienvenido</h2>
                <p>Para unirte a nuestra comunidad por favor Inicia Sesión con tus datos</p>
                <input type="button" value="Iniciar Sesión" id="sign-in">
            </div>
        </div>
        <div class="form-information">
            <div class="form-information-childs">
                <h2>Crear una Cuenta</h2>
                <div class="icons">
                    <i class='bx bxl-google'></i>
                    <i class='bx bxl-github'></i>
                    <i class='bx bxl-linkedin'></i>
                </div>
                <p>o usa tu email para registrarte</p>
                <form class="form form-register" method="POST" action="../auth/registerController.php" novalidate>
                    <div class="form-group">
                        <label>
                            <i class='bx bx-user'></i>
                            <input type="text" name="userName" placeholder="Nombre Usuario" required>
                        </label>
                    </div>

                    <div class="form-group">
                        <label>
                            <i class='bx bx-envelope'></i>
                            <input type="email" name="userEmail" placeholder="Correo Electrónico" required>
                        </label>
                    </div>

                    <div class="form-group">
                        <label>
                            <i class='bx bx-lock-alt'></i>
                            <input type="password" name="userPassword" placeholder="Contraseña" required>
                        </label>
                    </div>

                    <div class="form-group">
                        <label>
                            <i class='bx bx-user-id-card'></i>
                            <select name="userRole" required>
                                <option value="" disabled selected>Seleccione un rol...</option>
                                <option value="docente">Docente</option>
                                <option value="estudiante">Estudiante</option>
                            </select>
                        </label>
                    </div>


                    <input type="submit" value="Registrarse">

                    <div class="alerta-error" style="display: none;">Todos los campos son obligatorios</div>
                    <div class="alerta-exito" style="display: none;">Te registraste correctamente</div>
                </form>
            </div>
        </div>
    </div>


    <div class="container-form login hide">
        <div class="information">
            <div class="info-childs">
                <h2>¡¡Bienvenido nuevamente!!</h2>
                <p>Para unirte a nuestra comunidad por favor Inicia Sesión con tus datos</p>
                <input type="button" value="Registrarse" id="sign-up">
            </div>
        </div>
        <div class="form-information">
            <div class="form-information-childs">
                <h2>Iniciar Sesión</h2>
                <div class="icons">
                    <i class='bx bxl-google'></i>
                    <i class='bx bxl-github'></i>
                    <i class='bx bxl-linkedin'></i>
                </div>

                <form class="form form-login" method="POST" action="../auth/loginController.php" novalidate>
                    <div>
                        <label>
                            <i class='bx bx-envelope'></i>
                            <input type="email" placeholder="Correo Electrónico" name="userEmail" required>
                        </label>
                    </div>
                    <div>
                        <label>
                            <i class='bx bx-lock-alt'></i>
                            <input type="password" placeholder="Contraseña" name="userPassword" required>
                        </label>
                    </div>
                    <input type="submit" value="Iniciar Sesión">
                    <div class="alerta-error">Todos los campos son obligatorios</div>
                    <div class="alerta-exito">Inicio de sesión exitoso</div>
                </form>
            </div>
        </div>
    </div>

    <!-- Footer Start -->
    <?php // include "../inc/footer.php" 
    ?>
    <!-- Footer End -->

    <script src="script.js"></script>
    <script src="js/register.js"></script>
    <script src="js/login.js"></script>
</body>

</html>