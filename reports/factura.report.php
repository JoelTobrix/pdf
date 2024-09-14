<?php
require('../reports/fpdf.php');
require_once("../models/factura.model.php");

$pdf = new FPDF();
$pdf->AddPage();
$factura = new Factura();  // Cambiamos de Productos a Facturas
$pdf->SetFont('Arial', 'B', 12);
$pdf->Text(30, 10, 'Reporte de Facturas');
$pdf->SetFont('Arial', '', 12);
$pdf->MultiCell(0, 5, iconv('UTF-8', 'windows-1252', $texto), 0, 'J');

// Uso de POO para obtener el listado de facturas
$listafactura = $factura->todos();  // Método para obtener todas las facturas

// Verificar si se obtuvieron datos de la base de datos
if ($listafactura) {
    $pdf->Ln(10); // Espacio antes de la tabla

    // Generar encabezados de tabla para las facturas
    $pdf->Cell(10, 10, "#", 1);
    $pdf->Cell(30, 10, "ID Factura", 1);
    $pdf->Cell(40, 10, "Fecha", 1);
    $pdf->Cell(30, 10, "Sub Total", 1);
    $pdf->Cell(30, 10, "Sub Total IVA", 1);
    $pdf->Cell(30, 10, "Valor IVA", 1);
    $pdf->Cell(40, 10, "ID Cliente", 1);
    $pdf->Ln();

    // Llenar la tabla con los datos de las facturas
    $index = 1;
    while ($factura = mysqli_fetch_assoc($listafactura)) {
        $pdf->Cell(10, 10, $index, 1);
        $pdf->Cell(30, 10, $factura["idFactura"], 1);
        $pdf->Cell(40, 10, $factura["Fecha"], 1);
        $pdf->Cell(30, 10, $factura["Sub_total"], 1);
        $pdf->Cell(30, 10, $factura["Sub_total_iva"], 1);
        $pdf->Cell(30, 10, $factura["Valor_IVA"], 1);
        $pdf->Cell(40, 10, $factura["Clientes_idClientes"], 1);
        $pdf->Ln();
        $index++;
    }
} else {
    // Si no hay datos, agregar un mensaje en el PDF
    $pdf->Ln(20);
    $pdf->Cell(0, 10, 'No hay facturas disponibles.', 1, 1, 'C');
}

// Número de página al final del reporte


// Salida del PDF
$pdf->Output();
?>
