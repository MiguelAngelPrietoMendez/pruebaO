<?php require './conPrueba.php'; ?>
<html>
    <head>
        <script>
            

        </script>
        <meta charset="UTF-8">
        <?php
        $result = $mysqli->query("SELECT 
CASE MONTH(FECHA_CREACION)
WHEN 1  THEN 'ENERO'
WHEN 2  THEN 'FEBRERO'
WHEN 3  THEN 'MARZO'
WHEN 4  THEN 'ABRIL'
WHEN 5  THEN 'MAYO'
WHEN 6  THEN 'JUNIO'
WHEN 7  THEN 'JULIO'
WHEN 8  THEN 'AGOSTO'
WHEN 9  THEN 'SEPTIEMBRE'
WHEN 10 THEN 'OCTUBRE'
WHEN 11 THEN 'NOVIEMBRE'
WHEN 12 THEN 'DICIEMBRE'
END AS MESES,
SUM(CASE WHEN  DATEDIFF(NOW(),FECHA_NACIMIENTO) >= 6570 THEN 1 END) AS MAYOR_DE_EDAD,
SUM(CASE WHEN  DATEDIFF(NOW(),FECHA_NACIMIENTO) < 6570 THEN 1 END) AS MENOR_DE_EDAD,
SUM(CASE WHEN  DATEDIFF(NOW(),FECHA_NACIMIENTO) <=0 THEN 1 
			   WHEN  FECHA_NACIMIENTO ='0000-00-00' THEN 1 
				 WHEN  FECHA_NACIMIENTO IS NULL  THEN 1 END ) AS FECHA_ERRONEA
FROM onc_caso 
GROUP BY MONTH(FECHA_CREACION)");
        ?>
        <link href="../Plano/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="../Plano/Recursos/bootstrap-table/src/bootstrap-table.css" rel="stylesheet" type="text/css"/>

        <script src="../Plano/js/jquery-2.1.4.js" type="text/javascript"></script>
        <script src="../Plano/js/bootstrap.min.js" type="text/javascript"></script>

        <script src="http://code.highcharts.com/highcharts.js"></script>
        <script src="http://code.highcharts.com/modules/data.js"></script>
        <script src="http://code.highcharts.com/modules/exporting.js"></script>

        <script src="../Plano/Recursos/bootstrap-table/src/bootstrap-table.js" type="text/javascript"></script>
        <script src="../Plano/Recursos/bootstrap-table/dist/extensions/export/bootstrap-table-export.js" type="text/javascript"></script>
        <script src="../Plano/js/extensions/tableExport.jquery.plugin-master/tableExport.js" type="text/javascript"></script>
        <script src="../Plano/js/extensions/tableExport.jquery.plugin-master/libs/jsPDF/jspdf.min.js" type="text/javascript"></script>
        <script src="../Plano/js/extensions/tableExport.jquery.plugin-master/libs/jsPDF-AutoTable/jspdf.plugin.autotable.js" type="text/javascript"></script>
        <script src="../Plano/js/extensions/tableExport.jquery.plugin-master/libs/html2canvas/html2canvas.min.js" type="text/javascript"></script>
        <script src="../Plano/js/extensions/tableExport.jquery.plugin-master/libs/FileSaver/FileSaver.min.js" type="text/javascript"></script>
        <script> $(function () {
                    $('#container').highcharts({
                    data: {
                    table: 'datatable'

                    }
                    ,
                            chart: {
                            type: 'column'
                            },
                            title: {
                            text: 'DISTRIBUCIÓN DE CASOS POR MES'
                            },
                            xAxis: {
                            categories: ['ENERO', 'FEBRERO', 'MARZO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE']
                            },
                            yAxis: {
                            allowDecimals: false,
                                    min: 0,
                                    title: {
                                    text: 'Numero de casos'
                                    },
                                    stackLabels: {
                                    enabled: true,
                                            style: {
                                            fontWeight: 'bold',
                                                    color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                                            }
                                    }
                            }, credits: {
                    enabled: false
                    },
                            tooltip: {
                            formatter: function () {
                            return '<b>' + this.x + '</b><br/>' +
                                    this.series.name + ': ' + this.y + '<br/>' +
                                    'Total: ' + this.point.stackTotal;
                            }
                            }, legend: {
                    backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
                            borderColor: '#CCC',
                            borderWidth: 1,
                            shadow: false
                    },
                            plotOptions: {
                            column: {
                            stacking: 'normal',
                                    dataLabels: {
                                    enabled: true,
                                            color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white',
                                            style: {
                                            textShadow: '0 0 3px black'
                                            }
                                    }
                            }
                            }

                    });
                    });
        </script>
    </title>
</head>
<body>
    <div class="container">
        <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

        <div class="row">
            <table   id="datatable"
                     data-toggle="table"
                     data-show-export="true"
                     data-export-types=['pdf','csv','excel']
                     >
                <thead>
                    <tr>
                        <th >MESES</th>
                        <th  data-align="left" data-sortable="true">ADULTO</th>
                        <th  data-align="left" data-sortable="true">MENORES</th>
                        <th  data-align="left" data-sortable="true">DESCONOCIDO</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = $result->fetch_array()) {
                        echo"<tr>";
                        echo "<td>" . $row['MESES'] . "</td>";
                        echo "<td>" . $row['MAYOR_DE_EDAD'] . "</td>";
                        echo "<td>" . $row['MENOR_DE_EDAD'] . "</td>";
                        echo "<td>" . $row['FECHA_ERRONEA'] . "</td>";
                        echo"</tr>";
                    }
                    ?>
            </table>
        </div>
    </div>

</body>
</html>
