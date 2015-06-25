<?php
include 'access_db.php';

$IdSolicitud = $_POST['IdSolicitud'];
//Consulta de las solicitud validando el ultimo estado
$result = $mysqli->query("SELECT * FROM Solicitud INNER JOIN subtiposolicitud  ON Solicitud.IdSubtipoSolicitud =subtiposolicitud.IdSubtipoSolicitud INNER JOIN usuarios ON  Solicitud.idusuario = usuarios.idusuario WHERE Solicitud.IdSolicitud = " . $IdSolicitud);
$result2 = $mysqli->query("SELECT * FROM SolicitudProceso WHERE IdSolicitud = " . $IdSolicitud);
$general = $result->fetch_array();
?>
<script src="js/OntelJS.js" type="text/javascript"></script>
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
                        <!--<li><a href="#tab3default" data-toggle="tab">Default 3</a></li>-->
                        <!--<li class="dropdown">
                                                    <a href="#" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
                                                    <ul class="dropdown-menu" role="menu">
                                                        <li><a href="#tab4default" data-toggle="tab">Default 4</a></li>
                                                        <li><a href="#tab5default" data-toggle="tab">Default 5</a></li>
                                                    </ul>
                       </li>-->
                    </ul>
                </div>
                <div class="panel-body">
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="tab1default">        
                            <table id ="SolDes" class="table table-condensed table-hover table-striped" >
                                <tbody>
                                    <?php
                                    while ($row = $result2->fetch_array()) {
                                        ?>
                                        <tr>
                                            <td><?php echo $row['IdSolicitudProceso']; ?></td>
                                            <td><?php echo $row['Proceso']; ?></td>
                                            <td><?php echo $row['FechaCreacion']; ?></td>
                                            <td><?php echo $row['Observacion']; ?></td>
                                        </tr>
                                        <?php
                                    }
                                    ?>           
                                </tbody>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Proceso</th>
                                        <th>Fecha Creación</th>
                                        <th>Observación</th>
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
<!--PANELES DE INFORMACION GENERAL-->
<!--POPPUP INFORMACION-->

<div class="modal-footer">
    <a class="btn btn-default" data-toggle="modal" data-target="#Cancelacion">Cancelar Solicitud</a>
    <a  class="btn btn-primary" data-toggle="modal" data-target="#proceso">Siguiente Proceso</a>
</div>
<!--POPPUP DE VALIDACION CANCELACION-->
<div id="Cancelacion" class="modal fade" tabindex="-1" data-focus-on="input:first" style="display: none;">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" >×</button>
            <h4 class="modal-title">¿ Esta seguro que desea cancelar la solicitud ?</h4>
        </div>
        <div class="modal-body">
            <p>La solicitud  numero :  <?php echo $general['IdSolicitud']; ?>
                <br> Sera cancelada y no seguira con el soporte.
            </p>
        </div>
        <div class="modal-footer">
            <a class="btn btn-default" data-dismiss="modal" >No</a>
            <a class="btn btn-primary" data-toggle="modal" >Si</a>
        </div>
    </div>
</div>
<!--POPPUP DE VALIDACION CANCELACION-->
<!--POPPUO DE SIGUIENTE ESTADO-->
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
            <textarea class="form-control input-sm " type="textarea" id="message"
                      placeholder="Observaciones del la solicitud en el proceso" maxlength="250" rows="7"></textarea>
            <select class="form-control">
                <option value="0" selected="">Seleccione el proceso</option>

                <option value="1" >Abierto</option>
                <option value="2"></option>
            </select>
            <div class="modal-footer">
                <a class="btn btn-default" data-dismiss="modal">Close</a>
                <a class="btn btn-primary">Confirmar</a>
            </div>
        </div>
    </div>
</div>
<!--POPPUO DE SIGUIENTE ESTADO-->
<!--TAB VISUALIDAR  DE ARCHIVOS-->

<!--TAB VISUALIDAR  DE ARCHIVOS-->
<!--VER ARCHIVOS-->
<div id="view" class="modal fade" tabindex="-1" data-focus-on="input:first"  style="display: none;">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 id="nameFile" class="modal-title" ></h4>
        </div>
        <div class="modal-body" style="max-height: 420px;overflow-y: auto;">
            <div class="iframe-container" id="framefile"></iframe></div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
        </div>
    </div>
</div>
<!--VER ARCHIVOS-->
<iframe id="secretIFrame" src="" style="display:none; visibility:hidden;"></iframe>