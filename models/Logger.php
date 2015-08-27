<?php

/*
 * Archivo de errores  y acciones
 * Retorna el mensaje segun el numero del log
 * Ejemplo : Error #1 =  "Error Prueba"
 */

class Logger {

    function Log() {
        
    }

    private $Errores = [
        "1" => "Ocurrio un error mientras se creaba la solicitud      Comuniquese con su administrador",
        "2" => "Ocurrio un error mientras se actualizaba el estado de  solicitud      Comuniquese con su administrador",
        "3" => "Ocurrio un error mientras se creaba el usuario   Comuniquese con su administrador",
        "4" => "Ocurrio un error mientras se creaba el usuarioRol   Comuniquese con su administrador",
        "5" => "Ocurrio un error mientras se creaba la solicitudproceso Comuniquese con su administrador",
        "6" => "El Usuario ya se encuentra registrado Intente nuevamente",
        "7" => "El Usuaro se encuentra desactivado Comuniquese con su administrador",
        "8" => "Las contraseñas no coinciden  Intente nuevamente",
        "9" => "La contraseña actual no es correcta  Intente nuevamente",
        "10" => "Ocurrio un error mientras se modificaba el usuario",
        "11" => "Ocurrio un error mientras se modificaba el usarioRol",
        "12" => "El Rol del usuario es un campo obligatorio",
        "13" => "El Grupo del usuario es un campo obligatorio",
        "14" => "La contraseña del usuario es incorrecta    Intente  de nuevo",
        "15" => "El  usuario no se encuentra registrado  Verifiquelo"
    ];
    private $Acciones = [
        "1" => "Solicitud enviada exitosamente",
        "2" => "Proceso de la solicitud actualizado exitosamente",
        "3" => "Usuario creado exitosamente",
        "4" => "Usuario actualizado exitosamente"
    ];
    private $UltimoError = "";

    /**
     * Recibe el numero del error
     * 
     * @return String Description Error
     */
    public function getError($nError) {
        return $this->Errores[$nError];
    }

    /**
     * Recibe el numero dela accion
     * 
     * @return String Description Action
     */
    public function getAccion($nAccion) {
        return $this->Acciones[$nAccion];
    }

    function getUltimoError() {
        return $this->UltimoError;
    }

    function setUltimoError($UltimoError) {
        $this->UltimoError = $UltimoError;
    }

}
