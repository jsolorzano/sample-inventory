<?php
ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

require_once '../config/conexion.php';

if(isset($_POST['send'])){
	//~ echo "<pre>";
	//~ print_r($_POST);
	$email = $_POST['email'];
	$password = $_POST['password'];
	$sql = "SELECT firstname, lastname, email, created_at, updated_at FROM tbl_users where email = '$email' AND password = '$password'";

	if($result = mysqli_query($conn, $sql)){
		$data = array();
		/* obtener el array asociativo */
		while ($fila = mysqli_fetch_row($result)) {
			$data['firstname'] = $fila[0];
			$data['lastname'] = $fila[1];
			$data['email'] = $fila[2];
			$data['created_at'] = $fila[3];
			$data['updated_at'] = $fila[4];
		}
		/* Aquí falta una validación para saber si se está cargando datos
		 * en $data*/
		if(count($data) == 0){
			echo "Usuario o contraseña incorrectos";
			header("refresh:5;url=http://localhost/pruebas/php/test_fpdf/inventario/login.php");
		}else{
			session_start();
			$_SESSION['logged_in'] = $data;
			header('Location: http://localhost/pruebas/php/test_fpdf/inventario/admin/');
		}
	}else{
		echo "Ha ocurrido un error inesperado, consulte con el administrador.";
		header("refresh:5;url=http://localhost/pruebas/php/test_fpdf/inventario/login.php");
	}
	
}else{
	echo "Ha ocurrido un error en el envío de datos, consulte con el administrador.";
	header("refresh:5;url=http://localhost/pruebas/php/test_fpdf/inventario/login.php");
}

?>
