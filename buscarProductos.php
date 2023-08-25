<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar productos</title>

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
                        <a class="nav-link active" aria-current="page" href="buscarProductos.php">Buscar Producto <i class="bi bi-node-plus-fill"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="resumenCompra.php">Resumén de compra <i class="bi bi-bag-fill"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="historial.php">Historial de compras <i class="bi bi-calendar2-week-fill"></i></a>
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

    <div class="buscar">
        <form action="buscarProductos.php" class="input-group mb-3" method="POST">
            <input type="text" class="form-control" name="valorBuscado"
                placeholder="Escriba el nombre o el código del producto a buscar">
            <div class="input-group-append">
                <button class="btn btn-info" type="submit">Buscar</button>
            </div>
        </form>
    </div>

    <?php
        session_start();
        $conexion = new mysqli("localhost", "root", "cjloco1996", "acme", "3306");
        if (isset($_SESSION['usuario'])) {
            $id = $_SESSION['usuario'];
            $sql = $conexion->query("SELECT Nombre FROM Usuarios WHERE ID=$id");
            $nombreUsuario = mysqli_fetch_assoc($sql)['Nombre'];
        } else {
            header('Location: login.php');
            exit;
        }
    ?>

    <?php
    if (!$_POST) {
        $conexion = new mysqli("localhost", "root", "cjloco1996", "acme", "3306");
        $sql = $conexion->query("SELECT * FROM Productos");

        // Verificar si hay resultados
        if ($sql) {
            // Imprimir los resultados en una tabla
            echo "<table class='table-bordered' border='1'>
                    <tr>
                        <th>Código Producto</th>
                        <th>Nombre</th>
                        <th>Detalles</th>
                        <th>Precio</th>
                        <th>Comprar</th>
                    </tr>";

            // Iterar a través de los resultados y mostrarlos en la tabla
            while ($fila = mysqli_fetch_assoc($sql)) {
                echo "<tr>";
                echo "<td>" . $fila['Codigo_producto'] . "</td>";
                echo "<td>" . $fila['Nombre'] . "</td>";
                echo "<td>" . $fila['Detalles'] . "</td>";
                echo "<td> $" . $fila['Precio'] . "</td>"; 
                $cantidad = 1;
                echo "<td><a class=\"btn btn-success\" href=\"agregar_carro.php?producto={$fila['Codigo_producto']}&nombre={$fila['Nombre']}&precio={$fila['Precio']}&cantidad=$cantidad&total={$fila['Precio']}\">Agregar al carro</a></td>";
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
    }
    ?>

    <?php
    if ($_POST) {
        $valor = $_POST['valorBuscado'];
        $conexion = new mysqli("localhost", "root", "cjloco1996", "acme", "3306");
        $sql = $conexion->query("SELECT * FROM Productos WHERE Nombre LIKE '%$valor%' OR Codigo_producto ='$valor'");
        // Verificar si hay resultados
        if ($sql) {
            $contador = 0;

            // Iterar a través de los resultados y mostrarlos en la tabla
            while ($fila = mysqli_fetch_assoc($sql)) {
                if ($contador == 0) {
                    // Imprimir los resultados en una tabla
                    echo "<table class='table-bordered' border='1'>
                <tr>
                    <th>Código Producto</th>
                    <th>Nombre</th>
                    <th>Detalles</th>
                    <th>Precio</th>
                    <th>Comprar</th>
                </tr>";
                }

                echo "<tr>";
                echo "<td>" . $fila['Codigo_producto'] . "</td>";
                echo "<td>" . $fila['Nombre'] . "</td>";
                echo "<td>" . $fila['Detalles'] . "</td>";
                echo "<td> $" . $fila['Precio'] . "</td>";
                $cantidad = 1;
                echo "<td><a class=\"btn btn-success\" href=\"agregar_carro.php?producto={$fila['Codigo_producto']}&nombre={$fila['Nombre']}&precio={$fila['Precio']}&cantidad=$cantidad&total={$fila['Precio']}\">Agregar al carro</a></td>";
                echo "</tr>";
                $contador += 1;
            }

            if ($contador == 0) {
                echo "<h1 class='tituloVacio'>No se encontró resultados</h1>";
            }

            echo "</table>";

            // Liberar el resultado
            mysqli_free_result($sql);
        } else {
            echo "Error en la consulta: " . mysqli_error($conexion);
        }

        // Cerrar la conexión
        mysqli_close($conexion);
    }
    ?>
</body>

</html>