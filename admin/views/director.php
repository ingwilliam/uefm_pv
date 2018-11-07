<?php
$controlador = "Director";
$accion = "director";
$titulo = "Director de Curso";
?>
<!DOCTYPE html>
<html>
    <head>
        <?php
        include 'include/head.php';
        ?>
    </head>
    <body class="hold-transition skin-blue sidebar-mini">

        <div class="wrapper">

            <header class="main-header">
                <?php
                include 'include/header.php';
                ?>
            </header>
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar">
                <?php
                include 'include/sidebar.php';
                ?>
            </aside>
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <?php
                if (count($vars["arrayPermiso"]) > 0) {
                    ?>                
                    <!-- Content Header (Page header) -->
                    <section class="content-header">
                        <h1>
                            <small><?php echo $titulo;?></small>
                        </h1>
                        <ol class="breadcrumb">
                            <li><a href="index.php?controlador=Index&accion=index"><i class="fa fa-home"></i> Inicio</a></li>
                            <li class="active"><?php echo $titulo;?></li>
                        </ol>
                    </section>

                    <!-- Main content -->
                    <section class="content">
                        <?php
                        if ($vars["alerta"] == 1) {
                            ?>
                            <div class="alert alert-success alert-dismissible">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                <h4><i class="icon fa fa-check"></i> Exitoso!</h4>
                                Registro creado.
                            </div>
                            <?php
                        }
                        if ($vars["alerta"] == 2) {
                            ?>
                            <div class="alert alert-info alert-dismissible">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                <h4><i class="icon fa fa-info"></i> Exitoso!</h4>
                                Registro editado.
                            </div>
                            <?php
                        }
                        if ($vars["alerta"] == 3) {
                            ?>
                            <div class="alert alert-danger alert-dismissible">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                <h4><i class="icon fa fa-ban"></i> Error!</h4>
                                <?php echo $vars["error"] ?>
                            </div>                        
                            <?php
                        }
                        ?>
                        <a href="index.php?controlador=<?php echo $controlador; ?>&accion=<?php echo $accion; ?>" class="btn btn-app"><i class="fa fa-list"></i>Listar</a>
                        <a href="index.php?controlador=<?php echo $controlador; ?>&accion=nuevo" class="btn btn-app"><i class="fa fa-file-o"></i>Nuevo</a>
                        <?php
                        if ($vars["formularioNuevo"]) {
                            ?>
                            <div class="row">                            
                                <div class="box box-primary">
                                    <div class="box-header with-border">
                                        <h3 class="box-title"><?php echo $vars["tituloMetodo"]; ?> <?php echo $titulo; ?></h3>
                                    </div>
                                    <!-- /.box-header -->
                                    <!-- form start -->
                                    <form class="form-validar form-horizontal" action="index.php?controlador=<?php echo $controlador; ?>&accion=<?php echo $vars["accion"]; ?>Registro" method="post" class="formvalidar" enctype="multipart/form-data">
                                        <div id="mensajevalida" class="alert alert-warning alert-dismissible" style="display: none">
                                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                            <h4 style="font-size: 14px"><i class="icon fa fa-warning"></i>Los siguientes campos son obligatorios</h4>
                                            <ul>

                                            </ul>
                                        </div>

                                        <div class="box-body">
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" for="curso">Grado</label>
                                                <div class="col-sm-10">
                                                    <?php $vars["formXhtml"]->select("curso", "curso", $vars["arrayRegistro"]["curso"], "form-control", "Grado", "", "curso", "id", "nombre", "", "1", " orden ASC"); ?>                                                
                                                </div>                                            
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" for="curso">Director del grado</label>
                                                <div class="col-sm-10">
                                                    <?php $vars["formXhtml"]->selectExtraDirector("usuario", "usuario", $vars["arrayRegistro"]["usuario"], "form-control", "Director del grado", "", "usuario", "id", "primer_nombre", "perfil", "usuario_perfil.perfil=4 AND usuario.activo=1", " primer_nombre ASC" , array(),"",":: Seleccione ::","","usuario_perfil"); ?>                                                                                                                              
                                                </div>                                            
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" for="activar">Activar?</label>
                                                <div class="col-sm-10">
                                                    <?php $vars["formXhtml"]->radio("activo", "activo", $vars["arrayRegistro"]["activo"], "", "Activar?", "", array("1" => "Si", "0" => "No")); ?>
                                                </div>
                                            </div>

                                        </div><!-- /.box-body -->

                                        <!-- /.box-body -->
                                        <div class="box-footer">
                                            <input type="hidden" id="id" name="id" value="<?php echo $vars["arrayRegistro"]["id"] ?>" />
                                            <button type="submit" class="btn btn-info">Guardar</button>
                                        </div>
                                        <!-- /.box-footer -->
                                    </form>
                                </div>
                            </div>
                            <?php
                        } else {
                            ?>                        
                            <div class="row">
                                <div class="box box-primary">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Buscador</h3>
                                    </div>
                                    <!-- /.box-header -->
                                    <!-- form start -->
                                    <form class="form-horizontal" action="index.php" method="get">
                                        <input type="hidden" name="controlador" value="<?php echo $controlador; ?>" />
                                        <input type="hidden" name="accion" value="<?php echo $accion; ?>" />
                                        <input type="hidden" name="busqueda" value="1" />
                                        <div class="box-body">
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" for="anio_matricula">Año matricula</label>
                                                <div class="col-sm-10">
                                                    <?php $vars["formXhtml"]->select("anio", "anio", $vars["arrayRegistro"]["anio"], "validar form-control", "Año matricula", "", "", "", "", "", "", "", $vars["anios"]); ?>                                                
                                                </div>                                            
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" for="curso">Grado</label>
                                                <div class="col-sm-10">
                                                    <?php $vars["formXhtml"]->select("curso", "curso", $vars["arrayRegistro"]["curso"], "validar form-control", "Grado", "", "curso", "id", "nombre", "", "1", " nombre ASC"); ?>                                                
                                                </div>                                            
                                            </div>
                                        </div>
                                        <!-- /.box-body -->
                                        <div class="box-footer">
                                            <button type="submit" class="btn btn-info">Realizar busqueda</button>
                                            <button type="button" class="btn btn-primary" onclick="location.href = 'index.php?controlador=<?php echo $controlador; ?>&accion=<?php echo $accion; ?>'">Limpiar busqueda</button>
                                        </div>
                                        <!-- /.box-footer -->
                                    </form>
                                </div>
                                <div class="box">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Directores de Grados registrados en el Sistema</h3>
                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body">
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <th>Año</th>
                                                    <th>Grado</th>
                                                    <th>Director del grado</th>
                                                    <th>Activo</th>
                                                    <th>Editar</th>
                                                </tr>
                                                <?php
                                                foreach($vars["arrayPaginador"] as $item) {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $item['anio']; ?></td>
                                                        <td><?php echo $item['grado']; ?></td>
                                                        <td><?php echo $item['primer_nombre']." ".$item['segundo_nombre']." ".$item['primer_apellido']." ".$item['segundo_apellido']; ?></td>
                                                        <td>
                                                            <?php
                                                            if ($item["activo"]) {
                                                                ?>
                                                                <a href="index.php?controlador=<?php echo $controlador; ?>&accion=director&id=<?php echo $item['id']; ?>&a=0"><span class="fa fa-plus-circle"/></a>
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <a href="index.php?controlador=<?php echo $controlador; ?>&accion=director&id=<?php echo $item['id']; ?>&a=1"><span class="fa fa-times"/></a>
                                                                <?php
                                                            }
                                                            ?>
                                                        </td>
                                                        <td><a href="index.php?controlador=<?php echo $controlador; ?>&accion=editarRegistro&id=<?php echo $item['id']; ?>"><span class="fa fa-pencil-square-o"/> </a></td>
                                                    </tr>
                                                    <?php
                                                }
                                                ?>
                                            </tbody>    
                                        </table>
                                    </div>
                                    <!-- /.box-body -->
                                    <div class="box-footer clearfix">
                                        <ul class="pagination pagination-sm no-margin pull-right">
                                            <?php
                                            echo $vars["paginador"]->pages("btn");
                                            ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- /.row -->
                            <?php
                        }
                        ?>
                    </section>
                    <!-- /.content -->
                    <?php
                } else {
                    ?>
                    <br/>
                    <div class="alert alert-info alert-dismissible">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                        <h4><i class="icon fa fa-info"></i> No tienen permisos para ingresar a este modulo!</h4>
                        Comunicarse con el administrador del sistema
                    </div>
                    <?php
                }
                ?>
            </div>
            <!-- /.content-wrapper -->
            <footer class="main-footer">
                <?php
                include 'include/footer-main.php';
                ?>
            </footer>

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <?php
                include 'include/control-sidebar.php';
                ?>
            </aside>
            <!-- /.control-sidebar -->
            <!-- Add the sidebar's background. This div must be placed
                 immediately after the control sidebar -->
            <div class="control-sidebar-bg"></div>
        </div>
        <!-- ./wrapper -->
        <?php
        include 'include/footer.php';
        ?>
    </body>
</html>