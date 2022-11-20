<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Información Principal</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Inicio</a></li>
                                <li class="breadcrumb-item active">Información</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <!--DETALLE CASOS--->
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingOne">
                                    <button class="accordion-button fw-medium" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="true" aria-controls="flush-collapseOne">
                                        Detalle de página inicio
                                    </button>
                                </h2>
                                <div id="flush-collapseOne" class="accordion-collapse collapse show" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                    <!-- Informaciòn Principal -->
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="">Distrito</label>
                                                                <input type="text" class="form-control" id="t_distrito" placeholder="Distrito" required>
                                                            </div>
                                                        </div>                                
                                                        <div class="col-md-8">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="">Dirección</label>
                                                                <input type="text" class="form-control" id="t_direccion" placeholder="Dirección Principal" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="">Central Telefónica</label>
                                                                <input type="text" class="form-control" id="t_celular" placeholder="Central telefónica" required>
                                                            </div>
                                                        </div>                                
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="">WhatSapp</label>
                                                                <input type="text" class="form-control" id="t_whatsapp" placeholder="Número de Whatsapp" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="validationCustom01">Correo</label>
                                                                <input type="text" class="form-control" id="t_correo" placeholder="Correo electrónico" required>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-12">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="validationCustom01">Descripción Breve (Pie de Página)</label>
                                                                <textarea type="text" class="form-control" id="t_des_breve" placeholder=""></textarea>
                                                            </div>
                                                        </div>  
                                                        
                                                        <div class="col-md-12">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="validationCustom01">Walink - Botón WhatSapp</label>
                                                                <textarea type="text" class="form-control" id="t_des_walink" placeholder="Walink de whatsapp"></textarea>
                                                            </div>
                                                        </div>  

                                                    </div>
                                                    <button class="btn btn-danger" onclick="actualizar_inf_principal();" >Actualizar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>                                
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingTwo">
                                    <button class="accordion-button fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                        Iconos Redes
                                    </button>
                                </h2>
                                <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                    <!-- Informaciòn Redes -->
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="row" id="pnl_redes">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>                                
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingThree">
                                    <button class="accordion-button fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                        Sliders
                                    </button>
                                </h2>
                                <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                    <div class="card">
                                        <div class="card-header">
                                            <div style="display:flex;justify-content: space-between;">
                                                <button class="btn btn-sm btn-danger" onclick="agregar('slider',0);"><i class="fas fa-plus"></i>Agregar</button>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div id="panel_slider">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-heading4">
                                    <button class="accordion-button fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse4" aria-expanded="false" aria-controls="flush-collapse4">
                                        Sección Banner Nosotros
                                    </button>
                                </h2>
                                <div id="flush-collapse4" class="accordion-collapse collapse" aria-labelledby="flush-heading4" data-bs-parent="#accordionFlushExample">
                                    <div class="card">
                                        <div class="card-header" style="display:none;">
                                            <div style="display:flex;justify-content: space-between;">
                                                <button class="btn btn-sm btn-danger" onclick="agregar('banner',0);"><i class="fas fa-plus"></i>Agregar</button>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div id="panel_banner">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-heading5">
                                    <button class="accordion-button fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse5" aria-expanded="false" aria-controls="flush-collapse5">
                                        Sección Productos de Calidad
                                    </button>
                                </h2>
                                <div id="flush-collapse5" class="accordion-collapse collapse" aria-labelledby="flush-heading5" data-bs-parent="#accordionFlushExample">
                                    <div class="card">
                                        <div class="card-header">
                                        </div>
                                        <div class="card-body">
                                            <div id="panel_seccion">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>                                                        
                        </div><!-- end accordion -->
                    </div><!-- end card-body -->
                </div><!-- end card -->
            </div><!-- end col -->
        
        </div>
    </div>
    
</div>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<script>

    $(document).ready(function() {
        obtener_datos();
        obtener_datos_redes(); 
        obtener_datos_slider();
        obtener_datos_banner();
        obtener_datos_seccion();
    });

    function obtener_datos(){
        $.ajax({
            type: "POST",
            url: '<?php echo base_url();?>C_web_informacion/obtener_datos',
            data: {
            }, 
            beforeSend:function(){
            },   
            success: function(data){ 
                if(data=='noexiste'){
                    alertify.error('La descripción no existe.');
                    //alertas('danger','La descripción no existe');
                }else{
                    var json         = eval("(" + data + ")");
                    $('#t_distrito').val($.trim(json.t_distrito));
                    $('#t_direccion').val($.trim(json.t_direccion));
                    $('#t_celular').val($.trim(json.t_celular));
                    $('#t_whatsapp').val($.trim(json.t_whatsapp));
                    $('#t_correo').val($.trim(json.t_correo));
                    $('#t_des_breve').val($.trim(json.t_des_breve));
                    $('#t_des_walink').val($.trim(json.t_des_walink));
                }
            }
        });

    }

    function obtener_datos_redes(){
        $.ajax({
            type: "POST",
            url: '<?php echo base_url();?>C_web_informacion/obtener_datos_redes',
            data: {
            }, 
            beforeSend:function(){
            },   
            success: function(data){ 
                if(data=='noexiste'){
                    alertify.error('La descripción no existe.');
                    //alertas('danger','La descripción no existe');
                }else{
                    var json         = eval("(" + data + ")");
                    $('#pnl_redes').html($.trim(json.datos));
                }
            }
        });

    }

    function actualizar_inf_principal(){
        let t_distrito  = $('#t_distrito').val();
        let t_direccion = $('#t_direccion').val();
        let t_celular   = $('#t_celular').val();
        let t_whatsapp  = $('#t_whatsapp').val();
        let t_correo    = $('#t_correo').val();
        let t_des_breve = $('#t_des_breve').val();
        let t_des_walink = $('#t_des_walink').val();

        if(t_distrito!='' ){
            $.ajax({
                type: "POST",
                url: '<?php echo base_url();?>C_web_informacion/actualizar_inf_principal',
                data: {
                    't_distrito':t_distrito,
                    't_direccion':t_direccion,
                    't_celular':t_celular,
                    't_whatsapp':t_whatsapp,
                    't_correo':t_correo,
                    't_des_breve':t_des_breve,
                    't_des_walink':t_des_walink
                }, 
                beforeSend:function(){
                },   
                success: function(data){ 
                    if(data=='duplicado'){
                        alertify.error('La descripción ingresada no se encuentra disponible.');
                        //alertas('danger','La descripción ingresada ya se encuentra registrada');
                    }else{
                        alertify.success('La descripción ha sido actualizada correctamente.');
                    }
                }
            });
        }else{
            alertify.error('Ingresé una descripción obligatoria.');
        }
    }

    function actualizar_inf_redes(id){
        let t_redes_descripcion    = $('#t_redes_descripcion_'+id).val();
        let t_redes_icono          = $('#t_redes_icono_'+id).val();
        let t_redes_url            = $('#t_redes_url_'+id).val();
        let t_redes_estado         = $('#t_redes_estado_'+id).val();

        if(t_redes_descripcion!='' ){
            $.ajax({
                type: "POST",
                url: '<?php echo base_url();?>C_web_informacion/actualizar_inf_redes',
                data: {
                    't_redes_descripcion':t_redes_descripcion,
                    't_redes_icono':t_redes_icono,
                    't_redes_url':t_redes_url,
                    't_redes_estado':t_redes_estado,
                    'id':id
                }, 
                beforeSend:function(){
                },   
                success: function(data){ 
                    if(data=='duplicado'){
                        alertify.error('La descripción ingresada no se encuentra disponible.');
                        //alertas('danger','La descripción ingresada ya se encuentra registrada');
                    }else{
                        alertify.success('La descripción ha sido actualizada correctamente.');
                    }
                }
            });
        }else{
            alertify.error('Ingresé una descripción obligatoria.');
        }
    }

    function alertas(tipo,mensaje){
        switch (tipo) {
            case 'success':
                $('#mensaje-success').text(mensaje);
                $('#alert-success').fadeIn();
                setInterval(() => {
                    $('#alert-success').fadeOut();
                }, 3000);                
                break;
            case 'danger':
                $('#mensaje-danger').text(mensaje);
                $('#alert-danger').fadeIn();
                setInterval(() => {
                    $('#alert-danger').fadeOut();
                }, 3000);                
                break;                
            default:
                break;
        }
    }


    /*OBTENER BANNERS*/
    function obtener_datos_banner(){
        $.ajax({
            type: "POST",
            url: '<?php echo base_url();?>C_web_informacion/obtener_datos_banner',
            data: {
            }, 
            beforeSend:function(){
            },   
            success: function(data){ 
                if(data=='noexiste'){
                    alertify.error('La descripción no existe.');
                    //alertas('danger','La descripción no existe');
                }else{
                    var json         = eval("(" + data + ")");
                    $('#panel_banner').html($.trim(json.datos));
                }
            }
        });

    }

    function obtener_datos_seccion(){
        $.ajax({
            type: "POST",
            url: '<?php echo base_url();?>C_web_informacion/obtener_datos_seccion',
            data: {
            }, 
            beforeSend:function(){
            },   
            success: function(data){ 
                if(data=='noexiste'){
                    alertify.error('La descripción no existe.');
                    //alertas('danger','La descripción no existe');
                }else{
                    var json         = eval("(" + data + ")");
                    $('#panel_seccion').html($.trim(json.datos));
                }
            }
        });

    }

    /*DETALLE PRODUCTOS*/
    function obtener_datos_slider(){
        $.ajax({
            type: "POST",
            url: '<?php echo base_url();?>C_web_informacion/obtener_datos_slider',
            data: {
            }, 
            beforeSend:function(){
            },   
            success: function(data){ 
                if(data=='noexiste'){
                    alertify.error('La descripción no existe.');
                    //alertas('danger','La descripción no existe');
                }else{
                    var json         = eval("(" + data + ")");
                    $('#panel_slider').html($.trim(json.datos));
                }
            }
        });

    }

    function actualizar(tipo,id,id_prod){
        let input1 = ''; 
        let input2 = ''; 
        let input3 = ''; 
        let input4 = ''; 
        let input5 = ''; 
        let input6 = ''; 
        let file = ''; 

        switch (tipo) {
            case 'slider':
                input1  = $('#t_texto1_'+id).val();
                input2  = $('#t_texto2_'+id).val();
                input3  = $('#t_texto3_'+id).val();
                input4  = $('#t_texto_walink_slider_'+id).val();
                input5 = $('#t_texto_boton_'+id).val();
                input6 = $('#select_activo_'+id).val();
                file    = 'file_slider_'+id;
                break;
            case 'banner':
                input1  = $('#t_texto_walink_banner_'+id).val();
                file    = 'file_banner_'+id;
                break;
            case 'seccion':
                input1  = $('#t_seccion_texto1_'+id).val();
                input2  = $('#t_seccion_texto2_'+id).val();
                input3  = $('#t_seccion_texto_boton_'+id).val();
                input4  = $('#t_seccion_link_'+id).val();
                file    = 'file_seccion_'+id;
                break;                
            default: 
                break;
        }
        $.ajax({
            type: "POST",
            url: '<?php echo base_url();?>C_web_informacion/actualizar',
            data: {
                't_texto1_':input1,
                't_texto2_':input2,
                't_texto3_':input3,
                't_texto_walink_':input4,
                't_texto_boton_':input5,
                'select_activo_':input6,
                'tipo':tipo,
                'id':id

            }, 
            beforeSend:function(){
            },   
            success: function(data){ 
                if(data=='noexiste'){
                    alertify.error('La descripción no existe.');
                }else{
                    //alertify.success('Actualización realizada correctamente.');
                    switch (tipo) {
                        case 'slider':
                            var imgVal = $('#'+file).val(); 
                            if(imgVal==''){ 
                                obtener_datos();
                                notificacion('Actualización  '+tipo,'Se actualizó correctamente la '+tipo+'.','success');
                            }else{
                                subir_foto(file,tipo,id);
                            }
                            break;
                        case 'banner':
                            var imgVal = $('#'+file).val(); 
                            if(imgVal==''){ 
                                obtener_datos();
                                notificacion('Actualización  '+tipo,'Se actualizó correctamente la '+tipo+'.','success');
                            }else{
                                subir_foto(file,tipo,id);
                            }
                            // obtener_datos_slider();
                            break; 
                        case 'seccion':
                            var imgVal = $('#'+file).val(); 
                            if(imgVal==''){ 
                                obtener_datos();
                                notificacion('Actualización  '+tipo,'Se actualizó correctamente la '+tipo+'.','success');
                            }else{
                                subir_foto(file,tipo,id);
                            }
                            break;                             
                        default:
                            break;
                    }
                }
            }
        });

    }

    function subir_foto(file_,tipo,id){
            /*Con evento carga*/
            var inputfile = document.getElementById(file_);
            var file      = inputfile.files[0];
            var xhr = new XMLHttpRequest();
            (xhr.upload || xhr).addEventListener('progress', function(e) {
                //var done = e.position || e.loaded;
                //var total = e.totalSize || e.total;
                //var carg = Math.round(done/total*100);
                //$("#progressBar_img").val(carg);
                //$('#loaded_n_total_img').text(carg + ' % ');
            });
            xhr.addEventListener('load', function(e) {
                    var json         = eval("(" + this.responseText + ")");
                    if($.trim(json.valida)=='si'){
                        switch (tipo) {
                            case 'slider':
                                $('#file_slider'+id).val('');
                                obtener_datos_slider();
                                break;
                            case 'banner':
                                $('#file_banner_'+id).val('');
                                obtener_datos_banner();
                                break;   
                            case 'seccion':
                                $('#file_seccion_'+id).val('');
                                obtener_datos_seccion();
                                break;                                                                
                            default:
                                break;
                        }            
                        //var  caden  = '<?php //echo base_url();?>public/images/tag/'+json.imagen;
                        //$('#img_foto').attr('src',caden);
                        //$('#img_foto_2').attr('src',caden);
                       // alertify.success('success','Foto de perfil actualizada.');
                       notificacion('Foto '+tipo,'Foto de la '+tipo+' actualizada correctamente','success');
                    }else{
                       notificacion('Foto '+tipo,'Hubo un error en actualizar correctamente la foto.','error');
                    }
            });
            xhr.addEventListener('error', function(e) {
                notificacion('Foto Cabecera','Ocurrió un error en actualizar, vuelva a intentarlo','error');
            });  
            
            xhr.addEventListener('abort', function(e) {
                notificacion('Foto Cabecera','Ocurrió un error en actualizar, vuelva a intentarlo','error');
            });     
            xhr.open('post', '<?php echo base_url();?>C_web_informacion/subir_foto', true);
            
            var data = new FormData;
            data.append('file', file);
            data.append('tipo', tipo);
            data.append('id', id);
            xhr.send(data);          
    }

    function agregar(tipo,id){
        $.ajax({
            type: "POST",
            url: '<?php echo base_url();?>C_web_informacion/agregar',
            data: {
                'tipo':tipo,
                'id':id
            }, 
            beforeSend:function(){
            },   
            success: function(data){ 
                if(data!='0'){
                    notificacion('Registro '+tipo,'Registro correcto de la '+tipo+', actualice los registros solicitados.','success');
                    switch (tipo) {
                        case 'slider':
                            obtener_datos_slider();
                            break;
                        case 'banner':
                            obtener_datos_banner();
                            break;                            
                        default:
                            break;
                    }

                }else{
                    notificacion('Registro '+tipo,' Ocurrió un error en agregar, vuelva a intentarlo','error');
                }
            }
        });
    }

    function eliminar(tipo,id,id_produc){
        alertify.confirm("¿Està seguro de eliminar el registro?.",
        function(){
            $.ajax({
                type: "POST",
                url: '<?php echo base_url();?>C_web_informacion/eliminar',
                data: {'id':id,'tipo':tipo}, 
                beforeSend:function(){
                },   
                success: function(data){
                    if(data=='error'){
                        notificacion('Eliminar '+tipo,'Ocurrió un error en agregar, vuelva a intentarlo','error');
                    }else{
                        notificacion('Eliminar '+tipo,'Distribuidor eliinado correctamente','success');
                        switch (tipo) {
                            case 'slider':
                                obtener_datos_slider();
                                break;
                            default:
                                break;
                        }
                    }
                }
            });            
        },
        function(){
            alertify.error('Cancel');
        });   
    }
</script>