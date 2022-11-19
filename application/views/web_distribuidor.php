<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Distribuidores</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Inicio</a></li>
                                <li class="breadcrumb-item active">Distribuidor</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Informaciòn Imagen -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Imagen de Cabecera</h4>
                            <p class="card-title-desc">La foto de cabercera de la página distribuidores debe estar en una resolución de 1920 x 500 pixeles.</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="">Adjuntar</label>
                                        <div style="display:flex;">
                                            <input name="file_cabecera" type="file" id="file_cabecera">
                                            <button onclick="subir_foto('file_cabecera','cabecera');"  style="margin-left:5px;" class="btn btn-sm btn-danger"> Subir </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Informaciòn Distribuidores -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Distribuidores</h4>
                            <p class="card-title-desc">Agregue, edite y elimine distribuidores registrados. </p>
                        </div>
                        <div class="card-body">
                            <div style="display:flex;justify-content: space-between;">
                                <button class="btn btn-sm btn-danger" onclick="agregar();"><i class="fas fa-plus"></i>Agregar</button>
                                <div style="display:flex;width:300px">
                                    <input  style="width:250px;" type="text" class="form-control form-control-sm" id="t_busqueda" placeholder="Nombre del distribuidor" onchange="obtener_datos();" >
                                    <button class="btn btn-sm btn-secondary"><i class="dripicons dripicons-search"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="panel_datos">
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
        obtener_datos();
        //obtener_datos_redes(); 
    });

    /*CARGA DE FOTOS*/
    function subir_foto(id,tipo){
            /*Con evento carga*/
            var inputfile = document.getElementById(id);
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
                        $('#'+id).val('');
                        //var  caden  = '<?php //echo base_url();?>public/images/tag/'+json.imagen;
                        //$('#img_foto').attr('src',caden);
                        //$('#img_foto_2').attr('src',caden);
                       // alertify.success('success','Foto de perfil actualizada.');
                       notificacion('Foto Cabecera','Foto de la cebecera actualizada correctamente','success');
                    }else{
                       notificacion('Foto Cabecera','Hubo un error en actualizar correctamente la foto.','error');
                    }
            });
            xhr.addEventListener('error', function(e) {
                notificacion('Foto Cabecera','Ocurrió un error en actualizar, vuelva a intentarlo','error');
            });  
            
            xhr.addEventListener('abort', function(e) {
                notificacion('Foto Cabecera','Ocurrió un error en actualizar, vuelva a intentarlo','error');
            });     
            xhr.open('post', '<?php echo base_url();?>C_web_distribuidor/subir_foto', true);
            
            var data = new FormData;
            data.append('file', file);
            data.append('tipo', tipo);
            xhr.send(data);          
    }

    function agregar(){
        $.ajax({
            type: "POST",
            url: '<?php echo base_url();?>C_web_distribuidor/agregar',
            data: {
            }, 
            beforeSend:function(){
            },   
            success: function(data){ 
                if(data!='0'){
                    notificacion('Registro Distribuidor','Registro correcto del distribuidor, actualice los registros solicitados.','success');
                    obtener_datos();
                }else{
                    notificacion('Registro Distribuidor','Ocurrió un error en agregar, vuelva a intentarlo','error');
                }
            }
        });
    }

    function actualizar(id){
        let t_descripcion   = $('#t_descripcion_'+id).val();
        let t_direccion     = $('#t_direccion_'+id).val();
        let t_url           = $('#t_url_'+id).val();

        if(t_descripcion!=''){
            if(t_direccion!=''){
                //if(t_url!=''){
                    $.ajax({
                        type: "POST",
                        url: '<?php echo base_url();?>C_web_distribuidor/actualizar',
                        data: {
                            't_descripcion':t_descripcion,
                            't_direccion':t_direccion,
                            't_url':t_url,
                            'id':id
                        }, 
                        beforeSend:function(){
                        },   
                        success: function(data){ 
                            if(data=='noexiste'){
                                alertify.error('La descripción no existe.');
                                //alertas('danger','La descripción no existe');
                            }else{
                                alertify.success('Actualización realizada correctamente.');
                            }
                        }
                    });
                //}else{
                //    alertify.error('Ingrese la dirección URL del Walink.');
                //}
            }else{
                alertify.error('Ingrese la dirección del distribuidor.');
            }
        }else{
            alertify.error('Ingrese una descripción.');
        }
    }

    function eliminar(id){
        alertify.confirm("¿Està seguro de eliminar el registro?.",
        function(){
            $.ajax({
                type: "POST",
                url: '<?php echo base_url();?>C_web_distribuidor/eliminar',
                data: {'id':id}, 
                beforeSend:function(){
                },   
                success: function(data){
                    if(data=='error'){
                        notificacion('Eliminar Distribuidor','Ocurrió un error en agregar, vuelva a intentarlo','error');
                    }else{
                        notificacion('Eliminar Distribuidor','Distribuidor eliinado correctamente','success');
                        obtener_datos();
                    }
                }
            });            
        },
        function(){
            alertify.error('Cancel');
        });   
    }

    function obtener_datos(){
        $.ajax({
            type: "POST",
            url: '<?php echo base_url();?>C_web_distribuidor/obtener_datos',
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