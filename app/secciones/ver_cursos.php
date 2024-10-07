<?php
include('../templates/cabecera.php');
include('../secciones/cursos.php'); // Aquí se incluye el archivo que contiene la función

if (isset($_POST['accion']) && $_POST['accion'] == 'Seleccionar') {
    $idCurso = $_POST['id'];
    $alumnosCurso = obtenerEstudiantesPorCurso($conexionBD, $idCurso);
}
?>

<link rel="stylesheet" href="../ver_cursos.css">

<div class="blur-overlay"></div>

<div class="container">
    <br>
    <div class="search-bar">
        <form action="" method="get">
            <input type="text" name="search" placeholder="Nombre del curso..." value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
            <button type="submit">Buscar</button>
        </form>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">SECUENCIAL</th>
                        <th scope="col">CÓDIGO</th>
                        <th scope="col">NOMBRE</th>
                        <th scope="col">CICLO</th>
                        <th scope="col">HORARIO</th>
                        <th scope="col">SEDE</th>
                        <th scope="col">JORNADA</th>
                        <th scope="col">PROFESOR</th>
                        <th scope="col">ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $search = isset($_GET['search']) ? $_GET['search'] : '';
                    $filteredCursos = array_filter($listaCursos, function ($curso) use ($search) {
                        return stripos($curso['nombre_curso'], $search) !== false;
                    });

                    if (count($filteredCursos) > 0) {
                        $secuencial = 1;
                        foreach ($filteredCursos as $curso) { ?>
                            <tr>
                                <td><?php echo $secuencial++; ?></td> <!-- Incrementar secuencial -->
                                <td><?php echo $curso['codigo_curso']; ?></td>
                                <td><?php echo $curso['nombre_curso']; ?></td>
                                <td><?php echo $curso['ciclo_curso']; ?></td>
                                <td><?php echo date('H:i', strtotime($curso['hora_inicio'])) . ' - ' . date('H:i', strtotime($curso['hora_fin'])); ?></td>
                                <td><?php echo $curso['sede_curso']; ?></td>
                                <td><?php echo $curso['jornada_curso']; ?></td>
                                <td><?php echo $curso['profesor_curso']; ?></td>
                                <td>
                                    <form method="post">
                                        <input type="hidden" name="id" value="<?php echo $curso['id']; ?>">
                                        <input type="hidden" name="accion" value="Seleccionar">
                                        <button type="submit" class="btn-accion seleccionar">
                                            <img src="../Imagenes/logo-ver.png" alt="seleccionar">
                                        </button>
                                    </form>
                                    <form method="post" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este curso?');">
                                        <input type="hidden" name="id" value="<?php echo $curso['id']; ?>">
                                        <input type="hidden" name="accion" value="borrar">
                                        <button type="submit" class="btn-accion borrar">
                                            <img src="../Imagenes/logo-borrar.png" alt="borrar">
                                        </button>
                                    </form>
                                    <button type="button" class="btn-accion editar" onclick="openModal(<?php echo htmlspecialchars(json_encode($curso)); ?>)">
                                        <img src="../Imagenes/logo-editar.png" alt="editar">
                                    </button>
                                </td>
                            </tr>
                        <?php }
                    } else { ?>
                        <tr>
                            <td colspan="9">No se encontraron resultados</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal para mostrar los estudiantes inscritos en el curso seleccionado -->
<div id="estudiantesModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeEstudiantesModal()">&times;</span>
        <h4 class="text-center">Estudiantes Inscritos en el Curso</h4>
        <br>
        <div class="modal-body">
            <?php if (isset($alumnosCurso) && !empty($alumnosCurso)) { ?>
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Cédula</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Apellido</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($alumnosCurso as $alumno) { ?>
                            <tr>
                                <td><?php echo $alumno['cedula']; ?></td>
                                <td><?php echo $alumno['nombre']; ?></td>
                                <td><?php echo $alumno['apellido']; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php } else { ?>
                <p>No hay estudiantes inscritos en este curso.</p>
            <?php } ?>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn" onclick="closeEstudiantesModal()">Cerrar</button>
        </div>
    </div>
</div>

<div id="cursoModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h2 class="title-text">Detalles del Curso</h2>
        <br>
        <form method="post">
            <input type="hidden" name="id" id="modalCursoId">
            <input type="hidden" name="accion" value="editar">
            <div class="mb-3">
                <label for="cursoCodigo" class="form-label">CÓDIGO</label>
                <input type="text" class="form-control" id="modalCursoCodigo" name="codigo_curso" required>
            </div>
            <div class="mb-3">
                <label for="cursoNombre" class="form-label">NOMBRE</label>
                <input type="text" class="form-control" id="modalCursoNombre" name="nombre_curso" required>
            </div>
            <div class="mb-3">
                <label for="cursoCiclo" class="form-label">CICLO</label>
                <input type="text" class="form-control" id="modalCursoCiclo" name="ciclo_curso" required>
            </div>
            <div class="mb-3">
                <label for="cursoHorarioInicio" class="form-label">HORARIO INICIO</label>
                <input type="time" class="form-control" id="modalCursoHorarioInicio" name="hora_inicio" required>
            </div>
            <div class="mb-3">
                <label for="cursoHorarioFin" class="form-label">HORARIO FIN</label>
                <input type="time" class="form-control" id="modalCursoHorarioFin" name="hora_fin" required>
            </div>
            <div class="mb-3">
                <label for="cursoSede" class="form-label">SEDE</label>
                <input type="text" class="form-control" id="modalCursoSede" name="sede_curso" required>
            </div>
            <div class="mb-3">
                <label for="cursoJornada" class="form-label">JORNADA</label>
                <input type="text" class="form-control" id="modalCursoJornada" name="jornada_curso" required>
            </div>
            <div class="mb-3">
                <label for="cursoProfesor" class="form-label">PROFESOR</label>
                <input type="text" class="form-control" id="modalCursoProfesor" name="profesor_curso" required>
            </div>
            <button type="submit" class="btn btn-primary">Confirmar Edición</button>
        </form>
    </div>
</div>

<script>
    // Función para abrir el modal de edición de curso
    function openModal(curso) {
        document.getElementById('modalCursoId').value = curso.id;
        document.getElementById('modalCursoCodigo').value = curso.codigo_curso;
        document.getElementById('modalCursoNombre').value = curso.nombre_curso;
        document.getElementById('modalCursoCiclo').value = curso.ciclo_curso;
        document.getElementById('modalCursoHorarioInicio').value = curso.hora_inicio.substring(0, 5); // HH:MM
        document.getElementById('modalCursoHorarioFin').value = curso.hora_fin.substring(0, 5); // HH:MM
        document.getElementById('modalCursoSede').value = curso.sede_curso;
        document.getElementById('modalCursoJornada').value = curso.jornada_curso;
        document.getElementById('modalCursoProfesor').value = curso.profesor_curso;
        document.getElementById('cursoModal').style.display = 'block';
    }

    // Función para cerrar el modal de edición de curso
    function closeModal() {
        document.getElementById('cursoModal').style.display = 'none';
    }

    // Función para abrir el modal de estudiantes inscritos
    document.addEventListener('DOMContentLoaded', function() {
        <?php if (isset($alumnosCurso)) { ?>
            document.getElementById('estudiantesModal').style.display = 'block';
        <?php } ?>
    });

    // Función para cerrar el modal de estudiantes inscritos
    function closeEstudiantesModal() {
        document.getElementById('estudiantesModal').style.display = 'none';
    }
</script>

<?php include('../templates/pie.php'); ?>