<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Categorías de Productos</h4>
                            <p class="card-title-desc">Agregue, edite y elimine categorías del catálogo. Las imagenes de las categorías deben tener un resolución de <strong>45 x 50 pixeles</strong>.</p>
                        </div>
                        <div class="card-body">
                            <div style="display:flex;justify-content: space-between;">
                                <button class="btn btn-sm btn-danger" onclick="agregar('categoria',0);"><i class="fas fa-plus"></i>Agregar</button>
                                <div style="display:flex;width:300px">
                                    <input  style="width:250px;" type="text" class="form-control form-control-sm" id="t_busqueda" placeholder="Nombre del distribuidor" onchange="obtener_datos();" >
                                    <button class="btn btn-sm btn-secondary"><i class="dripicons dripicons-search"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row" id="panel_datos">
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
    });

    /*CARGA DE FOTOS*/
    function subir_foto(file_,tipo,id){
            /*Con evento carga*/
            var inputfile = document.getElementById(file_);
            var file      = inputfile.files[0];
            var xhr = new XMLHttpRequest();
            (xhr.upload || xhr).addEventListener('progress', function(e) {
            });
            xhr.addEventListener('load', function(e) {
                    var json         = eval("(" + this.responseText + ")");
                    if($.trim(json.valida)=='si'){
                        switch (tipo) {
                            case 'categoria':
                                $('#img_'+id).val('');
                                obtener_datos();
                                break;
                            default:
                                break;
                        }            
                       notificacion('Foto '+tipo,'Foto de la '+tipo+' actualizada correctamente','success');
                    }else{
                       notificacion('Foto '+tipo,'Hubo un error en actualizar correctamente la foto.','error');
                    }
            });
            xhr.addEventListener('error', function(e) {
                notificacion('Foto ','Ocurrió un error en actualizar, vuelva a intentarlo','error');
            });  
            
            xhr.addEventListener('abort', function(e) {
                notificacion('Foto ','Ocurrió un error en actualizar, vuelva a intentarlo','error');
            });     
            xhr.open('post', '<?php echo base_url();?>C_web_categoria/subir_foto', true);
            
            var data = new FormData;
            data.append('file', file);
            data.append('tipo', tipo);
            data.append('id', id);
            xhr.send(data);          
    }

    function agregar(tipo,id){
        $.ajax({
            type: "POST",
            url: '<?php echo base_url();?>C_web_categoria/agregar',
            data: {
                'tipo':tipo,
                'id':id
            }, 
            beforeSend:function(){
            },   
            success: function(data){ 
                if(data!='0'){
                    switch (tipo) {
                        case 'categoria':
                            notificacion('Registro '+tipo,'Registro correcto de la '+tipo+', actualice los registros solicitados.','success');
                            obtener_datos();
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
        let input1 = 't_descripcion_'+id; 
        let file = ''; 

        switch (tipo) {
            case 'categoria':
                input1 = '#t_descripcion_'+id;
                file = 'file_'+id;
                break;
            default:
                break;
        }

        let t_descripcion   = $(input1).val();
        
        $.ajax({
            type: "POST",
            url: '<?php echo base_url();?>C_web_categoria/actualizar',
            data: {
                't_descripcion':t_descripcion,
                'tipo':tipo,
                'id':id,
            }, 
            beforeSend:function(){
            },   
            success: function(data){ 
                if(data=='noexiste'){
                    alertify.error('La descripción no existe.');
                }else{
                    //alertify.success('Actualización realizada correctamente.');
                    switch (tipo) {
                        case 'categoria':
                            var imgVal = $('#'+file).val(); 
                            if(imgVal==''){ 
                                obtener_datos();
                                notificacion('Actualización  '+tipo,'Se actualizó correctamente la descripción de la '+tipo+'.','success');
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

    function eliminar(tipo,id,id_produc){
        alertify.confirm("¿Està seguro de eliminar el registro?.",
        function(){
            $.ajax({
                type: "POST",
                url: '<?php echo base_url();?>C_web_categoria/eliminar',
                data: {'id':id,'tipo':tipo}, 
                beforeSend:function(){
                },   
                success: function(data){
                    if(data=='error'){
                        notificacion('Eliminar '+tipo,'Ocurrió un error en agregar, vuelva a intentarlo','error');
                    }else{
                        notificacion('Eliminar '+tipo,'Distribuidor eliinado correctamente','success');
                        switch (tipo) {
                            case 'categoria':
                                obtener_datos();
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

    function obtener_datos(){
        $.ajax({
            type: "POST",
            url: '<?php echo base_url();?>C_web_categoria/obtener_datos',
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