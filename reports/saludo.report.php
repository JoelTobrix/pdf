<?php
require('../reports/fpdf.php');

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,10,'Buenos Dias Ingeniero Luis Llerena');
$pdf->Output();
?>