<?php
$conn = mysqli_connect("localhost", "root", "123456", "inventario");

/* comprobar la conexión */
if (mysqli_connect_errno()) {
    printf("Falló la conexión: %s\n", mysqli_connect_error());
    exit();
}
?>
