<?php
session_start();

if (!isset($_SESSION['carroCompras'])) {
    $_SESSION['carroCompras'] = array();
}

if (isset($_GET['producto']) && isset($_GET['nombre']) && isset($_GET['precio'])) {
    $producto = array(
        'codigo' => $_GET['producto'],
        'nombre' => $_GET['nombre'],
        'precio' => $_GET['precio']
    );

    array_push($_SESSION['carroCompras'], $producto);
}

header("Location: buscarProductos.php");
?>
