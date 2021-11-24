<?php
ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

header('Content-Type: text/html; charset=UTF-8');

if(isset($_POST['search']) && $_POST['search'] != ''){
	//~ echo "<pre>";
	//~ print_r($_POST);
	$sql = "SELECT * FROM tbl_catalogoproducto where ".
	"CodigoProducto like '%".$_POST['search']."%' OR ".
	"NombreProducto like '%".$_POST['search']."%' OR ".
	"Descripcion like '%".$_POST['search']."%' OR ".
	"PrecioUnitario like '%".$_POST['search']."%' OR ".
	"Unidades like '%".$_POST['search']."%' OR ".
	"Direccion like '%".$_POST['search']."%'";
}else{
	$sql = "SELECT * FROM tbl_catalogoproducto";
}

$result = mysqli_query($conn,$sql);

?>
