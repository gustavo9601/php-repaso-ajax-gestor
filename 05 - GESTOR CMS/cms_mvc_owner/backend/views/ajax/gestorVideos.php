<?php

require_once '../../models/gestorVideos.php';
require_once '../../controllers/gestorVideos.php';

class Ajax
{

    #FUNCION DE SUBIR VIDEO
    public $videoTemporal;

    public function gestorVideoAjax()
    {
        $datos = $this->videoTemporal;
        //envio el video hacia el controller
        $respuesta = @GestorVideos::mostrarVideoController($datos);

        echo $respuesta;
    }

    public $idVideo;
    public $rutaVideo;

    public function eliminarVideoAjax()
    {
        $datos = [
            'idVideo' => $this->idVideo,
            'rutaVideo' => $this->rutaVideo
        ];

        $respuesta = @GestorVideos::eliminarVideoController($datos);

        echo $respuesta;
    }


    #FUNCION DE ACTUALZIAR EL ORDE
    public $actualizarOrdenVideo;
    public $actualizarOrdenItem;

    public function actualizarOrdenAjax()
    {
        $datos = [
            'ordenVideo' => $this->actualizarOrdenVideo,
            'ordenItem' => $this->actualizarOrdenItem
        ];

        $respuesta = @GestorVideos::actualizarOrdenController($datos);

        echo $respuesta;

    }

}

//validando si viene el video por post
if (isset($_FILES['video']['tmp_name'])) {
    $a = NEW Ajax();
    $a->videoTemporal = $_FILES['video']['tmp_name'];
    $a->gestorVideoAjax();
}
//validando si viene la orden de eliminar por post
if (isset($_POST['idVideo'])) {
    $b = NEW Ajax();
    $b->idVideo = $_POST['idVideo'];
    $b->rutaVideo = $_POST['rutaVideo'];
    $b->eliminarVideoAjax();
}


//validando la peticion de ordenar
if (isset($_POST['actualizarOrdenVideo'])) {
    $c = NEW Ajax();
    $c->actualizarOrdenVideo = $_POST['actualizarOrdenVideo'];
    $c->actualizarOrdenItem = $_POST['actualizarOrdenItem'];
    $c->actualizarOrdenAjax();
}



?>