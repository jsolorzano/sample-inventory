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

if(isset($_POST['CodigoProducto'])){
	//~ echo "<pre>";
	//~ print_r($_POST);
	$CodigoProducto = $_POST['CodigoProducto'];
	$NombreProducto = utf8_decode($_POST['NombreProducto']);
	$Descripcion = utf8_decode($_POST['Descripcion']);
	$PrecioUnitario = $_POST['PrecioUnitario'];
	$Unidades = $_POST['Unidades'];
	$Direccion = utf8_decode($_POST['Direccion']);
	
	if($CodigoProducto == ""){
		echo '{"message":"El código está vacío o no es válido.","message_type":"warning"}';
	}else if($NombreProducto == "" || is_numeric($NombreProducto)){
		echo '{"message":"El nombre del producto está vacío o no es válido.","message_type":"warning"}';
	}else if($Descripcion == "" || is_numeric($Descripcion)){
		echo '{"message":"La descripción del producto está vacío o no es válido.","message_type":"warning"}';
	}else if($PrecioUnitario == "" || !is_numeric($PrecioUnitario)){
		echo '{"message":"El precio del producto está vacío o no es válido.","message_type":"warning"}';
	}else if($Unidades == "" || !is_numeric($Unidades)){
		echo '{"message":"Las unidades del producto está vacío o no es válido.","message_type":"warning"}';
	}else if($Direccion == "" || is_numeric($Direccion)){
		echo '{"message":"La dirección del producto está vacío o no es válido.","message_type":"warning"}';
	}else{
		$sql = "INSERT INTO tbl_catalogoproducto (CodigoProducto, NombreProducto, Descripcion, PrecioUnitario, Unidades, Direccion) VALUES".
		"('$CodigoProducto', '$NombreProducto', '$Descripcion', $PrecioUnitario, $Unidades, '$Direccion')";

		if($result = mysqli_query($conn, $sql)){
			//~ echo "Producto registrado con éxito.";
			//~ header("refresh:1;url=".WEB_HOST.SYSTEM_PATH."admin/table.php");
			echo '{"message":"Producto registrado con éxito.","message_type":"success"}';
		}else{
			//~ echo "Ha ocurrido un error en la operación, consulte con el administrador.";
			//~ header("refresh:2;url=".WEB_HOST.SYSTEM_PATH."admin/table.php");
			echo '{"message":"Ha ocurrido un error en la operación, consulte con el administrador.","message_type":"warning"}';
		}
	}	
}else{
	//~ echo "Ha ocurrido un error inesperado, consulte con el administrador.";
	//~ header("refresh:2;url=".WEB_HOST.SYSTEM_PATH."admin/table.php");
	echo '{"message":"Ha ocurrido un error inesperado, consulte con el administrador.","message_type":"warning"}';
}

?>
