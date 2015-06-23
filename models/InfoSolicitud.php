<?php
include 'access_db.php';

$IdSolicitud = $_POST['IdSolicitud'];
//Consulta de las solicitud validando el ultimo estado
$result = $mysqli->query("SELECT * FROM Solicitud WHERE IdSolicitud = " . $IdSolicitud);
$result2 = $mysqli->query("SELECT * FROM SolicitudProceso WHERE IdSolicitud = " . $IdSolicitud);
$general = $result->fetch_array();
?>
<script src="js/OntelJS.js" type="text/javascript"></script>
<!--POPPUP INFORMACION-->
<div class="modal-body">
    <form class="form-horizontal" role="form">
        <div class="form-group has-feedback">
            <div class="col-sm-2">
                <label for="inputEmail3" class="control-label">#Solicitud :</label>
            </div>
            <div class="col-sm-4">
                <label for="inputEmail3" class="control-label" style="font-weight: normal;
                       "><?php echo $general['IdSolicitud']; ?></label>
            </div>
            <div class="col-sm-2">
                <label for="inputEmail3" class="control-label">Solicitud :</label>
            </div>
            <div class="col-sm-3">

                <label for="text" class="control-label" style="font-weight: normal;
                       "><?php echo $general['Solicitud']; ?></label>
            </div>
        </div>
        <hr>
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
                <label for="inputEmail3" class="control-label" style='display:initial;'>Fecha Inicio</label>
            </div>
            <div class="col-sm-4">
                <?php echo $general['FechaInicio']; ?>
            </div>
            <div class="col-sm-2">
                <label for="inputEmail3" class="control-label"  style='display:initial;'>Fecha Fin</label>
            </div>
            <div class="col-sm-4">
                <?php echo $general['FechaFin']; ?>
            </div>
        </div>
        <div class="form-group"></div>
    </form>
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
    <div class="modal-footer">
        <a class="btn btn-default" data-toggle="modal" data-target="#Cancelacion">Cancelar Solicitud</a>
        <a  class="btn btn-primary" data-toggle="modal" data-target="#proceso">Siguiente Proceso</a>
    </div>
</div>
<!--POPPUP INFORMACION-->

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
                <a class="btn btn-primary">Save changes</a>
            </div>
        </div>
    </div>
</div>
 <!--POPPUO DE SIGUIENTE ESTADO-->