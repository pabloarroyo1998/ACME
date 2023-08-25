<?php
session_start();

if (isset($_GET['key']) && isset($_SESSION['carroCompras'][$_GET['key']])) {          
    $_SESSION['carroCompras'][$_GET['key']]['cantidad'] -=1;
    $_SESSION['carroCompras'][$_GET['key']]['total'] = $_SESSION['carroCompras'][$_GET['key']]['precio']*$_SESSION['carroCompras'][$_GET['key']]['cantidad'];
    echo $_SESSION['carroCompras'][$_GET['key']]['cantidad'];
}

header("Location: resumenCompra.php");
?>

