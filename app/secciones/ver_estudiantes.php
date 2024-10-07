<?php
include('../templates/cabecera.php');
include('../secciones/alumnos.php'); // Incluir el archivo que contiene la función

// Verificar si se ha seleccionado un estudiante
if (isset($_POST['accion2']) && $_POST['accion2'] == 'Seleccionar') {
    $idEstudiante = $_POST['id'];
    $cursosEstudiante = obtenerCursosPorEstudiante($conexionBD, $idEstudiante);
}
?>


<link rel="stylesheet" href="../ver_cursos.css">

<div class="blur-overlay"></div>

<div class="container">
    <!-- Barra de búsqueda -->
    <br>
    <div class="search-bar">
        <form action="" method="get">
            <input type="text" name="search" placeholder="Cedula o Nombre... " value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
            <button type="submit">Buscar</button>
        </form>
    </div>

    <!-- Tabla de estudiantes -->
    <div class="card">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th> <!-- Secuencial -->
                        <th scope="col">CÉDULA</th>
                        <th scope="col">NOMBRE COMPLETO</th>
                        <th scope="col">FECHA NACIMIENTO</th>
                        <th scope="col">EDAD</th>
                        <th scope="col">ESTADO CIVIL</th>
                        <th scope="col">GÉNERO</th>
                        <th scope="col">DIRECCIÓN</th>
                        <th scope="col">PARROQUIA</th>
                        <th scope="col">RECINTO</th>
                        <th scope="col">TELÉFONO</th>
                        <th scope="col">CELULAR 1</th>
                        <th scope="col">CELULAR 2</th>
                        <th scope="col">EMAIL</th>
                        <th scope="col">NIVEL DE INSTRUCCIÓN</th>
                        <th scope="col">UNIDAD EDUCATIVA</th>
                        <th scope="col">HIJOS</th>
                        <th scope="col">TRABAJA</th>
                        <th scope="col">RECIBIDO CURSOS</th>
                        <th scope="col">EMPRENDIMIENTO</th>
                        <th scope="col">ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $search = isset($_GET['search']) ? $_GET['search'] : '';
                    $filteredAlumnos = array_filter($alumnos, function ($alumno) use ($search) {
                        return stripos($alumno['nombre'] . ' ' . $alumno['apellido'], $search) !== false
                            || stripos($alumno['cedula'], $search) !== false;
                    });

                    if (count($filteredAlumnos) > 0) {
                        $sequentialNumber = 1; // Iniciar el contador
                        foreach ($filteredAlumnos as $alumno) { ?>
                            <tr>
                                <td><?php echo $sequentialNumber++; ?></td> <!-- Mostrar secuencial y aumentar -->
                                <td><?php echo $alumno['cedula']; ?></td>
                                <td><?php echo $alumno['nombre'] . ' ' . $alumno['apellido']; ?></td>
                                <td><?php echo $alumno['fecha_nacimiento']; ?></td>
                                <td><?php echo $alumno['edad']; ?></td>
                                <td><?php echo $alumno['estado_civil']; ?></td>
                                <td><?php echo $alumno['genero']; ?></td>
                                <td><?php echo $alumno['direccion']; ?></td>
                                <td><?php echo $alumno['parroquia']; ?></td>
                                <td><?php echo $alumno['recinto']; ?></td>
                                <td><?php echo $alumno['telefono']; ?></td>
                                <td><?php echo $alumno['celular_1']; ?></td>
                                <td><?php echo $alumno['celular_2']; ?></td>
                                <td><?php echo $alumno['correo']; ?></td>
                                <td><?php echo $alumno['nivel_instruccion']; ?></td>
                                <td><?php echo $alumno['unidad_educativa']; ?></td>
                                <td><?php echo $alumno['tiene_hijos']; ?> (<?php echo $alumno['cuantos_hijos']; ?>)</td>
                                <td><?php echo $alumno['trabaja']; ?> (<?php echo $alumno['en_que_trabaja']; ?>)</td>
                                <td><?php echo $alumno['recibido_cursos']; ?> (<?php echo $alumno['cursos_recibidos']; ?>)</td>
                                <td><?php echo $alumno['posee_emprendimiento']; ?> (<?php echo $alumno['tipo_emprendimiento']; ?>)</td>
                                <td>
                                    <form method="post">
                                        <input type="hidden" name="id" value="<?php echo $alumno['id']; ?>">
                                        <input type="hidden" name="accion2" value="Seleccionar">
                                        <button type="submit" class="btn-accion seleccionar">
                                            <img src="../Imagenes/logo-ver.png" alt="Ver cursos">
                                        </button>
                                    </form>
                                    <form method="post" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este estudiante?');">
                                        <input type="hidden" name="id" value="<?php echo $alumno['id']; ?>">
                                        <input type="hidden" name="accion2" value="borrar">
                                        <button type="submit" class="btn-accion borrar">
                                            <img src="../Imagenes/logo-borrar.png" alt="borrar">
                                        </button>
                                    </form>
                                    <button type="button" class="btn-accion editar" onclick="openModal(<?php echo htmlspecialchars(json_encode($alumno)); ?>)">
                                        <img src="../Imagenes/logo-editar.png" alt="editar">
                                    </button>
                                </td>
                            </tr>
                        <?php }
                    } else { ?>
                        <tr>
                            <td colspan="21">No se encontraron resultados</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal para ver los cursos en los que está inscrito el estudiante -->
<div id="cursosModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeCursosModal()">&times;</span>
        <h5 class="text-center">Cursos Inscritos del Estudiante</h5>
        <br>
        <div class="modal-body">
            <?php if (isset($cursosEstudiante) && !empty($cursosEstudiante)) { ?>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Código</th>
                                <th scope="col">Nombre del Curso</th>
                                <th scope="col">Ciclo</th>
                                <th scope="col">Horario</th>
                                <th scope="col">Sede</th>
                                <th scope="col">Jornada</th>
                                <th scope="col">Profesor</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($cursosEstudiante as $curso) { ?>
                                <tr>
                                    <td><?php echo $curso['codigo_curso']; ?></td>
                                    <td><?php echo $curso['nombre_curso']; ?></td>
                                    <td><?php echo $curso['ciclo_curso']; ?></td>
                                    <td><?php echo date('H:i', strtotime($curso['hora_inicio'])) . ' - ' . date('H:i', strtotime($curso['hora_fin'])); ?></td>
                                    <td><?php echo $curso['sede_curso']; ?></td>
                                    <td><?php echo $curso['jornada_curso']; ?></td>
                                    <td><?php echo $curso['profesor_curso']; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            <?php } else { ?>
                <p>No hay cursos inscritos para este estudiante.</p>
            <?php } ?>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" onclick="closeCursosModal()">Cerrar</button>
        </div>
    </div>
</div>

<!-- Modal para editar los detalles del estudiante -->
<div id="studentModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h2 class="title-text">Detalles del Estudiante</h2>
        <br>
        <form method="post">
            <input type="hidden" name="id" id="studentId">
            <input type="hidden" name="accion2" value="actualizar">
            <div class="mb-3">
                <label for="studentCedula" class="form-label">CÉDULA</label>
                <input type="text" class="form-control" id="studentCedula" name="cedula" required>
            </div>
            <div class="mb-3">
                <label for="studentNombre" class="form-label">NOMBRE DEL ALUMNO</label>
                <input type="text" class="form-control" id="studentNombre" name="nombre" required>
            </div>
            <div class="mb-3">
                <label for="studentApellido" class="form-label">APELLIDO DEL ALUMNO</label>
                <input type="text" class="form-control" id="studentApellido" name="apellido" required>
            </div>
            <div class="mb-3">
                <label for="studentFechaNacimiento" class="form-label">FECHA DE NACIMIENTO</label>
                <input type="date" class="form-control" id="studentFechaNacimiento" name="fecha_nacimiento" required>
            </div>
            <div class="mb-3">
                <label for="studentEdad" class="form-label">EDAD</label>
                <input type="number" class="form-control" id="studentEdad" name="edad" required>
            </div>
            <div class="mb-3">
                <label for="studentEstadoCivil" class="form-label">ESTADO CIVIL</label>
                <input type="text" class="form-control" id="studentEstadoCivil" name="estado_civil">
            </div>
            <div class="mb-3">
                <label for="studentGenero" class="form-label">GÉNERO</label>
                <input type="text" class="form-control" id="studentGenero" name="genero" required>
            </div>
            <div class="mb-3">
                <label for="studentDireccion" class="form-label">DIRECCIÓN</label>
                <input type="text" class="form-control" id="studentDireccion" name="direccion" required>
            </div>
            <div class="mb-3">
                <label for="studentParroquia" class="form-label">PARROQUIA</label>
                <input type="text" class="form-control" id="studentParroquia" name="parroquia">
            </div>
            <div class="mb-3">
                <label for="studentRecinto" class="form-label">RECINTO</label>
                <input type="text" class="form-control" id="studentRecinto" name="recinto">
            </div>

            <div class="col-md-12 mb-3">
                <label for="cursos" class="form-label">CURSOS</label>
                <div style="border: 1px solid #ced4da; border-radius: .25rem; overflow-y: auto; max-height: 300px; padding: 0;">
                    <table class="table table-hover table-sm mb-0" style="font-size: 0.75rem; table-layout: auto;">
                        <thead>
                            <tr style="line-height: 1.2;">
                                <th style="width: 5%;"></th>
                                <th style="width: 15%;">Código</th>
                                <th style="width: 35%;">Nombre del Curso</th>
                                <th style="width: 20%;">Profesor</th>
                                <th style="width: 10%;">Inicio</th>
                                <th style="width: 10%;">Fin</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($cursos as $curso) { ?>
                                <tr style="line-height: 1.2;">
                                    <td style="padding: 4px 8px;"><input type="checkbox" name="cursos[]" value="<?php echo $curso['id']; ?>"></td>
                                    <td style="padding: 4px 8px;"><?php echo $curso['codigo_curso']; ?></td>
                                    <td style="padding: 4px 8px;"><?php echo $curso['nombre_curso']; ?></td>
                                    <td style="padding: 4px 8px;"><?php echo !empty($curso['profesor_curso']) ? $curso['profesor_curso'] : 'No asignado'; ?></td>
                                    <td style="padding: 4px 8px;"><?php echo $curso['hora_inicio']; ?></td>
                                    <td style="padding: 4px 8px;"><?php echo $curso['hora_fin']; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mb-3">
                <label for="studentTelefono" class="form-label">TELÉFONO</label>
                <input type="text" class="form-control" id="studentTelefono" name="telefono">
            </div>
            <div class="mb-3">
                <label for="studentCelular1" class="form-label">CELULAR 1</label>
                <input type="text" class="form-control" id="studentCelular1" name="celular_1" required>
            </div>
            <div class="mb-3">
                <label for="studentCelular2" class="form-label">CELULAR 2</label>
                <input type="text" class="form-control" id="studentCelular2" name="celular_2">
            </div>
            <div class="mb-3">
                <label for="studentCorreo" class="form-label">CORREO ELECTRÓNICO</label>
                <input type="email" class="form-control" id="studentCorreo" name="correo" required>
            </div>
            <div class="mb-3">
                <label for="studentNivelInstruccion" class="form-label">NIVEL DE INSTRUCCIÓN</label>
                <input type="text" class="form-control" id="studentNivelInstruccion" name="nivel_instruccion">
            </div>
            <div class="mb-3">
                <label for="studentUnidadEducativa" class="form-label">UNIDAD EDUCATIVA</label>
                <input type="text" class="form-control" id="studentUnidadEducativa" name="unidad_educativa">
            </div>
            <div class="mb-3">
                <label for="studentTieneHijos" class="form-label">¿TIENE HIJOS?</label>
                <input type="text" class="form-control" id="studentTieneHijos" name="tiene_hijos">
            </div>
            <div class="mb-3">
                <label for="studentCuantosHijos" class="form-label">¿CUÁNTOS HIJOS?</label>
                <input type="number" class="form-control" id="studentCuantosHijos" name="cuantos_hijos">
            </div>
            <div class="mb-3">
                <label for="studentTrabaja" class="form-label">¿TRABAJA?</label>
                <input type="text" class="form-control" id="studentTrabaja" name="trabaja">
            </div>
            <div class="mb-3">
                <label for="studentEnQueTrabaja" class="form-label">¿EN QUÉ TRABAJA?</label>
                <input type="text" class="form-control" id="studentEnQueTrabaja" name="en_que_trabaja">
            </div>
            <div class="mb-3">
                <label for="studentRecibidoCursos" class="form-label">¿RECIBIDO CURSOS?</label>
                <input type="text" class="form-control" id="studentRecibidoCursos" name="recibido_cursos">
            </div>
            <div class="mb-3">
                <label for="studentCursosRecibidos" class="form-label">¿QUÉ CURSOS?</label>
                <input type="text" class="form-control" id="studentCursosRecibidos" name="cursos_recibidos">
            </div>
            <div class="mb-3">
                <label for="studentIniciarEmprendimiento" class="form-label">¿INICIAR EMPRENDIMIENTO?</label>
                <input type="text" class="form-control" id="studentIniciarEmprendimiento" name="iniciar_emprendimiento">
            </div>
            <div class="mb-3">
                <label for="studentPoseeEmprendimiento" class="form-label">¿POSEE EMPRENDIMIENTO?</label>
                <input type="text" class="form-control" id="studentPoseeEmprendimiento" name="posee_emprendimiento">
            </div>
            <div class="mb-3">
                <label for="studentTipoEmprendimiento" class="form-label">TIPO DE EMPRENDIMIENTO</label>
                <input type="text" class="form-control" id="studentTipoEmprendimiento" name="tipo_emprendimiento">
            </div>
            <div class="mb-3">
                <label for="studentNombreEmprendimiento" class="form-label">NOMBRE DEL EMPRENDIMIENTO</label>
                <input type="text" class="form-control" id="studentNombreEmprendimiento" name="nombre_emprendimiento">
            </div>
            <div class="mb-3">
                <label for="studentParticiparFerias" class="form-label">¿PARTICIPAR FERIAS?</label>
                <input type="text" class="form-control" id="studentParticiparFerias" name="participar_ferias">
            </div>
            <button type="submit" class="btn btn-primary">Confirmar Edición</button>
        </form>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const checkboxes = document.querySelectorAll('#studentModal input[name="cursos[]"]');

        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const selectedCourses = [];

                // Recolectar horarios de los cursos seleccionados
                checkboxes.forEach(cb => {
                    if (cb.checked) {
                        const row = cb.closest('tr');
                        const startTime = row.querySelector('td:nth-child(5)').textContent.trim();
                        const endTime = row.querySelector('td:nth-child(6)').textContent.trim();
                        selectedCourses.push({
                            startTime,
                            endTime
                        });
                    }
                });

                // Verificar superposición de horarios
                if (hasOverlappingTimes(selectedCourses)) {
                    // Deseleccionar el curso que causa conflicto y mostrar una advertencia
                    this.checked = false;
                    alert('Este curso tiene un horario que se superpone con otro curso seleccionado.');
                }
            });
        });

        function hasOverlappingTimes(courses) {
            for (let i = 0; i < courses.length; i++) {
                for (let j = i + 1; j < courses.length; j++) {
                    const course1 = courses[i];
                    const course2 = courses[j];

                    if (timesOverlap(course1.startTime, course1.endTime, course2.startTime, course2.endTime)) {
                        return true;
                    }
                }
            }
            return false;
        }

        function timesOverlap(start1, end1, start2, end2) {
            return (start1 < end2 && end1 > start2);
        }
    });
</script>

<script>
    function openModal(alumno) {
        document.getElementById('studentId').value = alumno.id;
        document.getElementById('studentCedula').value = alumno.cedula;
        document.getElementById('studentNombre').value = alumno.nombre;
        document.getElementById('studentApellido').value = alumno.apellido;
        document.getElementById('studentFechaNacimiento').value = alumno.fecha_nacimiento;
        document.getElementById('studentEdad').value = alumno.edad;
        document.getElementById('studentEstadoCivil').value = alumno.estado_civil;
        document.getElementById('studentGenero').value = alumno.genero;
        document.getElementById('studentDireccion').value = alumno.direccion;
        document.getElementById('studentParroquia').value = alumno.parroquia;
        document.getElementById('studentRecinto').value = alumno.recinto;
        document.getElementById('studentTelefono').value = alumno.telefono;
        document.getElementById('studentCelular1').value = alumno.celular_1;
        document.getElementById('studentCelular2').value = alumno.celular_2;
        document.getElementById('studentCorreo').value = alumno.correo;
        document.getElementById('studentNivelInstruccion').value = alumno.nivel_instruccion;
        document.getElementById('studentUnidadEducativa').value = alumno.unidad_educativa;
        document.getElementById('studentTieneHijos').value = alumno.tiene_hijos;
        document.getElementById('studentCuantosHijos').value = alumno.cuantos_hijos;
        document.getElementById('studentTrabaja').value = alumno.trabaja;
        document.getElementById('studentEnQueTrabaja').value = alumno.en_que_trabaja;
        document.getElementById('studentRecibidoCursos').value = alumno.recibido_cursos;
        document.getElementById('studentCursosRecibidos').value = alumno.cursos_recibidos;
        document.getElementById('studentIniciarEmprendimiento').value = alumno.iniciar_emprendimiento;
        document.getElementById('studentPoseeEmprendimiento').value = alumno.posee_emprendimiento;
        document.getElementById('studentTipoEmprendimiento').value = alumno.tipo_emprendimiento;
        document.getElementById('studentNombreEmprendimiento').value = alumno.nombre_emprendimiento;
        document.getElementById('studentParticiparFerias').value = alumno.participar_ferias;
        document.getElementById('studentModal').style.display = 'block';
    }

    function closeModal() {
        document.getElementById('studentModal').style.display = 'none';
    }

    // Abre el modal de cursos inscritos del estudiante
    document.addEventListener('DOMContentLoaded', function() {
        <?php if (isset($cursosEstudiante)) { ?>
            document.getElementById('cursosModal').style.display = 'block';
        <?php } ?>
    });

    function closeCursosModal() {
        document.getElementById('cursosModal').style.display = 'none';
    }
</script>

<?php include('../templates/pie.php'); ?>