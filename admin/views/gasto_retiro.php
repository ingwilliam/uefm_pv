<?php
$controlador = "GastoRetiro";
$accion = "gasto_retiro";
$titulo = "Gasto o Retiro";
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
                            Directivos
                            <small>Gastos Retiros del sistema</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li><a href="index.php?controlador=Index&accion=index"><i class="fa fa-home"></i> Inicio</a></li>
                            <li>Directivos</li>
                            <li class="active">Gastos Retiros del sistema</li>
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
                                                <label class="col-sm-2 control-label" for="tipo">Tipo</label>
                                                <div class="col-sm-10">
                                                    <?php $vars["formXhtml"]->select("tipo", "tipo", $vars["arrayRegistro"]["tipo"], "validar form-control", "Tipo", "", "", "", "", "", "", "", array("Gastos generales" => "Gastos generales", "Nomina" => "Nomina", "Mantenimiento" => "Mantenimiento", "Colmedica" => "Colmedica", "Colsubsidio" => "Colsubsidio", "Seguridad social" => "Seguridad social", "Servicios" => "Servicios", "Impuestos" => "Impuestos", "Trasporte" => "Trasporte", "Retiros cuenta corriente UEFM" => "Retiros cuenta corriente UEFM", "Retiros cuenta corriente Maria Barbosa" => "Retiros cuenta corriente Maria Barbosa")); ?>
                                                </div>                                            
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" for="descripcion">Descripción</label>
                                                <div class="col-sm-10">
                                                    <?php $vars["formXhtml"]->textarea("descripcion", "descripcion", $vars["arrayRegistro"]["descripcion"], "form-control", "Descripción"); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" for="costo">Costo</label>
                                                <div class="col-sm-10">
                                                    <?php $vars["formXhtml"]->inputtext("text", "costo", "costo", $vars["arrayRegistro"]["costo"], "validar form-control numeric", "Costo"); ?>
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
                                                <label class="col-sm-2 control-label" for="tipo">Tipo</label>
                                                <div class="col-sm-10">
                                                    <?php $vars["formXhtml"]->select("tipo", "tipo", $vars["arrayRegistro"]["tipo"], "validar form-control", "Tipo", "", "", "", "", "", "", "", array("Gastos generales" => "Gastos generales", "Nomina" => "Nomina", "Mantenimiento" => "Mantenimiento", "Colmedica" => "Colmedica", "Colsubsidio" => "Colsubsidio", "Seguridad social" => "Seguridad social", "Servicios" => "Servicios", "Impuestos" => "Impuestos", "Trasporte" => "Trasporte", "Retiros cuenta corriente UEFM" => "Retiros cuenta corriente UEFM", "Retiros cuenta corriente Maria Barbosa" => "Retiros cuenta corriente Maria Barbosa")); ?>
                                                </div>                                            
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" for="fecha_inicio">Fecha inicio</label>
                                                <div class="col-sm-4">
                                                    <?php
                                                    $vars["formXhtml"]->inputtext("text", "fecha_inicio", "fecha_inicio", $vars["arrayRegistro"]["fecha_inicio"], "validar form-control calendario", "Fecha inicio", "", "", "", "", "", "", true);
                                                    ?>
                                                </div>
                                                <label class="col-sm-2 control-label" for="fecha_fin">Fecha fin</label>
                                                <div class="col-sm-4">
                                                    <?php
                                                    $vars["formXhtml"]->inputtext("text", "fecha_fin", "fecha_fin", $vars["arrayRegistro"]["fecha_fin"], "validar form-control calendario", "Fecha fin", "", "", "", "", "", "", true);
                                                    ?>
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
                            </div>
                            <div class="row">
                                <div class="col-md-3 col-sm-6 col-xs-12">
                                    <div class="info-box bg-yellow">
                                        <span class="info-box-icon"><i class="fa  fa-money"></i></span>

                                        <div class="info-box-content">
                                            <span class="info-box-text">Total Gastos</span>
                                            <span class="info-box-number">$<?php echo number_format($vars["gastos"]["total"]); ?></span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                    <!-- /.info-box -->
                                </div>
                                <!-- /.col -->
                                <div class="col-md-3 col-sm-6 col-xs-12">
                                    <div class="info-box bg-red">
                                        <span class="info-box-icon"><i class="fa  fa-credit-card"></i></span>

                                        <div class="info-box-content">
                                            <span class="info-box-text">Total Retiros</span>
                                            <span class="info-box-number">$<?php echo number_format($vars["retiros"]["total"]); ?></span>                                            
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                    <!-- /.info-box -->
                                </div>
                                <!-- /.col -->
                            </div>
                            <div class="row">
                                <div class="box">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Gastos y Retiros registrados en el Sistema</h3>
                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body">
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <th>Fecha Registro</th>
                                                    <th>Fecha Modificación</th>
                                                    <th>Tipo</th>
                                                    <th>Descripción</th>
                                                    <th>Costo</th>
                                                    <th>Editar</th>
                                                </tr>
                                                <?php
                                                foreach ($vars["arrayPaginador"] as $item) {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $item['fecha_crear']; ?></td>
                                                        <td><?php echo $item['fecha_editar']; ?></td>
                                                        <td><?php echo $item['tipo']; ?></td>
                                                        <td><?php echo $item['descripcion']; ?></td>
                                                        <td>$<?php echo number_format($item['costo']); ?></td>
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