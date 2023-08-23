<?php
session_start();

if (isset($_GET['key']) && isset($_SESSION['carroCompras'][$_GET['key']])) {
    unset($_SESSION['carroCompras'][$_GET['key']]);
}

header("Location: resumenCompra.php");
?>
