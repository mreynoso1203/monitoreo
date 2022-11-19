<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
    <div class="logo_panel">
        <img src="<?php echo base_url(); ?>public/img/logo2.png" class="img-responsive" alt="">
    </div>
    <div class="profile-sidebar">
        <div class="profile-userpic">
            <img src="<?php echo base_url(); ?>public/img/user.png" class="img-responsive" alt="">
        </div>
        <div class="profile-usertitle">
            <div class="profile-usertitle-name"><?php echo (isset($_SESSION['_SESSIONUSERNOMBRE'])) ? $_SESSION['_SESSIONUSERNOMBRE'] : 'Usuario'; ?></div>
            <div class="profile-usertitle-status"><span class="indicator label-success"></span>Conectado</div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="divider"></div>
    <!--<form role="search">
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Search">
        </div>
    </form>-->
    <ul class="nav menu">
        <?php
            $mact = (isset($menu_activo)) ? $menu_activo : '';
            if (isset($menu))
            {
                if (!is_null($menu))
                {
                    foreach ($menu as $men)
                    {
                        if ($men == 'panel')
                        {
                            $act = ($mact == 'panel') ? 'active' : '';
                            echo '<li><a href="'.base_url().'" class="'.$act.'"><em class="fa fa-dashboard">&nbsp;</em> Panel</a></li>';
                        }
                        elseif ($men == 'voucher')
                        {
                            $act = ($mact == 'voucher') ? 'active' : '';
                            echo '<li><a href="'.base_url().'voucher" class="'.$act.'"><em class="fa fa-files-o">&nbsp;</em> Psicologos</a></li>';
                        }
                        elseif ($men == 'pasajeros')
                        {
                            $act = ($mact == 'pasajeros') ? 'active' : '';
                            echo '<li><a href="'.base_url().'pasajeros" class="'.$act.'"><em class="fa fa-users">&nbsp;</em> Pasajeros</a></li>';
                        }
                        elseif ($men == 'agencias')
                        {
                            $act = ($mact == 'agencias') ? 'active' : '';
                            echo '<li><a href="'.base_url().'agencias" class="'.$act.'"><em class="fa fa-desktop">&nbsp;</em> Agencias</a></li>';
                        }
                        elseif ($men == 'counters')
                        {
                            $act = ($mact == 'counters') ? 'active' : '';
                            echo '<li><a href="'.base_url().'counters" class="'.$act.'"><em class="fa fa-briefcase">&nbsp;</em> Counters</a></li>';
                        }
                        elseif ($men == 'promotores')
                        {
                            $act = ($mact == 'promotores') ? 'active' : '';
                            echo '<li><a href="'.base_url().'promotores" class="'.$act.'"><em class="fa fa-address-book-o">&nbsp;</em> Promotores</a></li>';
                        }
                        elseif ($men == 'planes')
                        {
                            $act = ($mact == 'planes') ? 'active' : '';
                            echo '<li><a href="'.base_url().'planes" class="'.$act.'"><em class="fa fa-file-text-o">&nbsp;</em> Planes</a></li>';
                        }
                        elseif ($men == 'cobranza')
                        {
                            $act = ($mact == 'cobranza') ? 'active' : '';
                            echo '<li><a href="'.base_url().'cobranza" class="'.$act.'"><em class="fa fa-money">&nbsp;</em> Cobranza</a></li>';
                        }
                        elseif ($men == 'beneficios')
                        {
                            $act = ($mact == 'beneficios') ? 'active' : '';
                            echo '<li><a href="'.base_url().'beneficios" class="'.$act.'"><em class="fa fa-check-square">&nbsp;</em> Beneficios</a></li>';
                        }
                        elseif ($men == 'servicios')
                        {
                            $act = ($mact == 'servicios') ? 'active' : '';
                            echo '<li><a href="'.base_url().'servicios" class="'.$act.'"><em class="fa fa-server">&nbsp;</em> Servicios</a></li>';
                        }
                        elseif ($men == 'consulta')
                        {
                            $act = ($mact == 'consulta') ? 'active' : '';
                            echo '<li><a href="'.base_url().'consulta" class="'.$act.'"><em class="fa fa-server">&nbsp;</em> Tipo Consulta</a></li>';
                        }
                        elseif ($men == 'asistencia')
                        {
                            $act = ($mact == 'asistencia') ? 'active' : '';
                            echo '<li><a href="'.base_url().'asistencia" class="'.$act.'"><em class="fa fa-clock-o">&nbsp;</em>asistencia</a></li>';
                        }
                        elseif ($men == 'paciente')
                        {
                            $act = ($mact == 'paciente') ? 'active' : '';
                            echo '<li><a href="'.base_url().'paciente" class="'.$act.'"><em class="fa fa-user">&nbsp;</em>Pacientes</a></li>';
                        }
                        elseif ($men == 'historial')
                        {
                            $act = ($mact == 'historial') ? 'active' : '';
                            echo '<li><a href="'.base_url().'historial" class="'.$act.'"><em class="fa fa-truck">&nbsp;</em>Consultas</a></li>';
                        }                                                
                    }
                }
            }
        ?>
        <li><a href="<?php echo base_url(); ?>logout"><em class="fa fa-power-off">&nbsp;</em> Cerrar Sesión</a></li>
    </ul>
</div><!--/.sidebar-->