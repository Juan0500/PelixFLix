<?php
session_start();
// INCLUIMOS LA CAPA DATOS O SUPERCLASE
include ("../ModuloConexion.php");
include ("../Datos/Datos_Login.php");
//CREAMOS LA INSTANCIA DATOS O SUPERCLASE
$Proyecto= new Login();
 //Loguarse
 if ($_POST['crud'] == 0) {
    //PARA VOLVER A LA PELICULA SELECCIONADA
    $Regresar_Pelicula = $_POST['Regresar_Pelicula'];
    $Usuario = $_POST['Usuario'];
    $Contraseña = $_POST['Password'];
    $res = $Proyecto->login($Usuario,$Contraseña);
    if ($res == "Usuario") {
        //OBTENER LOS DATOS DEL USUARIO
        $sql = "SELECT Cedula FROM Cuentas WHERE Usuario = '$Usuario'";
        $res= mysqli_query($conn,$sql);
        if ($res) {
            while ($row = mysqli_fetch_assoc($res)) {
                $Cedula = $row['Cedula'];
                $_SESSION['Tipo_user'] = "Cliente";
                $_SESSION['alert_bienvenida'] = true;
                $_SESSION['Cedula'] = $Cedula;
            }
        }
        if ($Regresar_Pelicula != null) {
            header("location:../".$Regresar_Pelicula."");
        }
        else {
            header("location:../index.php");
        }
    }
    else if ($res == "Administrador") {
        $_SESSION['Tipo_user'] = "Administrador";
        $_SESSION['alert_bienvenida'] = true;
        $_SESSION['Cedula'] = $Usuario;
        if ($Regresar_Pelicula != null) {
            header("location:../".$Regresar_Pelicula."");
        }
        else {
            header("location:../index.php");
        }
    }
    else {
        $_SESSION["login_error"] = 1;
        header("location:../Login/");
    }
}
 //cerrar sesion
 if ($_POST["crud"] == 1) {
    $Regresar_Pelicula = $_POST['Regresar_Pelicula'];
    session_destroy();
    if ($Regresar_Pelicula != null) {
        header("location:../".$Regresar_Pelicula."");
    }
    else {
        header("location:../index.php");
    }
    
    
}
       