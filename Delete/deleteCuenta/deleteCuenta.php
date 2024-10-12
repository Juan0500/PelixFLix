<?php
include "ModuloConexion.php";

if (isset($_GET['/'])) {
    $Cedula = $_GET['Cedula'];
   
    try{
        $conn->Begin_transaction();
        //ELIMINAR USUARIO
        $conn->query("DELETE FROM Usuarios WHERE Cedula=$Cedula");
        $conn->commit();

        session_start();
        session_destroy();
        header("location:index.php");
    } catch (Exception $e2){
        $conn->rollback();
        echo $e2;
    }
}

?>