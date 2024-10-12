<?php

    class Catalogos{
        //FUNCION DE CONEXION EN EL SERVIDOR LOCAL
        private $con;
        private $dbhost="localhost";
        private $dbuser="root";
        private $dbpass="";
        private $dbname="bd_proyecto";
        function __construct(){
            $this->connect_db();
        }
        public function connect_db(){
            $this->con = mysqli_connect($this->dbhost, $this->dbuser, $this->dbpass, $this->dbname);
            if(mysqli_connect_error()){
                die("Conexión a la base de datos falló " . mysqli_connect_error() . mysqli_connect_errno());
            }
        }



          //********************************************************************** */

        //FUNCION CREATE PARA CATALOGO
        public function create_Catalogos($Genero,$Detalle){
            $sql = "INSERT INTO `Catalogo` (Genero, Detalle) 
            VALUES ('$Genero','$Detalle')";
            $res = mysqli_query($this->con, $sql);
            if($res){
                echo 1;
            }else{
            return false;
            }
        }
        //FUNCION READ O SELECT PARA Catalogos
        public function read_Catalogos(){
            $sql = "SELECT * FROM Catalogo";
            $res = mysqli_query($this->con, $sql);
            if ($res && mysqli_affected_rows($this->con) > 0) {
                return $res;
            }
            else {
                return false;
            }
        }
        public function BuscarCatalogos($IDCatalogo){
            $sql = "SELECT * FROM Catalogo where IDCatalogo='$IDCatalogo'";
            $res = mysqli_query($this->con, $sql);
            $return = mysqli_fetch_object($res );
            return $return ;
        }
        //FUNCION UPDATE O ACTUALIZAR CATALOGO
        public function update_Catalogos($Genero,$Detalle,$IDCatalogo){
            $sql = "UPDATE Catalogo SET Genero='$Genero',Detalle='$Detalle' WHERE IDCatalogo=$IDCatalogo";
            $res = mysqli_query($this->con, $sql);
            if($res){
               echo 2;
            }else{
                return false;
            }
        }
        //FUNCION DELETE O ELIMINAR PARA CATALOGO
        public function delete_Catalogo($IDCatalogo){
            $sql = "DELETE FROM Catalogo WHERE IDCatalogo=$IDCatalogo";
            $res = mysqli_query($this->con, $sql);
            if($res){
            return true;
            }else{
            return false;
            }
        }

        public function  B_CatalogoEspecifico($Genero, $Detalle){
            $sql="SELECT * FROM Catalogo WHERE Genero='$Genero' AND Detalle='$Detalle'";
            $res=mysqli_query($this->con,$sql);
            if ($res) {
                while ($row = mysqli_fetch_assoc($res)) {
                    echo $row['IDCatalogo'];
                }
            }
        }
        
       
       
        
    }

    ?>
    