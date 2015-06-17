<html>
    <?php
    include 'head.php';
    ?>  
    <body>
        <?php
        include 'Menu.php';
        ?>  
       
        <!--ALERTAS-->
        <div id="area_alertas"></div>   
        <!--ALERTAS-->
        <!--POPPUP DE INFORMACION DE LA SOLICITUD-->
        <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <form class="form-horizontal" role="form">
                            <div class="form-group has-feedback">
                                <div class="col-sm-2">
                                    <label for="inputEmail3" class="control-label"># Solicitud</label>
                                </div>
                                <div class="col-sm-1">
                                    <label for="inputEmail3" class="control-label">1</label>
                                </div>
                                <div class="col-sm-2">
                                    <label for="inputEmail3" class="control-label">Solicitud</label>
                                </div>
                                <div class="col-sm-3">
                                    <label for="inputEmail3" class="control-label">Titulo Solicitud</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-2">
                                    <label for="inputPassword3" class="control-label">Descipción</label>
                                </div>
                                <div class="col-sm-10">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p>Descripcion de la solicituda asygdyhasjdaksdasbgvdabshjdasndnjaskdmnasgsdhmjaskkhndkasdhnjasd</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-2">
                                    <label for="inputEmail3" class="control-label">Fecha Inicio</label>
                                </div>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="inputEmail3" placeholder="Fecha Inicio">
                                </div>
                                <div class="col-sm-2">
                                    <label for="inputEmail3" class="control-label">Fecha Fin</label>
                                </div>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="inputEmail3" placeholder="Fecha Fin">
                                </div>
                            </div>
                            <div class="form-group"></div>
                        </form>
                        <div class="input-group">
                            <div class="col-md-12">
                                <hr>
                            </div>
                            <span class="input-group-btn">
                                <button class="btn btn-default" id ="Verifica" type="button" >
                                    <i id="icon-cambio" class="fa fa-2x fa-fw fa-angle-double-down"></i>
                                </button>
                            </span>
                        </div>
                        <table id ="SolDes" class="table table-condensed table-hover table-striped" >
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Jacob</td>
                                    <td>Thornton</td>
                                    <td>@fat</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Larry</td>
                                    <td>the Bird</td>
                                    <td>@twitter</td>
                                </tr>
                            </tbody>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Proceso</th>
                                    <th>Fecha Creacion</th>
                                    <th>Observación</th>
                                </tr>
                            </thead>
                        </table>
                        <div class="modal-footer">
                            <a class="btn btn-default" onclick="emerCancelar();">Cancelar Solicitud</a>
                            <a class="btn btn-primary">Siguiente Proceso</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--POPPUP DE INFORMACION DE LA SOLICITUD-->
        <!--POPPUP DE VALIDACION CANCELACION-->
        <div id ="emerSeg" class="modal fade" >
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="NoEmerCancelar();">×</button>
                        <h4 class="modal-title">¿ Esta seguro que desea cancelar la solicitud ?</h4>
                    </div>
                    <div class="modal-body">
                        <p>La solicitud  numero :  ### 
                            <br> Sera cancelada y no seguira con el soporte.
                        </p>
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-default" data-dismiss="modal" onclick="NoEmerCancelar();">No</a>
                        <a class="btn btn-primary">Si</a><!--ACCION PARA CANCELAR-->
                    </div>
                </div>
            </div>
        </div>
        <!--POPPUP DE VALIDACION CANCELACION-->
        <!--POPPUO DE SIGUIENTE ESTADO-->

        <!--POPPUO DE SIGUIENTE ESTADO-->
        <div class="section">           
                <h1 id ="titulo" class="text-center">SOLICITUDES ABIERTAS</h1>            
        </div>
        <div class="section">
            <div class="container">
                <div class="row">
                    <div id ="scroll"  class="col-md-12">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th># Solicitud</th>
                                    <th>Nombre&nbsp;</th>
                                    <th>Fecha Inicio</th>
                                    <th>Fecha Final</th>
                                    <th>Estado</th>
                                    <th>Ver</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Usuario 1</td>
                                    <td>July 21, 1983 01:15:00</td>
                                    <td></td>
                                    <td>
                                        <span class="label label-warning">Resuelto</span>
                                         <!--<span class="label label-success">Proceso</span>-->
                                        <!--<span class="label label-default">Cerrado</span>-->
                                        <!--<span class="label label-danger">Cancelado</span>-->
                                         <!--<span class="label label-primary">Abierto</span>-->

                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">
                                            <i class="fa fa-eye fa-fw fa-lg"></i>
                                        </button>
                                    </td>
                                </tr>

                                <tr>
                                    <td>2</td>
                                    <td>Jacob</td>
                                    <td>July 21, 1983 01:15:00</td>
                                    <td>@fat</td>
                                    <td>
                                        <span class="label label-success">Proceso</span>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">
                                            <i class="fa fa-eye fa-fw fa-lg"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Jacob</td>
                                    <td>July 21, 1983 01:15:00</td>
                                    <td>@fat</td>
                                    <td>
                                        <span class="label label-default">Cerrado</span>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">
                                            <i class="fa fa-eye fa-fw fa-lg"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Jacob</td>
                                    <td>July 21, 1983 01:15:00</td>
                                    <td>@fat</td>
                                    <td>
                                        <span class="label label-danger">Cancelado</span>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">
                                            <i class="fa fa-eye fa-fw fa-lg"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Jacob</td>
                                    <td>July 21, 1983 01:15:00</td>
                                    <td>@fat</td>
                                    <td>
                                        <span class="label label-success">Proceso Sis</span>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">
                                            <i class="fa fa-eye fa-fw fa-lg"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Jacob</td>
                                    <td>July 21, 1983 01:15:00</td>
                                    <td>@fat</td>
                                    <td>
                                        <span class="label label-primary">Abierto</span>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">
                                            <i class="fa fa-eye fa-fw fa-lg"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </body>
    <?php
    include 'pie.php';
    ?>
</html>