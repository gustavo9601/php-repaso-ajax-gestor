<?php

require_once '../../controllers/gestorContacto.php';
require_once '../../models/gestorContacto.php';

class AjaxContacto
{

    public $idActualizar;

    public function actualizarEstadoSuscriptor()
    {
        $datos = $this->idActualizar;

        $respuesta = @GestorContactoConroller::actualizarEstadoSuscriptorController($datos);

        echo $respuesta;
    }

}


if (isset($_POST['idActualizar'])) {
    $a = NEW AjaxContacto();
    $a->idActualizar = $_POST['idActualizar'];
    $a->actualizarEstadoSuscriptor();
}

?>