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

if(isset($_POST['id']) && $_POST['id'] != ""){
	//~ echo "<pre>";
	//~ print_r($_POST);
	$id = $_POST['id'];
	$CodigoProducto = $_POST['CodigoProducto'];
	$NombreProducto = utf8_decode($_POST['NombreProducto']);
	$Descripcion = utf8_decode($_POST['Descripcion']);
	$PrecioUnitario = $_POST['PrecioUnitario'];
	$Unidades = $_POST['Unidades'];
	$Direccion = utf8_decode($_POST['Direccion']);
	
	$sql = "UPDATE tbl_catalogoproducto SET CodigoProducto = '$CodigoProducto', ". 
	"NombreProducto = '$NombreProducto', Descripcion = '$Descripcion', PrecioUnitario = $PrecioUnitario, ".
	" Unidades = $Unidades, Direccion = '$Direccion' WHERE id = $id";

	if($result = mysqli_query($conn, $sql)){
		//~ echo "Producto actualizado con éxito.";
		//~ header("refresh:1;url=".WEB_HOST.SYSTEM_PATH."admin/table.php");
		echo '{"message":"Producto actualizado con éxito.","message_type":"success"}';
	}else{
		//~ echo "Ha ocurrido un error en la operación, consulte con el administrador.";
		//~ header("refresh:2;url=".WEB_HOST.SYSTEM_PATH."admin/table.php");
		echo '{"message":"Ha ocurrido un error en la operación, consulte con el administrador.","message_type":"warning"}';
	}
}else{
	//~ echo "Ha ocurrido un error inesperado, consulte con el administrador.";
	//~ header("refresh:2;url=".WEB_HOST.SYSTEM_PATH."admin/table.php");
	echo '{"message":"Ha ocurrido un error inesperado, consulte con el administrador.","message_type":"warning"}';
}

?>
