<?php
include 'models/access_db.php';
if (!isset($_SESSION['IdUsuario'])) {
    header("Location: ./index.php");
}
?>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="inicio.php" id="logo">
                <img id="logo" src="img/logo.png" alt=""></a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li>
                    <!--ESPACIO DE NOTIFICACIONES DEPENDIENTO DEL ROL-->
                    <a href="#"><span class="badge">
                            <?php
                            $nTickect = 0;
                            if (isset($_SESSION['Rol']) && $_SESSION['Rol'] == "Administrador") {
                                $resultTickects = $mysqli->query("SELECT * FROM Solicitud WHERE  Estado = 1 AND FechaFin IS NULL");
                            } else
                            if (isset($_SESSION['Rol']) && $_SESSION['Rol'] == "Usuario") {
                                $resultTickects = $mysqli->query("SELECT * FROM Solicitud WHERE  Estado = 1 AND IdUsuario = " . $_SESSION['IdUsuario'] . " AND FechaFin IS NULL");
                            }
                            $nRow = $resultTickects->num_rows;
                            if ($nRow > 0) {
                                while ($Solicitud = $resultTickects->fetch_array()) {
                                    $resultSolicitud = $mysqli->query("SELECT * FROM SolicitudProceso WHERE IdSolicitud =" . $Solicitud['IdSolicitud'] . " ORDER BY solicitudproceso.FechaCreacion DESC LIMIT 1");
                                    $nRowProceso = $resultSolicitud->num_rows;
                                    if ($nRowProceso > 0) {
                                        if ($Proceso = $resultSolicitud->fetch_array()) {
                                            if (isset($_SESSION['Rol']) && $_SESSION['Rol'] == "Administrador") {
                                                if (($Proceso['Proceso'] != "Cancelado") && ($Proceso['Proceso'] != "Cerrado") && ($Proceso['Proceso'] != "Proceso")) {
                                                    $nTickect = $nTickect + 1;
                                                }
                                            } else {
                                                if (($Proceso['Proceso'] != "Abierto") && ($Proceso['Proceso'] != "Cerrado") && ($Proceso['Proceso'] != "Cancelado") && ($Proceso['Proceso'] != "ProcesoSistemas") && ($Proceso['Proceso'] != "Cancelado")) {
                                                    $nTickect = $nTickect + 1;
                                                }
                                            }
                                        }
                                    }
                                }
                            }

                            echo $nTickect;
                            ?>



                        </span>Ver Ticket's</a>
                </li>
                <li>
                    <a href="inicio.php">Inicio <span class="sr-only">(current)</span></a>
                </li>

                <li>
                    <a href="solicitud.php">Crear Ticket</a>
                </li>
            </ul>
            <form class="navbar-form navbar-left" role="search" action="inicio.php
                  " method="POST">
                <div class="form-group">
                    <input name="ticket" type="text" class="form-control" placeholder="Buscar # Ticket" required>
                </div>
                <button type="submit" class="btn btn-default">Buscar</button>
            </form>
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="#">Manuales <span class="sr-only">(current)</span></a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                       aria-expanded="false">Opciones<span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li>
                            <a id="crea_usuario"  href="Usuarios.php">Crear Usuario</a>
                        </li>
                        <li>
                            <a href="Usuarios.php">Modificar Usuario</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="index.php?Close=true">Cerrar Sesión</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>