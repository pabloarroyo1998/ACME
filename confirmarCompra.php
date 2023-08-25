<?php
session_start();
$conexion = new mysqli("localhost", "root", "cjloco1996", "acme", "3306");

$id = $_SESSION['usuario'];
    $fechaActual = date("Y-m-d");

    $consulta = "INSERT INTO facturas (IDCliente, Fecha) VALUES ($id, '$fechaActual')";
    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado) {
        echo "Registro insertado correctamente.";
    } else {
        echo "Error en la inserción: " . mysqli_error($conexion);
    }

if (isset($_SESSION['carroCompras']) && !empty($_SESSION['carroCompras'])) {
    foreach ($_SESSION['carroCompras'] as $producto) {
        $consulta = $conexion->query("SELECT MAX(IDFactura) FROM facturas");
        $IDFactura = mysqli_fetch_assoc($consulta)['MAX(IDFactura)'];
        

        $idProducto = intval($producto['codigo']);
        $nombre = mysqli_real_escape_string($conexion, $producto['nombre']);
        $precio = floatval($producto['precio']);
        $cantidad = intval($producto['cantidad']);
        $total = intval($producto['total']);

        $consulta = "INSERT INTO productosVendidos (IDFactura, IDProducto, NombreProducto, PrecioProducto, CantidadProducto, Total) VALUES ($IDFactura, $idProducto, '$nombre', $precio, $cantidad, $total)";
        $resultado = mysqli_query($conexion, $consulta);

        if (!$resultado) {
            echo "Error en la inserción: " . mysqli_error($conexion);
        }
    }
}

// Cerrar la conexión
mysqli_close($conexion);
unset($_SESSION['carroCompras']);

header("Location: resumenCompra.php");

exit;
?>