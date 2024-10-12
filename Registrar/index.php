<?php
 session_start();
 //Requerir Modulo de Conexion.
 require "../ModuloConexion.php";
 //PARA REGRESAR A LA PELICULA SELECCIONADA
 if (isset($_SESSION['Regresar_Pelicula'])) {
  $Regresar_Pelicula = $_SESSION['Regresar_Pelicula'];
}
else{
    $Regresar_Pelicula = null;
}
?>
<!DOCTYPE html>
<html lang="en" >
<head>
<meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>REGISTRO PELIXFLIX</title>
  <!-- BOOTSTRAP CSS -->
  <link rel="stylesheet" href="../css/bootstrap.css">
  <link rel="stylesheet" href="../css/bootstrap.css.map">
  <link rel="stylesheet" href="../css/fontawesome_all.css">
  <link rel="stylesheet" href="style.css">

  <!-- JS -->
  <!-- tether JS -->
  <script src="../js/tether.min.js"></script>
  <!-- JQUERY JS -->
  <script src="../js/jquery.min.js"></script>
  <!-- BOOTSTRAP JS -->
  <script src="../js/bootstrap.js"></script>
  <!-- FONTAWESOME -->
  <script src="../js/fontawesome_all.js"></script>
  <!-- SWEETALERT2 JS -->
  <script src="../js/sweetalert2.all.min.js"></script>
  <!------------------------------------->


</head>
<body>
 <main>

  <!-- BOTON VOLVER AL MENU PRINCIPAL -->
  <div class="btn-volver">
    <a href="../index.php" class="btn-flotante"><i class="fa-solid fa-house"></i></a>
  </div>

  <!-- MENU PARA IR AL LOGIN -->
  <div class="menu-login">
    <label class="p-2"> ¿Ya tienes Cuenta ? </label>
    <a href="../Login/" class="btn-login text-white">Login</a>
  </div>


  <!-- FORMULARIO -->
  <div id="bg">
    <div class="module">
      <ul>
        <li id="tabUsuario" class="tab activeTab"><img src="https://i.imgur.com/Fk1Urva.png" alt="" class="icon"></li>
        <li id="tabCuenta" class="tab"><img src="https://w7.pngwing.com/pngs/744/669/png-transparent-computer-icons-user-material-design-my-account-icon-miscellaneous-company-service-thumbnail.png" alt="" class="icon"></li>
        <li id="tabTarjeta" class="tab" ><img src="https://i.pinimg.com/originals/2e/6b/3b/2e6b3bb6a2a3eccd057309a980cdbff2.png" alt="" class="icon"></li>
        <li id="tabPlan" class="tab" ><img src="https://toppng.com/uploads/preview/icono-flecha-derecha-azul-11550104356qn5asl0qln.png" alt="" class="icon"></li>
      </ul>   
      <form id="form" class="form" method="POST" action="../Interfaz/Interfaz_Registrar.php" id="form">
        <!-- INPUT PARA LLEVAR URL DE LA PELICULA QUE ESTABA -->
        <input type="hidden" name="Regresar_Pelicula" value="<?php echo $Regresar_Pelicula; ?>">
        <!-- CEDULA, NOMBRE, APELLIDO -->
        <div id="divUsuario">
          <!-- INPUT OCULTO CUANDO YA EXISTE LA CEDULA -->
          <input type="hidden" id="YaExCedula">
          <!-- INPUT CEDULA -->
          <label class="text-success" id="CedulaSuccessMensaje"></label>
          <label class="text-danger" id="CedulaErrorMensaje"></label>
          <input type="text" name="Cedula" onkeydown="ValidarCedula()" onblur="ValidarCedula()" id="Cedula" maxlength="8" placeholder="Cedula" class="textbox">
          <!-- INPUT NOMBRE -->
          <label class="text-success" id="NombreSuccessMensaje"></label>
          <label class="text-danger" id="NombreErrorMensaje"></label>
          <input type="text" name="Nombre" onkeydown="ValidarNombre()" onblur="ValidarNombre()" id="Nombre" placeholder="Nombre" class="textbox">
          <!-- INPUT APELLIDO -->
          <label class="text-success" id="ApellidoSuccessMensaje"></label>
          <label class="text-danger" id="ApellidoErrorMensaje"></label>
          <input type="text" name="Apellido" onkeydown="ValidarApellido()" onblur="ValidarApellido()" id="Apellido" placeholder="Apellido" class="textbox">
          <button type="button" id="Next1" value="Next" class="button mt-2">Next</button>
        </div>
        <!-- NOMBRE DE USUARIO, PASSWORD, GMAIL -->
        <div style="display:none;" id="divCuenta">
          <!-- INPUT NOMBRE DE USUARIO -->
          <label id="UsuarioSuccessMensaje" class="text-success"></label>
          <label id="UsuarioErrorMensaje" class="text-danger"></label>
          <input type="text" name="Usuario" maxlength="15" oninput="this.value = this.value.replace(/[^a-zA-Z0-9]/,'')" onkeydown="ValidarUsuario()" onblur="ValidarUsuario()" id="Usuario" placeholder="Nombre de Usuario" class="textbox">
          <!-- INPUT CONTRASEÑA -->
          <label id="PasswordSuccessMensaje" class="text-success"></label>
          <label id="PasswordErrorMensaje" class="text-danger"></label>
          <input type="password" name="Password" maxlength="15" onkeydown="ValidarPassword()" onblur="ValidarPassword()"  id="Password" placeholder="Contraseña" class="textbox">
          <!-- INPUT GMAIL -->
          <label id="GmailSuccessMensaje" class="text-success"></label>
          <label id="GmailErrorMensaje" class="text-danger"></label>
          <input type="mail" name="Gmail"  onkeydown="ValidarGmail()" onblur="ValidarGmail()" id="Gmail" placeholder="Gmail" class="textbox" >
          <button type="button" id="Next2" value="Next" class="button mt-2">Next</button>
        </div>
        <!-- NÚMERO DE TARJETA, SALDO, FECHA DE VENCIMIENTO -->
        <div style="display:none;" id="divTarjeta">
          <label id="N_TarjetaSuccessMensaje" class="text-success"></label>
          <label id="N_TarjetaErrorMensaje" class="text-danger"></label>
          <input type="text" name="N_Tarjeta"  maxlength="16" onkeydown="ValidarN_Tarjeta(event)" onblur="ValidarN_Tarjeta(event)" id="N_Tarjeta" placeholder="Numero de Tarjeta" class="textbox" >
          <label id="SaldoSuccessMensaje" class="text-success"></label>
          <label id="SaldoErrorMensaje" class="text-danger"></label>
          <input type="number" name="Saldo" maxlength="6" onkeydown="ValidarSaldo()" onblur="ValidarSaldo()" id="Saldo" placeholder="Saldo" class="textbox" >
          <label id="Fecha_VencimientoSuccessMensaje" class="text-success"></label>
          <label id="Fecha_VencimientoErrorMensaje" class="text-danger"></label>
          <input type="date" name="Fecha_Vencimiento" onkeydown="ValidarFecha_Vencimiento()" onblur="ValidarFecha_Vencimiento()" id="Fecha_Vencimiento" value="<?php echo date('Y-m-d') ?>" placeholder="Fecha_Vencimineto" class="textbox" >
          <button type="button" id="Next3" value="Next" class="button mt-2">Next</button>
        </div>
        <!-- AGREGAR UN PACK O UN PLAN -->
        <div class="text-center" style="display:none;" id="divPlan">
        <div id="btns-plan-pack">
          <div class="col-12">
            <label class="titulo"> Finalizar Registro de Usuario </label>
          </div>
          <div class="col-12"> <hr> </div>
              <!-- BTN PARA AGREGAR PLAN -->
          <div class="col-12 mt-4">
            <a href="#" class="btn btn-warning" id="btn-plan">Agregar Plan</a>   
          </div>
          <div class="col-12 mt-2"> O </div>
        </div>
        <!-- BTN PARA AGREGAR PACK -->
        <div id="div-btn-pack" class="col-12 mt-2 mb-4">
          <a href="#" class="btn btn-primary m-0" id="btn-pack">Agregar Pack</a>
        </div>
        <div id="DatosFinalesUser" style="display:none;">
          <div class="row">
            <div class="col-12"> <hr> </div>
            <div class="col-12">
              <label class="titulo"> Finalizar Registro de Usuario </label>
            </div>
            <div class="col-12"> <hr> </div>
            <div class="col-12">
              <input type="checkbox" id="TerminosCondiciones">
              He leído y acepto los <a href="#"> términos </a> y <a href="#"> condiciones </a> de uso del sistema.
            </div>
          </div>
        </div>

        <!-- BOTON PARA CONFIRMAR REGISTRO -->
        <a type="submit" id="NextFin" value="Finalizar" class="button mt-5" >Finalizar</a>
        </div>

        <!--CONTENIDO OCULTO CON LA ID DEL PLAN O DEL PACK -->
        <div>
          <input type="hidden" id="IDPlan" name="IDPlan" value="No">
          <input type="hidden" id="IDPack" name="IDPack" value="No">
          <br><br>
          <div id="IDPeliculasCompradas">
          
        </div>
        </div>
        
        <!-- IDS DE TODAS LAS PELICULAS SELECCIONADAS -->

        
      </form>
    </div>
  </div>
  <!-- FIN DEL FORMULARIO -->

  <!-- INPUTS CON LOS DATOS DEL PACK -->
  <input type="hidden" id="Nombrepack-plan" name="Nombrepack-plan">
  <input type="hidden" id="Montopack-plan" name="Montopack-plan">
  <input type="hidden" id="Cantidadpack-plan" name="Cantidadpack-plan">
  <input type="hidden" id="Descuento-pack" name="Descuento-pack">


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
            <a href="#" ID="<?php echo $ID ?>" Nombre="<?php echo $Detalle ?>" Monto="<?php echo $Monto ?>" Dispositivos="<?php echo $Dispositivos ?>" class="boton-plan">Seleccionar</a>
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
        
  <!-- PACK -->
  <div style="display:none;" id="cont-pack" class="container  mostrar-plan-pack">
   <div class="cont-planes-packs">
    <h1 class="plan-titulo text-white ">Seleccionar Pack</h1>
    <div class="contenedor-plan"> 
        <?php $sql="SELECT * FROM Planes WHERE Dia != '30'"; 
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
            <p><?php echo $Dispositivos?> Peliculas </p>
            <a href="#" ID="<?php echo $ID ?>" class="boton-pack" Nombre="<?php echo $Detalle ?>" Monto="<?php echo $Monto ?>" Cantidad="<?php echo $Dispositivos ?>">Seleccionar</a>
          </div> 
          <?php 
        } 
        } 
        ?> 
        </div> 
      </div>
    
  </div>
  </div>
  <!---------->

  <!-- PLAN SELECCIONADO FLOTANTE -->
  <div class="plan-seleccionado-flotante" style="display:none;"> 
    <h2 id="NombrePlanSelec"></h2> 
    <h3 id="MontoPlanSelec"><sup>$</sup></h3> 
    <p id="DispositivosPlanSelec"> Dispositivos </p>
     <!-- QUITAR SELECCION -->
     <button type="button" onclick="quitarPackPlan()" class="btn btn-danger quitar">Quitar Plan</button>
  </div> 

  <!-- PELICULAS SELECCIONADAS CARUSEL FLOTANTE -->
    <div class="pelicula-seleccionada-flotante" style="display:none;">
        <div class="ocultar-pel-select-flotante col-12 text-center"> <i class="fa-solid fa-arrow-down"></i> </div>
        <div class="mt-2" id="Cant_Peliculas_Seleccionadas"></div>
        
        <!-- CARUSEL -->
        <div id="carouselExampleSlidesOnly" class="carousel slide"  data-interval="false">
          <div id="carouselExampleControls" class="carousel slide"  data-interval="false">
            <div class="carousel-inner" style="max-width:200px;max-height:400px;" id="carousel-inner">
              <!-- DONDE SE AGREGARAN LAS PELICULAS SELECCIONADAS -->
            </div>
            <div class="m-4 p-4" id="aleliminar"><img src="../img/sin_seleccion_film.gif" width="250px" alt=""></div>

            <a class="carousel-control-prev btn-carusel-next-prev" style="display:none;" href="#carouselExampleControls" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next btn-carusel-next-prev" href="#carouselExampleControls" style="display:none;" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
        </div>

        <!-- PRECIO TOTAL -->
        <div id="PrecioTotal"></div>
        <!-- QUITAR SELECCION -->
        <button type="button"  onclick="quitarPackPlan()" class="btn btn-danger quitar-seleccion">Quitar Todos</button>
    </div>
    <!-- BOTON CONFIRMAR SELECCION FLOTANTE  -->
      <a href="#" id="BTN_FINALIZAR_COMPRA" style="display:none;" class="btn-flotante2">Confirmar</a>
    <!-- BOTON PARA MOSTRAR EL BOTON CONFIRMAR FLOTANTE -->
      <div class="mostrar-pelicula-seleccionada-flotante" style="transform: translateY(100vh);"><i class="fa-solid fa-arrow-up"></i></div>

  <!-- TIENDA PELICULAS -->
  <div style="display:none;"  class="container-fluid cont-shop-peliculas">
    <!-- GIF CARGA AL SELECIONAR -->
    <div id="gif-des_selecionar" style="display: none;width:100%;justify-content: center;align-items: center;position:fixed;z-index:4;background-color: rgba(0, 0, 0, .303);height:100vh;">
        <img src="https://acegif.com/wp-content/uploads/loading-29.gif" width="250px">
    </div>

    <!-- FILTRAR  -->
    <div class="caja2-shop-pelicula text-white">
      <hr>
      <h3> FILTROS </h3>
      <!-- BUSCADOR -->
      <div class="">
          <input type="text" id="Titulo" placeholder="Nombre de la Pelicula">
      </div>
       <hr>

       <!-- AÑO DE ESTRENO -->
       <div id="div-Anio_Estreno">
         <button type="button" id="btn-Anio_Estreno" class="btn m-0 text-warning">Año de Estreno</button>
       </div>
       <div style="display:none;" id="select-Anio_Estreno">
        <?php $cont = date('Y'); ?> 
        <select id="selectAnioEstreno" class="form-control mb-3"><option selected value="todos">Todos</option>
        <?php while ($cont >= 1900) { ?> 
          <option value="<?php echo($cont); ?>"><?php echo($cont); ?></option> <?php $cont = ($cont-1); } ?> </select>
       </div>
      
       <!-- GENERO -->
       <div  id="div-Genero" class="text-center">
         <button type="button" id="btn-Genero" class="btn m-0 text-warning">Genero</button>
       </div>
       <div style="display:none;" id="select-Genero" class="text-center">
        <?php 
        $sql="SELECT * FROM Catalogo"; 
        $res=mysqli_query($conn,$sql); 
        if($res){ 
          ?> 
            <select class="form-control" id="selectGenero">  
              <option  selected value="todos">Todos</option>
          <?php 
            while ($row = mysqli_fetch_assoc($res)) {
          ?> <option value="<?php echo $row['Genero'];?>"><?php echo $row['Genero']; ?></option> 
          <?php  
          } 
        } 
        ?> 
        </select>
       </div>


       <button id="Search-Pelicula-Shop" class="btn btn-success mt-5 text-white"><i class="fa-solid fa-filter"></i> Filtrar</button>
        <hr>
        

      
    </div>

    
     <!-- PELICULAS DISPONIBLES -->
    <div class="row caja1-shop-pelicula">

      <!-- Titulo -->
      <div class="col-12 text-center Titulo">
        <h1 class="h-uno" >Disponibles</h1> 
      </div>
      <!-- Datos de la Busqueda -->
      <div class="col-12 text-center Datos_Busqueda text-white">
        <h4 class="res_titulo-genero-anioEstreno"></h4>
      </div>

      <!-- Peliculas -->
      <div class="Peliculas container">
        <div class="row">
          <?php
            $sql = "SELECT * FROM Peliculas";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
            $ID     = $row['IDPelicula'];
            $Titulo = $row['Titulo'];
            $Imagen = base64_encode($row['Imagen']);
            ?>
            <div class="div-pelicula"  id="<?php echo $ID ?>" Titulo="<?php echo $Titulo ?>" Imagen="<?php echo $Imagen ?>" style="background-image:url('data:jpeg;base64,<?php echo $Imagen;?>');background-size: cover;background-repeat: no-repeat;">
              <label class="titulo">$10</label>
              <div class="icono-pelicula" style="min-height:50%;"></div>
              <div class="nomb-de-pelicula limitar-lineas">
              <p class="titulo"><?php echo $Titulo ?></p>
              </div>
              </div>
              <?php
                }
              ?>
            </div>
            <script>
              //CREAR VARIABLES NECESARIAS
              var cant_peliculas = 0;
              var Precio_Total = 0;
              var MontoMaximo = null;
              var CantidadMaxima = null;
              var DescuentoPack = null;
             
              //AL PASAR EL MOUSE EN UNA PELICULA//            
              $(".icono-pelicula").mouseenter(function(e){
                $(this).html('<label class="mjs-select-pelicula">Seleccionar</label>');
              });
              $(".icono-pelicula").mouseleave(function(e){
                $(this).html('');
              });
              ////////////AL HACER CLICK EN LA PELICULA///////////
              $('.div-pelicula').on('click', function(){

                //OBTENER VALORES DE LOS INPUTS
                Descuento = parseInt(DescuentoPack);

                Max_Precio = parseInt(MontoMaximo);
                Max_Precio_Total = Descuento + Max_Precio;

  
                
               
                //GUARDAR DATOS EN VARIABLES
                var border = $(this).css('border-color');
                var id = $(this).attr('id');
                var Titulo = $(this).attr('Titulo');
                var Imagen = $(this).attr('Imagen');
  
               
                var  film = $('.classid_'+id);
                //PARA QUITAR PELICULA SELECCIONADA
                if ( film.attr('idPelicula') == id) {
                 
                  //QUITAR LAS PELICULAS SELECCIONADAS PARA EVITAR ERRORES.
                  $('#IDPeliculasCompradas').html("");
                  
                  //VERIFICAR SI SOLO UNA PELICULA ESTA SELECCONADA
                  if ($('.carousel-item').length == 1) {
                    //MOSTRAR EL MENSAJE DE SELECCION
                    $('#aleliminar').css('display', 'block');
                    //OCULTAR LOS BOTONES PARA DESLIZAR
                    $('.btn-carusel-next-prev').css('display','none');
                    film.remove();
                  }
                  else if($('.carousel-item').length == 2){
                    //OCULTAR BOTONES DE DESLIZAR
                    $('.btn-carusel-next-prev').css('display','none');

                    //VERIFICAR SI LA PELICULA DESELECCIONADA ES LA ACTIVA ACTUALMENTE
                    if( $('.active').attr('idPelicula') == id){
                      //ACTIVAR EL DESLIZE AUTOMATICO
                      $('.carousel-control-next').click();
                      }
                    //MOSTRAR ANIMACION DE CARGA
                    $('#gif-des_selecionar').css("display","flex");
                    setTimeout(function(){
                      //ELIMINAR LUEGO DE DESLIZAR PARA EVITAR ERRORES
                      film.remove();
                      //LUEGO DE DESLIZAR(TIEMPO ESTIMADO 0,5s)
                      //QUITAR ANIMACION DE CARGA
                      $('#gif-des_selecionar').css("display","none");
                    }, 600);
                  }
                  //MAS DE DOS PELICULA SELECCIONADA
                  else{
                    //VERIFICAR SI LA PELICULA DESELECCIONADA ES LA ACTIVA ACTUALMENTE
                    if( $('.active').attr('idPelicula') == id){
                      //ACTIVAR EL DESLIZE AUTOMATICO
                      $('.carousel-control-next').click();
                      }
                    //MOSTRAR ANIMACION DE CARGA
                    $('#gif-des_selecionar').css("display","flex");
                    setTimeout(function(){
                      //ELIMINAR LUEGO DE DESLIZAR PARA EVITAR ERRORES
                      film.remove();
                      //LUEGO DE DESLIZAR(TIEMPO ESTIMADO 0,5s)
                      //QUITAR ANIMACION DE CARGA
                      $('#gif-des_selecionar').css("display","none");
                    }, 600);
                  }
                  //QUITAR BORDE AZUL
                  $(this).css('border', '2px solid rgb(33, 37, 41)');
                  //ESCALA POR DEFECTO
                  $(this).css('scale','1');
                  //REDUCIR NUMERO DE SELECCION
                  cant_peliculas = cant_peliculas - 1;
                  //REDUCIR MONTO
                   console.log("Precio Anterior: "+ Precio_Total);
                   Precio_Total = Precio_Total - 10;
                   console.log("Precio Aactual: "+ Precio_Total);
                  //AGREGAR CANTIDAD REDUCIDA
                  $('#Cant_Peliculas_Seleccionadas').html("Peliculas Seleccionadas " + cant_peliculas + "/" + CantidadMaxima);
                  //AGREGAR MONTO REDUCIDO
                  $('#PrecioTotal').html("$ "+Precio_Total);
                }
                //PARA AGREGAR LA PELICULA AL MENU DE SELECCION
                else{
                  if (cant_peliculas < CantidadMaxima) {
                    $('#gif-des_selecionar').css('display','flex');
                    //VERIICAR SI NO HAY OTRA SELECCIONADA ANTERIORMENTE(SI NO HAY ESTA TENDRA LA CLASS DE ACTIVA)
                    if ($('#aleliminar').css('display') == "block") {
                      //OCULTARLO
                      $('#aleliminar').css('display', 'none');
                      //AGREGAR LA PELICULA SELECCIONADA
                      //TIENE UNA CLASS CON LA ID DE ESTA
                      $('#carousel-inner').append('<div class="carousel-item active classid_'+id+'" idPelicula= "'+id+'"><img class="d-block" style="padding:0 3rem;width:100%;height:100%;" src="data:jpeg;base64,'+Imagen+'"></div>');
                    }
                    else{
                      //MOSTRAR BOTONES DE DESLIZAR
                      $('.btn-carusel-next-prev').css('display','flex');
                      //AGREGAR LA NUEVA SELECCIONADA OCULTA
                      $('#carousel-inner').append('<div class="carousel-item classid_'+id+'" idPelicula= "'+id+'"><img class="d-block" style="padding:0 3rem;width:100%;height:100%;" src="data:jpeg;base64,'+Imagen+'"></div>');
                      $('.carousel-control-next').click();

                      
                    }
                    //OCULTAR MENU DE CARGA
                    setTimeout(function(){
                      //LUEGO DE DESLIZAR(TIEMPO ESTIMADO 0,5s)
                      //QUITAR ANIMACION DE CARGA
                      $('#gif-des_selecionar').css("display","none");
                    }, 600);
                    //AUMENTAR NUMERO DE SELECCION
                    cant_peliculas = cant_peliculas + 1;
                    //CAMBIAR  NUMERO DE SELECCION
                    $('#Cant_Peliculas_Seleccionadas').html("Peliculas Seleccionadas " + cant_peliculas + "/" + CantidadMaxima);
             
                    //AUMENTAR MONTO
                    Precio_Total = Precio_Total + 10;
                    //CAMBIAR MONTO
                    $('#PrecioTotal').html("<br><h6>Monto:</h6>$ "+Precio_Total);
                    console.log("Maximo Precio: "+Max_Precio_Total);
  
                    $(this).css('border', '2px solid rgb(0, 0, 255)');
                    //CAMBIAR ESCALA
                    $(this).css('scale','1.1');
  
                   
                    //VERIFICAR PRECIO TOTAL PARA EL DESCUNTO
                    if (Precio_Total == Max_Precio_Total) {
                      Precio_Total_Descuento = Precio_Total - Descuento;
                      if (Max_Precio_Total == 10) {
                        $('#PrecioTotal').html("<br><br><h6>Monto Final: $ "+Precio_Total_Descuento+"</h6>");
                      }
                      else{
                        $('#PrecioTotal').html("<br><h6>Monto: $ "+Precio_Total+"</h6><h6>Descuento: $ "+Descuento+"</h6><h6>Monto Final: $ "+Precio_Total_Descuento+"</h6>");
                      }
                    }
                  }
                  else{
                    if (CantidadMaxima == 1) {
                      Swal.fire({
                        icon:'warning',
                        title:'Limite alcanzado!',
                        html:'Solo puedes seleccionar '+CantidadMaxima+' Pelicula.<br><br> Nota: Pueden obtener peliculas con descuentos con packs grandes!'
                      })
                    }
                    else{
                      Swal.fire({
                        icon:'warning',
                        title:'Limite alcanzado!',
                        html:'Solo puedes seleccionar '+CantidadMaxima+' Peliculas!'
                      })
                    }
                  }
                  
                  
                }
              })
             
              ////////////////////////////////////
            </script>
        </div>
      </div>
  </div>


</main>




<!-- SCRIPT PARA VALIDAR LOS INPUTS -->
<script src="scripts.js"></script>
<!------------------------------------->
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
    var id = $(this).attr('ID');
    $('#cont-plan').fadeOut(250);
    $('#div-btn-pack').hide();
    $('#IDPlan').val(id);
    $('#IDPack').val("No");
      $('#ReturnMenu').hide();
    
    Nombre = $(this).attr('Nombre');
    Monto = $(this).attr('Monto');
    Dispositivos = $(this).attr('Dispositivos');
    $('#NombrePlanSelec').html(Nombre);
    $('#MontoPlanSelec').html(Monto+" $");
    $('#DispositivosPlanSelec').html(Dispositivos+" Dispositivos");

    $('#btns-plan-pack').hide();
    $('#DatosFinalesUser').show();
    $('.plan-seleccionado-flotante').show();
    


  })
  ///////////////////////////


  ///////////PACK///////////
  //ABRIR CONTENIDO DE PACKS
  $('#btn-pack').on('click', function() {
    $('#cont-pack').fadeIn(500);
    $('#ReturnMenu').show();
  })

  //SELECCIONAR ELPACK
  $('.boton-pack').on('click', function() {
    quitarPackPlan();
    $('#btn-pack').html('Cambiar Pack');
    $('#btn-pack').css({'position':'fixed','z-index':'5','bottom':'7%','left':'3%'})
    $('#cont-pack').fadeOut(250);
    var id = $(this).attr('ID');
    $('#IDPlan').val("No");
    $('#IDPack').val(id);

    //CAMBIAR EL NOMBRE DEL BOTON DE QUITAR SELECCION/PACK
    $('.quitar-seleccion').html('Quitar Seleccion');

    //AGREGAR LOS VALORES DEL PACK EN LOS INPUTS OCULTOS
    MontoMaximo = $(this).attr('Monto');
    CantidadMaxima = $(this).attr('Cantidad');

    //CONDICION  PARA CAMBIAR DESCUENTO
    if ($(this).attr('Cantidad') == 1) {
      DescuentoPack = 0;
    }
    else if ($(this).attr('Cantidad') == 4) {
      DescuentoPack = 10;
  
    }
    $(".cont-shop-peliculas").show();
    $(".pelicula-seleccionada-flotante").show();
    $("#BTN_FINALIZAR_COMPRA").show();
    $('#BTN_FINALIZAR_COMPRA').html('Confirmar');
    $("#Cant_Peliculas_Seleccionadas").html('Peliculas Seleccionadas 0/'+ CantidadMaxima);
  })
  //////////////////////////

  /////////////FILTRAR/////////////
  $("#Titulo").keypress(function(e) {
    if(e.which == 13) {
    BUSCARPELICULA();
    }
  });
  $("#Search-Pelicula-Shop").on('click', function() {
    BUSCARPELICULA();
  });
  //NOMBRE,AÑO DE ESTRENO Y GENERO
  function BUSCARPELICULA(){
    

    var Titulo = $('#Titulo').val();
    var Año_Estreno = $('#selectAnioEstreno').val();
    var Genero = $('#selectGenero').val();

    //BUSCAR POR TITULO
    if (Genero == "todos" && Año_Estreno == "todos") {
      $.ajax({
        url:'Ajax.php',
        type:'POST',
        data:{'Titulo':Titulo, 'Por':'Titulo'},
      }).done(function(res){
      if (Titulo != "") {
        $('.caja1-shop-pelicula .Titulo .h-uno').html('Resultados:');
        $('.caja1-shop-pelicula .Datos_Busqueda .res_titulo-genero-anioEstreno').html(Titulo);
      }
      else{
        $('.caja1-shop-pelicula .Titulo .h-uno').html('Disponibles');
        $('.caja1-shop-pelicula .Datos_Busqueda .res_titulo-genero-anioEstreno').html('');
      }
      $('.caja1-shop-pelicula .Peliculas').html(res);
      }).fail(function(data){
        console.log(data)
      })
    }

    //BUSCAR POR GENERO
    else if(Genero != "todos" && Año_Estreno == "todos" & Titulo == ""){
      $.ajax({
        url:'Ajax.php',
        type:'POST',
        data:{'Genero':Genero, 'Por':'Genero'},
      }).done(function(res){
      $('.caja1-shop-pelicula .Titulo .h-uno').html('Resultados:');
      $('.caja1-shop-pelicula .Datos_Busqueda .res_titulo-genero-anioEstreno').html(Genero);
      $('.caja1-shop-pelicula .Peliculas').html(res);
      }).fail(function(data){
        console.log(data)
      })
    }

    //BUSCAR POR AÑO DE ESTRENO  
    else if(Genero == "todos" && Año_Estreno != "todos" & Titulo == ""){
      $.ajax({
        url:'Ajax.php',
        type:'POST',
        data:{'Anio_Estreno':Año_Estreno, 'Por':'Anio_Estreno'},
      }).done(function(res){
      $('.caja1-shop-pelicula .Titulo .h-uno').html('Resultado:');
      $('.caja1-shop-pelicula .Datos_Busqueda .res_titulo-genero-anioEstreno').html('Peliculas del '+Año_Estreno);
      $('.caja1-shop-pelicula .Peliculas').html(res);
      }).fail(function(data){
        console.log(data)
      })
    }

    //BUSCAR POR TITULO Y GENERO
    else if(Titulo != "" && Genero != "todos" && Año_Estreno == "todos"){
      $.ajax({
        url:'Ajax.php',
        type:'POST',
        data:{'Titulo':Titulo, 'Genero':Genero, 'Por':'Titulo_Genero'},
      }).done(function(res){
      $('.caja1-shop-pelicula .Titulo .h-uno').html('Resultados:');
      $('.caja1-shop-pelicula .Datos_Busqueda .res_titulo-genero-anioEstreno').html(Titulo+' <i class="fa-solid fa-arrow-right"></i> '+Genero);
      $('.caja1-shop-pelicula .Peliculas').html(res);
      }).fail(function(data){
        console.log(data)
      })
    }

    //BUSCAR POR TITULO Y AÑO DE ESTRENO
    else if(Titulo != "" && Genero == "todos" && Año_Estreno != "todos"){
      $.ajax({
        url:'Ajax.php',
        type:'POST',
        data:{'Titulo':Titulo, 'Anio_Estreno':Año_Estreno, 'Por':'Titulo-Anio_Estreno'},
      }).done(function(res){
      $('.caja1-shop-pelicula .Titulo .h-uno').html('Resultados:');
      $('.caja1-shop-pelicula .Datos_Busqueda .res_titulo-genero-anioEstreno').html(Titulo+' <i class="fa-solid fa-arrow-right"></i> '+Año_Estreno);
      $('.caja1-shop-pelicula .Peliculas').html(res);
      }).fail(function(data){
        console.log(data)
      })
    }

    //BUSCAR POR TITULO, GENERO Y AÑO DE ESTRENO
    else if(Titulo != "" && Genero != "todos" && Año_Estreno != "todos"){
      $.ajax({
        url:'Ajax.php',
        type:'POST',
        data:{'Titulo':Titulo, 'Genero':Genero, 'Anio_Estreno':Año_Estreno, 'Por':'Titulo-Genero-Anio_Estreno'},
      }).done(function(res){
      $('.caja1-shop-pelicula .Titulo .h-uno').html('Resultados:');
      $('.caja1-shop-pelicula .Datos_Busqueda .res_titulo-genero-anioEstreno').html(Titulo + ' <i class="fa-solid fa-arrow-right"></i> ' + Genero + ' <i class="fa-solid fa-arrow-right"></i> ' + Año_Estreno);
      $('.caja1-shop-pelicula .Peliculas').html(res);
      }).fail(function(data){
        console.log(data)
      })
    }

    //BUSCAR POR GENERO Y AÑO DE ESTRENO
     //BUSCAR POR TITULO Y AÑO DE ESTRENO
     else if(Titulo == "" && Genero != "todos" && Año_Estreno != "todos"){
      $.ajax({
        url:'Ajax.php',
        type:'POST',
        data:{'Genero':Genero, 'Anio_Estreno':Año_Estreno, 'Por':'Genero-Anio_Estreno'},
      }).done(function(res){
      $('.caja1-shop-pelicula .Titulo .h-uno').html('Resultados:');
      $('.caja1-shop-pelicula .Datos_Busqueda .res_titulo-genero-anioEstreno').html(Genero+' <i class="fa-solid fa-arrow-right"></i> '+Año_Estreno);
      $('.caja1-shop-pelicula .Peliculas').html(res);
      }).fail(function(data){
        console.log(data)
      })
    }
  }
  /////////////////////////////////

  //MOSTRAR u Ocultar SELECTS DE AÑO Y GENERO//
  //AÑO DE ESTRENO
  $('#btn-Anio_Estreno').on('click', function(){
    let select = $('#select-Anio_Estreno').css('display');
    if (select == "none") {
      $('#select-Anio_Estreno').css('display', 'block')
    }
    else{
      document.getElementById('select-Anio_Estreno').value="";
      $('#select-Anio_Estreno').css('display', 'none')
    }
   
    
  })
  //Genero
  $('#btn-Genero').on('click', function(){
    let select = $('#select-Genero').css('display');
    if (select == "none") {
      $('#select-Genero').css('display', 'block')
    }
    else{
      $('#select-Genero').css('display', 'none')
    }
    
  })

  //CAMBIAR FONDO DE LOS BOTONES DE DESLIZAR

  //CUANDO EL MOUSE ESA ARRIBA
  $('.pelicula-seleccionada-flotante').mouseenter(function(){
    $('.btn-carusel-next-prev').css('background-color','black')
  })
  //CUANDO DEJA DE ESTARLO
  $('.pelicula-seleccionada-flotante').mouseleave(function(){
    $('.btn-carusel-next-prev').css('background-color','transparent')
  })


  //OCULTAR MENU DE PELICULAS SELECCIONADAS
  $('.ocultar-pel-select-flotante').on('click', function(){
    $('.pelicula-seleccionada-flotante').css(	'transform','translateY(100vh)');
    setTimeout(function(){
      $('.mostrar-pelicula-seleccionada-flotante').css(	'transform','translateY(0vh)');
    }, 500);
  })
  $('.mostrar-pelicula-seleccionada-flotante').on('click', function(){
    $('.mostrar-pelicula-seleccionada-flotante').css(	'transform','translateY(100vh)');
    setTimeout(function(){
      $('.pelicula-seleccionada-flotante').css(	'transform','translateY(0vh)');
    }, 500);

  })
  

  $('#BTN_FINALIZAR_COMPRA').on('click', function(){
    var cont_select = $(".cont-shop-peliculas").css('display');
    //VOLVER A MOSTRAR EL MENU DE SELECCION
    if (cont_select == "none") {

      //MOSTRAR BOTON PARA QITAR EL PACK
      $('#ReturnMenu').show();
      
      //MOSTRAR BOTON PARA CAMBIAR EL PACK
      $('#btn-pack').html('Cambiar Pack');
      $('#btn-pack').css({'position':'fixed','z-index':'5','bottom':'7%','left':'3%'});
       $('#div-btn-pack').show();

      $(this).html('Confirmar');
      $(".cont-shop-peliculas").fadeIn(650);

      //CAMBIAR EL NOMBRE DEL BOTON DE QUITAR SELECCION/PACK
      $('.quitar-seleccion').html('Quitar Seleccion');
    }
    //SELECCIONAR LAS PELICULAS
    else{
     

      //OBTENER TODAS LAS PELICULAS DEL CARUSEL
      var Objet1 = $('.carousel-item')[0];
      var Objet2 = $('.carousel-item')[1];
      var Objet3 = $('.carousel-item')[2];
      var Objet4 = $('.carousel-item')[3];

      //VERIFICAR SI TODAS LAS PELICULAS FUERON SELECCIONADAS
      if (cant_peliculas == CantidadMaxima) {
        //OCULTAR EL BOTON VOLVER
        $('#ReturnMenu').hide();

        //OCULTAR EL BOTON PARA QUITAR PACK
        $('.quitar-seleccion').html('Quitar Pack');
        //OCULTAR EL MENU DE SELECCION DE PELICULAS
        $(".cont-shop-peliculas").fadeOut(650);
        $(this).html('Volver');
        $('#btns-plan-pack').hide();
        $('#div-btn-pack').hide();
        //MOSTRAR DATOS PRINCIPALES DE USUARIO
        $('#DatosFinalesUser').show();

        //SI NO EXISTE UNA SEGUNDA SELECCION(ES DECIR SELECCIONO PLAN DE 1 PELICULA)
        if (Objet2 == null) {
          var Film1 = Objet1.getAttribute('idPelicula');
          $('#IDPeliculasCompradas').html('<input type="hidden" name="Pelicula" value="'+Film1+'">');
        }
        //PACK DE 4 PELICULAS SELECCINADO
        else{
          var Film1 = Objet1.getAttribute('idPelicula');
          var Film2 = Objet2.getAttribute('idPelicula');
          var Film3 = Objet3.getAttribute('idPelicula');
          var Film4 = Objet4.getAttribute('idPelicula');
          $('#IDPeliculasCompradas').html('<input type="hidden" name="Pelicula1" value="'+Film1+'"><input type="hidden" name="Pelicula2" value="'+Film2+'" ><input type="hidden" name="Pelicula3" value="'+Film3+'"><input type="hidden" name="Pelicula4" value="'+Film4+'" >');
        }
        
      }
      //MENSAJE DE SI NO ESTAN TODAS LAS PELICULAS SELECCIONADAS
      else if (cant_peliculas == 0) {
      

        Swal.fire({
          icon:'info',
          title:'Por favor seleccione '+CantidadMaxima+' peliculas para continuar.',
          html:'Puedes hacerlo haciendo click sobre ellas!'
  
        })        
      }
      else{
        FilmDisponibles = CantidadMaxima - cant_peliculas;
        Swal.fire({
          icon:'info',
          title:'Aún tienes '+FilmDisponibles+' peliculas disponibles!'

        })
        
      }

     

    }
  })
  ///////////////////////////////////////////
   //QUITAR PACK O PLAN SELECCIONADO
   function quitarPackPlan(){
    cant_peliculas = 0;
    Precio_Total = 0;
    var tienda = $('.cont-shop-peliculas').css('display');

    //OCULTAR BOTONES DE DESLIZAR CARUSEL
     $('.btn-carusel-next-prev').css('display','none');
    if (tienda == "none") {
      //PACK Y PLAN
        $('#IDPlan').val('No');
        $('#IDPack').val('No');
      

      //PLAN
        $('.plan-seleccionado-flotante').hide();
        $('#NombrePlanSelec').html("");
        $('#MontoPlanSelec').html("");
        $('#DispositivosPlanSelec').html("");


  
      //PACK
        //CAMBIAR POSICION Y NOMBRE DEL BOTON PLAN
        $('#div-btn-pack').show();
        $('#btn-pack').html('Agregar Pack');
        $('#btn-pack').css({'position':'static'});

        //OCULTAR CARUSEL DE SELECCION
        $('.pelicula-seleccionada-flotante').hide();
        $('#BTN_FINALIZAR_COMPRA').hide();
        //QUITAR 
        $('#DatosFinalesUser').hide();
        //MOSTRAR BOTONES DE AGREGAR UN PACK O UN PLAN
        $('#btns-plan-pack').show();
        //QUITAR LAS IDS DE LAS PELICUAL SELECCIONADAS DE LOS INPUTS OCULTOS
        $("#IDPeliculasCompradas").html('');
        //QUITAR LAS PELICULAS DEL CARUSEL DE SELECCION
        $(".carousel-item").remove();
        //CAMBIAR EL CONTENIDO DE CANTIDAD DE PELICULAS SELECCIONADAS
        $("#Cant_Peliculas_Seleccionadas").html('Peliculas Seleccionadas 0/'+ CantidadMaxima);
        //DEJAR EL CONTENIDO DE PRECIO VACIO
        $("#PrecioTotal").html('');
        //MOSTRAR ITEM ACTIVO DEL CARUSEL(GIF DE NADA SELECCIONADO)
        $('#aleliminar').css('display', 'block');
        //QUITAR EL BORDE AZUL DE LA PELICULAS SELECCIONADAS ANTERIORMENTE
        $('.div-pelicula').css('border','none');
    }
    else{
      //OCULTAR EL BOTON PARA QUITAR PACK
      //QUITAR LAS IDS DE LAS PELICUAL SELECCIONADAS DE LOS INPUTS OCULTOS
      $("#IDPeliculasCompradas").html('');
      //QUITAR LAS PELICULAS DEL CARUSEL DE SELECCION
      $(".carousel-item").remove();
      //CAMBIAR EL CONTENIDO DE CANTIDAD DE PELICULAS SELECCIONADAS
      $("#Cant_Peliculas_Seleccionadas").html('Peliculas Seleccionadas 0/'+ CantidadMaxima);
      //DEJAR EL CONTENIDO DE PRECIO VACIO
      $("#PrecioTotal").html('');
      //MOSTRAR ITEM ACTIVO DEL CARUSEL(GIF DE NADA SELECCIONADO)
      $('#aleliminar').css('display', 'block');
      //QUITAR EL BORDE AZUL DE LA PELICULAS SELECCIONADAS ANTERIORMENTE
      $('.div-pelicula').css('border','none');
      
    }
  }

  //CERRAR TIENDA Y SELECCION DE PACKS
  $('#ReturnMenu').on('click', function(){
    $(this).hide();
    $('#cont-pack').hide();
    $('#cont-plan').hide();
    
    $('.cont-shop-peliculas').hide();
    quitarPackPlan();
  })

  

</script>
<!------------------------------------->

</body>
</html>