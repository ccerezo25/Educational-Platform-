<!doctype html>
<html lang="en">

<head>
    <title>SISTEMA CEYOM</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            padding-top: 70px;
            font-family: 'Poppins', sans-serif;
        }

        .navbar {
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.5);
            /* Añade una sombra suave */
        }

        .nav-link {
            transition: transform 0.3s, color 0.3s;
        }

        .nav-link:hover {
            transform: scale(1.1);
            color: #FFD700;
            /* Color dorado para indicar selección */
        }

        .dropdown-menu .dropdown-item {
            transition: transform 0.3s, color 0.3s;
        }

        .dropdown-menu .dropdown-item:hover {
            transform: scale(1.02);
            background-color: #bc9a00;
            color: #FFD700;
        }

        .logo-cerrar-sesion img {
            height: 20px;
            /* Ajusta el tamaño del logo */
            margin-right: 5px;
            /* Ajusta el margen */
            filter: invert(1);
            /* Invierte los colores de la imagen (blanco a negro, negro a blanco) */
            transition: transform 0.3s, opacity 0.3s;
            /* Agrega una transición suave */
        }

        .logo-cerrar-sesion .text-cerrar-sesion {
            display: none;
            /* Oculta el texto del enlace "Cerrar Sesión" por defecto */
        }

        .logo-cerrar-sesion:hover .text-cerrar-sesion {
            display: inline;
            /* Muestra el texto del enlace "Cerrar Sesión" cuando se hace hover */
        }

        .logo-cerrar-sesion:hover img {
            transform: translateX(-5px);
            /* Mueve la imagen del logo hacia la izquierda cuando se hace hover */
        }

        .dropdown-menu {
            display: none;
        }

        .nav-item:hover .dropdown-menu {
            display: block;
        }

        .dropdown-menu-custom {
            min-width: 200px;
            /* Ajusta el ancho del menú desplegable */
            background-color: #deb600;
            color: white;
        }

        .dropdown-menu-custom .dropdown-item {
            font-size: 16px;
            /* Ajusta el tamaño de fuente de los elementos del menú */
            font-family: 'Poppins', sans-serif;
        }

        /* Media Queries para Responsividad */
        @media (max-width: 768px) {
            .navbar-brand img {
                height: 30px;
                /* Ajusta el tamaño del logo para pantallas pequeñas */
            }

            .nav-link {
                font-size: 14px;
                /* Ajusta el tamaño de la fuente de los enlaces de navegación */
            }

            .dropdown-menu-custom .dropdown-item {
                font-size: 14px;
                /* Ajusta el tamaño de fuente de los elementos del menú */
            }

            .logo-cerrar-sesion img {
                height: 18px;
                /* Ajusta el tamaño del logo de cerrar sesión */
            }

            .logo-cerrar-sesion .text-cerrar-sesion {
                display: inline;
                /* Muestra el texto del enlace "Cerrar Sesión" en pantallas pequeñas */
            }
        }

        @media (max-width: 480px) {
            .navbar-brand img {
                height: 25px;
                /* Ajusta el tamaño del logo para pantallas más pequeñas */
            }

            .nav-link {
                font-size: 12px;
                /* Ajusta el tamaño de la fuente de los enlaces de navegación */
            }

            .dropdown-menu-custom .dropdown-item {
                font-size: 12px;
                /* Ajusta el tamaño de fuente de los elementos del menú */
            }

            .logo-cerrar-sesion img {
                height: 16px;
                /* Ajusta el tamaño del logo de cerrar sesión */
            }

            .logo-cerrar-sesion .text-cerrar-sesion {
                display: inline;
                /* Muestra el texto del enlace "Cerrar Sesión" en pantallas pequeñas */
            }
        }
    </style>
</head>

<nav class="navbar navbar-expand-lg fixed-top" style="background: linear-gradient(to right, #deb600, #bc9a00); padding: 10px 20px;">
    <a class="navbar-brand" href="inicio.php" style="margin-right: 20px;">
        <img src="../Imagenes/logoceyom.png" alt="Logo" style="height: 40px;">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav me-auto">
            <li class="nav-item">
                <a class="nav-link" href="inicio.php" style="color:white;">Inicio</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color:white; margin-left: 20px;">
                    Cursos
                </a>
                <ul class="dropdown-menu dropdown-menu-custom" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="reg_curso.php" style="color: white">Agregar Curso</a></li>
                    <li><a class="dropdown-item" href="ver_cursos.php" style="color: white">Ver Cursos</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color:white; margin-left: 20px;">
                    Estudiantes
                </a>
                <ul class="dropdown-menu dropdown-menu-custom" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="reg_estudiante.php" style="color: white">Registrar Estudiante</a></li>
                    <li><a class="dropdown-item" href="ver_estudiantes.php" style="color: white">Ver Estudiantes</a></li>
                    <li><a class="dropdown-item" href="registrar_estudiante_curso.php" style="color: white">Generar Certificados</a></li>
                </ul>
            </li>
        </ul>
        <ul class="navbar-nav">
            <li class="nav-item logo-cerrar-sesion">
                <a class="nav-link" href="logout.php" style="color:white;">
                    <img src="../Imagenes/logo-cerrar-sesion.png" alt="Cerrar Sesión">
                    <span class="text-cerrar-sesion">Cerrar Sesión</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
<div class="container">