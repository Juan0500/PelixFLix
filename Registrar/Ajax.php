<?php
require "../ModuloConexion.php";

//BUSCAR PELICULAS
if (isset($_POST['Por'])) {
  if ($_POST['Por'] == 'Titulo') {
      $TituloBuscado = $_POST['Titulo'];
      $sql="SELECT * FROM Peliculas WHERE Titulo LIKE '%".$TituloBuscado."%'";
      $res=mysqli_query($conn,$sql);
      if ($res && mysqli_affected_rows($conn) > 0) {
        ?>
        <div class="row">
        <?php
          while ($row = mysqli_fetch_assoc($res)) {
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
      <?php
      }
      else{
          echo "<div><div class='alert alert-danger'>SIN RESULTADOS</div></div>";
      }
  }
  if ($_POST['Por'] == 'Genero') {
      $Genero = $_POST['Genero'];
      $sql="SELECT * FROM Peliculas WHERE Genero = '$Genero'";
      $res=mysqli_query($conn,$sql);
      if ($res && mysqli_affected_rows($conn) > 0) {
          while ($row = mysqli_fetch_assoc($res)) {
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
      }
      else{
          echo "<div><div class='alert alert-danger'>SIN RESULTADOS</div></div>";
      }
  }
  if ($_POST['Por'] == 'Anio_Estreno') {
      $Año_Estreno = $_POST['Anio_Estreno'];
      $sql="SELECT * FROM Peliculas WHERE year(Fecha_Estreno)='$Año_Estreno'";
      $res=mysqli_query($conn,$sql);
      if ($res && mysqli_affected_rows($conn) > 0) {
          while ($row = mysqli_fetch_assoc($res)) {
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
      }
      else{
          echo "<div><div class='alert alert-danger'>SIN RESULTADOS</div></div>";
      }
  }
  if ($_POST['Por'] == 'Titulo_Genero') {
      $Titulo = $_POST['Titulo'];
      $Genero = $_POST['Genero'];
      $sql="SELECT * FROM Peliculas WHERE Titulo LIKE '%".$Titulo."%' AND Genero = '$Genero'";
      $res=mysqli_query($conn,$sql);
      if ($res && mysqli_affected_rows($conn) > 0) {
          while ($row = mysqli_fetch_assoc($res)) {
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
      }
      else{
          echo "<div><div class='alert alert-danger'>SIN RESULTADOS</div></div>";
      }
  }
  if ($_POST['Por'] == 'Titulo-Anio_Estreno') {
      $Titulo = $_POST['Titulo'];
      $Año_Estreno = $_POST['Anio_Estreno'];
      $sql="SELECT * FROM Peliculas WHERE year(Fecha_Estreno)='$Año_Estreno' AND Titulo LIKE '%".$Titulo."%'";
      $res=mysqli_query($conn,$sql);
      if ($res && mysqli_affected_rows($conn) > 0) {
          while ($row = mysqli_fetch_assoc($res)) {
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
      }
      else{
          echo "<div><div class='alert alert-danger'>SIN RESULTADOS</div></div>";
      }
  }
  if ($_POST['Por'] == 'Titulo-Genero-Anio_Estreno') {
      $Titulo = $_POST['Titulo'];
      $Genero = $_POST['Genero'];
      $Año_Estreno = $_POST['Anio_Estreno'];
      $sql="SELECT * FROM Peliculas WHERE year(Fecha_Estreno)='$Año_Estreno' AND Genero='$Genero' AND Titulo LIKE '%".$Titulo."%'";
      $res=mysqli_query($conn,$sql);
      if ($res && mysqli_affected_rows($conn) > 0) {
          while ($row = mysqli_fetch_assoc($res)) {
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
      }
      else{
          echo "<div><div class='alert alert-danger'>SIN RESULTADOS</div></div>";
      }
  }
  if ($_POST['Por'] == 'Genero-Anio_Estreno') {
      $Genero = $_POST['Genero'];
      $Año_Estreno = $_POST['Anio_Estreno'];
      $sql="SELECT * FROM Peliculas WHERE year(Fecha_Estreno)='$Año_Estreno' AND Genero='$Genero'";
      $res=mysqli_query($conn,$sql);
      if ($res && mysqli_affected_rows($conn) > 0) {
          while ($row = mysqli_fetch_assoc($res)) {
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
      }
      else{
          echo "<div><div class='alert alert-danger'>SIN RESULTADOS</div></div>";
      }
  }
  ?>
  <script>
    
    //AL REALIZAR LA BUSQUEDA
    $(document).ready(function(){
      //SIMULAR QUE EL MOUSE PASON POR TODAS LAS PELICULAS
        $(".div-pelicula").trigger('mouseenter');
    });

    
    //AL PASAR EL MOUSE EN LAS PELICULA//        
    
    //MOSTRAR BOTON DE SELECCION
    $(".icono-pelicula").mouseenter(function(e){
      $(this).html('<label class="mjs-select-pelicula">Seleccionar</label>');
    });
    //QUITAR BOTON DE SELECCION
    $(".icono-pelicula").mouseleave(function(e){
      $(this).html('');
    });
    //VERIFICAR SI YA HA SIDO SELECCIONADA ANTERIORMENTE DE LA BUSQUEDA(PARA EVITAR SERLO DE NUEVO Y AGREGAR BORDES AZULES)
    $('.div-pelicula').mouseenter(function(){
      var id_a = $(this).attr('id');
      if ($('*').hasClass('classid_'+id_a)){
        $(this).css({'border':'2px solid blue', 'scale':'1.1'});
      }
    })

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
  <?php
}
if (isset($_POST['BuscarCedula'])) {
  $CedulaIngresada = $_POST['Valor'];
  $sql="SELECT Cedula FROM Usuarios WHERE Cedula=$CedulaIngresada";
  $res=mysqli_query($conn,$sql);
  if ($res && mysqli_affected_rows($conn) > 0) {
    echo 1;
  }
}
?>

