<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">





                    <!-- Informaciòn Distribuidores -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Productos</h4>
                            <p class="card-title-desc">Agregue, edite y elimine productos registrados. Las imagenes de los productos deben tener un resolución de <strong>544 x 667 pixeles</strong>.</p>
                        </div>
                        <div class="card-body">
                            <div style="display:flex;justify-content: space-between;">
                                <button class="btn btn-sm btn-danger" onclick="agregar('productos',0);"><i class="fas fa-plus"></i>Agregar</button>
                                <div style="display:flex;width:300px">
                                    <input  style="width:250px;" type="text" class="form-control form-control-sm" id="t_busqueda_productos" placeholder="Nombre del producto" onchange="obtener_datos_productos();" >
                                    <button class="btn btn-sm btn-secondary"><i class="dripicons dripicons-search"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row" id="panel_productos">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<script>

    $(document).ready(function() {
        //obtener_datos_caracteristicas();
        obtener_datos_productos();
        //obtener_datos_redes(); 
    });

    /*CARGA DE FOTOS*/
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
                            case 'caracteristica':
                                $('#img_caracteristica_'+id).val('');
                                break;
                            case 'productos':
                                $('#img_producto_'+id).val('');
                                break;
                            case 'fotos':
                                obtener_datos_fotos(tipo,id);
                                //$('#img_producto_'+id).val('');
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
            xhr.open('post', '<?php echo base_url();?>C_web_producto/subir_foto', true);
            
            var data = new FormData;
            data.append('file', file);
            data.append('tipo', tipo);
            data.append('id', id);
            xhr.send(data);          
    }

    function agregar(tipo,id){
        $.ajax({
            type: "POST",
            url: '<?php echo base_url();?>C_web_producto/agregar',
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
                        case 'caracteristica':
                            obtener_datos_caracteristicas();
                            break;
                        case 'productos':
                            obtener_datos_productos();
                            break;
                        case 'detalle':
                            obtener_datos_detalle('productos',id);
                            break;                                            
                        default:
                            break;
                    }

                }else{
                    notificacion('Registro '+tipo,'Ocurrió un error en agregar, vuelva a intentarlo','error');
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

        let input7 = ''; 
        let input8 = ''; 
        let input9 = ''; 
        let input10 = ''; 

        let input11 = ''; 

        let input12 = ''; 
        let input13 = ''; 
        let input14 = ''; 

        let file = ''; 

        switch (tipo) {
            case 'caracteristica':
                input1 = '#t_descripcion_caracteristica_'+id;
                file = 'file_caracteristica_'+id;
                break;
            case 'productos':
                input1 = '#t_nombre_productos_'+id;
                input2 = '#t_descripcion_productos_'+id;
                input3 = '#select_marca_'+id;
                input4 = '#select_categoria_'+id;
                input11 = '#select_activo_'+id;
                file = 'file_productos_'+id;
                
                break;  
            case 'detalle':
                input5 = '#select_detalle_producto_'+id;
                input6 = '#text_detalle_des_'+id;
                break;  
            case 'slider':
                input7 = '#text_slider_texto1_'+id;
                input8 = '#text_slider_texto2_'+id;
                input9 = '#text_slider_texto3_'+id;
                input10= '#text_slider_textoboton_'+id;
                input13= '#text_boton_whatsapp_'+id;
                input14= '#text_url_whatsapp_'+id;
                file = 'file_slider_'+id;
                break;     
            case 'fotos':
                file = 'file_fotos_';
                break;
            case 'redes':
                input12= '#t_descripcion_url_'+id;
                break;
            case 'pdf':
                file= '#file_pdf_'+id;
                break;                                                  
            default:
                break;
        }

        let t_nombre   = $(input1).val();
        
        //para productos
        let t_descripcion   = $(input2).val();
        let id_marca   = $(input3).val();
        let id_categoria   = $(input4).val();
        let activo   = $(input11).val();

        //Para detalle
        let id_caracteristica   = $(input5).val();
        let t_carac_descrip   = $(input6).val();

        //Para slider
        let t_texto1   = $(input7).val();
        let t_texto2   = $(input8).val();
        let t_texto3   = $(input9).val();
        let t_textobotton   = $(input10).val();
        let t_btn_whatsapp   = $(input13).val();
        let t_url_whatsapp   = $(input14).val();

        //redes
        let t_redes   = $(input12).val();
        
        $.ajax({
            type: "POST",
            url: '<?php echo base_url();?>C_web_producto/actualizar',
            data: {
                't_descripcion':t_descripcion,
                'id_marca':id_marca,
                'id_categoria':id_categoria,
                't_nombre':t_nombre,
                'tipo':tipo,
                'id':id,
                'id_prod':id_prod,
                'id_caracteristica':id_caracteristica,
                'descripcion':t_carac_descrip,
                'texto_1':t_texto1,
                'texto_2':t_texto2,
                'texto_3':t_texto3,
                'texto_boton':t_textobotton,
                'pag_inicio':activo,
                't_redes':t_redes,
                't_btn_whatsapp':t_btn_whatsapp,
                't_url_whatsapp':t_url_whatsapp

            }, 
            beforeSend:function(){
            },   
            success: function(data){ 
                if(data=='noexiste'){
                    alertify.error('La descripción no existe.');
                }else{
                    //alertify.success('Actualización realizada correctamente.');
                    switch (tipo) {
                        case 'caracteristica':
                            obtener_datos_caracteristicas();
                            subir_foto(file,tipo,id);
                            break;
                        case 'productos':
                            obtener_datos_productos();
                            subir_foto(file,tipo,id);
                            break; 
                        case 'detalle':
                            obtener_datos_detalle(tipo,id_prod);
                             notificacion('Registro '+tipo,'Detalle actualizado correctamente.','success');
                            break;  
                        case 'slider':
                            obtener_datos_slider(tipo,id_prod);
                            subir_foto(file,tipo,id);
                            //notificacion('Registro '+tipo,'Slider Detalle actualizado correctamente.','success');
                            break; 
                        case 'fotos':
                            subir_foto(file,tipo,id_prod);
                            obtener_datos_fotos(tipo,id_prod);
                            //notificacion('Registro '+tipo,'Slider Detalle actualizado correctamente.','success');
                            break;
                        case 'pdf':
                            subir_foto(file,tipo,id_prod);
                            obtener_datos_pdf(tipo,id_prod);
                            break;                             
                        case 'redes':
                            obtener_datos_redes(tipo,id_prod);
                            notificacion('Registro '+tipo,'Detalle actualizado correctamente.','success');
                            break;                                                                                                                                
                        default:
                            break;
                    }
                }
            }
        });

    }

    function eliminar(tipo,id,id_produc){
        alertify.confirm("¿Està seguro de eliminar el registro?.",
        function(){
            $.ajax({
                type: "POST",
                url: '<?php echo base_url();?>C_web_producto/eliminar',
                data: {'id':id,'tipo':tipo}, 
                beforeSend:function(){
                },   
                success: function(data){
                    if(data=='error'){
                        notificacion('Eliminar '+tipo,'Ocurrió un error en agregar, vuelva a intentarlo','error');
                    }else{
                        notificacion('Eliminar '+tipo,'Distribuidor eliinado correctamente','success');
                        switch (tipo) {
                            case 'caracteristica':
                                obtener_datos_caracteristicas();
                                break;
                            case 'productos':
                                obtener_datos_productos();
                                break;  
                            case 'detalle':
                                obtener_datos_detalle(tipo,id_produc);
                                break;   
                            case 'fotos':
                                obtener_datos_fotos(tipo,id_produc);
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

    function obtener_datos_caracteristicas(){
        $.ajax({
            type: "POST",
            url: '<?php echo base_url();?>C_web_producto/obtener_datos_caracteristicas',
            data: {
               'dato': $('#t_busqueda').val()
            }, 
            beforeSend:function(){
            },   
            success: function(data){ 
                if(data=='noexiste'){
                    alertify.error('La descripción no existe.');
                    //alertas('danger','La descripción no existe');
                }else{
                    var json         = eval("(" + data + ")");
                    $('#panel_datos').html($.trim(json.datos));
                }
            }
        });

    }


    function obtener_datos_productos(){
        $.ajax({
            type: "POST",
            url: '<?php echo base_url();?>C_web_producto/obtener_datos_productos',
            data: {
               'dato': $('#t_busqueda_productos').val()
            }, 
            beforeSend:function(){
            },   
            success: function(data){ 
                if(data=='noexiste'){
                    alertify.error('La descripción no existe.');
                    //alertas('danger','La descripción no existe');
                }else{
                    var json         = eval("(" + data + ")");
                    $('#panel_productos').html($.trim(json.datos));
                }
            }
        });

    }

    function obtener_datos_detalle(tipo,id){
        $.ajax({
            type: "POST",
            url: '<?php echo base_url();?>C_web_producto/obtener_datos_detalle',
            data: {
               'dato': $('#t_busqueda_productos').val(),
               'tipo': tipo,
               'id': id
            }, 
            beforeSend:function(){
            },   
            success: function(data){ 
                if(data=='noexiste'){
                    alertify.error('La descripción no existe.');
                    //alertas('danger','La descripción no existe');
                }else{
                    $('#panel_caracteristica_'+id).css('display','block');
                    $('#panel_archivo_'+id).css('display','none');
                    $('#panel_slider_'+id).css('display','none');
                    $('#panel_fotos_'+id).css('display','none');
                    $('#panel_redes_'+id).css('display','none');
                    var json         = eval("(" + data + ")");
                    $('#panel_caracteristica_'+id).html($.trim(json.datos));
                }
            }
        });

    }

    function obtener_datos_slider(tipo,id){
        $.ajax({
            type: "POST",
            url: '<?php echo base_url();?>C_web_producto/obtener_datos_slider',
            data: {
               'dato': $('#t_busqueda_productos').val(),
               'tipo': tipo,
               'id': id
            }, 
            beforeSend:function(){
            },   
            success: function(data){ 
                if(data=='noexiste'){
                    alertify.error('La descripción no existe.');
                    //alertas('danger','La descripción no existe');
                }else{
                    $('#panel_caracteristica_'+id).css('display','none');
                    $('#panel_archivo_'+id).css('display','none');
                    $('#panel_slider_'+id).css('display','block');
                    $('#panel_fotos_'+id).css('display','none');
                    var json         = eval("(" + data + ")");
                    $('#panel_slider_'+id).html($.trim(json.datos));
                }
            }
        });

    }

    function obtener_datos_pdf(tipo,id){
        $.ajax({
            type: "POST",
            url: '<?php echo base_url();?>C_web_producto/obtener_datos_pdf',
            data: {
               'tipo': tipo,
               'id': id
            }, 
            beforeSend:function(){
            },   
            success: function(data){ 
                if(data=='noexiste'){
                    alertify.error('La descripción no existe.');
                    //alertas('danger','La descripción no existe');
                }else{
                    $('#panel_caracteristica_'+id).css('display','none');
                    $('#panel_redes_'+id).css('display','none');
                    $('#panel_archivo_'+id).css('display','block');
                    $('#panel_slider_'+id).css('display','none');
                    $('#panel_fotos_'+id).css('display','none');
                    var json         = eval("(" + data + ")");
                    $('#panel_archivo_'+id).html($.trim(json.datos));
                }
            }
        });

    }


    function obtener_datos_redes(tipo,id){
        $.ajax({
            type: "POST",
            url: '<?php echo base_url();?>C_web_producto/obtener_datos_redes',
            data: {
               'tipo': tipo,
               'id': id
            }, 
            beforeSend:function(){
            },   
            success: function(data){ 
                if(data=='noexiste'){
                    alertify.error('La descripción no existe.');
                    //alertas('danger','La descripción no existe');
                }else{
                    $('#panel_caracteristica_'+id).css('display','none');
                    $('#panel_archivo_'+id).css('display','none');
                    $('#panel_slider_'+id).css('display','none');
                    $('#panel_fotos_'+id).css('display','none');
                    $('#panel_redes_'+id).css('display','block');
                    var json         = eval("(" + data + ")");
                    $('#panel_redes_'+id).html($.trim(json.datos));
                }
            }
        });

    }

    function obtener_datos_fotos(tipo,id){
        $.ajax({
            type: "POST",
            url: '<?php echo base_url();?>C_web_producto/obtener_datos_fotos',
            data: {
               'tipo': tipo,
               'id': id
            }, 
            beforeSend:function(){
            },   
            success: function(data){ 
                if(data=='noexiste'){
                    alertify.error('La descripción no existe.');
                    //alertas('danger','La descripción no existe');
                }else{
                    $('#panel_caracteristica_'+id).css('display','none');
                    $('#panel_archivo_'+id).css('display','none');
                    $('#panel_slider_'+id).css('display','none');
                    $('#panel_fotos_'+id).css('display','block');
                    $('#panel_redes_'+id).css('display','none');
                    var json         = eval("(" + data + ")");
                    $('#panel_fotos_'+id).html($.trim(json.datos));
                }
            }
        });

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

</script>