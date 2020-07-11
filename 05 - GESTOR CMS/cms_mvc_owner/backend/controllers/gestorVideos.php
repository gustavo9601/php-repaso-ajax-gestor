<?php
ini_set("memory_limit", "50M");
ini_set('post_max_size', "50M");

class GestorVideos
{
    #FUNCION QUE SUBE EL VIDEO AL SERVER Y DEVUELVE LA CONSULTA DE URL del MODEL
    public function mostrarVideoController($datos)
    {
        $aleatorio = mt_rand(100, 999);
        $ruta = '../../views/videos/video' . $aleatorio . '.mp4';

        //permite subir cualquier tipo de archivo


        if (move_uploaded_file($datos, $ruta)) {
            //haciendo el insert desde el modelo de la ruta
            $respuesta = @GestorVideosModel::subirVideoModel($ruta, 'videos');
            if ($respuesta == 'ok') {
                //query que me devuelve con el url del video subido al server e insertado en la BD
                $respuesta2 = @GestorVideosModel::mostrarVideoModel($ruta, 'videos');
                $enviarDatos = $respuesta2['ruta'];
                echo $enviarDatos;
            } else {
                echo 'error';
            }
        } else {
            echo 'error';
        }
    }

    #FUNCION VIDEOS EN LA VISTA
    public function mostrarVideoVistaController()
    {
        //llamando al modelo
        $respuesta = @GestorVideosModel::mostrarVideoVistaModel("videos");

        foreach ($respuesta as $dato) {
            echo '<li id="' . $dato['id'] . '" ruta="' . $dato['ruta'] . '" class="bloqueVideo">
            <span class="fa fa-times eliminarVideo"></span>
            <video controls class="handleVideo">
                <source src="' . substr($dato['ruta'], 6) . '" type="video/mp4">
            </video>
            </li>';
        }

    }

    #FUNCION QUE ELIMINA EL VIDEO
    public function eliminarVideoController($datos)
    {
        //eliminado los datos
        $respuesta = @GestorVideosModel::eliminarVideoModel($datos, 'videos');
        if ($respuesta == 'ok') {
            //eliminado el video del servidor
            unlink($datos['rutaVideo']);

            echo 'ok';
        } else {
            echo 'error';
        }
    }

    #FUCION DE ACTUALIZAR ORDEN de videos
    public function actualizarOrdenController($datos)
    {
        $respuesta = @GestorVideosModel::actualizarOrdenModel($datos, 'videos');

        if ($respuesta == 'ok') {

            $respuesta2 = @GestorVideosModel::seleccionarOrdenModel('videos');

            foreach ($respuesta2 as $dato) {
                echo '<li id="' . $dato['id'] . '" ruta="' . $dato['ruta'] . '" class="bloqueVideo">
            <span class="fa fa-times eliminarVideo"></span>
            <video controls class="handleVideo">
                <source src="' . substr($dato['ruta'], 6) . '" type="video/mp4">
            </video>
            </li>';
            }
        } else {
            echo 'error';
        }

    }
}

?>