<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Gestionar actividades de monitoreo</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Inicio</a></li>
                                <li class="breadcrumb-item active">Actividades de monitoreo</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <!-- end page title -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Agregar</h4>
                            <p class="card-title-desc"></p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="validationCustom01">Actividad de monitoreo</label>
                                        <input type="text" class="form-control" id="text_descripcion" placeholder="Tipo de servicio" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mt-4">
                                        <button class="btn btn-danger" onclick="registrar();" >Agregar</button>
                                    </div>
                                </div>                                
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Registros</h4>
                            <p class="card-title-desc"></p>
                        </div>
                        <div class="card-body">
                            <table id="tb_table" class="table table-bordered dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>Actividad de monitoreo</th>
                                        <th>Fecha Registro</th>
                                        <th>Opción</th>
                                    </tr>
                                </thead>
                            </table>                            
                        </div>
                    </div>
                </div>

            </div>
        
        </div>
    </div>
    
</div>

    <!--Modals-->
    <!-- Static Backdrop Modal -->
    <div class="modal fade" id="modal_editar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Editar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Editar el registro</p>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label" for="validationCustom01">Descripción</label>
                                <input type="text" class="form-control" id="text_descripcion_upd" placeholder="Tipo de servicio" required>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-danger" onclick="actualizar();">Grabar</button>
                </div>
            </div>
        </div>
    </div>
    <!---------->

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<script>
    var id_upd; 
    var table; 
    $(document).ready(function() {
        id_upd=0; 
        //table.ajax.reload(null,false);   
        forDataTables('#tb_table','C_actividad/listar_registros'); 
        table.buttons().container().appendTo('#tb_table_wrapper .col-md-6:eq(0)');
    });

    function editar(id){
        id_upd=id; 

        $.ajax({
            type: "POST",
            url: '<?php echo base_url();?>C_actividad/obtener_datos',
            data: {
                'id':id
            }, 
            beforeSend:function(){
            },   
            success: function(data){ 
                if(data=='noexiste'){
                    alertify.error('La descripción no existe.');
                    //alertas('danger','La descripción no existe');
                }else{
                    var json         = eval("(" + data + ")");
                    $('#text_descripcion_upd').val($.trim(json.descripcion));
                }
            }
        });

        
        $('#modal_editar').modal('show');
    }

    function actualizar(){
        let des = $('#text_descripcion_upd').val();
        if(des!=''){
            $.ajax({
                type: "POST",
                url: '<?php echo base_url();?>C_actividad/actualizar',
                data: {
                    'des':des,
                    'id' :id_upd
                }, 
                beforeSend:function(){
                },   
                success: function(data){ 
                    if(data=='duplicado'){
                        alertify.error('La descripción ingresada no se encuentra disponible.');
                        //alertas('danger','La descripción ingresada ya se encuentra registrada');
                    }else{
                        table.ajax.reload(null,false);
                        alertify.success('La descripción ha sido actualizada correctamente.');
                        //alertas('success','La descripción ha sido actualizada correctamente');
                        $('#text_descripcion').val('');
                        $('#modal_editar').modal('hide');
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

    function registrar(){
        let des = $('#text_descripcion').val();
        if(des!=''){
            $.ajax({
                type: "POST",
                url: '<?php echo base_url();?>C_actividad/registrar',
                data: {'des':des}, 
                beforeSend:function(){
                },   
                success: function(data){ 
                    if(data=='duplicado'){
                        alertify.error('La descripción ingresada no se encuentra disponible.');
                        //alertas('danger','La descripción ingresada ya se encuentra registrada');
                    }else{
                        table.ajax.reload(null,false); 
                        alertify.success('Registro realizado.');
                        //alertas('success','La descripción ingresada ha sido registrada correctamente');
                        $('#text_descripcion').val('');
                    }
                }
            });
        }else{
            alertify.error('Ingrese una descripción correcta.');
        }
    }

    function listar(){
        $.ajax({
            type: "POST",
            url: '<?php echo base_url();?>C_actividad/listar',
            data: {}, 
            beforeSend:function(){
            },   
            success: function(data){ 
                $('#table_contenido').html(data);
            }
        });
    }

    function eliminar(id){
        alertify.confirm("¿Està seguro de eliminar el registro?.",
        function(){
            $.ajax({
                type: "POST",
                url: '<?php echo base_url();?>C_actividad/eliminar',
                data: {'id':id}, 
                beforeSend:function(){
                },   
                success: function(data){
                    if(data=='error'){
                        alertify.error('No se pudo eliminar la descripción.');
                        //alertas('danger','Hubo un error, no se pudo eliminar la descripción seleccionada.');
                    }else{
                        //table.ajax.reload(null,false); 
                        table.ajax.reload(null,false);                        
                        alertify.success('La descripción seleccionada ha sido eliminada.');
                        //alertas('success','La descripción seleccionada ha sido eliminada.');
                    }
                }
            });            
        },
        function(){
            alertify.error('Cancel');
        });          
    }

    function forDataTables( id, ruta) {
        table = $(id).DataTable({
            "scrollX": true,
            "processing":true,
            "serverSide":true,
            "order":[],
            "dom": 'Bfrtip',
            "buttons": ['copy', 'excel', 'pdf', 'colvis'],
            "ajax":{
                url:"<?php echo base_url(); ?>" + ruta,
                type:"POST"
            },          
            "order": [[ 0, "DESC" ]],
            "language": {
                "sProcessing": "Procesando...",
                "sLengthMenu": "Mostrar _MENU_ registros",
                "sZeroRecords": "No se encontraron resultados",
                "sEmptyTable": "Ningún dato disponible en esta tabla",
                "sInfo": "Del _START_ al _END_",
                "sInfoEmpty": "Del 0 al 0 ",
                "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix": "",
                "sSearch": "Buscar:",
                "sUrl": "",
                "sInfoThousands": ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast": "Último",
                    "sNext": "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            }
        });
    } 

</script>