<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de compras</title>

    <link rel="stylesheet" href="css/login.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="inicio.php">ACME</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="buscarProductos.php">Buscar Producto <i
                                class="bi bi-node-plus-fill"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="resumenCompra.php">Resumén de compra <i
                                class="bi bi-bag-fill"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="historial.php">Historial de compras <i
                                class="bi bi-calendar2-week-fill"></i></a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="cerrarSesion.php"><i class="bi bi-box-arrow-left"></i> Cerrar
                            Sesión</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <br>
    <h1 class="tituloVacio">Historial de compras</h1>

    <?php
    session_start();
    $conexion = new mysqli("localhost", "root", "cjloco1996", "acme", "3306");
    if (isset($_SESSION['usuario'])) {
        $id = $_SESSION['usuario'];
        $sql = $conexion->query("SELECT * FROM ProductosVendidos");


        if ($sql) {
            echo "<table class='table-bordered' border='1'>
                    <tr>
                        <th>Número de pedido</th>
                        <th>Código producto</th>
                        <th>Nombre</th>                        
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Total</th>
                    </tr>";

            // Iterar a través de los resultados y mostrarlos en la tabla
            while ($fila = mysqli_fetch_assoc($sql)) {
                echo "<tr>";
                echo "<td>" . $fila['IDFactura'] . "</td>";
                echo "<td>" . $fila['IDProducto'] . "</td>";
                echo "<td>" . $fila['NombreProducto'] . "</td>";
                echo "<td> $" . $fila['PrecioProducto'] . "</td>";
                echo "<td> $" . $fila['CantidadProducto'] . "</td>";
                echo "<td> $" . $fila['Total'] . "</td>";
                echo "</tr>";
            }

            echo "</table>";

            // Liberar el resultado
            mysqli_free_result($sql);
        } else {
            echo "Error en la consulta: " . mysqli_error($conexion);
        }

        // Cerrar la conexión
        mysqli_close($conexion);
    } else {
        header('Location: login.php');
        exit;
    }

    echo "<br><br><br>";
    ?>
</body>

</html>