<?php

session_start();
include 'access_db.php';
//Descripcion del proceso
$taDescriptionProcess = $mysqli->real_escape_string($_POST["taDescriptionProcess"]);
$IdSolicitud = $mysqli->real_escape_string($_POST["IdSolicitud"]);
echo $taDescriptionProcess;

//Proceso Siguiente (Select)
$selTypeProcess = 0;
if (isset($_POST["selTypeProcess"])) {
    $selTypeProcess = $_POST["selTypeProcess"];
}
$sTypeProcess = "";
switch ($selTypeProcess) {
    case 1:
        $sTypeProcess = "Abierto";
        break;
    case 2:
        $sTypeProcess = "ProcesoSistemas";
        break;
    case 3:
        $sTypeProcess = "Proceso";
        break;
    case 4:
        $sTypeProcess = "Resuelto";
        break;
    case 5:
        $sTypeProcess = "Cerrado";
        //Actualizar Fecha Fin de la Solicitud
        $result = $mysqli->query("UPDATE Solicitud SET FechaFin = now() WHERE IdSolicitud=" . $IdSolicitud);
        if (!$result) {
            header("Location: ../Inicio.php?error=2");
            return;
        }
        break;
    case 6:
        $sTypeProcess = "Cancelado";
        //Actualizar Fecha Fin de la Solicitud
        $result = $mysqli->query("UPDATE Solicitud SET FechaFin = now() WHERE IdSolicitud=" . $IdSolicitud);
        if (!$result) {
            header("Location: ../Inicio.php?error=2");
            return;
        }
        break;
}

$result = $mysqli->query("INSERT INTO solicitudproceso (IdSolicitud,Proceso,Observacion,IdUsuario)VALUES(" . $IdSolicitud . ",'" . $sTypeProcess . "','" . $taDescriptionProcess . "'," . $_SESSION['IdUsuario'] . ")");
if ($result) {
    //Proceso actualizado exitosamente
    header("Location: ../Inicio.php?ok=1");
} else {
     header("Location: ../Inicio.php?error=1");
}