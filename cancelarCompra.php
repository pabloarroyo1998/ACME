<?php
session_start();

unset( $_SESSION[ 'carroCompras' ] );
echo 'Sesión detenida correctamente.';
header( 'Location: resumenCompra.php' );
exit;
?>