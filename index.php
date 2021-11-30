<?php
session_start();
require_once 'config/config.php';
if (isset($_SESSION['logged_in'])) {
	header('Location: '.WEB_HOST.SYSTEM_PATH.'admin/');
}else{
	header('Location: '.WEB_HOST.SYSTEM_PATH.'login.php');
}
?>
