<?php
session_start();
session_destroy();
header('Location: http://localhost/pruebas/php/test_fpdf/inventario/login.php');
?>
