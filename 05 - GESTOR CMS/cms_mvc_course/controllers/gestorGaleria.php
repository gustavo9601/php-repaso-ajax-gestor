<?php

class Galeria
{
    public function seleccionarGaleriaController()
    {
        $respuesta = @GaleriaModels::seleccionarGaleriaModel('galeria');

        foreach ($respuesta as $dato) {
            echo '<li>
                <a rel="grupo" href="backend/' . substr($dato['ruta'], 6) . '">
                    <img src="backend/' . substr($dato['ruta'], 6) . '">
                </a>
            </li>';
        }


    }

}

?>