<?php
//------------------------------\\
require "header.php";
require "ModuloConexion.php";
//------------------------------\\
date_default_timezone_set("America/Montevideo");
//------------------------------\\
//BUSCAR PELICULAS CON BARRA DE NAVEGACION
if (isset($_GET['¡'])) {
  //NOVEDADES
  if ($_GET['¡'] ==  base64_encode("Novedades")) {
    ?>
    <main class="mt-5">
      <div class="container-fluid mt-5">
        <!-- MENU DE PELICULAS NUEVAS  -->
        <!-- TITULO -->
        <div class="col-12 text-center">
          <label class="titulo-menu-peliculas ml-2"> PELICULAS NUEVAS </label>
        </div>
        <div class="cont-peliculas-aleatorias">
            <div class="row text-center pt-3">
            <?php
              $fecha_actual = date('Y-m-d');
              $fechaMenosunaSemana = date("Y-m-d",strtotime($fecha_actual."- 7 days")); 
              $Año = date('Y');
              $mes = date('m');

              //OBTENER TODAS LAS AGREGADA APARTIR DE UNA SEMANA ATRAS(EXCEPTO LAS ESTRENADAS).
              $sql = "SELECT * FROM Peliculas WHERE FechaGuardada >= '$fechaMenosunaSemana' AND  YEAR(Fecha_Estreno) != $Año AND MONTH(Fecha_Estreno) != $mes OR  FechaGuardada >= '$fechaMenosunaSemana' AND  YEAR(Fecha_Estreno) = $Año AND MONTH(Fecha_Estreno) != $mes ORDER BY RAND()";
              $result = mysqli_query($conn, $sql);
              if ($result) {
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
          ?>
          </div>
        </div>
      </div>
    </main>
    <?php
  }
  //Estrenos
  if ($_GET['¡'] ==  base64_encode("Estrenos")) {
    ?>
    <main class="mt-5">
      <div class="container-fluid mt-5">
        <div class="col-12 text-center">
          <label class="titulo-menu-peliculas ml-2"> Estrenos 2022 </label>
        </div>
        <div class="cont-peliculas-aleatorias">
            <div class="row text-center pt-3">
            <?php
              $Año = date('Y');
              $mes = date('m');
              $sql = "SELECT * FROM Peliculas WHERE YEAR(Fecha_Estreno) = $Año AND MONTH(Fecha_Estreno) = $mes ORDER BY RAND()";
              $result = mysqli_query($conn, $sql);
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
          ?>
          </div>
        </div>
      </div>
    </main>
    <?php
  }
  //Aleatorias
  if ($_GET['¡'] ==  base64_encode("Aleatorias")) {
    ?>
    <main class="mt-5">
      <div class="container-fluid mt-5">
        <div class="col-12 text-center mb-3">
          <label class="titulo-menu-peliculas ml-2"> Películas en tendencia </label>
        </div>
        <div class="cont-peliculas-aleatorias">
            <div class="row text-center pt-3" style="margin-bottom: 400px;">
              <?php
                $sql = "SELECT * FROM Peliculas  ORDER BY RAND()";
                $result = mysqli_query($conn, $sql);
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
              ?>
          </div>
        </div>
      </div>
    </main>
    <?php
  }
  //Vistas
  if ($_GET['¡'] ==  base64_encode("Vistas")) {
    ?>
    <main class="mt-5">
      <div class="container-fluid mt-5">
      <!-- VISTAS -->
        <div class="cont-peliculas-Vistas">
            <div class="col-12">
              <label class="titulo-menu-peliculas ml-2"> Vistas  </label>
            </div>
            <div>
                <div class="row text-center pt-3">
                <?php
                  $sql = "SELECT * FROM PeliculasVistas WHERE Cedula=$Cedula";
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
                      $('.cont-peliculas-Vistas').hide();
                    </script>
                  <?php
                  }
                ?>
              </div>
            </div>
          </div>
            
                
      
        </div>
    </main>
    <?php
  }
  //Genero
  if ($_GET['¡'] ==  base64_encode("Genero")) {
    $Genero = $_GET['id'];
      ?>
      <main class="mt-5">
        <div class="container-fluid mt-5">
          <div class="col-12 text-center mb-3">
            <label class="titulo-menu-peliculas ml-2"> Peliculas del genero:  <?php echo $Genero ?>  </label>
          </div>
          <div class="cont-peliculas-aleatorias">
              <div class="row text-center pt-3" style="margin-bottom: 400px;">
                <?php
                
                  $sql = "SELECT * FROM Peliculas WHERE Genero = '$Genero' ORDER BY RAND()";
                  $result = mysqli_query($conn, $sql);
                  if ($result && mysqli_affected_rows($conn) > 0) {
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
                    ?>
                    <script>window.location.href='index.php'</script>
                    <?php
                  }
                  
                ?>
            </div>
          </div>
        </div>
      </main>
      <?php
  } 
  //Compradas
  if ($_GET['¡'] ==  base64_encode("Compradas")) {
    ?>
      <main class="mt-5">
        <div class="container-fluid mt-5">
          <div class="col-12 text-center mb-3">
            <label class="titulo-menu-peliculas ml-2"> Mis Peliculas:  </label>
          </div>
          <div class="cont-peliculas" id="cont-peliculas-Compradas">
                <div class="row text-center pt-3">
                  <?php
                    $sql = "SELECT * FROM PeliculasCompradas WHERE Cedula=$Cedula ORDER BY RAND()";
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
                  ?>
                </div>
              </div>
        </div>
      </main>
      <?php
   
  }
  if ($_GET['¡'] ==  base64_encode("Favoritas")) {
    ?>
      <main class="mt-5">
        <div class="container-fluid mt-5">
          <div class="col-12 text-center mb-3">
            <label class="titulo-menu-peliculas ml-2"> Favoritas:  </label>
          </div>
          <div>
          <div class="row text-center pt-3">
          <?php
            $sql = "SELECT * FROM Favoritos WHERE Cedula=$Cedula  ORDER BY RAND()";
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
      </main>
      <?php
   
  }
}
else if(isset($_GET['b'])) {
  $TituloBuscado = $_GET['b'];
  if ($TituloBuscado != null) {
  ?>
    <script>
      //PONER VALOR BUSCADO AL INPUT BUSCAR
      $('#NAV_BUSCAR').val('<?php echo $TituloBuscado ?>');
    </script>
    <main class="mt-5">
      <div class="container-fluid mt-5">
        <div class="col-12 text-center mb-3">
          <label class="titulo-menu-peliculas ml-2"> Buscar por :  <?php echo $TituloBuscado ?>  </label>
        </div>
        <div class="cont-peliculas-aleatorias">
            <div class="row text-center pt-3" style="margin-bottom: 400px;">
              <?php
              
                $sql = "SELECT * FROM Peliculas WHERE Titulo LIKE '%".$TituloBuscado."%' ORDER BY RAND()";
                $result = mysqli_query($conn, $sql);
                if ($result && mysqli_affected_rows($conn) > 0) {
                  
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
                else {
                  ?>
                    <div class="col-12 text-center mt-5">
                      <label class="titulo-menu-peliculas ml-2 text-danger"> <i class="fa-regular fa-face-frown"></i> ¡Ups..! , SIN RESULTADOS <i class="fa-regular fa-face-frown"></i> </label>
                    </div>
                    <div class="col-12"><hr class="bg-primary"></div>
                    <div class="col-4 text-right titulo-menu-peliculas">Buscar de Nuevo</div>
                    <div class="col-4">
                    <form method="GET" action="PeliculasBuscadas.php" class="form-inline my-2 my-lg-0 ml-5">
                      <div class="form-outline">
                        <input type="search" id="form1" name="b" class="form-control" placeholder="Buscar" aria-label="Search">
                        <button type="submit" class="p-0 m-0 btn text-white"><i class="fa-solid fa-magnifying-glass"></i></button>
                      </div>
                    </form>
                    </div>
                      <div class="col-12 text-"><hr class="bg-primary"></div>
                  <?php 
                }
                ?>
          </div>
        </div>
      </div>
    </main>
  <?php
  }
  else{
    ?> <script> location.href="index.php"; </script> <?php
  }
  
}
else {
  ?> <script> location.href="index.php"; </script> <?php
}

//------------------------------\\
require "footer.php";
//------------------------------\\
?>