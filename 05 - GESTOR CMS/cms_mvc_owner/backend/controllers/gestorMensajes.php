<?php

class MensajesController
{

    #FUNCION QUE DEVUELVE TODOS LO S MENSAJES QUE NO ESTAN VISTOS
    public function mostrarMensajesSinVerController()
    {
        $respuesta = @MensajeModel::mostrarMensajesSinVerModel('mensajes');
        /*uso substr() //para cortar la cadena y mostrar solo una parte*/
        foreach ($respuesta as $dato) {
            echo '<div class="well well-sm">
        <span class="fa fa-times pull-right"></span>
        <h3>De: ' . $dato['nombre'] . '</h3>
        <h5>Email: ' . $dato['email'] . '</h5>
        <p>' . substr($dato['comentario'], 0, 8) . '...</p>
        <a href="#mensaje' . $dato['id'] . '" class="btn btn-primary btnMensajeVisto" data-toggle="modal" id="' . $dato['id'] . '">Leer mensaje</a>
          </div>
        <div id="mensaje' . $dato['id'] . '" class="modal fade">
                 <div class="modal-dialog modal-content">
                 <div class="modal-header" style="border:1px solid #eee">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title">Mensaje Nuevo</h3>
            </div>
            <div class="modal-body" style="border:1px solid #eee">
                <h3>De: ' . $dato['nombre'] . '</h3>
                <h3>Email: ' . $dato['email'] . '</h3>
                <hr>
                <p class="parrafoContenido">' . $dato['comentario'] . '</p>
             </div>
             <div class="modal-footer" style="border:1px solid #eee">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
            </div>
      
    </div>';
        }
    }


    #FUNCION QUE REALZIA EL UPDATE SOBRE LOS MENSAJES QUE SE VIERON
    public function actualizaEstadoMensajeController($datos)
    {
        $respuesta = @MensajeModel::actualizaEstadoMensajeModel($datos);

        return $respuesta;
    }


    #FUNCUON QUE DEVUELVE LOS MENSAJES DE ACUERDO AL ESTADO VISTO O NO
    public function mostrarMensajeController($datos)
    {
        $respuesta = @MensajeModel::mostrarMensajeModel($datos);

        if ($datos == 1) {
            $claseExtra = 'btnMensajeVistos';
        } else {
            $claseExtra = 'btnMensajeVisto';
        }


        /*uso substr() //para cortar la cadena y mostrar solo una parte*/
        foreach ($respuesta as $dato) {
            echo '<div class="well well-sm">
        <span class="fa fa-times pull-right"></span>
        <h3>De: ' . $dato['nombre'] . '</h3>
        <h5>Email: ' . $dato['email'] . '</h5>
        <p>' . substr($dato['comentario'], 0, 8) . '...</p>
        <a href="#mensaje' . $dato['id'] . '" class="btn btn-primary ' . $claseExtra . '" data-toggle="modal" id="' . $dato['id'] . '">Leer mensaje</a>
          </div>
        <div id="mensaje' . $dato['id'] . '" class="modal fade">
                 <div class="modal-dialog modal-content">
                 <div class="modal-header" style="border:1px solid #eee">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title">Mensaje Nuevo</h3>
            </div>
            <div class="modal-body" style="border:1px solid #eee">
                <h3>De: ' . $dato['nombre'] . '</h3>
                <h3>Email: ' . $dato['email'] . '</h3>
                <hr>
                <p class="parrafoContenido">' . $dato['comentario'] . '</p>
             </div>
             <div class="modal-footer" style="border:1px solid #eee">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
            </div>
      
    </div>';
        }

    }


    #FUNCION QUE DEVUELVE LA CANTIDAD DE USUARIOS DEL LIST BOX A ENVIAR EL EMAIL
    public function devuelveEmailsMensajeController()
    {
        $respuesta = @MensajeModel::devuelveEmailsMensajeModel();
        foreach ($respuesta as $dato) {
            echo '<option data-tokens="ketchup mustard" value="' . $dato['email'] . '">' . $dato['nombre'] . '</option>';
        }
    }

    #FUNCION QUE ENVIARA EL EMAIL AL DESINATARIO ASIGNADO
    public function enviarEmailController($datos)
    {

        $to = $datos['email'];
        $subject = $datos['titulo'];
        $txt = $datos['mensaje'];
        $headers = "From: ing.gustavo.marquez@gmail.com";

        if (mail($to, $subject, $txt, $headers)) {
            return 'ok';
        } else {
            return 'error';
        }

    }

    #FUNCION QUE DEVUELVE LA CANTIDAD DE MENSAJES SIN LEER
    public function cantidadMensajesSinLeerController()
    {
        $respuesta = @MensajeModel::cantidadMensajesSinLeerModel();
        return $respuesta;
    }

    #FUNCION QUE DEVUEVE LA CANTIDAD MENSAJES Y SUSCRIPREORES HAY
    public function cantidadDeMensajesSuscritoresNuevos()
    {
        $respuesta = @MensajeModel::cantidadMensajesSinLeerModel();
        echo $respuesta['CANTIDAD'];
    }

}

?>