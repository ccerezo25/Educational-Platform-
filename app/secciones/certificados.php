<?php
require('../librerias/fpdf.php'); // Asegúrate de que la ruta sea correcta

// Obtener la cédula y los códigos de cursos desde la URL
$cedula = isset($_GET['cedula']) ? $_GET['cedula'] : '';
$codigos_cursos = isset($_GET['cursos']) ? explode(',', $_GET['cursos']) : [];

// Conectar a la base de datos para obtener los detalles del estudiante y curso
include('../configuraciones/bd.php');
$conexionBD = BD::crearInstancia();

// Crear un nuevo documento PDF en formato horizontal (landscape)
$pdf = new FPDF('L', 'mm', 'A4'); // 'L' indica Landscape, 'mm' son milímetros, y 'A4' es el tamaño del papel

foreach ($codigos_cursos as $codigo_curso) {
    $sql = "SELECT a.nombre, a.apellido, c.nombre_curso 
            FROM alumnos a 
            INNER JOIN alumnos_cursos ac ON a.id = ac.idalumno 
            INNER JOIN cursos c ON ac.idcurso = c.id 
            WHERE a.cedula = :cedula AND c.codigo_curso = :codigo_curso";
    $consulta = $conexionBD->prepare($sql);
    $consulta->bindParam(':cedula', $cedula);
    $consulta->bindParam(':codigo_curso', $codigo_curso);
    $consulta->execute();
    $datos = $consulta->fetch(PDO::FETCH_ASSOC);

    if ($datos) {
        $nombre_completo = $datos['nombre'] . ' ' . $datos['apellido'];
        $nombre_curso = $datos['nombre_curso'];

        // Crear una nueva página para cada curso
        $pdf->AddPage();

        // Fondo de color
        $pdf->SetFillColor(255, 255, 204); // Color amarillo claro
        $pdf->Rect(0, 0, 297, 210, 'F');

        // Añadir el logo
        $pdf->Image('C:\xampp\htdocs\app\Imagenes\logoceyom.png', 10, 10, 40);

        // Establecer la fuente para el título principal
        $pdf->SetFont('Arial', 'B', 24);
        $pdf->SetTextColor(0, 51, 102); // Azul oscuro
        $pdf->Cell(0, 40, utf8_decode('CERTIFICADO DE FINALIZACIÓN'), 0, 1, 'C');
        $pdf->Ln(10);

        // Establecer la fuente para el subtítulo
        $pdf->SetFont('Arial', 'I', 18);
        $pdf->SetTextColor(100, 100, 100); // Gris
        $pdf->Cell(0, 10, utf8_decode('Se otorga a:'), 0, 1, 'C');
        $pdf->Ln(10);

        // Establecer la fuente para el nombre del estudiante
        $pdf->SetFont('Arial', 'B', 22);
        $pdf->SetTextColor(0, 102, 204); // Azul brillante
        $pdf->Cell(0, 10, utf8_decode($nombre_completo), 0, 1, 'C');
        $pdf->Ln(10);

        // Establecer la fuente para el contenido
        $pdf->SetFont('Arial', '', 16);
        $pdf->SetTextColor(0); // Negro
        $pdf->MultiCell(0, 10, utf8_decode("Por haber completado satisfactoriamente el curso: $nombre_curso.\n"), 0, 'C');
        $pdf->Ln(10);

        // Añadir una línea para la firma
        $pdf->SetFont('Arial', 'I', 12);
        $pdf->Cell(0, 10, utf8_decode('Fecha de emisión: ') . date('d/m/Y'), 0, 1, 'C');
        $pdf->Ln(20); // Añadir un poco de espacio para las firmas

        // Firma del Instructor y Alcalde
        $pdf->SetFont('Arial', 'I', 14);
        $pdf->Cell(0, 10, '________________________            ________________________', 0, 1, 'C');
        $pdf->Cell(0, 10, utf8_decode('Firma del Instructor                                 Firma del Alcalde'), 0, 1, 'C');
        $pdf->Ln(1); // Pequeño espacio entre los títulos y nombres
        $pdf->Cell(0, 10, '                                                               ' . utf8_decode('Ing. Juan José Yúnez'), 0, 1, 'C'); // Nombre del alcalde

        // Bordes decorativos
        $pdf->SetLineWidth(1);
        $pdf->SetDrawColor(0, 51, 102); // Azul oscuro
        $pdf->Rect(5, 5, 287, 200, 'D');
    } else {
        die('No se encontraron datos para generar el certificado.');
    }
}

// Salida del PDF al navegador
$pdf->Output("I", "Certificados_$cedula.pdf");
