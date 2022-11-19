<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">





                    <!-- Informaciòn Distribuidores -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Multimedia</h4>
                            <p class="card-title-desc">Agregue,  y elimine fotos de la pàgina multimedia. Las imagenes deben tener una resolución de <strong>1200 x 1200 pixeles</strong>.</p>
                        </div>
                        <div class="card-body">
                            <div class="row" id="panel_multimedia">
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
        ///obtener_datos_productos();
        //obtener_datos_redes(); 

        obtener_datos_fotos('multimedia');
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
                            case 'multimedia':
                                $('#file_fotos_').val('');
                                obtener_datos_fotos(tipo);
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
            xhr.open('post', '<?php echo base_url();?>C_web_multimedia/subir_foto', true);
            
            var data = new FormData;
            data.append('file', file);
            data.append('tipo', tipo);
            data.append('id', id);
            xhr.send(data);          
    }

    function agregar(tipo,id){
        $.ajax({
            type: "POST",
            url: '<?php echo base_url();?>C_web_multimedia/agregar',
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
                        case 'multimedia':
                            obtener_datos_fotos(tipo);
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

    function eliminar(tipo,id,id_produc){
        alertify.confirm("¿Està seguro de eliminar el registro?.",
        function(){
            $.ajax({
                type: "POST",
                url: '<?php echo base_url();?>C_web_multimedia/eliminar',
                data: {'id':id,'tipo':tipo}, 
                beforeSend:function(){
                },   
                success: function(data){
                    if(data=='error'){
                        notificacion('Eliminar '+tipo,'Ocurrió un error en agregar, vuelva a intentarlo','error');
                    }else{
                        notificacion('Eliminar '+tipo,'Distribuidor eliinado correctamente','success');
                        switch (tipo) {
                            case 'multimedia':
                                obtener_datos_fotos(tipo);
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

    function obtener_datos_fotos(tipo){
        $.ajax({
            type: "POST",
            url: '<?php echo base_url();?>C_web_multimedia/obtener_datos_fotos',
            data: {
               'tipo': tipo
            }, 
            beforeSend:function(){
            },   
            success: function(data){ 
                if(data=='noexiste'){
                    alertify.error('La descripción no existe.');
                }else{
                    var json         = eval("(" + data + ")");
                    $('#panel_multimedia').html($.trim(json.datos));
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