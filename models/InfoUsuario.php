<?php 
include 'access_db.php';

$IdUsuario = $_POST['IdUsuario'];
//Consulta de las solicitud validando el ultimo estado
$result = $mysqli->query("SELECT * FROM Usuarios WHERE IdUsuario = " . $IdUsuario);
$general = $result->fetch_array();
?>
<!--POPPUP  DATOS-->             
<div class="modal-body">
    <form id="" action="" method="post"  role="form" class="form-horizontal" >
        <div class="form-group">
            <textarea></textarea>
            <div class="col-sm-2">
                <label for="inputEmail3" class="control-label">Email</label>
            </div>
            <div class="col-sm-10">
                <input type="email" class="form-control" id="inputEmail3" placeholder="Email" value ="<?php echo $general['Login']; ?>"></input>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-2">
                <label for="inputEmail3" class="control-label">Nombres</label>
            </div>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputEmail3" placeholder="Nombres" value="<?php echo $general['Nombres']; ?>">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-2">
                <label for="inputEmail3" class="control-label">Apellidos</label>
            </div>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputEmail3" placeholder="Apellidos" value="<?php echo $general['Apellidos']; ?>">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-2">
                <label for="inputEmail3" class="control-label">Rol</label>
            </div>
            <div class="col-sm-10">
                <select class="form-control">
                    <option value="0" selected>Selecciones un rol</option>
                    <option value="1">Administrador</option>
                    <option value="2">Usuario</option>

                </select>
            </div>

        </div>
        <div class="form-group">
            <div class="col-sm-2">
                <label for="inputEmail3" class="control-label">Grupo</label>
            </div>
            <div class="col-sm-10">
                <select class="form-control">
                    <option value="0" selected>Selecciones un Grupo</option>
                    <option value="1">Administrador</option>
                    <option value="2"></option>
                </select>
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
    </form>                        
    <div class="modal-footer">
        <a class="btn btn-primary" onclick="emerCancelar();">Modificar Usuario</a>
    </div>
</div>
<!--POPPUP  DATOS-->


