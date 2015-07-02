<?php

include 'access_db.php';
include '../models/Logger.php';
session_start();
$obj = unserialize($_SESSION['OBJ']);


$sEmail = $mysqli->real_escape_string($_POST["email"]);
$sNombres = $mysqli->real_escape_string($_POST["nombres"]);
$sApellidos = $mysqli->real_escape_string($_POST["apellidos"]);
$pContraseña = $mysqli->real_escape_string($_POST["password"]);
$sTypeGroup = $mysqli->real_escape_string($_POST["selTypeGroup"]);
$sTypeRol = $mysqli->real_escape_string($_POST["selTypeRol"]);

$Validar = $mysqli->query("SELECT * FROM usuarios WHERE Login ='" . $sEmail . "'");
$RowUsuario = $Validar->num_rows;
if ($RowUsuario > 0) {
            header("Location: ../Usuarios.php?error=6");
            return;
}
$Rol = "";
$Grupo = "";
switch ($sTypeRol) {
    case 1:
        $Rol = "Administrador";
        break;
    case 2:
        $Rol = "Usuario";
        break;
}
switch ($sTypeGroup) {
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
$result = $mysqli->query("INSERT INTO Usuarios (Nombres,Apellidos,Login,Password,Estado,Grupo)VALUES('" . $sNombres . "','" . $sApellidos . "','" . $sEmail . "','" . $pContraseña . "'," . 1 . ",'" . $Grupo . "')");
if ($result) {
    $result2 = $mysqli->query("SELECT IdUsuario FROM usuarios ORDER BY IdUsuario DESC LIMIT 1");
    $row2 = $result2->fetch_array();
    $IdUsuario = $row2["IdUsuario"];
    $result3 = $mysqli->query("INSERT INTO usuariorol (IdUsuario,Rol,Estado)VALUES('" . $IdUsuario . "','" . $Rol . "'," . 1 . ")");
    if ($result3) {
        //Proceso actualizado exitosamente
        header("Location: ../Usuarios.php?ok=3");
    } else {
        $obj->setUltimoError($mysqli->error);
        $objse = serialize($obj);
        $_SESSION['OBJ'] = $objse;
        header("Location: ../Usuarios.php?error=4");
    }
} else {
    $obj->setUltimoError($mysqli->error);
    $objse = serialize($obj);
    $_SESSION['OBJ'] = $objse;
    header("Location: ../Usuarios.php?error=3");
}






