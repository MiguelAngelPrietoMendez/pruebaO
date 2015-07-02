<?php

session_start();
include 'access_db.php';
include '../models/Logger.php';
$obj = new Logger;
$objse = serialize($obj);
$_SESSION['OBJ'] = $objse;

$itUsuario = $mysqli->real_escape_string($_POST["itUsuario"]);
$itContrasena = $mysqli->real_escape_string($_POST["itContrasena"]);
//Valida si existe  el usuario
if ($result = $mysqli->query("SELECT * FROM Usuarios WHERE Login='" . $itUsuario . "'")) {
    $RowUsuario = $result->num_rows;
    if ($RowUsuario > 0) {
        $result2 = $mysqli->query("SELECT * FROM Usuarios WHERE Login='" . $itUsuario . "' AND  Password ='" . $itContrasena . "'");
        $RowUsuario = $result2->num_rows;
        if ($RowUsuario > 0) {
            if ($row = mysqli_fetch_array($result2)) {
                if ($row["Estado"] == 0) {
                    header("Location: ../index.php?error=7");
                } else {
                    $_SESSION['IdUsuario'] = $row["IdUsuario"];
                    $sNombres = $row["Nombres"] . " " . $row["Apellidos"];
                    $_SESSION['Nombres'] = $sNombres;
                    //Buscar permisos del usuario que esta creando sesion
                    $resultPermisos = $mysqli->query("SELECT * FROM UsuarioRol WHERE IdUsuario = " . $row['IdUsuario']);
                    $RowPermisos = $resultPermisos->num_rows;
                    if ($RowPermisos > 0) {
                        if ($RowValor = mysqli_fetch_array($resultPermisos)) {
                            $_SESSION['Rol'] = $RowValor['Rol'];
                        }
                    }
                    $result->close();
                    $result2->close();
                    $resultPermisos->close();
                    header("Location: ../inicio.php?Det=1");
                }
            }
        } else {
            $result->close();
            $result2->close();
            header("Location: ../index.php?Error=2");
        }
    } else {
        $result->close();
        //Mensaje de no existe el usuario
        header("Location: ../index.php?Error=1");
    }
}
?>