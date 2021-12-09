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

if(isset($_POST['id'])){
	//~ echo "<pre>";
	//~ print_r($_POST);
	$id = $_POST['id'];
	
	$sql = "DELETE FROM tbl_users WHERE id = $id";

	if($result = mysqli_query($conn, $sql)){
		echo '{"message":"Usuario borrado con éxito.","message_type":"success"}';
	}else{
		echo '{"message":"Ha ocurrido un error en la operación, consulte con el administrador.","message_type":"warning"}';
	}
}else{
	echo '{"message":"Ha ocurrido un error inesperado, consulte con el administrador.","message_type":"warning"}';
}

?>
