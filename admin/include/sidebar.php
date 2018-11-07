

<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
        <div class="pull-left image">
            <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
            <p><?php echo $dataUser["primer_nombre"] . " " . $dataUser["primer_apellido"]; ?></p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
    </div>
    <!-- search form -->
    <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
            <input type="text" name="q" class="form-control" placeholder="Buscar...">
            <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
            </span>
        </div>
    </form>
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
        <li class="header">Menu de Navegación</li>
        <li class="<?php echo ( $controlador == 'Index' ) ? 'active' : '';?>"><a href="index.php?controlador=Index&accion=index"><i class="fa fa-home"></i> <span>Inicio</span></a></li>        
        <li class="treeview <?php echo ( $controlador == 'Seguridad' || $controlador == 'Seguridad' || $controlador == 'Usuario' || $controlador == 'Modulo' || $controlador == 'Perfil' || $controlador == 'Permiso') ? 'active' : '';?>">
            <a href="#">
                <i class="fa fa-unlock-alt"></i>
                <span>Panel de Seguridad</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li><a class="<?php echo ( $controlador == 'Seguridad') ? 'a_activo' : '';?>" href="index.php?controlador=Seguridad&accion=seguridad"><i class="fa fa-circle-o"></i> Seguridad</a></li>
                <li><a class="<?php echo ( $controlador == 'Usuario') ? 'a_activo' : '';?>" href="index.php?controlador=Usuario&accion=usuario"><i class="fa fa-circle-o"></i> Usuarios</a></li>
                <li><a class="<?php echo ( $controlador == 'Modulo') ? 'a_activo' : '';?>" href="index.php?controlador=Modulo&accion=modulo"><i class="fa fa-circle-o"></i> Modulos</a></li>
                <li><a class="<?php echo ( $controlador == 'Perfil') ? 'a_activo' : '';?>" href="index.php?controlador=Perfil&accion=perfil"><i class="fa fa-circle-o"></i> Perfiles</a></li>
                <li><a class="<?php echo ( $controlador == 'Permiso') ? 'a_activo' : '';?>" href="index.php?controlador=Permiso&accion=permiso"><i class="fa fa-circle-o"></i> Permisos</a></li>                
            </ul>
        </li>
        <li class="treeview <?php echo ( $controlador == 'Matricula' || $controlador == 'Pension'|| $controlador == 'GastoRetiro') ? 'active' : '';?>">
            <a href="#">
                <i class="fa fa-institution"></i>
                <span>Directivos</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li><a class="<?php echo ( $controlador == 'Matricula') ? 'a_activo' : '';?>" href="index.php?controlador=Matricula&accion=matricula"><i class="fa fa-circle-o"></i> Matriculas</a></li>
                <li><a class="<?php echo ( $controlador == 'Pension') ? 'a_activo' : '';?>" href="index.php?controlador=Pension&accion=index"><i class="fa fa-circle-o"></i> Pensiones</a></li>
                <li><a class="<?php echo ( $controlador == 'GastoRetiro') ? 'a_activo' : '';?>" href="index.php?controlador=GastoRetiro&accion=gasto_retiro"><i class="fa fa-circle-o"></i> Gastos - Retiros</a></li>
            </ul>
        </li>
        <li class="treeview <?php echo ( $controlador == 'Planilla' || $controlador == 'Grado' || $controlador == 'Director' || $controlador == 'Area' || $controlador == 'Asignatura' || $controlador == 'Plan' ) ? 'active' : '';?>">
            <a href="#">
                <i class="fa fa-cogs"></i>
                <span>Coordinadores</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">                
                <li><a class="<?php echo ( $controlador == 'Grado') ? 'a_activo' : '';?>" href="index.php?controlador=Grado&accion=grado"><i class="fa fa-circle-o"></i>Grados</a></li>
                <li><a class="<?php echo ( $controlador == 'Area') ? 'a_activo' : '';?>" href="index.php?controlador=Area&accion=area"><i class="fa fa-circle-o"></i>Area</a></li>
                <li><a class="<?php echo ( $controlador == 'Asignatura') ? 'a_activo' : '';?>" href="index.php?controlador=Asignatura&accion=asignatura"><i class="fa fa-circle-o"></i>Asignatura</a></li>
                <li><a class="<?php echo ( $controlador == 'Director') ? 'a_activo' : '';?>" href="index.php?controlador=Director&accion=director"><i class="fa fa-circle-o"></i>Directores de Grados</a></li>
                <li><a class="<?php echo ( $controlador == 'Plan') ? 'a_activo' : '';?>" href="index.php?controlador=Plan&accion=plan"><i class="fa fa-circle-o"></i>Plan de Estudios</a></li>
                <li><a class="<?php echo ( $controlador == 'Planilla') ? 'a_activo' : '';?>" href="index.php?controlador=Planilla&accion=planilla_grado"><i class="fa fa-circle-o"></i>Planilla de notas</a></li>
            </ul>
        </li>
        <li class="treeview <?php echo ( $controlador == 'Planeacion') ? 'active' : '';?>">
            <a href="#">
                <i class="fa fa-users"></i>
                <span>Docentes</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">                
                <li><a class="<?php echo ( $controlador == 'Planeacion') ? 'a_activo' : '';?>" href="index.php?controlador=Planeacion&accion=planeacion"><i class="fa fa-circle-o"></i>Planeación Semanal</a></li>                
            </ul>
        </li>
        <li class="treeview">
            <a href="#">
                <i class="fa  fa-mortar-board"></i>
                <span>Estudiantes</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                                
            </ul>
        </li>        
        <li class="treeview">
            <a href="#">
                <i class="fa  fa-bar-chart"></i>
                <span>Reportes</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li><a class="<?php echo ( $controlador == 'Planilla') ? 'a_activo' : '';?>" href="index.php?controlador=Moroso&accion=moroso"><i class="fa fa-circle-o"></i>Morosos Pensiones</a></li>                
            </ul>            
        </li>        
    </ul>
</section>
<!-- /.sidebar -->