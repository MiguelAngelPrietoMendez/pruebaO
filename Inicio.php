<?php
session_start();
include 'models/access_db.php';
include './models/Logger.php';
$obj = unserialize($_SESSION['OBJ']);
?>
<html lang="es">
    <?php
    include 'head.php';
    ?>  
    <script>
        $(document).ready(function ()
        {
<?php
if (!isset($_SESSION['menBienvenida'])) {
    $_SESSION['menBienvenida'] = 1;
    if (isset($_SESSION['Nombres'])) {
        ?>
         Alert_Info("Bienvenido <?php echo $_SESSION['Nombres']; ?>");
        <?php
    }
}
?>

<?php
if (isset($_GET['ok'])) {
    ?>
                Alert_Info("<?php echo $obj->getAccion($_GET['ok']); ?>");
    <?php
}
?>
<?php
if (isset($_GET['error'])) {
    ?>
                Alert_Warning("<?php echo $obj->getError($_GET['error']); ?>" + "\n" + "<?php echo $obj->getUltimoError(); ?>");
    <?php
}
?>
        });
    </script>   
    <body>
        <?php
        include 'Menu.php';
        ?>  
        <?php
        //Consulta de las solicitud  
        if ($_SESSION['Rol'] == "Administrador") { //Valida Permisos Administrador
            if (isset($_POST['ticket'])) { // Valida si es por buscador
                $result = $mysqli->query("SELECT * FROM Solicitud INNER JOIN Usuarios ON Solicitud.IdUsuario =  Usuarios.IdUsuario WHERE IdSolicitud=" . $_POST['ticket']);
            } else {
                $result = $mysqli->query("SELECT * FROM Solicitud INNER JOIN Usuarios ON Solicitud.IdUsuario =  Usuarios.IdUsuario ORDER BY IdSolicitud DESC");
            }
        } else {//Valida permisos usuario
            if (isset($_POST['ticket'])) {// Valida si es por buscador
                $result = $mysqli->query("SELECT * FROM Solicitud  INNER JOIN Usuarios ON Solicitud.IdUsuario =  Usuarios.IdUsuario WHERE Solicitud.IdSolicitud=" . $_POST['ticket'] . " AND Usuarios.IdUsuario = " . $_SESSION['IdUsuario']);
            } else {
                $result = $mysqli->query("SELECT * FROM Solicitud  INNER JOIN Usuarios ON Solicitud.IdUsuario =  Usuarios.IdUsuario WHERE Solicitud.IdUsuario =" . $_SESSION['IdUsuario'] . " ORDER BY IdSolicitud DESC");
            }
        }
        ?>
        <div id="stack1" class="modal fade" tabindex="-1" data-focus-on="input:first" style="display: none;">
        </div>
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
        <div class="section">           
            <h1 id ="titulo" class="text-center">SOLICITUDES</h1>    

        </div>
        <div class="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <table data-url="inicio.php" data-toggle="table"   data-pagination="true" data-search="true"  data-height="400"  data-show-refresh="true" data-show-toggle="true" >
                            <thead>
                                <tr>
                                    <th data-field="id" data-align="left" data-sortable="true"># Solicitud</th>
                                    <th >Nombre</th>
                                    <th >Usuario</th>
                                    <th data-align="left" data-sortable="true">Fecha Inicio</th>
                                    <th data-align="left" data-sortable="true">Fecha Fin</th>
                                    <th data-align="center" data-sortable="true">Estado</th>
                                    <th >Ver</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($row = $result->fetch_array()) {
                                    $resultEstado = $mysqli->query("SELECT * FROM SolicitudProceso WHERE IdSolicitud =" . $row['IdSolicitud'] . " ORDER BY solicitudproceso.FechaCreacion DESC LIMIT 1");
                                    if ($rowEstado = $resultEstado->fetch_array()) {
                                        if (isset($_GET['Det'])) {
                                            if (isset($_SESSION['Rol']) && $_SESSION['Rol'] == 'Administrador') {
                                                if ($rowEstado['Proceso'] == 'Abierto' || $rowEstado['Proceso'] == 'Onteal') {
                                                    echo"<tr>"
                                                    . "<td>" . $row['IdSolicitud'] . "</td>
                                                           <td>" . $row['nombre'] . "</td>
                                                           <td>" . $row['Nombres'] . "</td>
                                                           <td>" . $row['FechaInicio'] . "</td>
                                                           <td>" . $row['FechaFin'] . "</td>";
                                                    echo "<td>";
                                                    if ($rowEstado['Proceso'] == 'Abierto') {
                                                        echo "<span class='label label-primary'>Abierto</span>";
                                                    }
                                                    if ($rowEstado['Proceso'] == 'Onteal') {
                                                        echo "<span class='label label-success'>Onteal</span>";
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
                                        } elseif (isset($_SESSION['Rol']) && $_SESSION['Rol'] == 'Usuario') {
                                            if ($rowEstado['Proceso'] == 'Proceso' || $rowEstado['Proceso'] == 'Resuelto') {
                                                echo"<tr>"
                                                . "<td>" . $row['IdSolicitud'] . "</td>
                                                           <td>" . $row['nombre'] . "</td>
                                                               <td>" . $row['Nombres'] . "</td>
                                                           <td>" . $row['FechaInicio'] . "</td>
                                                           <td>" . $row['FechaFin'] . "</td>";
                                                echo "<td>";
                                                if ($rowEstado['Proceso'] == 'Devuelto') {
                                                    echo "<span class='label label-success'>Proceso</span>";
                                                }
                                                if ($rowEstado['Proceso'] == 'Resuelto') {
                                                    echo "<span class='label label-warning'>Resuelto</span>";
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
                                        }
                                    } else {
                                        echo"<tr>"
                                        . "<td>" . $row['IdSolicitud'] . "</td>
                                             <td>" . $row['nombre'] . "</td>
                                             <td>" . $row['Nombres'] . "</td>             
                                             <td>" . $row['FechaInicio'] . "</td>
                                             <td>" . $row['FechaFin'] . "</td>";
                                        echo "<td>";
                                        if ($rowEstado['Proceso'] == 'Abierto') {
                                            echo "<span class='label label-primary'>Abierto</span>";
                                        }
                                        if ($rowEstado['Proceso'] == 'Cancelado') {
                                            echo "<span class='label label-danger'>Cancelado</span>";
                                        }
                                        if ($rowEstado['Proceso'] == 'Cerrado') {
                                            echo "<span class='label label-default'>Cerrado</span>";
                                        }
                                        if ($rowEstado['Proceso'] == 'Devuelto') {
                                            echo "<span class='label label-success'>Devuelto</span>";
                                        }
                                        if ($rowEstado['Proceso'] == 'Onteal') {
                                            echo "<span class='label label-success'>Onteal</span>";
                                        }
                                        if ($rowEstado['Proceso'] == 'Resuelto') {
                                            echo "<span class='label label-warning'>Resuelto</span>";
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
                                }
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <?php
    include 'pie.php';
    ?>
    <script src="js/bootstrap-table.js" type="text/javascript"></script>
    <script src="js/bootstrap-table-es-MX.js" type="text/javascript"></script>
    <link href="css/bootstrap-table.css" rel="stylesheet" type="text/css"/>
</html>