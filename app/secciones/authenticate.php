<?php
session_start();

// Definir las credenciales del administrador
$admin_username = "admin";  // Nombre de usuario fijo
$admin_password_hash = '$2y$10$MW3Sw2ivwbCC6s9OUHb0weRhYyo9oJcdT2p5poEdBYsfCWG99O1FC';  // Hash de la contraseña 'ecotec'

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['usuario'];
    $password = $_POST['contrasenia'];

    // Verificar si el nombre de usuario es correcto
    if ($username === $admin_username) {
        // Verificación de la contraseña
        if (password_verify($password, $admin_password_hash)) {
            // Credenciales correctas, crear la sesión
            $_SESSION['admin'] = true;

            // Redirigir al área segura
            header("Location: ../secciones/inicio.php");
            exit;
        } else {
            // Contraseña incorrecta
            header("Location: ../index.php?error=1");
            exit;
        }
    } else {
        // Usuario incorrecto
        header("Location: ../index.php?error=1");
        exit;
    }
} else {
    // Si el método no es POST, redirigir al formulario de inicio de sesión
    header("Location: ../index.php");
    exit;
}
