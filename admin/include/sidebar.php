

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
        <li class="treeview <?php echo ( $controlador == 'Seguridad' || $controlador == 'Usuario' || $controlador == 'Modulo' || $controlador == 'Perfil' || $controlador == 'Permiso') ? 'active' : '';?>">
            <a href="#">
                <i class="fa fa-unlock-alt"></i>
                <span>Panel de Seguridad</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li><a href="index.php?controlador=Seguridad&accion=seguridad"><i class="fa fa-circle-o"></i> Seguridad</a></li>
                <li><a href="index.php?controlador=Usuario&accion=usuario"><i class="fa fa-circle-o"></i> Usuarios</a></li>
                <li><a href="index.php?controlador=Modulo&accion=modulo"><i class="fa fa-circle-o"></i> Modulos</a></li>
                <li><a href="index.php?controlador=Perfil&accion=perfil"><i class="fa fa-circle-o"></i> Perfiles</a></li>
                <li><a href="index.php?controlador=Permiso&accion=permiso"><i class="fa fa-circle-o"></i> Permisos</a></li>                
            </ul>
        </li>
        <li class="treeview <?php echo ( $controlador == 'Matricula') ? 'active' : '';?>">
            <a href="#">
                <i class="fa fa-institution"></i>
                <span>Directivos</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li><a href="index.php?controlador=Matricula&accion=matricula"><i class="fa fa-circle-o"></i> Matriculas</a></li>
            </ul>
        </li>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-cogs"></i>
                <span>Coordinadores</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                                
            </ul>
        </li>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-users"></i>
                <span>Docentes</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                              
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
    </ul>
</section>
<!-- /.sidebar -->