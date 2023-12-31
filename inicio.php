<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>

    <link rel="stylesheet" href="css/login.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>
</head>

<body class="inicio">
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
                        <a class="nav-link" aria-current="page" href="buscarProductos.php">Buscar Producto <i class="bi bi-node-plus-fill"></i></a>
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

    <div class="fondoPrincipal">
        <?php
        session_start();
        $conexion = new mysqli("localhost", "root", "cjloco1996", "acme", "3306");
        if (isset($_SESSION['usuario'])) {
            $id = $_SESSION['usuario'];
            $sql = $conexion->query("SELECT Nombre FROM Usuarios WHERE ID=$id");
            $nombreUsuario = mysqli_fetch_assoc($sql)['Nombre'];
            echo "<h1 class='titulo'>Bienvenido: $nombreUsuario!</h1>";
        } else {
            header('Location: login.php');
            exit;
        }
        ?>
        <img src="imagenes/ACME-logo.png" width="65%" class="imgFondo" alt="Imagen">
    </div>
</body>

</html>