<?php include('../templates/cabecera.php'); ?>
<?php include('../secciones/alumnos.php'); ?>

<?php
// Conexión a la base de datos y consulta para obtener la lista de estudiantes y cursos con el profesor
$sql = "SELECT a.cedula, a.nombre, a.apellido, c.codigo_curso, c.nombre_curso, c.hora_inicio, c.hora_fin, c.profesor_curso
        FROM alumnos a
        INNER JOIN alumnos_cursos ac ON a.id = ac.idalumno
        INNER JOIN cursos c ON ac.idcurso = c.id";
$consulta = $conexionBD->prepare($sql);
$consulta->execute();
$listaEstudiantes = $consulta->fetchAll(PDO::FETCH_ASSOC);
?>

<link rel="stylesheet" href="../cursos.css">
<div class="blur-overlay"></div>

<div class="row">
    <div class="col-12">
        <div class="row">
            <div class="col-md-12">
                <form action="" method="post">
                    <div class="card">
                        <div class="card-header" style="text-align: center;">
                            Registrar Nuevo Estudiante
                            <h6>Informacion personal</h6>
                        </div>
                        <div class="card-body">
                            <h6>Campos con * son obligatorios</h6>
                            <div class="row">
                                <!-- CÉDULA -->
                                <div class="col-md-2 mb-3 me-3">
                                    <label for="cedula" class="form-label">Cédula*</label>
                                    <input type="number" class="form-control" name="cedula" id="cedula" placeholder="0950885414" required />
                                </div>
                            </div>
                            <div class="row">
                                <!-- NOMBRE -->
                                <div class="col-md-6 mb-3">
                                    <label for="nombre" class="form-label">Nombre del Estudiante*</label>
                                    <input type="text" class="form-control" name="nombre" id="nombre" aria-describedby="helpId" placeholder="Escriba los nombres" required />
                                </div>
                                <!-- APELLIDO -->
                                <div class="col-md-6 mb-3">
                                    <label for="apellido" class="form-label">Apellido del Estudiante*</label>
                                    <input type="text" class="form-control" name="apellido" id="apellido" aria-describedby="helpId" placeholder="Escriba los apellidos" required />
                                </div>
                                <!-- FECHA DE NACIMIENTO -->
                                <div class="col-md-6 mb-3">
                                    <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento*</label>
                                    <input type="date" class="form-control" name="fecha_nacimiento" id="fecha_nacimiento" placeholder="" required />
                                </div>
                                <!-- EDAD -->
                                <div class="col-md-6 mb-3">
                                    <label for="edad" class="form-label">Edad*</label>
                                    <input type="number" class="form-control" name="edad" id="edad" placeholder="" required />
                                </div>
                                <!-- ESTADO CIVIL -->
                                <div class="col-md-6 mb-3">
                                    <label for="estado_civil" class="form-label">Estado Civil</label>
                                    <select class="form-control" name="estado_civil" id="estado_civil">
                                        <option value="" disabled selected>Seleccione su estado civil</option>
                                        <option value="soltero">Soltero/a</option>
                                        <option value="casado">Casado/a</option>
                                        <option value="viudo">Viudo/a</option>
                                        <option value="divorciado">Divorciado/a</option>
                                        <option value="union_hecho">Unión de hecho</option>
                                    </select>
                                </div>
                                <!-- GÉNERO -->
                                <div class="col-md-6 mb-3">
                                    <label for="genero" class="form-label">Género*</label>
                                    <select class="form-control" name="genero" id="genero">
                                        <option value="MASCULINO">MASCULINO</option>
                                        <option value="FEMENINO">FEMENINO</option>
                                    </select>
                                </div>
                                <!-- DIRECCIÓN DOMICILIARIA -->
                                <div class="col-md-6 mb-3">
                                    <label for="direccion" class="form-label">Dirección Domiciliaria*</label>
                                    <input type="text" class="form-control" name="direccion" id="direccion" placeholder="" required />
                                </div>
                                <!-- PARROQUIA -->
                                <div class="col-md-6 mb-3">
                                    <label for="parroquia" class="form-label">Parroquia</label>
                                    <input type="text" class="form-control" name="parroquia" id="parroquia" placeholder="" />
                                </div>
                                <!-- RECINTO -->
                                <div class="col-md-6 mb-3">
                                    <label for="recinto" class="form-label">Recinto</label>
                                    <input type="text" class="form-control" name="recinto" id="recinto" placeholder="" />
                                </div>
                                <!-- Tabla de cursos -->
                                <div class="col-md-12 mb-3">
                                    <label for="cursos" class="form-label">CURSOS</label>
                                    <div style="border: 1px solid #ced4da; border-radius: .25rem; overflow-y: auto; max-height: 300px; padding: 0; width: 100%;">
                                        <table class="table table-hover table-sm mb-0" style="font-size: 0.75rem; table-layout: fixed; width: 100%;">
                                            <thead>
                                                <tr>
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
                                                    <tr>
                                                        <td><input type="checkbox" name="cursos[]" value="<?php echo $curso['id']; ?>"></td>
                                                        <td><?php echo $curso['codigo_curso']; ?></td>
                                                        <td><?php echo $curso['nombre_curso']; ?></td>
                                                        <td><?php echo $curso['profesor_curso']; ?></td>
                                                        <td><?php echo $curso['hora_inicio']; ?></td>
                                                        <td><?php echo $curso['hora_fin']; ?></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <h4>INFORMACIÓN DE CONTACTO:</h4>
                                <div class="row">
                                    <!-- TELÉFONO -->
                                    <div class="col-md-6 mb-3">
                                        <label for="telefono" class="form-label">Teléfono</label>
                                        <input type="number" class="form-control" name="telefono" id="telefono" placeholder="" />
                                    </div>
                                    <!-- CELULAR 1 -->
                                    <div class="col-md-6 mb-3">
                                        <label for="celular_1" class="form-label">No. de Celular 1*</label>
                                        <input type="number" class="form-control" name="celular_1" id="celular_1" placeholder="" maxlength="10" required />
                                    </div>
                                    <!-- CELULAR 2 -->
                                    <div class="col-md-6 mb-3">
                                        <label for="celular_2" class="form-label">No. de Celular 2</label>
                                        <input type="number" class="form-control" name="celular_2" id="celular_2" placeholder="" maxlength="10" />
                                    </div>
                                    <!-- CORREO ELECTRÓNICO -->
                                    <div class="col-md-6 mb-3">
                                        <label for="correo" class="form-label">Correo Electrónico*</label>
                                        <input type="email" class="form-control" name="correo" id="correo" placeholder="" required />
                                    </div>
                                </div>
                            </div>
                            <div>
                                <h4>REDES SOCIALES:</h4>
                                <div class="row">
                                    <!-- TIENE REDES -->
                                    <div class="col-md-6 mb-3">
                                        <label for="tiene_redes" class="form-label">¿Tiene redes sociales?*</label>
                                        <select class="form-control" name="tiene_redes" id="tiene_redes">
                                            <option value="no">NO</option>
                                            <option value="si">SI</option>
                                        </select>
                                    </div>
                                    <!-- TIKTOK -->
                                    <div class="col-md-6 mb-3">
                                        <label for="tiktok" class="form-label">TikTok</label>
                                        <input type="text" class="form-control" name="tiktok" id="tiktok" placeholder="" disabled />
                                    </div>
                                    <!-- FACEBOOK -->
                                    <div class="col-md-6 mb-3">
                                        <label for="facebook" class="form-label">Facebook</label>
                                        <input type="text" class="form-control" name="facebook" id="facebook" placeholder="" disabled />
                                    </div>
                                    <!-- INSTAGRAM -->
                                    <div class="col-md-6 mb-3">
                                        <label for="instagram" class="form-label">Instagram</label>
                                        <input type="text" class="form-control" name="instagram" id="instagram" placeholder="" disabled />
                                    </div>
                                </div>
                            </div>
                            <div>
                                <h4>INFORMACIÓN ACADÉMICA:</h4>
                                <div class="row">
                                    <!-- NIVEL DE INSTRUCCIÓN -->
                                    <div class="col-md-6 mb-3">
                                        <label for="nivel_instruccion" class="form-label">Nivel de Instrucción*</label>
                                        <select class="form-control" name="nivel_instruccion" id="nivel_instruccion">
                                            <option value="PRIMARIA">PRIMARIA</option>
                                            <option value="SECUNDARIA">SECUNDARIA</option>
                                            <option value="CURSANDO UNIVERSIDAD">CURSANDO UNIVERSIDAD</option>
                                            <option value="TERCER NIVEL">TERCER NIVEL</option>
                                        </select>
                                    </div>
                                    <!-- UNIDAD EDUCATIVA -->
                                    <div class="col-md-6 mb-3">
                                        <label for="unidad_educativa" class="form-label">Unidad Educativa en la que Estudia</label>
                                        <input type="text" class="form-control" name="unidad_educativa" id="unidad_educativa" placeholder="" required />
                                    </div>
                                </div>
                            </div>
                            <div>
                                <h4>DATOS GENERALES:</h4>
                                <div class="row">
                                    <!-- TIENE HIJOS // se la cambio por discapacidad-->
                                    <div class="col-md-6 mb-3">
                                        <label for="tiene_hijos" class="form-label">¿Tiene alguna discapacidad?</label>
                                        <select class="form-control" name="tiene_hijos" id="tiene_hijos">
                                            <option value="no">NO</option>
                                            <option value="si">SI</option>
                                        </select>
                                    </div>
                                    <!-- CUANTOS HIJOS // se la cambio por discapacidad -->
                                    <div class="col-md-6 mb-3">
                                        <label for="cuantos_hijos" class="form-label">¿Cuál es?</label>
                                        <input type="text" class="form-control" name="cuantos_hijos" id="cuantos_hijos" placeholder="" disabled />
                                    </div>
                                    <!-- TRABAJA -->
                                    <div class="col-md-6 mb-3">
                                        <label for="trabaja" class="form-label">¿Usted trabaja?</label>
                                        <select class="form-control" name="trabaja" id="trabaja">
                                            <option value="no">NO</option>
                                            <option value="si">SI</option>
                                        </select>
                                    </div>
                                    <!-- EN QUE TRABAJA -->
                                    <div class="col-md-6 mb-3">
                                        <label for="en_que_trabaja" class="form-label">Si es si, ¿En qué trabaja?</label>
                                        <input type="text" class="form-control" name="en_que_trabaja" id="en_que_trabaja" placeholder="" disabled />
                                    </div>
                                    <!-- RECIBIDO CURSOS -->
                                    <div class="col-md-6 mb-3">
                                        <label for="recibido_cursos" class="form-label">¿Usted ha recibido cursos en CEYOM anteriormente?</label>
                                        <select class="form-control" name="recibido_cursos" id="recibido_cursos">
                                            <option value="no">NO</option>
                                            <option value="si">SI</option>
                                        </select>
                                    </div>
                                    <!-- CURSOS RECIBIDOS -->
                                    <div class="col-md-6 mb-3">
                                        <label for="cursos_recibidos" class="form-label">Si es si, ¿Qué cursos ha recibido?</label>
                                        <input type="text" class="form-control" name="cursos_recibidos" id="cursos_recibidos" placeholder="" disabled />
                                    </div>
                                    <!-- INICIAR EMPRENDIMIENTO -->
                                    <div class="col-md-6 mb-3">
                                        <label for="iniciar_emprendimiento" class="form-label">¿Usted toma los cursos para iniciar un Emprendimiento?</label>
                                        <select class="form-control" name="iniciar_emprendimiento" id="iniciar_emprendimiento">
                                            <option value="no">NO</option>
                                            <option value="si">SI</option>
                                        </select>
                                    </div>
                                    <!-- POSEE EMPRENDIMIENTO -->
                                    <div class="col-md-6 mb-3">
                                        <label for="posee_emprendimiento" class="form-label">¿Usted posee algún emprendimiento?</label>
                                        <select class="form-control" name="posee_emprendimiento" id="posee_emprendimiento">
                                            <option value="no">NO</option>
                                            <option value="si">SI</option>
                                        </select>
                                    </div>
                                    <!-- TIPO DE EMPRENDIMIENTO -->
                                    <div class="col-md-6 mb-3">
                                        <label for="tipo_emprendimiento" class="form-label">Si es si, ¿Qué tipo de emprendimiento tiene?</label>
                                        <input type="text" class="form-control" name="tipo_emprendimiento" id="tipo_emprendimiento" placeholder="" disabled />
                                    </div>
                                    <!-- NOMBRE DEL EMPRENDIMIENTO -->
                                    <div class="col-md-6 mb-3">
                                        <label for="nombre_emprendimiento" class="form-label">¿Cómo se llama su emprendimiento?</label>
                                        <input type="text" class="form-control" name="nombre_emprendimiento" id="nombre_emprendimiento" placeholder="" disabled />
                                    </div>
                                    <!-- PARTICIPAR FERIAS -->
                                    <div class="col-md-6 mb-3">
                                        <label for="participar_ferias" class="form-label">¿Le gustaría participar en ferias?</label>
                                        <select class="form-control" name="participar_ferias" id="participar_ferias">
                                            <option value="no">NO</option>
                                            <option value="si">SI</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer" style="margin-top: 20px; text-align: right;">
                            <button type="submit" name="accion2" value="registrar" class="btn" style="background-color: #ffc107; color: white;">Registrar Estudiante</button>
                        </div>
                    </div>
                </form>
                <br>
                <br>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const checkboxes = document.querySelectorAll('input[name="cursos[]"]');

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
    const ids = ['cedula', 'telefono', 'celular_1', 'celular_2'];

    ids.forEach(id => {
        const input = document.getElementById(id);

        input.addEventListener('input', () => {
            if (input.value.length > 10) {
                input.value = input.value.slice(0, 10);
            }
        });

        input.addEventListener('blur', () => {
            if (input.value.length !== 10 && input.value.length > 0) {
                alert('El campo debe tener exactamente 10 dígitos.');
                return;
            }

            if (id === 'cedula' && input.value.length === 10) {
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "../secciones/alumnos.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        var response = JSON.parse(xhr.responseText);
                        if (response.exists) {
                            alert("La cédula ya está registrada.");
                            document.getElementById('cedula').value = ''; // Limpia el campo de cédula
                        }
                    }
                };
                xhr.send("cedula=" + input.value + "&verificar_cedula=true");
            }
        });
    });
</script>

<script>
    document.getElementById('tiene_hijos').addEventListener('change', function() {
        var cuantosHijos = document.getElementById('cuantos_hijos');
        cuantosHijos.disabled = this.value === 'no';
    });

    document.getElementById('trabaja').addEventListener('change', function() {
        var enQueTrabaja = document.getElementById('en_que_trabaja');
        enQueTrabaja.disabled = this.value === 'no';
    });

    document.getElementById('recibido_cursos').addEventListener('change', function() {
        var queCursos = document.getElementById('cursos_recibidos');
        queCursos.disabled = this.value === 'no';
    });

    document.getElementById('posee_emprendimiento').addEventListener('change', function() {
        var tipoEmprendimiento = document.getElementById('tipo_emprendimiento');
        var nombreEmprendimiento = document.getElementById('nombre_emprendimiento');
        var disabled = this.value === 'no';
        tipoEmprendimiento.disabled = disabled;
        nombreEmprendimiento.disabled = disabled;
    });

    document.getElementById('tiene_redes').addEventListener('change', function() {
        var TIKTOK = document.getElementById('tiktok');
        var INSTAGRAM = document.getElementById('instagram');
        var FACEBOOK = document.getElementById('facebook');
        var disabled = this.value === 'no';
        TIKTOK.disabled = disabled;
        INSTAGRAM.disabled = disabled;
        FACEBOOK.disabled = disabled;
    })

    document.getElementById('fecha_nacimiento').addEventListener('change', function() {
        const nacimiento = new Date(this.value);
        const hoy = new Date();
        const edad = hoy.getFullYear() - nacimiento.getFullYear();

        document.getElementById('edad').value = edad;
    });
</script>

<?php include('../templates/pie.php'); ?>