<?php
//------------------------------\\
$Regresar_Pelicula="Seleccion.php?fi14=".$_GET['fi14']."";
include ('Datos/Datos_Login.php');
require "header.php";



//------------------------------\\
// Traer Datos de la pelicula Seleccionada
$IDPelicula = base64_decode($_GET['fi14']);
$sql="SELECT * FROM Peliculas WHERE IDPelicula = $IDPelicula";
$result=mysqli_query($conn,$sql);
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $Titulo = $row['Titulo'];
        $Productora = $row['Productora'];
        $Actores = $row['Actores'];
        $Descripcion = $row['Descripcion'];
        $Fecha_Estreno = $row['Fecha_Estreno'];
        $Genero = $row['Genero'];
        $URL_Trailer = $row['URL_Trailer'];
        $URL_Film = $row['URL_Film'];
        $Imagen = base64_encode($row['Imagen']);
        $Portada = base64_encode($row['Portada']);

        ?>
        <main class="" style="background-image: linear-gradient(rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0.75)),url('data:jpeg;base64,<?php echo $Portada ?>'); background-size: 100% ;background-repeat: no-repeat;background-attachment: fixed;">
            <div class="container-fluid contenedor mt-5 mb-5" >
                <div class="caja1 p-2 mt-5">
                    <div class="container-fluid text-center">
                        
                        
                        <!-- SINOPSIS -->
                        <div class="col-12 text-left">
                            <label style=" font:  40px/1 Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;text-transform: uppercase;"> <?php echo $Titulo ?>   </label>
                            <p> <?php echo $Descripcion ?> </p>
                        </div>
                        <!-- Trailer -->
                        <div class="trailer" id="trailer">
                            <div class="col-12 text-center">
                                <label style=" font:  40px/1 Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;text-transform: uppercase;"> Trailer  </label>
                            </div>
                            <!-- Trailer -->
                            <div class="row mt-4 Pelicula">
                                <!-- Trailer Pelicula -->
                                <div class="col-12" id="t_film" style="">
                                    <iframe width="100%" height="100%" src="<?php echo $URL_Trailer ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                
                                </div>
                                
                            </div>
                        </div>
                        <hr>
                            <!-- Titulo -->
                            <div class="row mt-5 titulo" style="font: 20px/1 Impact;text-transform: uppercase;">
                            <div class="col-12">
                                <label class="h4 t_greenyellow">✅ Estas apunto de ver <?php echo $Titulo ?> ✅</label>
                            </div>
                        </div>
                        <!-- Idioma de la Pelicula -->
                        <div class="row mt-3 mb-5 idioma">
                            <div class="col-3"></div>
                            <div class="col-6 p-3 background_black_box">
                                <a href="#" class="btn btn-info"> Latinos </a>
                                <a href="#" class="btn btn-info"> Castellano </a>
                                <a href="#" class="btn btn-info"> Subtitulado </a>
                            </div>
                        </div>
                        <!-- Pelicula -->
                        <div class="mt-5" id="Pelicula">
                            
                            <div class="row mt-4 Pelicula" style="background-image: linear-gradient(rgba(0, 0, 0, 0.9), rgba(0, 0, 0, 0.9))">
                                <!-- TITULO -->
                                <div class="col-12 mt-3" id="tituloPelicula">
                                    <label class="h4">
                                        Mira <?php echo $Titulo ?> en HD solo en PelixFlix!
                                    </label>
                                </div>
                                
                                <?php
                                if ($tipo_user != null) {
                                    if ($tipo_user == "Cliente") {
                                        $sqlP = "SELECT * FROM PeliculasCompradas WHERE Cedula = $Cedula";
                                        $resP = mysqli_query($conn,$sqlP);
                                        if ($resP && mysqli_affected_rows($conn) > 0) {
                                            $sql="SELECT * FROM PeliculasCompradas WHERE Cedula = $Cedula AND IDPelicula = $IDPelicula";
                                            $res=mysqli_query($conn,$sql);
                                            if ($res && mysqli_affected_rows($conn) == 0) {
                                                ?>
                                                <script>
                                                    $('.pelicula').hide();
                                                    $('.idioma').html('<div class="col-12"><button id="ComprarPelicula" class="btn btn-success">Comprar <?php echo $Titulo ?> Ahora!  </button ></div>');
                                                    $('.titulo').hide();
                                                    $('#Pelicula').hide();
                                                </script>
                                                <?php
                                            }
                                        }
                                        ?>
                                      
                                        <!-- ICONO DE PLAY Pelicula Completa -->
                                            <div class="col-12 text-center" id="fa-playUsuario">
                                                <i onclick="Usuarioplayfilmcompleto()" class="fa-solid fa-play play-red"></i>
                                            </div>
                                        <?php
                                    }
                                    else if ($tipo_user == "Administrador") {
                                        ?>
                                        <!-- ICONO DE PLAY Pelicula Completa -->
                                            <div class="col-12 text-center" id="fa-playAdministrador">
                                                <i onclick="Administradorplayfilmcompleto()" class="fa-solid fa-play play-red"></i>
                                            </div>
                                            <script>
                                                function Administradorplayfilmcompleto(){
                                                    $("#fa-playAdministrador").hide();
                                                    $("#tituloPelicula").hide();
                                                    $("#film_com").show(); 
                                                }

                                            </script>
                                        <?php
                                    }
                                    
                                }
                                else{
                                    ?>
                                    <!-- ICONO DE PLAY Trailer -->
                                    <div class="col-12 text-center" id="fa-play_SinCuenta">
                                        <i onclick="playfilmtrailerSinCuenta()" class="fa-solid fa-play  play-red"></i>
                                    </div>
                                    <script>
                                        //ALERTA DE LOGIN O REGISTER, Y INICIAR TRAILER
                                    function playfilmtrailerSinCuenta(){
                                        Swal.fire({
                                            title:'Inicia Sesion Para mirar la Pelicula.',
                                            html:'<label> Nota:Puedes mirar el trailer!</label><br> <a href="Login/"> Iniciar Session </a> <label> o </label> <a href="Registrar/"> Regitrarse </a><br>',
                                            icon:'info',
                                            confirmButtonText:'Mas Tarde'
                                        })
                                        $("#fa-play_SinCuenta").hide();
                                        $("#tituloPelicula").hide();
                                        $("#t_film_Pelicula").show();
                                    }
                                    </script>
                                <?php

                                }
                                ?>
                                <!-- Pelicula Completa -->
                                <div class="col-12" id="film_com" style="display:none;">
                                    <iframe width="100%" height="100%" src="<?php echo $URL_Film ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                </div>
                                    <!-- Trailer Pelicula -->
                                    <div class="col-12" id="t_film_Pelicula" style="display:none;">
                                    <iframe width="100%" height="100%" src="<?php echo $URL_Trailer ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                
                                </div>
                            </div>
                        </div>
                         <!-- BOTON FLOTANTE PARA FAVORITOS -->
                    <button class="btn boton-plan mt-2"  id="AgregarFavorito" style="display:none;"> Agregar Favorito </button>
                        
                        
                    </div>
                </div>
                <div class="caja2 p-3 mt-5">
                   
                    <div class="container-fluid background_black_box text-center">
                        <!-- Imagen -->
                        <div class="row">
                            <div class="col-12 mt-3">
                                <img class="img"  width="200" height="300" src="data:jpeg;base64,<?php echo $Imagen ?>" style="border-radius:25px;">
                            </div>
                        </div>
                        <!-- Genero -->
                        <div class="row mt-3">
                            <div class="col-1"></div>
                            <div class="col-5">
                                <label for="">Genero:</label>
                            </div>
                            <div class="col-5 Genero">
                                <a href="PeliculasBuscadas.php?id=<?php echo $Genero; ?>&¡=<?php echo  base64_encode("Genero"); ?>" class="text-warning"> <?php echo $Genero ?> </a>
                            </div>
                        </div>
                        <!-- Fecha de Estreno -->
                        <div class="row mt-3">
                            <div class="col-1"></div>
                            <div class="col-5">
                                <label for="">Fecha:</label>
                            </div>
                            <div class="col-5">
                                <label for=""> <?php echo $Fecha_Estreno ?> </label>
                            </div>
                        </div>
                        <!-- Idioma -->
                        <div class="row mt-3">
                            <div class="col-1"></div>
                            <div class="col-5">
                                <label for="">Idioma:</label>
                            </div>
                            <div class="col-5">
                                <label for=""> Español </label>
                            </div>
                        </div>
                        <!-- Productra -->
                        <div class="row mt-3">
                            <div class="col-1"></div>
                            <div class="col-5">
                                <label for="">Productora:</label>
                            </div>
                            <div class="col-5">
                                <label for=""> <?php echo $Productora ?> </label>
                            </div>
                        </div>
                            <!-- Actores -->
                        <div class="row mt-3">
                            <div class="col-1"></div>
                            <div class="col-5">
                                <label for="">Actores:</label>
                            </div>
                            <div class="col-5">
                                <label for=""> <?php echo $Actores; ?> </label>
                            </div>
                        </div>
                        <!-- Calidad -->
                        <div class="row mt-3">
                            <div class="col-1"></div>
                            <div class="col-5">
                                <label for="">Calidad:</label>
                            </div>
                            <div class="col-5">
                                <label for=""> HD </label>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
                

        </main>
        <?php

    }
}   

//------------------------------\\
//VERIFICAR SI LA CUENTA ESTA DESACTIVADA
if ($tipo_user == "Cliente") {
    $sql="SELECT * FROM Cuentas WHERE Cedula = $Cedula";
    $res = mysqli_query($conn,$sql);
    if ($res) {
        while ($row = mysqli_fetch_assoc($res)) {
            $EstadoCuenta = $row['Estado'];
        }
        if ($EstadoCuenta == 0) {
            ?>
            <script>
                 $('#AgregarFavorito').hide();
                $('#Pelicula').hide();
                $('.titulo').html('<div class="col-12 bg-warning text-danger"><h1>¡Cuenta desactivada!</h1><h5>Por favor renueva el plan/pack para seguir mirando </h5></div>');
                $('.idioma').hide();
            </script>
            <?php
        }
    }
}

//OCULTAR DIV PARA NO LOGUEADO
if ($tipo_user == null) {
    ?>
    <script>
        $('#AgregarFavorito').hide();
        $('#trailer').hide();
    </script>
    <?php
}
  

if ($tipo_user == "Cliente") {
    echo " <script>  $('#AgregarFavorito').show(); </script>";
    //PARA EL BOTON DE FAVORITOS
    $sqlBF="SELECT * FROM Favoritos WHERE Cedula = '$Cedula' && IDPelicula = '$IDPelicula'";
    $resBF=mysqli_query($conn,$sqlBF);
    if ($resBF && mysqli_affected_rows($conn) == 1) {
        ?>
        <script> $('#AgregarFavorito').html('Quitar Favorito'); </script>
        <?php
    }
}

?>
<!-- SCRIPT PARA INICIAR LA PELICULA -->
<script>

function playfilmtrailer(){
    $("#fa-play").hide();
    $("#titulo").hide();
    $("#t_film").show();
}
//INICIAR PELICULA COMPLETA(CUNADO ESTA LOGUEADO)
function Usuarioplayfilmcompleto(){
    $("#fa-playUsuario").hide();
    $("#tituloPelicula").hide();
    $("#film_com").show();

    //GUARDAR PELCULA COMO VISTA
    $.ajax({
        url:'Ajax.php',
        type:'POST',
        data:{'GuardarComoVista':'1', 'idPelicula':'<?php echo $IDPelicula ?>', 'Cedula':'<?php echo $Cedula ?>'}
    }).done(function(res){
        console.log(res);
        
    })
}

//AGREGAR FAVORITO 
$('#AgregarFavorito').on('click',function(){
    $.ajax({
    url:'Ajax.php',
    type:'POST',
    data:{'AgregarFavorito':1,'Cedula':'<?php echo $Cedula; ?>','IDPelicula':'<?php echo $IDPelicula ?>'},
}).done(function(res){
    console.log(res);
    if (res == 1) {
        $('#AgregarFavorito').html('Quitar Favorito');
        Swal.fire({
            icon:'success',
            html:'Agregado como favorito!',
            toast:true,
            timer:1500,
            position:'top-end',
            showConfirmButton:false,
            timerProgressBar:true
        })
    }
    else if (res == 2) {
        $('#AgregarFavorito').html('Agregar Favorito');
        Swal.fire({
            icon:'info',
            html:'Quitado de la lista de favoritos',
            toast:true,
            timer:1500,
            position:'top-end',
            showConfirmButton:false,
            timerProgressBar:true
        })
    }
})
})

//COMPRAR PELICULA
$('#ComprarPelicula').on('click',function() {
    Swal.fire({
        title:'Comprar <?php echo $Titulo ?>',
        showConfirmButton:false,
        showCancelButton:true,
        showCloseButton:true,
        html:'<h4>¿Estas seguro ?</h4><br> al confirmar el pago sera realizado ! <br><br><button id="AceptCompPel" class="btn btn-primary">Si,Comprar</button>',
    })

    //ACEPTAR COMPRA
    $('#AceptCompPel').on('click',function(){
      $.ajax({
        url:'Ajax.php',
        type:'POST',
        data:{'ComprarPelicula':1, 'Titulo':'<?php echo $Titulo ?>','IDPelicula':'<?php echo $IDPelicula ?>','Cedula':'<?php echo $Cedula ?>','IDTarjeta':'<?php echo $IDTarjeta ?>'},
      }).done(function(res){
        console.log(res);
        if (res == 1) {
            Swal.fire({
                icon:'success',
                title:'Pelicula Comprada con éxito',
                showButtonConfirm:false,
                timer: 1500,
                timerProgressBar: true
            })
            setTimeout(() => {
                location.reload();
            }, 1500);
        }
        else if (res == 2) {
            Swal.fire({
                icon:'error',
                title:'Tarjeta de crédito vencida!',
                html:'Por favor renueve tu tarjeta y vuelve a intentarlo'
            })
        }
        else if (res == 3) {
            Swal.fire({
                icon:'error',
                title:'Saldo Insuficiente!',
                html:'No tiene saldo para adquerir <?php echo $Titulo ?>'                
            })
        }
        
      })
    })

})
</script>
<?php
require "footer.php";
?>
</body>
</html>

