<?php 
    session_start();
    if (isset($_GET['id'])){
        include('../../Datos/Datos_Peliculas.php');

         /*********************** */
        //ELIMINAR Pelicula

        $Peliculas =new Peliculas();
        $IDPelicula=intval($_GET['id']);
        $res = $Peliculas->delete_Pelicula($IDPelicula);
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