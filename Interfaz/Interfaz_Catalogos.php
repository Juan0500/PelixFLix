<?php
session_start();

// INCLUIMOS LA CAPA DATOS O SUPERCLASE
include ("../Datos/Datos_Catalogos.php");
//CREAMOS LA INSTANCIA DATOS O SUPERCLASE
$Proyecto= new Catalogos();

//Verificar si viene con el input oculto
if (isset($_POST['crud'])) {
    //Guardadr POSTS en variables
    $Accion = $_POST['crud'];
    $Genero = $_POST['Genero'];
    $Detalle = $_POST['Detalle'];
    //Accion realizada dependiendo del caso
    switch($Accion) {
        //Caso para Guardar Usuario
        case 'G_Catalogos': 
            $Proyecto -> create_Catalogos($Genero, $Detalle);
        break;
        //Caso para Modificar Usuario
        case 'M_Catalogos': 
            $IDCatalogo = $_POST['IDCatalogo'];
            $Proyecto -> update_Catalogos($Genero, $Detalle, $IDCatalogo);
        break;
        //Caso para Buscar Catalogo Especifico
        case 'B_Catalogos': 
            $Proyecto -> B_CatalogoEspecifico($Genero, $Detalle);
        break;

    }
}

?>
