<?php

$a = "123";
session_start();
include 'access_db.php';

$itName = $mysqli->real_escape_string($_POST["itName"]);
$taDescription = $mysqli->real_escape_string($_POST["taDescription"]);
$selApplication = 0;
if (isset($_POST["selApplicationSoft"]) && $_POST["selApplicationSoft"] > 0 && $_POST["selType"] == 1) {
    $selApplication = $_POST["selApplicationSoft"];
    echo "SOFT: " . $selApplication . " - " . $_POST["selApplicationSoft"];
}
if (isset($_POST["selApplicationHard"]) && $_POST["selApplicationHard"] > 0 && $_POST["selType"] == 2) {
    $selApplication = $_POST["selApplicationHard"];
    echo "HARD: " . $selApplication . " - " . $_POST["selApplicationHard"];
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
if ($count == count($_FILES["file"]["name"])) {
    $result = $mysqli->query("INSERT INTO solicitud (nombre,Descripcion,Archivos,IdUsuario,IdSubTipoSolicitud)VALUES"
            . "('" . $itName . "','" . $taDescription . "','" . $file . "'," . $_SESSION['IdUsuario'] . "," . $selApplication . ")");
    if ($result) {
        $result2 = $mysqli->query("SELECT IdSolicitud FROM solicitud ORDER BY IdSolicitud DESC LIMIT 1");
        $row2 = $result2->fetch_array();
        $IdSolicitud = $row2["IdSolicitud"];
        $result3 = $mysqli->query("INSERT INTO solicitudproceso (IdSolicitud,Proceso,IdUsuario)VALUES(" . $IdSolicitud . ",'Abierto'," . $_SESSION['IdUsuario'] . ")");
        if ($result3) {
            //INSERT EXITOSO
            header("Location: ../Inicio.php?ok=1");
        } else {
            echo "Error insertantod Solicidud  \n " . "INSERT INTO solicitudproceso (IdSolicitud,Proceso)VALUES(" . $IdSolicitud . ",'Abierto')";
            header("Location: ../Inicio.php?error=5");
        }
    } else {
        echo "INSERT INTO solicitud (nombre,Descripcion,Archivos,IdUsuario,IdSubTipoSolicitud)VALUES"
        . "('" . $itName . "','" . $taDescription . "','" . $file . "'," . $_SESSION['IdUsuario'] . "," . $selApplication . ")";
        header("Location: ../Inicio.php?error=1");
    }
}


echo "<br>" . count($_FILES["file"]["name"]);
?>