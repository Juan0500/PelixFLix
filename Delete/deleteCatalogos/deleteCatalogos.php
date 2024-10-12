<?php 
    session_start();
    if (isset($_GET['id'])){
        include('../../Datos/Datos_Catalogos.php');

         /*********************** */
        //ELIMINAR CATALOGO
            $Catalogo =new Catalogos();
            $IDCatalogo=intval($_GET['id']);
            $res = $Catalogo->delete_Catalogo($IDCatalogo);
            if($res){
               echo 1;
            }else{
                echo "Error al eliminar el registro";
            }
        /*********************** */

        }
        else {
            header("location:../../MenuAdmin.php");
        }
    ?>