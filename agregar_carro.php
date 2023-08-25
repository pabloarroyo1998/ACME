<?php
session_start();

if (!isset($_SESSION['carroCompras'])) {
    $_SESSION['carroCompras'] = array();
}

if (isset($_GET['producto']) && isset($_GET['nombre']) && isset($_GET['precio']) && isset($_GET['cantidad']) && isset($_GET['total'])) {
    $producto = array(
        'codigo' => $_GET['producto'],
        'nombre' => $_GET['nombre'],
        'precio' => $_GET['precio'],
        'cantidad' => $_GET['cantidad'],
        'total' => $_GET['total']
    );

    array_push($_SESSION['carroCompras'], $producto);
}

header("Location: buscarProductos.php");
?>
