<!---->
<div class="modal fade" tabindex="-1" role="dialog" id="modal_cita" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="">Programar Cita</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group col-lg-12">
                            <label for="" class="control-label">Psicologo</label>
                            <select onchange="load_consultasxpsico();" id="pc_psicologo" name="pc_psicologo" class="form-control"><option>Seleccione</option></select>
                        </div>
                        <div class="form-group col-lg-12">
                            <label for="" class="control-label">Tipo de Consulta</label>
                            <select id="pc_tconsulta" name="pc_tconsulta" class="form-control"><option>Seleccione</option></select>
                        </div>
                        <div class="form-group col-lg-12">
                            <label for="" class="control-label">Fecha Programada</label>
                            <input  id="pc_fecha" name="pc_fecha" onchange="cargar_disponibilidad();" class="form-control" type="date" min="2020-06-30 07:00" >
                        </div>
                        <div class="form-group col-lg-12">
                            <label for="" class="control-label">Hora</label>
                            <div style="display: flex;flex-direction: row;">
                               <input  id="pc_hora" name="pc_hora" class="form-control" type="text" >
                               <label>:</label>
                               <input  id="pc_minuto" name="pc_minuto" class="form-control" type="text" >
                            </div>
                        </div>                        
                        <div class="form-group col-lg-12">
                            <label for="" class="control-label">Modalidad de Atención</label>
                            <select id="pc_modalidad" name="pc_modalidad" class="form-control">
                                <option value="">Seleccione</option>
                                <option value="VIRTUAL">Virtual</option>
                                <option value="PRESENCIAL">Presencial</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-12">
                            <label for="" class="control-label">Modalidad de pago</label>
                            <select id="pc_pago" id="pc_pago" class="form-control">
                                <option value="">Seleccione</option>
                                <option value="EFECTIVO">Efectivo</option>
                                <option value="TARJETA">Tarjeta</option>
                                <option value="DEPOSITO">Deposito</option>
                            </select>
                        </div>                        
                    </div> 
                    <div class="col-lg-8" id="panel_disponibilidad">
                        <div class="col-lg-12">
                            <div class="alert alert-warning" style="padding: 5px;margin-bottom: 5px; text-align: center;"><strong>LUNES 30 ABR.</strong></div>
                        </div>
                        <div class="col-lg-4">
                            <div class="alert alert-warning" style="padding: 5px;margin-bottom: 5px;">T. Mañana</div>
                            
                            <div class="alert alert-danger" style="padding: 3px;margin-bottom: 5px;">
                                <a href="#" class="alert-link">9:00am-9:30am</a>.
                            </div>
                            
                            <div class="alert alert-danger" style="padding: 3px;margin-bottom: 5px;">
                                <a href="#" class="alert-link">9:30am-10:00am</a>.
                            </div>
                            <div class="alert alert-info" style="padding: 3px;margin-bottom: 5px;">
                                <a href="#" class="alert-link">10:00am-10:30am</a>.
                            </div>
                            <div class="alert alert-info" style="padding: 3px;margin-bottom: 5px;">
                                <a href="#" class="alert-link">10:30am-11:00am</a>.
                            </div>
                            <div class="alert alert-info" style="padding: 3px;margin-bottom: 5px;">
                                <a href="#" class="alert-link">11:00am-11:30am</a>.
                            </div>
                            <div class="alert alert-info" style="padding: 3px;margin-bottom: 5px;">
                                <a href="#" class="alert-link">11:30am-12:00am</a>.
                            </div>                                                                                                                                            
                        </div>
                        <div class="col-lg-4">
                           <div class="alert alert-warning" style="padding: 5px;margin-bottom: 5px;">T. Tarde</div>
                            <div class="alert alert-info" style="padding: 3px;margin-bottom: 5px;">
                                <a href="#" class="alert-link">12:00am-12:30pm</a>.
                            </div> 
                            <div class="alert alert-info" style="padding: 3px;margin-bottom: 5px;">
                                <a href="#" class="alert-link">12:30pm-13:00pm</a>.
                            </div> 
                            <div class="alert alert-info" style="padding: 3px;margin-bottom: 5px;">
                                <a href="#" class="alert-link">13:00pm-13:30pm</a>.
                            </div> 
                            <div class="alert alert-danger" style="padding: 3px;margin-bottom: 5px;">
                                <a href="#" class="alert-link">13:30pm-14:00pm</a>.
                            </div> 
                            <div class="alert alert-danger" style="padding: 3px;margin-bottom: 5px;">
                                <a href="#" class="alert-link">14:00pm-14:30pm</a>.
                            </div> 
                            <div class="alert alert-info" style="padding: 3px;margin-bottom: 5px;">
                                <a href="#" class="alert-link">14:30pm-15:00pm</a>.
                            </div> 
                            <div class="alert alert-info" style="padding: 3px;margin-bottom: 5px;">
                                <a href="#" class="alert-link">15:00pm-15:30pm</a>.
                            </div> 
                            <div class="alert alert-info" style="padding: 3px;margin-bottom: 5px;">
                                <a href="#" class="alert-link">15:30pm-16:00pm</a>.
                            </div> 
                             <div class="alert alert-info" style="padding: 3px;margin-bottom: 5px;">
                                <a href="#" class="alert-link">16:00pm-16:30pm</a>.
                            </div> 
                            <div class="alert alert-danger" style="padding: 3px;margin-bottom: 5px;">
                                <a href="#" class="alert-link">16:30pm-17:00pm</a>.
                            </div> 
                            <div class="alert alert-danger" style="padding: 3px;margin-bottom: 5px;">
                                <a href="#" class="alert-link">17:00pm-17:30pm</a>.
                            </div> 
                            <div class="alert alert-info" style="padding: 3px;margin-bottom: 5px;">
                                <a href="#" class="alert-link">17:30pm-18:00pm</a>.
                            </div>                         
                        </div> 
                        <div class="col-lg-4">
                           <div class="alert alert-warning" style="padding: 5px;margin-bottom: 5px;">T. Noche</div>
                            <div class="alert alert-info" style="padding: 3px;margin-bottom: 5px;">
                                <a href="#" class="alert-link">18:00pm-18:30pm</a>.
                            </div>
                            <div class="alert alert-info" style="padding: 3px;margin-bottom: 5px;">
                                <a href="#" class="alert-link">18:30pm-19:00pm</a>.
                            </div>
                            <div class="alert alert-info" style="padding: 3px;margin-bottom: 5px;">
                                <a href="#" class="alert-link">19:00pm-19:30pm</a>.
                            </div>
                            <div class="alert alert-danger" style="padding: 3px;margin-bottom: 5px;">
                                <a href="#" class="alert-link">19:30pm-20:00pm</a>.
                            </div> 
                            <div class="alert alert-info" style="padding: 3px;margin-bottom: 5px;">
                                <a href="#" class="alert-link">20:00pm-20:30pm</a>.
                            </div>
                            <div class="alert alert-info" style="padding: 3px;margin-bottom: 5px;">
                                <a href="#" class="alert-link">20:30pm-21:00pm</a>.
                            </div>                               
                        </div>                                                
                    </div>                                       
                </div>
            </div>
            <div class="modal-footer">
                <button onclick="actualizar_data()" class="btn btn-info">Actualizar</button>
                <button data-dismiss="modal" class="btn btn-warning">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!---->

<!---->
<div class="modal fade" tabindex="-1" role="dialog" id="modal_consulta" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="">AGREGAR TIPO DE CONSULTA</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-lg-12">
                        <label for="txtfd" class="control-label">DESCRIPCÍÓN</label>
                        <input type="text" class="form-control" required id="tpconsulta" name="tpconsulta" >
                    </div>
                    <div class="form-group col-lg-12">
                        <label  style="font-size:12px;" id="msgaddconsulta" class="control-label">Msg: </label>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button onclick="agregar_consulta()" class="btn btn-info">Agregar</button>
                <button data-dismiss="modal" class="btn btn-warning">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!---->

<!---->
<div class="modal fade" tabindex="-1" role="dialog" id="modal_psicologo" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="">ACTUALIZAR DATOS</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-lg-4">
                        <label for="txtfd" class="control-label">Nombres</label>
                        <input type="text" class="form-control" required id="pnombres" name="pnombres" >
                        <input type="hidden" class="form-control" id="pid" name="pid" value="" >
                    </div>
                    <div class="form-group col-lg-4">
                        <label for="txtfh" class="control-label">Apellidos</label>
                        <input type="text" class="form-control" required id="papellidos" name="papellidos" >
                    </div>
                    <div class="form-group col-lg-4">
                        <label for="txtfh" class="control-label">Fecha Nacimiento</label>
                        <input type="date" class="form-control" required id="pfecha" name="pfecha" >
                    </div>
                    <div class="form-group col-lg-4">
                        <label for="txtfh" class="control-label">DNI</label>
                        <input type="text" class="form-control" required id="pdni" name="pdni" >
                    </div>
                    <div class="form-group col-lg-4">
                        <label for="txtfh" class="control-label">Genero</label>
                        <select class="form-control" id="pgenero" required name="pgenero">
                            <option value="">SELECCIONE</option>
                            <option value="M">MASCULINO</option>
                            <option value="F">FEMENINO</option>
                        </select>
                    </div>
                    <div class="form-group col-lg-4">
                        <label for="txtfh" class="control-label">Celular</label>
                        <input type="text" class="form-control" required id="pcelular" name="pcelular" >
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="txtfh" class="control-label">Dirección</label>
                        <input type="text" class="form-control" required id="pdireccion" name="pdireccion" >
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="txtfh" class="control-label">Correo</label>
                        <input type="text" class="form-control" required id="pcorreo" name="pcorreo" >
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button onclick="actualizar_data()" class="btn btn-info">Actualizar</button>
                <button data-dismiss="modal" class="btn btn-warning">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!---->


<!--begin modal window-->
<div class="modal fade" id="myModal" oncontextmenu="return false">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<div class="pull-left" id="tituloModal"></div>
<button type="button" class="close" data-dismiss="modal" title="Close"> <span class="glyphicon glyphicon-remove"></span></button>
</div>
<div class="modal-body">

<!--CAROUSEL CODE GOES HERE-->
<!--begin carousel-->
<div id="myGallery" class="carousel slide" data-interval="false">
    <div class="carousel-inner" id="imagenesSlider">
        <div class="item active"> 
            <img id="imagen01" src="" alt="item0">
            <div class="carousel-caption">
            </div>
        </div>
        <div class="item"> 
            <img id="imagen02" src="" alt="item1">
            <div class="carousel-caption">
            </div>
        </div>
        <div class="item"> 
            <img  id="imagen03" src="" alt="item2">
            <div class="carousel-caption">
            </div>
        </div>
        <!--end carousel-inner-->
    </div>
    <!--Begin Previous and Next buttons-->
    <a class="left carousel-control" style="color:black; background:#ffffff00" href="#myGallery" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left"></span></a>
    <a style="color:black; background:#ffffff00" class="right carousel-control" href="#myGallery" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right"></span></a>
<!--end carousel-->
</div>


<!--end modal-body--></div>
<!--end modal-content--></div>
<!--end modal-dialoge--></div>
<!--end myModal-->></div>





<div class="modal fade" tabindex="-1" role="dialog" id="modalLoad" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="titulomodalload"></h4>
            </div>
            <div class="modal-body">
                <p id="mensajemodalload"></p>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->




<div class="modal fade" tabindex="-1" role="dialog" id="modalConfirm" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="titulomodal"></h4>
            </div>
            <div class="modal-body">
                <p id="mensajemodal"></p>
            </div>
            <div class="modal-footer">
                <a id="rutamodal" href="#" class="btn btn-warning">Terminar</a>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" tabindex="-1" role="dialog" id="modalError" >
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="titulomodale"></h4>
            </div>
            <div class="modal-body">
                <p id="mensajemodale"></p>
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-warning">Cerrar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php if (isset($rutaExportar)){ ?>
<div class="modal fade" tabindex="-1" role="dialog" id="modalExportar" >
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="titulomodalex">Exportar</h4>
            </div>
            <div class="modal-body">
                <p id="mensajemodalex">Seleccione el modo de exportación</p>
                <form action="<?php echo base_url().$rutaExportar; ?>/exp_rango" method="post" id="frmexport" target="_blank">
                    <div class="radio">
                        <label>
                            <input type="radio" name="tipoe" id="modoExp1" value="s" checked>
                            Selección de Items
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="tipoe" id="modoExp2" value="f">
                            Rango de Fechas
                        </label>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label for="txtfd" class="col-sm-2 control-label">Desde</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="txtfd" name="txtfd" readonly>
                            </div>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="txtfh" class="col-sm-2 control-label">Hasta</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="txtfh" name="txtfh" readonly>
                            </div>
                        </div>
                    </div>
                </form>
                <form action="<?php echo base_url().$rutaExportar; ?>/exp_seleccionados" id="frmExportSel" method="post" target="_blank">
                    <input type="hidden" name="seleccionados" id="exportSelec">
                </form>
                <p id="idMensajeExp" style="color: #f9243f; display: none;"></p>
            </div>
            <div class="modal-footer">
                <button id="idBtnExportar" class="btn btn-success">Exportar</button>
                <button data-dismiss="modal" class="btn btn-warning">Cancelar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php } ?>

<div class="modal fade" tabindex="-1" role="dialog" id="modalDelete" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="titulomodale">Eliminar</h4>
            </div>
            <div class="modal-body">
                <p id="mensajemodale">¿ Desea eliminar esta fila ?</p>
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-warning">NO</button>
                <a class="btn btn-success btn-ok">SI</a>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script src="<?php echo base_url(); ?>public/js/jquery-1.11.1.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/chart.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/chart-data.js"></script>
<script src="<?php echo base_url(); ?>public/js/easypiechart.js"></script>
<script src="<?php echo base_url(); ?>public/js/easypiechart-data.js"></script>
<script src="<?php echo base_url(); ?>public/js/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url(); ?>public/js/datatables.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/custom.js"></script>
<script src="<?php echo base_url(); ?>public/js/jquery-validate.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/jquery-ui-1.10.4.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>file_all/js/tableexport.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>file_all/js/jquery.base64.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>file_all/js/html2canvas.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>file_all/js/jspdf/libs/sprintf.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>file_all/js/jspdf/jspdf.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>file_all/js/jspdf/libs/base64.js"></script>

<script  src="<?php echo base_url(); ?>public/js/toastr.js"></script>

<script src="<?php echo base_url(); ?>public/js/main.js"></script>
<script>
    $(document).ready(function() {
        $('#tbpaciente').DataTable();
        $('#tbhistorial').DataTable();
        
        function forDataTables( id, ruta, targets ) {
            var dataTable = $(id).DataTable({
                /*"responsive":true,*/
                "processing":true,
                "serverSide":true,
                "order":[],
                "ajax":{
                    url:"<?php echo base_url(); ?>" + ruta,
                    type:"POST"
                },
                "columnDefs":[
                    {
                        "targets":targets,
                        "orderable":false,
                    },
                ],
                "language": {
                    "sProcessing": "Procesando...",
                    "sLengthMenu": "Mostrar _MENU_ registros",
                    "sZeroRecords": "No se encontraron resultados",
                    "sEmptyTable": "Ningún dato disponible en esta tabla",
                    "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
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
            /*setInterval( function () {
                dataTable.ajax.reload( null, false ); // user paging is not reset on reload
            }, 1000 );*/
        }
        forDataTables('#idTableExcel','excel/listar_excel',3);

        forDataTables('#idTableVoucher','voucher/listar_voucher',6);
        forDataTables('#idTablePasajeros','pasajeros/listar_pasajeros',[3,4,5]);
        forDataTables('#idTableAgencias','agencias/listar_agencias',[2,3]);
        forDataTables('#idTableCounters','counters/listar_counters',[3,4,6]);
        forDataTables('#idTablePromotores','promotores/listar_promotores',[4]);
        forDataTables('#idTablePlanes','planes/listar_planes',[0,2,3,4,5]);
        forDataTables('#idTableCobranza','cobranza/listar_cobranza',[2,3,4]);
        forDataTables('#idTableBeneficios','beneficios/listar_beneficios',[0,2]);
        forDataTables('#idTableServicios','servicios/listar_servicios',[0,3,4]);
        <?php
            if (isset($id_plan_for_precios)){
        ?>
        forDataTables('#idTablePrecios','planes/precios/listar_precios/<?php echo $id_plan_for_precios; ?>',[0,1,2]);
        <?php
        }
        ?>


    });
</script>
<script>

    var baseurl = '<?php echo base_url(); ?>';
    $('#idCheck').on('change',function ()
    {
        var check = $(this).prop('checked');
        if (check)
            $(this).val('1');
        else
            $(this).val('0');
    });
</script>
<script src="<?php echo base_url(); ?>public/js/validaciones.js"></script>
<script>
</script>

</body>
</html>
