<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Global Assist - Recuperar Cuenta</title>
    <link href="<?php echo base_url(); ?>public/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>public/css/datepicker3.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>public/css/styles.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="<?php echo base_url(); ?>public/js/html5shiv.js"></script>
    <script src="<?php echo base_url(); ?>public/js/respond.min.js"></script>
    <![endif]-->
    <style>
        @media screen and (min-width: 991px) {
            .dflex{
                display: flex;
            }
            .flexcenter{
                display: flex;
                align-items: center;
                justify-content: center;
            }
        }
        .titulo{
            color: #0f62ac;
            font-size: 1.2em;
            font-weight: bold;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2 col-md-8 col-md-offset-2">
            <div class="login-panel panel panel-default">
                <div class="panel-body">
                    <div class="row dflex">
                        <div class="col-lg-6 flexcenter">
                            <div>
                                <div style="margin: 0 auto; max-width: 200px; margin-bottom: 20px;"><img src="<?php echo base_url(); ?>public/img/logo.png" class="img-responsive"></div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <h3 class="titulo">Recuperar Cuenta</h3>
                            <form role="form" method="post" action="<?php echo base_url(); ?>recuperar_action" id="formLogin">
                                <fieldset>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="# de R.U.C" name="ruc" type="text" maxlength="20">
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Usuario" name="usuario" type="text" maxlength="30">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Enviar</button>
                                    <a href="<?php echo base_url(); ?>" class="btn btn-danger">Volver</a>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.col-->
    </div><!-- /.row -->
</div>
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
                <button data-dismiss="modal" class="btn btn-default">Cerrar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script src="<?php echo base_url(); ?>public/js/jquery-1.11.1.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/main.js"></script>
<script>
    $('#formLogin').validate({
        rules: {
            "ruc": { required: true },
            "usuario":{ required:true },
        },
        submitHandler: function(form) {
            $.ajax({
                url: form.action,
                type: form.method,
                data: $(form).serialize(),
                success: function(response) {
                    var res = jQuery.parseJSON(response);
                    if (res.error == 0)
                    {
                        mostrarModalErrorVar('Recuperar Cuenta',res.mensaje);
                        setTimeout(function () {
                            window.location.href = '/panel';
                        },5000);
                    }
                    else
                    {
                        mostrarModalErrorVar('Recuperar Cuenta',res.mensaje);
                    }
                }
            });
        }
    });

    function mostrarModalErrorVar(titulo, mensaje) {
        $('#modalError').modal('show');
        $('#titulomodale').text(titulo);
        $('#mensajemodale').text(mensaje);
    }
</script>
</body>
</html>
