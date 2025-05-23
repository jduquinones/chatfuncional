<?php

session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: /');
    exit;
}
?>

<!-- Contenedor principal -->
<div class="registro-usuario">
    <h2 class="mb-4 text-center">Registrar Nuevo Usuario</h2>

    <div class="card shadow p-4 border-0 rounded-3" style="max-width: 600px; margin: auto; background-color: #f8f9fa;">
        <form method="POST" action="../../auth/registerController.php" novalidate>
            <div class="mb-3">
                <label class="form-label">Nombre de Usuario</label>
                <div class="input-group">
                    <span class="input-group-text bg-primary text-white"><i class="bi bi-person"></i></span>
                    <input type="text" class="form-control" name="userName" placeholder="Nombre de usuario" required>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Correo Electrónico</label>
                <div class="input-group">
                    <span class="input-group-text bg-primary text-white"><i class="bi bi-envelope"></i></span>
                    <input type="email" class="form-control" name="userEmail" placeholder="Correo electrónico" required>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Contraseña</label>
                <div class="input-group">
                    <span class="input-group-text bg-primary text-white"><i class="bi bi-lock"></i></span>
                    <input type="password" class="form-control" name="userPassword" placeholder="Contraseña" required>
                </div>
            </div>

            <!-- Nuevo campo: Rol -->
            <div class="mb-4">
                <label class="form-label">Rol</label>
                <div class="input-group">
                    <span class="input-group-text bg-primary text-white"><i class="bi bi-person-badge"></i></span>
                    <select class="form-select" name="userRole" required>
                        <option value="">Seleccione un rol...</option>
                        <option value="docente">Docente</option>
                        <option value="estudiante">Estudiante</option>

                    </select>
                </div>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-success">Registrar Usuario</button>
            </div>

            <!-- Mensajes -->
            <div class="mt-3 text-danger alerta-error" style="display:none;">Todos los campos son obligatorios</div>
            <div class="mt-3 text-success alerta-exito" style="display:none;">Usuario registrado correctamente</div>
        </form>
    </div>
</div>