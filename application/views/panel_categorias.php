<!-- Begin page -->

<?php //include 'layouts/menu.php'; ?>

<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Categorías Catálogo</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Categorías</a></li>
                                <li class="breadcrumb-item active">Lista</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Opciones</h4>
                            <p class="card-title-desc">Seleccione la mejor opción de búsqueda.
                            </p>
                        </div>
                        <div class="card-body">
                            <a type="button" href="<?php echo base_url();?>mod_categorias/agregar" class="btn btn-secondary btn-sm waves-effect waves-light"><i class="bx bxs-add-to-queue"></i> Nueva Categoría</a>
                        </div>
                        <div class="card-body">
                            <table id="tb_table" class="table table-bordered dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>Descripción</th>
                                        <th>Opción</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
    <?php //include 'layouts/footer.php'; ?>
</div>
<!-- end main content-->

<!----->
</div>
<!-- END layout-wrapper -->
<!-- Right Sidebar -->
<?php //include 'layouts/right-sidebar.php'; ?>
<!-- /Right-bar -->
</body>
</html>
<footer class="footer">
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-6">
            <script>document.write(new Date().getFullYear())</script> © MQS.
        </div>
        <div class="col-sm-6">
            <div class="text-sm-end d-none d-sm-block">
                Design & Develop by <a href="#!" class="text-decoration-underline">KallpaCorp</a>
            </div>
        </div>
    </div>
</div>
</footer>
<!-- JAVASCRIPT -->
<script src="<?php echo base_url();?>public/libs/jquery/jquery.min.js"></script>
<script src="<?php echo base_url();?>public/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url();?>public/libs/metismenu/metisMenu.min.js"></script>
<script src="<?php echo base_url();?>public/libs/simplebar/simplebar.min.js"></script>
<script src="<?php echo base_url();?>public/libs/node-waves/waves.min.js"></script>
<script src="<?php echo base_url();?>public/libs/feather-icons/feather.min.js"></script>
<!-- pace js -->
<script src="<?php echo base_url();?>public/libs/pace-js/pace.min.js"></script>

<!-- Required datatable js -->
<script src="<?php echo base_url();?>public/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>public/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<!-- Buttons examples -->
<script src="<?php echo base_url();?>public/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url();?>public/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
<script src="<?php echo base_url();?>public/libs/jszip/jszip.min.js"></script>
<script src="<?php echo base_url();?>public/libs/pdfmake/build/pdfmake.min.js"></script>
<script src="<?php echo base_url();?>public/libs/pdfmake/build/vfs_fonts.js"></script>
<script src="<?php echo base_url();?>public/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url();?>public/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="<?php echo base_url();?>public/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>

<!-- Responsive examples -->
<script src="<?php echo base_url();?>public/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url();?>public/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

<!-- Datatable init js -->
<script src="<?php echo base_url();?>public/js/pages/datatables.init.js"></script>

<script src="<?php echo base_url();?>public/js/app.js"></script>

<script>
var table; 
$(document).ready(function() {
forDataTables('#tb_table','mod_categorias/listar'); 
table.buttons().container()
.appendTo('#tb_table_wrapper .col-md-6:eq(0)');
});


function forDataTables( id, ruta) {
table = $(id).DataTable({
      "scrollX": true,
      "processing":true,
      "serverSide":true,
      "order":[],
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