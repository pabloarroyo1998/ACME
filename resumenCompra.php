<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Revisar Compra</title>

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
                        <a class="nav-link" aria-current="page" href="buscarProductos.php">Buscar Producto</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="gestionProductos.php">Gestión Productos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="resumenCompra.php">Resumén de compra</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="historial.php">Historial de compras</a>
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

    <h1 class="tituloVacio">Resumén de compra pendiente</h1>

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

    <br>

    <?php
    $contador = 0;
    if (isset($_SESSION['carroCompras'])) {
        foreach ($_SESSION['carroCompras'] as $key => $producto) {
            if($contador == 0){
                echo "<table class='table-bordered' border='1'>
                    <tr>
                        <th>Código Producto</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Total</th>
                        <th></th>
                    </tr>";
            }

            echo "<tr>";
            echo "<td>{$producto['codigo']}</td>";
            echo "<td>{$producto['nombre']}</td>";            
            echo "<td>" . '<input type="number" class="precioUnitario" value='. $producto['precio'] . " readonly></td>";
            echo "<td>" . '<input type="number" class="cantidad" value=1>' . "</td>";
            echo '<td class="precioTotal">' . $producto['precio'] . "</td>";
            echo "<td><a class=\"btn btn-danger\" href=\"eliminar_producto.php?key=$key\">Eliminar del carro</a></td>";
            echo "</tr>";
            $contador +=1;
        }

        echo "</table>";
    }
    ?>
    <br>

    <h2>Total: <span id="total">0</span></h2>

    <div class="contenedor">
        <div class="botones">
            <a class="btn btn-success" href="confirmarCompra.php" type="button" >CONFIRMAR COMPRA</a>
            <a class="btn btn-danger" href="cancelarCompra.php" type="button" >CANCELAR COMPRA</a>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const cantidades = document.querySelectorAll('.cantidad');
            const precioUnidad = document.querySelectorAll('.precioUnitario');
            const precioTotales = document.querySelectorAll('.precioTotal');
            const totalElement = document.getElementById('total');
            recalcularTotal();

            cantidades.forEach(function (cantidadInput, index) {
                cantidadInput.addEventListener('input', function () {
                    const precioUnitario = parseFloat(precioUnidad[index].value);
                    const cantidad = parseFloat(cantidadInput.value);
                    const nuevoPrecioTotal = precioUnitario * cantidad;
                    precioTotales[index].textContent = nuevoPrecioTotal.toFixed(0);
                    recalcularTotal();
                });
            });

            function recalcularTotal() {
                let total = 0;
                precioTotales.forEach(function (precioTotal) {
                    total += parseFloat(precioTotal.textContent);
                });
                totalElement.textContent = "$" + total.toLocaleString();
            }
        });

    </script>

</body>

</html>