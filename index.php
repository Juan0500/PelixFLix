<?php
//------------------------------\\
require "header.php";
//------------------------------\\
?>
<body id="body">
  <main class="mt-5">
    <!-- CONTENEDOR DEL MENU PRINCIPAL -->
    <div class="container contenedor-menu-principal">
      <!-- MENU DE INOVACION  -->
      <?php
       if ($tipo_user == null) {
         ?>
        <div class="barra-blanca"></div>
        <div class="menu-inovacion">
          <!-- TITULO -->
          <div class="row">
            <div class="col-12 text-center">
              <label class="titulo-inovacion"> !Algo nunca antes visto! </label>
            </div>
          </div>
          <!-- POSTERS -->
          <div class="sub-menu-inovacion">
            <div class="div-imagen">
            </div>
            <div class="div-video">
             <img src="img/Inovacion.gif" height="400px">
            </div>
          </div>
          <!-- INFO INOVACION -->
          <div class="info-inovacion">
            <label> ¿Qué esperas?<br> Adquiere ya!, sin la necesidad de pagos menusales! </label><br>
            <a href="#" class="btn btn-warning">Más Información</a>
          </div>
        </div>
        <div class="barra-blanca"></div>
        <?php
       }
       ?>
    
        <!-- Carusel  -->
      <div id="carouselGrande" class="carousel slide mt-5" data-ride="carousel">
        <div class="carousel-inner">
            <?php
            $sql1 = "SELECT * FROM Peliculas ORDER BY RAND() LIMIT 1";
            $res1 = mysqli_query($conn,$sql1);
            if ($res1 && mysqli_affected_rows($conn) > 0) {
              while ($row = mysqli_fetch_assoc($res1)) {
                $IDPelicula = $row['IDPelicula'];
                $Titulo = $row['Titulo'];
                $Descripcion = $row['Descripcion'];
                $Imagen = base64_encode($row['Portada']);
                ?>
                <div class="carousel-item active">
                  <div style="background: linear-gradient(rgba(0, 0, 0, .50) 0%, rgba(0, 0, 0, .50) 100%), url('data:jpeg;base64,<?php echo $Imagen;?>');background-size: 100% 100%; background-repeat: no-repeat;" class="d-block w-100 carusel pelicula-principal">
                    <div class="contenedor container-fluid">
                      <div class="row row-titulo">
                        <div class="col-12">
                          <h3 class="titulo"><?php echo $Titulo ?></h3>
                        </div>
                      </div>
                      <div class="row row-descripcion">
                        <div class="col-12">
                          <label class="descripcion h4">
                          <?php echo $Descripcion ?>
                          </label>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-12 row-botones">
                          <a href="Seleccion.php?fi14=<?php echo base64_encode($IDPelicula);?>" role="button" class="boton p-2"><i class="fas fa-play play-white"></i>  Reproducir</a>  
                          
                        </div>
                      </div>
                    
                    </div>
                  </div>
                </div>


                <?php
              }
              $sql2 = "SELECT * FROM Peliculas WHERE IDPelicula != $IDPelicula ORDER BY RAND()";
              $res2 = mysqli_query($conn,$sql2);
              if ($res2) {
              while ($row = mysqli_fetch_assoc($res2)) {
                $IDPelicula = $row['IDPelicula'];
                $Titulo = $row['Titulo'];
                $Descripcion = $row['Descripcion'];
                $Imagen = base64_encode($row['Portada']);
                ?>
                <div class="carousel-item">
                    <div style="background: linear-gradient(rgba(0, 0, 0, .50) 0%, rgba(0, 0, 0, .50) 100%), url('data:jpeg;base64,<?php echo $Imagen;?>');background-size: cover; background-repeat: no-repeat;" class="d-block w-100 carusel pelicula-principal">
                      <div class="contenedor container-fluid">
                        <div class="row row-titulo">
                          <div class="col-12">
                            <h3 class="titulo"><?php echo $Titulo ?></h3>
                          </div>
                        </div>
                        <div class="row row-descripcion">
                          <div class="col-12">
                            <label class="descripcion h4">
                            <?php echo $Descripcion ?>
                            </label>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-12 row-botones">
                            <a href="Seleccion.php?fi14=<?php echo base64_encode($IDPelicula);?>" role="button" class="boton p-2"><i class="fas fa-play play-white"></i>  Reproducir</a>  
                            
                          </div>
                        </div>
                      
                      </div>
                    </div>
                  </div>
                <?php
              }
              }
            }
            else{
              ?>
              <script> 
                $('#carouselGrande').hide();
                alert("NO HAY PELICULAS GUARDADAS");
              </script>
              <?php
            }
            
            ?>
            
            
        </div>

        <!-- BOTONES PARA DELIZAR -->
        <a class="carousel-control-prev controles-carusel" href="#carouselGrande" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next controles-carusel" href="#carouselGrande" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>

      <!-- MENU SOLO PARA USUARIOS -->
        <?php
        //VERIFICAR SI ES UNA CUENTA CON PACK
       
        if ($tipo_user == "Cliente") {
          $sql  = "SELECT * FROM PeliculasCompradas WHERE Cedula=$Cedula";
          $res=mysqli_query($conn,$sql);
          if ( $res && mysqli_affected_rows($conn) > 0 ) {
            ?>
            <!-- COMPRADAS -->
              <div class="cont-peliculas" id="cont-peliculas-Compradas">
                <div class="col-12">
                  <label class="titulo-menu-peliculas ml-2"> mis peliculas  </label>
                </div>
                <div class="row text-center pt-3">
                  <?php
                    $sql = "SELECT * FROM PeliculasCompradas WHERE Cedula=$Cedula ORDER BY RAND() LIMIT 4";
                    $result = mysqli_query($conn, $sql);
                    if ($result && mysqli_affected_rows($conn) > 0) {
                      while ($row = mysqli_fetch_assoc($result)) {
                          $ID_PELICULASCOMPRADAS = $row['IDPelicula'];
                        $sql2="SELECT  * FROM Peliculas WHERE IDPelicula = $ID_PELICULASCOMPRADAS";
                        $res= mysqli_query($conn,$sql2);
                        if ($res) {
                          while ($row = mysqli_fetch_assoc($res)) {
                            $ID     = $row['IDPelicula'];
                            $Titulo = $row['Titulo'];
                            $Imagen = base64_encode($row['Imagen']);
            
                            //FECHAS PARA AGREGAR ICONO EL LAS PELICULAS
                            $fecha_actual = date('Y-m-d');
                            $fechaMenosunaSemana = date("Y-m-d",strtotime($fecha_actual."- 7 days")); 
            
                            $Fecha_Estreno = $row['Fecha_Estreno'];
                            $FechaGuardada = $row['FechaGuardada'];
                            $fechaEstrenoComoEntero = strtotime($Fecha_Estreno);
                            $mes = date("m", $fechaEstrenoComoEntero);
                            $año = date("Y", $fechaEstrenoComoEntero);
            
                        
                            ?>
                            <div class="pelicula col-6 col-sm-6 col-md-4 col-lg-3 col-xl-3">
                              <div class="div">
                                <a href="Seleccion.php?fi14=<?php echo base64_encode($ID);?>">
                                  <div class="img_film" style="background-image:url('data:jpeg;base64,<?php echo $Imagen;?>');border-radius:20px;box-shadow:0 1px 5px white ;">
                                    <?php
                                      //ICONO DE ESTRENO
                                      if ( $mes == date('m') && $año == date('Y')) {
                                        ?>
                                        <img src="img/Estreno.png" height="100px">
                                        <?php
                                      }
                                      //ICONO DE NUEVA
                                      else if($FechaGuardada > $fechaMenosunaSemana ){
                                        ?>
                                        <img src="img/nueva.png" height="100px">
                                        <?php
                                      }
                                    ?>
                                  </div>
                                </a>
                              </div>
                              <label for=""> <?php echo $Titulo;?> </label>
                            </div>
                            <?php
                          }
                        
                        }
                        
                      }
                    }
                    else{
                      //OCULTAR EL CONTENIDO DE VISTAS
                    ?>
                      <script>
                        $('#cont-peliculas-Compradas').hide();
                      </script>
                    <?php
                    }
                  ?>
                </div>
                <!--BTN VER MAS -->
                <div class="col-12 text-right">
                  <a href="PeliculasBuscadas.php?¡=<?php echo  base64_encode("Compradas") ?>" class="ver-mas-menu-peliculas"> Ver mas <i class="fa-solid fa-angles-right"></i> </a>
                </div>  
              </div>
          <?php
           
          }
          ?>
          <!-- FAVORITAS -->
            <div class="cont-peliculas" id="cont-peliculas-Favoritas">
              <div class="col-12">
                <label class="titulo-menu-peliculas ml-2"> FAVORITAS  </label>
              </div>
              <div>
                  <div class="row text-center pt-3">
                  <?php
                    $sql = "SELECT * FROM Favoritos WHERE Cedula=$Cedula  ORDER BY RAND() LIMIT 4";
                    $result = mysqli_query($conn, $sql);
                    if ($result && mysqli_affected_rows($conn) > 0) {
                      while ($row = mysqli_fetch_assoc($result)) {
                        $ID_PELICULASCOMPRADAS = $row['IDPelicula'];
                        $sql2="SELECT  * FROM Peliculas WHERE IDPelicula = $ID_PELICULASCOMPRADAS";
                        $res= mysqli_query($conn,$sql2);
                        if ($res) {
                          while ($row = mysqli_fetch_assoc($res)) {
                            $ID     = $row['IDPelicula'];
                            $Titulo = $row['Titulo'];
                            $Imagen = base64_encode($row['Imagen']);
            
                            //FECCHAS PARA AGREGAR ICONO EL LAS PELICULAS
                            $fecha_actual = date('Y-m-d');
                            $fechaMenosunaSemana = date("Y-m-d",strtotime($fecha_actual."- 7 days")); 
            
                            $Fecha_Estreno = $row['Fecha_Estreno'];
                            $FechaGuardada = $row['FechaGuardada'];
                            $fechaEstrenoComoEntero = strtotime($Fecha_Estreno);
                            $mes = date("m", $fechaEstrenoComoEntero);
                            $año = date("Y", $fechaEstrenoComoEntero);
            
                        
                            ?>
                            <div class="pelicula col-6 col-sm-6 col-md-4 col-lg-3 col-xl-3">
                              <div class="div">
                                <a href="Seleccion.php?fi14=<?php echo base64_encode($ID);?>">
                                  <div class="img_film" style="background-image:url('data:jpeg;base64,<?php echo $Imagen;?>');border-radius:20px;box-shadow:0 1px 5px white ;">
                                    <?php
                                      //ICONO DE ESTRENO
                                      if ( $mes == date('m') && $año == date('Y')) {
                                        ?>
                                        <img src="img/Estreno.png" height="100px">
                                        <?php
                                      }
                                      //ICONO DE NUEVA
                                      else if($FechaGuardada > $fechaMenosunaSemana ){
                                        ?>
                                        <img src="img/nueva.png" height="100px">
                                        <?php
                                      }
                                    ?>
                                  </div>
                                </a>
                              </div>
                              <label for=""> <?php echo $Titulo;?> </label>
                            </div>
                            <?php
                      }
                        
                        }
                        
                      }
                    }
                    else{
                      //OCULTAR EL CONTENIDO DE VISTAS
                    ?>
                      <script>
                        $('#cont-peliculas-Favoritas').hide();
                      </script>
                    <?php
                    }
                  ?>
                </div>
              </div>
              <!--BTN VER MAS -->
              <div class="col-12 text-right">
                <a href="PeliculasBuscadas.php?¡=<?php echo  base64_encode("Favoritas") ?>" class="ver-mas-menu-peliculas"> Ver mas <i class="fa-solid fa-angles-right"></i> </a>
              </div>   
            </div>
          <!-- VISTAS -->
            <div class="cont-peliculas" id="cont-peliculas-Vistas">
              <!-- TITULO -->
              <div class="col-12">
                <label class="titulo-menu-peliculas ml-2"> Vistas  </label>
              </div>
              <!-- PELICULAS  -->
              <div class="row text-center pt-3">
                <?php
                  $sql = "SELECT * FROM PeliculasVistas WHERE Cedula=$Cedula  ORDER BY RAND() LIMIT 4";
                  $result = mysqli_query($conn, $sql);
                  if ($result && mysqli_affected_rows($conn) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                      $ID_PELICULASCOMPRADAS = $row['IDPelicula'];
                      $sql2="SELECT  * FROM Peliculas WHERE IDPelicula = $ID_PELICULASCOMPRADAS";
                      $res= mysqli_query($conn,$sql2);
                      if ($res) {
                        while ($row = mysqli_fetch_assoc($res)) {
                          $ID     = $row['IDPelicula'];
                          $Titulo = $row['Titulo'];
                          $Imagen = base64_encode($row['Imagen']);
          
                          //FECCHAS PARA AGREGAR ICONO EL LAS PELICULAS
                          $fecha_actual = date('Y-m-d');
                          $fechaMenosunaSemana = date("Y-m-d",strtotime($fecha_actual."- 7 days")); 
          
                          $Fecha_Estreno = $row['Fecha_Estreno'];
                          $FechaGuardada = $row['FechaGuardada'];
                          $fechaEstrenoComoEntero = strtotime($Fecha_Estreno);
                          $mes = date("m", $fechaEstrenoComoEntero);
                          $año = date("Y", $fechaEstrenoComoEntero);
          
                      
                          ?>
                          <div class="pelicula col-6 col-sm-6 col-md-4 col-lg-3 col-xl-3">
                            <div class="div">
                              <a href="Seleccion.php?fi14=<?php echo base64_encode($ID);?>">
                                <div class="img_film" style="background-image:url('data:jpeg;base64,<?php echo $Imagen;?>');border-radius:20px;box-shadow:0 1px 5px white ;">
                                  <?php
                                    //ICONO DE ESTRENO
                                    if ( $mes == date('m') && $año == date('Y')) {
                                      ?>
                                      <img src="img/Estreno.png" height="100px">
                                      <?php
                                    }
                                    //ICONO DE NUEVA
                                    else if($FechaGuardada > $fechaMenosunaSemana ){
                                      ?>
                                      <img src="img/nueva.png" height="100px">
                                      <?php
                                    }
                                  ?>
                                </div>
                              </a>
                            </div>
                            <label for=""> <?php echo $Titulo;?> </label>
                          </div>
                          <?php
                    }
                      
                      }
                      
                    }
                  }
                  else{
                    //OCULTAR EL CONTENIDO DE VISTAS
                  ?>
                    <script>
                      $('#cont-peliculas-Vistas').hide();
                    </script>
                  <?php
                  }
                ?>
              </div>
              <!--BTN VER MAS -->
              <div class="col-12 text-right">
                <a href="PeliculasBuscadas.php?¡=<?php echo  base64_encode("Vistas") ?>" class="ver-mas-menu-peliculas"> Ver mas <i class="fa-solid fa-angles-right"></i> </a>
              </div>   
            </div>
                    
          <?php
        }
        ?>
       
        
      <!-- MENU DE PELICULAS ALEATORIAS -->
        <div class="cont-peliculas" id="cont-peliculas-Aleatorias">
          <!-- TITULO -->
          <div class="col-12">
            <label class="titulo-menu-peliculas ml-2"> Películas en tendencia </label>
          </div>
          <div class="cont-peliculas">
              <div class="row text-center pt-3">
              <?php
                $sql = "SELECT * FROM Peliculas ORDER BY RAND() LIMIT 4";
                $result = mysqli_query($conn, $sql);
                if ($result && mysqli_affected_rows($conn)) {
                  while ($row = mysqli_fetch_assoc($result)) {
                    $ID     = $row['IDPelicula'];
                    $Titulo = $row['Titulo'];
                    $Imagen = base64_encode($row['Imagen']);
    
                    //FECCHAS PARA AGREGAR ICONO EL LAS PELICULAS
                    $fecha_actual = date('Y-m-d');
                    $fechaMenosunaSemana = date("Y-m-d",strtotime($fecha_actual."- 7 days")); 
    
                    $Fecha_Estreno = $row['Fecha_Estreno'];
                    $FechaGuardada = $row['FechaGuardada'];
                    $fechaEstrenoComoEntero = strtotime($Fecha_Estreno);
                    $mes = date("m", $fechaEstrenoComoEntero);
                    $año = date("Y", $fechaEstrenoComoEntero);
    
                 
                    ?>
                    <div class="pelicula col-6 col-sm-6 col-md-4 col-lg-3 col-xl-3">
                      <div class="div">
                        <a href="Seleccion.php?fi14=<?php echo base64_encode($ID);?>">
                          <div class="img_film" style="background-image:url('data:jpeg;base64,<?php echo $Imagen;?>');border-radius:20px;box-shadow:0 1px 5px white ;">
                            <?php
                              //ICONO DE ESTRENO
                              if ( $mes == date('m') && $año == date('Y')) {
                                ?>
                                <img src="img/Estreno.png" height="100px">
                                <?php
                              }
                              //ICONO DE NUEVA
                              else if($FechaGuardada > $fechaMenosunaSemana ){
                                ?>
                                <img src="img/nueva.png" height="100px">
                                <?php
                              }
                            ?>
                          </div>
                        </a>
                      </div>
                      <label for=""> <?php echo $Titulo;?> </label>
                    </div>
                    <?php
                  }
                }
                else{
                   //OCULTAR EL CONTENIDO DE VISTAS
                   ?>
                   <script>
                     $('#cont-peliculas-Aleatorias').hide();
                   </script>
                 <?php
                }
            ?>
            </div>
          </div>
          <!--VER MAS -->
          <div class="col-12 text-right">
            <a href="PeliculasBuscadas.php?¡=<?php echo  base64_encode("Aleatorias") ?>" class="ver-mas-menu-peliculas"> Ver mas <i class="fa-solid fa-angles-right"></i> </a>
          </div>
      </div>
        
      <!-- MENU DE PELICULAS ESTRENADAS  -->
        <div class="cont-peliculas" id="cont-peliculas-Estrenadas">
          <!-- TITULO -->
          <div class="col-12">
            <label class="titulo-menu-peliculas ml-2"> Estrenos </label>
          </div>
          <div class="cont-peliculas">
              <div class="row text-center pt-3">
              <?php
                $Año = date('Y');
                $mes = date('m');
                $sql = "SELECT * FROM Peliculas WHERE YEAR(Fecha_Estreno) = $Año AND MONTH(Fecha_Estreno) = $mes ORDER BY RAND() LIMIT 4";
                $result = mysqli_query($conn, $sql);
                if ($result && mysqli_affected_rows($conn) > 0) {
                  while ($row = mysqli_fetch_assoc($result)) {
                    $ID     = $row['IDPelicula'];
                    $Titulo = $row['Titulo'];
                    $Imagen = base64_encode($row['Imagen']);
                    ?>
                    <div class="pelicula col-6 col-sm-6 col-md-4 col-lg-3 col-xl-3">
                      <div class="div">
                        <a href="Seleccion.php?fi14=<?php echo base64_encode($ID);?>">
                          <div class="img_film" style="background-image:url('data:jpeg;base64,<?php echo $Imagen;?>');border-radius:20px;box-shadow:0 1px 5px white ;">
                            <img src="img/Estreno.png" height="100px">
                          
                          </div>
                        </a>
                      </div>
                      <label for=""> <?php echo $Titulo;?> </label>
                    </div>
                    <?php
                  }
                }
                else{
                  //OCULTAR EL CONTENIDO DE VISTAS
                  ?>
                  <script>
                    $('#cont-peliculas-Estrenadas').hide();
                  </script>
                <?php
                }
            ?>
            </div>
          </div>
          <!--VER MAS -->
          <div class="col-12 text-right">
            <a href="PeliculasBuscadas.php?¡=<?php echo  base64_encode("Estrenos") ?>" class="ver-mas-menu-peliculas"> Ver mas <i class="fa-solid fa-angles-right"></i> </a>
          </div>
        </div>
      <!-- MENU DE PELICULAS NUEVAS  -->
        <div class="cont-peliculas" id="cont-peliculas-Nuevas">
          <!-- TITULO -->
          <div class="col-12">
            <label class="titulo-menu-peliculas ml-2"> Nuevas </label>
          </div>
          <div class="cont-peliculas">
              <div class="row text-center pt-3">
              <?php
                $fecha_actual = date('Y-m-d');
                $fechaMenosunaSemana = date("Y-m-d",strtotime($fecha_actual."- 7 days")); 
                $Año = date('Y');
                $mes = date('m');

                //OBTENER TODAS LAS AGREGADA APARTIR DE UNA SEMANA ATRAS(EXCEPTO LAS ESTRENADAS).
                $sql = "SELECT * FROM Peliculas WHERE FechaGuardada >= '$fechaMenosunaSemana' AND  YEAR(Fecha_Estreno) != $Año AND MONTH(Fecha_Estreno) != $mes OR  FechaGuardada >= '$fechaMenosunaSemana' AND  YEAR(Fecha_Estreno) = $Año AND MONTH(Fecha_Estreno) != $mes ORDER BY RAND() LIMIT 4";
                $result = mysqli_query($conn, $sql);
                if ($result && mysqli_affected_rows($conn) > 0) {
                  while ($row = mysqli_fetch_assoc($result)) {
                    $ID     = $row['IDPelicula'];
                    $Titulo = $row['Titulo'];
                    $Imagen = base64_encode($row['Imagen']);
                    ?>
                    <div class="pelicula col-6 col-sm-6 col-md-4 col-lg-3 col-xl-3">
                      <div class="div">
                        <a href="Seleccion.php?fi14=<?php echo base64_encode($ID);?>">
                          <div class="img_film" style="background-image:url('data:jpeg;base64,<?php echo $Imagen;?>');border-radius:20px;box-shadow:0 1px 5px white ;">
                            <img src="img/nueva.png" height="100px">
                          
                          </div>
                        </a>
                      </div>
                      <label for=""> <?php echo $Titulo;?> </label>
                    </div>
                    <?php
                  }
                }
                else{
                  //OCULTAR EL CONTENIDO DE VISTAS
                  ?>
                  <script>
                    $('#cont-peliculas-Nuevas').hide();
                  </script>
                <?php
                }
            ?>
            </div>
          </div>
          <!--VER MAS -->
          <div class="col-12 text-right">
            <a href="PeliculasBuscadas.php?¡=<?php echo  base64_encode("Novedades") ?>" class="ver-mas-menu-peliculas"> Ver mas <i class="fa-solid fa-angles-right"></i> </a>
          </div>
        </div>
    </div>

  </main>
  <?php
    require "footer.php";
  ?>
  </body>
</html>
<?php

?>