<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap.css.map">
    <link rel="stylesheet" href="css/fontawesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <!-- JS --> 
    <script src="js/jquery.min.js"></script>
    <script src="js/tether.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/bootstrap.js.map"></script>
    <script src="js/fontawesome_all.js"></script>
    <script src="js/sweetalert2.all.min.js"></script>
  <title>PelixFLix</title>
</head>
<body id="body">
<?php
  session_start();
   //Requerir Modulo de Conexion.
 require "ModuloConexion.php";

  //VERIFICAR EL ESTADO DEL LOGIN ACUAL
  if (isset($_SESSION['Tipo_user'])) {

    //CUANDO LA SESION ESTA INICIADA.
    $tipo_user = $_SESSION['Tipo_user'];
    $Cedula   = $_SESSION['Cedula'];

    //CUAND ES ADMINISTRADOR
    if ($tipo_user == "Administrador") {
      $sqlAdmin = "SELECT * FROM Administrador WHERE Cedula = $Cedula";
      $result = mysqli_query($conn, $sqlAdmin);
      if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
          $Nombre   = $row['Nombre'];
          $Apellido = $row['Apellido'];
        }
      }
      if (isset($_SESSION['alert_bienvenida'])) {
          ?>
        <!-- Alerta de bienvenida para Administrador -->
        <script>
          Swal.fire({
              icon: 'success',
              title: '¡ Bienvenido de nuevo Admministrador <?php
              echo $Nombre; ?> !',
              html: '<label class="h3">  </label><br><label class="h6"> Asegurate de Verificar los Cambios realizados! </label>',
              icon: 'success'
          })    
        </script>
        <!--------------------------------------------->
        <?php
        unset($_SESSION['alert_bienvenida']);
      }
    }
    //CUANDO ES USUARIO
    else{
      //----------------------PARA CLIENTE-----------------------//
        //SENTENCIA PARA OBTENER DATOS DE LA CUENTA
        $sqlCuenta = "SELECT * FROM Cuentas WHERE Cedula=$Cedula";
        //---------------------------------------------------------//
        //SENTENCIA PARA OBTENER DATOS DEL USUARIO
        $sqlUsuario = "SELECT * FROM Usuarios WHERE Cedula=$Cedula";
        //---------------------------------------------------------//
        
        //---------------------------------------------------------//
        //OBTENER DATOS DE LA CUENTA
        $resultCuenta= mysqli_query($conn,$sqlCuenta);
        while ($row = mysqli_fetch_assoc($resultCuenta)) {
          $IDCuenta = $row['IDCuenta'];
          $NombreUsuario = $row['Usuario'];
          $Contraseña = $row['Password'];
          $Email = $row['email'];
          $Fecha_Inicio = $row['Fecha_Inicio'];
          $FechaFinal = $row['Fecha_Final'];
          $Estado = $row['Estado'];
          $IDTarjeta = $row['IDTarjeta'];
        }
        //---------------------------------------------------------//
        //OBTENER DATOS DEL USUARIO
        $resultUsuario= mysqli_query($conn,$sqlUsuario);
        while ($row = mysqli_fetch_assoc($resultUsuario)) {
          $Nombre = $row['Nombre'];
          $Apellido = $row['Apellido'];
        }
      //---------------------------------------------------------//

      //CUANDO ES CLIENTE ANTIGUO
      if ($tipo_user == "Cliente") {
        if (isset($_SESSION['alert_bienvenida'])) {
          ?>
            <!-- Alerta de bienvenida para Usuario -->
              <script>
                $(document).ready(function(){
                    Swal.fire({
                        icon: 'success',
                        title: '¡ Bienvenido de nuevo  <?php
                        echo $Nombre; ?> !',
                        html: '<label class="h3">  </label><br><label class="h6"> Disfruta de las novedades! </label>',
                        icon: 'success'
                    })    
                })
              </script>
            <!--------------------------------------------->
          <?php
          unset($_SESSION['alert_bienvenida']);
        }

        date_default_timezone_set("America/Montevideo");
        $dateActual = new DateTime(date('Y-m-d H:i:s'));
        $dateInicio = new DateTime($Fecha_Inicio);
        $dateFinal = new DateTime($FechaFinal);
        //VERIFICAR SI ES UN PLAN(SOLO LOS PLANES TIENEN 30 Dias)
        $diff = $dateInicio->diff($dateFinal);
        //CUANDO TIENE PLAN
        if($diff->days == 30 && $dateActual >= $dateFinal && $Estado == 1){
          ?>
          <script>
            //DESACRIVAR CUENTA
            $.ajax({
              url:'Ajax.php',
              type:'POST',
              data:{'Desactivar':1,'Cedula':'<?php echo $Cedula; ?>'},
            })
          </script>
          <?php
        }
        //CUAND TIENE PACK
        else if($diff->days == 1){
        
          //VERIFICAR SI NO ENCUENTRA NINGUNA PELICULA COMPRADA PARA DESACRIVAR LA CUENTA
          $sqlPDC="SELECT * FROM PeliculasCompradas WHERE Cedula=$Cedula";
          $resPDC=mysqli_query($conn,$sqlPDC);
          if($resPDC && mysqli_affected_rows($conn) == 0){
              ?>
              <script>
                $.ajax({
                  url:'Ajax.php',
                  type:'POST',
                  data:{'Desactivar':2,'Cedula':'<?php echo $Cedula; ?>'},
                }).done(function(res){
                })
              </script>
              <?php
          }
          $fechaActual=date('Y-m-d H:i:s');
          $sqlBPC="SELECT * FROM PeliculasCompradas WHERE Cedula=$Cedula && FechaFinal < '$fechaActual'";
          $resBPC=mysqli_query($conn,$sqlBPC);
          //VERIFICAR SI VENCIO LA PELICULA PARA ELIMINARLA DEL MENU DE COMPRADAS
          if ($resBPC && mysqli_affected_rows($conn)) {
            while ($row = mysqli_fetch_assoc($resBPC)) {
              $IDComprada = $row['ID'];
              $IDPeliculaComprada = $row['IDPelicula'];
              $FechaFinalPeliculaComprada = $row['FechaFinal'];

              ?>
              <script>
                 $.ajax({
                  url:'Ajax.php',
                  type:'POST',
                  data:{'EliminarPeliculaComprada':1,'ID':'<?php echo $IDComprada ?>'},
                })
              </script>
              <?php
             
            }
            ?>
              <script>
                Swal.fire({
                  icon:'info',
                  timer: 2500,
                  backdrop: `
                    rgba(0,0,0)`,
                  timerProgressBar: true,
                  title:'Pelicula Finalizada!',
                  html:'uno de tus packs ha finalizado!.'
                })
                setTimeout(() => {
                  location.reload();
                }, 2200);
              </script>
              <?php
          }
        }
       
      } 
      //CUANDO ES RECIEN REGISTRADO
      else{
        $_SESSION['Tipo_user'] = "Cliente";
        $tipo_user = $_SESSION['Tipo_user'];
        ?>
        <!-- ALERTA DEBIENVENIDA PARA CLIENTE RECIEN REGISTRADO -->
        <script>
          Swal.fire({
              title: 'Cuenta Creada con éxito!',
              html: '<label class="h3"> Gracias por ser Cleinte de Pelix Flix </label><br><label class="h6"> Contamos con los mejores catalogos para que disfrutes!</label>',
              icon: 'success'
          })  
        </script>
        <!------------------------------------------->
        <?php
      }

      //MENU DE RENOVACION DE LA CUENTA
      if ($Estado == 0) {
        ?>
          <!-- BOTON PARA RENOVAR CUENTA -->
          <div class="btn-renovarcuenta-flotante"> 
            <label>Cuenta Desactivada!</label>
            <label class="h5"> Renovar Cuenta </label> 
            <div class="row">
              <div class="col-6 text-center">
                <button id="btn-plan" class="btn boton btn-warning p-2 mr-4"> Plan </button>
              </div>
              <div class="col-6 text-center">
                <a href="RenovacionPack.php" class="btn boton btn-info p-2"> Pack </a>
              </div>
            </div>
          </div>

          <!-- BOTON CERRAR TIENDA -->
          <button style="display:none;" class="btn mt-5 mb-4 btn-regresar" id="ReturnMenu"> Volver </button>
          <!---------------------------------->

          <!-- PLAN -->
          <div style="display:none;" id="cont-plan" class="container  mostrar-plan-pack">
            <div class="cont-planes-packs">
              <h1 class="plan-titulo text-white ">Seleccionar Plan</h1>
              <div class="contenedor-plan"> 
                <?php $sql="SELECT * FROM Planes WHERE Dia = '30'"; 
                $res=mysqli_query($conn,$sql); 
                if ($res) { 
                  while ($row=mysqli_fetch_assoc($res)) { 
                  $ID=$row['IDPlan']; 
                  $Monto=$row['Monto'];
                  $Detalle=$row['Detalle'];
                  $Dispositivos=$row['Dispositivos'];
                  $logo = base64_encode($row['logo']);
                  ?> 
                  <div class="tabla-plan"> 
                    <h2><?php echo $Detalle?></h2> 
                    <img src="data:jpeg;base64,<?php echo $logo;?>" alt=""> 
                    <h3><?php echo $Monto?> <sup>$</sup></h3> 
                    <p><?php echo $Dispositivos?> Dispositivos </p>
                    <a class="boton-plan" href="#" IDPlan="<?php echo $ID ?>">Seleccionar</a>
                  </div> 
                  <?php 
                } 
                } 
                ?> 
                </div> 
              </div> 
            </div>
          </div>
          <!----------->
        <?php
      }
    }

  }  
  //CUANDO ESTA SIN LOGUEARSE 
  else{
    $tipo_user = null;
  }
  
  
  //CUANDO QUIERE LOGUEARSE/DESLOGUEARSE ESTANDO EN SELECCION DE UNA PELICULA.
  if (isset($Regresar_Pelicula)) {
    $_SESSION['Regresar_Pelicula'] = $Regresar_Pelicula;
  } 
  else {
    $_SESSION['Regresar_Pelicula'] = null;
  }


  ?>
<!-- BOTON DE ADINISTRADOR -->
<div class="MenuAcciones" id="admin">
  <input type="checkbox" name="" id="btn-mas">
  <div class="acciones">
    <a href="MenuAdmin.php?/=<?php echo  base64_encode("Cuentas")?>" id="MenuUsuarios">Menu Cuentas</a>
    <a href="MenuAdmin.php?/=<?php echo  base64_encode("Movimientos") ?>" id="MenuTarjetas">Menu Movimientos</a>
    <a href="MenuAdmin.php?/=<?php echo  base64_encode("Plan")  ?>" id="MenuPlanes">Menu Planes</a>
    <a href="MenuAdmin.php?/=<?php echo  base64_encode("Catalogo") ?>" id="MenuCatalogos">Menu Catalogos</a>
    <a href="MenuAdmin.php?/=<?php echo  base64_encode("Pelicula")  ?>" id="MenuPeliculas">Menu Peliculas</a>
    <div class="btn-mas">
      <label for="btn-mas"><i class="icon-mas2 fa-solid fa-pen-to-square"></i> </label>
    </div>
  </div>
</div>
<!-- ------------------------ -->
<!-- ANIMACION DE CARGA -->
<!--<div id="cargar" class="cargar">
  <img class="gif" whidth="40px" src="img/cargar.gif">
</div>-->
<!-- BARRA DE NAVEGACION -->
<nav id="navBAR" class="navbar navbar-expand-lg navbar-dark bg-dark" style="position:fixed;width:100%;z-index:998;top:0;">
  <a class="navbar-brand" href="index.php"> <img src="img/logo_pagina4.png" width="60px"> </a>
  <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId"
    aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavId">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item">
        <a class="nav-link" href="PeliculasBuscadas.php?¡=<?php echo  base64_encode("Novedades") ?>">Novedades</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="PeliculasBuscadas.php?¡=<?php echo  base64_encode("Estrenos") ?>">Estrenos</a>
      </li>
      <li class="nav-item dropdown mr-5">
        <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-toggle="dropdown" aria-haspopup="true"
          aria-expanded="false">Categorias</a>
        <div class="dropdown-menu" aria-labelledby="dropdownId">
          <?php
            $sql    = "SELECT Genero FROM Catalogo";
            $result = mysqli_query($conn, $sql);
            if ($result) {
             while ($row = mysqli_fetch_assoc($result)) {
              $Genero = $row['Genero'];?>
          <a class="dropdown-item" href="PeliculasBuscadas.php?id=<?php echo $Genero ?>&¡=<?php echo  base64_encode("Genero") ?>"><?php
            echo $Genero;?></a>
          <?php
            }
            }?>
        </div>
      </li>
      <li>
        <form method="GET" action="PeliculasBuscadas.php" class="form-inline my-2 my-lg-0 ml-5">
          <div class="form-outline">
            <input type="search" id="NAV_BUSCAR" name="b" class="form-control" placeholder="Buscar" aria-label="Search">
            <button type="submit" class="p-0 m-0 btn text-white"><i class="fa-solid fa-magnifying-glass"></i></button>
          </div>
        </form>
      </li>
    </ul>
    <ul class="navbar-nav mt-2 mt-lg-0">
      <?php
        if ($tipo_user != null) {?>
      <li class="nav-item dropdown text-center" style="width:150px;">
        <a class="nav-link dropdown-toggle" href="#" id="NavNombreUser" data-toggle="dropdown" aria-haspopup="true"
          aria-expanded="false"><?php
          echo $Nombre;?></a>
        <div class="dropdown-menu" aria-labelledby="dropdownId">
          <a class="dropdown-item text-center" href="Configuraciones.php">Configuracion</a>
          <form action="Interfaz/Interfaz_Login.php" method="post">
            <input type="submit" id="btnCerrarSesion" class="btn dropdown-item" value="Cerrar Sesion">
            <input type="hidden" name="crud" value="1">
            <input type="hidden" name="Regresar_Pelicula"
              value="<?php echo $_SESSION['Regresar_Pelicula'];?>">
          </form>
        </div>
      </li>
      <?php
        } else {?>
      <a href="Registrar/" class="btn btn-warning">Registrarse</a>
      <label class="mr-3 ml-3"> o </label>
      <a href="Login/" class="btn btn-primary">Iniciar Sesion</a>
      <?php
        }?>
    </ul>
  </div>
</nav>

<?php
  //CAMBIAR EL ESTADO DEL  BOTON DE ADMINISTRADOR
  if (isset($_SESSION['Tipo_user'])) {
    $tipo_user = $_SESSION['Tipo_user'];
    if ($tipo_user == "Administrador") {
      ?>
        <script>
          let BTNModificar = document.getElementById("admin");
          BTNModificar.style.display = "block";
          </script>
      <?php
    } 
    else {
      ?>
        <script>
          let BTNModificar = document.getElementById("admin");
          BTNModificar.style.display = "none";
        </script>
      <?php
    }
  } 
  else {
    ?>
      <script>
        let BTNModificar = document.getElementById("admin");
        BTNModificar.style.display = "none";
      </script>
    <?php
  }
  //FIN DE BOTON DE ADMINISTRADOR
?>
 
<!-- MY SCRIPT  -->
<script>

  ////////////PLAN///////////
  //ABRIR CONTENIDO DE PLANES
  $('#btn-plan').on('click', function() {
    $('#cont-plan').fadeIn(500);
    $('#ReturnMenu').show();
  })
  

  //SELECCIONAR EL PLAN
  $('.boton-plan').on('click', function() {
    var IDPlan = $(this).attr('IDPlan');
    Swal.fire({
      title: 'Confirmar Seleccion',
      text: "Si confirmas el pago sera realizado!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si, Confirmar'
    }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url:'Ajax.php',
        type:'POST',
        data:{'ActivarConPlan':1,'IDPlan':IDPlan,'IDCuenta':'<?php echo $IDCuenta ?>','Cedula':'<?php echo $Cedula ?>','IDTarjeta':'<?php echo $IDTarjeta ?>'},
      }).done(function(res){
        console.log(res);
        if (res == 1) {
          Swal.fire(
            'Cuenta Renovada con exito!',
            'Disfruta del nuevo contenido!',
            'success'
          )
          location.reload();
        }
        else{
          Swal.fire(
            'Error de Pago!',
            'No tienes saldo suficuente para adquerir el plan!<br><br>Saldo Disponible: $'+res,
            'error'
          )
        }
      })
    }
})
  })
  
  //CERRAR TIENDA Y SELECCION DE PACKS
  $('#ReturnMenu').on('click', function(){
    $(this).hide();
    $('#cont-pack').hide();
    $('#cont-plan').hide();
  })


</script>
<!------------------------------------->