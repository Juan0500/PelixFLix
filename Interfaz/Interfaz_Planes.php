<?php
session_start();

// INCLUIMOS LA CAPA DATOS O SUPERCLASE
include ("../Datos/Datos_Planes.php");
//CREAMOS LA INSTANCIA DATOS O SUPERCLASE
$Proyecto= new Planes();

//Verificar si viene con el input oculto
if (isset($_POST['crud'])) {
    //Guardadr POSTS en variables
    $Accion = $_POST['crud'];
    $Monto = $_POST['Monto'];
    $Dia = $_POST['Dia'];
    $Dispositivos = $_POST['Dispositivos'];
    $Detalle = $_POST['Detalle'];
    //Accion realizada dependiendo del caso
    switch($Accion) {
        //Caso para Guardar Usuario
        case 'G_Planes': 
            $Proyecto -> create_Planes($Monto, $Dia, $Dispositivos, $Detalle);
            break;
            //Caso para Modificar Usuario
        case 'M_Planes': 
            $IDPlan = $_POST['IDPlan'];
            $Proyecto -> update_Planes($Monto, $Dia, $Dispositivos, $Detalle, $IDPlan);
        break;
        case 'B_Planes': 
            $Proyecto -> Buscar_PlaEspecifico($Monto, $Dia, $Dispositivos, $Detalle);
        break;

    }
    
}
?>