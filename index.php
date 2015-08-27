<?php
session_start();

if (isset($_GET['Close']) && $_GET['Close'] == 'true') {
    session_destroy();
}
if (isset($_SESSION['IdUsuario'])) {
    header("Location: ./Inicio.php?Det=1");
} else {
    include 'head.php';
    include './models/Logger.php';
    $obj = new Logger;
    ?>
    <html>
        <head>

        </head>
        <script>
            $(document).ready(function ()
            {

    <?php
    if (isset($_GET['ok'])) {
        ?>
                    Alert_Info("<?php echo $obj->getAccion($_GET['ok']); ?>");
        <?php
    }
    ?>
    <?php
    if (isset($_GET['error'])) {
        ?>
                    Alert_Warning("<?php echo $obj->getError($_GET['error']); ?>" + "\n" + "<?php echo $obj->getUltimoError(); ?>");
        <?php
    }
    ?>

            });
        </script>

        <body>

            <div class="navbar navbar-default navbar-static-top">
                <div class="container-fluid">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <a class="navbar-brand" href="#" id="logo">
                            <img id="logo" src="img/logo.png" alt="">
                        </a>
                    </div>
                </div>
            </div>
            <!--ALERTAS-->
            <div id="area_alertas"></div>   
            <!--ALERTAS-->
            <div class="section">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <h1 class="text-primary">Onteal Help Desk </h1>
                            <h3>Creacion  y Administración de ticket con algun requerimiento.</h3>
                            <p></p>
                        </div>
                        <div class="col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <span class="glyphicon glyphicon-lock"></span>Login</div>
                                <div class="panel-body">
                                    <form class="form-horizontal" role="form" action="models/create_sesion.php" method="POST">
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-3 control-label">Email</label>
                                            <div class="col-sm-9">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="glyphicon glyphicon-user"></i>
                                                    </span>
                                                    <input type="email" class="form-control" id="inputEmail3" placeholder="Email"
                                                           required="" name="itUsuario">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputPassword3" class="col-sm-3 control-label">Contraseña</label>
                                            <div class="col-sm-9">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="glyphicon glyphicon-lock"></i>
                                                    </span>
                                                    <input type="password" class="form-control" id="inputPassword3" placeholder="Contraseña"
                                                           required="" name="itContrasena">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-offset-3 col-sm-9">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox">Recordar mis datos</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group last">
                                            <div class="col-sm-offset-3 col-sm-9">
                                                <button type="submit" class="btn btn-success btn-sm" >Iniciar sesión</button>
                                                <button type="reset" class="btn btn-default btn-sm" >Cancelar</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </body>
        <?php
        include 'pie.php';
        ?>
    </html>
<?php } ?>