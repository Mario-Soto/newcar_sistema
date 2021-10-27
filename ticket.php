<?php
session_start();
require('fpdf.php');


class PDF extends FPDF
{
    protected $col1;
    protected $col2;
    protected $col3;
    protected $col4;
    protected $col5;
    // Page header
    function Header()
    {
        // Logo
        $this->Image('res/images/new_car-logo.png', 15, 15, 40);
        // Arial bold 15
        $this->SetFont('Helvetica', 'B', 24);
        // Move to the right
        $this->Cell(55);
        // Title
        $this->Cell(0, 20, 'Ticket de compra', 0, 0, 'C');
        // Line break
        $this->Ln(30);
    }

    function Atributo($atributo,)
    {
        $this->SetFont('Times', 'B', 16);
        $this->Cell(40, 16, "$atributo: ", 0, 0, 'R');
    }

    function Valor($valor)
    {
        $this->SetFont('Times', '', 15);
        // $this->Cell(60, 4,'',0,0);
        $this->Cell(60, 12, "$valor", 'B', 0);
    }

    function Fecha()
    {
        date_default_timezone_set('America/Mexico_City');
        $fecha = date('d/M/Y h:i:s a', time());
        $this->SetFont('Times', 'B', 14);
        $this->Cell(185);
        $this->Cell(10, 10, utf8_decode("Fecha de impresión: "), 0, 0, 'R');
        $this->SetFont('Times', 'U', 12);
        $this->Cell(10, 10, utf8_decode("$fecha"), 0, 1, 'L');
    }

    function Titulo($titulo)
    {
        $this->SetFont('Helvetica', 'B', 16);
        $this->Cell(0, 20, "$titulo", 0, 1, 'C');
    }

    function Table($dato)
    {
        // Colors, line width and bold font
        $this->SetFillColor(59, 106, 122);
        $this->SetTextColor(255);
        $this->SetDrawColor(141, 171, 181);
        $this->SetLineWidth(.05);
        $this->SetFont('', 'B');
        // Header
        $col1 = 27;
        $col2 = 45;
        $col3 = 135;
        $col4 = 5;
        $col5 = 25;

        $this->Cell($col1, 12, 'Tipo', 1, 0, 'C', true);
        $this->Cell($col2, 12, 'Producto', 1, 0, 'C', true);
        $this->Cell($col3, 12, utf8_decode('Descripción'), 1, 0, 'C', true);
        $this->Cell($col4 + $col5, 12, 'Precio', 1, 0, 'C', true);
        $this->Ln();
        // Color and font restoration
        $this->SetFillColor(198, 203, 221);
        $this->SetTextColor(0);
        $this->SetFont('', '', 14);
        // Data
        $this->Cell($col1, 8, 'Auto', '', 0, 'C', false);
        $this->Cell($col2, 8, utf8_decode($dato['marca'] . ' ' . $dato['modelo']), '', 0, 'L', false);
        $this->Cell($col3, 8, utf8_decode('Año ' . $dato['año'] . ', color ' . strtolower($dato['color']) . ', transmisión ' . strtolower($dato['transmision']).($dato['estado']==0?' (Nuevo)':' (Usado)')), '', 0, 'L', false);
        $this->Cell($col4, 8, '$', '', 0, 'R', false);
        $this->Cell($col5, 8, number_format($dato['precio']), '', 0, 'R', false);
        $this->Ln();

        if ($dato['placa'] <> null) {
            $this->Cell($col1, 8, 'Placas', '', 0, 'C', true);
            $this->Cell($col2, 8, utf8_decode('Placa: '.$dato['placa']), '', 0, 'L', true);
            $this->Cell($col3, 8, utf8_decode('N/A'), '', 0, 'C', true);
            $this->Cell($col4, 8, '$', '', 0, 'R', true);
            $this->Cell($col5, 8, number_format(5000), '', 0, 'R', true);
            $this->Ln();
        }
        // Closing line
        $this->Cell($col1 + $col2 + $col3 + $col4 + $col5, 1, '', 'T',1);
        $this->Cell($col1 + $col2 + $col3-7, 8, 'Total', 'T', 0, 'R');
        $this->Cell(7, 8, '', 'T', 0, 'R');
        $this->Cell($col4, 8, '$', 'T', 0, 'R');
        $this->Cell($col5, 8, number_format($dato['total']), 'T', 0, 'R');
    }
}

include 'res/db/ventasDB.php';
$ventasdb = new VentasDB();

$venta = $ventasdb->getVentaPorId($_GET['id']);

// Instanciation of inherited class
$pdf = new PDF('L', 'mm', 'Letter');
$pdf->SetMargins(20, 25, 20);
$pdf->AddPage();
$pdf->Fecha();
$pdf->Titulo('CLIENTE');
$pdf->Cell(0, 0, '', 'T', 1);
$pdf->Cell(0, 4, '', '', 1);
$pdf->Atributo('Nombre');
$pdf->Valor(utf8_decode($venta['nombre'] . ' ' . $venta['apellido']));
$pdf->Atributo('RFC');
$pdf->Valor(utf8_decode($venta['rfc']));
$pdf->Ln();
$pdf->Cell(0, 4, '', '', 1);
$pdf->Titulo(utf8_decode('INFORMACIÓN DE COMPRA'));
$pdf->Cell(0, 0, '', 'T', 1);
$pdf->Cell(0, 4, '', '', 1);
$pdf->Atributo('Forma de pago');
if($venta['formaPago']==1){
    $pdf->Valor('Efectivo');
}else{
    $pdf->Valor(utf8_decode('Crédito'));
    $pdf->Atributo('Tiempo');
    $pdf->Valor($venta['plazo'].' meses');
}
$pdf->Ln();
$pdf->Cell(0, 7, '', '', 1);
$pdf->Table($venta);
if(isset($_GET['download'])){
    $pdf->Output('D','ticket_venta'.$_GET['id'].'.pdf',true);
}else{
    $pdf->Output('I','ticket_venta'.$_GET['id'].'.pdf',true);
}
