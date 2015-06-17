<?php

include 'access_db.php';

$itUsuario = $mysqli->real_escape_string($_POST["itUsuario"]);
$itContrasena = $mysqli->real_escape_string($_POST["itContrasena"]);

$result = $mysqli->query("SELECT * FROM prueba WHERE nombre='".$itUsuario."' AND apellido='".$itContrasena."'");
$totalRows = $result->num_rows;

if($totalRows>0)
{
    header();
}else
{
    
}

?>