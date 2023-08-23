<?php 
if(!empty($_POST["Ingresar"])){
    if(empty($_POST["usuario"]) or empty($_POST["password"])){
        echo '<div class="alert alert-danger">LOS CAMPOS ESTAN VACIOS</div>';
    }else{
        $usuario= $_POST['usuario'];
        $clave= $_POST["password"];
        $sql= $conexion->query("SELECT * FROM Usuarios WHERE ID=$usuario AND contrasena='$clave'");
        if($datos=$sql->fetch_object()){
            session_start();
            $_SESSION['usuario'] = $usuario;
            header("Location:inicio.php");
            exit;                 
        }else{
            echo '<div class="alert alert-danger">ACCESO DENEGADO</div>';
        }
    }
}
?>