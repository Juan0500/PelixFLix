<?php
    //----------------------------------------------\\
    date_default_timezone_set("America/Montevideo");
    //----------------------------------------------\\

    class Registrar{
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
        //Functio Register
        public function registerConPlan($Cedula, $Nombre, $Apellido, $Usuario, $Contraseña, $Email, $N_Tarjeta, $Saldo, $Fecha_Vencimiento, $IDPlan,  $Regresar_Pelicula){

            echo "Cedula: ".$Cedula."<br>";
            echo "Nombre: ".$Nombre."<br>";
            echo "Apellido: ".$Apellido."<br>";
            echo "usuario: ".$Usuario."<br>";
            echo "Contraseña: ".$Contraseña."<br>";
            echo "Email: ".$Email."<br>";
            echo "N_Tarjeta: ".$N_Tarjeta."<br>";
            echo "Saldo: ".$Saldo."<br>";
            echo "Fecha_Vencimiento: ".$Fecha_Vencimiento."<br>";
            echo "IDPlan: ".$IDPlan."<br>";
           
            //Trer dato(Dias y Precio) del plan para guardar fecha final y Descontar Monto de la Tarjeta
            $sql="SELECT * FROM Planes WHERE IDPlan = $IDPlan";
            $result=mysqli_query($this->con,$sql);
            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $Monto = $row['Monto'];
                    $Dia = $row['Dia'];
                }
            }
            //SALDO ACTUAL LUEGO DE PAGAR PLAN
            $Saldo_Actual = $Saldo - $Monto;
            // REALIZAR FECHAS
            $fecha_actual = date("Y-m-d H:i:s");
            $diferencia = strtotime('+ '.$Dia.' days', strtotime ($fecha_actual));
            $fecha_final = date ( 'Y-m-d H:i:s', $diferencia);

            //TRY PARA HACER MUTIPLES SENTENCIAS.
            try {
                $this->con->Begin_transaction();
                //USUARIO
                $this->con->query("INSERT INTO Usuarios(Cedula, Nombre, Apellido)VALUES('$Cedula', '$Nombre', '$Apellido')");
                //GUARDAR TARJETA
                $this->con->query("INSERT INTO Tarjetas(NTarjeta, Saldo, Fecha_Vencimiento, Cedula)VALUES('$N_Tarjeta', '$Saldo', '$Fecha_Vencimiento', '$Cedula')");  
            } catch (Exception $e1) {
                $this->con->rollback();
                echo $e1;
            }
            //VERIFICAR SI LA VARIABEL E1 ES NULLA(SIN ERRORES)
            if (!isset($e1)) {
                //TRAER LA ID DE LA TARJETA RECIEN GUARDADA
                $sql="SELECT * FROM Tarjetas WHERE NTarjeta = '$N_Tarjeta'";
                $res = mysqli_query($this->con,$sql);
                if ($res) {
                    while ($row = mysqli_fetch_assoc($res)) {

                        //ID DE LA TARJETA
                        $IDTarjeta = $row['ID'];

                        //SEGUNDO TRY DE MULTIPLES SENTENCIAS
                        try{
                            $this->con->Begin_transaction();
                            //CUENTA
                            $this->con->query("INSERT INTO Cuentas(Usuario, Password, email, Fecha_Inicio, Fecha_Final, Cedula, IDTarjeta, IDPlan, Estado)VALUES('$Usuario', '$Contraseña', '$Email', '$fecha_actual', '$fecha_final', '$Cedula', '$IDTarjeta', '$IDPlan',1)");
                            //ACTUALIZAR TARJETA
                            $this->con->query("UPDATE Tarjetas SET Saldo='$Saldo_Actual' WHERE ID = '$IDTarjeta'");
                            //MOVIMIENTO
                            $this->con->query("INSERT INTO Movimientos(Detalle, Monto, Saldo_Anterior, Saldo_Actual, Fecha_Movimiento, Cedula, IDTarjeta, Tipo_User)VALUES('Cuenta Creada, Con Plan', '$Monto', '$Saldo', '$Saldo_Actual', '$fecha_actual', '$Cedula', '$IDTarjeta', 'Vigente')");
            
                            $this->con->commit();
                        } catch (Exception $e2){
                            $this->con->rollback();
                        
                        }

                        //VERIFICAR SI LA VARIABEL E2 ES NULLA(SIN ERRORES)
                        if (!isset($e2)) {
                            $_SESSION['Tipo_user'] = "Nuevo Cliente";
                            $_SESSION['Cedula'] = $Cedula;
                            if ($Regresar_Pelicula != null) {
                                header("location:../".$Regresar_Pelicula."");
                            }
                            else {
                                header("location:../index.php");
                            }
                        }
                        //ERROR
                        else{
                            echo "<h1>ERROR AL GUARDAR CUENTA</h1><br>". $e2;
                        }
                    }
                }
            }
            else{
                echo "<h1> NO SE GUARDO EL USUARIO O LA TARJETA </h1>";
            }
        }
        public function registerConPack($Cedula, $Nombre, $Apellido, $Usuario, $Contraseña, $Email, $N_Tarjeta, $Saldo, $Fecha_Vencimiento, $IDPack, $IDPelicula, $Regresar_Pelicula){

            echo "Cedula: ".$Cedula."<br>";
            echo "Nombre: ".$Nombre."<br>";
            echo "Apellido: ".$Apellido."<br>";
            echo "usuario: ".$Usuario."<br>";
            echo "Contraseña: ".$Contraseña."<br>";
            echo "Email: ".$Email."<br>";
            echo "N_Tarjeta: ".$N_Tarjeta."<br>";
            echo "Saldo: ".$Saldo."<br>";
            echo "Fecha_Vencimiento: ".$Fecha_Vencimiento."<br>";
            echo "IDPack: ".$IDPack."<br>";
            echo "Pelicula: ".$IDPelicula."<br>";

            //Trer dato(Dias y Precio) del plan(pack) para guardar fecha final y Descontar Monto de la Tarjeta
            $sql="SELECT * FROM Planes WHERE IDPlan = $IDPack";
            $result=mysqli_query($this->con,$sql);
            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $Monto = $row['Monto'];
                    $Dia = $row['Dia'];
                }
            }
            //SALDO ACTUAL LUEGO DE PAGAR PLAN
            $Saldo_Actual = $Saldo - $Monto;
            // REALIZAR FECHAS
            $fecha_actual = date("Y-m-d H:i:s");
            $diferencia = strtotime('+ '.$Dia.' days', strtotime ($fecha_actual));
            $fecha_final = date ( 'Y-m-d H:i:s', $diferencia);

            //TRY PARA HACER MUTIPLES SENTENCIAS(GUARDAR USUARIO, TARJETA, CUENTA)
            try {
                $this->con->Begin_transaction();
                //USUARIO
                $this->con->query("INSERT INTO Usuarios(Cedula, Nombre, Apellido)VALUES('$Cedula', '$Nombre', '$Apellido')");
                //GUARDAR TARJETA
                $this->con->query("INSERT INTO Tarjetas(NTarjeta, Saldo, Fecha_Vencimiento, Cedula)VALUES('$N_Tarjeta', '$Saldo', '$Fecha_Vencimiento', '$Cedula')");

                $sql="SELECT * FROM Tarjetas WHERE NTarjeta = '$N_Tarjeta'";
                $res=mysqli_query($this->con, $sql);
                if ($res && mysqli_affected_rows($this->con)) {
                    while ($row = mysqli_fetch_assoc($res)) {
                        $IDTarjeta = $row['ID'];
                    }
                }

                try{
                    $this->con->Begin_transaction();
                    //CUENTA
                    $this->con->query("INSERT INTO Cuentas(Usuario, Password, email, Fecha_Inicio, Fecha_Final, Cedula, IDTarjeta, IDPlan, Estado)VALUES('$Usuario', '$Contraseña', '$Email', '$fecha_actual', '$fecha_final', '$Cedula', '$IDTarjeta', '$IDPack', 1)");
                    //ACTUALIZAR TARJETA
                    $this->con->query("UPDATE Tarjetas SET Saldo='$Saldo_Actual' WHERE ID = '$IDTarjeta'");
                    //MOVIMIENTO
                    $this->con->query("INSERT INTO Movimientos(Detalle, Monto, Saldo_Anterior, Saldo_Actual, Fecha_Movimiento, Cedula, IDTarjeta, Tipo_User)VALUES('Cuenta Creada, Con Pack de 1 Pelicula', '$Monto', '$Saldo', '$Saldo_Actual', '$fecha_actual', '$Cedula', '$IDTarjeta', 'Vigente')");
                    //PELICULA COMPRADA
                    $this->con->query("INSERT INTO PeliculasCompradas(Fecha, FechaFinal, IDPelicula, Cedula)VALUES('$fecha_actual', '$fecha_final', '$IDPelicula', '$Cedula')");

                    $_SESSION['Tipo_user'] = "Nuevo Cliente";
                    $_SESSION['Cedula'] = $Cedula;
                    if ($Regresar_Pelicula != null) {
                        header("location:../".$Regresar_Pelicula."");
                    }
                    else {
                        header("location:../index.php");
                    }
    
                    $this->con->commit();
                } catch (Exception $e2){
                    $this->con->rollback();
                    echo "<h1>ERROR AL GUARDAR CUENTA</h1><br>". $e2;
                
                }
    
               
            } catch (Exception $e1) {
                $this->con->rollback();
                echo "<h1>ERROR AL GUARDAR LA CUENTA O LA TARJETA</h1><br>". $e1;
            }

        }
        //***********************************************************/
        public function registerConPackDoble($Cedula, $Nombre, $Apellido, $Usuario, $Contraseña, $Email, $N_Tarjeta, $Saldo, $Fecha_Vencimiento, $IDPack, $IDPelicula1, $IDPelicula2, $IDPelicula3, $IDPelicula4, $Regresar_Pelicula){

            echo "Cedula: ".$Cedula."<br>";
            echo "Nombre: ".$Nombre."<br>";
            echo "Apellido: ".$Apellido."<br>";
            echo "usuario: ".$Usuario."<br>";
            echo "Contraseña: ".$Contraseña."<br>";
            echo "Email: ".$Email."<br>";
            echo "N_Tarjeta: ".$N_Tarjeta."<br>";
            echo "Saldo: ".$Saldo."<br>";
            echo "Fecha_Vencimiento: ".$Fecha_Vencimiento."<br>";
            echo "IDPack: ".$IDPack."<br>";
            echo "Pelicula1: ".$IDPelicula1."<br>";
            echo "Pelicula2: ".$IDPelicula2."<br>";
            echo "Pelicula3: ".$IDPelicula3."<br>";
            echo "Pelicula4: ".$IDPelicula4."<br>";

            //Trer dato(Dias y Precio) del plan(pack) para guardar fecha final y Descontar Monto de la Tarjeta
            $sql="SELECT * FROM Planes WHERE IDPlan = $IDPack";
            $result=mysqli_query($this->con,$sql);
            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $Monto = $row['Monto'];
                    $Dia = $row['Dia'];
                }
            }
            //SALDO ACTUAL LUEGO DE PAGAR PLAN
            $Saldo_Actual = $Saldo - $Monto;
            // REALIZAR FECHAS
            $fecha_actual = date("Y-m-d H:i:s");
            $diferencia = strtotime('+ '.$Dia.' days', strtotime ($fecha_actual));
            $fecha_final = date ( 'Y-m-d H:i:s', $diferencia);

            //TRY PARA HACER MUTIPLES SENTENCIAS(GUARDAR USUARIO, TARJETA, CUENTA,ETC).

            //GUARDAR USUARIO Y TARJETA
            try {
                $this->con->Begin_transaction();
                //USUARIO
                $this->con->query("INSERT INTO Usuarios(Cedula, Nombre, Apellido)VALUES('$Cedula', '$Nombre', '$Apellido')");
                //GUARDAR TARJETA
                $this->con->query("INSERT INTO Tarjetas(NTarjeta, Saldo, Fecha_Vencimiento, Cedula)VALUES('$N_Tarjeta', '$Saldo', '$Fecha_Vencimiento', '$Cedula')");

                //OBTENER ID DE LA TARJETA RECIEN GUARDADA
                $sqlSearchT="SELECT * FROM Tarjetas WHERE NTarjeta='$N_Tarjeta'";
                $resSearchT= mysqli_query($this->con,$sqlSearchT);
                if ($resSearchT && mysqli_affected_rows($this->con) > 0) {
                    while ($row = mysqli_fetch_assoc($resSearchT)) {
                        $IDTarjeta = $row['ID']; 
                    }
                }

                //GUARDAR LAS DEMAS
                try{
                    $this->con->Begin_transaction();
                    //CUENTA
                    $this->con->query("INSERT INTO Cuentas(Usuario, Password, email, Fecha_Inicio, Fecha_Final,  Cedula, IDTarjeta, IDPlan, Estado)VALUES('$Usuario', '$Contraseña', '$Email', '$fecha_actual', '$fecha_final', '$Cedula', '$IDTarjeta', '$IDPack', 1)");
                    //ACTUALIZAR TARJETA
                    $this->con->query("UPDATE Tarjetas SET Saldo='$Saldo_Actual' WHERE ID = '$IDTarjeta'");
                    //MOVIMIENTO
                    $this->con->query("INSERT INTO Movimientos(Detalle, Monto, Saldo_Anterior, Saldo_Actual, Fecha_Movimiento, Cedula, IDTarjeta, Tipo_User)VALUES('Cuenta Creada, Con pack de 4 Peliculas', '$Monto', '$Saldo', '$Saldo_Actual', '$fecha_actual', '$Cedula', '$IDTarjeta', 'Vigente')");
                    //PELICULAS COMPRADAS
                    $this->con->query("INSERT INTO PeliculasCompradas(Fecha, FechaFinal, IDPelicula, Cedula)VALUES('$fecha_actual', '$fecha_final', '$IDPelicula1', '$Cedula')");
                    $this->con->query("INSERT INTO PeliculasCompradas(Fecha, FechaFinal, IDPelicula, Cedula)VALUES('$fecha_actual', '$fecha_final', '$IDPelicula2', '$Cedula')");
                    $this->con->query("INSERT INTO PeliculasCompradas(Fecha, FechaFinal, IDPelicula, Cedula)VALUES('$fecha_actual', '$fecha_final', '$IDPelicula3', '$Cedula')");
                    $this->con->query("INSERT INTO PeliculasCompradas(Fecha, FechaFinal, IDPelicula, Cedula)VALUES('$fecha_actual', '$fecha_final', '$IDPelicula4', '$Cedula')");

                    $_SESSION['Tipo_user'] = "Nuevo Cliente";
                    $_SESSION['Cedula'] = $Cedula;
                    if ($Regresar_Pelicula != null) {
                        header("location:../".$Regresar_Pelicula."");
                    }
                    else {
                        header("location:../index.php");
                    }

                    $this->con->commit();
                } catch (Exception $e2){
                    $this->con->rollback();
                    echo "<h1>ERROR AL GUARDAR CUENTA</h1><br>". $e2;
                }
               
            } catch (Exception $e1) {
                $this->con->rollback();
                echo "<h1>ERROR AL GUARDAR CUENTA</h1><br>". $e1;
            }
          

        }
          
    }
    ?>