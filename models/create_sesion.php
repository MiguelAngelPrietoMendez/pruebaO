<?php

session_start();
include 'access_db.php';

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
                $_SESSION['IdUsuario'] = $row["IdUsuario"];
            }
            $result->close();
            $result2->close();
            header("Location: ../inicio.php");
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