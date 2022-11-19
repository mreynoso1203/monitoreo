<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">





                    <!-- Informaciòn Distribuidores -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Solicitudes</h4>
                            <p class="card-title-desc">Se muestra las solicitudes que llegan desde las web teniendo en cuenta el tipo de consulta.</p>
                        </div>
                        <div class="card-body">
                            <div class="row" id="panel_solicitud">
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
        obtener_datos_solicitud();
    });


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
                file = 'file_slider_'+id;
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

        
        $.ajax({
            type: "POST",
            url: '<?php echo base_url();?>C_web_solicitud/actualizar',
            data: {
                't_descripcion':t_descripcion,
                'id_marca':id_marca,
                'id_categoria':id_categoria,
                't_nombre':t_nombre,
                'tipo':tipo,
                'id':id,
                'id_caracteristica':id_caracteristica,
                'descripcion':t_carac_descrip,
                'texto_1':t_texto1,
                'texto_2':t_texto2,
                'texto_3':t_texto3,
                'texto_boton':t_textobotton,
                'pag_inicio':activo

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
                            obtener_datos_solicitud();
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
                        default:
                            break;
                    }
                }
            }
        });

    }

    function obtener_datos_solicitud(){
        $.ajax({
            type: "POST",
            url: '<?php echo base_url();?>C_web_solicitud/obtener_datos_solicitud',
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
                    $('#panel_solicitud').html($.trim(json.datos));
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