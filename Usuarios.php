<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
session_start();
include 'models/access_db.php';
?>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Administración de usuarios</title>
        <?php include 'head.php'; ?>
    </head>   
    <body>
        <?php include 'Menu.php'; ?>
        <?php
        $result = $mysqli->query("SELECT * FROM Usuarios");
        ?>
        <div class="section">           
            <h1 id ="titulo" class="text-center">ADMINISTRACIÓN DE USUARIOS</h1>            
        </div>
        <!--POPPUP  DATOS-->                
        <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-content">
                    <div class="modal-body">
                    </div>
                </div>
        </div>
        <!--POPPUP  DATOS-->
        <!--POPPUP  CONFIRMACION MODIFICAR-->               
        <div id ="emerSeg" class="modal fade" >
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="NoEmerCancelar();">×</button>
                        <h4 class="modal-title">¿ Esta seguro que desea modificar el usuario ?</h4>
                    </div>
                    <div class="modal-body">
                        <p>El usuario :  ### 
                            <br> Sera modificado desea continuar?
                        </p>
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-default" data-dismiss="modal" onclick="NoEmerCancelar();">No</a>
                        <a class="btn btn-primary">Si</a>
                    </div>
                </div>
            </div>
        </div>
        <!--POPPUP  CONFIRMACION MODIFICAR-->
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="panel panel-login">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-6">
                                    <a href="#" class="active" id="login-form-link">Usuarios</a>
                                </div>
                                <div class="col-xs-6">
                                    <a href="#" id="register-form-link">Registrar</a>
                                </div>
                            </div>
                            <hr>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div id="login-form" role="form" style="display: block;">
                                        <table class="table table-hover table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Login</th>
                                                    <th>Nombres</th>
                                                    <th>Apellidos</th>
                                                    <th>Contraseña</th>
                                                    <th>Estado</th>
                                                    <th>Ver</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php while ($row = $result->fetch_array()) { ?>
                                                    <tr>
                                                        <td><?php echo $row['Login']; ?></td>
                                                        <td><?php echo $row['Nombres']; ?></td>
                                                        <td><?php echo $row['Apellidos']; ?></td>
                                                        <td><?php echo $row['Password']; ?></td>
                                                        <td>
                                                            <?php if ($row['Estado'] == 1) { ?>
                                                                <span class="label label-info">Activo</span>
                                                            <?php } else {
                                                                ?>
                                                                <span class="label label-danger">Inactivo</span>
                                                                <?php
                                                            }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal" onclick="InfoUsuario(<?php echo $row['IdUsuario']; ?>);">
                                                                <i class="fa fa-eye fa-fw fa-lg"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                <?php } ?>                                       

                                            </tbody>
                                        </table>
                                    </div>
                                    <form id="register-form" clas ="form-horizontal" action="" method="post" role="form" style="display: none;">
                                        <div class="form-group">
                                            <div class="col-sm-2">
                                                <label for="inputEmail3" class="control-label">Email</label>
                                            </div>
                                            <div class="col-sm-10">
                                                <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-2">
                                                <label for="inputEmail3" class="control-label">Nombres</label>
                                            </div>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="inputEmail3" placeholder="Nombres">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-2">
                                                <label for="inputEmail3" class="control-label">Apellidos</label>
                                            </div>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="inputEmail3" placeholder="Apellidos">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-2">
                                                <label for="inputEmail3" class="control-label">Grupo</label>
                                            </div>
                                            <div class="col-sm-10">

                                                <a class="active btn btn-default dropdown-toggle" data-toggle="dropdown" style="
                                                   width: 100%;"> Grupos <span class="fa fa-caret-down"></span></a>
                                                <ul class="dropdown-menu" role="menu" style="
                                                    width: 100%;
                                                    ">
                                                    <li>
                                                        <a href="#">Action</a>
                                                    </li>

                                                    <li class="divider"></li>
                                                </ul>

                                            </div>

                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-2">
                                                <label for="inputEmail3" class="control-label">Rol</label>
                                            </div>
                                            <div class="col-sm-10">

                                                <a class="active btn btn-default dropdown-toggle" data-toggle="dropdown" style="
                                                   width: 100%;"> Roles <span class="fa fa-caret-down"></span></a>
                                                <ul class="dropdown-menu" role="menu" style="
                                                    width: 100%;
                                                    ">
                                                    <li>
                                                        <a href="#">Action</a>
                                                    </li>

                                                    <li class="divider"></li>
                                                </ul>

                                            </div>

                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-2">
                                                <label for="inputPassword3" class="control-label">Contraseña</label>
                                            </div>
                                            <div class="col-sm-10">
                                                <input type="password" class="form-control" id="inputPassword3" placeholder="Contraseña">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-2">
                                                <label for="inputPassword3" class="control-label">Confirmar Contraseña</label>
                                            </div>
                                            <div class="col-sm-10">
                                                <input type="password" class="form-control" id="inputPassword3" placeholder="Password">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <button type="submit" class="btn btn-default">Registrarse</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include'pie.php' ?>
    </body>
</html>
