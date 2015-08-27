<?php

$mysqli = new mysqli("50.21.183.59", "root","@nte@l2000", "bd_call");
if ($mysqli->connect_errno) {
    echo "Falló la conexión a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
} else {
//    echo "ok";
}
?>