<?php
require  "ModuloConexion.php";
date_default_timezone_set("America/Montevideo");
//GUARDAR PELICULA COMO VISTA
if (isset($_POST['GuardarComoVista'])) {
    $IDPelicula = $_POST['idPelicula'];
    $Cedula = $_POST['Cedula'];

    $sqlP="SELECT * FROM PeliculasVistas WHERE Cedula=$Cedula AND IDPelicula=$IDPelicula";
    $resP=mysqli_query($conn,$sqlP);
    if ($resP && mysqli_affected_rows($conn) == 0) {
        $sql="INSERT INTO PeliculasVistas(IDPelicula, Cedula)VALUES($IDPelicula, $Cedula)";
        $res=mysqli_query($conn,$sql);
        if ($res) {
            echo " GUARDO ";
        }
    }

}

//DESACRIVAR LA CUENTA ATRASADO
//------------------------------\\
if(isset($_POST['Desactivar'])){
  $Cedula = $_POST['Cedula'];
  if ($_POST['Desactivar'] == 1) {
    $sql="UPDATE Cuentas SET Estado='0' WHERE Cedula=$Cedula";
    $res=mysqli_query($conn,$sql);
    if ($res) {
      echo "DESACIVO";
    }
    else{
      echo "NO DESACIVO";
    } 
  }
  if ($_POST['Desactivar'] == 2) {
    $FechaDesactivada=date('Y-m-d H:i:s');
    $sql="UPDATE Cuentas SET Estado='0', Fecha_Final='$FechaDesactivada' WHERE Cedula=$Cedula";
    $res=mysqli_query($conn,$sql);
    if ($res) {
      echo "DESACIVO";
    }
    else{
      echo "NO DESACIVO";
    } 
  }
}
//------------------------------\\
//DESACRIVAR EL LA PELICULA COMPRADA
//------------------------------\\
if(isset($_POST['EliminarPeliculaComprada'])){
    $ID = $_POST['ID'];
    $sql="DELETE FROM PeliculasCompradas WHERE ID=$ID";
    $res=mysqli_query($conn,$sql);
    if ($res) {
      echo "ELIMINADA";
    }
    else{
      echo "NO ELIMINADA";
    } 
}
//------------------------------\\
//ACTIVAR EL CUENTA ATRASADA
if (isset($_POST['ActivarConPlan'])) {
  $IDPlan = $_POST['IDPlan'];
  $IDCuenta = $_POST['IDCuenta'];
  $Cedula = $_POST['Cedula'];
  $IDTarjeta = $_POST['IDTarjeta'];

  //Traer saldo actual de la tarjeta
  $sqlTraSald="SELECT * FROM Tarjetas WHERE ID = $IDTarjeta";
  $resTraSald=mysqli_query($conn,$sqlTraSald);
  while ($row=mysqli_fetch_assoc($resTraSald)) {
    $Saldo = $row['Saldo'];
  }

  //Trer dato(Dias y Precio) del plan para guardar fecha final y Descontar Monto de la Tarjeta
  $sql="SELECT * FROM Planes WHERE IDPlan = $IDPlan";
  $result=mysqli_query($conn,$sql);
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

  //VERIFICA SI TIENE SALDO DISPONIBLE
  if ($Saldo_Actual > 0) {
    try {
      $conn->Begin_transaction();
  
      //RENOVAR CUENTA
      $conn->query("UPDATE Cuentas SET Fecha_Inicio='$fecha_actual', Fecha_Final='$fecha_final', IDPlan='$IDPlan', Estado='1' WHERE IDCuenta=$IDCuenta");
  
      //GUARDAR MOVIMIENTO
      $conn->query("INSERT INTO Movimientos(Detalle, Monto, Saldo_Anterior, Saldo_Actual, Fecha_Movimiento, Cedula, IDTarjeta, Tipo_User)VALUES('Cuenta Renovada, Con Plan','$Monto','$Saldo','$Saldo_Actual','$fecha_actual','$Cedula','$IDTarjeta','Vigente')");

      //ACTUALIZAR TARJETA
      $conn->query("UPDATE Tarjetas SET Saldo='$Saldo_Actual' WHERE ID = '$IDTarjeta'");
  
      echo 1;
      $conn->commit();
    }  catch (Exception $e){
      $conn->rollback();
      echo "<h1>ERROR AL ACTUALIZAR EL USUARIO </h1><br>". $e;
    }
  }
  else{
    echo $Saldo;
  }

}
if (isset($_POST['ActivarConPackUnaPelicula'])) {
  $IDPelicula = $_POST['IDPelicula'];
  $IDPack = $_POST['IDPack'];
  $IDCuenta = $_POST['IDCuenta'];
  $Cedula = $_POST['Cedula'];
  $IDTarjeta = $_POST['IDTarjeta'];

  //Traer saldo actual de la tarjeta
  $sqlTraSald="SELECT * FROM Tarjetas WHERE ID = $IDTarjeta";
  $resTraSald=mysqli_query($conn,$sqlTraSald);
  while ($row=mysqli_fetch_assoc($resTraSald)) {
    $Saldo = $row['Saldo'];
  }

  //Trer dato(Dias y Precio) del plan para guardar fecha final y Descontar Monto de la Tarjeta
  $sql="SELECT * FROM Planes WHERE IDPlan = $IDPack";
  $result=mysqli_query($conn,$sql);
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
  $fecha_final = date ('Y-m-d H:i:s', $diferencia);

  //TRAER TITULO DE LA PELICULA
  $sqlTpelicula="SELECT * FROM Peliculas WHERE IDPelicula=$IDPelicula";
  $resTpelicula=mysqli_query($conn,$sqlTpelicula);
  while ($row = mysqli_fetch_assoc($resTpelicula)) {
    $Titulo = $row['Titulo'];
  }
  $Detalle = "Cuenta Renovada con Pack de 1 Pelicula, Nombre ".$Titulo;

  if ($Saldo_Actual > 0) {
    try {
      $conn->Begin_transaction();
  
      //RENOVAR CUENTA
      $conn->query("UPDATE Cuentas SET Fecha_Inicio='$fecha_actual', Fecha_Final='$fecha_final', IDPlan='$IDPack', Estado='1' WHERE IDCuenta = $IDCuenta");
  
      //GUARDAR MOVIMIENTO
      $conn->query("INSERT INTO Movimientos(Detalle, Monto, Saldo_Anterior, Saldo_Actual, Fecha_Movimiento, Cedula, IDTarjeta, Tipo_User)VALUES('$Detalle','$Monto','$Saldo','$Saldo_Actual','$fecha_actual','$Cedula','$IDTarjeta','Vigente')");

      //ACTUALIZAR TARJETA
      $conn->query("UPDATE Tarjetas SET Saldo='$Saldo_Actual' WHERE ID = '$IDTarjeta'");

      //PELICULA COMPRADA
      $conn->query("INSERT INTO PeliculasCompradas(Fecha, FechaFinal, IDPelicula, Cedula)VALUES('$fecha_actual', '$fecha_final', '$IDPelicula', '$Cedula')");
  
      echo 1;
      $conn->commit();
    }  catch (Exception $e){
      $conn->rollback();
      echo "<h1>ERROR AL ACTUALIZAR EL USUARIO </h1><br>". $e;
    }
  }
  else{
    echo $Saldo;
  }



}
if (isset($_POST['ActivarConPackDoble'])) {
  $IDPelicula1 = $_POST['IDPelicula1'];
  $IDPelicula2 = $_POST['IDPelicula2'];
  $IDPelicula3 = $_POST['IDPelicula3'];
  $IDPelicula4 = $_POST['IDPelicula4'];
  $IDPack = $_POST['IDPack'];
  $IDCuenta = $_POST['IDCuenta'];
  $Cedula = $_POST['Cedula'];
  $IDTarjeta = $_POST['IDTarjeta'];

  //Traer saldo actual de la tarjeta
  $sqlTraSald="SELECT * FROM Tarjetas WHERE ID = $IDTarjeta";
  $resTraSald=mysqli_query($conn,$sqlTraSald);
  while ($row=mysqli_fetch_assoc($resTraSald)) {
    $Saldo = $row['Saldo'];
  }

  //Trer dato(Dias y Precio) del plan para guardar fecha final y Descontar Monto de la Tarjeta
  $sql="SELECT * FROM Planes WHERE IDPlan = $IDPack";
  $result=mysqli_query($conn,$sql);
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
  $fecha_final = date ('Y-m-d H:i:s', $diferencia);

  //TRAER TITULO DE LA PELICULA
  $sqlTpelicula1="SELECT * FROM Peliculas WHERE IDPelicula=$IDPelicula1";
  $resTpelicula1=mysqli_query($conn,$sqlTpelicula1);
  while ($row = mysqli_fetch_assoc($resTpelicula1)) {
    $Titulo1 = $row['Titulo'];
  }
  $sqlTpelicula2="SELECT * FROM Peliculas WHERE IDPelicula=$IDPelicula2";
  $resTpelicula2=mysqli_query($conn,$sqlTpelicula2);
  while ($row = mysqli_fetch_assoc($resTpelicula2)) {
    $Titulo2 = $row['Titulo'];
  }
  $sqlTpelicula3="SELECT * FROM Peliculas WHERE IDPelicula=$IDPelicula3";
  $resTpelicula3=mysqli_query($conn,$sqlTpelicula3);
  while ($row = mysqli_fetch_assoc($resTpelicula3)) {
    $Titulo3 = $row['Titulo'];
  }
  $sqlTpelicula4="SELECT * FROM Peliculas WHERE IDPelicula=$IDPelicula4";
  $resTpelicula4=mysqli_query($conn,$sqlTpelicula4);
  while ($row = mysqli_fetch_assoc($resTpelicula4)) {
    $Titulo4 = $row['Titulo'];
  }
  $Detalle = "Cuenta Renovada con Pack de 4 Pelicula, ".$Titulo1.", ".$Titulo2.", ". $Titulo3.", ". $Titulo4;

  if ($Saldo_Actual > 0) {
    try {
      $conn->Begin_transaction();
  
      //RENOVAR CUENTA
      $conn->query("UPDATE Cuentas SET Fecha_Inicio='$fecha_actual', Fecha_Final='$fecha_final', IDPlan='$IDPack', Estado='1' WHERE IDCuenta = $IDCuenta");
  
      //GUARDAR MOVIMIENTO
      $conn->query("INSERT INTO Movimientos(Detalle, Monto, Saldo_Anterior, Saldo_Actual, Fecha_Movimiento, Cedula, IDTarjeta, Tipo_User)VALUES('$Detalle','$Monto','$Saldo','$Saldo_Actual','$fecha_actual','$Cedula','$IDTarjeta', 'Vigente')");

      //ACTUALIZAR TARJETA
      $conn->query("UPDATE Tarjetas SET Saldo='$Saldo_Actual' WHERE ID = '$IDTarjeta'");

      //PELICULAS COMPRADAS
      $conn->query("INSERT INTO PeliculasCompradas(Fecha, FechaFinal, IDPelicula, Cedula)VALUES('$fecha_actual', '$fecha_final', '$IDPelicula1', '$Cedula')");
      $conn->query("INSERT INTO PeliculasCompradas(Fecha, FechaFinal, IDPelicula, Cedula)VALUES('$fecha_actual', '$fecha_final', '$IDPelicula2', '$Cedula')");
      $conn->query("INSERT INTO PeliculasCompradas(Fecha, FechaFinal, IDPelicula, Cedula)VALUES('$fecha_actual', '$fecha_final', '$IDPelicula3', '$Cedula')");
      $conn->query("INSERT INTO PeliculasCompradas(Fecha, FechaFinal, IDPelicula, Cedula)VALUES('$fecha_actual', '$fecha_final', '$IDPelicula4', '$Cedula')");
  
      echo 1;
      $conn->commit();
    }  catch (Exception $e){
      $conn->rollback();
      echo "<h1>ERROR AL ACTUALIZAR EL USUARIO </h1><br>". $e;
    }
  }
  else{
    echo $Saldo;
  }



}

//------------------------------\\
//GUARDAR FAVORITO DE PELICULA
if (isset($_POST['AgregarFavorito'])) {
  $Cedula = $_POST['Cedula'];
  $IDPelicula = $_POST['IDPelicula'];
  
  $sqlBF="SELECT * FROM Favoritos WHERE Cedula = '$Cedula' && IDPelicula = '$IDPelicula'";
  $resBF=mysqli_query($conn,$sqlBF);
  if ($resBF && mysqli_affected_rows($conn) == 0) {
    $sql="INSERT INTO Favoritos(Cedula, IDPelicula)VALUES('$Cedula','$IDPelicula')";
    $res=mysqli_query($conn,$sql);
    if ($res) {
      echo 1;
    }
  }
  else {
    $sql="DELETE FROM Favoritos WHERE Cedula = $Cedula && IDPelicula = $IDPelicula";
    $res=mysqli_query($conn,$sql);
    if ($res) {
      echo 2;
    }
    
  }


}
//------------------------------\\
//COMPRAR PELICULA
if(isset($_POST['ComprarPelicula'])){
  $IDPelicula = $_POST['IDPelicula'];
  $IDTarjeta = $_POST['IDTarjeta'];
  $Cedula = $_POST['Cedula'];
  $Titulo = $_POST['Titulo'];
  $fecha_actual = date("Y-m-d H:i:s");
  $diferencia = strtotime('+ 1 days', strtotime ($fecha_actual));
  $fecha_final = date ( 'Y-m-d H:i:s', $diferencia);

  //DETALLE
  $Detalle = "Compra de ". $Titulo;

  //TRAER DATOS DE LA TARJETA
  $sqlDT="SELECT * FROM Tarjetas WHERE ID = $IDTarjeta";
  $resDT=mysqli_query($conn,$sqlDT);
  if ($resDT) {
    while ($row = mysqli_fetch_assoc($resDT)) {
      $Saldo_Anterior = $row['Saldo'];
      $Fecha_Vencimiento = $row['Fecha_Vencimiento'];
    }
    $Saldo_Actual = $Saldo_Anterior - 10;
    if ($Saldo_Actual > 0 && $Fecha_Vencimiento > $fecha_actual ) {
      try {
        $conn->Begin_transaction();
        //GUARDAR COMPRA DE LA PELICULA
        $conn->query("INSERT INTO PeliculasCompradas(Fecha, FechaFinal, IDPelicula, Cedula)VALUES('$fecha_actual','$fecha_final','$IDPelicula','$Cedula')");
        //ACTUALIZAR TARJETA
        $conn->query("UPDATE Tarjetas SET Saldo='$Saldo_Actual' WHERE ID = $IDTarjeta");
        //GUARDAR MOVIMIENTO
        $conn->query("INSERT INTO Movimientos(Detalle, Monto, Saldo_Anterior, Saldo_Actual, Fecha_Movimiento, Cedula, IDTarjeta, Tipo_User)VALUES('$Detalle','10','$Saldo_Anterior','$Saldo_Actual','$fecha_actual','$Cedula','$IDTarjeta', 'Vigente')");
        //CAMBIAR FECHA DE VENCIMIENTO DE LA CUENTA
        $conn->query("UPDATE Cuentas SET Fecha_Final='$fecha_final' WHERE Cedula='$Cedula'");

        echo 1;
        
        $conn->commit();
      } catch (Exception $e) {
        $conn->rollback();
        echo $e;
      }
      
    }
    else if($Saldo_Actual > 0 && $Fecha_Vencimiento <= $fecha_actual ){
      echo 2;
    }
    else {
      echo 3;
    }
    
  }
}
//------------------------------\\
//MODIFICAR DATOS DE LA CUENTA
if (isset($_POST['ModificarCuenta'])) {
  if (isset($_POST['ModificarNombre'])) {
    $Cedula=$_POST['Cedula'];
    $NombreNuevo = $_POST['ModificarNombre'];
    $sql="UPDATE Usuarios SET Nombre='$NombreNuevo' WHERE Cedula=$Cedula";
    $res=mysqli_query($conn,$sql);
    if ($res) {
      echo $NombreNuevo;
    }
  }
  if (isset($_POST['ModificarApellido'])) {
    $Cedula=$_POST['Cedula'];
    $ApellidoNuevo = $_POST['ModificarApellido'];
    $sql="UPDATE Usuarios SET Apellido='$ApellidoNuevo' WHERE Cedula=$Cedula";
    $res=mysqli_query($conn,$sql);
    if ($res) {
      echo $ApellidoNuevo;
    }
  }
  if (isset($_POST['ModificarUsuario'])) {
    $IDCuenta=$_POST['IDCuenta'];
    $UsuarioNuevo = $_POST['ModificarUsuario'];
    $sql="UPDATE Cuentas SET Usuario='$UsuarioNuevo' WHERE IDCuenta=$IDCuenta";
    $res=mysqli_query($conn,$sql);
    if ($res) {
      echo $UsuarioNuevo;
    }
  }
  if (isset($_POST['ModificarPassword'])) {
    $IDCuenta=$_POST['IDCuenta'];
    $PasswordNuevo = $_POST['ModificarPassword'];
    $sql="UPDATE Cuentas SET Password='$PasswordNuevo' WHERE IDCuenta=$IDCuenta";
    $res=mysqli_query($conn,$sql);
    if ($res) {
      echo $PasswordNuevo;
    }
  }
  if (isset($_POST['ModificarEmail'])) {
    $IDCuenta=$_POST['IDCuenta'];
    $EmailNuevo = $_POST['ModificarEmail'];
    $sql="UPDATE Cuentas SET email='$EmailNuevo' WHERE IDCuenta=$IDCuenta";
    $res=mysqli_query($conn,$sql);
    if ($res) {
      echo $EmailNuevo;
    }
  }
}
//------------------------------\\
//ELIMINAR
if (isset($_POST['EliminarCuenta'])) {
  $Cedula = $_POST['Cedula'];
  $sql="DELETE FROM Usuarios WHERE Cedula = $Cedula";
  $res=mysqli_query($conn,$sql);
  $sql2="UPDATE Movimientos SET Tipo_User ='Eliminado' WHERE Cedula=$Cedula ";
  $res2=mysqli_query($conn,$sql2);
  if ($res && $res2) {
    echo 1;
  }
}
//------------------------------\\
?>