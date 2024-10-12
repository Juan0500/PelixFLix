
<?php
//-------------------------------\\
require "ModuloConexion.php";
require "header.php";
include('Datos/Datos_Catalogos.php');
include('Datos/Datos_Peliculas.php');
include('Datos/Datos_Planes.php');

if ($tipo_user !== "Administrador") {
   header("location:index.php");
}


//------------------------------\\
?>  

<body id="body">
    <!-- MODAL PARA DE ACCIONES DE ADMINISTRADOR(GUARDAR;MODIFICAR;ELIMINAR) -->
    <div class="modal fade  text-dark" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body"  id="body-contenido">
                    
                </div>
                <div class="modal-footer" id="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Volver</button>
                    <button type="button" id="btn-continuar-modal" class="btn btn-primary" data-dismiss="modal">Continuar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- FIN DE MODAL -->

    <!-- TODOS LOS MENUS -->
    <main class="mt-5">
        <?php
        if (isset($_GET['/'])) {
            
            if($_GET['/'] == base64_encode("Plan")){
                ?>
                <!-- MENU PLANES -->
                <div  class="container mt-5" id="cont-MPlanes">
                            <div class="row mt-3 mb-3">
                                <div class="col-sm-8"><h2>Listado de  <b>Planes</b></h2></div>
                                <div class="col-sm-4">
                                    <a href="#"  data-toggle="modal" data-target="#modelId" class="btn btn-info add-new btn-create-plan"><i class="fa fa-plus"></i> Agregar Plan</a>
                                </div>
                            </div>
                            <?php 
                            $Planes = new Planes();
                            $listado=$Planes->read_Planes();
                            if ($listado == false) {
                                $message="¡ No hay Planes Guardados !";
                                $class="alert alert-danger";
                                echo "<div class='text-center ".$class."'><label class='h3'>".$message."</label></div>"; 
                            }
                            else{
                            ?>
                            <table class="table table-striped bg-dark text-center">
                                <thead class="bg-primary">
                                    <tr>
                                        <th class="text-center">ID Plan</th>
                                        <th class="text-center">Monto</th>
                                        <th class="text-center">Dia</th>
                                        <th class="text-center">Cantidad de Dispositivos</th>
                                        <th class="text-center">Detalle</th>
                                        <th class="text-center">Accion</th>
                                    </tr>
                                </thead>
                                <tbody id="tablaPlanes">
                                    <?php 
                                        while ($row=mysqli_fetch_object($listado)){
                                        $IDPlan=$row->IDPlan;
                                        $Monto=$row->Monto;
                                        $Dia=$row->Dia;
                                        $Dispositivo=$row->Dispositivos;
                                        $Detalle=$row->Detalle;
                                        ?>
                                    <tr id="<?php echo $IDPlan?>">
                                        <td data-titulo="IDPlan:"><?php echo $IDPlan;?></td>
                                        <td data-titulo="Monto:"><?php echo $Monto;?></td>
                                        <td data-titulo="Dia:"><?php echo $Dia;?></td>
                                        <td data-titulo="Cant. Dispositivos:"><?php echo $Dispositivo;?></td>
                                        <td data-titulo="Detalle:"><?php echo $Detalle;?></td>

                                        <td>
                                        <div class="acc" style="display:flex;
                                        justify-content:space-around;">
                                            <!-- BOTON MODIFICAR -->
                                            <a IDPlan="<?php echo $IDPlan ?>" Monto="<?php echo $Monto ?>" Dia="<?php echo $Dia ?>" Dispositivos="<?php echo $Dispositivo ?>" Detalle="<?php echo $Detalle ?>" href="#" data-toggle="modal" data-target="#modelId" class="btn btn-warning btn-edit-plan" title="Editar" data-toggle="tooltip"><i class="fa-solid fa-pen-to-square"></i></a>
                            
                                                <!-- BOTON ELIMINAR -->
                                                <a href="#" id="<?php echo $IDPlan ?>" class="btn btn-danger btn-del" donde="Delete/deletePlanes/deletePlanes.php?action=4&id=<?php echo $IDPlan?> "><i class="fa fa-trash"></i></a>
                                        </div>
                                        </td>
                                    </tr>	
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <?php
                            }
                        ?>
                </div>
                <?php 
            }
            if($_GET['/'] == base64_encode("Catalogo")){
                ?>
                 <!-- Menu Catalogos -->
                <div  class="container mt-5" id="cont-MCatalogos">
                    <div class="row mt-4 mb-3">
                        <div class="col-sm-8"><h2>Listado de <b>Catalogos</b></h2></div>
                        <div class="col-sm-4">
                            <a href="#"  data-toggle="modal" data-target="#modelId"  class="btn btn-info btn-create-catalogo"><i class="fa fa-plus"></i> Agregar Catalogo</a>
                        </div>
                    </div>
                    <?php 
                    $Usuarios = new Catalogos();
                    $listado=$Usuarios->read_Catalogos();
                    if ($listado == false) {
                        $message="¡ No hay Catalogos Guardados !";
                        $class="alert alert-danger";
                        echo "<div class='text-center ".$class."'><label class='h3'>".$message."</label></div>";    
                    }
                    else {     
                    ?>
                    <table class="table table-striped bg-dark text-center">
                        <thead class="bg-primary">
                            <tr>
                                <th class="text-center">ID Catalogo</th>
                                <th class="text-center">Genero</th>
                                <th class="text-center">Detalle</th>
                                <th class="text-center">Accion</th>
                            <tr>
                        </thead>
                        <tbody id="tablaCatalogos"> 
                                <?php 
                                    while ($row=mysqli_fetch_object($listado)){
                                    $IDCatalogo=$row->IDCatalogo;
                                    $Genero=$row->Genero;
                                    $Detalle=$row->Detalle;
                                ?>
                            <tr id="<?php echo $IDCatalogo ?>">
                                <td data-titulo="ID Catalogo:"><label id="IDCatalogo"> <?php echo $IDCatalogo;?></label></td>
                                <td data-titulo="Genero:"><?php echo $Genero;?></td>
                                <td data-titulo="Detalle:"> <label class=""><?php echo $Detalle;?></label></td>

                                <td>
                                    <div class="acc" style="display:flex;
                                    justify-content:space-around;">
                                            <!-- BOTON MODIFICAR -->
                                            <a href="#" IDCatalogo="<?php echo $IDCatalogo ?>" Genero="<?php echo $Genero ?>" Detalle="<?php echo $Detalle ?>"  data-toggle="modal" data-target="#modelId"  class="btn btn-warning btn-edit-catalogo" title="Editar" data-toggle="tooltip"><i class="fa-solid fa-pen-to-square"></i></a>


                                            <!-- BOTON ELIMINAR -->
                                            <a class="btn btn-danger btn-del" id="<?php echo $IDCatalogo ?>" href="#" donde="Delete/deleteCatalogos/deleteCatalogos.php?action=5&id=<?php echo $IDCatalogo?> "><i class="fa fa-trash"></i></a>
                                    </div>
                                </td>
                            </tr>	
                            <?php
                            }
                            ?>
                            <tbody>        
                        </tbody>
                    </table>
                    <?php
                    }
                    ?>
                </div>
                <?php 
            }
            if($_GET['/'] == base64_encode("Pelicula")){
                ?>
                <!-- MENU PELICULAS -->
                <div class="container mt-5" id="cont-MPeliculas">
                    <div class="row mt-3 mb-3">
                        <div class="col-sm-8"><h2>Listado de  <b>Películas</b></h2></div>
                        <div class="col-sm-4 text-center">
                        <a id="AC" href="#"  data-toggle="modal" data-target="#modelId"   class="btn btn-info btn-create-peliculas"><i class="fa fa-plus"></i> Agregar Pelicula</a>
                            <label class="text-white bg-danger mt-2 p-2" id='ACNHC' style="display:none;">  !No tienes Catalogos Guardados! </label>
                        </div>
                    </div>
                    <?php 
                        $Pelicula = new Peliculas();
                        $listado=$Pelicula->read_Peliculas();
                        if ($listado == false) {
                            $message="¡ No hay Peliculas Guardadas !";
                                $class="alert alert-danger";
                                echo "<div class='text-center ".$class."'><label class='h3'>".$message."</label></div>"; 
                        }
                        else {    
                        ?>
                        <div class="">
                            <table class="table table-striped text-center bg-dark">
                                <thead class="bg-primary">
                                    <tr>
                                        <th class="text-center">Titulo</th>
                                        <th class="text-center">Genero</th>
                                        <th class="text-center">Imagen</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>        
                                <?php 
                                    while ($row=mysqli_fetch_object($listado)){
                                    $IDPelicula=$row->IDPelicula;
                                    $Titulo=$row->Titulo;
                                    $Productora=$row->Productora;
                                    $Actores=$row->Actores;
                                    $Genero=$row->Genero;
                                    $Fecha_Estreno=$row->Fecha_Estreno;
                                    $URL_Trailer=$row->URL_Trailer;
                                    $URL_Film=$row->URL_Film;
                                    $Descripcion=$row->Descripcion;
                                    $FechaGuardada=$row->FechaGuardada;
                                ?>
                                <tr id="<?php echo $IDPelicula ?>">
                                    <td data-titulo="Titulo:"><?php echo $IDPelicula;?></td>
                                    <td data-titulo="Genero:"><?php echo $Titulo;?></td>
                                    <td> <input type="image" id="ver-imagen"  width="150" height="200" src="data:jpeg;base64,<?php echo  base64_encode($row->Imagen);?>">  </td>
                                   
                                    
                                <!-- ACCIONES -->
                                <td style="padding-top:5%;">
                                
                                    <div class="cc" style="display:flex;justify-content:space-around;">
                                        <div>
                                            <!-- Mas INformacion de la Pelicula -->
                                            <a IDFilm="<?php echo $IDPelicula ?>" Titulo="<?php echo $Titulo ?>" Productora="<?php echo $Productora ?>" Actores="<?php echo $Actores ?>"  Fecha_Estreno="<?php echo $Fecha_Estreno ?>" Genero="<?php echo $Genero ?>" URL_Trailer="<?php echo $URL_Trailer ?>" URL_Film="<?php echo $URL_Film ?>" Descripcion = "<?php echo $Descripcion ?>"  FechaGuardada="<?php $FechaGuardada ?>" href="#" class="btn btn-warning btn-more-film"><i class="fa-solid fa-plus"></i></a>
                                        </div>
                                        <!-- BOTON MODIFICAR -->
                                        <a  IDPelicula="<?php echo $IDPelicula ?>" Titulo="<?php echo $Titulo ?>" Productora="<?php echo $Productora ?>" Actores="<?php echo $Actores ?>" Fecha_Estreno="<?php echo $Fecha_Estreno ?>" Genero="<?php echo $Genero ?>" URL_Trailer="<?php echo $URL_Trailer ?>" URL_Film="<?php echo $URL_Film ?>" Descripcion = "<?php echo $Descripcion ?>"  FechaGuardada="<?php $FechaGuardada ?>" href="#"  data-toggle="modal" data-target="#modelId"   class="btn btn-warning btn-edit-pelicula" title="Editar" data-toggle="tooltip"><i class="fa-solid text-white fa-pen-to-square"></i></a>
                                
                                        <!-- BOTON ELIMINAR -->
                                        <a class="btn btn-danger btn-del" href="#" id="<?php echo $IDPelicula ?>" donde="Delete/deletePeliculas/deletePeliculas.php?action=2&id=<?php echo $IDPelicula ?> "><i class="fa fa-trash"></i></a>
                                    </div>
                                </td>
                                </tr>	
                                <?php
                                }
                                ?>
                                    <tbody>         
                                </tbody>
                            </table>
                        </div>
                        <?php
                        }
                    ?>
                </div>
                <?php 
            }
            if($_GET['/'] == base64_encode("Cuentas")){
                ?>
                <!-- MENU PELICULAS -->
                <div class="container mt-5" id="cont-MPeliculas">
                    <div class="row mt-3 mb-3">
                        <div class="col-sm-8"><h2>Listado de  <b>Cuentas</b></h2></div>
                    </div>
                    <?php  
                     $sql="SELECT * FROM Cuentas";
                     $res=mysqli_query($conn,$sql);
                     if ($res && mysqli_affected_rows($conn) > 0) {  
                        ?>
                        <div class="">
                            <table class="table table-striped text-center bg-dark">
                                <thead class="bg-primary">
                                    <tr>
                                        <th class="text-center">IDCuenta</th>
                                        <th class="text-center">Cedula</th>
                                        <th class="text-center">Usuario</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>        
                                <?php 
                                  
                                    while ($row=mysqli_fetch_assoc($res)){
                                    $IDCuenta=$row['IDCuenta'];
                                    $Usuario=$row['Usuario'];
                                    $Password=$row['Password'];
                                    $email=$row['email'];
                                    $Fecha_Inicio=$row['Fecha_Inicio'];
                                    $Fecha_Final=$row['Fecha_Final'];
                                    $Cedula=$row['Cedula'];
                                    $IDTarjeta=$row['IDTarjeta'];
                                    $IDPlan=$row['IDPlan'];
                                ?>
                                <tr>
                                    <td data-titulo="IDCuenta:"><?php echo $IDCuenta;?></td>
                                    <td data-titulo="Cedula:"><?php echo $Cedula;?></td>
                                    <td data-titulo="Nom. Usuario:"> <?php echo $Usuario;?>  </td>
                                   
                                    
                                <!-- ACCION MAS-->
                                <td>
                                    <!-- Mas Informacion de la Pelicula -->
                                    <a IDCuenta="<?php echo $IDCuenta ?>" Usuario="<?php echo $Usuario ?>" Password="<?php echo $Password ?>" email="<?php echo $email ?>" Fecha_Inicio="<?php echo $Fecha_Inicio ?>" Fecha_Final="<?php echo $Fecha_Final ?>" Cedula="<?php echo $Cedula ?>" IDTarjeta="<?php echo $IDTarjeta ?>" IDPlan="<?php echo $IDPlan ?>"  href="#" class="btn btn-warning btn-more-cuentas"><i class="fa-solid fa-plus"></i></a>
                                </td>
                                </tr>	
                                <?php
                                }
                                }
                                   else {
                                    ?>
                                    <div class="alert alert-danger text-center" role="alert"><label class="h3"> No hay Cuentas Guardadas.</label></div>
                                    <?php
                                   }
                                ?>
                                    <tbody>         
                                </tbody>
                            </table>
                        </div>
                <?php
            }
             if($_GET['/'] == base64_encode("Movimientos")){
                ?>
                <!-- MENU Movimientos -->
                <div class="container mt-5" id="cont-MPeliculas">
                    <div class="row mt-3 mb-3">
                        <div class="col-sm-8"><h2>Listado de  <b>Moviminetos</b></h2></div>
                    </div>
                    <?php  
                     $sql="SELECT * FROM Movimientos";
                     $res=mysqli_query($conn,$sql);
                     if ($res && mysqli_affected_rows($conn) > 0) {  
                        ?>
                        <div class="">
                            <table class="table table-striped text-center bg-dark">
                                <thead class="bg-primary">
                                    <tr>
                                        <th class="text-center">IDMovimiento</th>
                                        <th class="text-center">Cedula</th>
                                        <th class="text-center">N°Tarjeta</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>        
                                <?php 
                                  
                                    while ($row=mysqli_fetch_assoc($res)){
                                    $IDMovimiento=$row['IDMovimiento'];
                                    $Detalle=$row['Detalle'];
                                    $Monto=$row['Monto'];
                                    $Saldo_Anterior=$row['Saldo_Anterior'];
                                    $Saldo_Actual=$row['Saldo_Actual'];
                                    $Fecha_Movimiento=$row['Fecha_Movimiento'];
                                    $Cedula=$row['Cedula'];
                                    $IDTarjeta=$row['IDTarjeta'];
                                ?>
                                <tr>
                                    <td data-titulo="IDMovimiento:"><?php echo $IDMovimiento;?></td>
                                    <td data-titulo="Cedula:"><?php echo $Cedula;?></td>
                                    <td data-titulo="Num. Tarjeta:"> <?php echo $IDTarjeta;?>  </td>
                                   
                                    
                                <!-- ACCION MAS -->
                                <td>
                                    <!-- Mas Informacion del Movimiento -->
                                    <a IDMovimiento="<?php echo $IDMovimiento ?>" Detalle="<?php echo $Detalle ?>" Monto="<?php echo $Monto ?>" Saldo_Anterior="<?php echo $Saldo_Anterior ?>" Saldo_Actual="<?php echo $Saldo_Actual ?>" Fecha_Movimiento="<?php echo $Fecha_Movimiento ?>" Cedula="<?php echo $Cedula ?>" IDTarjeta="<?php echo $IDTarjeta ?>"   href="#" class="btn btn-warning btn-more-movimientos"><i class="fa-solid fa-plus"></i></a>  
                                </td>
                                </tr>	
                                <?php
                                }
                                 }
                                   else {
                                    ?>
                                    <div class="alert alert-danger text-center"><label class="h3"> No hay Movimientos de Usuarios.</label></div>
                                    <?php
                                   }
                                ?>
                                    <tbody>         
                                </tbody>
                            </table>
                        </div>
                <?php
            }
            ?>  
            </div>
            <?php 
        }
            
            
        else{
            ?>
            <script>
                location.href="index.php";
            </script>
            <?php
        }
        ?>    
    </main>
 
    <script src="js/scripts.js"></script> 
    <!-- CONFIRMACION DE ELIMINACION  --> 
    <script>
        $('.btn-del').click( function(){
            const id = $(this).attr('id')
            const donde = $(this).attr('donde')
            Swal.fire({
                title: 'Estas seguro que deseas eliminarlo?',
                text: "¡No podrás revertir esto!!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, eliminar!', 
                cancelButtonText: 'Cancelar!', 
                }).then((result)=>{
                    if(result.value){
                    if (result.isConfirmed) {
                      $.ajax({
                        url:donde,
                        type:'POST',
                        data:{'id':id},
                        
                      }).done(function(res){
                        if (res == 1) {
                            Swal.fire(
                                'Eliminado!',
                                'Eliminado Corectamente.',
                                'success'
                            )
                           
                        }
                       
                        var tr = document.getElementById(id);
                        tr.style.display="none";
                      }).fail(function(data){

                      })
                    }
                    }   

                })
            }) 
    </script>
    <?php
      require "footer.php";
      ?>
</body>
</html>


