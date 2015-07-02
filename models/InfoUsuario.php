<?php
include 'access_db.php';

$IdUsuario = $_POST['IdUsuario'];
//Consulta de las solicitud validando el ultimo estado
$result = $mysqli->query("SELECT * FROM Usuarios WHERE IdUsuario = " . $IdUsuario);
$result2 = $mysqli->query("SELECT usuariorol.rol FROM Usuarios INNER JOIN usuariorol ON Usuarios.Idusuario = usuariorol.idusuario  WHERE usuariorol.IdUsuario = " . $IdUsuario);
$permiso = $result2->fetch_array();
$general = $result->fetch_array();
?>
<!--POPPUP  DATOS-->             
<div class="modal-body">
    <form  action="models/modifyUser.php" method="POST"  role="form" class="form-horizontal" >
        <input type="hidden" name="IdUsuario" value="<?php echo $IdUsuario; ?>"  />
        <input type="hidden" name="actpassword" value="<?php echo $general['Password']; ?>"  />

        <div class="form-group">
            <div class="col-sm-2">
                <label for="inputEmail3" class="control-label">Email</label>
            </div>
            <div class="col-sm-10">
                <input type="email" class="form-control" id="inputName" placeholder="Email" value ="<?php echo $general['Login']; ?>" required disabled> </input>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-2">
                <label for="inputEmail3" class="control-label">Nombres</label>
            </div>
            <div class="col-sm-10">
                <input type="text" name ="nombres" class="form-control" id="inputEmail3" placeholder="Nombres" value="<?php echo $general['Nombres']; ?>">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-2">
                <label for="inputEmail3" class="control-label">Apellidos</label>
            </div>
            <div class="col-sm-10">
                <input type="text" name ="apellidos" class="form-control" id="inputEmail3" placeholder="Apellidos" value="<?php echo $general['Apellidos']; ?>">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-2">
                <label for="inputEmail3" class="control-label">Rol</label>
            </div>
            <div class="col-sm-10">
                <select  id="selTypeRol" name = "selTypeRol" class = "form-control">
                    <option value = "0">Seleccione el Rol</option>
                    <option value = "1" <?php
                    if ($permiso['rol'] == "Administrador") {
                        echo "selected";
                    }
                    ?>>Administrador</option>
                    <option value = "2" <?php
                    if ($permiso['rol'] == "Usuario") {
                        echo "selected";
                    }
                    ?>>Usuario</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-2">
                <label for="inputEmail3" class="control-label">Grupo</label>
            </div>
            <div class="col-sm-10">
                <select id ="selTypeGroup" name = "selTypeGroup" class = "form-control">
                    <option value = "0" >Seleccione el grupo</option>
                    <option value = "1" <?php
                    if ($general['Grupo'] == "SALUD TOTAL") {
                        echo "selected";
                    }
                    ?>>SALUD TOTAL</option>
                    <option value = "2" <?php
                    if ($general['Grupo'] == "CUENTAS MEDICAS") {
                        echo "selected";
                    }
                    ?>>CUENTAS MEDICAS</option>
                    <option value = "3" <?php
                    if ($general['Grupo'] == "CTC") {
                        echo "selected";
                    }
                    ?>>CTC</option>
                    <option value = "4" <?php
                    if ($general['Grupo'] == "RECURSOS HUMANOS") {
                        echo "selected";
                    }
                    ?>>RECURSOS HUMANOS</option>
                    <option value = "5" <?php
                    if ($general['Grupo'] == "SANITAS CARTERA") {
                        echo "selected";
                    }
                    ?>>SANITAS CARTERA</option>
                    <option value = "6" <?php
                    if ($general['Grupo'] == "SEGURIDAD") {
                        echo "selected";
                    }
                    ?>>SEGURIDAD</option>
                </select>
            </div> 
        </div>
        <div class="form-group">
            <div class="col-sm-3">
                <label for="inputPassword3" class="control-label">Nueva Contraseña</label>
            </div>
            <div class="col-sm-9">
                <input type="password" name="newpassword" class="form-control" id="inputPassword3" placeholder="Contraseña">

            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-3">
                <label for="inputPassword3"  name="conpassword" class="control-label">Confirmar Contraseña</label>
            </div>
            <div class="col-sm-9">

                <input type="password"  name="conpassword" class="form-control" id="inputPassword3" placeholder="Password">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-3">
                <label for="inputPassword3" class="control-label">Contraseña Anterior</label>
            </div>
            <div class="col-sm-9">
                <input type="password" name="oldpassword" class="form-control" id="inputPassword3" placeholder="Password">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-2">
                <label for="inputPassword3" class="control-label">Estado</label>
            </div>
            <div class="col-sm-3">
                <input type="checkbox"  name="estado" class="form-control" <?php
                if ($general['Estado'] == 1) {
                    echo "checked";
                }
                ?>>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Modificar </button>
        </div>
    </form>                        

</div>
<!--POPPUP  DATOS-->

