<?php

$mysqli = new mysqli("192.168.1.211", "root", "", "glpi");
if ($mysqli->connect_errno) 
{
    echo "Falló la conexión a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}else
{
    echo "ok";
}

?>