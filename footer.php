<footer>
  <div class="footer-middle">  
  <div class="container-fluid footer">  
    <div class="row">
        <div class="col-md-2 mt-5">  
        <img src="img/logo.png" width="100px">
             
        </div>  
      <div class="col-md-4 col-sm-6">  
        <div class="footer-pad">  
          <table class="mt-4">
            <tr>
                <td> <a class="mr-cinco" href="#">Preguntas Frecuentes</a></td>  
                <td> <a href="#"> Terminos de uso </a></td> 
            </tr>
            <tr>  
                <td> <a class="mr-cinco" href="#"> Política y privacidad</a></td>  
                <td> <a  href="#">Acerca de PelixFlix</a></td>  
            </tr>
            <tr>
                <td> <a href="#">Ayuda</a></td>  
            </tr>
          </table>  
        </div>  
      </div>   
        <div class="col-md-2">  
             
        </div>  
        <div class="col-md-3">  
            <label class="h4 text-center">  </label>
            <ul class="list-unstyled">  
            <li> <a href="#"> WorldEntretainment2022@gmil.com </a> </li>  
            <li> <a href="#"> @WorldEntretainment2022 </a> </li>
            <li> <a href="#"> +598 92091259 </a> </li>
          </ul>    
        </div>  
    </div>  
    <div class="row text-center">  
    <div class="col-md-12 copy">  
    <label class="h6"> © Copyright 2022 - World Entretainment.  Todos los derechos Reservados. </label>  
    </div>  
    </div>  
  </div>  
  </div>  

</footer>






<script>
  //MOSTRAR EL FOOTER DEL MODAL EN EL CASO DE SER OCULTO EN EL MENU DE PELCULAS
  $('#modal-footer').show();


  /* CONTENIDO DEL BODY DEL MODAL CUANDO EL ADMINISTRADOR REALIZA UNA ACCION */
  /* ------------------------ */
  /* PLANES */
  $('.btn-create-plan').on('click', function(e){
          $('.modal-title').html('Guardar Nuevo Plan');
          $('#body-contenido').html('<form><div class="col-md-12"><label>Monto:</label><input type="number" name="Monto" id="Monto" class="form-control"  maxlength="6" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" required ></div><div class="col-md-12"><label>Dia:</label><input type="number" name="Dia" id="Dia" class="form-control"  maxlength="3" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" required></div><div class="col-md-12"><label>Dispositivos:</label><input type="number"  maxlength="2" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" name="Dispositivos" id="Dispositivos" class="form-control" required></div><div class="col-md-12"><label>Detalle:</label><textarea type="text" name="Detalle" id="Detalle" class="form-control" maxlength="100" required></textarea></div><div class="col-md-12 text-center mt-5"><input id="Accion"  type="hidden" value="G_Planes"><input id="crud"  type="hidden" value="Planes"></div></form>');
  });
  $('.btn-edit-plan').on('click', function(e){
          const IDPlan = $(this).attr('IDPlan');
          const Monto = $(this).attr('Monto');
          const Dia = $(this).attr('Dia');
          const Dispositivos = $(this).attr('Dispositivos');
          const Detalle = $(this).attr('Detalle');
          $('#modal-title').html('Modificar Plan');
          $('#body-contenido').html('<form"><div class="col-md-12"><label>Monto:</label><input type="text" name="Monto" id="Monto" class="form-control" maxlength="100" required  value="'+Monto+'"><input type="hidden" name="IDPlan" id="IDPlan" class="form-control" maxlength="100" value="'+IDPlan+'"></div><div class="col-md-12"><label>Dia:</label><input type="text" name="Dia" id="Dia" class="form-control" maxlength="100" required value="'+Dia+'"></div><div class="col-md-12"><label>Dispositivos:</label><input type="text" name="Dispositivos" id="Dispositivos" class="form-control" maxlength="15" required value="'+Dispositivos+'"></div><div class="col-md-12"><label>Detalle:</label><textarea  name="Detalle" id="Detalle" class="form-control" maxlength="255" required>'+Detalle+'</textarea></div><div class="col-md-12 mt-4 text-center"><input id="crud" name="crud" type="hidden" value="Planes"><input id="Accion" name="Accion" type="hidden" value="M_Planes"></div></form>');
        
  });
 /* ------------------------ */
 /* CATALOGOS */
  $('.btn-create-catalogo').on('click', function(e){
    $('.modal-title').html('Guardar Nuevo Plan');
    $('#body-contenido').html('<form><div class="col-md-12 mb-3 text-center"><input type="text" placeholder="Género" name="Genero" id="Genero" class="form-control" maxlength="25" required ></div><div class="col-md-12"><textarea type="text" placeholder="Detalle" name="Detalle" id="Detalle" class="form-control" maxlength="500" required></textarea></div><div class="col-md-12 mt-5"><input id="crud" name="crud" type="hidden" value="Catalogos"><input id="Accion" name="Accion" type="hidden" value="G_Catalogos"><input type="hidden" id="IDCatalogo" value="NO"></div></form>');
  });
  $('.btn-edit-catalogo').on('click', function(e){
          const IDCatalogo = $(this).attr('IDCatalogo');
          const Genero = $(this).attr('Genero');
          const Detalle = $(this).attr('Detalle');
          $('#modal-title').html('Modificar Catalogo');
          $('#body-contenido').html('<form><div class="col-md-12"><label>Genero:</label><input type="text" name="Genero" id="Genero" class="form-control" maxlength="100" required  value="'+Genero+'"><input type="hidden" name="IDCatalogo" id="IDCatalogo" class="form-control" maxlength="100" value="'+IDCatalogo+'"></div><div class="col-md-12"><label>Detalle:</label><input type="text" name="Detalle" id="Detalle" class="form-control" maxlength="500" required value="'+Detalle+'"></div><div class="col-md-12 mt-5 text-center"><input id="crud" name="crud" type="hidden" value="Catalogos"><input id="Accion" name="Accion" type="hidden" value="M_Catalogos"></div></form>');
        
  });
   /* ------------------------ */
   /*Peliculas*/
   $('.btn-create-peliculas').on('click', function(e){
          $('#modal-footer').hide();
          $('.modal-title').html('Guardar Nueva Pelicula');
          $('#body-contenido').html('<form method="post" action ="Interfaz/Interfaz_Peliculas.php" enctype="multipart/form-data"><div class="row"><div class="col-md-6"><label>Titulo:</label><input type="text" name="Titulo" id="Titulo" class="form-control" maxlength="100" required ></div><div class="col-md-6"><label>Productora:</label><input type="text" name="Productora" id="Productora" class="form-control" maxlength="100" required></div><div class="col-md-12"><label>Actores:</label><textarea name="Actores" id="Actores" class="form-control" required ></textarea></div><div class="col-md-12"><label>Descripción:</label><textarea name="Descripcion" id="Descripcion" class="form-control" required ></textarea></div><div class="col-md-6 text-center"><label class="mt-3"> URL del Trailer: </label><input type="text" class="form-control" name="URL_Trailer" id="URL_Trailer"></div><div class="col-md-6 text-center"><label class="mt-3"> URL de la Pelicula: </label><input type="text" class="form-control" maxlength="500" name="URL_Pelicula" id="URL_Film"></div><div class="col-md-6 text-center"><label class="mt-3">Fecha de Estreno:</label><input type="date" name="Fecha_Estreno" id="Fecha_Estreno" class="form-control" maxlength="100" required></input></div><div class="col-md-6 text-center"><label class="mt-3">Genero:</label><div class="form-group"><select class="custom-select" name="Genero" id="Genero"><?php $sql="SELECT * FROM Catalogo";$result=mysqli_query($conn,$sql); if ($result && mysqli_affected_rows($conn) > 0) { while ( $row = mysqli_fetch_assoc($result)) { ?><option value="<?php echo $row['Genero'] ?>"><?php echo $row['Genero'] ?></option><?php } } else { ?><option value=""> No se ha guardado ningun genero! </option><?php } ?></select></div></div><div class="col-md-12 text-center"><label class="mr-3">Imagen Chica</label><input type="file" name="image1" class="imagen" id="imagen1"><div class="col-md-12 text-center"><label class="mr-3">Imagen Grande</label><input type="file" name="image2" class="imagen" id="imagen2"></div></div><input id="createID" name="crud" type="hidden" value="G_Peliculas"><input id="dondevolver" type="hidden" value="<?php echo base64_encode("Pelicula") ?>"></div><div class="col-12 text-center mt-4"><input class="btn btn-primary" type="submit" name="submit" value="Guardar"></div><input type="hidden" id="pp1" value="GuardarPelicula"></form></div> ');

    //Validar Imangen de Pelicula
    $(".imagen").change(function() {
        //OBTENER ARCHVO SELECCONADO Y AGREGARLO A UNA VARABLE
        var file = this.files[0];
        //OBTENER SOLO EL FORMATO DE ESTE
        var imagefile = file.type;
        //ARRAY CON LOS FORMATOS PERMITIDOS
        var match= ["image/jpeg","image/png","image/jpg"];
        //VERFCAR SI EL ARCHIVO SELECCIONADO NO CUNPLE CON EL FORMATO
        if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2]))){
          //QUITAR EL ARCHIVO INVALIDO DEL INPUT
          $(this).val(null);
          //ALERTA
          Swal.fire({
            title:'Formato no permitido!',
            html:'Solo se permiten imagenes jpg, jpeg y png!',
            icon:'error',
            async:false,
            showConfirmButton:true
          });
          return false;
        }
    });
  });
  $('.btn-edit-pelicula').on('click', function(e){
    $('#modal-footer').hide();
    const IDPelicula = $(this).attr('IDPelicula');
    const Titulo = $(this).attr('Titulo');
    const Productora = $(this).attr('Productora');
    const Actores = $(this).attr('Actores');
    const Fecha_Estreno = $(this).attr('Fecha_Estreno');
    const Genero = $(this).attr('Genero');
    const URL_Trailer = $(this).attr('URL_Trailer');
    const URL_Film = $(this).attr('URL_Film');
    const Descripcion = $(this).attr('Descripcion');
    const FechaGuardada = $(this).attr('FechaGuardada');
    $('#modal-title').html('Modificar Pelicula');
    $('#body-contenido').html('<form method="post" action ="Interfaz/Interfaz_Peliculas.php" enctype="multipart/form-data"><div class="row"><div class="col-md-6"><label>Titulo:</label><input type="text" name="Titulo" id="Titulo" class="form-control" maxlength="100" required  value="'+Titulo+'"><input type="hidden" name="IDPelicula" id="IDPelicula" class="form-control" maxlength="100"   value="'+IDPelicula+'"></div><div class="col-md-6"><label>Productora:</label><input type="text" name="Productora" id="Productora" class="form-control" maxlength="100" required value="'+Productora+'"></div><div class="col-md-12"><label>Actores:</label><textarea class="form-control" name="Actores"> '+Actores+' </textarea></div><div class="col-md-12"><label>Descripcion:</label><textarea class="form-control" name="Descripcion"> '+Descripcion+' </textarea></div><div class="col-md-6"><label>Genero:</label><div class="form-group"><select class="form-control" name="Genero" id="Genero"> <option value="'+Genero+'" selected> Actual('+Genero+') </option> <?php $sql="SELECT Genero FROM Catalogo WHERE 1"; $res = mysqli_query($conn, $sql); if ($res) { while ($row = mysqli_fetch_assoc($res)) { ?><option value="<?php echo $row['Genero'] ?>"> <?php echo $row['Genero'] ?> </option> <?php	 } } ?>  </select></div></div> <div class="col-md-6"><label>URL del Trailer:</label><input type="text" name="URL_Trailer" id="URL_Trailer" class="form-control" maxlength="500" required value="'+URL_Trailer+'"></div><div class="col-md-6"><label class="mt-3">URL de la Pelicula:</label><input type="text" name="URL_Film" id="URL_Film" class="form-control" maxlength="500" required value="'+URL_Film+'"></div><div class="col-md-6"><label class="mt-3">Fecha Estreno:</label><input type="date"  name="Fecha_Estreno" id="Fecha_Estreno" class="form-control"required value="'+Fecha_Estreno+'"></div><div class="col-md-12 text-center mt-3"> <label class="mr-3">  Imagen Chica: </label> <input type="file" name="image1"><br><label class="mr-3">  Imagen Grande: </label> <input type="file" name="image2"><br><br> <input class="btn btn-primary mb-2" type="submit" name="submit" value="Modificar"> <input id="createID" name="crud" type="hidden" value="M_Peliculas"> </div>  </div></form>');
  });

  /* BOTON MAS INFORMACION DE LA PELICULA */
  $('.btn-more-film').on('click', function(e){
    e.preventDefault();
    const id = $(this).attr('IDFilm')
    const titulo = $(this).attr('titulo')
    const productora = $(this).attr('productora')
    const actores = $(this).attr('actores')
    const Fecha_Estreno = $(this).attr('Fecha_Estreno')
    const Genero = $(this).attr('Genero')
    const URL_Trailer = $(this).attr('URL_Trailer')
    const URL_Film = $(this).attr('URL_Film')
    Swal.fire({
    html:'<div class="div-mas-info-pelicula"><div class="card bg-warning text-white"><div class="card-head p-2"><h4 class="text-center"> Mas sobre '+titulo+' </h4></div></div><table class="table table-sm text-center table-mas-info-pelicula"><tbody><tr><td class="td-titulos-mas-info-pelicula"> ID </td><td class="td-texto-mas-info-pelicula"> '+id+' </td></tr><tr><td  class="td-titulos-mas-info-pelicula"> Titulo </td><td class="td-texto-mas-info-pelicula">  '+titulo+' </td></tr><tr><td  class="td-titulos-mas-info-pelicula"> Productora </td><td class="td-texto-mas-info-pelicula"> '+productora+' </td></tr><tr><td  class="td-titulos-mas-info-pelicula"> Actores </td><td class="td-texto-mas-info-pelicula"> '+actores+' </td></tr><tr><td  class="td-titulos-mas-info-pelicula"> Fecha de Estreno </td><td class="td-texto-mas-info-pelicula"> '+Fecha_Estreno+' </td></tr><tr><td  class="td-titulos-mas-info-pelicula"> Genero </td><td class="td-texto-mas-info-pelicula"> '+Genero+' </td></tr><tr><td class="td-link-mas-info-pelicula"><iframe src="'+URL_Trailer+'" frameborder="0" style="width: 500px;height:300px;"></iframe></td><td class="td-link-mas-info-pelicula"> <iframe src="'+URL_Film+'" frameborder="0" style="width: 500px;height:300px;"></iframe> </td></tr></tbody></table></div>',
    showConfirmButton:false,
    showCloseButton:true,
    grow:'fullscreen',
    backdrop: `
    rgba(0,0,0,0.8)

    `
    })
    $(".swal2-modal").css('background-color', 'transparent');
    $(".swal2-container.in").css('background-color', 'rgba(43, 165, 137, 0.45)');
  });
  /* ------------------------ */
   /* BOTON MAS INFORMACION DE LA CUENTA */
   $('.btn-more-cuentas').on('click', function(e){
    e.preventDefault();
    const id = $(this).attr('IDCuenta')
    const Usuario = $(this).attr('Usuario')
    const Password = $(this).attr('Password')
    const email = $(this).attr('email')
    const Fecha_Inicio = $(this).attr('Fecha_Inicio')
    const Fecha_Final = $(this).attr('Fecha_Final')
    const URL_Trailer = $(this).attr('URL_Trailer')
    const Cedula = $(this).attr('Cedula')
    const IDTarjeta = $(this).attr('IDTarjeta')
    const IDPlan = $(this).attr('IDPlan')
    Swal.fire({
    html:'<div class="div-mas-info-pelicula"><div class="card bg-warning text-white"><div class="card-head p-2"><h4 class="text-center"> Mas sobre '+Usuario+' </h4></div></div><table class="table table-sm text-center table-mas-info-pelicula"><tbody><tr><td class="td-titulos-mas-info-pelicula"> ID </td><td class="td-texto-mas-info-pelicula"> '+id+' </td></tr><tr><td  class="td-titulos-mas-info-pelicula"> Usuario </td><td class="td-texto-mas-info-pelicula">  '+Usuario+' </td></tr><tr><td  class="td-titulos-mas-info-pelicula"> Password </td><td class="td-texto-mas-info-pelicula"> '+Password+' </td></tr><tr><td  class="td-titulos-mas-info-pelicula"> Email </td><td class="td-texto-mas-info-pelicula"> '+email+' </td></tr><tr><td  class="td-titulos-mas-info-pelicula"> Fecha de Inicio </td><td class="td-texto-mas-info-pelicula"> '+Fecha_Inicio+' </td></tr><tr><td  class="td-titulos-mas-info-pelicula"> Fecha Final </td><td class="td-texto-mas-info-pelicula"> '+Fecha_Final+' </td></tr><tr><td  class="td-titulos-mas-info-pelicula"> Cedula </td><td class="td-texto-mas-info-pelicula"> '+Cedula+' </td></tr><tr><td  class="td-titulos-mas-info-pelicula"> IDTarjeta </td><td class="td-texto-mas-info-pelicula"> '+IDTarjeta+' </td></tr><tr><td  class="td-titulos-mas-info-pelicula"> IDPlan </td><td class="td-texto-mas-info-pelicula"> '+IDPlan+' </td></tr></tbody></table></div>',
    showConfirmButton:false,
    showCloseButton:true,
    grow:'fullscreen',
    backdrop: `
    rgba(0,0,0,0.8)

    `
    })
    $(".swal2-modal").css('background-color', 'transparent');
    $(".swal2-container.in").css('background-color', 'rgba(43, 165, 137, 0.45)');
  });
  /* -------------------------------------- */
  /* BOTON MAS INFORMACION DE LA CUENTA */
  $('.btn-more-movimientos').on('click', function(e){
    e.preventDefault();
    const id = $(this).attr('IDMovimiento')
    const Detalle = $(this).attr('Detalle')
    const Monto = $(this).attr('Monto')
    const Saldo_Anterior = $(this).attr('Saldo_Anterior')
    const Saldo_Actual = $(this).attr('Saldo_Actual')
    const Fecha_Movimiento = $(this).attr('Fecha_Movimiento')
    const Cedula = $(this).attr('Cedula')
    const IDTarjeta = $(this).attr('IDTarjeta')
    const IDPlan = $(this).attr('IDPlan')
    Swal.fire({
    html:'<div class="div-mas-info-pelicula"><div class="card bg-warning text-white"><div class="card-head p-2"><h4 class="text-center"> CI del Cliente: '+Cedula+' </h4></div></div><table class="table table-sm text-center table-mas-info-pelicula"><tbody><tr><td class="td-titulos-mas-info-pelicula"> ID </td><td class="td-texto-mas-info-pelicula"> '+id+' </td></tr><tr><td  class="td-titulos-mas-info-pelicula"> Detalle </td><td class="td-texto-mas-info-pelicula">  '+Detalle+' </td></tr><tr><td  class="td-titulos-mas-info-pelicula"> Monto </td><td class="td-texto-mas-info-pelicula"> '+Monto+' $</td></tr><tr><td  class="td-titulos-mas-info-pelicula"> Saldo Anterior </td><td class="td-texto-mas-info-pelicula"> '+Saldo_Anterior+' $</td></tr><tr><td  class="td-titulos-mas-info-pelicula"> Saldo Actual </td><td class="td-texto-mas-info-pelicula"> '+Saldo_Actual+' $</td></tr><tr><td  class="td-titulos-mas-info-pelicula"> Fecha Movimento </td><td class="td-texto-mas-info-pelicula"> '+Fecha_Movimiento+' </td></tr><tr><td  class="td-titulos-mas-info-pelicula"> Cedula </td><td class="td-texto-mas-info-pelicula"> '+Cedula+' </td></tr><tr><td  class="td-titulos-mas-info-pelicula"> IDTarjeta </td><td class="td-texto-mas-info-pelicula"> '+IDTarjeta+' </td></tr></tbody></table></div>',
    showConfirmButton:false,
    showCloseButton:true,
    grow:'fullscreen',
    backdrop: `
    rgba(0,0,0,0.8)

    `
    })
    $(".swal2-modal").css('background-color', 'transparent');
    $(".swal2-container.in").css('background-color', 'rgba(43, 165, 137, 0.45)');
  });
</script> 




