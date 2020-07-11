<?php


class SuscriptoresController
{

    public function impresionSuscriptoresController($datos)
    {
        $datosController = $datos;

        $respuesta = @SuscriptoresModel::impresionSuscriptoresModel($datosController);

        return $respuesta;

    }

}

?>