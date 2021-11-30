<?php
session_start();
if (!isset($_SESSION['logged_in'])) {
	header('Location: http://localhost/pruebas/php/test_fpdf/inventario/login.php');
}
ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

require_once '../config/conexion.php';

require "../vendor/fpdf184/fpdf.php";

header('Content-Type: text/html; charset=UTF-8');

$pdf=new FPDF();
$pdf->SetFont('Arial','B',16);
$pdf->AddPage('P','Letter');
$pdf->SetMargins(20, 20, 20);
$pdf->Cell(180,10,utf8_decode('¡Mi primera página pdf con FPDF!'), 0, 1,'C');
$pdf->Ln(10);
$pdf->Cell(175,10,utf8_decode('Listado de productos'), 0, 1,'C');
$pdf->Ln(10);
// Encabezado de tabla
$pdf->SetFont('Arial','B',9);
$pdf->Cell(15,6,utf8_decode('Código'), 1, 0,'C');
$pdf->Cell(25,6,utf8_decode('Nombre'), 1, 0,'C');
$pdf->Cell(50,6,utf8_decode('Descripción'), 1, 0,'C');
$pdf->Cell(15,6,utf8_decode('Precio'), 1, 0,'C');
$pdf->Cell(20,6,utf8_decode('Unidades'), 1, 0,'C');
$pdf->Cell(55,6,utf8_decode('Dirección'), 1, 1,'C');
// Consulta de productos
$pdf->SetFont('Arial','',8);
if(isset($_GET['search']) && $_GET['search'] != ""){
	$sql = "SELECT * FROM tbl_catalogoproducto where ".
	"CodigoProducto like '%".$_GET['search']."%' OR ".
	"NombreProducto like '%".$_GET['search']."%' OR ".
	"Descripcion like '%".$_GET['search']."%' OR ".
	"PrecioUnitario like '%".$_GET['search']."%' OR ".
	"Unidades like '%".$_GET['search']."%' OR ".
	"Direccion like '%".$_GET['search']."%'";
}else{
	$sql = "SELECT * FROM tbl_catalogoproducto";
}
$result = mysqli_query($conn,$sql);
// Líneas de productos resultantes
while($mostrar = mysqli_fetch_array($result)){
	$pdf->Cell(15,6,utf8_decode($mostrar['CodigoProducto']), 1, 0,'C');
	$pdf->Cell(25,6,utf8_decode($mostrar['NombreProducto']), 1, 0,'C');
	$pdf->Cell(50,6,utf8_decode($mostrar['Descripcion']), 1, 0,'C');
	$pdf->Cell(15,6,utf8_decode($mostrar['PrecioUnitario']), 1, 0,'C');
	$pdf->Cell(20,6,utf8_decode($mostrar['Unidades']), 1, 0,'C');
	$pdf->Cell(55,6,utf8_decode(utf8_encode($mostrar['Direccion'])), 1, 1,'C');
}
$pdf->Output();
//~ $pdf->Output("test.pdf", 'I', true);
//~ $pdf->Output("test.pdf", 'D');
?>
