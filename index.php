<?php
session_start();
if (isset($_SESSION['logged_in'])) {
	header('Location: http://localhost/pruebas/php/test_fpdf/inventario/admin/');
}else{
	header('Location: http://localhost/pruebas/php/test_fpdf/inventario/login.php');
}
?>
