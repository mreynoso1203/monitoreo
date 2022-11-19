    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Calendario</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Inicio</a></li>
                                    <li class="breadcrumb-item active">Calendario</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-12">
                    
                        <div class="row">
                            <div class="col-xl-3 col-lg-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-grid">
                                            <button class="btn font-16 btn-danger" id="btn-new-event"><i class="mdi mdi-plus-circle-outline"></i>Crear nuevo evento</button>
                                        </div>
                                        
                                        <div id="external-events" class="mt-2">
                                            <br>
                                            <!--<p class="text-muted">Arrastra y suelta el evento a agregar en el calendario.</p>-->
                                            <?php 
                                                foreach ($lst_tipo_eventos as $key) {
                                                    /*echo '
                                                    <div class="external-event fc-event '.$key->class1.' '.$key->class2.'" data-class="'.$key->data_class.'">
                                                        <i class="mdi mdi-checkbox-blank-circle font-size-11 me-2"></i>'.$key->descripcion.'
                                                    </div>
                                                    ';*/ 
                                                }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end col-->

                            <div class="col-xl-9 col-lg-8">
                                <div class="card">
                                    <div class="card-body">
                                        <div id="calendar"></div>
                                    </div>
                                </div>
                            </div> <!-- end col -->

                        </div> 

                        <div style='clear:both'></div>


                        <!-- Add New Event MODAL -->
                        <div class="modal fade" id="event-modal" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header py-3 px-4 border-bottom-0">
                                        <h5 class="modal-title" id="modal-title">Event</h5>

                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>

                                    </div>
                                    <div class="modal-body p-4">
                                        <form class="needs-validation" name="event-form" id="form-event" novalidate>
                                            <div class="row">
                                                <div class="col-12" style="display:none;">
                                                    <div class="mb-3">
                                                        <label class="form-label">ID</label>
                                                        <input class="form-control" type="text" id="event-ID" required value="" />
                                                    </div>
                                                </div> 
                                                <div class="col-12">
                                                    <div class="mb-3">
                                                        <label class="form-label">Nombre del Evento</label>
                                                        <input class="form-control" placeholder="Insert Event Name"
                                                            type="text" name="title" id="event-title" required value="" />
                                                        <div class="invalid-feedback">Please provide a valid event name</div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="mb-3">
                                                        <label class="form-label">Fecha</label>
                                                        <input class="form-control" placeholder="Nombre del evento" type="date" id="event-date" required value="" />
                                                    </div>
                                                </div> 
                                                <div class="col-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Hora Inicio</label>
                                                        <input class="form-control" type="time" value="00:00:00" id="event-hora-inicio">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Hora Fin</label>
                                                        <input class="form-control" type="time" value="00:00:00" id="event-hora-fin">
                                                    </div>
                                                </div>                                                 
                                                <div class="col-12">
                                                    <div class="mb-3">
                                                        <label class="form-label">Tipo de evento</label>
                                                        <select class="form-control form-select" name="category" id="event-category">
                                                            <option  value="" selected> --Seleccione-- </option>
                                                            <?php 
                                                                foreach ($lst_tipo_eventos as $key) {
                                                                    echo '
                                                                        <option value="'.$key->id.'">'.$key->descripcion.'</option>
                                                                    '; 
                                                                }
                                                            ?>
                                                        </select>
                                                        <div class="invalid-feedback">Please select a valid event category</div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="mb-3">
                                                        <label class="form-label">Observación</label>
                                                        <textarea class="form-control" id="event-description"></textarea>
                                                    </div>
                                                </div> 
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-4">
                                                    <button type="button" class="btn btn-danger" onclick="borrar_evento();">Eliminar</button>
                                                </div>
                                                <div class="col-8 text-end">
                                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button>
                                                    <button type="button" class="btn btn-success" onclick="modificar_evento();" >Actualizar</button>
                                                    <button type="button" class="btn btn-success" onclick="grabar_evento();" >Registrar</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div> <!-- end modal-content-->
                            </div> <!-- end modal dialog-->
                        </div>
                        <!-- end modal-->

                    </div>
                </div>
                
            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->
    </div>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script>
        function abrir_modal_evento(){
            $('#frm_agregar_evento').modal('show');
        }
        


        function agregar_evento(){

            //let dd = new Date(2022, 7, 26, 16, 0)
            //alert(dd);
            //return;

            var nombre  = $('#add_nombre_evento').val();
            var tipo    = $('#add_tipo_evento').val();
            var obs    = $('#add_observacion_evento').val();
            var fecha    = $('#add_fecha').val();
            var hinicio    = $('#add_hora_inicio').val();
            var hfin    = $('#add_hora_fin').val();
            
            if(nombre==''){
                alertify.error('El nombre del evento es obligatorio.');
                return;
            }
            if(tipo==''){
                alertify.error('El tipo de evento es obligatorio.');
                return;
            }
            if(fecha==''){
                alertify.error('Seleccione la fecha a programar.');
                return;
            }
            if(hinicio==''){
                alertify.error('Seleccione un horario correcto.');
                return;
            }
            if(hfin==''){
                alertify.error('Seleccione un horario correcto.');
                return;
            }                        

            $.ajax({
                type: "POST",
                url: '<?php echo base_url();?>C_agenda/agregar',
                data: {
                    'nombre':nombre,
                    'tipo':tipo,
                    'obs':obs,
                    'fecha':fecha,
                    'hinicio':hinicio,
                    'hfin':hfin
                }, 
                beforeSend:function(){
                },   
                success: function(data){
                    alertify.success('Se ingresó correctamente los datos del evento.');
                    cargar_eventos();
                    limpiar_modal();
                }
            });
        }

        function limpiar_modal(){
            $('#frm_agregar_evento').modal('hide');
            $('#add_nombre_evento').val('');
            $('#add_tipo_evento').val('');
            $('#add_observacion_evento').val('');
            $('#add_fecha').val('');
            $('#add_hora_inicio').val('');
            $('#add_hora_fin').val('');
        }



    </script>

