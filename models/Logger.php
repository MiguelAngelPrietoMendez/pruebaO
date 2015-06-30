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
        "1" => "Ocurrio un error mientras se procesaba la solicitud      Comuniquese con su admninistrador",
        "2" => "Ocurrio un error mientras se actualizaba el estado de  solicitud      Comuniquese con su admninistrador  "
    ];
    private $Acciones = [
        "1" => "Solicitud enviada exitosamente",
        "2" => "Proceso de la solicitud actualizado exitosamente"
    ];

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

}
