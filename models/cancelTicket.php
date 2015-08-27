<?php

/*
 * Cancelaciond de ticket   , Sin validacion de estado
 * Regla de negocios 
 * Jaime A. Boayca 
 * 13 de Julio 2015 
 * 
 * Cancelacion de ticket   -> Cambio de proceso a cancelado ,  en vista se valida que no se siga trabajando 
 * Solo la cancelacion y Resulto puedo alterar el estado de Solicitud.FechaFin Agregrando la fecha final  de la orden
 * 
 */
session_start();
include 'access_db.php';
$IdSolicitud = $mysqli->real_escape_string($_POST["IdSolicitud"]);
$sObservacionCancelacion = $mysqli->real_escape_string($_POST["taCancelacion"]);
$sTypeProcess = "Cancelado";
//Actualizar Fecha Fin de la Solicitud
$result = $mysqli->query("UPDATE Solicitud SET FechaFin = now() WHERE IdSolicitud=" . $IdSolicitud);
if (!$result) {
    header("Location: ../Inicio.php?error=2");
    return;
}
$result = $mysqli->query("INSERT INTO solicitudproceso (IdSolicitud,Proceso,Observacion,IdUsuario)VALUES(" . $IdSolicitud . ",'" . $sTypeProcess . "','".$sObservacionCancelacion."'," . $_SESSION['IdUsuario'] . ")");
if ($result) {
    //Proceso actualizado exitosamente
    header("Location: ../Inicio.php?ok=1");
} else {
//    echo "INSERT INTO solicitudproceso (IdSolicitud,Proceso,Observacion,IdUsuario)VALUES(" . $IdSolicitud . ",'" . $sTypeProcess . "','" . $taDescriptionProcess . "'," . $_SESSION['IdUsuario'] . ")";
    header("Location: ../Inicio.php?error=1");
}


