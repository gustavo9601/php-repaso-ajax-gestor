<?php


class Videos
{

    public function seleccionarVideosController()
    {

        $respuesta = @VidesoModel::seleccionarVideosModel('videos');

        foreach ($respuesta as $dato) {
            echo '<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <video controls width="100%">
            <source src="backend/' . substr($dato['ruta'],6) . '" type="video/mp4">
        </video>
    </div>';
        }

    }

}

?>