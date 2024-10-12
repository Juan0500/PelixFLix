//VALIDACION DE INPUTS CUANDO CAMBIAN
    var ErrorCedula;
    //PARA VERIFICAR SI YA EXISTE LA CEDULA AL PERDER EL FOCO  
    $("#Cedula").blur(function(){
        VerificarCedula();
    });
   function VerificarCedula(){
    $.ajax({
        url:'Ajax.php',
        type:'POST',
        data:{'BuscarCedula':1,'Valor':$('#Cedula').val()},
    }).done(function(res){
        console.log(res);
        if (res == 1) {
            $('#CedulaSuccessMensaje').html('');
            $('#CedulaErrorMensaje').html('Cedula ya utilizada!');
            $('#Cedula').css('border','2px solid red');   
            $('#YaExCedula').val('1');   
            
        }

    })
   }  
    //CAMBIOS EN LOS INPUTS
    function ValidarCedula(){
        $('#YaExCedula').val('');  
        const numeros = RegExp('^[0-9]+$', 'i');
        //SOLO PERMITE NUMEROS
        if (numeros.test($("#Cedula").val())) {

            var CantDigitos = $("#Cedula").val().length;
            if($("#Cedula").val() == "0"){
                $("#Cedula").val(null);
            }
            else if (CantDigitos == 8) {
                $('#CedulaSuccessMensaje').html('Exito');
                $('#CedulaErrorMensaje').html('');
                $('#Cedula').css('border','2px solid green');
            }
            else{
                $('#CedulaSuccessMensaje').html('');
                $('#CedulaErrorMensaje').html('Incorrecto, se requieren 8 digitos!');
                $('#Cedula').css('border','2px solid red');
               
               
            }
        }
        else if($("#Cedula").val() == ""){
            $('#CedulaSuccessMensaje').html('');
            $('#CedulaErrorMensaje').html('Campo requerido!');
            $('#Cedula').css('border','2px solid red');
        }
        else{
            $('#CedulaSuccessMensaje').html('');
            $('#CedulaErrorMensaje').html('Solo se aceptan numeros.');
            $('#Cedula').css('border','2px solid red');
        }
    }
    function ValidarNombre() {
        var CantDigitos = $("#Nombre").val().length;
        if (CantDigitos >= 3) {
            $('#NombreSuccessMensaje').html('Exito');
            $('#NombreErrorMensaje').html('');
            $('#Nombre').css('border','2px solid green');
        }
        else if (CantDigitos == 0){
            $('#NombreSuccessMensaje').html('');
            $('#NombreErrorMensaje').html('Campo requerido!');
            $('#Nombre').css('border','2px solid red');
        }
        else{
            $('#NombreSuccessMensaje').html('');
            $('#NombreErrorMensaje').html('Minimo 4 caracteres!');
            $('#Nombre').css('border','2px solid red');
        }
    }
    function ValidarApellido(){
    //SOLO PERMITIRA LETRAS
        var CantDigitos = $("#Apellido").val().length;
        if (CantDigitos >= 3) {
            $('#ApellidoSuccessMensaje').html('Exito');
            $('#ApellidoErrorMensaje').html('');
            $('#Apellido').css('border','2px solid green');
        }
        else if( CantDigitos == 0){
            $('#ApellidoSuccessMensaje').html('');
            $('#ApellidoErrorMensaje').html('Campo Requerido!');
            $('#Apellido').css('border','2px solid red');
        }
        else{
            $('#ApellidoSuccessMensaje').html('');
            $('#ApellidoErrorMensaje').html('demasiado corto !');
            $('#Apellido').css('border','2px solid red');
        }
    }
    function ValidarUsuario(){
        //SOLO PERMITIRA LETRAS
        var CantDigitos = $("#Usuario").val().length;   
        if (CantDigitos >= 3) {
            $('#UsuarioSuccessMensaje').html('Exito');
            $('#UsuarioErrorMensaje').html('');
            $('#Usuario').css('border','2px solid green');
        }
        else if(CantDigitos == "0") {
            $('#UsuarioSuccessMensaje').html('');
            $('#UsuarioErrorMensaje').html('Campo Requerido!');
            $('#Usuario').css('border','2px solid red');
        }
        else{
            $('#UsuarioSuccessMensaje').html('');
            $('#UsuarioErrorMensaje').html('Demaciado corto');
            $('#Usuario').css('border','2px solid red');
        }
            
    }
    function ValidarPassword(){
        var CantDigitos = $("#Password").val().length;   
        if (CantDigitos >= 8) {
            $('#PasswordSuccessMensaje').html('Exito');
            $('#PasswordErrorMensaje').html('');
            $('#Password').css('border','2px solid green');
        }
        else if(CantDigitos == "0") {
            $('#PasswordSuccessMensaje').html('');
            $('#PasswordErrorMensaje').html('Campo Requerido!');
            $('#Password').css('border','2px solid red');
        }
        else{
            $('#PasswordSuccessMensaje').html('');
            $('#PasswordErrorMensaje').html('Minimo 8 caracteres');
            $('#Password').css('border','2px solid red');
        }
            
    }
    function ValidarGmail(){
        if($("#Gmail").val().indexOf('@', 0) != -1 && $("#Gmail").val().indexOf('.', 0) != -1) {
            var CantDigitos = $("#Gmail").val().length;   
            if (CantDigitos >= 8) {
                $('#GmailSuccessMensaje').html('Exito');
                $('#GmailErrorMensaje').html('');
                $('#Gmail').css('border','2px solid green');
            }
            else if(CantDigitos == "0") {
                $('#GmailSuccessMensaje').html('');
                $('#GmailErrorMensaje').html('Campo Requerido!');
                $('#Gmail').css('border','2px solid red');
            }
            else{
                $('#GmailSuccessMensaje').html('');
                $('#GmailErrorMensaje').html('Minimo 8 caracteres');
                $('#Gmail').css('border','2px solid red');
            }
        } 
        else{
            $('#GmailSuccessMensaje').html('');
            $('#GmailErrorMensaje').html('Incorrecto, ejemplo@ejemplo.com');
            $('#Gmail').css('border','2px solid red');
        }    
    }
    function ValidarN_Tarjeta(event){
        var CantDigitos = $("#N_Tarjeta").val().length;
        if(event.key === "Backspace"){  
        } 
        else{
        if (CantDigitos >= 16) {
            $('#N_TarjetaSuccessMensaje').html('Exito');
            $('#N_TarjetaErrorMensaje').html('');
            $('#N_Tarjeta').css('border','2px solid green');
        } 
        else if(CantDigitos == 0){
            $('#N_TarjetaSuccessMensaje').html('');
            $('#N_TarjetaErrorMensaje').html('Campo requerido!');
            $('#N_Tarjeta').css('border','2px solid red');
        }
        else{
            $('#N_TarjetaSuccessMensaje').html('');
            $('#N_TarjetaErrorMensaje').html('Incorrecto');
            $('#N_Tarjeta').css('border','2px solid red');
        }

        }
    }
    function ValidarSaldo(){
        var CantDigitos = $("#Saldo").val().length;
        if ( $('#Saldo').val() == 0) {
            $('#Saldo').val(null);
        }  
        if (CantDigitos > 2) {
            $('#SaldoSuccessMensaje').html('Exito');
            $('#SaldoErrorMensaje').html('');
            $('#Saldo').css('border','2px solid green');
        }
        else{
            $('#SaldoSuccessMensaje').html('');
            $('#SaldoErrorMensaje').html('Incorrecto!');
            $('#Saldo').css('border','2px solid red');
        }
        
    }
     function ValidarFecha_Vencimiento(){
        var Fecha = new Date();
        var año = Fecha.getFullYear();
        var mes = Fecha.getMonth() + 1;
        var dia = Fecha.getDate();
        var FechaF = año + '-' + mes + '-' + dia;
        if ($('#Fecha_Vencimiento').val() <= FechaF) {
            $('#Fecha_VencimientoSuccessMensaje').html('');
            $('#Fecha_VencimientoErrorMensaje').html('Fecha Invalida');
            $('#Fecha_Vencimiento').css('border','3px solid red');
        }
        else{
            $('#Fecha_VencimientoSuccessMensaje').html('Correcto');
            $('#Fecha_VencimientoErrorMensaje').html('');
            $('#Fecha_Vencimiento').css('border','3px solid green');
            
        }
    }
    


//PERMITIR SOLO LETRAS Y ESPACIOS EN NOMBRE Y APELLIDO
$("#Nombre").keypress(function (key) {
    if ((key.charCode < 97 || key.charCode > 122)//letras mayusculas
        && (key.charCode < 65 || key.charCode > 90) //letras minusculas
        && (key.charCode != 45) //retroceso
        && (key.charCode != 241) //ñ
         && (key.charCode != 209) //Ñ
         && (key.charCode != 32) //espacio
         && (key.charCode != 225) //á
         && (key.charCode != 233) //é
         && (key.charCode != 237) //í
         && (key.charCode != 243) //ó
         && (key.charCode != 250) //ú
         && (key.charCode != 193) //Á
         && (key.charCode != 201) //É
         && (key.charCode != 205) //Í
         && (key.charCode != 211) //Ó
         && (key.charCode != 218) //Ú

        )
        return false;
});
$("#Apellido").keypress(function (key)  {
    if ((key.charCode < 97 || key.charCode > 122) && (key.charCode < 65 || key.charCode > 90) && (key.charCode != 45) && (key.charCode != 241) && (key.charCode != 209)  && (key.charCode != 32)  && (key.charCode != 225)  && (key.charCode != 233)  && (key.charCode != 237)  && (key.charCode != 243)  && (key.charCode != 250)  && (key.charCode != 193)  && (key.charCode != 201)  && (key.charCode != 205)  && (key.charCode != 211) && (key.charCode != 218) ) return false;
});
//------------------------------//


//CAMBIAR CON BOTONES SUPERIORES
$('#tabUsuario').on('click', function(e) {
    $('#divUsuario').show();
    $('#divCuenta').hide();
    $('#divTarjeta').hide();
    $('#divPlan').hide();

    $('#tabUsuario').addClass("activeTab");
    $('#tabCuenta').removeClass("activeTab");
    $('#tabTarjeta').removeClass("activeTab");
    $('#tabPlan').removeClass("activeTab");
    
})
$('#tabCuenta').on('click', function(e) {
    $('#divUsuario').hide();
        $('#divCuenta').show();
        $('#divTarjeta').hide();
        $('#divPlan').hide();
    
        $('#tabUsuario').removeClass("activeTab");
        $('#tabCuenta').addClass("activeTab");
        $('#tabTarjeta').removeClass("activeTab");
        $('#tabPlan').removeClass("activeTab");  
})
$('#tabTarjeta').on('click', function(e) {
  
    $('#divUsuario').hide();
    $('#divCuenta').hide();
    $('#divTarjeta').show();
    $('#divPlan').hide();
    $('#tabUsuario').removeClass("activeTab");
    $('#tabCuenta').removeClass("activeTab");
    $('#tabTarjeta').addClass("activeTab");
    $('#tabPlan').removeClass("activeTab");
  
})
$('#tabPlan').on('click', function(e) {
  
    $('#divUsuario').hide();
    $('#divCuenta').hide();
    $('#divTarjeta').hide();
    $('#divPlan').show();
    $('#tabUsuario').removeClass("activeTab");
    $('#tabCuenta').removeClass("activeTab");
    $('#tabTarjeta').removeClass("activeTab");
    $('#tabPlan').addClass("activeTab");
  
})


//CAMBIAR DE FORMULARIO CON EL BOTON SIGUIENTE
//Cambiar de Usuario a Cuenta
$('#Next1').on('click', function(e) {
    VerificarCedula();
    var colorCedula = $('#Cedula').css('border-color');
    var colorNombre = $('#Nombre').css('border-color');
    var colorApellido = $('#Apellido').css('border-color');
    if (colorCedula == "rgb(0, 128, 0)" && colorNombre == "rgb(0, 128, 0)" && colorApellido == "rgb(0, 128, 0)" ) {
        $('#tabUsuario').removeClass("activeTab");
        $('#tabCuenta').addClass("activeTab");
        $('#divUsuario').hide();
        $('#divCuenta').show();
    }
    else{
        ValidarCedula();
        ValidarNombre();
        ValidarApellido();
    }
    
    
})
//Cambiar de Cuenta a Tarjeta
$('#Next2').on('click', function(e) {
    e.preventDefault();
    var colUsuario = $('#Usuario').css('border-color');
    var colPassword = $('#Password').css('border-color');
    var colGmail = $('#Gmail').css('border-color');
    
    //SI TODOS LOS CAMPOS ESTAN COMPLETOS
    if (colUsuario == "rgb(0, 128, 0)" && colPassword  == "rgb(0, 128, 0)" && colGmail == "rgb(0, 128, 0)") {
        $('#tabCuenta').removeClass("activeTab");
        $('#tabTarjeta').addClass("activeTab");
        $('#divCuenta').hide();
        $('#divTarjeta').show();
    }
    else{
        ValidarUsuario();
        ValidarPassword();
        ValidarGmail();

    }
})
//Cambiar de Tarjeta a Plan
$('#Next3').on('click', function(e) {
    e.preventDefault();
    var colN_Tarjeta = $('#N_Tarjeta').css('border-color');
    var colSaldo = $('#Saldo').css('border-color');
    var colFecha_Vencimiento = $('#Fecha_Vencimiento').css('border-color');

   
    
    //SI TODOS LOS CAMPOS ESTAN COMPLETOS
    if (colN_Tarjeta ==  "rgb(0, 128, 0)" && colSaldo == "rgb(0, 128, 0)" && colFecha_Vencimiento ==  "rgb(0, 128, 0)") {
        $('#tabTarjeta').removeClass("activeTab");
        $('#tabPlan').addClass("activeTab");
        $('#divTarjeta').hide();
        $('#divPlan').show();
    }
    else{
        ValidarN_Tarjeta(event);
        ValidarSaldo();
        ValidarFecha_Vencimiento();
    }
})
//SELECCIONAR PLAN
$('.divPlan').on('click', function(){
    //COMPROBAR QUE EL SALDO ES MAYOR AL PRECIO DEL PLAN
    var PrecioPlan = $(this).attr('Monto');
    var SaldoTarjeta = $('#Saldo').val();
    //CONVERTIR A ENTEROS
    PrecioPlanINT = parseInt(PrecioPlan);
    SaldoTarjetaINT = parseInt(SaldoTarjeta);
    if (PrecioPlanINT > SaldoTarjetaINT | SaldoTarjeta == "") {
       Swal.fire({
        icon:'error',
        title:'No tienes saldo para adquirir este plan!',
        html:'Compruebe el saldo de la Tarjeta.'
       }) 
       $('#divUsuario').hide();
       $('#divCuenta').hide();
       $('#divTarjeta').show();
       $('#divPlan').hide();
       $('#tabUsuario').removeClass("activeTab");
       $('#tabCuenta').removeClass("activeTab");
       $('#tabTarjeta').addClass("activeTab");
       $('#tabPlan').removeClass("activeTab");
       ValidarN_Tarjeta(event);
       ValidarSaldo();
       ValidarFecha_Vencimiento();
    }
    else{
        //OBTENER LA ID DEL PLAN
        var id = $(this).attr('IDPlan');
        //PASAR LA ID AL INPUT OCULTO
        document.getElementById("PlanSeleccionado").value=id;
        //QUITAR LOS ESTILOS DEL SELECCIONADO ANTERIORMENTE
        $('.divPlan').css({'border':'rgba(0,0,0,.3) 2px solid','background-color':'#fff','font-family': 'arial','color': 'black','font-size': '16px','padding-top': '10px','height': '50px','font-weight': 'normal','box-shadow': '0 0 0 transparent'})
        //DEJAR ESTILOS PARA RESALTAR EL SELECCIONADO
        $(this).css({'background-color':'#ff8623','font-family': 'cursive','color': '#f0f0f0','font-size': '+20px','padding-top': '15px','height': '60px','font-weight': 'bold','box-shadow': '5px 5px 3px rgb(0, 0, 0, 0.3)'})
        }
})
//ULTIMO BOTON PARA REGISTRARSE
$('#NextFin').on('click', function(e){
    ValidarCedula();
    VerificarCedula();
    ValidarNombre();
    ValidarApellido();
    ValidarUsuario();
    ValidarPassword();
    ValidarGmail();
    ValidarN_Tarjeta(event);
    ValidarSaldo();
    ValidarFecha_Vencimiento();


    //COMPROBAR QUE TODOS LOS INPUTS ESTEN COMPLETOS
    //OBTENER LOS ESTILOS DE LOS INPUTS PARA COMPROBAR SI QUE NO ESTEN INCORRECTOS(ROJOS)
    var colorCedula = $('#Cedula').css('border-color');
    var colorNombre = $('#Nombre').css('border-color');
    var colorApellido = $('#Apellido').css('border-color');
    var colorUsuario = $('#Usuario').css('border-color');
    var colorPassword = $('#Password').css('border-color');
    var colorGmail = $('#Gmail').css('border-color');
    var colorN_Tarjeta = $('#N_Tarjeta').css('border-color');
    var colorSaldo = $('#Saldo').css('border-color');
    var colorFecha_Vencimiento = $('#Fecha_Vencimiento').css('border-color');

    //CHECK DE TERMINOS Y CONDICIONES
    var check = $('#TerminosCondiciones');

    //COMPROBAR QUE SE SELECCIONO UN PLAN O UN PACK
    if ( $('#IDPlan').val() == "No" &&  $('#IDPack').val() != "No") {
      var Plan_Pack = true;
    }
    else if ( $('#IDPlan').val() != "No" &&  $('#IDPack').val() == "No") {
      var Plan_Pack = true;
    }
    else{
        var Plan_Pack = false;
    }
    

    //SI TODOS LOS INPUTS ESTAN CORRECTOS
    if (colorCedula != "rgb(255, 0, 0)" && colorNombre != "rgb(255, 0, 0)" && colorApellido != "rgb(255, 0, 0)" && colorUsuario != "rgb(255, 0, 0)" && colorPassword != "rgb(255, 0, 0)" && colorGmail != "rgb(255, 0, 0)" && colorN_Tarjeta != "rgb(255, 0, 0)" && colorSaldo != "rgb(255, 0, 0)" && colorFecha_Vencimiento != "rgb(255, 0, 0)" && Plan_Pack != false && check.is(':checked') == true ) {
        document.getElementById('form').submit();
        
    }
    //SI HAY INPUTS INCORRECTOS
    else{
        //IR AL MENU DEL CAMPO VACIO
        //SE DIRIGE AL PRIMER MENU QUE TIENE INPUTS CON BORDES ROJOS
       
        if ($('#YaExCedula').val() == 1) {
            $('#divUsuario').show();
            $('#divCuenta').hide();
            $('#divTarjeta').hide();
            $('#divPlan').hide();
        
            $('#tabUsuario').addClass("activeTab");
            $('#tabCuenta').removeClass("activeTab");
            $('#tabTarjeta').removeClass("activeTab");
            $('#tabPlan').removeClass("activeTab");

            Swal.fire({
                icon: 'error',
                title:'Formulario Incompleto!',
                text: 'Datos del Usuario incorrectos!.'
            }) 
        }
        else if (colorCedula != "rgb(0, 128, 0)" | colorNombre != "rgb(0, 128, 0)" | colorApellido != "rgb(0, 128, 0)") {
            $('#divUsuario').show();
            $('#divCuenta').hide();
            $('#divTarjeta').hide();
            $('#divPlan').hide();
        
            $('#tabUsuario').addClass("activeTab");
            $('#tabCuenta').removeClass("activeTab");
            $('#tabTarjeta').removeClass("activeTab");
            $('#tabPlan').removeClass("activeTab");

            Swal.fire({
                icon: 'error',
                title:'Formulario Incompleto!',
                text: 'Datos del Usuario incorrectos!.'
            }) 
        }
        else if (colorUsuario != "rgb(0, 128, 0)" | colorPassword != "rgb(0, 128, 0)" | colorGmail != "rgb(0, 128, 0)") {
            $('#divUsuario').hide();
            $('#divCuenta').show();
            $('#divTarjeta').hide();
            $('#divPlan').hide();
        
            $('#tabUsuario').removeClass("activeTab");
            $('#tabCuenta').addClass("activeTab");
            $('#tabTarjeta').removeClass("activeTab");
            $('#tabPlan').removeClass("activeTab");

            Swal.fire({
                icon: 'error',
                title:'Formulario Incompleto!',
                text: 'Datos de la Cuenta incorrectos.'
                }) 
        }
        else if (colorN_Tarjeta != "rgb(0, 128, 0)" | colorSaldo != "rgb(0, 128, 0)" | colorFecha_Vencimiento != "rgb(0, 128, 0)") {
            $('#divUsuario').hide();
            $('#divCuenta').hide();
            $('#divTarjeta').show();
            $('#divPlan').hide();
        
            $('#tabUsuario').removeClass("activeTab");
            $('#tabCuenta').removeClass("activeTab");
            $('#tabTarjeta').addClass("activeTab");
            $('#tabPlan').removeClass("activeTab");

            Swal.fire({
                icon: 'error',
                title:'Formulario Incompleto!',
                text: 'Datos de la Tarjeta incorrectos.'
                }) 
        }
        else if( Plan_Pack == false){
            Swal.fire({
                icon: 'error',
                title:'Formulario Incompleto!',
                text: 'Seleccione un Plan o un Pack para continuar!.'
            })   
        }
        else if(check.is(':checked') == false){
            Swal.fire({
                icon: 'error',
                title:'Formulario Incompleto!',
                text: 'Por favor acepte los términos y condiciones para proseguir.'
            })   
        } 
    }
})

