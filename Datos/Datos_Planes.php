<?php

    class Planes{
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
        //FUNCION READ O SELECT PARA Planes
        public function read_Planes(){
            $sql = "SELECT * FROM Planes";
            $res = mysqli_query($this->con, $sql);
            if ($res && mysqli_affected_rows($this->con) > 0) {
                return $res;
            }
            else{
                return false;
            }
        }
        public function BuscarPlanes($Planes){
            $sql = "SELECT * FROM Planes where IDPlan='$Planes'";
            $res = mysqli_query($this->con, $sql);
            $return = mysqli_fetch_object($res );
            return $return ;
        }
        //FUNCION CREATE PARA Planes
        public function create_Planes($Monto,$Dia, $Dispositivos, $Detalle){
            $sql = "INSERT INTO `Planes` (Monto, Dia, Dispositivos, Detalle) 
            VALUES ('$Monto',$Dia, '$Dispositivos', '$Detalle')";
            $res = mysqli_query($this->con, $sql);
            if($res){
                echo 1;
            }
        }
        //FUNCION UPDATE O ACTUALIZAR Planes
        public function update_Planes($Monto,$Dia,$Dispositivos, $Detalle, $IDPlan){
            $sql = "UPDATE Planes SET Monto='$Monto', Dia=$Dia, Dispositivos = '$Dispositivos', Detalle = '$Detalle' WHERE IDPlan=$IDPlan";
            $res = mysqli_query($this->con, $sql);
            if($res){
                echo 2;
            }
        }
        //FUNCION DELETE O ELIMINAR PARA Planes
        public function delete_Planes($IDPlan){
            $sql = "DELETE FROM Planes WHERE IDPlan=$IDPlan";
            $res = mysqli_query($this->con, $sql);
            if($res){
            return true;
            }else{
            return false;
            }
        }
        //********************************************************************** */
        public function Buscar_PlaEspecifico($Monto, $Dia, $Dispositivos, $Detalle){
            $sql="SELECT * FROM Planes WHERE Monto='$Monto' AND Dia='$Dia' AND Dispositivos='$Dispositivos' AND Detalle='$Detalle'";
            $res=mysqli_query($this->con,$sql);
            if ($res) {
                while ($row = mysqli_fetch_assoc($res)) {
                    echo $row['IDPlan'];
                }
            }
            else {
                	echo "ERROR";
            }
        }

       


    }

    ?>
    