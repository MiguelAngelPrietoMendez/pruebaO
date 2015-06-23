<?php

session_start();
include 'access_db.php';

$itName = $mysqli->real_escape_string($_POST["itName"]);
$taDescription = $mysqli->real_escape_string($_POST["taDescription"]);
$selApplication=0;
if(isset($_POST["selApplicationSoft"]) && $_POST["selApplicationSoft"]>0)
{
    $selApplication = $_POST["selApplicationSoft"];
    echo "SOFT: ".$selApplication." - ".$_POST["selApplicationSoft"];
}
if(isset($_POST["selApplicationHard"]) && $_POST["selApplicationHard"]>0)
{
    $selApplication = $_POST["selApplicationHard"];
    echo "HARD: ".$selApplication." - ".$_POST["selApplicationHard"];
}

$file = "";
$count=0;

for($i=0;$i<count($_FILES["file"]["name"]);$i++) 
{
    if (file_exists("../uploadTicket/" . $_FILES["file"]["name"][$i]))
    {
        echo $_FILES["file"]["name"][$i] . " El archivo ya existe pailas. <BR>";
    }
    else
    {
        if(move_uploaded_file($_FILES["file"]["tmp_name"][$i],
      "../uploadTicket/" . $_FILES["file"]["name"][$i]))
        {
            echo "<BR>brebes subio en : " . "../uploadTicket/" . $_FILES["file"]["name"][$i];
            $file .=$_FILES["file"]["name"][$i]."|";
            $count++;
        }else
        {
            echo "error subiendo el archivo";
        }
      
    }
}
    echo "<br>".$file."<br>";
    if($count==count($_FILES["file"]["name"]))
    {
        $result = $mysqli->query("INSERT INTO solicitud (nombre,Descripcion,Archivos,Estado,IdUsuario,IdSubTipoSolicitud)VALUES"
                . "('".$itName."','".$taDescription."','".$file."',1,".$_SESSION['IdUsuario'].",".$selApplication.")");
    
        if($result)
        {
            echo "<BR>INSERT AL PELO";
        }else
        {
            echo "INSERT INTO solicitud (nombre,Descripcion,Archivos,IdUsuario,IdSubTipoSolicitud)VALUES"
                . "('".$itName."','".$taDescription."','".$file."',".$_SESSION['IdUsuario'].",".$selApplication.")";
        }
        
        
    }
    
    
    echo "<br>select= ".$selApplication;




/*
//Consulta de las solicitud validando el ultimo estado

$result2 = $mysqli->query("SELECT * FROM SolicitudProceso WHERE IdSolicitud = " . $IdSolicitud);
$general = $result->fetch_array();

*/



?>
