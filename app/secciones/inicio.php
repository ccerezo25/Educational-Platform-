<?php
session_start();

// Verificar si el administrador ha iniciado sesión
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    // Si no ha iniciado sesión, redirigir al formulario de inicio de sesión
    header("Location: ../index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio CEYOM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400;600;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            overflow: hidden;
        }

        .fondo {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            background-image: url('../Imagenes/fondoinicio1.png');
        }

        .fondo::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            z-index: 1;
        }

        .contenido {
            position: relative;
            z-index: 2;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .logo {
            position: absolute;
            top: 25px;
            left: 10%;
            transform: translateX(-50%);
        }

        .logo img {
            width: 235px;
            height: auto;
        }

        .logout-button {
            position: absolute;
            top: 25px;
            right: 10%;
            transform: translateX(50%);
            background-color: #ded000;
            color: white;
            border-radius: 5px;
            padding: 10px 20px;
            font-weight: 600;
            cursor: pointer;
            border: none;
            transition: background-color 0.3s;
        }

        .logout-button:hover {
            background-color: #c9bb02;
        }

        .card-container {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 1px;
            margin-top: 320px;
        }

        .card-custom {
            background-color: rgba(255, 255, 255, 0.72);
            border: none;
            border-radius: 35px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
            padding: 10px;
            width: 400px;
            height: 160px;
            margin: 0 10px;
        }

        .welcome-text {
            text-align: center;
            font-family: 'Poppins', sans-serif !important;
            font-weight: 200 !important;
            color: #144600;
            font-size: 20px;
        }

        .title-text {
            text-align: center;
            font-family: 'Poppins', sans-serif !important;
            font-weight: 800 !important;
            color: #144600;
            font-size: 35px;
            line-height: 18px;
        }

        .btn-custom {
            background-color: #ded000;
            color: white;
            position: absolute;
            top: 100px;
            left: 135px;
            transform: translateX(-50%);
        }

        .btn-custom1 {
            background-color: #ded000;
            color: white;
            position: absolute;
            top: 100px;
            left: 275px;
            transform: translateX(-50%);
        }

        .btn-custom2 {
            background-color: #ded000;
            color: white;
            position: absolute;
            top: 100px;
            left: 145px;
            transform: translateX(-50%);
        }

        .btn-custom3 {
            background-color: #ded000;
            color: white;
            position: absolute;
            top: 100px;
            left: 295px;
            transform: translateX(-50%);
        }

        .btn-custom4 {
            background-color: #ded000;
            color: white;
            position: absolute;
            top: 100px;
            left: 200px;
            transform: translateX(-50%);
        }

        .btn-custom:hover,
        .btn-custom1:hover,
        .btn-custom2:hover,
        .btn-custom3:hover,
        .btn-custom4:hover {
            background-color: #c9bb02;
            color: white;
        }

        /* Estilos para dispositivos móviles */
        @media (max-width: 767px) {
            body {
                overflow: auto;
            }

            .contenido {
                flex-direction: column;
                justify-content: flex-start;
                padding: 20px;
                overflow-y: auto;
                /* Habilita el desplazamiento vertical */
            }

            .logo {
                position: relative;
                top: auto;
                left: auto;
                transform: none;
                margin-bottom: 20px;
            }

            .logout-button {
                position: static;
                transform: none;
                margin: 10px auto;
                display: block;
                width: auto;
            }

            .card-container {
                flex-direction: column;
                margin-top: 1px;
                overflow-y: auto;
                /* Asegura el desplazamiento en dispositivos móviles */
                max-height: calc(100vh - 150px);
                /* Limita la altura para dejar espacio a la cabecera y el pie */
            }

            .card-custom {
                width: 100%;
                max-width: none;
                height: auto;
                margin: 10px 0;
            }

            .btn-custom,
            .btn-custom1,
            .btn-custom2,
            .btn-custom3,
            .btn-custom4 {
                position: static;
                transform: none;
                margin: 5px auto;
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="fondo">
        <div class="contenido">
            <div class="logo">
                <img src="../Imagenes/logoceyombl.png" alt="Logo CEYOM">
            </div>

            <!-- Botón de Cerrar Sesión -->
            <button class="logout-button" onclick="location.href='logout.php'">Cerrar Sesión</button>

            <div class="card-container">
                <div class="card card-custom">
                    <div class="card-body">
                        <h5 class="welcome-text">MODULO</h5>
                        <h5 class="title-text">Cursos</h5>
                        <button class="btn btn-custom" onclick="location.href='reg_curso.php'">Agregar Curso</button>
                        <button class="btn btn-custom1" onclick="location.href='ver_cursos.php'">Ver Cursos</button>
                    </div>
                </div>
                <div class="card card-custom">
                    <div class="card-body">
                        <h5 class="welcome-text">MODULO</h5>
                        <h5 class="title-text">Estudiantes</h5>
                        <button class="btn btn-custom2" onclick="location.href='reg_estudiante.php'">Agregar Estudiante</button>
                        <button class="btn btn-custom3" onclick="location.href='ver_estudiantes.php'">Ver Lista</button>
                    </div>
                </div>
                <div class="card card-custom">
                    <div class="card-body">
                        <h5 class="welcome-text">Generar</h5>
                        <h5 class="title-text">Certificados</h5>
                        <button class="btn btn-custom4" onclick="location.href='registrar_estudiante_curso.php'">Crear</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>