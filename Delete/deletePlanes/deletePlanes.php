<?php 
    session_start();
    if (isset($_GET['id'])){
        include('../../Datos/Datos_Planes.php');

         /*********************** */
        //ELIMINAR Planes

        $Planes =new Planes();
        $IDPlan=intval($_GET['id']);
        $res = $Planes->delete_Planes($IDPlan);
        if($res){
           echo 1;
        }else{
            echo "Error";
        }
          
        /*********************** */

        }
        else {
            header("location:../../MenuAdmin.php");
        }
    ?>