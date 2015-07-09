
<?php
session_start();
include './models/access_db.php';
include './models/Logger.php';

$obj = unserialize($_SESSION['OBJ']);
?>
<html>
    <head>
        <?php include './head.php'; ?>
        <title>Reportes</title>
    </head>
    <body>
        <?php include './Menu.php'; ?>
        <?php
        $result = $mysqli->query("SELECT IdUsuario,Nombres,Apellidos,SUM(Cantidad) AS Cantidad FROM acm_usuario_m_a GROUP BY IdUsuario");
        ?>
        <script src="js/jquery-2.1.4.js" type="text/javascript"></script>
        <script src="js/highcharts.js" type="text/javascript"></script>
        <script src="js/data.js" type="text/javascript"></script>
        <script src="js/drilldown.js" type="text/javascript"></script>
        <script src="js/exporting.js" type="text/javascript"></script>

        <div id="container" style="min-width: 310px; max-width: 600px; height: 400px; margin: 0 auto"></div>
        <script>
            $(function () {
                $('#container').highcharts({
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: 'Graficas detalladas de usuario'
                    },
                    xAxis: {
                        type: 'category'
                    },
                    yAxis: {
                        min: 0,
                        title: {
                            text: 'Tickets'
                        }
                    },
                    plotOptions: {
                        pie: {
                            point: {
                                events: {
                                    click: function () {
                                        var drilldown = this.drilldown;
                                        if (drilldown) {
                                            //                                    alert(1233);
                                        } else { // restore
                                        }
                                    }
                                }
                            },
                            dataLabels: {
                                enabled: true,
                                formatter: function () {
                                    return '<b>' + this.point.name + '</b>: ' + this.y;
                                }
                            }
                        },
                        series: {
                            borderWidth: 2,
                            dataLabels: {
                                enabled: true
                            }
                        }
                    },
                    tooltip: {
                        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
                    }, credits: {
                        enabled: false
                    },
                    series: [{
                            id: 'toplevel',
                            name: 'Usuarios',
                            data: [
<?php
//USUARIOS GENERAL
while ($row = $result->fetch_array()) {
    echo "{name:'" . $row['Nombres'] . "' , y:" . $row['Cantidad'] . " ,drilldown : '" . $row['IdUsuario'] . "'},\n";
}
$result->data_seek(0);
?>
                            ]
                        }],
                    drilldown: {
                        series: [
<?php
//TICKETS POR CATEGORIA GENERAL DE USUARIO
while ($row = $result->fetch_array()) {
    echo "{\n id :'" . $row['IdUsuario'] . "',\n";
    echo "name :'Tipo Solicitudes',";
    $resultGeneral = $mysqli->query("SELECT IdUsuario,Nombres,Apellidos,SUM(Cantidad) AS Cantidad ,Tipo,
                                                                    CASE Tipo
                                                                    WHEN  1   THEN 'Software'
                                                                    WHEN 2  THEN 'Hardware'
                                                                    END AS cTipo
                                                                    FROM acm_usuario_m_a  WHERE IdUsuario=" . $row['IdUsuario'] . "   GROUP BY IdUsuario , Tipo
                                                                    ");

    echo "data :[";
    while ($row = $resultGeneral->fetch_array()) {
        echo "{name :'" . $row['cTipo'] . "',y:" . $row['Cantidad'] . ",drilldown : '" . $row['cTipo'] . $row['IdUsuario'] . "'},";
    }
    echo "]},\n";
}

$resultGeneral->close();
//TICKEST POR CATEGORIA ESPECIFICA DE USUARIO
//TICKETS SOFTWARE Y HARDWARE  GENERAL
$resultGeneral = $mysqli->query("SELECT IdUsuario,Nombres,Apellidos,SUM(Cantidad) AS Cantidad ,Tipo,
                                                                    CASE Tipo
                                                                    WHEN  1   THEN 'Software'
                                                                    WHEN 2  THEN 'Hardware'
                                                                    END AS cTipo
                                                                    FROM acm_usuario_m_a   GROUP BY IdUsuario , Tipo
                                                                    ");
while ($rowGeneral = $resultGeneral->fetch_array()) {
    //SI EL TIPO ES SOFTWARE
    $resultSof = $mysqli->query("SELECT IdUsuario,Nombres,Apellidos,SUM(Cantidad) AS Cantidad ,
                                                                    CASE Tipo
                                                                    WHEN  1   THEN 'Software'
                                                                    WHEN 2  THEN 'Hardware'
                                                                    END AS cTipo,
                                                                     subtiposolicitud
                                                                    FROM acm_usuario_m_a WHERE Tipo =" . $rowGeneral['Tipo'] . " AND IdUsuario =" . $rowGeneral['IdUsuario'] . "  GROUP BY  
                                                                    subtiposolicitud ORDER BY Cantidad DESC ");
    if ($rowGeneral['Tipo'] == 1) {
        $A = $resultSof->num_rows;
        if ($A > 0) {
            //Si es tipo de solicitud Sofware se valida por aplicativo GENERAL
            $resultGeneralSof = $mysqli->query("SELECT IdUsuario,Tipo,SUM(cantidad) AS Cantidad,subtiposolicitud,
                                                                    CASE Tipo
                                                                    WHEN  1   THEN 'Software'
                                                                    WHEN 2  THEN 'Hardware'
                                                                    END AS cTipo
                                                                    FROM acm_usuario_m_a WHERE IdUsuario = " . $rowGeneral['IdUsuario'] . " AND Tipo= " . $rowGeneral['Tipo'] . " AND subtiposolicitud LIKE 'PS%'  GROUP BY IdUsuario,Tipo
                                                                    UNION
                                                                    SELECT IdUsuario,Tipo,SUM(cantidad) AS Cantidad,subtiposolicitud,
                                                                    CASE Tipo
                                                                    WHEN  1   THEN 'Software'
                                                                    WHEN 2  THEN 'Hardware'
                                                                    END AS cTipo
                                                                    FROM acm_usuario_m_a WHERE IdUsuario = " . $rowGeneral['IdUsuario'] . " AND Tipo= " . $rowGeneral['Tipo'] . " AND subtiposolicitud LIKE 'ST%'  GROUP BY IdUsuario,Tipo
                                                                     UNION
                                                                    SELECT IdUsuario,Tipo,SUM(cantidad) AS cantidad,subtiposolicitud,
                                                                    CASE Tipo
                                                                    WHEN  1   THEN 'Software'
                                                                    WHEN 2  THEN 'Hardware'
                                                                    END AS cTipo
                                                                    FROM acm_usuario_m_a WHERE IdUsuario = " . $rowGeneral['IdUsuario'] . " AND Tipo= " . $rowGeneral['Tipo'] . " AND subtiposolicitud LIKE 'CM%'  GROUP BY IdUsuario,Tipo
                                                                    ");
            $A = $resultGeneralSof->num_rows;
            if ($A > 0) {
                echo "{\n id :'Software" . $rowGeneral['IdUsuario'] . "',\n";
                echo "name :'" . $rowGeneral['cTipo'] . "',";
                echo "data :[\n";
                while ($rowsoftware = $resultGeneralSof->fetch_array()) {
                    $TipoSof = explode("_", $rowsoftware['subtiposolicitud']);
                    switch ($TipoSof[0]) {
                        case "PS":
                            $TipoSofName = "PORTAL SIGAME";

                            break;
                        case "ST":
                            $TipoSofName = "SALUD TOTAL";

                            break;
                        case "CM":
                            $TipoSofName = "CUENTAS MEDICAS";

                            break;
                    }
                    echo "{\n name :'" . $TipoSofName . "',y:" . $rowsoftware['Cantidad'] . ",drilldown : '" . $TipoSofName . $rowsoftware['IdUsuario'] . "'\n},";
                }
                echo "]},\n";
            }
        }
    } elseif ($rowGeneral['Tipo'] == 2) {
        echo "{\n id :'" . $rowGeneral['cTipo'] . $rowGeneral['IdUsuario'] . "',\n";
        echo "name :'" . $rowGeneral['cTipo'] . "',";
        echo "data :[";
        while ($row2 = $resultSof->fetch_array()) {
            echo "{name :'" . $row2['subtiposolicitud'] . "',y:" . $row2['Cantidad'] . ",drilldown : 'null'},";
        }
        echo "]},\n";
    }
}

$resultGeneral = $mysqli->query("SELECT IdUsuario,Nombres,Apellidos,SUM(Cantidad) AS Cantidad ,Tipo,subtiposolicitud ,
                                                                    CASE Tipo
                                                                    WHEN  1   THEN 'Software'
                                                                    WHEN 2  THEN 'Hardware'
                                                                    END AS cTipo
                                                                    FROM acm_usuario_m_a  WHERE Tipo =1  GROUP BY IdUsuario , Tipo
                                                                    ");
while ($rowGeneral = $resultGeneral->fetch_array()) {
    $resultSof1 = $mysqli->query("SELECT IdUsuario,Nombres,Apellidos,SUM(Cantidad) AS Cantidad ,subtiposolicitud,
                                                                    CASE Tipo
                                                                    WHEN  1   THEN 'Software'
                                                                    WHEN 2  THEN 'Hardware'
                                                                    END AS cTipo,
                                                                     subtiposolicitud
                                                                    FROM acm_usuario_m_a WHERE Tipo = 1 AND IdUsuario =" . $rowGeneral['IdUsuario'] . " AND subtiposolicitud LIKE 'PS%'   GROUP BY  
                                                                    subtiposolicitud ORDER BY subtiposolicitud DESC ");
    echo "{\n id :'PORTAL SIGAME" . $rowGeneral['IdUsuario'] . "',\n";
    echo "name :'PT" . $rowGeneral['IdUsuario'] . "',\n";
    echo "data :[";
    while ($row2 = $resultSof1->fetch_array()) {
        echo "{\n name :'" . $row2['subtiposolicitud'] . "',y:" . $row2['Cantidad'] . ",drilldown : 'null' \n},";
    }
    echo "]},\n ";
    $resultSof2 = $mysqli->query("SELECT IdUsuario,Nombres,Apellidos,SUM(Cantidad) AS Cantidad ,subtiposolicitud,
                                                                    CASE Tipo
                                                                    WHEN  1   THEN 'Software'
                                                                    WHEN 2  THEN 'Hardware'
                                                                    END AS cTipo,
                                                                     subtiposolicitud
                                                                    FROM acm_usuario_m_a WHERE Tipo = 1 AND IdUsuario =" . $rowGeneral['IdUsuario'] . " AND subtiposolicitud LIKE 'ST%'  GROUP BY  
                                                                    subtiposolicitud ORDER BY subtiposolicitud DESC ");
    echo "{\n id :'SALUD TOTAL" . $rowGeneral['IdUsuario'] . "',\n";
    echo "name :'ST" . $rowGeneral['IdUsuario'] . "',\n";
    echo "data :[";
    while ($row2 = $resultSof2->fetch_array()) {
        echo "{\n name :'" . $row2['subtiposolicitud'] . "',y:" . $row2['Cantidad'] . ",drilldown : 'null' \n},";
    }
    echo "]},\n ";
    $resultSof3 = $mysqli->query("SELECT IdUsuario,Nombres,Apellidos,SUM(Cantidad) AS Cantidad ,subtiposolicitud,
                                                                    CASE Tipo
                                                                    WHEN  1   THEN 'Software'
                                                                    WHEN 2  THEN 'Hardware'
                                                                    END AS cTipo,
                                                                     subtiposolicitud
                                                                    FROM acm_usuario_m_a WHERE Tipo = 1 AND IdUsuario =" . $rowGeneral['IdUsuario'] . "  AND subtiposolicitud LIKE 'CM%'  GROUP BY  
                                                                    subtiposolicitud ORDER BY subtiposolicitud DESC ");
    echo "{\n id :'CUENTAS MEDICAS" . $rowGeneral['IdUsuario'] . "',\n";
    echo "name :'CM" . $rowGeneral['IdUsuario'] . "',\n";
    echo "data :[";
    while ($row2 = $resultSof3->fetch_array()) {
        echo "{\n name :'" . $row2['subtiposolicitud'] . "',y:" . $row2['Cantidad'] . ",drilldown : 'null' \n},";
    }
    echo "]},\n ";
}
?>
                        ]
                    }
                });
            });
        </script>
        <div class="container">.

            <div class="row">
                <h2>Reportes</h2>
                <div class="col-md-6">
                    <div class="blockquote-box clearfix">
                        <div class="square pull-left">
                            <img src="http://placehold.it/60/8e44ad/FFF&text=B" alt="" class="" />
                        </div>
                        <h4>
                            Bootsnipp</h4>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a
                            ante.
                        </p>
                    </div>
                    <div class="blockquote-box blockquote-primary clearfix">
                        <div class="square pull-left">
                            <span class="glyphicon glyphicon-music glyphicon-lg"></span>
                        </div>
                        <h4>
                            Let's music play</h4>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a
                            ante. <a href="http://www.jquery2dotnet.com/search/label/jquery">jquery2dotnet</a>
                        </p>
                    </div>
                    <div class="blockquote-box blockquote-success clearfix">
                        <div class="square pull-left">
                            <span class="glyphicon glyphicon-tree-conifer glyphicon-lg"></span>
                        </div>
                        <h4>
                            Tree conifer</h4>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a
                            ante.
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="blockquote-box blockquote-info clearfix">
                        <div class="square pull-left">
                            <span class="glyphicon glyphicon-info-sign glyphicon-lg"></span>
                        </div>
                        <h4>
                            Information</h4>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a
                            ante.
                        </p>
                    </div>
                    <div class="blockquote-box blockquote-warning clearfix">
                        <div class="square pull-left">
                            <span class="glyphicon glyphicon-warning-sign glyphicon-lg"></span>
                        </div>
                        <h4>
                            Warning</h4>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a
                            ante.
                        </p>
                    </div>
                    <div class="blockquote-box blockquote-danger clearfix">
                        <div class="square pull-left">
                            <span class="glyphicon glyphicon-record glyphicon-lg"></span>
                        </div>
                        <h4>
                            Danger</h4>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a
                            ante.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <?php include'pie.php' ?>
    </body>
</html>
