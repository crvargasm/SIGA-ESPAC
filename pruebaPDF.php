<?php
require('libraries/fpdf/fpdf.php');
class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {
        $this->Image('workspace/images/logoespac.png', 240, 10, 33);  //Logo  (Ubicacion, Coord-x, Coord-y, tamaño);
        $this->Image('workspace/images/escudoDF.png', 20, 10, 33);  
        $this->SetFont('Courier', 'B', 18);
        $this->Ln(5);
        $this->Cell('', 10, utf8_decode('DIOCESIS DE FONTIBÓN'), 0, 0, 'C');
        $this->Ln(8);
        $this->Cell('', 10, utf8_decode('ESCUELA PARROQUIAL DE CATEQUISTAS'), 0, 0, 'C');
        $this->Ln(15);
        $this->Cell('', 10, 'CERTIFICAMOS', 0, 0, 'C');
        // Salto de línea
        $this->Ln(20);
    }

    // Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Número de página
        //$this->Cell(0, 10, 'Pagina ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}

// Creación del objeto de la clase heredada
$pdf = new PDF('L', 'mm', 'A4');
$pdf->SetTitle('Reporte de Notas');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times', '', 14);
$pdf->SetLeftMargin(23);
$pdf->SetRightMargin(23);
$pdf->MultiCell(0, 5, utf8_decode('Que ' . 'Adriana Clemencia del Corazón de Jesús y de la Santísima Trinidad' . ', identificada con Cedula de Ciudadanía No.'.' 19467615 '.'de la parroquia'.' PARROQUIA'.', cursó y aprobó las siguientes asignaturas y prácticas correspondientes a las Cuatro Etapas del programa ESPAC bajo las siguientes evaluaciones:'), 0, 1);
for ($i = 0; $i < 13; $i++)
    //$pdf->Cell(0, 10, utf8_decode('Imprimiendo línea número ') . ($i+1), 0, 1);
$pdf->Output('I', 'Prueba PDF.pdf', true);
