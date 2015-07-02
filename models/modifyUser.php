<?php

include 'access_db.php';
include '../models/Logger.php';
session_start();
$obj = unserialize($_SESSION['OBJ']);

$IdUsuario = $mysqli->real_escape_string($_POST["IdUsuario"]);
$sNombres = $mysqli->real_escape_string($_POST["nombres"]);
$sApellidos = $mysqli->real_escape_string($_POST["apellidos"]);
$nuevaContraseña = $mysqli->real_escape_string($_POST["newpassword"]);
$confirmarContraseña = $mysqli->real_escape_string($_POST["conpassword"]);
$ActualContraseñaForm = $mysqli->real_escape_string($_POST["oldpassword"]);
$ActualContraseñaBD = $mysqli->real_escape_string($_POST["actpassword"]);
if ($nuevaContraseña != $confirmarContraseña && !empty($nuevaContraseña) && !empty($confirmarContraseña)) {
    $obj->setUltimoError($mysqli->error);
    $objse = serialize($obj);
    $_SESSION['OBJ'] = $objse;
    header("Location: ../Usuarios.php?error=8");
    return;
} else if ($ActualContraseñaForm != $ActualContraseñaBD && !empty($ActualContraseñaForm)) {
    $obj->setUltimoError($mysqli->error);
    $objse = serialize($obj);
    $_SESSION['OBJ'] = $objse;
    header("Location: ../Usuarios.php?error=9");
    return;
} else {
    if (empty($nuevaContraseña)  && empty($confirmarContraseña) && empty($ActualContraseñaForm)) {
        $ActualContraseña = $ActualContraseñaBD;
    } else {
        $ActualContraseña = $confirmarContraseña;
    }
    $sTypeGroup = $mysqli->real_escape_string($_POST["selTypeGroup"]);
    $sTypeRol = $mysqli->real_escape_string($_POST["selTypeRol"]);
    $cEstado = $mysqli->real_escape_string($_POST["estado"]);
    $Rol = "";
    $Grupo = "";
    switch ($sTypeRol) {
        case 0:
            $obj->setUltimoError($mysqli->error);
            $objse = serialize($obj);
            $_SESSION['OBJ'] = $objse;
            header("Location: ../Usuarios.php?error=12");
            return;
        case 1:
            $Rol = "Administrador";
            break;
        case 2:
            $Rol = "Usuario";
            break;
    }

    switch ($sTypeGroup) {
        case 0:
            $obj->setUltimoError($mysqli->error);
            $objse = serialize($obj);
            $_SESSION['OBJ'] = $objse;
            header("Location: ../Usuarios.php?error=13");
            return;

        case 1:
            $Grupo = "SALUD TOTAL";
            break;
        case 2:
            $Grupo = "CUENTAS MEDICAS";
            break;
        case 3:
            $Grupo = "CTC";
            break;
        case 4:
            $Grupo = "RECURSOS HUMANOS";
            break;
        case 5:
            $Grupo = "SANITAS CARTERA";
            break;
        case 6:
            $Grupo = "SEGURIDAD";
            break;
    }

    if ($cEstado == "on") {
        $cEstado = 1;
    } else {
        $cEstado = 0;
    }
    $result = $mysqli->query("UPDATE Usuarios   SET Nombres ='" . $sNombres . "', Apellidos ='" . $sApellidos . "' ,Password='" . $ActualContraseña . "', Estado ='" . $cEstado . "',Grupo='" . $Grupo . "'  WHERE IdUsuario=" . $IdUsuario);
    if ($result) {
        $result2 = $mysqli->query("UPDATE usuariorol SET usuariorol.Rol ='" . $Rol . "'  WHERE IdUsuario=" . $IdUsuario);
        if ($result2) {
            $obj->setUltimoError($mysqli->error);
            $objse = serialize($obj);
            $_SESSION['OBJ'] = $objse;
            header("Location: ../Usuarios.php?ok=4");
        } else {
            $obj->setUltimoError($mysqli->error);
            $objse = serialize($obj);
            $_SESSION['OBJ'] = $objse;
            header("Location: ../Usuarios.php?error=11");
        }
    } else {
        $obj->setUltimoError($mysqli->error);
        $objse = serialize($obj);
        $_SESSION['OBJ'] = $objse;
        header("Location: ../Usuarios.php?error=10");
    }
}
