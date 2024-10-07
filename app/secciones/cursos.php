<?php
include_once '../configuraciones/bd.php';
$conexionBD = BD::crearInstancia();

// Recuperar datos del formulario
$id = isset($_POST['id']) ? $_POST['id'] : '';
$nombre_curso = isset($_POST['nombre_curso']) ? $_POST['nombre_curso'] : '';
$codigo_curso = isset($_POST['codigo_curso']) ? $_POST['codigo_curso'] : '';
$ciclo_curso = isset($_POST['ciclo_curso']) ? $_POST['ciclo_curso'] : '';
$jornada_curso = isset($_POST['jornada_curso']) ? $_POST['jornada_curso'] : '';
$hora_inicio = isset($_POST['hora_inicio']) ? $_POST['hora_inicio'] : '';
$hora_fin = isset($_POST['hora_fin']) ? $_POST['hora_fin'] : '';
$profesor_curso = isset($_POST['profesor_curso']) ? $_POST['profesor_curso'] : '';
$sede_curso = isset($_POST['sede_curso']) ? $_POST['sede_curso'] : '';
$accion = isset($_POST['accion']) ? $_POST['accion'] : '';

function codigoCursoExiste($conexionBD, $codigo_curso)
{
    $sql = "SELECT COUNT(*) FROM cursos WHERE codigo_curso = :codigo_curso";
    $consulta = $conexionBD->prepare($sql);
    $consulta->bindParam(':codigo_curso', $codigo_curso);
    $consulta->execute();
    return $consulta->fetchColumn() > 0;
}

if ($accion != '') {
    try {
        switch ($accion) {
            case 'agregar':
                // Validación: Verificar si el código ya existe
                if (codigoCursoExiste($conexionBD, $codigo_curso)) {
                    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
                    echo "<script>Swal.fire({ icon: 'error', title: 'El código de curso ya existe. Por favor, elija otro.', showConfirmButton: true });</script>";
                } else {
                    $sql = "INSERT INTO cursos (codigo_curso, nombre_curso, ciclo_curso, jornada_curso, hora_inicio, hora_fin, profesor_curso, sede_curso) VALUES (:codigo_curso, :nombre_curso, :ciclo_curso, :jornada_curso, :hora_inicio, :hora_fin, :profesor_curso, :sede_curso)";
                    $consulta = $conexionBD->prepare($sql);
                    $consulta->bindParam(':codigo_curso', $codigo_curso);
                    $consulta->bindParam(':nombre_curso', $nombre_curso);
                    $consulta->bindParam(':ciclo_curso', $ciclo_curso);
                    $consulta->bindParam(':jornada_curso', $jornada_curso);
                    $consulta->bindParam(':hora_inicio', $hora_inicio);
                    $consulta->bindParam(':hora_fin', $hora_fin);
                    $consulta->bindParam(':profesor_curso', $profesor_curso);
                    $consulta->bindParam(':sede_curso', $sede_curso);
                    if ($consulta->execute()) {
                        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
                        echo "<script>Swal.fire({ icon: 'success', title: 'Curso agregado exitosamente.', showConfirmButton: true });</script>";
                    } else {
                        $errorMsg = "Error al agregar curso: " . implode(":", $consulta->errorInfo());
                        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
                        echo "<script>Swal.fire({ icon: 'error', title: '$errorMsg', showConfirmButton: true });</script>";
                    }
                }
                break;

            case 'editar':
                // Validación: Verificar si el código ya existe y no es el mismo curso
                $sql = "SELECT COUNT(*) FROM cursos WHERE codigo_curso = :codigo_curso AND id != :id";
                $consulta = $conexionBD->prepare($sql);
                $consulta->bindParam(':codigo_curso', $codigo_curso);
                $consulta->bindParam(':id', $id);
                $consulta->execute();
                if ($consulta->fetchColumn() > 0) {
                    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
                    echo "<script>Swal.fire({ icon: 'error', title: 'El código de curso ya existe en otro curso. Por favor, elija otro.', showConfirmButton: true });</script>";
                } else {
                    $sql = "UPDATE cursos SET codigo_curso=:codigo_curso, nombre_curso=:nombre_curso, ciclo_curso=:ciclo_curso, jornada_curso=:jornada_curso, hora_inicio=:hora_inicio, hora_fin=:hora_fin, profesor_curso=:profesor_curso, sede_curso=:sede_curso WHERE id=:id";
                    $consulta = $conexionBD->prepare($sql);
                    $consulta->bindParam(':id', $id);
                    $consulta->bindParam(':codigo_curso', $codigo_curso);
                    $consulta->bindParam(':nombre_curso', $nombre_curso);
                    $consulta->bindParam(':ciclo_curso', $ciclo_curso);
                    $consulta->bindParam(':jornada_curso', $jornada_curso);
                    $consulta->bindParam(':hora_inicio', $hora_inicio);
                    $consulta->bindParam(':hora_fin', $hora_fin);
                    $consulta->bindParam(':profesor_curso', $profesor_curso);
                    $consulta->bindParam(':sede_curso', $sede_curso);
                    if ($consulta->execute()) {
                        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
                        echo "<script>Swal.fire({ icon: 'success', title: 'Curso actualizado exitosamente.', showConfirmButton: true });</script>";
                    } else {
                        $errorMsg = "Error al actualizar curso: " . implode(":", $consulta->errorInfo());
                        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
                        echo "<script>Swal.fire({ icon: 'error', title: '$errorMsg', showConfirmButton: true });</script>";
                    }
                }
                break;

            case 'borrar':
                $sql = "DELETE FROM cursos WHERE id=:id";
                $consulta = $conexionBD->prepare($sql);
                $consulta->bindParam(':id', $id);
                if ($consulta->execute()) {
                    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
                    echo "<script>Swal.fire({ icon: 'success', title: 'Curso eliminado exitosamente.', showConfirmButton: true });</script>";
                } else {
                    $errorMsg = "Error al eliminar curso: " . implode(":", $consulta->errorInfo());
                    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
                    echo "<script>Swal.fire({ icon: 'error', title: '$errorMsg', showConfirmButton: true });</script>";
                }
                break;

            case "Seleccionar":
                $sql = "SELECT * FROM cursos WHERE id=:id";
                $consulta = $conexionBD->prepare($sql);
                $consulta->bindParam(':id', $id);
                $consulta->execute();
                $curso = $consulta->fetch(PDO::FETCH_ASSOC);
                if ($curso) {
                    $codigo_curso = $curso['codigo_curso'];
                    $nombre_curso = $curso['nombre_curso'];
                    $ciclo_curso = $curso['ciclo_curso'];
                    $jornada_curso = $curso['jornada_curso'];
                    $hora_inicio = $curso['hora_inicio'];
                    $hora_fin = $curso['hora_fin'];
                    $profesor_curso = $curso['profesor_curso'];
                    $sede_curso = $curso['sede_curso'];
                } else {
                    echo "Curso no encontrado.";
                }
                break;
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}

// Consultar la información de la BD
$consulta = $conexionBD->prepare("SELECT * FROM cursos");
$consulta->execute();
$listaCursos = $consulta->fetchAll();

//funcion que me permite ver los estudiantes incritos en los cursos
function obtenerEstudiantesPorCurso($conexionBD, $idCurso)
{
    $sql = "SELECT a.cedula, a.nombre, a.apellido
            FROM alumnos a
            INNER JOIN alumnos_cursos ac ON a.id = ac.idalumno
            WHERE ac.idcurso = :idCurso";
    $consulta = $conexionBD->prepare($sql);
    $consulta->bindParam(':idCurso', $idCurso);
    $consulta->execute();
    return $consulta->fetchAll(PDO::FETCH_ASSOC);
}
