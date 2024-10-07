<?php
// obtener_estudiante.php
header('Content-Type: application/json');

include_once '../configuraciones/bd.php';
$conexionBD = BD::crearInstancia();

if (isset($_GET['cedula'])) {
    $cedula = $_GET['cedula'];

    // Consultar los datos del estudiante
    $sql = "SELECT nombre, apellido, edad, direccion FROM alumnos WHERE cedula = ?";
    $consulta = $conexionBD->prepare($sql);
    $consulta->execute([$cedula]);
    $estudiante = $consulta->fetch(PDO::FETCH_ASSOC);

    if ($estudiante) {
        echo json_encode($estudiante);
    } else {
        echo json_encode(null);
    }
} else {
    echo json_encode(null);
}
