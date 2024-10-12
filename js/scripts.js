//ACCIONES DEL CRUD
$('#btn-continuar-modal').click( function(){
  var DD_Viene = $('#crud').val();
  if (DD_Viene == "Planes") {  
    var Accion = $('#Accion').val();
    var IDPlan = $('#IDPlan').val();
    var Monto = $('#Monto').val();
    var Dia = $('#Dia').val();
    var Dispositivos = $('#Dispositivos').val();
    var Detalle = $('#Detalle').val();
      $.ajax({
          url: 'Interfaz/Interfaz_Planes.php',
          type: 'POST',
          data: {'IDPlan': IDPlan, 'Monto': Monto, 'Dia': Dia, 'Dispositivos': Dispositivos, 'Detalle': Detalle, 'crud': Accion},
          
      }).done(function(res){
        //CUANDO SE GUARDA
        if (res == 1) {
          $.ajax({
            url: 'Interfaz/Interfaz_Planes.php',
            type: 'POST',
            data: {'Monto': Monto, 'Dia': Dia, 'Dispositivos': Dispositivos, 'Detalle': Detalle, 'crud': 'B_Planes'},
          }).done(function(res){
            if (res) {
              IDPlanEncntrada = res.replace(/\s+/g, '');
              console.log(IDPlanEncntrada);
              console.log("AJAX DE BUSQUEDA ESPECIFICA REALIZADA!");
              var trPlanes = '<tr id="'+IDPlanEncntrada+'"><td data-titulo="IDPlan:">'+IDPlanEncntrada+'</td><td data-titulo="Monto:">'+Monto+'</td><td data-titulo="Dia:">'+Dia+'</td><td data-titulo="Cant. Dispositivos:">'+Dispositivos+'</td><td data-titulo="Detalle:">'+Detalle+'</td><td><div class="acc" style="display:flex;justify-content:space-around;"><a IDPlan="'+IDPlanEncntrada+'" Monto="'+Monto+'" Dia="'+Dia+'" Dispositivos="'+Dispositivos+'" Detalle="'+Detalle+'" href="#" data-toggle="modal" data-target="#modelId" class="btn btn-warning btn-edit-plan" title="Editar" data-toggle="tooltip"><i class="fa-solid fa-pen-to-square"></i></a><a href="#" id="'+IDPlanEncntrada+'" class="btn btn-danger btn-del" donde="Delete/deletePlanes/deletePlanes.php?action=4&id='+IDPlanEncntrada+'"><i class="fa fa-trash"></i></a></div></td></tr>';
              $('#tablaPlanes').prepend(trPlanes);
              //ANIMACION DE PRUEBA
              donde = IDPlanEncntrada;
              $('#'+donde).css({"background-color":"rgba(34, 255, 0)", "transition": "02s ease all"});
              setTimeout(function(){
                $('#'+donde).css({"background-color": "rgba(34, 255, 0, 0.7)", "transition": "02s ease all"});
              }, 1000);
              setTimeout(function(){
                $('#'+donde).css({"background-color": "rgba(34, 255, 0, 0.5)", "transition": "02s ease all"});
              }, 2000);
              setTimeout(function(){
                $('#'+donde).css({"background-color": "rgba(34, 255, 0, 0.3)", "transition": "02s ease all"});
              }, 3000);
              setTimeout(function(){
                $('#'+donde).css({"background-color": "rgba(34, 255, 0, 0.1)", "transition": "02s ease all"});
              }, 4000);
              setTimeout(function(){
                $('#'+donde).css({"background-color": "#343a40", "transition": "02s ease all"});
              }, 5000);
  
              //EDITAR PLAN AGREGADO
              $('.btn-edit-plan').on('click', function(e){
                console.log("Estoy en el Modificar Plan recien Guardado");
                const IDPlan = $(this).attr('IDPlan');
                const Monto = $(this).attr('Monto');
                const Dia = $(this).attr('Dia');
                const Dispositivos = $(this).attr('Dispositivos');
                const Detalle = $(this).attr('Detalle');
                $('#modal-title').html('Modificar Plan');
                $('#body-contenido').html('<form"><div class="col-md-12"><label>Monto:</label><input type="text" name="Monto" id="Monto" class="form-control" maxlength="100" required  value="'+Monto+'"><input type="hidden" name="IDPlan" id="IDPlan" class="form-control" maxlength="100" value="'+IDPlan+'"></div><div class="col-md-12"><label>Dia:</label><input type="text" name="Dia" id="Dia" class="form-control" maxlength="100" required value="'+Dia+'"></div><div class="col-md-12"><label>Dispositivos:</label><input type="text" name="Dispositivos" id="Dispositivos" class="form-control" maxlength="15" required value="'+Dispositivos+'"></div><div class="col-md-12"><label>Detalle:</label><textarea  name="Detalle" id="Detalle" class="form-control" maxlength="255" required>'+Detalle+'</textarea></div><div class="col-md-12 mt-4 text-center"><input id="crud" name="crud" type="hidden" value="Planes"><input id="Accion" name="Accion" type="hidden" value="M_Planes"></div></form>');
              
              });
              //ELIMINAR PLAN AGREGADA
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
                            console.log(res);
                            if (res == 1) {
                                Swal.fire(
                                    'Eliminado!',
                                    'Eliminado con éxito!.',
                                    'success'
                                )
                                console.log(id);
                                var eliminado = document.getElementById(id);
                                eliminado.style.display="none";
                            }
            
                            }).fail(function(data){
            
                            })
                        }
                        }   
            
                    })
                }) 
              
              
              
            }
          }).fail(function(data){
            console.log(data);
          })
          
        }
        //CUANDO SE MODIFICA
        if (res == 2) {
          //OBTENER EL TR MODIFICADO PARA RENOVARLO
          var donde = $('#'+IDPlan).attr('id');
          var tr = ' <td data-titulo="IDPlan:">'+IDPlan+'</td><td data-titulo="Monto:">'+Monto+'</td><td data-titulo="Dia:">'+Dia+'</td><td data-titulo="Cant. Dispositivos:">'+Dispositivos+'</td><td data-titulo="Detalle:">'+Detalle+'</td><td><div class="acc" style="display:flex;justify-content:space-around;"><a IDPlan="'+IDPlan+'" Monto="'+Monto+'" Dia="'+Dia+'" Dispositivos="'+Dispositivos+'" Detalle="'+Detalle+'" href="#" data-toggle="modal" data-target="#modelId" class="btn btn-warning btn-edit-plan" title="Editar" data-toggle="tooltip"><i class="fa-solid fa-pen-to-square"></i></a><a href="#" id="'+IDPlan+'" class="btn btn-danger btn-del" donde="Delete/deletePlanes/deletePlanes.php?action=4&id='+IDPlan+' "><i class="fa fa-trash"></i></a></div></td>';
          $('#'+donde).html(tr);
          //ANIMACION DE PRUEBA DE COLOR(FUNCIONA)
          $('#'+donde).css({"background-color":"rgba(34, 255, 0, 0.9)", "transition": "02s ease all"});
          setTimeout(function(){
            $('#'+donde).css({"background-color": "rgba(34, 255, 0, 0.7)", "transition": "02s ease all"});
          }, 1000);
          setTimeout(function(){
            $('#'+donde).css({"background-color": "rgba(34, 255, 0, 0.5)", "transition": "02s ease all"});
          }, 2000);
          setTimeout(function(){
            $('#'+donde).css({"background-color": "rgba(34, 255, 0, 0.3)", "transition": "02s ease all"});
          }, 3000);
          setTimeout(function(){
            $('#'+donde).css({"background-color": "rgba(34, 255, 0, 0.1)", "transition": "02s ease all"});
          }, 4000);
          setTimeout(function(){
            $('#'+donde).css({"background-color": "#343a40", "transition": "02s ease all"});
          }, 5000);


          //MODIFICAR DE NUEVO EL MODIFICADO
          $('.btn-edit-plan').on('click', function(e){
            const IDPlan = $(this).attr('IDPlan');
            const Monto = $(this).attr('Monto');
            const Dia = $(this).attr('Dia');
            const Dispositivos = $(this).attr('Dispositivos');
            const Detalle = $(this).attr('Detalle');
            $('#modal-title').html('Modificar Plan');
            $('#body-contenido').html('<form"><div class="col-md-12"><label>Monto:</label><input type="text" name="Monto" id="Monto" class="form-control" maxlength="100" required  value="'+Monto+'"><input type="hidden" name="IDPlan" id="IDPlan" class="form-control" maxlength="100" value="'+IDPlan+'"></div><div class="col-md-12"><label>Dia:</label><input type="text" name="Dia" id="Dia" class="form-control" maxlength="100" required value="'+Dia+'"></div><div class="col-md-12"><label>Dispositivos:</label><input type="text" name="Dispositivos" id="Dispositivos" class="form-control" maxlength="15" required value="'+Dispositivos+'"></div><div class="col-md-12"><label>Detalle:</label><textarea  name="Detalle" id="Detalle" class="form-control" maxlength="255" required>'+Detalle+'</textarea></div><div class="col-md-12 mt-4 text-center"><input id="crud" name="crud" type="hidden" value="Planes"><input id="Accion" name="Accion" type="hidden" value="M_Planes"></div></form>');
          
          });
          //ELIMINAR MODIFICADOS
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
                        console.log(res);
                        if (res == 1) {
                            Swal.fire(
                                'Eliminado!',
                                'Eliminado con éxito!.',
                                'success'
                            )
                            console.log(id);
                            var eliminado = document.getElementById(id);
                            eliminado.style.display="none";
                        }
        
                        }).fail(function(data){
        
                        })
                    }
                    }   
        
                })
          })  
        }
        
        
      }).fail(function(data){
        console.log("error");
        alert("Datos Incorrectos");
          
      })    
  }
  else if (DD_Viene == "Catalogos") {
    var Accion = $('#Accion').val();
    var IDCatalogo = $('#IDCatalogo').val();
    var Genero = $('#Genero').val();
    var Detalle = $('#Detalle').val();
      $.ajax({
          url: 'Interfaz/Interfaz_Catalogos.php',
          type: 'POST',
          data: {'IDCatalogo': IDCatalogo, 'Genero': Genero, 'Detalle': Detalle, 'crud': Accion},
          
      }).done(function(res){
        console.log(res);
        //CUANDO SE GUARDA
        if (res == 1) {
          $.ajax({
            url: 'Interfaz/Interfaz_Catalogos.php',
            type: 'POST',
            data: {'Genero': Genero, 'Detalle': Detalle, 'crud': 'B_Catalogos'},
            
        }).done(function(res){
          IDCatalogoE = res.replace(/\s+/g, '');
          console.log(IDCatalogoE);
          var tr = '<tr id="'+IDCatalogoE+'"><td data-titulo="ID Catalogo:"><label id="IDCatalogo">'+IDCatalogoE+'</label></td><td data-titulo="Genero:">'+Genero+'</td><td data-titulo="Detalle:"> <label class="">'+Detalle+'</label></td><td><div class="acc" style="display:flex;justify-content:space-around;"><a href="#" IDCatalogo="'+IDCatalogoE+'" Genero="'+Genero+'" Detalle="'+Detalle+'"  data-toggle="modal" data-target="#modelId"  class="btn btn-warning btn-edit-catalogo" title="Editar" data-toggle="tooltip"><i class="fa-solid fa-pen-to-square"></i></a><a class="btn btn-danger btn-del" id="'+IDCatalogoE+'" href="#" donde="Delete/deleteCatalogos/deleteCatalogos.php?action=5&id='+IDCatalogoE+'"><i class="fa fa-trash"></i></a></div></td></tr>';
          $('#tablaCatalogos').prepend(tr);
          donde = IDCatalogoE;
          //ANIMACION AGREGADO
          $('#'+donde).css({"background-color":"rgba(34, 255, 0, 0.9)", "transition": "02s ease all"});
          setTimeout(function(){
            $('#'+donde).css({"background-color": "rgba(34, 255, 0, 0.7)", "transition": "02s ease all"});
          }, 1000);
          setTimeout(function(){
            $('#'+donde).css({"background-color": "rgba(34, 255, 0, 0.5)", "transition": "02s ease all"});
          }, 2000);
          setTimeout(function(){
            $('#'+donde).css({"background-color": "rgba(34, 255, 0, 0.3)", "transition": "02s ease all"});
          }, 3000);
          setTimeout(function(){
            $('#'+donde).css({"background-color": "rgba(34, 255, 0, 0.1)", "transition": "02s ease all"});
          }, 4000);
          setTimeout(function(){
            $('#'+donde).css({"background-color": "#343a40", "transition": "02s ease all"});
          }, 5000);

          //MODIFICAR CATALOGO AGREGADO
          $('.btn-edit-catalogo').on('click', function(e){
            const IDCatalogo = $(this).attr('IDCatalogo');
            const Genero = $(this).attr('Genero');
            const Detalle = $(this).attr('Detalle');
            $('#modal-title').html('Modificar Catalogo');
            $('#body-contenido').html('<form><div class="col-md-12"><label>Genero:</label><input type="text" name="Genero" id="Genero" class="form-control" maxlength="100" required  value="'+Genero+'"><input type="hidden" name="IDCatalogo" id="IDCatalogo" class="form-control" maxlength="100" value="'+IDCatalogo+'"></div><div class="col-md-12"><label>Detalle:</label><input type="text" name="Detalle" id="Detalle" class="form-control" maxlength="500" required value="'+Detalle+'"></div><div class="col-md-12 mt-5 text-center"><input id="crud" name="crud" type="hidden" value="Catalogos"><input id="Accion" name="Accion" type="hidden" value="M_Catalogos"></div></form>');
          
          });
          //ELIMINAR CATALOGO AGREGADO
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
                        console.log(res);
                        if (res == 1) {
                            Swal.fire(
                                'Eliminado!',
                                'Eliminado con éxito!.',
                                'success'
                            )
                            var eliminado = document.getElementById(id);
                            eliminado.style.display="none";
                        }
        
                        }).fail(function(data){
        
                        })
                    }
                    }   
        
                })
          })
        })  
        }
        //CUANDO SE MODIFICA
        if (res == 2) {
          var donde = $('#'+IDCatalogo).attr('id');
          var tr = ' <td data-titulo="ID Catalogo:"><label id="IDCatalogo">'+IDCatalogo+'</label></td><td data-titulo="Genero:">'+Genero+'</td><td data-titulo="Detalle:"> <label class="">'+Detalle+'</label></td><td><div class="acc" style="display:flex;justify-content:space-around;"><a href="#" IDCatalogo="'+IDCatalogo+'" Genero="'+Genero+'" Detalle="'+Detalle+'"  data-toggle="modal" data-target="#modelId"  class="btn btn-warning btn-edit-catalogo" title="Editar" data-toggle="tooltip"><i class="fa-solid fa-pen-to-square"></i></a><a class="btn btn-danger btn-del" id="'+IDCatalogo+'" href="#" donde="Delete/deleteCatalogos/deleteCatalogos.php?action=5&id='+IDCatalogo+'"><i class="fa fa-trash"></i></a></div></td>';
          $('#'+donde).html(tr);
          //ANIMACION DE PRUEBA DE COLOR(FUNCIONA)
          $('#'+donde).css({"background-color":"rgba(34, 255, 0, 0.9)", "transition": "02s ease all"});
          setTimeout(function(){
            $('#'+donde).css({"background-color": "rgba(34, 255, 0, 0.7)", "transition": "02s ease all"});
          }, 1000);
          setTimeout(function(){
            $('#'+donde).css({"background-color": "rgba(34, 255, 0, 0.5)", "transition": "02s ease all"});
          }, 2000);
          setTimeout(function(){
            $('#'+donde).css({"background-color": "rgba(34, 255, 0, 0.3)", "transition": "02s ease all"});
          }, 3000);
          setTimeout(function(){
            $('#'+donde).css({"background-color": "rgba(34, 255, 0, 0.1)", "transition": "02s ease all"});
          }, 4000);
          setTimeout(function(){
            $('#'+donde).css({"background-color": "#343a40", "transition": "02s ease all"});
          }, 5000);

          //MODIFICAR DE NUEVO EL MODIFICADO
          $('.btn-edit-catalogo').on('click', function(e){
            const IDCatalogo = $(this).attr('IDCatalogo');
            const Genero = $(this).attr('Genero');
            const Detalle = $(this).attr('Detalle');
            $('#modal-title').html('Modificar Catalogo');
            $('#body-contenido').html('<form><div class="col-md-12"><label>Genero:</label><input type="text" name="Genero" id="Genero" class="form-control" maxlength="100" required  value="'+Genero+'"><input type="hidden" name="IDCatalogo" id="IDCatalogo" class="form-control" maxlength="100" value="'+IDCatalogo+'"></div><div class="col-md-12"><label>Detalle:</label><input type="text" name="Detalle" id="Detalle" class="form-control" maxlength="500" required value="'+Detalle+'"></div><div class="col-md-12 mt-5 text-center"><input id="crud" name="crud" type="hidden" value="Catalogos"><input id="Accion" name="Accion" type="hidden" value="M_Catalogos"></div></form>');
          
          });
          //ELIMINAR MODIFICADOS
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
                        console.log(res);
                        if (res == 1) {
                            Swal.fire(
                                'Eliminado!',
                                'Eliminado con éxito!.',
                                'success'
                            )
                            console.log(id);
                            var eliminado = document.getElementById(id);
                            eliminado.style.display="none";
                        }
        
                        }).fail(function(data){
        
                        })
                    }
                    }   
        
                })
          })

        }
        else{
          console.log(Accion);
          console.log(IDCatalogo);
          console.log(Genero);
          console.log(Detalle);

        }
        
      }).fail(function(data){
        console.log("error");
        alert("Datos Incorrectos");
          
      })    
  }
  else if (DD_Viene == "Peliculas") {
    var Accion = $('#Accion').val();
    var Cedula = $('#Cedula').val();
    var Nombre = $('#Nombre').val();
    var Apellido = $('#Apellido').val();
      $.ajax({
          url: 'Interfaz/Interfaz_Usuarios.php',
          type: 'POST',
          data: {'Nombre': Nombre, 'Apellido': Apellido, 'Cedula': Cedula, 'crud': Accion},
          
      }).done(function(res){
        console.log(res);
        if (res == "1") {
          alert("Guardado");
          location.reload();
        }
        if (res == "2") {
          alert("Modificado");
          location.reload();
        }
        
      }).fail(function(data){
        console.log("error");
        alert("Datos Incorrectos");
          
      })    
  }
  else{
    console.log("SIN DIRECCION");
    console.log(DD_Viene);

  }
});


