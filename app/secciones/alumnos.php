<?php
include_once '../configuraciones/bd.php';
$conexionBD = BD::crearInstancia();

$id = isset($_POST['id']) ? $_POST['id'] : '';
$cedula = isset($_POST['cedula']) ? $_POST['cedula'] : '';
$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
$apellido = isset($_POST['apellido']) ? $_POST['apellido'] : '';
$fecha_nacimiento = isset($_POST['fecha_nacimiento']) ? $_POST['fecha_nacimiento'] : '';
$edad = isset($_POST['edad']) ? $_POST['edad'] : '';
$estado_civil = isset($_POST['estado_civil']) ? $_POST['estado_civil'] : '';
$genero = isset($_POST['genero']) ? $_POST['genero'] : '';
$direccion = isset($_POST['direccion']) ? $_POST['direccion'] : '';
$parroquia = isset($_POST['parroquia']) ? $_POST['parroquia'] : '';
$recinto = isset($_POST['recinto']) ? $_POST['recinto'] : '';
$telefono = isset($_POST['telefono']) ? $_POST['telefono'] : '';
$celular_1 = isset($_POST['celular_1']) ? $_POST['celular_1'] : '';
$celular_2 = isset($_POST['celular_2']) ? $_POST['celular_2'] : '';
$correo = isset($_POST['correo']) ? $_POST['correo'] : '';
$tiene_redes = isset($_POST['tiene_redes']) ? $_POST['tiene_redes'] : '';
$tiktok = isset($_POST['tiktok']) ? $_POST['tiktok'] : '';
$facebook = isset($_POST['facebook']) ? $_POST['facebook'] : '';
$instagram = isset($_POST['instagram']) ? $_POST['instagram'] : '';
$nivel_instruccion = isset($_POST['nivel_instruccion']) ? $_POST['nivel_instruccion'] : '';
$unidad_educativa = isset($_POST['unidad_educativa']) ? $_POST['unidad_educativa'] : '';
$tiene_hijos = isset($_POST['tiene_hijos']) ? $_POST['tiene_hijos'] : '';
$cuantos_hijos = isset($_POST['cuantos_hijos']) ? $_POST['cuantos_hijos'] : '';
$trabaja = isset($_POST['trabaja']) ? $_POST['trabaja'] : '';
$en_que_trabaja = isset($_POST['en_que_trabaja']) ? $_POST['en_que_trabaja'] : '';
$recibido_cursos = isset($_POST['recibido_cursos']) ? $_POST['recibido_cursos'] : '';
$cursos_recibidos = isset($_POST['cursos_recibidos']) ? $_POST['cursos_recibidos'] : '';
$iniciar_emprendimiento = isset($_POST['iniciar_emprendimiento']) ? $_POST['iniciar_emprendimiento'] : '';
$posee_emprendimiento = isset($_POST['posee_emprendimiento']) ? $_POST['posee_emprendimiento'] : '';
$tipo_emprendimiento = isset($_POST['tipo_emprendimiento']) ? $_POST['tipo_emprendimiento'] : '';
$nombre_emprendimiento = isset($_POST['nombre_emprendimiento']) ? $_POST['nombre_emprendimiento'] : '';
$participar_ferias = isset($_POST['participar_ferias']) ? $_POST['participar_ferias'] : '';
$calificacion = isset($_POST['calificacion']) ? $_POST['calificacion'] : null; // Variable calificacion añadida
$accion2 = isset($_POST['accion2']) ? $_POST['accion2'] : '';

// Verificar si cedula no esta repetida
if (isset($_POST['cedula']) && isset($_POST['verificar_cedula'])) {
    $cedula = $_POST['cedula'];
    $sql = "SELECT COUNT(*) FROM alumnos WHERE cedula = :cedula";
    $stmt = $conexionBD->prepare($sql);
    $stmt->bindParam(':cedula', $cedula);
    $stmt->execute();
    $exists = $stmt->fetchColumn();

    echo json_encode(['exists' => $exists > 0]);
    exit;
}

if ($accion2 != '') {
    switch ($accion2) {
        case 'registrar':
            // Verificar si la cédula ya está registrada
            $sqlVerificar = "SELECT COUNT(*) FROM alumnos WHERE cedula = :cedula";
            $consultaVerificar = $conexionBD->prepare($sqlVerificar);
            $consultaVerificar->bindParam(':cedula', $cedula);
            $consultaVerificar->execute();
            $existeCedula = $consultaVerificar->fetchColumn();

            if ($existeCedula > 0) {
                echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
                echo "<script>Swal.fire({ icon: 'error', title: 'La cédula ya está registrada.', showConfirmButton: true });</script>";
            } else {
                // Inserción del nuevo alumno
                $sql = "INSERT INTO alumnos (
                    cedula, nombre, apellido, fecha_nacimiento, edad, estado_civil, genero, direccion, parroquia, recinto,
                    telefono, celular_1, celular_2, correo, tiene_redes, tiktok, facebook, instagram, nivel_instruccion,
                    unidad_educativa, tiene_hijos, cuantos_hijos, trabaja, en_que_trabaja, recibido_cursos, cursos_recibidos,
                    iniciar_emprendimiento, posee_emprendimiento, tipo_emprendimiento, nombre_emprendimiento, participar_ferias,
                    calificacion
                ) VALUES (
                    :cedula, :nombre, :apellido, :fecha_nacimiento, :edad, :estado_civil, :genero, :direccion, :parroquia, :recinto,
                    :telefono, :celular_1, :celular_2, :correo, :tiene_redes, :tiktok, :facebook, :instagram, :nivel_instruccion,
                    :unidad_educativa, :tiene_hijos, :cuantos_hijos, :trabaja, :en_que_trabaja, :recibido_cursos, :cursos_recibidos,
                    :iniciar_emprendimiento, :posee_emprendimiento, :tipo_emprendimiento, :nombre_emprendimiento, :participar_ferias,
                    :calificacion
                )";
                $consulta = $conexionBD->prepare($sql);
                $consulta->bindParam(':cedula', $cedula);
                $consulta->bindParam(':nombre', $nombre);
                $consulta->bindParam(':apellido', $apellido);
                $consulta->bindParam(':fecha_nacimiento', $fecha_nacimiento);
                $consulta->bindParam(':edad', $edad, PDO::PARAM_INT);
                $consulta->bindParam(':estado_civil', $estado_civil);
                $consulta->bindParam(':genero', $genero);
                $consulta->bindParam(':direccion', $direccion);
                $consulta->bindParam(':parroquia', $parroquia);
                $consulta->bindParam(':recinto', $recinto);
                $consulta->bindParam(':telefono', $telefono);
                $consulta->bindParam(':celular_1', $celular_1);
                $consulta->bindParam(':celular_2', $celular_2);
                $consulta->bindParam(':correo', $correo);
                $consulta->bindParam(':tiene_redes', $tiene_redes);
                $consulta->bindParam(':tiktok', $tiktok);
                $consulta->bindParam(':facebook', $facebook);
                $consulta->bindParam(':instagram', $instagram);
                $consulta->bindParam(':nivel_instruccion', $nivel_instruccion);
                $consulta->bindParam(':unidad_educativa', $unidad_educativa);
                $consulta->bindParam(':tiene_hijos', $tiene_hijos);
                $consulta->bindParam(':cuantos_hijos', $cuantos_hijos);
                $consulta->bindParam(':trabaja', $trabaja);
                $consulta->bindParam(':en_que_trabaja', $en_que_trabaja);
                $consulta->bindParam(':recibido_cursos', $recibido_cursos);
                $consulta->bindParam(':cursos_recibidos', $cursos_recibidos);
                $consulta->bindParam(':iniciar_emprendimiento', $iniciar_emprendimiento);
                $consulta->bindParam(':posee_emprendimiento', $posee_emprendimiento);
                $consulta->bindParam(':tipo_emprendimiento', $tipo_emprendimiento);
                $consulta->bindParam(':nombre_emprendimiento', $nombre_emprendimiento);
                $consulta->bindParam(':participar_ferias', $participar_ferias);
                $consulta->bindParam(':calificacion', $calificacion, PDO::PARAM_STR); // Asegúrate de enlazar calificacion
                if ($consulta->execute()) {
                    // Obtener el ID del alumno recién insertado
                    $idalumno = $conexionBD->lastInsertId();

                    // Insertar los cursos seleccionados en 'alumnos_cursos'
                    if (!empty($_POST['cursos'])) {
                        foreach ($_POST['cursos'] as $idcurso) {
                            $sqlCurso = "INSERT INTO alumnos_cursos (idalumno, idcurso) VALUES (:idalumno, :idcurso)";
                            $consultaCurso = $conexionBD->prepare($sqlCurso);
                            $consultaCurso->bindParam(':idalumno', $idalumno);
                            $consultaCurso->bindParam(':idcurso', $idcurso);
                            $consultaCurso->execute();
                        }
                    }

                    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
                    echo "<script>Swal.fire({ icon: 'success', title: 'Estudiante registrado exitosamente con los cursos.', showConfirmButton: true });</script>";
                } else {
                    $errorMsg = "Error al registrar estudiante: " . implode(":", $consulta->errorInfo());
                    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
                    echo "<script>Swal.fire({ icon: 'error', title: '$errorMsg', showConfirmButton: true });</script>";
                }
            }
            break;

        case 'Seleccionar':
            $sql = "SELECT * FROM alumnos WHERE id=:id";
            $consulta = $conexionBD->prepare($sql);
            $consulta->bindParam(':id', $id);
            $consulta->execute();
            $alumno = $consulta->fetch(PDO::FETCH_ASSOC);
            if ($alumno) {
                $cedula = $alumno['cedula'];
                $nombre = $alumno['nombre'];
                $apellido = $alumno['apellido'];
                $fecha_nacimiento = $alumno['fecha_nacimiento'];
                $edad = $alumno['edad'];
                $estado_civil = $alumno['estado_civil'];
                $genero = $alumno['genero'];
                $direccion = $alumno['direccion'];
                $parroquia = $alumno['parroquia'];
                $recinto = $alumno['recinto'];
                $telefono = $alumno['telefono'];
                $celular_1 = $alumno['celular_1'];
                $celular_2 = $alumno['celular_2'];
                $correo = $alumno['correo'];
                $tiene_redes = $alumno['tiene_redes'];
                $tiktok = $alumno['tiktok'];
                $facebook = $alumno['facebook'];
                $instagram = $alumno['instagram'];
                $nivel_instruccion = $alumno['nivel_instruccion'];
                $unidad_educativa = $alumno['unidad_educativa'];
                $tiene_hijos = $alumno['tiene_hijos'];
                $cuantos_hijos = $alumno['cuantos_hijos'];
                $trabaja = $alumno['trabaja'];
                $en_que_trabaja = $alumno['en_que_trabaja'];
                $recibido_cursos = $alumno['recibido_cursos'];
                $cursos_recibidos = $alumno['cursos_recibidos'];
                $iniciar_emprendimiento = $alumno['iniciar_emprendimiento'];
                $posee_emprendimiento = $alumno['posee_emprendimiento'];
                $tipo_emprendimiento = $alumno['tipo_emprendimiento'];
                $nombre_emprendimiento = $alumno['nombre_emprendimiento'];
                $participar_ferias = $alumno['participar_ferias'];
                $calificacion = $alumno['calificacion']; // Añadir la calificación
            } else {
                echo "No se encontró el alumno con ID: $id";
            }
            break;

        case 'actualizar':
            // Asegurarse de que el ID del alumno esté presente
            if (!empty($id)) {
                // Preparar la consulta de actualización para los datos del alumno
                $sqlActualizar = "UPDATE alumnos SET 
                        cedula = :cedula, 
                        nombre = :nombre, 
                        apellido = :apellido, 
                        fecha_nacimiento = :fecha_nacimiento, 
                        edad = :edad, 
                        estado_civil = :estado_civil, 
                        genero = :genero, 
                        direccion = :direccion, 
                        parroquia = :parroquia, 
                        recinto = :recinto, 
                        telefono = :telefono, 
                        celular_1 = :celular_1, 
                        celular_2 = :celular_2, 
                        correo = :correo, 
                        tiene_redes = :tiene_redes, 
                        tiktok = :tiktok, 
                        facebook = :facebook, 
                        instagram = :instagram, 
                        nivel_instruccion = :nivel_instruccion, 
                        unidad_educativa = :unidad_educativa, 
                        tiene_hijos = :tiene_hijos, 
                        cuantos_hijos = :cuantos_hijos, 
                        trabaja = :trabaja, 
                        en_que_trabaja = :en_que_trabaja, 
                        recibido_cursos = :recibido_cursos, 
                        cursos_recibidos = :cursos_recibidos, 
                        iniciar_emprendimiento = :iniciar_emprendimiento, 
                        posee_emprendimiento = :posee_emprendimiento, 
                        tipo_emprendimiento = :tipo_emprendimiento, 
                        nombre_emprendimiento = :nombre_emprendimiento, 
                        participar_ferias = :participar_ferias, 
                        calificacion = :calificacion 
                        WHERE id = :id";

                $consultaActualizar = $conexionBD->prepare($sqlActualizar);

                // Vinculamos los parámetros
                $consultaActualizar->bindParam(':cedula', $cedula);
                $consultaActualizar->bindParam(':nombre', $nombre);
                $consultaActualizar->bindParam(':apellido', $apellido);
                $consultaActualizar->bindParam(':fecha_nacimiento', $fecha_nacimiento);
                $consultaActualizar->bindParam(':edad', $edad, PDO::PARAM_INT);
                $consultaActualizar->bindParam(':estado_civil', $estado_civil);
                $consultaActualizar->bindParam(':genero', $genero);
                $consultaActualizar->bindParam(':direccion', $direccion);
                $consultaActualizar->bindParam(':parroquia', $parroquia);
                $consultaActualizar->bindParam(':recinto', $recinto);
                $consultaActualizar->bindParam(':telefono', $telefono);
                $consultaActualizar->bindParam(':celular_1', $celular_1);
                $consultaActualizar->bindParam(':celular_2', $celular_2);
                $consultaActualizar->bindParam(':correo', $correo);
                $consultaActualizar->bindParam(':tiene_redes', $tiene_redes);
                $consultaActualizar->bindParam(':tiktok', $tiktok);
                $consultaActualizar->bindParam(':facebook', $facebook);
                $consultaActualizar->bindParam(':instagram', $instagram);
                $consultaActualizar->bindParam(':nivel_instruccion', $nivel_instruccion);
                $consultaActualizar->bindParam(':unidad_educativa', $unidad_educativa);
                $consultaActualizar->bindParam(':tiene_hijos', $tiene_hijos);
                $consultaActualizar->bindParam(':cuantos_hijos', $cuantos_hijos);
                $consultaActualizar->bindParam(':trabaja', $trabaja);
                $consultaActualizar->bindParam(':en_que_trabaja', $en_que_trabaja);
                $consultaActualizar->bindParam(':recibido_cursos', $recibido_cursos);
                $consultaActualizar->bindParam(':cursos_recibidos', $cursos_recibidos);
                $consultaActualizar->bindParam(':iniciar_emprendimiento', $iniciar_emprendimiento);
                $consultaActualizar->bindParam(':posee_emprendimiento', $posee_emprendimiento);
                $consultaActualizar->bindParam(':tipo_emprendimiento', $tipo_emprendimiento);
                $consultaActualizar->bindParam(':nombre_emprendimiento', $nombre_emprendimiento);
                $consultaActualizar->bindParam(':participar_ferias', $participar_ferias);
                $consultaActualizar->bindParam(':calificacion', $calificacion, PDO::PARAM_STR);
                $consultaActualizar->bindParam(':id', $id, PDO::PARAM_INT);

                // Ejecutar la consulta de actualización
                if ($consultaActualizar->execute()) {
                    // Si la actualización fue exitosa, actualizar los cursos asociados
                    if (!empty($_POST['cursos'])) {
                        // Eliminar los cursos actuales del alumno
                        $sqlEliminarCursos = "DELETE FROM alumnos_cursos WHERE idalumno = :id";
                        $consultaEliminar = $conexionBD->prepare($sqlEliminarCursos);
                        $consultaEliminar->bindParam(':id', $id);
                        $consultaEliminar->execute();

                        // Insertar los nuevos cursos seleccionados
                        foreach ($_POST['cursos'] as $idcurso) {
                            $sqlCurso = "INSERT INTO alumnos_cursos (idalumno, idcurso) VALUES (:idalumno, :idcurso)";
                            $consultaCurso = $conexionBD->prepare($sqlCurso);
                            $consultaCurso->bindParam(':idalumno', $id);
                            $consultaCurso->bindParam(':idcurso', $idcurso);
                            $consultaCurso->execute();
                        }
                    }

                    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
                    echo "<script>Swal.fire({ icon: 'success', title: 'Datos y cursos actualizados correctamente.', showConfirmButton: true });</script>";
                } else {
                    $errorMsg = "Error al actualizar los datos: " . implode(":", $consultaActualizar->errorInfo());
                    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
                    echo "<script>Swal.fire({ icon: 'error', title: '$errorMsg', showConfirmButton: true });</script>";
                }
            } else {
                echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
                echo "<script>Swal.fire({ icon: 'error', title: 'ID de alumno no proporcionado.', showConfirmButton: true });</script>";
            }
            break;

            /*           if (isset($_POST['cedula']) && isset($_POST['calificacion'])) {
                $cedula = $_POST['cedula'];
                $calificaciones = $_POST['calificacion'];

                // Obtener el ID del alumno a partir de la cédula
                $sqlAlumno = "SELECT id FROM alumnos WHERE cedula = :cedula";
                $consultaAlumno = $conexionBD->prepare($sqlAlumno);
                $consultaAlumno->bindParam(':cedula', $cedula);
                $consultaAlumno->execute();
                $alumno = $consultaAlumno->fetch(PDO::FETCH_ASSOC);

                if ($alumno) {
                    $idalumno = $alumno['id'];

                    // Actualizar las calificaciones en alumnos_cursos
                    foreach ($calificaciones as $idcurso => $calificacion) {
                        $sqlActualizar = "UPDATE alumnos_cursos SET calificacion = :calificacion WHERE idalumno = :idalumno AND idcurso = :idcurso";
                        $consultaActualizar = $conexionBD->prepare($sqlActualizar);
                        $consultaActualizar->bindParam(':calificacion', $calificacion, PDO::PARAM_STR);
                        $consultaActualizar->bindParam(':idalumno', $idalumno);
                        $consultaActualizar->bindParam(':idcurso', $idcurso);
                        $consultaActualizar->execute();
                    }

                    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
                    echo "<script>Swal.fire({ icon: 'success', title: 'Calificaciones actualizadas correctamente.', showConfirmButton: true });</script>";
                } else {
                    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
                    echo "<script>Swal.fire({ icon: 'error', title: 'Estudiante no encontrado.', showConfirmButton: true });</script>";
                }
            }
            break; */

        case 'borrar':
            $sql = "DELETE FROM alumnos WHERE id=:id";
            $consulta = $conexionBD->prepare($sql);
            $consulta->bindParam(':id', $id);
            if ($consulta->execute()) {
                echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
                echo "<script>Swal.fire({ icon: 'success', title: 'Alumno eliminado exitosamente.', showConfirmButton: true });</script>";
            } else {
                $errorMsg = "Error al eliminar alumno: " . implode(":", $consulta->errorInfo());
                echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
                echo "<script>Swal.fire({ icon: 'error', title: '$errorMsg', showConfirmButton: true });</script>";
            }
            break;
    }
}

// Consulta para listar todos los alumnos
$sql = "SELECT * FROM alumnos";
$listaAlumnos = $conexionBD->query($sql);
$alumnos = $listaAlumnos->fetchAll(PDO::FETCH_ASSOC);

// Consulta para listar todos los cursos
$sql = "SELECT * FROM cursos";
$listaCursos = $conexionBD->query($sql);
$cursos = $listaCursos->fetchAll(PDO::FETCH_ASSOC);

// Función para obtener los cursos en los que está inscrito un estudiante
function obtenerCursosPorEstudiante($conexionBD, $idEstudiante)
{
    $sql = "SELECT c.codigo_curso, c.nombre_curso, c.ciclo_curso, c.hora_inicio, c.hora_fin, c.sede_curso, c.jornada_curso, c.profesor_curso
            FROM cursos c
            INNER JOIN alumnos_cursos ac ON c.id = ac.idcurso
            WHERE ac.idalumno = :idEstudiante";
    $consulta = $conexionBD->prepare($sql);
    $consulta->bindParam(':idEstudiante', $idEstudiante);
    $consulta->execute();
    return $consulta->fetchAll(PDO::FETCH_ASSOC);
}
