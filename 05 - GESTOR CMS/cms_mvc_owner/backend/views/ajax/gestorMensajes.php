<?php

require_once '../../controllers/gestorMensajes.php';
require_once '../../models/gestorMensajes.php';

class AjaxMensajes
{
    #FUNCION QUE ACTUALIZA EL ESTADO DE MENSAJE A VISTO O NO
    public $idMensajeVisto;

    public function actualizaEstadoMensajeAjax()
    {

        $datos = $this->idMensajeVisto;
        $respuesta = @MensajesController::actualizaEstadoMensajeController($datos);

        echo $respuesta;

    }


    #funcion que deuvelve llos mensajes segun seavistos o no
    public $estadoMensaje;

    public function mostrarMensajeAjax()
    {
        $datos = $this->estadoMensaje;
        $respuesta = @MensajesController::mostrarMensajeController($datos);

        echo $respuesta;
    }

    #FUNCION QUE ENVIARA LOS MAILS A LAS PERSONAS ESCOGIDAS
    public $emailEnviar;
    public $tituloEnviar;
    public $mensajeEnviar;

    public function enviarEmailAjax()
    {
        $datos = [
            'email' => $this->emailEnviar,
            'titulo' => $this->tituloEnviar,
            'mensaje' => $this->mensajeEnviar
        ];

        $respuesta = @MensajesController::enviarEmailController($datos);

        echo $respuesta;

    }


    #FUNCION QUE DEVUELVERA LA CANTIDAD DE MENSAJES SIN LEER
    public function cantidadMensajesSinLeerAjax()
    {
        $respuesta = @MensajesController::cantidadMensajesSinLeerController();
        echo $respuesta['CANTIDAD'];
    }


}

if (isset($_POST['idMensajeVisto'])) {
    $a = NEW AjaxMensajes();
    $a->idMensajeVisto = $_POST['idMensajeVisto'];
    $a->actualizaEstadoMensajeAjax();
}

if (isset($_POST['estadoMensaje'])) {
    $b = NEW AjaxMensajes();
    $b->estadoMensaje = $_POST['estadoMensaje'];
    $b->mostrarMensajeAjax();
}

if (isset($_POST['email'])) {
    $c = NEW AjaxMensajes();
    $c->emailEnviar = $_POST['email'];
    $c->tituloEnviar = $_POST['titulo'];
    $c->mensajeEnviar = $_POST['mensaje'];
    $c->enviarEmailAjax();
}

if (isset($_POST['activa'])) {
    $d = NEW AjaxMensajes();
    $d->cantidadMensajesSinLeerAjax();
}

?>