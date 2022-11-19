<html><head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <style>
        html {
            margin: 0;
        }
        @font-face {
            font-family: abadi;
            src: url("<?php echo base_url(); ?>public/fonts/abadimtcondensed.ttf");
        }
        body {
            font-family: abadi;
            margin: 8mm 8mm 2mm 8mm;
        }
        body td, body p {
            font-family: abadi;
        }
        hr {
            page-break-after: always;
            border: 0;
            margin: 0;
            padding: 0;
        }
    </style>
</head><body>
<table border="0" cellpadding="4" cellspacing="0" width="530" style="font-size:11px;font-family: Consolas, Andale Mono, Lucida Console, Lucida Sans Typewriter, Monaco, Courier New, monospace;">
    <tr>
        <td align="right" valign="middle" colspan="2"><img src="<?php echo base_url(); ?>public/img/logo.png" width="180" height="100"></td>
    </tr>
    <tr>
        <td colspan="2"></td>
    </tr>
    <tr>
        <td colspan="2"><h1 style="font-size:16px;color:#000000;border-bottom:1px solid #E3E3E3;">INFORMACIÓN DE VOUCHER Nº: <?php echo $insertvou; ?></h1></td>
    </tr>
    <tr>
        <td align="left"><b>PLAN ELEGIDO:</b> <?php echo $plan; ?></td>
        <td align="right" width="180"><b>FECHA EMITIDA:</b> <?php echo date('d').'/'.date('m').'/'.date('Y'); ?></td>
    </tr>
    <tr>
        <td colspan="2">
            <table border="0" width="100%">
                <tr>
                    <td><b>DESTINO:</b> <?php echo $destino; ?></td>
                    <td><b>N# DE DÍAS:</b> <?php echo $dias; ?></td>
                    <td><b>VIG. DESDE:</b> <?php echo $desde; ?></td>
                    <td><b>VIG. HASTA:</b> <?php echo $hasta; ?></td>