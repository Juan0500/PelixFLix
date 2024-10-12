<?php
    class Login{
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

          //*********************************************************************CRUD
        //FUNCTION LOGIN
        public function login($Usuario,$Contraseña){
            if (is_numeric($Usuario)) {
                 //Buscar si es un Administrador
                $sql2= "SELECT * FROM `Administrador` WHERE BINARY Cedula = $Usuario AND BINARY `Password` = '$Contraseña'";
                $res2 = mysqli_query($this->con,$sql2) && mysqli_affected_rows($this->con);

                if ($res2) {
                    return $res="Administrador";
                }
                else {
                    return false;
                }
            }
            else{
                //Buscar si es un Cliente
                $sql="SELECT * FROM Cuentas WHERE BINARY Usuario='$Usuario' AND BINARY Password = '$Contraseña'";
                $res = mysqli_query($this->con,$sql) && mysqli_affected_rows($this->con);

                if ($res) {
                    return $res="Usuario";
                }
                else {
                    return false;
                }
                
            }
           
        }
    }
    ?>