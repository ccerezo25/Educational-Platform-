<?php include('../templates/cabecera.php'); ?>
<?php include('../secciones/cursos.php'); ?>
<link rel="stylesheet" href="../cursos.css">

<div class="blur-overlay"></div>

<br>
<div class="row">
    <div class="col-12">
        <div class="row">
            <div class="col-md-12">
                <form id="formul" action="" method="post">
                    <div class="card">
                        <div class="card-header">
                            Registrar Curso
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <!--CODIGO - id-->
                                <div class="col-md-4 mb-3">
                                    <label for="codigo_curso" class="form-label">Código del Curso</label>
                                    <input type="text" class="form-control" name="codigo_curso" id="codigo_curso" value="" aria-describedby="helpId" placeholder="4 letras o números" pattern="[A-Za-z0-9]{4}" maxlength="4" required />
                                </div>
                                <!--NOMBRE - nombre_curso-->
                                <div class="col-md-4 mb-3">
                                    <label for="nombre_curso" class="form-label">Nombre</label>
                                    <input type="text" class="form-control" name="nombre_curso" id="nombre_curso" value="" aria-describedby="helpId" placeholder="Nombre del curso" required />
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="ciclo_curso" class="form-label">Ciclo</label>
                                    <input type="text" class="form-control" name="ciclo_curso" id="ciclo_curso" value="" aria-describedby="helpId" placeholder="Ciclo" required />
                                </div>
                            </div>
                            <div class="row">
                                <!-- Hora de Inicio -->
                                <div class="col-md-4 mb-3">
                                    <label for="hora_inicio" class="form-label">Hora de Inicio</label>
                                    <input type="time" class="form-control" name="hora_inicio" id="hora_inicio" value="" aria-describedby="helpId" required />
                                </div>
                                <!-- Hora de Fin -->
                                <div class="col-md-4 mb-3">
                                    <label for="hora_fin" class="form-label">Hora de Fin</label>
                                    <input type="time" class="form-control" name="hora_fin" id="hora_fin" value="" aria-describedby="helpId" required />
                                </div>
                                <!--SEDE - sede_curso-->
                                <div class="col-md-4 mb-3">
                                    <label for="sede_curso" class="form-label">Sede</label>
                                    <input type="text" class="form-control" name="sede_curso" id="sede_curso" value="" aria-describedby="helpId" placeholder="Sede" required />
                                </div>
                            </div>
                            <div class="row">
                                <!--JORNADA - jornada_curso-->
                                <div class="col-md-6 mb-3">
                                    <label for="jornada_curso" class="form-label">Jornada</label>
                                    <input type="text" class="form-control" name="jornada_curso" id="jornada_curso" value="" aria-describedby="helpId" placeholder="Jornada" required />
                                </div>
                                <!--PROFESOR - profesor_curso-->
                                <div class="col-md-6 mb-3">
                                    <label for="profesor_curso" class="form-label">Profesor</label>
                                    <input type="text" class="form-control" name="profesor_curso" id="profesor_curso" value="" aria-describedby="helpId" placeholder="Profesor" required />
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" name="accion" value="agregar" class="btn btn-warning text-white">
                                    Agregar
                                </button>

                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Lista de códigos de curso existentes obtenida desde PHP
    const cursosExistentes = <?php echo json_encode(array_column($listaCursos, 'codigo_curso')); ?>;

    document.getElementById('formul').addEventListener('submit', function(event) {
        const codigoCurso = document.getElementById('codigo_curso').value;

        // Validar si el curso ya existe en la lista de cursos existentes
        if (cursosExistentes.includes(codigoCurso)) {
            alert('El código de curso ya existe. Por favor, elija otro.');
            event.preventDefault(); // Evita que el formulario se envíe si el código ya existe
        }
    });
</script>

<?php include('../templates/pie.php'); ?>