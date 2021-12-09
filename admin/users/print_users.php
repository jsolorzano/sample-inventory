<?php
session_start();
require_once '../../config/config.php';
if (!isset($_SESSION['logged_in'])) {
	header('Location: '.WEB_HOST.SYSTEM_PATH.'login.php');
}
ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

require_once '../../config/conexion.php';

require "../../vendor/fpdf184/fpdf.php";

header('Content-Type: text/html; charset=UTF-8');

$pdf=new FPDF();
$pdf->SetFont('Arial','B',16);
$pdf->AddPage('P','Letter');
$pdf->SetMargins(20, 20, 20);
$pdf->Cell(180,10,utf8_decode('¡Mi primera página pdf con FPDF!'), 0, 1,'C');
$pdf->Ln(10);
$pdf->Cell(175,10,utf8_decode('Listado de usuarios'), 0, 1,'C');
$pdf->Ln(10);
// Encabezado de tabla
$pdf->SetFont('Arial','B',9);
$pdf->Cell(15,6,utf8_decode('Id'), 1, 0,'C');
$pdf->Cell(25,6,utf8_decode('Nombre'), 1, 0,'C');
$pdf->Cell(25,6,utf8_decode('Apellido'), 1, 0,'C');
$pdf->Cell(45,6,utf8_decode('Email'), 1, 0,'C');
$pdf->Cell(35,6,utf8_decode('Creación'), 1, 0,'C');
$pdf->Cell(35,6,utf8_decode('Actualización'), 1, 1,'C');
// Consulta de productos
$pdf->SetFont('Arial','',8);
if(isset($_GET['search']) && $_GET['search'] != ""){
	$sql = "SELECT * FROM tbl_users where ".
	"id like '%".$_GET['search']."%' OR ".
	"firstname like '%".$_GET['search']."%' OR ".
	"lastname like '%".$_GET['search']."%' OR ".
	"email like '%".$_GET['search']."%' OR ".
	"created_at like '%".$_GET['search']."%' OR ".
	"updated_at like '%".$_GET['search']."%'";
}else{
	$sql = "SELECT * FROM tbl_users";
}
$result = mysqli_query($conn,$sql);
// Líneas de usuarios resultantes
while($mostrar = mysqli_fetch_array($result)){
	$pdf->Cell(15,6,utf8_decode($mostrar['id']), 1, 0,'C');
	$pdf->Cell(25,6,utf8_decode($mostrar['firstname']), 1, 0,'C');
	$pdf->Cell(25,6,utf8_decode($mostrar['lastname']), 1, 0,'C');
	$pdf->Cell(45,6,utf8_decode($mostrar['email']), 1, 0,'C');
	$pdf->Cell(35,6,utf8_decode($mostrar['created_at']), 1, 0,'C');
	$pdf->Cell(35,6,utf8_decode($mostrar['updated_at']), 1, 1,'C');
}
$pdf->Output();
//~ $pdf->Output("test.pdf", 'I', true);
//~ $pdf->Output("test.pdf", 'D');
?>
