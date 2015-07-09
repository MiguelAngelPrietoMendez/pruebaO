<script src="js/jquery-2.1.4.js" type="text/javascript"></script>
<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/modules/data.js"></script>
<script src="http://code.highcharts.com/modules/drilldown.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>
<div id="container" style="width: 980px; height: 400px; margin: 0 auto"></div>
<button id="export2pdf">Export to PDF</button>
<script>
    var chart;
    $(document).ready(function () {
        /*begin chart render*/
        var colors = Highcharts.getOptions().colors,
                categories = ['', '', ''],
                name = 'Usuarios',
                data = [{
                        name: 'NIVEL-1',
                        y: 55,
                        color: colors[0],
                        drilldown: {
                            //begin alcohol
                            name: 'NNIVEL-2.1',
                            color: colors[0],
                            data: [{
                                    y: 33.06,
                                    name: 'A',
                                    drilldown: {
                                        name: 'Budweiser',
                                        data: [
                                            {name: 'A', y: 10838}
                                            , {name: 'B', y: 11349}
                                            , {name: 'C', y: 11894}
                                            , {name: 'D', y: 11846}
                                            , {name: 'E', y: 11878}
                                            , {name: 'F', y: 11662}
                                            , {name: 'G', y: 11652}
                                        ],
                                        color: colors[0]
                                    }},
                                {
                                    y: 10.85,
                                    name: 'B',
                                    drilldown: {
                                        name: 'Heinekein',
                                        categories: ['A', 'B', 'C', 'D', 'E', 'F', 'G'],
                                        data: [2266, 2396, 2431, 2380, 2357, 3516],
                                        color: colors[0]
                                    }},
                                {
                                    y: 7.35,
                                    name: 'C',
                                    drilldown: {
                                        name: 'Jack Daniels',
                                        categories: ['A', 'B', 'C', 'D', 'E', 'F', 'G'],
                                        data: [1583, 1580, 1612, 4036],
                                        color: colors[0]
                                    }},
                                {
                                    y: 2.41,
                                    name: 'D',
                                    drilldown: {
                                        name: 'Johnnie Walker',
                                        categories: ['A', 'B', 'C', 'D', 'E', 'F', 'G'],
                                        data: [1649, 1654, 1724, 3557],
                                        color: colors[0]
                                    }},
                                {
                                    y: 2.41,
                                    name: 'E',
                                    drilldown: {
                                        name: 'Moet & Chandon',
                                        categories: ['A', 'B', 'C', 'D', 'E', 'F', 'G'],
                                        data: [2470, 2445, 2524, 2861, 2991, 3257, 3739, 3951, 3754, 4021],
                                        color: colors[0]
                                    }},
                                {
                                    y: 2.41,
                                    name: 'F',
                                    drilldown: {
                                        name: 'Smirnoff',
                                        categories: ['A', 'B', 'C', 'D', 'E', 'F', 'G'],
                                        data: [2594, 2723, 5600, 2975, 3097, 3032, 3379, 3590, 7350, 3624],
                                        color: colors[0]
                                    }},
                                {
                                    y: 2.41,
                                    name: 'G',
                                    drilldown: {
                                        name: 'Corona',
                                        categories: ['A', 'B', 'C', 'D', 'E', 'F', 'G'],
                                        data: [3847],
                                        color: colors[0]
                                    }}],
                        }},
                    {
                        name: 'B-1',
                        y: 11.94,
                        color: colors[2],
                        drilldown: {
                            name: 'B',
                            categories: ['A-2', 'B-2', 'C-2'],
                            color: colors[2],
                            data: [{
                                    y: 33.06,
                                    name: 'A',
                                    drilldown: {
                                        name: 'A',
                                        categories: ['A', 'B'],
                                        data: [4444, 6666],
                                        color: colors[3]
                                    }
                                },
                                {
                                    name: 'B',
                                    y: 10.85,
                                    drilldown: {
                                        name: 'B',
                                        categories: ['A', 'B'],
                                        data: [22222, 6005],
                                        color: colors[3]
                                    }
                                },
                                {
                                    name: 'C',
                                    y: 7.35,
                                    drilldown: {
                                        name: 'C',
                                        categories: ['2011'],
                                        data: [3605],
                                        color: colors[3]
                                    }}]
                        }}
                ];

        function setChart(name, categories, data, color) {
            chart.xAxis[0].setCategories(categories);
            chart.series[0].remove();
            chart.addSeries({
                name: name,
                data: data,
                pointPadding: -0.3,
                borderWidth: 0,
                pointWidth: 15,
                shadow: true,
                color: color || 'white',
            });
        }

        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'container',
                type: 'pie',
                /* changes bar size */
                pointPadding: -0.3,
                borderWidth: 0,
                pointWidth: 10
            },
            title: {
                text: 'Pie Test'
            },
            subtitle: {
                text: 'Pie Chart Triple Breakdown'
            },
            xAxis: {
                categories: categories
            },
            yAxis: {
                title: {
                    text: 'Total Brand Value',
                    categories: categories
                }
            },
            //drilldown plot

            plotOptions: {
                pie: {
                    cursor: 'pointer',
                    allowPointSelect: true,
                    point: {
                        events: {
                            click: function () {
                                var drilldown = this.drilldown;
                                if (drilldown) { // drill down
                                    setChart(drilldown.name, drilldown.categories, drilldown.data, drilldown.color);
                                } else { // restore
                                    setChart(name, categories, data);
                                }
                            }
                        }
                    },
                    dataLabels: {
                        enabled: true,
                        color: '#000',
                        connectorColor: '#000',
                        // connector label colors
                        formatter: function () {
                            return '<b>' + this.point.name + '</b>: ' + this.y;
                        }
                    }
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
            },
            credits: {
                enabled: false
            },
            series: [{
                    name: name,
                    data: data,
                    pointPadding: -0.3,
                    borderWidth: 0,
                    pointWidth: 15,
                    shadow: true,
                    colorByPoint: true,
                    color: 'black' //Sectors icon
                }],
            exporting: {
                enabled: true
            }
        });
        

    });
</script>