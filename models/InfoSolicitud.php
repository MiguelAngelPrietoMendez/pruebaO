<?php
session_start();
include 'access_db.php';

$IdSolicitud = $_POST['IdSolicitud'];
//Consulta de las solicitud validando el ultimo estado
$result = $mysqli->query("SELECT * FROM Solicitud INNER JOIN subtiposolicitud  ON Solicitud.IdSubtipoSolicitud =subtiposolicitud.IdSubtipoSolicitud INNER JOIN usuarios ON  Solicitud.idusuario = usuarios.idusuario WHERE Solicitud.IdSolicitud = " . $IdSolicitud);
$result2 = $mysqli->query("SELECT * FROM SolicitudProceso WHERE IdSolicitud = " . $IdSolicitud);
$general = $result->fetch_array();
?>
<script src="js/OntelJS.js" type="text/javascript"></script>

<script src="js/fileinput.js" type="text/javascript"></script>
<script src="js/fileinput.min.js" type="text/javascript"></script>
<script src="js/fileinput_locale_es.js" type="text/javascript"></script>
<link href="css/fileinput.css" rel="stylesheet" type="text/css"/>
<!--POPPUP INFORMACION-->
<div class="modal-body">
    <form class="form-horizontal" role="form">
        <div class="form-group has-feedback" style="background-color:rgb(60, 83, 83); color:white" >
            <div class="col-sm-2">
                <label for="inputEmail3" class="control-label">#Solicitud :</label>
            </div>
            <div class="col-sm-1">
                <label for="inputEmail3" class="control-label" style="font-weight: normal;
                       "><?php echo $general['IdSolicitud']; ?></label>
            </div>
            <div class="col-sm-2">
                <label for="inputEmail3" class="control-label">Solicitud :</label>
            </div>
            <div class="col-sm-2">

                <label for="text" class="control-label" style="font-weight: normal;
                       "><?php echo $general['nombre']; ?></label>
            </div>
            <div class="col-sm-2">
                <label for="inputEmail3" class="control-label">Usuario :</label>
            </div>
            <div class="col-sm-2">

                <label for="text" class="control-label" style="font-weight: normal;
                       "><?php echo $general['Nombres'] . "  " . $general['Apellidos']; ?></label>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-2">
                <label for="inputEmail3" class="control-label" style='display:initial;'>Tipo Solicitud:</label>
            </div>
            <div class="col-sm-4">
                <?php
                if ($general['Tipo'] == 1) {
                    echo "Software";
                } else {
                    echo "Hardware";
                }
                ?>
            </div>
            <div class="col-sm-2">
                <label for="inputEmail3" class="control-label"  style='display:initial;'> <?php
                    if ($general['Tipo'] == 1) {
                        echo "Software: ";
                    } else {
                        echo "Hardware: ";
                    }
                    ?></label>
            </div>
            <div class="col-sm-4">
                <?php echo $general['SubTipoSolicitud']; ?>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-2">
                <label for="inputPassword3" class="control-label">Descipción:</label>
            </div>
            <div class="col-sm-10">
                <div class="row">
                    <div class="col-md-12">
                        <p><?php echo utf8_encode($general['Descripcion']); ?></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-2">
                <label for="inputEmail3" class="control-label" style='display:initial;'>Fecha Inicio:</label>
            </div>
            <div class="col-sm-4">
                <?php echo $general['FechaInicio']; ?>
            </div>
            <div class="col-sm-2">
                <label for="inputEmail3" class="control-label"  style='display:initial;'>Fecha Fin :</label>
            </div>
            <div class="col-sm-4">
                <?php echo $general['FechaFin']; ?>
            </div>
        </div>
        <div class="input-group">
            <div class="col-md-12">
                <hr>
            </div>
            <span class="input-group-btn">
                <button class="btn btn-default" id ="Verifica" type="button" >
                    <i id="icon-cambio" class="fa fa-2x fa-fw fa-angle-double-down"></i>
                </button>
            </span>
        </div>
    </form>
    <!--PANELES DE INFORMACION GENERAL-->
    <div class="row" id ="SolDes">
        <div class="col-md-12">
            <div class="panel with-nav-tabs panel-default">
                <div class="panel-heading">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab1default" data-toggle="tab">Procesos</a></li>
                        <li><a href="#tab2default" data-toggle="tab">Archivos</a></li>

                    </ul>
                </div>
                <div class="panel-body">
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="tab1default">        
                            <table  id="table" data-url="inicio.php" data-toggle="table"   data-height="300" data-show-toggle="true" >
                                <tbody>
                                    <?php
                                    while ($row = $result2->fetch_array()) {
                                        ?>
                                        <tr>
                                            <td class="clickable" data-toggle="collapse" id="row1" data-target=".row<?php echo $row['IdSolicitudProceso']; ?>"><?php echo $row['IdSolicitudProceso']; ?></td>
                                            <td class="clickable" data-toggle="collapse" id="row1" data-target=".row<?php echo $row['IdSolicitudProceso']; ?>"><?php echo $row['Proceso']; ?></td>
                                            <td class="clickable" data-toggle="collapse" id="row1" data-target=".row<?php echo $row['IdSolicitudProceso']; ?>"><?php echo $row['FechaCreacion']; ?></td>
                                            <td class="clickable" data-toggle="collapse" id="row1" data-target=".row<?php echo $row['IdSolicitudProceso']; ?>"><?php echo $row['Observacion']; ?></td>
                                            <td class="clickable" data-toggle="collapse" id="row1" data-target=".row<?php echo $row['IdSolicitudProceso']; ?>"><?php
                                                if (!empty($row['Archivos'])) {
                                                    echo '<i class="fa fa-2x fa-fw fa-paperclip"></i>';
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                        <?php
                                        $rutas = $row['Archivos'];
                                        $ruta = explode('|', $rutas);
                                        $a = 1;
                                        $cont = count($ruta);
                                        $cont--;
                                        foreach ($ruta as $value) {
                                            if ($a <= (count($ruta) - 1)) {
                                                ?>
                                                <tr class="collapse row<?php echo $row['IdSolicitudProceso']; ?>">

                                                    <?php
                                                    $a++;
                                                    $ext = explode('.', $value);
                                                    ?>
                                                    <td></td>
                                                    <td><h4 class="media-heading"><?php echo $ext[0]; ?></h4></td>
                                                    <td><a class="btn btn-default view-pdf" data-toggle="modal" data-target="#view" href="<?php echo $value; ?>"><i class="fa fa-2x fa-fw pull-right fa-binoculars"></i></a>
                                                    </td>
                                                    <td><a class="btn btn-default download" onclick="file('<?php echo $value; ?>');"  ><i class="fa fa-2x fa-floppy-o fa-fw pull-right"></i></a>
                                                    </td>
                                                </tr>

                                                <?php
                                            }
                                        }
                                        ?>
                                        <?php
                                        $ultimoProceso = $row['Proceso'];
                                    }
                                    ?>           
                                </tbody>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Proceso</th>
                                        <th>Fecha Creación</th>
                                        <th>Observación</th>
                                        <th>Archivos</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="tab2default">
                            <div class="col-md-12">
                                <ul class="media-list">
                                    <?php
                                    $rutas = $general['Archivos'];
                                    $ruta = explode('|', $rutas);
                                    $a = 1;
                                    $cont = count($ruta);
                                    $cont--;
                                    foreach ($ruta as $value) {
                                        if ($a <= (count($ruta) - 1)) {
                                            $a++;
                                            $ext = explode('.', $value);
                                            if ($ext[1] == "pdf" && $ext[1] !== "") {
                                                ?>
                                                <li class="media">
                                                    <i class="fa fa-5x fa-fw pull-left fa-file-pdf-o"></i>
                                                    <div class="media-body">
                                                        <h4 class="media-heading"><?php echo $ext[0]; ?></h4>
                                                        <a class="btn btn-default download" onclick="file('<?php echo $value; ?>');"  ><i class="fa fa-2x fa-floppy-o fa-fw pull-right"></i></a>
                                                        <a class="btn btn-default view-pdf" data-toggle="modal" data-target="#view" href="<?php echo $value; ?>"><i class="fa fa-2x fa-fw pull-right fa-binoculars"></i></a>
                                                    </div>
                                                </li>
                                            <?php } elseif ($ext[1] == "xls" && $ext[1] !== "") {
                                                ?>
                                                <li class="media">
                                                    <i class="fa fa-5x -pdf-o fa-fw pull-left fa-file-excel-o" ></i>
                                                    <div class="media-body">
                                                        <h4 class="media-heading"><?php echo $ext[0]; ?></h4>
                                                        <a class="btn btn-default download" onclick="file('<?php echo $value; ?>');"  ><i class="fa fa-2x fa-floppy-o fa-fw pull-right"></i></a>
                                                    </div>
                                                </li>

                                            <?php } elseif ($ext[1] == "doc" && $ext[1] !== "") { ?>
                                                <li class="media">
                                                    <i class="fa fa-5x fa-fw pull-left -image-o fa-file-text-o"></i>
                                                    <div class="media-body">
                                                        <h4 class="media-heading"><?php echo $ext[0]; ?></h4>
                                                        <a class="btn btn-default download" onclick="file('<?php echo $value; ?>');"  ><i class="fa fa-2x fa-floppy-o fa-fw pull-right"></i></a>
                                                    </div>
                                                </li>
                                            <?php } elseif ($ext[1] == "png" || $ext[1] == "jpg" || $ext[1] == "gif" && $ext[1] !== "") { ?>
                                                <li class="media">
                                                    <i class="fa fa-5x fa-fw  pull-left fa-file-image-o"></i>
                                                    <div class="media-body">
                                                        <h4 class="media-heading"><?php echo $ext[0]; ?></h4>
                                                        <a class="btn btn-default download" onclick="file('<?php echo $value; ?>');"  ><i class="fa fa-2x fa-floppy-o fa-fw pull-right"></i></a>
                                                        <a class="btn btn-default view-pdf" data-toggle="modal" data-target="#view" href="<?php echo $value; ?>"><i class="fa fa-2x fa-fw pull-right fa-binoculars"></i></a>

                                                    </div>
                                                </li>
                                                <?php
                                            }
                                        }
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <?php
    if ($ultimoProceso != 'Cerrado' && $ultimoProceso != 'Cancelado') {
        switch ($ultimoProceso) {

            case 'Abierto':
                if (isset($_SESSION['Rol']) && $_SESSION['Rol'] == 'Administrador') {
                    echo '<a class = "btn btn-primary" data-toggle = "modal" data-target = "#proceso">Siguiente Proceso</a>';
                }
                break;
            case 'Devuelto':
                if (isset($_SESSION['Rol']) && $_SESSION['Rol'] == 'Usuario') {
                    echo '<a class = "btn btn-primary" data-toggle = "modal" data-target = "#proceso">Siguiente Proceso</a>';
                }
                echo '<a class = "btn btn-primary" data-toggle = "modal" data-target = "#proceso">Siguiente Proceso</a>';

                break;
            case 'Onteal':
                if (isset($_SESSION['Rol']) && $_SESSION['Rol'] == 'Administrador') {
                    echo '<a class = "btn btn-primary" data-toggle = "modal" data-target = "#proceso">Siguiente Proceso</a>';
                }
                break;
            case 'Resuelto':
                if (isset($_SESSION['Rol']) && $_SESSION['Rol'] == 'Usuario') {
                    echo '<a class = "btn btn-primary" data-toggle = "modal" data-target = "#proceso">Siguiente Proceso</a>';
                }
                break;
        }
        echo '<a class="btn btn-default" data-toggle="modal" data-target="#Cancelacion">Cancelar Solicitud</a>';
    }
    ?>
</div>
<!--PANELES DE INFORMACION GENERAL-->

<!--POPPUP DE VALIDACION CANCELACION-->
<div id="Cancelacion" class="modal fade" tabindex="-1" data-focus-on="input:first" style="display: none;">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" >×</button>
            <h4 class="modal-title">¿ Esta seguro que desea cancelar la solicitud ?</h4>
        </div>
        <form class="form-horizontal" role="form" method="POST" action="models/cancelTicket.php" enctype="multipart/form-data">

            <div class="modal-body">

                <p>La solicitud  numero :  <?php echo $general['IdSolicitud']; ?>
                    <br> Sera cancelada y no seguira con el soporte.
                </p>
                <textarea name="taCancelacion" class="form-control input-sm " type="textarea" id="message"
                          placeholder="Observaciones del la cancelación  de la solicitud" maxlength="250" rows="7" required></textarea>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="IdSolicitud" value="<?php echo $general['IdSolicitud']; ?> " />
                <a class="btn btn-default" data-dismiss="modal">No</a>
                <!--CANCELACION DE  SOLICITUD-->
                <button  type="submit" class="btn btn-primary">Si</button>
            </div>
        </form>
    </div>
</div>
<!--POPPUP DE VALIDACION CANCELACION-->

<!--POPPUP DE SIGUIENTE ESTADO O PROCESO-->
<div id="proceso" class="modal fade" tabindex="-1" data-focus-on="input:first" style="display: none;">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h2 class="modal-title"><b>Siguiente Proceso</b></h2>
        </div>
        <div class="modal-body">              
            <div class="col-sm-2 col-md-12">
                <h4>Observaciones al siguien proceso</h4>
            </div>
            <form class="form-horizontal" role="form" id="FormSolicitud" method="POST" action="models/createProceso.php" enctype="multipart/form-data">
                <textarea name="taDescriptionProcess" class="form-control input-sm " type="textarea" id="message"
                          placeholder="Observaciones del la solicitud en el proceso" maxlength="250" rows="7" required></textarea>
                          <?php
                          switch ($ultimoProceso) {
                              case 'Abierto':
                                  if (isset($_SESSION['Rol']) && $_SESSION['Rol'] == 'Administrador') {
                                      echo ' <input type="hidden" name="selTypeProcess" value="2"/>';
                                  }
                                  break;
                              case 'Devuelto':
//                                  if (isset($_SESSION['Rol']) && $_SESSION['Rol'] == 'Usuario') {
                                      ?>
                            <select name = "selTypeProcess" class = "form-control">
                                <option value = "0" selected = "" >Seleccione el proceso</option>
                                <option value = "2">Onteal</option>
                                <option value = "5">Cerrado</option>
                            </select>
                            <?php
//                        }
                        break;
                    case 'Onteal':
                        if (isset($_SESSION['Rol']) && $_SESSION['Rol'] == 'Administrador') {
                            ?>
                            <select name = "selTypeProcess" class = "form-control">
                                <option value = "0" selected = "" >Seleccione el proceso</option>
                                <option value = "3">Devuelto</option>
                                <option value = "4">Resuelto</option>
                            </select>
                            <?php
                        }
                        break;
                    case 'Resuelto':
                        if (isset($_SESSION['Rol']) && $_SESSION['Rol'] == 'Usuario') {
                            ?>
                            <select name = "selTypeProcess" class = "form-control">
                                <option value = "0" selected = "" >Seleccione el proceso</option>
                                <option value = "2">Onteal</option>
                                <option value = "5">Cerrado</option>
                            </select>
                            <?php
                        }
                        break;
                }
                ?>
                <input   name="file[]" id="input-700" type="file" multiple=true class="file-loading">

                <input type="hidden" name="IdSolicitud" value="<?php echo $IdSolicitud; ?>" />
                <div class="modal-footer">
                    <a class="btn btn-default" data-dismiss="modal">Cancelar</a>
                    <button  type="submit" class="btn btn-primary">Confirmar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--POPPUP DE SIGUIENTE ESTADO-->

<!--VER ARCHIVOS-->
<div id="view" class="modal fade" tabindex="-1" data-focus-on="input:first"  style="display: none;">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 id="nameFile" class="modal-title" ></h4>
        </div>
        <div class="modal-body" style="max-height: 420px;overflow-y: auto;">
            <div class="iframe-container" id="framefile"></div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
        </div>
    </div>
</div>
<iframe id="secretIFrame" src="" style="display:none; visibility:hidden;"></iframe>
<script src="js/bootstrap-table.js" type="text/javascript"></script>
<script src="js/bootstrap-table-es-MX.js" type="text/javascript"></script>
<link href="css/bootstrap-table.css" rel="stylesheet" type="text/css"/>
<script>
                                                            $("#input-700").fileinput({
                                                                language: "es",
                                                                uploadUrl: "http://localhost/site/file-upload-batch",
                                                                allowedFileExtensions: ["jpg", "png", "gif", "doc", "xls", "pdf", "xlsx", "zip", "rar"],
                                                                minFileCount: 1,
                                                                maxFileCount: 5,
                                                                uploadAsync: true
                                                            });
</script> 
<!--VER ARCHIVOS-->