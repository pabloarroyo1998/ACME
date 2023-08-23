<!-- Define que el documento esta bajo el estandar de HTML 5 -->
<!doctype html>

<!-- Representa la raíz de un documento HTML o XHTML. Todos los demás elementos deben ser descendientes de este elemento. -->
<html lang="es">

<head>

    <meta charset="utf-8">

    <title> Login </title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="author" content="Videojuegos & Desarrollo">
    <meta name="description" content="Ejemplo de formulario de acceso basado en HTML5 y CSS">
    <meta name="keywords" content="login,formulariode acceso html">

    <script src="js/jquery-3.2.1.min.js" type="text/javascript"></script>
    <link href="https://fonts.googleapis.com/css?family=Nunito&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


    <!-- Link hacia el archivo de estilos css -->
    <link rel="stylesheet" href="css/login.css">
    <script type="text/javascript">
        function mostrarPassword() {
            var cambio = document.getElementById("password");
            if (cambio.type == "password") {
                cambio.type = "text";
                $('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
            } else {
                cambio.type = "password";
                $('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
            }
        }

        $(document).ready(function () {
            //CheckBox mostrar contraseña
            $('#ShowPassword').click(function () {
                $('#Password').attr('type', $(this).is(':checked') ? 'text' : 'password');
            });
        });
    </script>

</head>

<body>

    <div id="contenedor">


        <div id="contenedorcentrado">
            <div id="login">
                <form method="post" id="loginform">
                    <label for="usuario">Usuario</label>
                    <input id="usuario" type="text" name="usuario" placeholder="Usuario" required>

                    <label for="password">Contraseña</label>
                                    
                    <div class="input-group-append">
                        <input id="password" type="Password" placeholder="Contraseña" name="password" required>
                        <div class="input-group-append">
                            <button id="show_password" class="btn btn-primary mostrar" type="button" onclick="mostrarPassword()"> <span class="fa fa-eye-slash icon"></span> </button>
                        </div>                     
                    </div>                    

                    <input type="submit" class="boton" title="Ingresar" name="Ingresar" value="Ingresar">
                </form>
            </div>

            <div id="derecho">
                <?php
                include("conexion_bd.php");
                include("controlador.php");
                ?>
                <div class="titulo">
                    Bienvenido
                </div>
                <div >
                    <img src="imagenes/ACME-logo.png" width="100%">
                </div>
            </div>
        </div>
    </div>

    <form action="inicio.php" method="post">
        <label for="dato">Ingrese un dato:</label>
        <input type="text" name="dato" id="dato">
        <button type="submit" name="enviar">Enviar</button>
    </form>

</body>

</html>