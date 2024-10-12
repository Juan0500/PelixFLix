
<?php
session_start();
// INCLUIMOS LA CAPA DATOS O SUPERCLASE
include ("../Datos/Datos_Registrar.php");
//CREAMOS LA INSTANCIA DATOS O SUPERCLASE
$Proyecto= new Registrar();

/*****************************************************************/
$Regresar_Pelicula = $_POST['Regresar_Pelicula'];
$Cedula = $_POST["Cedula"];
$Nombre = $_POST["Nombre"];
$Apellido = $_POST["Apellido"];
$Usuario = $_POST["Usuario"];
$Contraseña = $_POST["Password"];
$Email = $_POST["Gmail"];
$N_Tarjeta = $_POST["N_Tarjeta"];
$Saldo = $_POST["Saldo"];
$Fecha_Vencimiento = $_POST["Fecha_Vencimiento"];
$IDPlan = $_POST["IDPlan"];
$IDPack = $_POST["IDPack"];

//COMPROBAR SI VIENE CON PLAN O CON PACK
if ($IDPlan != "No") {
    $res = $Proyecto->registerConPlan($Cedula, $Nombre, $Apellido, $Usuario, $Contraseña, $Email, $N_Tarjeta, $Saldo, $Fecha_Vencimiento, $IDPlan, $Regresar_Pelicula); 
}
else{
    if (isset($_POST['Pelicula'])) {
        $IDPelicula = $_POST['Pelicula'];
        $res = $Proyecto->registerConPack($Cedula, $Nombre, $Apellido, $Usuario, $Contraseña, $Email, $N_Tarjeta, $Saldo, $Fecha_Vencimiento, $IDPack, $IDPelicula, $Regresar_Pelicula); 
    }
    else{
        $IDPelicula1 = $_POST['Pelicula1'];
        $IDPelicula2 = $_POST['Pelicula2'];
        $IDPelicula3 = $_POST['Pelicula3'];
        $IDPelicula4 = $_POST['Pelicula4'];
        $res = $Proyecto->registerConPackDoble($Cedula, $Nombre, $Apellido, $Usuario, $Contraseña, $Email, $N_Tarjeta, $Saldo, $Fecha_Vencimiento, $IDPack, $IDPelicula1, $IDPelicula2, $IDPelicula3, $IDPelicula4, $Regresar_Pelicula); 

    }
}

/*************************************************************** */
    ?>
   