<table border="1" cellpadding="0" cellspacing="0" width="530" style="border:1px solid #727272;font-size:10px;margin-top:10px;">

    <tr>

        <!-- <td rowspan="2" width="50%" align="center"><h1 style="padding:2px 5px;margin:0px;font-size:14px;border-right:1px solid #DADADA">BENEFICIOS</h1></td> -->

        <td width="50%" align="center"><h1 style="padding:2px 5px;margin:0px;font-size:14px;border-right:1px solid #DADADA">BENEFICIOS</h1></td>

        <td width="20%" align="center"><h1 style="padding:2px 5px;margin:0px;font-size:14px;"><?php echo $plan; ?></h1></td>

    </tr>

    <!-- <tr>

        <td align="center"><p style="margin:0px;padding:2px 5px;margin-left:10px;"><b>SCHENGEN / MUNDIAL</b></p></td>

    </tr> -->

    <?php 

    if(count($beneficios) > 0 ){

    foreach ($beneficios as $ben) { 

    ?>

    <tr>

        <td><p style="margin:0px;padding:2px 5px;margin-right:10px;"><?php echo $ben->nombre; ?></p></td>

        <td align="center"><p style="margin:0px;padding:2px 5px;margin-left:10px;"><?php echo $ben->descripcion; ?></p></td>

    </tr>

    <?php }} ?>

</table>