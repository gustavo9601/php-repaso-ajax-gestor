<?php

require_once '../../controllers/gestorGaleria.php';
require_once '../../models/gestorGaleria.php';

class Ajax
{
    #SUBIR IMAGEN TEMPORAL AL SERVER
    public $imagenTemporal;

    public function gestorGaleria()
    {
        $datos = $this->imagenTemporal;

        $respuesta = @GestorGaleria::mostrarImagenController($datos);

        //se ejecuta la funcion de arriba y luego devolvemos la respuesta
        echo $respuesta;

    }


    #FUNCTION QUE ELIMINA LA IMAGEN DE ACUERDO AL ID
    public $idItemGaleria;
    public $rutaGaleria;

    public function eliminarGaleriaAjax()
    {
        $datos = [
            'idGaleria' => $this->idItemGaleria,
            'rutaGaleria' => $this->rutaGaleria
        ];

        $respuesta = @GestorGaleria::eliminarGaleriaController($datos);
        echo $respuesta;

    }


    #FUNCION ACTUALIZAR ORDEN DE LAS IAMGNES
    public $actualizarOrdenGaleria;
    public $actualizarOrdenItem;

    public function actualizarOrdenAjax()
    {
        $datos = [
            "ordenGaleria" => $this->actualizarOrdenGaleria,
            "ordenItem" => $this->actualizarOrdenItem
        ];

        $respuesta = @GestorGaleria::actualizarOrdenController($datos);

        echo $respuesta;
    }


}


//validanco la peticion, al ser de tipo subir archivo
if (isset($_FILES['imagen']['tmp_name'])) {
    $a = NEW Ajax();
    $a->imagenTemporal = $_FILES['imagen']['tmp_name'];
    $a->gestorGaleria();
    /*
     echo "recibo";*/
}


//validando si se envio la peticion de eliminar la galeria mediante ajax
if (isset($_POST['idGaleria'])) {
    $b = NEW Ajax();
    $b->idItemGaleria = $_POST['idGaleria'];
    $b->rutaGaleria = $_POST['rutaGaleria'];
    $b->eliminarGaleriaAjax();
}


//validando si se envio el orden de imagenes
if (isset($_POST['actualizarOrdenGaleria'])) {
    $c = NEW Ajax();
    $c->actualizarOrdenGaleria = $_POST['actualizarOrdenGaleria'];
    $c->actualizarOrdenItem = $_POST['actualizarOrdenItem'];
    $c->actualizarOrdenAjax();
}
?>