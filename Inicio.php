<?php
session_start();
include 'models/access_db.php';
?>
<html lang="es">
    <?php
    include 'head.php';
    ?>  
    <script>

    </script>

    <body>
        <?php
        include 'Menu.php';
        ?>  
        <?php
        //Consulta de las solicitud validando el ultimo estado
        $result = $mysqli->query("SELECT * FROM solicitud INNER JOIN  solicitudproceso ON solicitud.IdSolicitud = solicitudproceso.idsolicitud ORDER BY solicitudproceso.FechaCreacion DESC");
        ?>
        <!--ALERTAS-->
        <div id="area_alertas"></div>   
        <!--ALERTAS-->
        <!--POPPUP DE INFORMACION DE LA SOLICITUD-->
        <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                </div>
            </div>
        </div>
        <!--POPPUP DE INFORMACION DE LA SOLICITUD-->
     
        <!--POPPUO DE SIGUIENTE ESTADO-->
        <!--POPPUO DE SIGUIENTE ESTADO-->
        <div class="section">           
            <h1 id ="titulo" class="text-center">SOLICITUDES ABIERTAS</h1>            
        </div>


        <div class="section">
            <div class="container">
                <div class="row">
                    <div id ="scroll"  class="col-md-12">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th># Solicitud</th>
                                    <th>Nombre&nbsp;</th>
                                    <th>Fecha Inicio</th>
                                    <th>Fecha Final</th>
                                    <th>Estado</th>
                                    <th>Ver</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($row = $result->fetch_array()) {
                                    echo"<tr>"
                                    . "<td>" . $row['IdSolicitud'] . "</td>
                                    <td>" . $row['Solicitud'] . "</td>
                                    <td>" . $row['FechaInicio'] . "</td>
                                    <td>" . $row['FechaFin'] . "</td>";
                                    echo "<td>";
                                    if ($row['Proceso'] == 'Abierto') {
                                        echo "<span class='label label-primary'>Abierto</span>";
                                    }
                                    if ($row['Proceso'] == 'Cancelado') {
                                        echo "<span class='label label-danger'>Cancelado</span>";
                                    }
                                    if ($row['Proceso'] == 'Cerrado') {
                                        echo "<span class='label label-default'>Cerrado</span>";
                                    }
                                    if ($row['Proceso'] == 'Proceso') {
                                        echo "<span class='label label-success'>Proceso</span>";
                                    }
                                    ?>
                                    </td>
                                <td>
                                    <button type=button' class='btn btn-default' data-toggle='modal' data-target='#myModal' onclick="InfoSoli(<?php echo $row['IdSolicitud']; ?>);">
                                        <i class='fa fa-eye fa-fw fa-lg'></i>
                                    </button>
                                </td>
                                <!--data-target='#myModal'-->
                                <?php
                            }
                            ?>

<!--                                        <span class="label label-warning">Resuelto</span>-->
          <!--<span class="label label-success">Proceso</span>-->
         <!--<span class="label label-default">Cerrado</span>-->
         <!--<span class="label label-danger">Cancelado</span>-->
          <!--<span class="label label-primary">Abierto</span>-->



<!--                                <tr>
                                    <td>2</td>
                                    <td>Jacob</td>
                                    <td>July 21, 1983 01:15:00</td>
                                    <td>@fat</td>
                                    <td>
                                        <span class="label label-success">Proceso</span>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">
                                            <i class="fa fa-eye fa-fw fa-lg"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Jacob</td>
                                    <td>July 21, 1983 01:15:00</td>
                                    <td>@fat</td>
                                    <td>
                                        <span class="label label-default">Cerrado</span>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">
                                            <i class="fa fa-eye fa-fw fa-lg"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Jacob</td>
                                    <td>July 21, 1983 01:15:00</td>
                                    <td>@fat</td>
                                    <td>
                                        <span class="label label-danger">Cancelado</span>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">
                                            <i class="fa fa-eye fa-fw fa-lg"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Jacob</td>
                                    <td>July 21, 1983 01:15:00</td>
                                    <td>@fat</td>
                                    <td>
                                        <span class="label label-success">Proceso Sis</span>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">
                                            <i class="fa fa-eye fa-fw fa-lg"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Jacob</td>
                                    <td>July 21, 1983 01:15:00</td>
                                    <td>@fat</td>
                                    <td>
                                        <span class="label label-primary">Abierto</span>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">
                                            <i class="fa fa-eye fa-fw fa-lg"></i>
                                        </button>
                                    </td>
                                </tr>-->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </body>
    <?php
    include 'pie.php';
    ?>
</html>