<!DOCTYPE html>
<html lang="en">

    <head>

        <title>Sistema de Monitoreo</title>
        <meta charset="utf-8"/>
        <meta http-equiv="content-type" content="application/vnd.ms-excel; charset=UTF-8">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description"/>
        <meta content="Themesbrand" name="author"/>
        <!-- App favicon -->
        <link rel="shortcut icon" href="<?php echo base_url();?>public/images/favicon.ico">

        <!-- plugin css -->
        <link href="<?php echo base_url();?>public/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
        <!-- preloader css -->
        <link rel="stylesheet" href="<?php echo base_url();?>public/css/preloader.min.css" type="text/css" />

        <!-- Bootstrap Css -->
        <link href="<?php echo base_url();?>public/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="<?php echo base_url();?>public/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="<?php echo base_url();?>public/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

        <!-- DataTables -->
        <link href="<?php echo base_url();?>public/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>public/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

        <!-- Responsive datatable examples -->
        <link href="<?php echo base_url();?>public/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

        <!-- alertifyjs Css -->
        <link href="<?php echo base_url();?>public/libs/alertifyjs/build/css/alertify.min.css" rel="stylesheet" type="text/css" />

        <!-- alertifyjs default themes  Css -->
        <link href="<?php echo base_url();?>public/libs/alertifyjs/build/css/themes/default.min.css" rel="stylesheet" type="text/css" />
        
        <!-- Responsive Table css -->
        <link href="<?php echo base_url();?>public/libs/admin-resources/rwd-table/rwd-table.min.css" rel="stylesheet" type="text/css" />

        <link href="<?php echo base_url();?>public/libs/@fullcalendar/core/main.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>public/libs/@fullcalendar/daygrid/main.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>public/libs/@fullcalendar/bootstrap/main.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>public/libs/@fullcalendar/timegrid/main.min.css" rel="stylesheet" type="text/css" />
        
        <link href="<?php echo base_url();?>public/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
        
    </head>

    <?php 
    $layout='';
    $layout_mode ='';
    $layout_width = '';
    $layout_position = '';
    $topbar_color = '';
    $sidebar_size = '';
    $sidebar_color = '';
    
    foreach ($config as $key) {
        $layout=$key->layout;
        $layout_mode = $key->layout_mode;
        $layout_width = $key->layout_width;
        $layout_position = $key->layout_position;
        $topbar_color = $key->topbar_color;
        $sidebar_size = $key->sidebar_size;
        $sidebar_color = $key->sidebar_color;

    }


    if($layout=='vertical'){
        echo '
            <body data-layout-mode="'.$layout_mode.'" data-layout-size="'.$layout_width.'" data-layout-scrollable="'.$layout_position.'" data-topbar="'.$topbar_color.'" data-sidebar="'.$sidebar_color.'" data-sidebar-size="'.$sidebar_size.'" >
        ';
    }else{
        echo '
            <body f="'.$layout.'" data-layout="horizontal" data-layout-mode="'.$layout_mode.'" data-layout-size="'.$layout_width.'" data-layout-scrollable="'.$layout_position.'" data-topbar="'.$topbar_color.'" data-sidebar="'.$sidebar_color.'" data-sidebar-size="'.$sidebar_size.'" >
        ';
    }
    ?>
        <!-- Begin page -->
        <div id="layout-wrapper">
