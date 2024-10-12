<?php
//------------------------------\\
require "header.php";
require "ModuloConexion.php";
//------------------------------\\
//VOLVER AL MUNU SI NO ESTA LOGUEADO
if ($tipo_user == null) {
    ?>
    <script>
        location.href="index.php";
    </script>
    <?php
}
//------------------------------\\
//OBTENER TARJETA DEL USUARIO:
$sql="SELECT * FROM Tarjetas WHERE ID = $IDTarjeta";
$res = mysqli_query($conn,$sql);
if ($res) {
    while ($row = mysqli_fetch_assoc($res)) {
        $NTarjeta = $row['NTarjeta'];
        $Fecha_VencimientoTarjeta = $row['Fecha_Vencimiento'];
    }
    //OBTNER SOLO LOS PRIMEROS 4 DIGITOS DE LA TARJETA
    $NTarjeta4Dig = substr($NTarjeta, 0, -12);
}
//------------------------------\\
?>
<body class="mt-5">
    <main>
        <div class="container-fluid mt-5">
            <?php 
            if ($tipo_user == "Administrador") {
                ?>
                <!-- DATOS DEL ADMINISTRADOR -->
                <div class="col-12 border-tituloConfig text-center">
                    <h1 class="tituloConfig">Cuenta</h1>
                </div>
                <div class="cont-Cuenta">
                    <div class="ContenidoUsuario">
                        <div class="row">
                            <div class="col-6">
                                <h1><img src="img/img1.jpg" style="border-radius:15px;" height="10%" width="10%"> Datos de Administrador  </h1>
                            </div>
                            <div class="col-6 text-right text-info">Nota: has click para modificar, La cedula no puede ser modificada!</div>
                        </div>
                        <!-- Cedula -->
                        <div class="row text-center">
                            <div class="col-3"></div>
                            <div class="col-3 border border-dark">Cedula</div>
                            <div class="col-3 border border-dark text-info"><?php echo $Cedula ?></div>
                        </div>   
                        <!-- Nombre -->
                        <div class="row text-center mt-2">
                            <div class="col-3"></div>
                            <div class="col-3 border border-dark">Nombre</div>
                            <div class="col-3 border border-dark text-primary">John</div>
                        </div>   
                        <!-- Apellido -->        
                        <div class="row text-center mt-2">
                            <div class="col-3"></div>
                            <div class="col-3 border border-dark">Apellido</div>
                            <div class="col-3 border border-dark">KK</div>
                        </div>             
                    </div>
                </div>
                <?php
            }
            else{
            ?>
            <!-- DATOS DEL USUARIO -->
            <div id="MostrarDatosCuenta" class="col-12 border-tituloConfig text-center">
                <h1 class="tituloConfig">Cuenta</h1>
            </div>
            <div class="cont-Cuenta" style="display:none;">
                <div class="ContenidoUsuario">
                    <div class="row">
                        <div class="col-6">
                            <h1><img src="img/img1.jpg" style="border-radius:15px;" height="10%" width="10%"> Datos de Usuario  </h1>
                        </div>
                        <div class="col-6 text-right text-info">Nota: has click para modificar, La cedula no puede ser modificada!</div>
                    </div>
                    <!-- Cedula -->
                    <div class="row text-center">
                        <div class="col-3"></div>
                        <div class="col-3 border border-dark">Cedula</div>
                        <div class="col-3 border border-dark text-white"><?php echo $Cedula ?></div>
                    </div>   
                    <!-- Nombre -->
                    <div class="row text-center mt-2">
                        <div class="col-3"></div>
                        <div class="col-3 border border-dark">Nombre</div>
                        <div class="col-3 border border-dark text-primary mousePuntero" id="ModNombre"><?php echo $Nombre; ?></div>
                    </div>   
                    <!-- Apellido -->        
                    <div class="row text-center mt-2">
                        <div class="col-3"></div>
                        <div class="col-3 border border-dark">Apellido</div>
                        <div id="ModApellido" class="col-3 border border-dark mousePuntero text-primary"><?php echo $Apellido; ?></div>
                    </div>           
                    <!-- Nombre de Usuario -->        
                    <div class="row text-center mt-2">
                        <div class="col-3"></div>
                        <div class="col-3 border border-dark">Nombre de Usuario</div>
                        <div id="ModUsuario" class="col-3 border border-dark mousePuntero text-primary"><?php echo $NombreUsuario; ?></div>
                    </div>  
                    <!-- Contraseña -->         
                    <div class="row text-center mt-2">
                        <div class="col-3"></div>
                        <div class="col-3 border border-dark">Contraseña</div>
                        <div id="VerPassword" class="col-3 border border-dark mousePuntero"><a href="#" class="text-warning">Verificar</a></div>
                    </div>  
                    <!-- Email -->         
                    <div class="row text-center mt-2">
                        <div class="col-3"></div>
                        <div class="col-3 border border-dark">Email</div>
                        <div id="ModEmail" class="col-3 border border-dark mousePuntero text-primary"><?php echo $Email; ?></div>
                    </div>
                </div>
                <div class="col-12 bg-info"><hr></div>
            </div>

            <!-- Tarjeta de Credito -->
            <div id="MostrarDatosTarjeta" class="col-12 border-tituloConfig text-center">
                <h1 class="tituloConfig">Tarjeta</h1>
            </div>
            <div class="cont-Tarjeta" style="display:none;">
                <div class="container-fluid Configtarjeta">
                    <!-- icono -->
                    <div class="row ml-1 mt-4">
                        <div class="col-12 text-left">
                            <img src="img/fortarjeta.png" alt="">
                        </div>
                    </div>
                    <!-- NUMERO TARJETA -->
                    <div class="row">
                        <div class="col-12 text-center">
                            <h1 class="NTarjeta"> <?php echo $NTarjeta4Dig ?> **** **** **** </h1>
                        </div>
                    </div>
                    <div class="LABELS">
                        <!-- LABELS -->
                        <div class="row">
                            <div class="col-4">
                                <label for=""> NOMBRE </label>
                            </div>
                            <div class="col-4"></div>
                            <div class="col-4">
                                <label for=""> VÁLIDO HASTA  </label>
            
                            </div>
                        </div>
                        <!-- DATOS LABELS -->
                        <div class="row">
                            <div class="col-4">
                                <h6 for=""> <?php echo $Nombre." ".$Apellido ?> </h6>
                            </div>
                            <div class="col-4"></div>
                            <div class="col-4">
                                <h6 for=""> <?php echo date('d/m/Y', strtotime($Fecha_VencimientoTarjeta ))?>  </h6>
            
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 bg-info"><hr></div>
            </div>

            <!-- MOVIMIENTOS -->
            <div id="MostrarDatosMovimiento" class="col-12 border-tituloConfig text-center">
                <h1 class="tituloConfig">Movimientos</h1>
            </div>
            <div class="cont-Movimientos" style="display:none;">
                <div class="container-fluid ConfigMovimientos">
                    <?php
                        $sql="SELECT * FROM Movimientos WHERE Cedula=$Cedula && Tipo_User ='Vigente'";
                        $res=mysqli_query($conn,$sql);
                        if ($res && mysqli_affected_rows($conn) > 0) {
                            ?>
                            <table class="table text-center table-striped table-dark">
                                <thead class="bg-info">
                                    <tr>
                                        <th> Detalle </th>
                                        <th> Monto </th>
                                        <th> Saldo Anterior </th>
                                        <th> Saldo Actual </th>
                                        <th> Fecha del Movimiento </th>
                                    </tr>
                                </thead>
                                <tbody class="">
                            <?php
                            while ($row = mysqli_fetch_assoc($res)) {
                                $Detalle = $row['Detalle'];
                                $Monto = $row['Monto'];
                                $Saldo_Anterior = $row['Saldo_Anterior'];
                                $Saldo_Actual = $row['Saldo_Actual'];
                                $Fecha_Movimiento = $row['Fecha_Movimiento'];

                                ?>
                                <tr>
                                    <td data-titulo="Detalle:"> <?php echo $Detalle ?> </td>
                                    <td data-titulo="Monto:">$ <?php echo $Monto ?> </td>
                                    <td data-titulo="Saldo Anterior:">$ <?php echo $Saldo_Anterior ?></td>
                                    <td data-titulo="Saldo Actual:">$ <?php echo $Saldo_Actual ?> </td>
                                    <td data-titulo="F. Movimiento:"> <?php echo date('d/m/Y', strtotime($Fecha_Movimiento)) ?> </td>
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
                <div class="col-12 bg-info"><hr></div>
            </div>

            <!-- ESTADO DE LA CUENTA -->
            <?php
            if ($Estado == 0) {
                ?>
                <div class="col-12 text-center">
                    <h1 class="tituloValidesCuenta text-danger">Cuenta Desactivada el  <?php echo date(' d/M/Y  H:i:s', strtotime($FechaFinal)) ?> hs</h1>
                </div>
            <?php
            }
            else{
                ?>
                <div class="col-12 text-center">
                    <h1 class="tituloValidesCuenta">Cuenta Valida hasta <?php echo date(' d/M/Y  H:i:s', strtotime($FechaFinal)) ?> hs</h1>
                </div>
                <?php
            }
            }
            ?>
            <!-- ELIMINAR CUENTA -->
            <div id="DatosEliminar" class="mt-5 col-12 border-tituloConfig text-center">
                <h1 class="tituloConfig text-danger">Eliminar Cuenta</h1>
            </div>
        
        </div>
    </main>
    <?php
        require "footer.php";
    ?>
</body>
<script>
    $('#MostrarDatosCuenta').on('click', function(){
        var ContCuenta = $('.cont-Cuenta');
        if (ContCuenta.css('display') == "none") {
            ContCuenta.fadeIn(800);
        }
        else{
            ContCuenta.fadeOut(400);
        }
    })
    $('#MostrarDatosTarjeta').on('click', function(){
        var ContCuenta = $('.cont-Tarjeta');
        if (ContCuenta.css('display') == "none") {
            ContCuenta.fadeIn(800);
        }
        else{
            ContCuenta.fadeOut(400);
        }
    })
    $('#MostrarDatosMovimiento').on('click', function(){
        var ContCuenta = $('.cont-Movimientos');
        if (ContCuenta.css('display') == "none") {
            ContCuenta.fadeIn(800);
        }
        else{
            ContCuenta.fadeOut(400);
        }
    })
    //ALERTA PARA ELIMINAR LA CUENTA
    $('#DatosEliminar').on('click', function(){
       Swal.fire({
        title:'¿Estas seguro que deseas Eliminar la Cuenta?',
        html:'<h5 class="font-italic text-danger font-weight-bold">Esta acción no podra ser revertida!</h5><button onclick="ElimCuenta()"  class="btn btn-danger mt-5 mr-5"> Si, Eliminar </button><button onclick="canElimCuenta()" class="btn btn-primary mt-5"> Volver </button>',
        showConfirmButton:false,
        customClass: {title:'text-primary'}
       })
    })
    //CANCELAR ELIMINACION DE CUENTA
    function canElimCuenta(){
        swal.close();
    }
    // AL ACEPTAR HACER EL MENU PARA  VERIFICAR LA CONTRASEÑA
    function ElimCuenta() {
        Swal.fire({
            title:'Verifica tu contraseña',
            showConfirmButton:false,
            html:'<input type="password" class="form-control" id="VerPassDelCuenta"><button class="btn btn-primary mt-5" onclick="VerPasswordParaEliminar()"> Verificar </button>',
        })
    }
    //VERIFICAR CONTRASEÑA PARA ELIMINAR
    function VerPasswordParaEliminar(){
        var Pass = document.getElementById('VerPassDelCuenta');
        if (Pass.value == "<?php echo $Contraseña ?>") {
            EliminarCuenta();
        }
        else{
            swal.close();
            Swal.fire({
                icon:'error',
                title:'Contraseña Incrrecta!',
                showConfirmButton:false,
                timer:1200
            })
          
        }
    }
    //ELIMINAR CUENTA
    function EliminarCuenta() {
       swal.close();
       var Comentario = $('#MotivoEliminacion').val();
       if (Comentario == null ) {
           $.ajax({
            url:'Ajax.php',
            type:'POST',
            data:{'EliminarCuenta':1,'Cedula':'<?php echo $Cedula; ?>'},
           }).done(function(res){
            console.log(res);
            if (res == 1) {
                $('#btnCerrarSesion').click();
            }
           })
       }
       else{
        alert(Comentario);
       }
    }


    //MODIFICAR DATOS DE LA CUENTA

    //MOSTRAR MODIFICAR NOMBRE
    $('#ModNombre').on('click',function(){
        Swal.fire({
            title:'Modificar Nombre',
            showConfirmButton:false,
            html:'<input type="text" class="form-control" id="inpNombre" value="'+$('#ModNombre').html()+'"><button class="btn btn-primary mt-5" onclick="ModNombre()"> Modificar </button>',
        })
        
    })
    //MODIFICAR NOMBRE
    function ModNombre() {
        $.ajax({
            url:'Ajax.php',
            type:'POST',
            data:{'ModificarCuenta':1,'ModificarNombre':$('#inpNombre').val(),'Cedula':'<?php echo $Cedula ?>'},
        }).done(function (res) {
            console.log(res);
            $('#ModNombre').html(res);
            $('#NavNombreUser').html(res);
            swal.close();
            Swal.fire({
                toast:true,
                icon:'success',
                position:'top-end',
                text:'Modificado con exito',
                showConfirmButton:false,
                timer:1200
            })
        })
    }

    //MOSTRAR MODIFICAR APELLIDO
    $('#ModApellido').on('click',function(){
        Swal.fire({
            title:'Modificar Apellido',
            showConfirmButton:false,
            html:'<input type="text" class="form-control" id="inpApellido" value="'+$('#ModApellido').html()+'"><button class="btn btn-primary mt-5" onclick="ModApellido()"> Modificar </button>',
        })
        
    })
    //MODIFICAR APELLIDO
    function ModApellido() {
        $.ajax({
            url:'Ajax.php',
            type:'POST',
            data:{'ModificarCuenta':1,'ModificarApellido':$('#inpApellido').val(),'Cedula':'<?php echo $Cedula ?>'},
        }).done(function (res) {
            console.log(res);
            $('#ModApellido').html(res);
            swal.close();
            Swal.fire({
                toast:true,
                icon:'success',
                position:'top-end',
                text:'Modificado con exito',
                showConfirmButton:false,
                timer:1200
            })
        })
    }

    //MOSTRAR MODIFICAR APELLIDO
    $('#ModUsuario').on('click',function(){
        Swal.fire({
            title:'Modificar Usuario',
            showConfirmButton:false,
            html:'<input type="text" class="form-control" id="inpUsuario" value="'+$('#ModUsuario').html()+'"><button class="btn btn-primary mt-5" onclick="ModUsuario()"> Modificar </button>',
        })
        
    })
    //MODIFICAR APELLIDO
    function ModUsuario() {
        $.ajax({
            url:'Ajax.php',
            type:'POST',
            data:{'ModificarCuenta':1,'ModificarUsuario':$('#inpUsuario').val(),'IDCuenta':'<?php echo $IDCuenta ?>'},
        }).done(function (res) {
            console.log(res);
            $('#ModUsuario').html(res);
            swal.close();
            Swal.fire({
                toast:true,
                icon:'success',
                position:'top-end',
                text:'Modificado con exito',
                showConfirmButton:false,
                timer:1200
            })
        })
    }

    //MOSTRAR VERIFICAR CONTRASEÑA
    $('#VerPassword').on('click',function(){
        Swal.fire({
            title:'Verifica tu contraseña',
            showConfirmButton:false,
            html:'<input type="password" class="form-control" id="PasswordVerificar"><button class="btn btn-primary mt-5" onclick="VerPassword()"> Verificar </button>',
        })
        
    })
    //VERIFICAR CONTRASEÑA
    function VerPassword(){
        var Pass = document.getElementById('PasswordVerificar');
        if (Pass.value == "<?php echo $Contraseña ?>") {
            ViewModContraseña()
        }
        else{
            swal.close();
            Swal.fire({
                icon:'error',
                title:'Contraseña Incrrecta!',
                showConfirmButton:false,
                timer:1200
            })
          
        }
    }
     //MOSTRAR MODIFICAR CONTRASEÑA
    function ViewModContraseña(){
        Swal.fire({
            title:'Cambiar contraseña',
            showConfirmButton:false,
            html:'<input type="password" class="form-control" id="inpPassword" value="'+document.getElementById('PasswordVerificar').value+'"><button class="btn btn-primary mt-5" onclick="ModPassword()"> Modificar </button>',
        })
        
    }
    //MODIFICAR Contraseña
    function ModPassword() {
        $.ajax({
            url:'Ajax.php',
            type:'POST',
            data:{'ModificarCuenta':1,'ModificarPassword':$('#inpPassword').val(),'IDCuenta':'<?php echo $IDCuenta ?>'},
        }).done(function (res) {
            console.log(res);
            $('#ModPassword').html(res);
            swal.close();
            Swal.fire({
                icon:'success',
                title:'Modificado con exito',
                text:'Por seguridad la pagina recargara!',
                showConfirmButton:false,
                timer:1200
            })
            location.reload();
        })
    }

    //MOSTRAR MODIFICAR APELLIDO
    $('#ModEmail').on('click',function(){
        Swal.fire({
            title:'Modificar Email',
            showConfirmButton:false,
            html:'<input type="email" class="form-control" id="inpEmail" value="'+$('#ModEmail').html()+'"><button class="btn btn-primary mt-5" onclick="ModEmail()"> Modificar </button>',
        })
        
    })
    //MODIFICAR APELLIDO
    function ModEmail() {
        $.ajax({
            url:'Ajax.php',
            type:'POST',
            data:{'ModificarCuenta':1,'ModificarEmail':$('#inpEmail').val(),'IDCuenta':'<?php echo $IDCuenta ?>'},
        }).done(function (res) {
            console.log(res);
            $('#ModEmail').html(res);
            swal.close();
            Swal.fire({
                toast:true,
                icon:'success',
                position:'top-end',
                text:'Modificado con exito',
                showConfirmButton:false,
                timer:1200
            })
        })
    }
    
</script>
</html>