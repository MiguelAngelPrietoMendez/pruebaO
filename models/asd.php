<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
session_start();
include 'access_db.php';

$IdSolicitud = 23;
//Consulta de las solicitud validando el ultimo estado
$result = $mysqli->query("SELECT * FROM Solicitud INNER JOIN subtiposolicitud  ON Solicitud.IdSubtipoSolicitud =subtiposolicitud.IdSubtipoSolicitud INNER JOIN usuarios ON  Solicitud.idusuario = usuarios.idusuario WHERE Solicitud.IdSolicitud = " . $IdSolicitud);
$result2 = $mysqli->query("SELECT * FROM SolicitudProceso WHERE IdSolicitud = " . $IdSolicitud);
$general = $result->fetch_array();
?>
<html>
    <head>
        <title>Sub Table</title>
        <meta charset="utf-8">
        <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="../css/bootstrap-table.css" rel="stylesheet" type="text/css"/>
        <script src="../js/jquery-2.1.4.js" type="text/javascript"></script>
        <script src="../js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../js/bootstrap-table.js" type="text/javascript"></script>
    </head>
    <body>
        <div class="container">
            <h1>Sub Table</h1>
            <p>Use <code>onExpandRow</code> event to handle your detail view.</p>
            <table   class="table table-responsive table-hover" id="table" data-toggle="table"  data-detail-view="false">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Proceso</th>
                        <th>Fecha Creación</th>
                        <th>Observación</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = $result2->fetch_array()) {
                        ?>
                        <tr>
                            <td class="clickable" data-toggle="collapse" id="row1" data-target=".row<?php  echo $row['IdSolicitudProceso'];  ?>"><?php echo $row['IdSolicitudProceso']; ?></td>
                            <td><?php echo $row['Proceso']; ?></td>
                            <td><?php echo $row['FechaCreacion']; ?></td>
                            <td><?php echo $row['Observacion']; ?></td>
                        </tr>
                        </tr>
                        <tr class="collapse row<?php  echo $row['IdSolicitudProceso'];  ?>">
                            <td>child row</td>
                            <td><?php  echo $row['IdSolicitudProceso'];  ?></td>
                            <td>data</td>  
                            <td>data</td>
                        </tr>
                        <?php
                        $ultimoProceso = $row['Proceso'];
                    }
                    ?>           
                </tbody>

            </table>
        </div>
    </body>
</body>
</html>
