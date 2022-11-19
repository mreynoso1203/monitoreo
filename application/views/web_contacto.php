<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Contacto</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Inicio</a></li>
                                <li class="breadcrumb-item active">Contacto</li>
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
                            <p class="card-title-desc">La foto de cabercera de la página Contacto debe estar en una resolución de 1920 x 500 pixeles.</p>
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

            <!-- I Frame -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">IFrame Google Maps</h4>
                            <p class="card-title-desc">Teniendo en cuenta la ubicación en el mapa, la opción compartir y pestaña Insertar en un mapa.</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label class="form-label" for="">Inserte código</label>
                                        <div style="display:flex;">
                                            <textarea id="text_iframe" class="form-control form-control-sm"></textarea>
                                            <button onclick="actualizar();"  style="margin-left:5px;" class="btn btn-sm btn-danger"> Actualizar </button>
                                        </div>
                                    </div>
                                </div>
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
        get_datos();
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
                       notificacion('Foto Cabecera','Foto de la '+tipo+' actualizada correctamente','success');
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
            xhr.open('post', '<?php echo base_url();?>C_web_contacto/subir_foto', true);
            
            var data = new FormData;
            data.append('file', file);
            data.append('tipo', tipo);
            xhr.send(data);          
    }

    function actualizar(){
        let text_iframe  = $('#text_iframe').val();
        if(text_iframe!='' ){
            $.ajax({
                type: "POST",
                url: '<?php echo base_url();?>C_web_contacto/actualizar',
                data: {
                    'text_iframe':text_iframe
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

    function get_datos(){
        $.ajax({
            type: "POST",
            url: '<?php echo base_url();?>C_web_contacto/get_datos',
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
                    $('#text_iframe').html($.trim(json.text_iframe));
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