<!doctype html>
<html lang="es">

<head>
    <title>SISTEMA CEYOM</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />

    <!-- Google Fonts: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="styleindex.css">
</head>

<body>
    <div class="fondo">
        <div class="contenido">
            <div class="logo">
                <img src="Imagenes/logoceyombl.png" alt="Logo CEYOM">
            </div>
            <div class="custom-container">
                <!-- Aquí se muestra la alerta si hay un error -->
                <?php if (isset($_GET['error']) && $_GET['error'] == 1): ?> <!--para comprobar si existe un error en la URL y si este es igual a 1-->
                    <div class="alert alert-danger" role="alert">
                        Usuario o contraseña incorrecta. Por favor, inténtelo de nuevo.
                    </div>
                <?php endif; ?>

                <form action="secciones/authenticate.php" method="post">
                    <div class="card card-custom">
                        <div class="card-body">
                            <h5 class="welcome-text">Bienvenidos</h5>
                            <h5 class="title-text">SISTEMA CEYOM</h5>
                            <div class="mb-3">
                                <label for="usuario" class="form-label">Usuario</label>
                                <input type="text" class="form-control" name="usuario" id="usuario" aria-describedby="helpId" placeholder="Usuario" required />
                                <small id="helpId" class="form-text text-muted">Escriba su Usuario</small>
                            </div>
                            <div class="mb-3">
                                <label for="contrasenia" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" name="contrasenia" id="contrasenia" placeholder="Contraseña" required />
                                <small id="helpId" class="form-text text-muted">Escriba su Contraseña</small>
                            </div>
                            <button type="submit" class="btn btn-custom">Iniciar Sesión</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+3oB6i5oWzW1435IK7tDgm9Fuj/ocp" crossorigin="anonymous"></script>
</body>

</html>