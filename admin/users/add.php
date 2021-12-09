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

if(isset($_POST['firstname'])){
	//~ echo "<pre>";
	//~ print_r($_POST);
	$firstname = $_POST['firstname'];
	$lastname = utf8_decode($_POST['lastname']);
	$email = utf8_decode($_POST['email']);
	$password = $_POST['password'];
	
	if($firstname == "" || is_numeric($firstname)){
		echo '{"message":"El nombre está vacío o no es válido.","message_type":"warning"}';
	}else if($lastname == "" || is_numeric($lastname)){
		echo '{"message":"El apellido está vacío o no es válido.","message_type":"warning"}';
	}else if($email == "" || is_numeric($email)){
		echo '{"message":"El email está vacío o no es válido.","message_type":"warning"}';
	}else if($password == ""){
		echo '{"message":"La contraseña está vacía o no es válida.","message_type":"warning"}';
	}else{
		$sql = "INSERT INTO tbl_users (firstname, lastname, email, password, created_at) VALUES".
		"('$firstname', '$lastname', '$email', '".md5($password)."', now())";

		if($result = mysqli_query($conn, $sql)){
			//~ echo "Usuario registrado con éxito.";
			//~ header("refresh:1;url=".WEB_HOST.SYSTEM_PATH."admin/table.php");
			echo '{"message":"Usuario registrado con éxito.","message_type":"success"}';
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
