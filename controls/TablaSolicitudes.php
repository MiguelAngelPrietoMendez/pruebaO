<?php
session_start();
include 'models/access_db.php';
?>
<script src="js/jquery-2.1.4.js" type="text/javascript"></script>
<script src="js/bootstrap.min.js" type="text/javascript"></script>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
<link href="css/OntealStyle.css" rel="stylesheet" type="text/css"/>

<?php
//Consulta de las solicitud  G
if ($_SESSION['Rol'] == "Administrador") { //Valida Permisos Administrador
    if (isset($_POST['ticket'])) { // Valida si es por buscador
        $result = $mysqli->query("SELECT * FROM Solicitud WHERE IdSolicitud=" . $_POST['ticket']);
    } else {
        $result = $mysqli->query("SELECT * FROM Solicitud");
    }
} else {//Valida permisos usuario
    if (isset($_POST['ticket'])) {// Valida si es por buscador
        $result = $mysqli->query("SELECT * FROM Solicitud WHERE IdSolicitud=" . $_POST['ticket'] . " AND IdUsuario = " . $_SESSION['IdUsuario']);
    } else {
        $result = $mysqli->query("SELECT * FROM Solicitud WHERE IdUsuario =" . $_SESSION['IdUsuario']);
    }
}
?>
<table data-url="inicio.php" data-toggle="table"  data-pagination="true" data-search="true"  data-height="400"  data-show-refresh="true" data-show-toggle="true" >
    <thead>
        <tr>
            <th data-field="id" data-align="left" data-sortable="true"># Solicitud</th>
            <th >Nombre</th>
            <th data-align="left" data-sortable="true">Fecha Inicio</th>
            <th data-align="left" data-sortable="true">Fecha Fin</th>
            <th data-align="center" data-sortable="true">Estado</th>
            <th >Ver</th>
        </tr>
    </thead>
    <tbody>
        <?php
        while ($row = $result->fetch_array()) {
            ?>
            <tr>
                <td><?php echo $row['IdSolicitud']; ?></td>
                <td><?php echo $row['Solicitud']; ?></td>
                <td><?php echo $row['FechaInicio']; ?></td>
                <td><?php echo $row['FechaFin']; ?></td>
                <td>
                    <?php
                    $resultEstado = $mysqli->query("SELECT * FROM SolicitudProceso WHERE IdSolicitud =" . $row['IdSolicitud'] . " ORDER BY solicitudproceso.FechaCreacion DESC LIMIT 1");
                    if ($rowEstado = $resultEstado->fetch_array()) {

                        if ($rowEstado['Proceso'] == 'Abierto') {
                            echo "<span class='label label-primary'>Abierto</span>";
                        }
                        if ($rowEstado['Proceso'] == 'Cancelado') {
                            echo "<span class='label label-danger'>Cancelado</span>";
                        }
                        if ($rowEstado['Proceso'] == 'Cerrado') {
                            echo "<span class='label label-default'>Cerrado</span>";
                        }
                        if ($rowEstado['Proceso'] == 'Proceso') {
                            echo "<span class='label label-success'>Proceso</span>";
                        }
                        if ($rowEstado['Proceso'] == 'ProcesoSistemas') {
                            echo "<span class='label label-success'>Proceso Sistemas</span>";
                        }
                        if ($rowEstado['Proceso'] == 'Resuelto') {
                            echo "<span class='label label-warning'>Resuelto</span>";
                        }
                    }
                    ?>
                </td>
                <td>
                    <button type=button' class='btn btn-default' data-toggle='modal'  href="#stack1" onclick="InfoSoli(<?php echo $row['IdSolicitud']; ?>);" >
                        <i class='fa fa-eye fa-fw fa-lg'></i>
                    </button>
                </td>
                <?php
            }
            ?>
        </tr>
    </tbody>
</table>
<script src="js/bootstrap-table.js" type="text/javascript"></script>
<script src="js/bootstrap-table-es-MX.js" type="text/javascript"></script>
<link href="css/bootstrap-table.css" rel="stylesheet" type="text/css"/>