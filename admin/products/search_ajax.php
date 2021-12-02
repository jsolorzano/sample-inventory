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

if(isset($_POST['id']) && $_POST['id'] != ''){
	//~ echo "<pre>";
	//~ print_r($_POST);
	$id = $_POST['id'];
	$sql = "SELECT * FROM tbl_catalogoproducto where id = $id";
	
	if($result = mysqli_query($conn, $sql)){
		// Esta forma trae los datos de las columnas tanto de forma indexada como de forma asociativa
		//~ $mostrar = mysqli_fetch_array($result);
		
		// Nos basta con traer los datos de forma asociativa
		$mostrar = mysqli_fetch_assoc($result);
		// Es necesario codificar a utf-8 los datos que puedan contener caracteres especiales
		$mostrar['NombreProducto'] = utf8_encode($mostrar['NombreProducto']);
		$mostrar['Descripcion'] = utf8_encode($mostrar['Descripcion']);
		$mostrar['Direccion'] = utf8_encode($mostrar['Direccion']);
		$json_data = json_encode($mostrar);
		echo $json_data;
	}else{
		echo "Ha ocurrido un error inesperado, consulte con el administrador.";
	}
}else{
	echo "Ha ocurrido un error inesperado, consulte con el administrador.";
}

?>
