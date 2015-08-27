<?php

session_start();
include 'access_db.php';
$obj = unserialize($_SESSION['OBJ']);
//Descripcion del proceso
$taDescriptionProcess = $mysqli->real_escape_string($_POST["taDescriptionProcess"]);
$IdSolicitud = $mysqli->real_escape_string($_POST["IdSolicitud"]);
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
        $sTypeProcess = "Onteal";
        break;
    case 3:
        $sTypeProcess = "Devuelto";
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
$file = "";
$count = 0;
$date = date("Y m d H i s");
for ($i = 0; $i < count($_FILES["file"]["name"]); $i++) {
//    if (file_exists("../uploadTicket/" . $_FILES["file"]["name"][$i])) {
//        echo $_FILES["file"]["name"][$i] . " El archivo ya existe. <BR>";
//    } else 
//    {

    if ($_FILES["file"]["name"][$i] === "" || empty($_FILES["file"]["name"][$i])) {
        echo "siass" . $_FILES["file"]["name"][$i];
        $count++;
    } else {
        echo "nokas" . $_FILES["file"]["name"][$i];
        if (move_uploaded_file($_FILES["file"]["tmp_name"][$i], "../uploadTicket/" . $_FILES["file"]["name"][$i])) {
            $path_parts = pathinfo($_FILES["file"]["name"][$i]);
            $image_path = $path_parts['filename'] . '_' . time() . '.' . $path_parts['extension'];
            echo "<BR>brebes subio en : " . "../uploadTicket/" . $_FILES["file"]["name"][$i];
            $path_parts = pathinfo($_FILES["file"]["name"][$i]);
            $image_path = $path_parts['filename'] . '_' . time() . '.' . $path_parts['extension'];
            rename("../uploadTicket/" . $_FILES["file"]["name"][$i], "../uploadTicket/" . $image_path);
            $file .=$image_path . "|";
            $count++;
            echo $count;
        } else {
            echo "Error subiendo el archivo \n Por favor comuniqueses con su administrador";
        }
    }
//    }
}
$result = $mysqli->query("INSERT INTO solicitudproceso (IdSolicitud,Proceso,Observacion,IdUsuario,Archivos)VALUES(" . $IdSolicitud . ",'" . $sTypeProcess . "','" . $taDescriptionProcess . "'," . $_SESSION['IdUsuario'] . ",'".$file."')");
if ($result) {
    //Proceso actualizado exitosamente
    header("Location: ../Inicio.php?ok=1");
} else {
    
//    echo "INSERT INTO solicitudproceso (IdSolicitud,Proceso,Observacion,IdUsuario)VALUES(" . $IdSolicitud . ",'" . $sTypeProcess . "','" . $taDescriptionProcess . "'," . $_SESSION['IdUsuario'] . ")";
    $obj->setUltimoError($mysqli->error);
    header("Location: ../Inicio.php?error=1");
}