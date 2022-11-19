<meta charset="utf-8"/>
<title>.::Login Chazqui::.</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta content="Premium Multipurpose Admin & Dashboard Template" name="description"/>
<meta content="Themesbrand" name="author"/>
<!-- App favicon -->
<link rel="shortcut icon" href="public/images/favicon.ico">

<!-- preloader css -->
<link rel="stylesheet" href="public/css/preloader.min.css" type="text/css" />

<!-- Bootstrap Css -->
<link href="public/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
<!-- Icons Css -->
<link href="public/css/icons.min.css" rel="stylesheet" type="text/css" />
<!-- App Css-->
<link href="public/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
<div class="auth-page">
    <div class="container-fluid p-0">
        <div class="row g-0">
            <div class="col-xxl-3 col-lg-4 col-md-5">
                <div class="auth-full-page-content d-flex p-sm-5 p-4">
                    <div class="w-100">
                        <div class="d-flex flex-column h-100">
                            <div class="mb-4 mb-md-5 text-center">
                                <a href="<?php echo base_url();?>" class="d-block auth-logo">
                                    <img src="public/images/chazki.png" alt="" height="35"> <span class="logo-txt"></span>
                                </a>
                            </div>
                            <div class="auth-content my-auto">
                                <div class="text-center">
                                    <h5 class="mb-0">Intranet </h5>
                                    <p class="text-muted mt-2">Control de cambios o seguimiento de consultas que llegan desde la web.</p>
                                </div>
                                <!--<form class="custom-form mt-4 pt-2" action="<?php //echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">-->
                                <form role="form" method="post" action="<?php echo base_url(); ?>login" id="formLogin">
                                    <div class="mb-3 <?php //echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                                        <label class="form-label" for="ruc">DNI</label>
                                        <input type="text" class="form-control" id="ruc" placeholder="Enter username" name="ruc" value="">
                                        <span class="text-danger"><?php //echo $username_err; ?></span>
                                    </div>                                
                                    <div class="mb-3 <?php //echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                                        <label class="form-label" for="usuario">Usuario SICA</label>
                                        <input type="text" class="form-control" id="usuario" placeholder="Enter username" name="usuario" value="">
                                        <span class="text-danger"><?php //echo $username_err; ?></span>
                                    </div>
                                    <div class="mb-3 <?php //echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                                        <div class="d-flex align-items-start">
                                            <div class="flex-grow-1">
                                                <label class="form-label" for="txtclave" >Clave</label>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <div class="">
                                                    <!--<a href="javascript::void(0);" class="text-muted">Olvidaste tu contraseña?</a>-->
                                                </div>
                                            </div>
                                        </div>

                                        <div class="input-group auth-pass-inputgroup">
                                            <input type="password" class="form-control" placeholder="Enter password"  name="contra" id="contra" value="" aria-label="Password" aria-describedby="password-addon">
                                            <span class="text-danger"><?php //echo $password_err; ?></span>
                                            <!--<button class="btn btn-light ms-0" type="submit"  id="password-addon"><i class="mdi mdi-eye-outline"></i></button>-->
                                        </div>
                                    </div>
                                    <div class="row mb-4" style="display:none;">
                                        <div class="col">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="remember-check">
                                                <label class="form-check-label" for="remember-check">
                                                    Recuerdame
                                                </label>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="mb-3">
                                        <button class="btn btn-danger w-100 waves-effect waves-light" type="button" onclick="upd_login();">Iniciar Sesión</button>
                                    </div>
                                </form>

                                <div class="mt-5 text-center" style="display:none;">
                                    <p class="text-muted mb-0">No tienes una cuenta ? <a href="javascript::void(0);" class="text-primary fw-semibold"> Registrate ahora </a> </p>
                                </div>
                            </div>
                            <div class="mt-4 mt-md-5 text-center">
                                <p class="mb-0">© <script>
                                        document.write(new Date().getFullYear())
                                    </script> <i class="mdi mdi-heart text-danger"></i> by CHAZKI</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end auth full page content -->
            </div>
            <!-- end col -->
            <div class="col-xxl-9 col-lg-8 col-md-7">
                <div class="auth-bg pt-md-5 p-4 d-flex">
                    <div class="bg-overlay bg-danger"></div>
                    <ul class="bg-bubbles">
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                    </ul>
                    <!-- end bubble effect -->
                    <div class="row justify-content-center align-items-center">
                        <div class="col-xl-7">
                            <div class="p-0 p-sm-4 px-xl-0">
                                <div id="reviewcarouselIndicators" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-indicators carousel-indicators-rounded justify-content-start ms-0 mb-0">
                                        <button type="button" data-bs-target="#reviewcarouselIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                        <button type="button" data-bs-target="#reviewcarouselIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                        <button type="button" data-bs-target="#reviewcarouselIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                    </div>
                                    <!-- end carouselIndicators -->
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <div class="testi-contain text-white">
                                                <i class="bx bxs-quote-alt-left text-success display-6"></i>
                                                <h4 class="mt-4 fw-medium lh-base text-white"></h4>
                                                <div class="mt-4 pt-3 pb-5">
                                                    <div class="d-flex align-items-start">
                                                        <div class="flex-shrink-0">
                                                            <img src="public/images/users/avatar-2.jpg" class="avatar-md img-fluid rounded-circle" alt="...">
                                                        </div>
                                                        <div class="flex-grow-1 ms-3 mb-4">
                                                            <h5 class="font-size-18 text-white">Maribel de la Cruz</h5>
                                                            <p class="mb-0 text-white-50">Por fin ya puedo realizar mis actividades de manera rápida..</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                                    <!-- end carousel-inner -->
                                </div>
                                <!-- end review carousel -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container fluid -->
</div>
<!-- JAVASCRIPT -->
<script src="public/libs/jquery/jquery.min.js"></script>
<script src="public/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="public/libs/metismenu/metisMenu.min.js"></script>
<script src="public/libs/simplebar/simplebar.min.js"></script>
<script src="public/libs/node-waves/waves.min.js"></script>
<script src="public/libs/feather-icons/feather.min.js"></script>
<!-- pace js -->
<script src="public/libs/pace-js/pace.min.js"></script>

<script>
    $('#formLogin').validate({

        rules: {
            "ruc": { required: true },
            "usuario":{ required:true },
            "contra":{ required:true },
        },
        submitHandler: function(form) {
            $.ajax({
                url: form.action,
                type: form.method,
                data: $(form).serialize(),
                success: function(response) {
                    alert(response);
                    
                    if (response != "error")
                    {   
                        //if(response==10){
                            window.location.href = '/monitoreo/mod_evento';
                        //}else{
                        //    window.location.href = '/chazqui/mod_repuestos/';
                        //}
                    }
                    else
                    {
                        mostrarModalErrorVar('Acceso al Panel',response);
                    }
                }
            });
        }
    });
    function get_data(id){
        return $('#'+id).val();
    }
    function upd_login(){
        var data =  new FormData();
        data.append('ruc',get_data('ruc'));
        data.append('usuario',get_data('usuario'));
        data.append('contra',get_data('contra'));
        $.ajax({
          type:'post',
          contentType:false,
          url:'<?php echo base_url()?>login',
          data: data,
          processData:false,
          beforeSend:function(){
          },
          success: function(response){
            if(response=='si'){
                window.location.href = '/monitoreo/agenda/';
            }else{
            }
          }
        });
    }


    function mostrarModalErrorVar(titulo, mensaje) {
        $('#modalError').modal('show');
        $('#titulomodale').text(titulo);
        $('#mensajemodale').text(mensaje);
    }
</script>