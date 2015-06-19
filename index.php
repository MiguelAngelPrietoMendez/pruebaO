

<html>
    <head>
        <?php
        include 'head.php';
        ?>
    </head>
    <script>
        $(document).ready(function ()
        {

<?php
if (isset($_GET['Error']) && $_GET['Error'] == 1) {
    ?>
                Alert_Warning('El usuario no existe');
    <?php
}
?>
<?php
if (isset($_GET['Error']) && $_GET['Error'] == 2) {
    ?>
                Alert_Info('La contraseña del usuario es incorrecta');
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
        <div id="area_alertas"  ></div>  
        <!--ALERTAS-->
        <div class="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h1 class="text-primary">Onteal Help Desk MICK333SSS</h1>
                        <h3>A subtit</h3>
                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo
                            ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis
                            dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies
                            nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.
                            Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In
                            enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum
                            felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus
                            elementum semper nisi.</p>
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