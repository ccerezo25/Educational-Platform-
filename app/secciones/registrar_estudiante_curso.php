<?php include('../templates/cabecera.php'); ?>
<?php include('../secciones/alumnos.php'); ?>
<link rel="stylesheet" href="../ecertificado.css">

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cedula'])) {
    $cedula = $_POST['cedula'];

    // Conexión a la base de datos y consulta para obtener los cursos del estudiante
    $sql = "SELECT a.cedula, a.nombre, a.apellido, c.codigo_curso, c.nombre_curso
            FROM alumnos a
            INNER JOIN alumnos_cursos ac ON a.id = ac.idalumno
            INNER JOIN cursos c ON ac.idcurso = c.id
            WHERE a.cedula = :cedula";
    $consulta = $conexionBD->prepare($sql);
    $consulta->bindParam(':cedula', $cedula);
    $consulta->execute();
    $cursosEstudiante = $consulta->fetchAll(PDO::FETCH_ASSOC);

    $resultados = [];
    $cursosAprobados = [];

    if (isset($_POST['notas']) && is_array($_POST['notas'])) {
        foreach ($_POST['notas'] as $cursoCodigo => $nota) {
            $nota = (int)$nota;
            $estado = $nota >= 70 ? 'Aprobado' : 'Reprobado';
            $resultados[] = [
                'curso' => $cursoCodigo,
                'nota' => $nota,
                'estado' => $estado
            ];

            if ($estado === 'Aprobado') {
                $cursosAprobados[] = $cursoCodigo;
            }
        }
    }
}
?>

<div class="row">
    <div class="col-12">
        <div class="row">
            <div class="col-md-12">
                <!-- Formulario para buscar al estudiante -->
                <form action="" method="post">
                    <div class="card">
                        <div class="card-header">Buscar Estudiante</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="cedula" class="form-label">CEDULA</label>
                                    <input type="number" class="form-control" name="cedula" id="cedula" value="<?php echo isset($cedula) ? $cedula : ''; ?>" required />
                                </div>
                            </div>
                        </div>
                        <div class="card-footer" style="text-align: right;">
                            <button type="submit" name="accion" value="buscar_estudiante" class="btn btn-warning">Buscar Estudiante</button>
                        </div>
                    </div>
                </form>

                <!-- Mostrar los cursos del estudiante si existen -->
                <?php if (isset($cursosEstudiante) && !empty($cursosEstudiante)) { ?>
                    <form action="" method="post">
                        <input type="hidden" name="cedula" value="<?php echo $cedula; ?>">
                        <div class="card mt-4">
                            <div class="card-header">Cursos del Estudiante</div>
                            <div class="card-body">
                                <div class="row">
                                    <?php foreach ($cursosEstudiante as $curso) { ?>
                                        <div class="col-md-6 mb-3">
                                            <label for="nota_<?php echo $curso['codigo_curso']; ?>" class="form-label"><?php echo $curso['codigo_curso']; ?> - <?php echo $curso['nombre_curso']; ?></label>
                                            <input type="number" class="form-control" name="notas[<?php echo $curso['codigo_curso']; ?>]" id="nota_<?php echo $curso['codigo_curso']; ?>" min="0" max="100" required />
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="card-footer" style="text-align: right;">
                                <button type="submit" name="accion" value="registrar_notas" class="btn btn-warning">Registrar Notas</button>
                            </div>
                        </div>
                    </form>
                <?php } ?>

                <!-- Mostrar el resultado de las notas y los enlaces para descargar certificados -->
                <?php if (isset($resultados) && !empty($resultados)) { ?>
                    <div class="card mt-4">
                        <div class="card-header">Resultados</div>
                        <div class="card-body">
                            <ul>
                                <?php foreach ($resultados as $resultado) { ?>
                                    <li>
                                        Curso: <?php echo $resultado['curso']; ?> - Nota: <?php echo $resultado['nota']; ?> - Estado: <?php echo $resultado['estado']; ?>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>

                    <?php if (!empty($cursosAprobados)) { ?>
                        <div class="alert alert-success mt-4">
                            <strong>¡Felicidades!</strong> El estudiante ha aprobado los siguientes cursos:
                            <ul>
                                <?php foreach ($cursosAprobados as $curso) { ?>
                                    <li><?php echo $curso; ?></li>
                                <?php } ?>
                            </ul>
                            <a href="certificados.php?cedula=<?php echo $cedula; ?>&cursos=<?php echo implode(',', $cursosAprobados); ?>" class="btn btn-success">Descargar Certificados</a>
                        </div>
                    <?php } else { ?>
                        <div class="alert alert-danger mt-4">
                            El estudiante no ha aprobado ningún curso.
                        </div>
                    <?php } ?>
                <?php } ?>

            </div>
        </div>
    </div>
</div>

<?php include('../templates/pie.php'); ?>