<?php
$a="123";
session_start();
include 'access_db.php';

$itName = $mysqli->real_escape_string($_POST["itName"]);
$taDescription = $mysqli->real_escape_string($_POST["taDescription"]);
$selApplication=0;
if(isset($_POST["selApplicationSoft"]) && $_POST["selApplicationSoft"]>0 && $_POST["selType"]==1)
{
    $selApplication = $_POST["selApplicationSoft"];
    echo "SOFT: ".$selApplication." - ".$_POST["selApplicationSoft"];
}
if(isset($_POST["selApplicationHard"]) && $_POST["selApplicationHard"]>0 && $_POST["selType"]==2)
{
    $selApplication = $_POST["selApplicationHard"];
    echo "HARD: ".$selApplication." - ".$_POST["selApplicationHard"];
}

$file = "";
$count=0;
$date = date("Y m d H i s"); 

for($i=0;$i<count($_FILES["file"]["name"]);$i++) 
{
    
    if (file_exists("../uploadTicket/" . $_FILES["file"]["name"][$i]))
    {
        echo $_FILES["file"]["name"][$i] . " El archivo ya existe pailas. <BR>";
    }
    else
    {
        if(move_uploaded_file($_FILES["file"]["tmp_name"][$i],
      "../uploadTicket/" .$_FILES["file"]["name"][$i]))
        {
            
            $path_parts = pathinfo($_FILES["file"]["name"][$i]);
            $image_path = $path_parts['filename'].'_'.time().'.'.$path_parts['extension'];
            
            echo "<BR>brebes subio en : " . "../uploadTicket/" . $_FILES["file"]["name"][$i];
            
            
            $path_parts = pathinfo($_FILES["file"]["name"][$i]);
            $image_path = $path_parts['filename'].'_'.time().'.'.$path_parts['extension'];
            
            rename ("../uploadTicket/" .$_FILES["file"]["name"][$i], "../uploadTicket/".$image_path);
            $file .=$image_path."|";
            $count++;
            
            echo "<br>NOMBRE IMAGEN.".$image_path;
            
             
        }else
        {
            echo "error subiendo el archivo";
        }
      
    }
} 
    echo "<br>".$file."<br>";
    if($count==count($_FILES["file"]["name"]))
    {
        $result = $mysqli->query("INSERT INTO solicitud (nombre,Descripcion,Archivos,IdUsuario,IdSubTipoSolicitud)VALUES"
                . "('".$itName."','".$taDescription."','".$file."',".$_SESSION['IdUsuario'].",".$selApplication.")");
    
        if($result)
        {
           
              $result2 = $mysqli->query("SELECT IdSolicitud FROM solicitud ORDER BY IdSolicitud DESC LIMIT 1");
                $row2=$result2->fetch_array();
                $IdSolicitud=$row2["IdSolicitud"];

            //echo "MAXIMO- ".$IdSolicitud;
            
            
            
            $result3 = $mysqli->query("INSERT INTO solicitudproceso (IdSolicitud,Proceso)VALUES(".$IdSolicitud.",'Abierto')");
    
            if($result3)
            {
                echo "<BR><BR>INSERT AL PELO";
                 //header("Location: ../Solicitud.php?ok=1");
            }else
            {
                echo "pailas -  "."INSERT INTO solicitudproceso (IdSolicitud,Proceso)VALUES(".$IdSolicitud.",'Abierto')";
            }
            
            
            
            
             
        }else
        {
            echo "INSERT INTO solicitud (nombre,Descripcion,Archivos,IdUsuario,IdSubTipoSolicitud)VALUES"
                . "('".$itName."','".$taDescription."','".$file."',".$_SESSION['IdUsuario'].",".$selApplication.")";
             //header("Location: ../Solicitud.php?error=1");
        }
        
        
    }
    
    
   

          



/*
//Consulta de las solicitud validando el ultimo estado

$result2 = $mysqli->query("SELECT * FROM SolicitudProceso WHERE IdSolicitud = " . $IdSolicitud);
$general = $result->fetch_array();

*/



?>
