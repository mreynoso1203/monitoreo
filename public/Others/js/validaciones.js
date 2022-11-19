



















function generarVoucherWeb(){
    // Obtenemos los valores ingresados del pasajero
        var dni= $('#txtdni').val();
        var apellido= $('#txtnombre').val();
        var documento= $('#txtapellido').val();
        var nacimiento= $('#txtnacimiento').val();
        var sexo= $('#cbosexo').val();
        var telefono= $('#txttelefono').val();
        var nacionalidad= $('#cbonaci').val();
        var pais= $('#txtpais').val();
        var ciudad= $('#txtciudad').val();
        var distrito= $('#txtdistrito').val();
        var domicilio= $('#txtdomicilio').val();
        // alert(dni + ' ' + apellido + ' ' + documento + ' ' + nacimiento + ' ' + sexo + ' ' + telefono + ' ' + nacionalidad + ' ' + pais + ' ' + ciudad + ' ' + distrito + ' ' + domicilio);
}


function mostrarModalLoad(titulo, mensaje) {
    $('#modalLoad').modal('show');
    $('#titulomodalload').text(titulo);
    $('#mensajemodalload').text(mensaje);
}


$('#formServicioNuevo').validate({
    rules: {
        "txtnplanes": { required: true },
        "txtnbeneficio":{ required:true },
        "txtndescripcion":{ required:true },
    },
    submitHandler: function(form) {
        $.ajax({
            url: form.action,
            type: form.method,
            data: $(form).serialize(),
            success: function(response) {
                mostrarModal(response);
            }
        });
    }
});

$('#formBeneficioNuevo').validate({
    rules: {
        "txtNombre": { required: true },
    },
    submitHandler: function(form) {
        $.ajax({
            url: form.action,
            type: form.method,
            data: $(form).serialize(),
            success: function(response) {
                mostrarModal(response);
            }
        });
    }
});


$('#formPlanesNuevo').validate({
    rules: {
        "txtNombre": { required: true },
        "txtEdad": { required: true, number: true },
        "txtDiaMin": { required: true, number: true },
        "txtDiaMax": { required: true, number:true },
    },
    submitHandler: function(form) {
        $.ajax({
            url: form.action,
            type: form.method,
            data: $(form).serialize(),
            success: function(response) {
                mostrarModal(response);
            }
        });
    }
});

$('#formPromotoresNuevo').validate({
    rules: {
        "txtNombre": { required: true },
        "txtApellido": { required: true },
        "txtCorreo": { required: true, email:true },
        "txtTelefono": { required: true,number:true },
        "txtTelefono2": { number:true },
        "txtTelefono3": { number:true },
    },
    submitHandler: function(form) {
        $.ajax({
            url: form.action,
            type: form.method,
            data: $(form).serialize(),
            success: function(response) {
                mostrarModal(response);
            }
        });
    }
});

$('#formCountersNuevo').validate({
    rules: {
        "txtNombre": { required: true },
        "txtApellido": { required: true },
        "txtCorreo": { required: true, email: true },
        "txtTelefono": { required: true, number: true },
        "txtRuc": { required: true, number: true },
        "txtTipo": { required: true },
        "txtUsuario": { required: true },
        "txtClave": { required: true },
    },
    submitHandler: function(form) {
        $.ajax({
            url: form.action,
            type: form.method,
            data: $(form).serialize(),
            success: function(response) {
                mostrarModal(response);
            }
        });
    }
});

$('#formCountersEditar').validate({
    rules: {
        "txtNombre": { required: true },
        "txtApellido": { required: true },
        "txtCorreo": { required: true, email: true },
        "txtTelefono": { required: true, number: true },
    },
    submitHandler: function(form) {
        $.ajax({
            url: form.action,
            type: form.method,
            data: $(form).serialize(),
            success: function(response) {
                mostrarModal(response);
            }
        });
    }
});
$('#formPasajerosEditar').validate({
    rules: {
        "txtnombre": { required: true },
        "txtapellido": { required: true },
        "txtdomicilio": { required: true},
        "txtNacimiento": { required: true},
        "txtSexo": { required: true},
        "txttel": { required: true, number: true},
        "txttel2": { number: true},
        "txttel3": { number: true},
        "txtcorreo": { email: true},
        "txtNacionalidad": { required: true},
        "txtpais": { required: true},
        "txtciudad": { required: true},
        "txtname": { required: true},
        "txtlname": { required: true},
        "txtphone": { required: true, number: true},
    },
    submitHandler: function(form) {
        $.ajax({
            url: form.action,
            type: form.method,
            data: $(form).serialize(),
            success: function(response) {
                mostrarModal(response);
            }
        });
    }
});

$('#formAgenciasNuevo').validate({
    rules: {
        "txtNombre": { required: true },
        "txtApellido": { required: true },
        "txtCorreo": { required: true, email: true },
        "txtUsuario": { required: true },
        "txtClave": { required: true },
        "txtTelefono": { required: true, number: true },
        "txtTelefono2": { number: true },
        "txtTelefono3": { number: true },
        "txtRuc": { required: true, number: true },
        "txtPromotor": { required: true },
        "txtNombreAgencia": { required: true },
        "txtDireccion": { required: true },
    },
    submitHandler: function(form) {
        $.ajax({
            url: form.action,
            type: form.method,
            data: $(form).serialize(),
            success: function(response) {
                mostrarModal(response);
            }
        });
    }
});

$('#formAgenciasEditar').validate({
    rules: {
        "txtNombre": { required: true },
        "txtApellido": { required: true },
        "txtCorreo": { required: true, email: true },
        "txtUsuario": { required: true },
        "txtTelefono": { required: true, number: true },
        "txtTelefono2": { number: true },
        "txtTelefono3": { number: true },
        "txtRuc": { required: true, number: true },
        "txtPromotor": { required: true },
        "txtNombreAgencia": { required: true },
        "txtDireccion": { required: true },
    },
    submitHandler: function(form) {
        $.ajax({
            url: form.action,
            type: form.method,
            data: $(form).serialize(),
            success: function(response) {
                mostrarModal(response);
            }
        });
    }
});

$('#formVoucherNuevo').validate({

    rules: {
        "cboclasificacion":{required:true},
        "nroparte":{required:true},
        "descripcion":{required:true},
        "fileimagen1":{required:true},
        // "fileimagen2":{required:true},
        // "fileimagen3":{required:true},
    },
    submitHandler: function(form) {
        var nroparte = $('#nroparte').val();
        var descripcion = $('#descripcion').val();

        var fileimagen1 = $('#fileimagen1').prop('files');
        var fileimagen2 = $('#fileimagen2').prop('files');
        var fileimagen3 = $('#fileimagen3').prop('files');
        var cboclasificacion = $('#cboclasificacion').val();
        var parametros={
            'nroparte':nroparte,
            'descripcion':descripcion,
            'fileimagen1':fileimagen1,
            'fileimagen2':fileimagen2,
            'fileimagen3':fileimagen3,
            'cboclasificacion':cboclasificacion
        };
        $.ajax({
            url: form.action,
            type: form.method,
            data: parametros,
            beforeSend: function () {
              mostrarModalLoad('Realizando Cambios', 'Por favor espere el mensaje de confirmación.');
            },
            success: function(response) {
                $('#modalLoad').modal('hide');
                mostrarModal(response);
            },
            error: function(response) { 
                mostrarModalLoad(response);
            },
            complete: function(response) {
                mostrarModalLoad(response);
            },

        });
    }
});


$('#formVoucherActualizar').validate({

    rules: {
        "cboclasificacion":{required:true},
        "nroparte":{required:true},
        "descripcion":{required:true},
    },
    submitHandler: function(form) {
        var nroparte = $('#nroparte').val();
        var descripcion = $('#descripcion').val();
        var fileimagen1 = $('#fileimagen1').prop('files');
        var fileimagen2 = $('#fileimagen2').prop('files');
        var fileimagen3 = $('#fileimagen3').prop('files');
        var cboclasificacion = $('#cboclasificacion').val();
        
        var img01 = $('#img01').val();
        var img02 = $('#img02').val();
        var img03 = $('#img03').val();

        var parametros={
            'nroparte':nroparte,
            'descripcion':descripcion,
            'fileimagen1':fileimagen1,
            'fileimagen2':fileimagen2,
            'fileimagen3':fileimagen3,
            'cboclasificacion':cboclasificacion,
            'img01':img01,
            'img02':img02,
            'img03':img03
        };
        $.ajax({
            url: form.action,
            type: form.method,
            data: parametros,
            beforeSend: function () {
              mostrarModalLoad('Realizando Cambios', 'Por favor espere el mensaje de confirmación.');
            },
            success: function(response) {
                $('#modalLoad').modal('hide');
                mostrarModal(response);
            },
            error: function(response) { 
                mostrarModalLoad(response);
            },
            complete: function(response) {
                mostrarModalLoad(response);
            },

        });
    }
});


$('#frmnewcob').submit(function(e){
    e.preventDefault();
    if($('input[name="codvoucher[]"]').length){
        if($('input[name="txtagenruc"]').val() != ""){
            if($('input[name="txtpromotor"]').val() != ""){
                $.ajax({
                    type: $('#frmnewcob').attr('method'),
                    url: $('#frmnewcob').attr('action'),
                    data: $('#frmnewcob').serialize(),
                    success: function(response) {
                        mostrarModal(response);
                    }
                });
            }else{
                mostrarModalErrorVar('Cobranza','Debe ingresar el código del promotor asignado a la agencia.');
            }
        }else{
            mostrarModalErrorVar('Cobranza','Debe ingresar el nombre de la agencia para emitir el documento de cobranza.');
        }
    }else{
        mostrarModalErrorVar('Cobranza','No existe ningun voucher agregado.');
    }
});

$('#formPreciosNuevo').validate({
    rules: {
        "txtCosto": { required: true, number: true },
        "txtDia": { required: true, number: true },
    },
    submitHandler: function(form) {
        $.ajax({
            url: form.action,
            type: form.method,
            data: $(form).serialize(),
            success: function(response) {
                mostrarModal(response);
            }
        });
    }
});
/* fin de validaciones */


var seleccionados = new Array();
function selExp( id )
{
    var id = id.toString();
    console.log(id);
    const existe = seleccionados.indexOf(id);
    if (existe > -1)
    {
        seleccionados.splice(existe, 1);
        $('#sel'+id).removeClass('btn-success');
        $('#sel'+id).addClass('btn-default');
    }
    else
    {
        seleccionados.push(id);
        $('#sel'+id).removeClass('btn-default');
        $('#sel'+id).addClass('btn-success');
    }
}

$('#idBtnExportar').click(function(e){
    if($('#modoExp1').prop('checked'))
    {
        var int=[];
        var i = 0;
        if (seleccionados.length > 0)
        {
            $.each(seleccionados,function(index,element){
                int[i++] = element;
            });
        }
        if (int.length > 0)
        {
            $('#exportSelec').val(seleccionados);
            $('#frmExportSel').submit();
            $('#modalExportar').modal('hide');
        }
        else
        {
            $('#idMensajeExp').text('Debe seleccionar una fila para la exportación').show('slow');
            setTimeout(function () {
                $('#idMensajeExp').text('').hide('slow');
            },2500);
        }
    }
    else
    {
        if ($('#txtfd').val() == '')
        {
            $('#idMensajeExp').text('El campo DESDE se encuentra vacío').show('slow');
            setTimeout(function () {
                $('#idMensajeExp').text('').hide('slow');
            },2500);
        }
        else if ($('#txtfh').val() == '')
        {
            $('#idMensajeExp').text('El campo HASTA se encuentra vacío').show('slow');
            setTimeout(function () {
                $('#idMensajeExp').text('').hide('slow');
            },2500);
        }
        else
        {
            $('#frmexport').submit();
            $('#modalExportar').modal('hide');
        }
    }
});